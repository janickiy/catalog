<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Links};
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;
use Excel;

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
        $options = ShowTree($options,0);

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

            Links::create(array_merge($request->all(),['token' => md5($request->url . time()), 'status' => 1]));

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
            $options = ShowTree($options,0);

            return view('admin.links.create_edit', compact('link','options'));
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

    public function import()
    {
        global $n;

        Excel::setDelimiter(';');

        if (Input::hasFile('file')) {
            $n = 0;
            $path = Input::file('file')->getRealPath();
            Excel::filter('chunk')->load($path)->chunk(250, function ($data) {
                global $n;

                foreach ($data as $row) {
                    $name = trim($row->nazvanie_organizatsii);

                    $city = trim($row->naselennye_punkty);
                    $address = trim($row->adresa);
                    $zip = trim($row->pochtovye_indeksy);
                    $email = trim($row->{'e_mail'});
                    $phone = trim($row->telefony);
                    $fax = trim($row->faksy);
                    $website = trim($row->sayty);

                    $arr = explode('/', trim($row->razdely));
                    $parent_id = 0;

                    for ($i = 0; $i < count($arr); $i++) {
                        if ($arr[$i]) $parent_id = $this->importCategory(trim($arr[$i]), $parent_id);
                    }

                    $category_id = $this->getIdByName(trim(array_pop($arr)));

                    if ($category_id && !empty($name) && $this->checkExistOrg($name, $category_id) === false) {
                        $fields = [
                            'id'   => 0,
                            'name' => $name,
                            'user_id'     => 0,
                            'category_id' => $category_id,
                            'city'    => $city,
                            'address' => $address,
                            'zip'   => $zip,
                            'email' => $email,
                            'phone' => $phone,
                            'fax'   => $fax,
                            'website' => $website,
                            'hidden'  => 0,
                            'banned'  => 0,
                            'deleted' => 0,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                            'count' => 0,
                        ];

                        if ($this->addOrganization($fields)) $n++;
                    }
                }
            });

            return ['result' => true, 'msg' => "Импортированно " . $n . " организаций"];
        }
    }

    public function export()
    {

    }
}