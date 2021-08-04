<?php
/**
 * Created by PhpStorm.
 * Filename: Currency.php
 * User: Orhan BAHAR
 * Date: 26.07.2021
 * Time: 18:52
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';
    public $timestamps = false;
}
