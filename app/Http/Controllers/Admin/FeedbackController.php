<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        return view('admin.feedback.list')->with('title', 'Сообщения с сайта');
    }
}