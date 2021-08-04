<?php
/**
 * Created by PhpStorm.
 * Filename: Translate.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 11:32
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Translate extends Model
{
    protected $table = 'translate';
    public $timestamps = false;
    private static $langs = [
        'tr',
        'en',
        'ae',
        'az',
        'fa',
        'ru',
        'hbr',
        'zh'
    ];

    /**
     * @return array|mixed
     */
    public static function cacheAllTranslate(): array
    {
        $cacheKey = 'cacheAllTranslate';

        if (Cache::has($cacheKey))
            return Cache::get($cacheKey);

        $data = [];
        $query = self::get();

        foreach ($query as $item) {
            foreach (self::$langs as $lang) {
                $data[$lang][$item->id] = $item->{$lang};
            }
        }

        if (!empty($data))
            Cache::put($cacheKey, $data, now()->addMinutes(15));

        return $data;
    }
}
