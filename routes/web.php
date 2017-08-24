<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Carbon\Carbon;
use GuzzleHttp\Client;
Route::get('/', [
  'middleware' => ['auth'],
  'uses' => function () {
    if (Auth::user() && Auth::user()->hasRole('admin')) {
        return redirect('/admin');
    }
    return redirect('/user');
  },
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@test')->middleware('auth');
Route::get('/test2', function(){
	$a = new Client();
  $response = $a->get('http://dev.passport.com/api/user');
});

Route::group(['prefix'=> '/admin', 'middleware' => ['auth', 'role:admin'], 'namespace' => 'Admin'], function($router){
  $router->get('/', 'AdminController@home');
  $router->resource('users', 'UserController');
  $router->get('/dashboard', function(){
    return view("admin.dashboard");
  });

  $router->get('/setting', 'SettingController@show');
  $router->post('/setting', 'SettingController@postSave');
  // role permissions
  $router->get('/roles/permission/{id}', 'RoleController@getPermission');
  $router->post('/roles/permission/{id}', 'RoleController@postPermission');
  // roles route
  $router->resource('roles', 'RoleController');

  // permissions route
  $router->resource('permissions', 'PermissionController');

  // clients route
  $router->get('clients', 'ClientsController@clients');
});

Route::group(['middleware'=> ['auth']], function($router) {
  $router->post('/user/avatar/{id}', 'Admin\UserController@postAvatar');

  $router->get('/user/region', 'Admin\UserController@getRegion');

});

Route::group(['prefix'=> '/user', 'middleware'=> ['auth'], 'namespace' => 'Front'], function($router) {
  $router->get('/', 'HomeController@home');
  $router->get('/profile', 'UserController@edit');
  $router->post('/profile', 'UserController@update');


});