<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests;
use App\User;
use App\Models\{Role,Settings};
use App\Http\Start\Helpers;
use Illuminate\Support\Facades\Auth;


class DataTableController extends Controller
{
    public function __construct()
    {

    }

    public function getUsers()
    {
        $users = User::all();

        return Datatables::of($users)

            ->addColumn('actions', function ($users) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . url("admin/user/edit/$users->id") . '"><span  class="fa fa-edit"></span></a> &nbsp;';

                if ($users->id != Auth::id())
                    $deleteBtn = '<a class="btn btn-xs btn-danger deleteRow" id="' . $users->id . '"><span class="fa fa-remove"></span></a>';
                else
                    $deleteBtn = '';

                return $editBtn . $deleteBtn;

            })

            ->addColumn('role', function ($users) {
                return isset($users->role->name) && $users->role->name ? $users->role->name : '';
            })
            ->rawColumns(['actions'])->make(true);
    }

    public function getRole()
    {
        $role = Role::all();

        return Datatables::of($role)

            ->addColumn('actions', function ($role) {
                $editBtn = Helpers::has_permission(Auth::user()->id, 'edit_role') ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . url("admin/role/edit/$role->id") . '"><span  class="fa fa-edit"></span></a> &nbsp;' : '';
                $deleteBtn = Helpers::has_permission(Auth::user()->id, 'delete_role') ? '<a class="btn btn-xs btn-danger deleteRow" id="' . $role->id . '"><span class="fa fa-remove"></span></a>' : '';

                return in_array($role->id,[1]) == false ? $editBtn . $deleteBtn : '';
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getSettings()
    {
        $settings = Settings::all();

        return Datatables::of($settings)

            ->addColumn('actions', function ($settings) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . url("admin/settings/edit/$settings->id") . '"><span  class="fa fa-edit"></span></a> &nbsp;';
                $deleteBtn = '<a class="btn btn-xs btn-danger deleteRow" id="' . $settings->id . '"><span class="fa fa-remove"></span></a>';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['actions'])->make(true);
    }


}
