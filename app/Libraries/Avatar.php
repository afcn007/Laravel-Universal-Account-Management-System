<?php
namespace App\Libraries;

use Config;
use Illuminate\Routing\UrlGenerator;

class Avatar {
    /**
    * generate avatar url
    * @param $avatar
    * @return string
    */
    public static function getAvatar($avatar = '')
    {
        $cdnUrl = rtrim(Setting::get('cdn_url', '/'), '/');
        if (!$avatar) {
            return $cdnUrl . '/' . ltrim(Config::get('auth.default_avatar'), '/');
        }
        if (app(UrlGenerator::class)->isValidUrl($avatar)) {
            return $avatar;
        }
        return $cdnUrl . '/' . ltrim($avatar, '/');
    }
}
