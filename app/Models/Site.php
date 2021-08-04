<?php
/**
 * Created by PhpStorm.
 * Filename: Site.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 18:48
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';
    public $timestamps = false;

    protected $fillable = [
        'custom_css_web',
        'custom_css_mobile',
        'custom_js_web',
        'custom_js_mobile',
        'facebook',
        'twitter',
        'youtube',
        'instagram',
        'pinterest',
        'whatsapp',
        'telegram',
        'messenger',
        'name',
        'title',
        'address',
        'description',
        'keywords',
        'timezone',
        'multilang',
        'email',
        'auto_forwading',
        'home_forwading',
        'lang',
        'currency',
        'logo_url',
        'favicon_url',
        'https',
        'bettingstatus',
        'casinostatus',
        'slotstatus',
        'newcustomerbettingstatus',
        'newcustomercasinostatus',
        'newcustomerslotstatus',
        'betslip_logo_url',
        'betslip_signature',
        'provider_list'
    ];
}
