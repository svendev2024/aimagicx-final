<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['id' => 1, 'language' => 'Arabic', 'language_code' => 'ar-AE', 'language_flag' => '/img/flags/ae.svg', 'status' => 1],
            ['id' => 2, 'language' => 'Chinese (Mandarin)', 'language_code' => 'cmn-CN', 'language_flag' => '/img/flags/cn.svg', 'status' => 1],
            ['id' => 3, 'language' => 'Croatian (Croatia)', 'language_code' => 'hr-HR', 'language_flag' => '/img/flags/hr.svg', 'status' => 1],
            ['id' => 4, 'language' => 'Czech (Czech Republic)', 'language_code' => 'cs-CZ', 'language_flag' => '/img/flags/cz.svg', 'status' => 1],
            ['id' => 5, 'language' => 'Danish (Denmark)', 'language_code' => 'da-DK', 'language_flag' => '/img/flags/dk.svg', 'status' => 1],
            ['id' => 6, 'language' => 'Dutch (Netherlands)', 'language_code' => 'nl-NL', 'language_flag' => '/img/flags/nl.svg', 'status' => 1],
            ['id' => 7, 'language' => 'English (USA)', 'language_code' => 'en-US', 'language_flag' => '/img/flags/us.svg', 'status' => 1],
            ['id' => 8, 'language' => 'Estonian (Estonia)', 'language_code' => 'et-EE', 'language_flag' => '/img/flags/ee.svg', 'status' => 1],
            ['id' => 9, 'language' => 'Finnish (Finland)', 'language_code' => 'fi-FI', 'language_flag' => '/img/flags/fi.svg', 'status' => 1],
            ['id' => 10, 'language' => 'French (France)', 'language_code' => 'fr-FR', 'language_flag' => '/img/flags/fr.svg', 'status' => 1],
            ['id' => 11, 'language' => 'German (Germany)', 'language_code' => 'de-DE', 'language_flag' => '/img/flags/de.svg', 'status' => 1],
            ['id' => 12, 'language' => 'Greek (Greece)', 'language_code' => 'el-GR', 'language_flag' => '/img/flags/gr.svg', 'status' => 1],
            ['id' => 13, 'language' => 'Hebrew (Israel)', 'language_code' => 'he-IL', 'language_flag' => '/img/flags/il.svg', 'status' => 1],
            ['id' => 14, 'language' => 'Hindi (India)', 'language_code' => 'hi-IN', 'language_flag' => '/img/flags/in.svg', 'status' => 1],
            ['id' => 15, 'language' => 'Hungarian (Hungary)', 'language_code' => 'hu-HU', 'language_flag' => '/img/flags/hu.svg', 'status' => 1],
            ['id' => 16, 'language' => 'Icelandic (Iceland)', 'language_code' => 'is-IS', 'language_flag' => '/img/flags/is.svg', 'status' => 1],
            ['id' => 17, 'language' => 'Indonesian (Indonesia)', 'language_code' => 'id-ID', 'language_flag' => '/img/flags/id.svg', 'status' => 1],
            ['id' => 18, 'language' => 'Italian (Italy)', 'language_code' => 'it-IT', 'language_flag' => '/img/flags/it.svg', 'status' => 1],
            ['id' => 19, 'language' => 'Japanese (Japan)', 'language_code' => 'ja-JP', 'language_flag' => '/img/flags/jp.svg', 'status' => 1],
            ['id' => 20, 'language' => 'Korean (South Korea)', 'language_code' => 'ko-KR', 'language_flag' => '/img/flags/kr.svg', 'status' => 1],
            ['id' => 21, 'language' => 'Malay (Malaysia)', 'language_code' => 'ms-MY', 'language_flag' => '/img/flags/my.svg', 'status' => 1],
            ['id' => 22, 'language' => 'Norwegian (Norway)', 'language_code' => 'nb-NO', 'language_flag' => '/img/flags/no.svg', 'status' => 1],
            ['id' => 23, 'language' => 'Polish (Poland)', 'language_code' => 'pl-PL', 'language_flag' => '/img/flags/pl.svg', 'status' => 1],
            ['id' => 24, 'language' => 'Portuguese (Portugal)', 'language_code' => 'pt-PT', 'language_flag' => '/img/flags/pt.svg', 'status' => 1],
            ['id' => 25, 'language' => 'Russian (Russia)', 'language_code' => 'ru-RU', 'language_flag' => '/img/flags/ru.svg', 'status' => 1],
            ['id' => 26, 'language' => 'Spanish (Spain)', 'language_code' => 'es-ES', 'language_flag' => '/img/flags/es.svg', 'status' => 1],
            ['id' => 27, 'language' => 'Swedish (Sweden)', 'language_code' => 'sv-SE', 'language_flag' => '/img/flags/se.svg', 'status' => 1],
            ['id' => 28, 'language' => 'Turkish (Turkey)', 'language_code' => 'tr-TR', 'language_flag' => '/img/flags/tr.svg', 'status' => 1],
            ['id' => 29, 'language' => 'Portuguese (Brazil)', 'language_code' => 'pt-BR', 'language_flag' => '/img/flags/br.svg', 'status' => 1],
            ['id' => 30, 'language' => 'Romanian (Romania)', 'language_code' => 'ro-RO', 'language_flag' => '/img/flags/ro.svg', 'status' => 1],
            ['id' => 31, 'language' => 'Vietnamese (Vietnam)', 'language_code' => 'vi-VN', 'language_flag' => '/img/flags/vn.svg', 'status' => 1],
            ['id' => 32, 'language' => 'Swahili (Kenya)', 'language_code' => 'sw-KE', 'language_flag' => '/img/flags/ke.svg', 'status' => 1],
            ['id' => 33, 'language' => 'Slovenian (Slovenia)', 'language_code' => 'sl-SI', 'language_flag' => '/img/flags/si.svg', 'status' => 1],
            ['id' => 34, 'language' => 'Thai (Thailand)', 'language_code' => 'th-TH', 'language_flag' => '/img/flags/th.svg', 'status' => 1],
            ['id' => 35, 'language' => 'Ukrainian (Ukraine)', 'language_code' => 'uk-UA', 'language_flag' => '/img/flags/ua.svg', 'status' => 1],
            ['id' => 36, 'language' => 'Lithuanian (Lithuania)', 'language_code' => 'lt-LT', 'language_flag' => '/img/flags/lt.svg', 'status' => 1],
            ['id' => 37, 'language' => 'Bulgarian (Bulgaria)', 'language_code' => 'bg-BG', 'language_flag' => '/img/flags/bg.svg', 'status' => 1],
            ['id' => 38, 'language' => 'Tamil (Malaysia)', 'language_code' => 'ta-MY', 'language_flag' => '/img/flags/my.svg', 'status' => 1],
            ['id' => 39, 'language' => 'Persian (Iran)', 'language_code' => 'fa-IR', 'language_flag' => '/img/flags/ir.svg', 'status' => 1],
            ['id' => 40, 'language' => 'English (UK)', 'language_code' => 'en-GB', 'language_flag' => '/img/flags/gb.svg', 'status' => 1],
            ['id' => 41, 'language' => 'Slovak (Slovakia)', 'language_code' => 'sk-SK', 'language_flag' => '/img/flags/sk.svg', 'status' => 1],
            ['id' => 42, 'language' => 'Latvian (Latvia)', 'language_code' => 'lv-LV', 'language_flag' => '/img/flags/lv.svg', 'status' => 1],
            ['id' => 43, 'language' => 'Albanian (Albania)', 'language_code' => 'sq-AL', 'language_flag' => '/img/flags/al.svg', 'status' => 1],
            ['id' => 44, 'language' => 'Filipino (Philippines)', 'language_code' => 'fil-PH', 'language_flag' => '/img/flags/ph.svg', 'status' => 1],
            ['id' => 45, 'language' => 'Khmer (Cambodia)', 'language_code' => 'km-KH', 'language_flag' => '/img/flags/kh.svg', 'status' => 1],
            ['id' => 46, 'language' => 'Bangla (Bangladesh)', 'language_code' => 'bn-BD', 'language_flag' => '/img/flags/bd.svg', 'status' => 1],
            ['id' => 47, 'language' => 'Bengali (India)', 'language_code' => 'bn-IN', 'language_flag' => '/img/flags/in.svg', 'status' => 1],
            ['id' => 48, 'language' => 'Welsh (Wales)', 'language_code' => 'cy-GB', 'language_flag' => '/img/flags/gb-wls.svg', 'status' => 1],
            ['id' => 49, 'language' => 'Catalan (Spain)', 'language_code' => 'ca-ES', 'language_flag' => '/img/flags/es.svg', 'status' => 1],
            ['id' => 50, 'language' => 'Serbian (Serbia)', 'language_code' => 'sr-RS', 'language_flag' => '/img/flags/rs.svg', 'status' => 1],
            ['id' => 51, 'language' => 'Maltese (Malta)', 'language_code' => 'mt-MT', 'language_flag' => '/img/flags/mt.svg', 'status' => 1],
            ['id' => 52, 'language' => 'Irish (Ireland)', 'language_code' => 'ga-IE', 'language_flag' => '/img/flags/ie.svg', 'status' => 1],
        ];


        foreach ($languages as $language) {
            Language::updateOrCreate(['id' => $language['id']], $language);
        }
    }
}
