<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Catalog, Links};
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LinksImport;

class LinksController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.links.list')->with('title', 'Ссылки');
    }

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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            Links::create(array_merge($request->all(), ['token' => md5($request->url . time()), 'status' => 1]));

            return redirect('admin/links/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $link = Links::where('id', $id)->first();

        if ($link) {
            $options = [];
            $options = ShowTree($options, 0);

            return view('admin.links.create_edit', compact('link', 'options'));
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'url' => 'required|url|unique:links,url,' . $request->id,
            'email' => 'required|email',
            'description' => 'required',
            'full_description' => 'required',
            'catalog_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['name'] = $request->name;
            $data['url'] = $request->url;
            $data['email'] = $request->email;
            $data['reciprocal_link'] = $request->reciprocal_link;
            $data['description'] = $request->description;
            $data['keywords'] = $request->keywords;
            $data['full_description'] = $request->full_description;
            $data['htmlcode_banner'] = $request->htmlcode_banner;
            $data['catalog_id'] = $request->catalog_id;
            $data['check_link'] = $request->check_link ? 1 : 0;

            Links::where('id', $request->id)->update($data);

            return redirect('admin/links/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        Links::where(['id' => $id])->delete();
    }

    public function importForm()
    {
        return view('admin.links.import');
    }

    public function import(Request $request)
    {
        $rules = [
            'file' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            if ($request->hasFile('file')) {


                $path = $request->file('file')->getRealPath();

                $array = Excel::toArray(new LinksImport, $request->file('file'));

foreach($array as $w) {
    dd($w);

}
              //  dd($array);




            }
        }
    }

    public function export()
    {

    }

    /**
     * @param $name
     * @param int $parent_id
     * @return mixed
     *
     */
    private function importCategory($name, $parent_id = 0)
    {
        if (!empty($name) && is_numeric($parent_id)) {
            $catalog = Catalog::where('name', 'like', $name)->where('parent_id', $parent_id);

            if ($catalog->count() > 0) {
                return $catalog->id;
            } else {
                if ($name) {
                    Catalog::create(['name' => $name, 'parent_id' => $parent_id]);
                }
            }
        }
    }
}