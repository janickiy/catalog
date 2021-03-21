<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\{Links};
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LinksImport;
use App\Imports\LinksImportFromCsv;
use Validator;
use URL;

class LinksController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $status_list = [];

        foreach (['new' => 0, 'publish' => 1, 'hide' => 2, 'block' => 3] as $key => $value) {
            $status_list[$value] = linkStatus($key);
        }

        return view('admin.links.list', compact('status_list'))->with('title', 'Ссылки');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $options = [];
        $options = ShowTree($options, 0);

        return view('admin.links.create_edit', compact('options'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'url' => 'required|url|unique:links',
            'email' => 'required|email',
            'description' => 'required',
            'full_description' => 'required',
            'catalog_id' => 'required|numeric'
        ];

        $messages = [
            'required' => 'Это поле обязательно для заполнения!',
            'email' => 'Адрес элетронной почты введен не верно!',
            'url' => 'URL адрес введен неверно',
            'url.unique' => 'Сайт с таким URL уже есть в каталоге!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Links::create(array_merge($request->all(), ['token' => md5($request->url . time()), 'status' => 1]));

        return redirect(URL::route('admin.links.list'))->with('success', 'Информация успешно добавлена');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $link = Links::find($id);

        if (!$link) abort(404);

        $options = [];
        $options = ShowTree($options, 0);

        return view('admin.links.create_edit', compact('link', 'options'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'url' => 'required|unique:links,url,' . $request->id,
            'email' => 'required|email',
            'description' => 'required',
            'full_description' => 'required',
            'catalog_id' => 'required|numeric'
        ];

        $messages = [
            'required' => 'Это поле обязательно для заполнения!',
            'email' => 'Адрес элетронной почты введен не верно!',
            'url' => 'URL адрес введен неверно',
            'url.unique' => 'Сайт с таким URL уже есть в каталоге!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $links = Links::find($request->id);

        if (!$links) abort(404);

        $links->name = $request->input('name');;
        $links->url = $request->input('url');
        $links->email = $request->input('email');
        $links->reciprocal_link = $request->input('reciprocal_link');
        $links->description = $request->input('description');
        $links->keywords = $request->input('keywords');
        $links->full_description = $request->input('full_descriptin');
        $links->htmlcode_banner = $request->input('htmlcode_banne');
        $links->catalog_id = $request->input('catalog_id');
        $links->check_link = $request->check_link ? 1 : 0;
        $links->save();

        return redirect(URL::route('admin.links.list'))->with('success', 'Данные обновлены');

    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        Links::find($request->id)->delete();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importForm()
    {
        return view('admin.links.import');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        set_time_limit(0);

        $rules = [
            'file' => 'required',
        ];

        $messages = [
            'required' => 'Это поле обязательно для заполнения!',
            'mimes' => 'Разрешено загружать файлы: csv,xlsx,xls!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $extension = strtolower($request->file('file')->getClientOriginalExtension());

        if ($extension == 'csv' or $extension == 'txt') {
            $path = $request->file('file')->getRealPath();

            $n = LinksImportFromCsv::import($path);

        } else {
            $n = Excel::import(new LinksImport, $request->file('file'));
        }

        return redirect(URL::route('admin.links.import'))->with('success', 'Импорт заврешен. Импортировано ' . $n . ' ссылок');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export()
    {
        return view('admin.links.export');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function statusLinks(Request $request)
    {
        if ($request->has('action')) {

            if ($request->has('activate')) {
                $temp = [];

                foreach ($request->activate as $id) {
                    if (is_numeric($id)) {
                        $temp[] = $id;
                    }
                }

                Links::whereIN('id', $temp)->update(['status' => $request->action]);

                return redirect(URL::route('admin.links.list'))->with('success', 'Данные обновлены');
            }
        }

        abort(500);
    }

}