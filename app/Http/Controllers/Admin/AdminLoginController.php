<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use Mail;
use Auth;
use URL;

class AdminLoginController extends Controller
{
    protected $data = [];

    /**
     * @return login page view
     */
    public function login()
    {
        $data = [];

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
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            Session::flash('error', 'You are not authenticated user !');
            return redirect(URL::route('admin.dashboard'));
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

        return redirect(URL::route('admin.dashboard'));
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
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);

        $data['email'] = $request->email;
        $data['token'] = base64_encode(encryptIt(rand(1000000, 9999999) . '_' . $request->email));
        $data['created_at'] = date('Y-m-d H:i:s');

        \DB::table('password_resets')->insert($data);

        Mail::send('auth.emails.password', ['data' => $data], function ($message) use ($data) {
            $message->from('us@example.com', 'Stock Manager');
            $message->to($data['email'])->subject('Reset Password!');
        });

        \Session::flash('status', 'Password reset link sent to your email address');

        return back()->withInput();

    }
}
