<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all(),
            'page_title' => '用户管理',
            'authority' => Auth::User()['authority']
        ];
        return view('user', $data);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->withSuccess('用户删除成功。');
    }

    public function update(Request $request, $id)
    {
        if ($request->input('password') != '')
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|confirmed|min:6'
            ]);
            if (User::where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]))
            {
                return redirect('/user')->withSuccess('用户信息修改成功。');
            }
            else
            {
                return redirect('/user')->withErrors('用户信息修改失败。');
            }
        }
        else
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255'
            ]);
            if (User::where('id', $id)->update($request->except(['_method', '_token', 'password', 'password_confirmation'])))
            {
                return redirect('/user')->withSuccess('用户信息修改成功。');
            }
            else
            {
                return redirect('/user')->withErrors('用户信息修改失败。');
            }
        }
    }
}
