<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Role, Permission, PermissionRole};
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.role.list')->with('title', 'Роли');
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('admin.role.create_edit', compact('permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $insertId = Role::create($request->all())->id;

            if (!$insertId) abort(500);

            if ($request->permission)
                foreach ($request->permission as $key => $value) {
                    PermissionRole::create(['permission_id' => $value, 'role_id' => $insertId]);
                }

            return redirect('admin/role/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        $permissions = Permission::get();
        $storedPermissionsList = PermissionRole::select('permission_id')->where('role_id', $id)->get();
        $stored_permissions = [];

        if (!empty($storedPermissionsList)) {
            foreach ($storedPermissionsList as $key => $value) {
                $stored_permissions[] = $value->permission_id;
            }
        }

        return view('admin.role.create_edit', compact('role','permissions', 'stored_permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:roles,name,' . $request->id,
            'display_name' => 'required',
            'description' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['name'] = $request->name;
            $data['display_name'] = $request->display_name;
            $data['description'] = $request->description;

            Role::where('id', $request->id)->update($data);

            $stored_permissions_lists = PermissionRole::select('permission_id')->where('role_id', $request->id)->get();
            $stored_permissions = [];

            if (!empty($stored_permissions_lists)) {
                foreach ($stored_permissions_lists as $key => $value) {
                    $stored_permissions[$key] = $value->permission_id;
                }
            }

            $permission = isset($request->permission) ? $request->permission : [];

            if (!empty($stored_permissions)) {
                foreach ($stored_permissions as $key => $value) {
                    if (!in_array($value, $permission))
                        PermissionRole::where(['permission_id' => $value, 'role_id' => $request->id])->delete();
                }
            }

            if (!empty($permission)) {
                foreach ($permission as $key => $value) {
                    if (!in_array($value, $stored_permissions)) {
                        PermissionRole::create(['permission_id' => $value, 'role_id' => $request->id]);
                    }
                }
            }

            return redirect('admin/role/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        Role::where(['id' => $id])->delete();
        PermissionRole::where(['role_id' => $id])->delete();
    }
}