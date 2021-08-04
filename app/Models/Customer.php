<?php
/**
 * Created by PhpStorm.
 * Filename: Customer.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 12:32
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\CustomerGroup;
use App\Models\Affiliate;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function group(): HasOne
    {
        return $this->hasOne(CustomerGroup::class, 'id', 'group_id');
    }

    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class, 'id', 'affiliate_id');
    }

    public function site(): HasOne
    {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }

    /**
     * @param $siteId
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public static function getDailyUserCount($siteId, $startDate, $endDate)
    {
        return self::where('site_id', $siteId)
            ->whereBetween('create_date', [
                $startDate,
                $endDate
            ])
            ->count();
    }

    /**
     * @param $siteId
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public static function getDailyActiveUserCount($siteId, $startDate, $endDate)
    {
        return self::where('site_id', $siteId)
            ->whereBetween('online_date', [
                $startDate,
                $endDate
            ])
            ->count();
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public static function getInstantActiveUserCount($siteId)
    {
        return self::where('site_id', $siteId)
            ->whereBetween('online_date', [
                Carbon::now()->addMinutes('-2'),
                Carbon::now()->addMinutes('+2')
            ])
            ->count();
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public static function getCustomersForDashBoard($siteId)
    {
        return self::select([
            'balance',
            'currency',
            'site_id'
        ])
            ->with(['site' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->where('site_id', $siteId)
            ->get();
    }
}
