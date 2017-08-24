<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Controllers\Common\AvatarController;
use App\Http\Controllers\Common\RegionController;
use Config;

class UserController extends Controller
{
    use AvatarController, RegionController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users = User::query();
        $inputs = $request->all();
        foreach ($inputs as $inputKey => $inputValue) {
            if ($inputValue !== null && $inputKey !== 'page') {
                $users->where($inputKey, 'like', '%' . $inputValue . '%');
            }
        }
        $users = $users->paginate(5);
        $users->appends($inputs);
        $countAllNum = User::count();
        return view("user.index", compact("users", 'inputs', 'countAllNum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->getRegionProvinces();
        $this->getAllRoles();
        return view("user.item", ["create" => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        
        //$infos = $request->all();
        //dd($infos);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'mobile' => 'digits:11|nullable',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:1,2',
            'roles' => 'array',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        $infos = $request->all();
        $infos['avatar'] = Config::get('auth.default_avatar');
        $infos['province'] = isset($infos['province']) ? $infos['province'] : 0;
        $infos['city'] = isset($infos['city']) ? $infos['city'] : 0;
        $infos['area'] = isset($infos['area']) ? $infos['area'] : 0;
        $infos['password'] = bcrypt($infos['password']);

        $user = User::create($infos);
        $user->roles()->sync($request->get('roles', []));
        return $this->successReturn(trans("common.add_success"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $create = false;
        $this->getRegionProvinces();
        $this->getAllRoles();
        $user = User::find($id);
        return view("user.item", compact("user", "create"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'mobile' => 'digits:11|nullable',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:0,2',
            'roles' => 'array',
            'password' => 'confirmed|min:6|nullable',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        $user = User::find($id);
        $user->mobile = $request->get('mobile');
        $user->nickname = $request->get('nickname');
        $user->description = $request->get('description');
        $user->sex = $request->get('sex', 0);
        $user->province = $request->get('province', 0);
        $user->city = $request->get('city', 0);
        $user->area = $request->get('area', 0);
        $user->avatar = $request->get('avatar', '');
        $password = $request->get('password', '');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        if($user->save()) {
            $user->roles()->sync($request->get('roles', []));
            return $this->successReturn(trans("common.edit_success"));
        }
        return $this->successReturn(trans("common.edit_fail"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        if ($user->delete()) {
            return $this->successReturn(trans('common.delete_success'));
        }
        return $this->errorReturn(trans('common.delete_fail'));
    }

    /**
    * share all roles in view
    *
    * @return null
    */
    public function getAllRoles()
    {
        $roles = Role::all();
        view()->share('roles', $roles);
    }

    /**
    * Post user avatar
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function postAvatar($id)
    {
        return $this->updateAvatar($id > 0 ? intval($id) : $this->authUser['id']);
    }

}
