<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    /**
    * Admin home page
    *
    * @return \Illuminate\View\View
    */
    public function home()
    {
    	$status = [
    		'system' => php_uname('s') . '-' . php_uname('r'),
    		'php_sapi_name' => php_sapi_name(),
    		'php_version' => PHP_VERSION,
    		'host' => $_SERVER['HTTP_HOST'],
    		'remote_addr' => $_SERVER['REMOTE_ADDR'],
    		'server_protocol' => $_SERVER['SERVER_PROTOCOL'],
    	];
    	return view('admin.home', compact('status'));
    }
}
