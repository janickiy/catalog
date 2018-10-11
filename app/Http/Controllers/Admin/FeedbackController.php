<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.feedback.list')->with('title', 'Сообщения с сайта');
    }
}