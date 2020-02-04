<?php

namespace App\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class OnlineOfflineLog extends Model
{

    /*
     * _AddLogChar Procedure in SRO_VT_LOG
     * Add this after the set variables
        BEGIN
	      -- SET NOCOUNT ON added to prevent extra result sets from
	      SET NOCOUNT ON;
	      IF EXISTS (SELECT 1 FROM onlineofflinelog WHERE CharID = @CharID)
	        UPDATE onlineofflinelog
	        SET    status = @EventID
	        WHERE	CharID = @CharID
	      ELSE
	        INSERT INTO onlineofflinelog ([CharID],  [status])
	        VALUES      (@CharID, @EventID)
	  	END
     */

    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'log';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dbo.onlineofflinelog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jid',
        'CharId',
        'status'
    ];

    /**
     * If the Char is logged in
     */
    const STATUS_LOGGED_IN = 4;

    /**
     * If the Char is logged out
     */
    const STATUS_LOGGED_OUT = 6;
}
