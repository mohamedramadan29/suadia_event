<?php

namespace App\Http\Controllers\dashboard\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function show_login()
    {
        return view("dashboard.auth.login");
    }

    public function register_login(Request $request)
    {
        if ($request->isMethod("POST")) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => ['required', 'captcha']
            ];
            $messages = [
                'email.required' => 'يجب ادخال البريد الالكتروني',
                'email.email' => 'يجب ادخال بريد الكتروني صحيح',
                'password.required' => 'يجب ادخال كلمة المرور',
                'g-recaptcha-response.required' => ' من فضلك اكد انك لست روبوت',
                'g-recaptcha-response.captcha' => 'من فضلك اكد انك لست روبوت غير صحيح'

            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
                // return redirect()->route('dashboard.welcome')->with('success','تم تسجيل الدخول بنجاح ');
                ////// intebded = > بيرجعك علي اخر حاجة كنت شغال عليها بعد التسجيل مرة اخري
                return redirect()->intended(route('dashboard.welcome'));
            }
            // return redirect()->route('dashboard.login.show')->withErrors([]'error','لا يوجد حساب بهذة البيانات ');
            return redirect()->back()->withErrors(['email' => 'لا يوجد حساب بهذة البيانات ']);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('dashboard.login.show');
    }
}
