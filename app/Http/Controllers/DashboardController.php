<?php
/**
* Name:  Dashboard Controller
* Author: w3developer
* Email : w3developer06@gmail.com
* Cell  : +88017 22 11 37 36
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Auth;
use App\User;

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
