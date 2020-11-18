<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebcmsProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // @Todo Need to be fixed
        $databaseCms = env('DB_SQL_SRO_WEB_LARAVEL', 'SRO_WEB_LARAVEL');
        $databaseShard = env('DB_SQL_DATABASE_SHARD', 'SRO_VT_SHARD');
        $procedure = <<<EOF
CREATE PROCEDURE [dbo].[_WebProcess] @CharID INT,
                                     @EventID TINYINT,
                                     @DESC VARCHAR(128),
                                     @strPos VARCHAR(64)
AS
    SET DATEFIRST 7;
DECLARE @CurrentDayNo TINYINT = DATEPART(WEEKDAY, GETDATE())
DECLARE @DayHour TINYINT = (SELECT DATEPART(HOUR, GETDATE()))
DECLARE @HourMinute TINYINT = (SELECT DATEPART(MINUTE, GETDATE()))

DECLARE
    @CharName VARCHAR(65) = (SELECT CharName16
                             FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                             WHERE CharID = @CharID)
DECLARE
    @CharWorldID TINYINT = (SELECT WorldID
                            FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                            WHERE CharID = @CharID)
DECLARE
    @KilledCharName VARCHAR(65) = (SELECT CharName16
                                   FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                                   WHERE CharID = @CharID)
DECLARE @KillerCharName VARCHAR(65) = @Desc
SELECT @KillerCharName = REPLACE(@KillerCharName, LEFT(@KillerCharName, CHARINDEX('(', @KillerCharName)), '')
SELECT @KillerCharName = REPLACE(@KillerCharName, RIGHT(@KillerCharName, CHARINDEX(')', REVERSE(@KillerCharName))), '')
DECLARE
    @KillerCharID INT = (SELECT CharID
                         FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                         WHERE CharName16 = @KillerCharName)
DECLARE
    @KilledCharID INT = (SELECT CharID
                         FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                         WHERE CharName16 = @KilledCharName)
DECLARE
    @KillerNickName VARCHAR(65) = (SELECT NickName16
                                   FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                                   WHERE CharName16 = @KillerCharName)
DECLARE
    @KilledNickName VARCHAR(65) = (SELECT NickName16
                                   FROM [{$databaseShard}].[dbo].[_Char] WITH (NOLOCK)
                                   WHERE CharName16 = @KilledCharName)
