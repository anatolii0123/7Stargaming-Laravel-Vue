<?php
/**
 * Created by PhpStorm.
 * Filename: IpBan.php
 * User: Orhan BAHAR
 * Date: 17.07.2021
 * Time: 19:41
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IpBan extends Model
{
    protected $table = 'ipban';
    public $timestamps = false;
    protected $fillable = [
        'site_id',
        'admin_id',
        'ip_address',
        'description',
        'date',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }
}
