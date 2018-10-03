<?php

namespace App\Http\Controllers;

use Validator;
use Image;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\User;
use App\Models\{Role, RoleUser};

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('admin.user.list')->with('title', 'Пользователи');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return User cerate page view
     */
    public function create()
    {
        $roles = Role::get();

        $role_options = [];

        foreach ($roles as $role) {
            $role_options[$role->id] = $role->name;
        }

        return view('admin.user.create_edit', compact('role_options'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return User List page view
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:3|required',
            'password_confirmation' => 'min:3|same:password',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/user/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $pic = $request->file('avatar');

            if (isset($pic)) {
                $destinationPath = public_path('/uploads/users/');
                $filename = time() . '.' . $pic->getClientOriginalExtension();

                $img = Image::make($request->file('avatar')->getRealPath());

                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);
            }

            $result = User::create(array_merge($request->all(), ['password' => Hash::make($request->password), 'avatar' => isset($filename) ? $filename : null]));

            if ($result) {
                RoleUser::create(['user_id' => $result->id, 'role_id' => $request->role_id]);

                return redirect("admin/user/list")->with('success', 'Пользователь добавлен');
            } else
                abort(500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (!is_numeric($id)) abort($id);

        $roles = Role::get();
        $userData = User::where('id', '=', $id)->first();

        $role_options = [];

        foreach ($roles as $role) {
            $role_options[$role->id] = $role->name;
        }

        return view('admin.user.create_edit', compact('roles', 'userData', 'role_options'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        // dd($id);exit;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'role_id' => 'required',
            'password' => 'min:6|nullable',
            'password_confirmation' => 'min:6|same:password|nullable',
        ]);

        if ($validator->fails()) {
            return redirect('admin/user/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $data['name'] = $request->name;
            $data['role_id'] = $request->role_id;

            if (!empty($request->password) && !empty($request->confirm_password)) {
                $data['password'] = Hash::make($request->password);
            }

            $pic = $request->file('avatar');

            if (isset($pic)) {

                $upload = 'public/uploads/users';
                $pic1 = $request->pic;

                if ($pic1 != NULL) {
                    $dir = public_path("uploads/users/$pic1");
                    if (file_exists($dir)) {
                        unlink($dir);
                    }
                }

                $destinationPath = public_path('/uploads/users/');
                $filename = time() . '.' . $pic->getClientOriginalExtension();

                $img = Image::make($request->file('avatar')->getRealPath());

                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);

                $data['avatar'] = $filename;
            }

            User::where('id', $id)->update($data);
            RoleUser::where('user_id', $id)->update(['role_id' => $request->role_id]);

            return redirect("admin/user/list")->with('success', 'Данные пользователя обнавлены');
        }
    }


    public function currentUser()
    {
        $id = Auth::user()->id;
        $data['menu'] = 'people';
        $data['sub_menu'] = 'user';
        $data['header'] = 'user';
        $data['userData'] = DB::table('users')->where('id', '=', $id)->first();
        return view('admin.user.edit_current_user', $data);
    }

    public function updateProfile()
    {
        $id = Auth::user()->id;
        $validator = Validator::make($this->request->all(), [
            'name' => 'required|min:3'
        ]);


        if ($validator->fails()) {
            return redirect('/edit/current-user')
                ->withErrors($validator)
                ->withInput();
        } else {

            $data['name'] = $this->request->name;
            $data['updated_at'] = date('Y-m-d H:i:s');

            if (!empty($this->request->password) && !empty($this->request->confirm_password)) {
                $data['password'] = Hash::make($this->request->password);
                if ($this->request->password != $this->request->confirm_password) {
                    return back()->withInput()->withErrors(['confirm_password' => "Password not matching !"]);
                }
            }

            $pic = $this->request->file('picture');

            if (isset($pic)) {
                $upload = 'public/uploads/userPic';

                $pic1 = $this->request->pic;
                if ($pic1 != NULL) {
                    $dir = public_path("uploads/userPic/$pic1");
                    if (file_exists($dir)) {
                        unlink($dir);
                    }
                }

                $filename = $pic->getClientOriginalName();
                $pic = $pic->move($upload, $filename);
                $data['picture'] = $filename;
            }

            DB::table('users')->where('id', $id)->update($data);

            Session::flash('message', 'Profile updated successfully !');
            return redirect()->intended("/edit/current-user");
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     * @return User List page view
     */

    public function destroy(Request $request)
    {
        $id = $request->id;
        User::where('id', '=', $id)->delete();
    }

}
