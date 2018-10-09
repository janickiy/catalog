<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Start\Helpers;
use App\Models\{Catalog,Links};
use Validator;
use URL;

class FrontendController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = 0)
    {

        $catalogs = Catalog::selectRaw('catalog.name,catalog.id,catalog.image,COUNT(links.status) AS number_links')
            ->leftJoin('links','links.catalog_id','=','catalog.id')
            ->where('catalog.parent_id', $id)
            ->groupBy('catalog.id')
            ->groupBy('catalog.name')
            ->groupBy('catalog.catalog.image')
            ->orderBy('catalog.name')
            ->get();

        $arraycat = [];

        foreach ($catalogs as $catalog) {
            $arraycat[] = array($catalog->name, $catalog->id, $catalog->image, $catalog->number_links);
        }

        $total = count($arraycat);
        $number = (int)($total / getSetting('COLUMNS_NUMBER'));

        if ((float)($total / getSetting('COLUMNS_NUMBER')) - $number != 0) $number++;

        $arr = [];

        // Form an array
        for ($i = 0; $i < $number; $i++) {
            for ($j = 0; $j < getSetting('COLUMNS_NUMBER'); $j++) {
                if (isset($arraycat[$j * $number + $i])) $arr[$i][$j] = $arraycat[$j * $number + $i];
            }
        }

        if ($id) {
            $links = Links::where('catalog_id',$id)->paginate(10);
        } else {
            $links = Links::orderBy('id', 'DESC')->take(5)->get();
        }

        if ($id > 0) {
            $topbar = [];
            $arraypathway = topbarMenu($topbar, $id);
            $pathway = '<a href="' . URL::route('index') . '">Главная</a> ';

            for ($i = 0; $i < count($arraypathway); $i++) {
                if ($arraypathway[$i][0] == $id) {
                    $pathway .= '» ' . $arraypathway[$i][1];
                } else {
                    $pathway .= '» <a href="' . URL::route('index', ['id' => $arraypathway[$i][0]]) . '">' . $arraypathway[$i][1] . '</a>';
                }
            }
        }

        return view('frontend.index', compact('arr','number', 'links', 'id', 'pathway'))->with('title','Каталог сайтов');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id)
    {
        if (!is_numeric($id)) abort(500);

        $link = Links::where('id',$id)->first();

        if ($link) {
            return view('frontend.info', compact('link'))->with('title',$link->name);
        }

        abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addurl()
    {
        $options = [];
        $options = ShowTree($options, 0);

        return view('frontend.addurl', compact('options'))->with('title','Добавить сайт');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $rules = [
            'name' => 'required',
            'url' => 'required|url|unique:links',
            'email' => 'required|email',
            'description' => 'required|min:100|max:300',
            'full_description' => 'required|min:200|max:2000',
            'catalog_id' => 'required|numeric',
            'captcha' => 'required|captcha',
            'agree' => 'required'
        ];

        $message = [
            'name.required' => 'Не указано название!',
            'url.required' => 'Не указан URL адрес сайта!',
            'url.url' => 'Не верно указан URL адрес сайта!',
            'url.unique' => 'Этот сайт уже есть в каталоге!',
            'email.required' => 'Не указан Email!',
            'email.email' => 'Не верно указан Email!',
            'description.required' => 'Не указано описание!',
            'description.min' => 'Количество символов в описание не должно быть меньше :min',
            'description.max' => 'Количество символов в описание не должно быть больше :max',
            'full_description.required' => 'Не указано полное описание!',
            'full_description.min' => 'Количество символов в полном описание не должно быть меньше :min',
            'full_description.max' => 'Количество символов в полном описание не должно быть больше :max',
            'catalog_id.required' => 'Выберите раздел!',
            'captcha.required' => 'Не указан защитный код!',
            'agree.required' => 'Вы должны принять правила каталога',

        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            Links::create(array_merge($request->all(), ['token' => md5($request->url . time()), 'status' => 1]));

            return redirect('/addurl')->with('success', 'Сайт добавлен в каталог');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($id)
    {
        if (!is_numeric($id)) abort(500);

        $link = Links::where('id',$id)->first();

        if ($link) {

            Links::where('id',$id)->update(['views' => $link->views + 1]);

            return redirect($link->url);
        }

        abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rules()
    {
        return view('frontend.rules')->with('title','Правила каталога сайтов');
    }
}
