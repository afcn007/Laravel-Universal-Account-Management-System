<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class HomeController extends Controller
{
    //
    public function home()
    {
    	$user = Auth::user();
    	$records = DB::table('oauth_access_tokens')
    		->join('oauth_clients', 'oauth_access_tokens.client_id', '=', 'oauth_clients.id')
    		->where('oauth_access_tokens.user_id', $user->id)
    		->select('oauth_access_tokens.created_at', 'oauth_clients.name')
    		->paginate(15);
    	return view('frontend.index', compact('records'));
    }
}
