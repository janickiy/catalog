<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use Validator;
use Carbon\Carbon;
use App\Models\Settings;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct(){

    }

    public function list()
    {
        return view('admin.settings.list')->with('title','Настройки')->with('title','Настройки');
    }

    /**
     * @param $type
     * @return $this
     */
    public function createForm($type)
    {
        return view('admin.settings.create_edit', compact('type'))->with(compact('Добавление параметра'));
    }

    public function create()
    {
        return view('admin.settings.select_type')->with('title','Настройки');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key_cd' => 'required|max:255|unique:settings',
            'type' => 'required',
            'display_value' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        } else {
            $setting = new Settings($request->except('_token', 'setting_id', 'value'));

            if ($request->hasFile('value')) {

                $validator = \Validator::make($request->all(), [
                    'value' => 'mimes:jpg,jpeg,png,txt,csv,zip,pdf',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }

                $destinationPath = public_path() . '/uploads/settings';
                $value = $setting->key_cd . '.' . $request->file('value')->getClientOriginalExtension();
                $request->file('value')->move($destinationPath, $value);

                $setting->value = $value;
            } elseif ($setting->type == 'SELECT') {
                $setting->value = json_encode($request->value);
            } else {
                $setting->value = $request->value;
            }

            $setting->save();
        }

        return redirect('admin/settings/list')->with('success', 'Информация успешно добавлена');
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $type = null;
        $setting = Settings::where('id', $id)->first();

        if ($setting) {
            return view('admin.settings.create_edit')->with(compact('type', 'setting'));
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) abort(500);

        $rules = [
            'key_cd' => 'required|max:255|unique:settings,key_cd,' . $request->input('setting_id'),
            'type' => 'required',
            'display_value' => 'required',
            'value' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $setting = Settings::where('id', $id)->first();
            $setting->key_cd = $request->key_cd;
            $setting->type = $request->type;
            $setting->display_value = $request->display_value;

            if ($request->hasFile('value')) {

                $validator = \Validator::make($request->all(), [
                    'value' => 'mimes:jpg,jpeg,png,txt,csv,zip,pdf',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }

                @unlink($setting->value);

                $destinationPath = public_path() . '/uploads/settings';
                $value = $setting->key_cd . '.' . $request->file('value')->getClientOriginalExtension();
                $request->file('value')->move($destinationPath, $value);
                $setting->value = $value;
            } elseif ($setting->type == 'SELECT') {
                $setting->value = json_encode($request->value);
            } else {
                $setting->value = $request->value;
            }

            $setting->save();

            return redirect('admin/settings/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        $setting = Settings::where('id', $id)->first();

        if ($setting->type == 'FILE') {
            $file = public_path() . '/' . $setting->value;
            if (file_exists($file)) @unlink($file);
        }

        Settings::where(['id' => $id])->delete();

    }
}