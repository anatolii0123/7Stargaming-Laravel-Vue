<?php
/**
 * Created by PhpStorm.
 * Filename: CustomerGroup.php
 * User: Orhan BAHAR
 * Date: 12.07.2021
 * Time: 02:03
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_group';
    public $timestamps = false;
    protected $fillable = [
        'site_id',
        'name',
        'status',
        'note',
        'color',
        'icon',
        'deposit_floor',
        'deposit_discount_access',
        'withdraw_amount',
        'withdraw_discount_remove',
        'discount_day',
        'discount_floor'
    ];
}
