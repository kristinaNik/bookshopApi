<?php


namespace App\Traits;


use Carbon\Carbon;

trait ParseDateTrait
{

    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @return object
     */
    public function parseDate(string $dateFrom, string $dateTo): object
    {
        $dates =  [
            'dateFrom' => Carbon::parse($dateFrom)->toDate(),
            'dateTo'   => Carbon::parse($dateTo)->toDate()
        ];

        $datesObject = (object) $dates;
        $datesObject->dateFrom;
        $datesObject->dateTo;

        return  $datesObject;

    }

}