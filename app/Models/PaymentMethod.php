<?php
/**
 * Created by PhpStorm.
 * Filename: PaymentMethod.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 00:37
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethod extends Model
{
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'site_id',
        'form',
        'lang',
        'group_id',
        'description',
        'deposit',
        'withdraw',
        'min_deposit',
        'min_withdraw',
        'max_deposit',
        'max_withdraw',
        'image',
        'fee',
        'time',
        'session_id',
        'api_id',
        'api_key',
        'blank',
        'status',
        'address',
        'priority'
    ];

    public function paymentGroup(): HasOne
    {
        return $this->hasOne(PaymentGroup::class, 'id', 'group_id');
    }
}
