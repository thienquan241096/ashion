<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function getList()
    {
        $user = User::all();
        return view('admin/user/list', ['user' => $user]);
    }

    public function getCreate()
    {
        return view('admin/user/add');
    }

    public function postCreate(UserFormRequest $request)
    {
        try {
            $create = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'confirmPassword' => Hash::make($request->confirmPassword),
                'phone' => $request->phone,
                'type' => $request->type,
            ]);
            if ($create) {
                return redirect()->route('user.getCreate')->with('thongbao', "Thêm mới thành công !!!");
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('admin/user/edit', [
            'user' => $user
        ]);
    }

    public function postEdit($id, UserFormRequest $request)
    {

        try {
            $model = User::find($id);
            if (!$model) {
                return redirect(route('user.getList'));
            }
            $model->fill($request->all());
            $model->save();
            return redirect()->route('user.getList')->with('thongbao', "Sửa thành công !!!");
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getEditPasword($id)
    {
        $user = User::find($id);
        return view('admin/user/edit-password', [
            'user' => $user
        ]);
    }

    public function postEditPasword(Request $request)
    {
        // dd($request->all());
        if ($request->password == "") {
            $password = User::find($request->id)->password;
        } else {
            $password = Hash::make($request->password);
        }
        try {
            $update = User::where('id', $request->id)->update([
                'password' => $password,
            ]);
            return redirect()->route('user.getList')->with('thongbao', "Đổi pass thành công !!!");
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function postDelete(Request $request)
    {
        try {
            $delete = User::where('id', $request->id)->delete();
            if ($delete) {
                return redirect()->route('user.getList')->with('thongbao', 'Xóa thành công !!!');
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getLogin()
    {
        return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $errs = [
            'email.required' => 'Vui lòng k để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'password.required' => 'Vui lòng k để trống',
            'password.min' => 'Vui lòng nhập ít nhất 6 kí tự',
            // 'confirmPassword.required' => 'Vui lòng k để trống',
            // 'confirmPassword.same' => 'mật khẩu nhập lại không khớp',
        ];

        $validateData =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'confirmPassword' => 'required|same:password',
        ], $errs);

        $info = $request->only('email', 'password');
        $info['type'] = 1;

        if (Auth::attempt($info)) {
            return redirect()->route('admin')->with('thongbao', 'Đăng nhập thành công !!!');
        } else {
            return redirect()->route('admin.getLogin')->with('thongbao', 'Đăng nhập thất bại !!!');
        }
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('admin.getLogin')->with('thongbao', 'Đăng xuất thành công !!!');
    }

    public function profile()
    {
        $user = Auth::user();
        // dump($user);
        return view('admin.auth.profile', [
            'infoUser' => $user
        ]);
    }

    public function getChangePass()
    {
        $user = Auth::user();
        // dump($user);
        return view('admin.auth.change-password', [
            'infoUser' => $user
        ]);
    }
}