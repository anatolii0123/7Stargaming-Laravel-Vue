<?php
/**
 * Created by PhpStorm.
 * Filename: SiteCurrency.php
 * User: Orhan BAHAR
 * Date: 25.07.2021
 * Time: 07:35
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SiteCurrency extends Model
{
    protected $table = 'sites_currencies';
    public $timestamps = false;
    protected $fillable = [
        'site_id',
        'currency'
    ];

    public function currencies(): HasOne
    {
        return $this->hasOne(Currency::class, 'code', 'currency');
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public static function getCurrenciesBySiteId($siteId)
    {
        return self::where('site_id', $siteId)->get();
    }
}
