<?php
/**
 * Created by PhpStorm.
 * Filename: PaymentGroup.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 01:18
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGroup extends Model
{
    protected $table = 'payments_group';
    public $timestamps = false;
}
