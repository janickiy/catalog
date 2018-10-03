<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(Auth $auth){
        $this->auth = $auth;
    }
    
    public function index()
    {
        return view('admin.dashboard');
    }
}
