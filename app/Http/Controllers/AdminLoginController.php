<?php
/**
* Name:  Login Controller
* Author: w3developer
* Email : w3developer06@gmail.com
* Cell  : +88017 22 11 37 36
*/
namespace App\Http\Controllers;

use Mail;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\User;
use Session;
use Validator;

class AdminLoginController extends Controller
{
    protected $data = [];

    /**
     * @return login page view
     */
    public function login()
    {
        $data=[];
    	return view('admin.login', $data);
    }

    /**
     * Login authenticate operation.
     *
     * @return redirect dashboard page
     */
    public function authenticate(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=>'required'
        ]);


        if ($validator->fails()) {
            return redirect('/admin')
                        ->withErrors($validator)
                        ->withInput();
        }else{

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }else{
        Session::flash('error','You are not authenticated user !');
        return redirect("/admin");
        }
    }

    }

    /**
     * logout operation.
     *
     * @return redirect login page view
     */
    public function logout()
    {
    	Auth::logout();
        \Session::flush();

    	return redirect('/admin');
    }

    /**
     * forget password
     *
     * @return forget password form
     */
    public function reset()
    {
        $data = [];
        return view('auth.passwords.email', $data);
    }

    /**
     * Send reset password link
     *
     * @return Null
     */
    public function sendResetLinkEmail(Request $request)
    {
        //setDbConnect($request->company);
        
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            //'company' => 'required',
        ]);

        $data['email'] = $request->email;
        $data['token'] = base64_encode(encryptIt(rand(1000000,9999999).'_'.$request->email));
        $data['created_at'] = date('Y-m-d H:i:s');
        
        \DB::table('password_resets')->insert($data);

        Mail::send('auth.emails.password', ['data' => $data], function ($message) use ($data) {
            
            $message->from('us@example.com', 'Stock Manager');

            $message->to($data['email'])->subject('Reset Password!');

        });

        \Session::flash('status','Password reset link sent to your email address');
        return back()->withInput();

    }

}
