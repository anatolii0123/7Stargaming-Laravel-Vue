<?php
/**
 * Created by PhpStorm.
 * Filename: Log.php
 * User: Orhan BAHAR
 * Date: 17.07.2021
 * Time: 12:14
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    public $timestamps = false;

    /**
     * @param $siteId
     * @param $ipAddress
     * @return mixed
     */
    public static function countByMultiIp($siteId, $ipAddress)
    {
        return self::select('logs.user_id as id', 'username')
            ->join('customer', function ($join) {
                $join->on('logs.user_id', '=', 'customer.id');
            })
            ->where('logs.site_id', '=', $siteId)
            ->where('logs.ip_address', '=', $ipAddress)
            ->where('logs.type', '=', 'login')
            ->where('logs.user_id', '>', 0)
            ->groupBy('logs.user_id')
            ->get();
    }
}
