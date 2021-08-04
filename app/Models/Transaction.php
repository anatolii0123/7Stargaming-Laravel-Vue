<?php
/**
 * Created by PhpStorm.
 * Filename: Transaction.php
 * User: Orhan BAHAR
 * Date: 24.07.2021
 * Time: 20:41
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $table = 'transactions';
    public $timestamps = false;

    public function paymentMethod(): HasOne
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function site(): HasOne
    {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }

    public function game(): HasOne
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }

    /**
     * @param $siteId
     * @param $type
     * @param $startDate
     * @param $endDate
     * @return Builder[]|Collection
     */
    public static function getFinanceTransactionsForDashBoard($siteId, $type, $startDate, $endDate)
    {
        return self::select([
            'type',
            'amount',
            'currency',
            'site_id',
            'game_id',
            'customer_id',
            'payment_id'
        ])
            ->with(['customer' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->with(['site' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->with(['paymentMethod.paymentGroup' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('site_id', $siteId)
            ->where('type', $type)
            ->where('status', 1)
            ->whereBetween('date', [
                $startDate,
                $endDate
            ])
            ->get();
    }

    /**
     * @param $siteId
     * @param $customerId
     * @return mixed
     */
    public static function getLastDepositForCustomer($siteId, $customerId)
    {
        return self::where('site_id', $siteId)
            ->where('customer_id', $customerId)
            ->where('type', 'deposit')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * @param $siteId
     * @param $customerId
     * @return mixed
     */
    public static function getLastWithdrawForCustomer($siteId, $customerId)
    {
        return self::where('site_id', $siteId)
            ->where('customer_id', $customerId)
            ->where('type', 'withdraw')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * @param $siteId
     * @param $startDate
     * @param $endDate
     * @return Builder[]|Collection
     */
    public static function getGameTransactionsForDashBoard($siteId, $startDate, $endDate)
    {
        return self::select([
            'type',
            'amount',
            'currency',
            'site_id',
            'game_id',
            'customer_id'
        ])
            ->with(['customer' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->with(['site' => function ($query) {
                $query->select('id', 'currency');
            }])
            ->with(['game' => function ($query) {
                $query->select('id', 'live', 'provider');
            }])
            ->where('site_id', $siteId)
            ->whereIn('type', ['casinoPlay', 'casinoWin', 'casinoCancel'])
            ->where('status', 1)
            ->where('amount', '>', 0)
            ->whereBetween('date', [
                $startDate,
                $endDate
            ])
            ->get();
    }
}
