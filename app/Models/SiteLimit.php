<?php
/**
 * Created by PhpStorm.
 * Filename: SiteLimit.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 11:29
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteLimit extends Model
{
    protected $table = 'sites_limits';
    public $timestamps = false;
}
