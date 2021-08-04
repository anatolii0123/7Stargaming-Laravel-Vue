<?php
/**
 * Created by PhpStorm.
 * Filename: LanguageController.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 11:33
 */

namespace App\Http\Controllers;

use App\Models\Translate;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function translate(): JsonResponse
    {
        $getTranslates = Translate::cacheAllTranslate();

        return response()->json($getTranslates);
    }

    /**
     * @param $lang
     * @return JsonResponse
     */
    public function changeLang($lang): JsonResponse
    {
        $defaultLang = [
            'tr',
            'en',
            'fa',
            'ru',
            'ae',
            'az',
            'hbr',
            'ar',
            'ku',
            'zh',
            'de',
        ];

        if (in_array($lang, $defaultLang)) {
            session(['lang' => $lang]);
            app()->setLocale($lang);
        } else {
            session(['lang' => 'tr']);
            app()->setLocale('tr');
        }

        return response()->json(['status' => true]);
    }

    /**
     * @return JsonResponse
     */
    public function languages(): JsonResponse
    {
        $dataResponse = [
            [
                'name' => 'Türkçe',
                'code' => 'tr',
                'direction' => 'ltr'
            ],
            [
                'name' => 'İngilizce',
                'code' => 'en',
                'direction' => 'ltr'
            ],
            [
                'name' => 'Rusça',
                'code' => 'ru',
                'direction' => 'ltr'
            ]
        ];

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $dataResponse
        ]);
    }
}
