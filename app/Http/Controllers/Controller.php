<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $siteId = null;
    public $lang = null;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->siteId = (int)$request->header('ActiveSite');
        $this->lang = (string)$request->header('ActiveLang');
    }

    /**
     * @param $timezone
     * @return string
     */
    public function checkTimeZone($timezone): string
    {
        if (!empty($timezone)) {
            return $timezone;
        } else
            return '+3';
    }

    /**
     * @param $date
     * @return string
     */
    public function dateConvert($date): string
    {
        if ($date != "0000-00-00 00:00:00" and $date != "") {
            $explode = explode(" ", $date);
            $explode2 = explode("-", $explode[0]);
            return $explode2[2] . "." . $explode2[1] . "." . $explode2[0] . " " . $explode[1];
        }
    }

    /**
     * @param $date
     * @param $timezone
     * @return false|string
     */
    public function timezone($date, $timezone)
    {
        if ($date != "0000-00-00 00:00:00") {
            return date("Y-m-d H:i:s", strtotime($timezone . ' hours', strtotime($date)));
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function convertLoopData($data): array
    {
        if (!empty($data)) {
            $newData = [];

            foreach ($data as $d) {
                $newData[] = $d;
            }

            return $newData;
        }

        return $data;
    }

    /**
     * @param $money
     * @return array|string|string[]
     */
    public function numberFormat($money)
    {
        $money = str_replace(',', '', $money);
        $money = number_format($money, 2, '.', '');
        $money = str_replace(',', '.', $money);
        return $money;
    }

    /**
     * @param $timezone
     * @return string
     */
    public function reverseTimeZone($timezone): string
    {
        $symbol = substr($timezone, 0, 1);
        $hour = str_replace($symbol, '', $timezone);

        if ($symbol === '+') {
            return '-' . $hour;
        } else {
            return '+' . $hour;
        }
    }

    /**
     * @param $timezone
     * @return string
     */
    public function startMonth($timezone): string
    {
        return Carbon::now()
            ->startOfMonth()
            ->addHours($this->reverseTimeZone($timezone))
            ->format('Y-m-d H:i:s');
    }

    /**
     * @param $timezone
     * @return string
     */
    public function startDay($timezone): string
    {
        return Carbon::now()
            ->startOfDay()
            ->addHours($this->reverseTimeZone($timezone))
            ->format('Y-m-d H:i:s');
    }
}
