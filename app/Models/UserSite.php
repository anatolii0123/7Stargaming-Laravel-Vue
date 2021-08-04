<?php
/**
 * Created by PhpStorm.
 * Filename: UserSite.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 18:32
 */

namespace App\Models;

use App\Models\Site;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserSite extends Model
{
    protected $table = 'user_sites';
    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function site(): HasOne
    {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }

    public static function getSitesForUserId($userId)
    {
        return self::where('user_id', $userId)->get();
    }
}
