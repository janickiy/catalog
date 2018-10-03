<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Catalog,Links};
use App\Http\Start\Helpers;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        $catalogs = Catalog::get();

        $cats = [];

        if ($catalogs) {

            $catalog_arr = $catalogs->toArray();

            foreach ($catalog_arr as $catalog) {
                $cats_ID[$catalog['id']][] = $catalog;
                $cats[$catalog['parent_id']][$catalog['id']] = $catalog;
            }
        }

        return view('admin.catalog.list', compact('cats'))->with('title', 'Категории');
    }

    /**
     * @param int $parent_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($parent_id = 0)
    {
        if (!is_numeric($parent_id)) abort(500);

        return view('admin.catalog.create_edit', compact('parent_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,gif,png|max:2048|nullable',
            'parent_id' => 'numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $pic = $request->file('image');

            if (isset($pic)) {
                $destinationPath = public_path('/uploads/catalog/');
                $filename = time() . '.' . $pic->getClientOriginalExtension();

                $img = Image::make($request->file('image')->getRealPath());

                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);
            }

            Catalog::create(array_merge(array_merge($request->all()), ['image' => isset($filename) ? $filename : null]));

            return redirect('admin/catalog/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $catalog = Catalog::where('id', $id)->first();

        if ($catalog) {
            $parent_id = $catalog->parent_id;
            return view('admin.catalog.create_edit', compact('catalog', 'parent_id'));
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
            'image' => 'image|mimes:jpeg,jpg,gif,png|max:2048|nullable',
            'parent_id' => 'numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['keywords'] = $request->keywords;
            $data['parent_id'] = $request->parent_id;

            $pic = $request->file('image');

            if (isset($pic)) {

                $upload = 'public/uploads/catalog';
                $pic1 = $request->pic;

                if ($pic1 != NULL) {
                    $dir = public_path("uploads/catalog/$pic1");
                    if (file_exists($dir)) {
                        unlink($dir);
                    }
                }

                $destinationPath = public_path('/uploads/catalog/');
                $filename = time() . '.' . $pic->getClientOriginalExtension();

                $img = Image::make($request->file('image')->getRealPath());

                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);

                $data['image'] = $filename;
            }

            Catalog::where('id', $request->id)->update($data);

            return redirect('admin/catalog/list')->with('success', 'Данные обновлены');
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

        $parent = Catalog::findOrFail($id);
        $array_of_ids = $this->getChildren($parent);
        array_push($array_of_ids, $id);

        $pics = $this->getPic($parent);

        Catalog::destroy($array_of_ids);

        if (is_array($pics)) {
            foreach ( $pics as $pic) {
                $image = public_path() . '/catalog/' . $pic;
                if (file_exists($image)) @unlink($image);
            }
        }

        Links::whereIn('parent_id',$array_of_ids);

        return redirect('admin/catalog/list')->with('success', 'Данные удалены');
    }

    /**
     * @param $category
     * @return array
     */
    private function getChildren($category){
        $ids = [];
        foreach ($category->children as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }
        return $ids;
    }

    /**
     * @param $category
     * @return array
     */
    private function getPic($category){
        $pic = [];
        foreach ($category->children as $cat) {
            $cat->image;
            $pic = array_merge($pic, $this->getPic($cat));
        }
        return $pic;
    }

}