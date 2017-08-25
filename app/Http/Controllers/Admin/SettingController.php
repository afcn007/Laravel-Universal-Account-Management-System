<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function show()
    {
        $app_name = Setting::get('app_name');
        $cdn_url = Setting::get('cdn_url');
        $settings = [
          "app_name" => $app_name,
          "cdn_url" => $cdn_url,
        ];
        return view('admin.setting', compact('settings'));
    }

    public function postSave(Request $request)
    {
        $app_name = is_null($request->get('app_name', '')) ? "" : $request->get('app_name', '');
        $cdn_url = is_null($request->get('cdn_url', '')) ? "" : $request->get('cdn_url', '');

        if (filter_var($cdn_url, FILTER_SANITIZE_URL) === false) {
            $cdn_url = "/";
        }
        Setting::set("app_name", $app_name);
        Setting::set("cdn_url", $cdn_url);
        return $this->successReturn('修改成功');
    }
}
