<?php
/**
 * Created by PhpStorm.
 * Filename: Coupon.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 14:55
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Coupon extends Model
{
    protected $table = 'coupon';
    public $timestamps = false;

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'user_id');
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
    public static function getCouponsForDashBoard($siteId, $startDate, $endDate)
    {
        return self::select([
            'user_id',
            'site_id',
            'amount',
            'win',
            'status'
        ])
            ->with(['customer' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->with(['site' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->where('site_id', $siteId)
            ->whereBetween('create_date', [
                $startDate,
                $endDate
            ])
            ->get();
    }
}
