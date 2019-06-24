<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function field(Request $request) {
    //     $email = $this->username();
    //     Log::debug('testinggggg');
    //     $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    //     $out->writeln(filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username');
    //     return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    // }

    // /**
    //  * Validate the user login request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return void
    //  *
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // protected function validateLogin(Request $request)
    // {
    //     $field = $this->field($request);

    //     $message = [
    //         "{$this->username()}.exists" => 
    //             'The account are trying  to login!'
    //     ];
    //     $request->validate([
    //         // $this->username() => "required|string",
    //         $field => "required|string|exists:users,{$field}",
    //         'password' => 'required|string',
    //     ], $message);
    // }

    // /**
    //  * Get the needed authorization credentials from the request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // protected function credentials(Request $request)
    // {
    //     $field = $this->field($request);

    //     // return []
    //     // return $request->only($this->username(), 'password');
    //     // return $request->only($field, 'password');
    //     return [
    //         $field => $request->get($this->username()),
    //         'password' => $request->get('password'),
    //     ];
    // }
}
