<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Controllers\Common\RegionController;

class UserController extends Controller
{
    use RegionController;
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $user = Auth::user();
        $this->getRegionProvinces();
        return view('frontend.user.item', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'mobile' => 'digits:11|nullable',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:0,2',
            'password' => 'confirmed|min:6|nullable',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        $user = Auth::user();
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
        if ($user->save()) {
            return $this->successReturn(trans("common.edit_success"));
        }
        return $this->successReturn(trans("common.edit_fail"));
    }
}
