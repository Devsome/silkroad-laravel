<?php

namespace App\Http\Library\Services\SRO\Log;

use File;

class UniqueService
{
    /**
     * @param $data
     * @return mixed
     */
    public function getUniquePoints($data)
    {
        $collection = $data;
        $uniquePoints = config('unique');

        // If the unique example is not copied - Fallback
        if (!File::exists(config_path() . '/unique.php')) {
            $uniquePoints = config('unique.example');
        } else {
            unset($uniquePoints['example']);
        }
        $uniquePoints = $collection->map(static function ($data) use ($uniquePoints) {

            $uniqueMappingName = data_get($uniquePoints, $data->UniqueName . '.name', $data->UniqueName);
            $uniqueMappingPoints = data_get($uniquePoints, $data->UniqueName . '.points', null);

            if ($uniqueMappingPoints === null) {
                $test = array_search(
                    $data->UniqueName,
                    array_map(
                        static function ($a) {
                            return $a['name'];
                        },
                        $uniquePoints
                    ),
                    true
                );


                $a = array_map(static function ($a) {
                    return $a['points'];
                }, $uniquePoints);

                $uniqueMappingPoints = data_get($a, $test, 0);
            }

            $data->UniqueName = str_replace(
                array_keys($uniquePoints),
                $uniqueMappingName,
                $data->UniqueName
            );
            $data->Points = (integer)$uniqueMappingPoints;
            return $data;
        });
        $uniquePoints = $uniquePoints->groupBy('CharName16')
            ->map(static function ($d) {
                $sum = $d->sum('Points');
                if ($sum > 0) {
                    return [
                        'points' => $d->sum('Points')
                    ];
                }
            });
        $uniquePoints = $uniquePoints->sortDesc();
        $uniquePoints->values()->all();
        $uniquePoints = $uniquePoints->filter(static function ($value) {
            return !is_null($value);
        });
        return $uniquePoints;
    }
}