BEGIN

    IF (@EventID = 4) -- login
        BEGIN
            SET NOCOUNT ON;
            INSERT INTO [{$databaseCms}].[dbo].[loginhistory] ([CharID], [status])
            VALUES (@CharID, @EventId)
            IF EXISTS(SELECT 1 FROM [{$databaseCms}].[dbo].[onlineofflinelog] WHERE CharID = @CharID)
                BEGIN
                    UPDATE [{$databaseCms}].[dbo].[onlineofflinelog]
                    SET status = @EventID
                    WHERE CharID = @CharID
                END
            ELSE
                BEGIN
                    INSERT INTO [{$databaseCms}].[dbo].[onlineofflinelog] ([CharID], [status]) VALUES (@CharID, @EventID)
                END


        END
    ELSE
        IF (@EventID = 6) -- logout
            BEGIN
                DECLARE
                    @GuildID INT = (SELECT GuildID FROM [{$databaseShard}].[dbo].[_GuildMember] WHERE CharID = @CharID)
                UPDATE [{$databaseShard}].[dbo].[_Char]
                SET ItemPoints = (SELECT SUM
                                             (CASE
                                                  WHEN RO.CodeName128 LIKE '%_A_RARE' THEN RO.ReqLevel1 + 5
                                                  WHEN RO.CodeName128 LIKE '%_B_RARE' THEN RO.ReqLevel1 + 10
                                                  WHEN RO.CodeName128 LIKE '%_C_RARE' THEN RO.ReqLevel1 + 15
                                                  ELSE RO.ReqLevel1
                            END) + SUM(ISNULL(BOPT.nOptValue, 0)) + SUM(ISNULL(IT.OptLevel, 0)) ItemPoints
                                  FROM [{$databaseShard}].[dbo].[_Char] CH
                                           INNER JOIN [{$databaseShard}].[dbo]._Inventory IV ON IV.CharID = CH.CharID
                                           INNER JOIN [{$databaseShard}].[dbo]._Items IT ON IT.ID64 = IV.ItemID
                                           INNER JOIN [{$databaseShard}].[dbo]._RefObjCommon RO ON IT.RefItemID = RO.ID
[]                                  WHERE IV.slot < 13
                                    AND IV.slot <> 8
                                    AND IV.slot <> 7
                                    AND IV.CharID = CH.CharID
                                    AND IV.CharID = @CharID)
                WHERE _Char.CharID = @CharID

                IF (@GuildID > 0)
                    BEGIN
                        DECLARE
                            @GuildPoints INT = (SELECT SUM(CH.ItemPoints)
                                                FROM [{$databaseShard}].[dbo].[_Char] CH
                                                         INNER JOIN [{$databaseShard}].[dbo].[_Guild] GU ON CH.GuildID = GU.ID
                                                WHERE GU.ID = @GuildID)
                        UPDATE [{$databaseShard}].[dbo].[_Guild] SET ItemPoints = @GuildPoints / 10 WHERE ID = @GuildID
                    END


                IF EXISTS(SELECT 1 FROM [{$databaseCms}].[dbo].[onlineofflinelog] WHERE CharID = @CharID)
                    BEGIN
                        UPDATE [{$databaseCms}].[dbo].[onlineofflinelog]
                        SET status = @EventID
                        WHERE CharID = @CharID
                    END
                ELSE
                    BEGIN
                        INSERT INTO [{$databaseCms}].[dbo].[onlineofflinelog] ([CharID], [status]) VALUES (@CharID, @EventID)
                    END


            END

        ELSE
            IF (@EventID = 20)
                BEGIN
                    IF (@CharWorldID BETWEEN 2 AND 9) AND
                       EXISTS(SELECT * FROM [{$databaseCms}].[dbo].[_FortressStatus] WHERE Status = 'Running')
                        BEGIN
                            INSERT INTO [{$databaseCms}].[dbo].[pvp_records] (CharName, CharID, KilledCharName, KilledCharID,
                                                                         type, position, description, killed_at)
                            VALUES (@KillerCharName, @KillerCharID, @KilledCharName, @KilledCharID, N'4',
                                    REPLACE(REPLACE(RIGHT(@strPos, charindex(' )', reverse(@strPos)) - 1), '(', ''),
                                            ')', ''),
                                    '[' + @KillerCharName + '] has killed ' + '[' + @KilledCharName + '].', GETDATE())
                        END
                    ELSE
                        IF (@DESC LIKE '%Trader, Neutral, no freebattle team%' -- Trader
                            OR @DESC LIKE '%Hunter, Neutral, no freebattle team%' -- Hunter
                            OR @DESC LIKE '%Robber, Neutral, no freebattle team%' -- Thief
                            OR @DESC like '%no job, Neutral, %no job, Neutral%' -- Free PVP
                               )
                            AND (@CharWorldID NOT BETWEEN 2 AND 9)
                            BEGIN
                                -- Get killer name
                                -- Get job type
                                DECLARE
                                    @jobString VARCHAR(10) = LTRIM(RTRIM(SUBSTRING(@DESC, 5, 7)))
                                DECLARE
                                    @jobType INT = CASE
                                                       WHEN @jobString IN ('Trader', 'Robber', 'Hunter')
                                                           THEN (SELECT JobType
                                                                 FROM [{$databaseShard}].[dbo].[_CharTrijob]
                                                                 WHERE CharID = @KillerCharID)
                                                       ELSE 0 END
                                DECLARE
                                    @jobDesc VARCHAR(32) = CASE WHEN @jobType BETWEEN 1 AND 3 THEN 'Job Conflict' ELSE 'Free PVP' END
                                DECLARE
                                    @strDesc VARCHAR(512)
                                IF (@jobString LIKE 'Trader' OR @jobString LIKE 'Robber' OR @jobString LIKE 'Hunter')
                                    BEGIN
                                        -- If it's a Job Kill, then write character nicknames

                                        SET @strDesc = '[' + @KillerNickName + '] has killed [' + @KilledNickName +
                                                       '] on [' + @jobDesc + '] at [' +
                                                       CONVERT(VARCHAR(50), GETDATE()) + ']'
                                    END

                                ELSE
                                    BEGIN
                                        -- If it's normal PVP Kill, write real character names
                                        SET @strDesc = '[' + @KillerCharName + '] has killed [' + @KilledCharName +
                                                       '] on [' + @jobDesc + '] at [' +
                                                       CONVERT(VARCHAR(50), GETDATE()) + ']'
                                    END

                                IF (@KillerCharID > 0)
                                    BEGIN
                                        -- Update the log
                                        INSERT INTO [{$databaseCms}].[dbo].[pvp_records] (CharName, CharID, KilledCharName,
                                                                                     KilledCharID, type, position,
                                                                                     description, killed_at)
                                        VALUES (@KillerCharName, @KillerCharID, @KilledCharName, @KilledCharID,
                                                @jobType, @strPos, @strDesc, GETDATE())
                                    END
                            END

                END
END
EOF;

        DB::connection('cms')->unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('cms')->unprepared('DROP procedure IF EXISTS _WebProcess');
    }
}
