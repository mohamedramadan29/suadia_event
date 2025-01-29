<?php

namespace App\Http\Controllers\dashboard\auth;

use Illuminate\Http\Request;
use App\Models\dashboard\Admin;
use App\Http\Traits\Message_Trait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    use Message_Trait;
    public function showemailform()
    {
        return view("dashboard.auth.password.email");
    }


    public function forget_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $email = $data['email'];
            $user = Admin::where('email', $email)->count();
            if ($user > 0) {
                ////////////////////// Send Forget Mail To User  ///////////////////////////////
                ///
                DB::beginTransaction();
                $email = $data['email'];
                $MessageDate = [
                    'code' => base64_encode($email)
                ];
                Mail::send('dashboard.mails.UserChangePasswordMail', $MessageDate, function ($message) use ($email) {
                    $message->to($email)->subject(' رابط تغير كلمة المرور ');
                });
                DB::commit();
                return $this->success_message(' تم ارسال رابط تغير كلمة المرور علي البريد الالكتروني  ');
            } else {
                return Redirect::back()->withErrors(['للاسف لا يوجد حساب بهذة البيانات ']);
                // return $this->Error_message(' للاسف لا يوجد حساب بهذة البيانات  ');
            }
        }
        return view('dashboard.auth.password.email');
    }

    public function change_forget_password(Request $request, $email)
    {
        $email = base64_decode($email);
        return view('dashboard.auth.password.reset', compact('email'));
    }

    public function update_forget_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $email = $data['email'];
            //dd($data);
            $usercount = Admin::where('email', $email)->count();
            if ($usercount > 0) {
                ////////// Start Change Password
                $user = Admin::where('email', $email)->first();
                $rules = [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                    'g-recaptcha-response' => ['required', 'captcha']
                ];
                $messages = [
                    'password.required' => ' من فضلك ادخل كلمة المرور  ',
                    'confirm_password.required' => ' من فضلك اكد كلمة المرور ',
                    'confirm_password.same' => ' من فضلك يجب تاكيد كلمة المرور بنجاح ',
                    'g-recaptcha-response.required' => ' من فضلك حدد انك لست روبوت  ',
                ];
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $user->update([
                    'password' => Hash::make($data['password']),
                ]);
                return redirect()->to('dashboard/login')->with('Success_message', '   تم تعديل كلمة المرور بنجاح سجل ذخولك الان ');
            } else {
                return Redirect::back()->withErrors(['للاسف لا يوجد حساب بهذة البيانات ']);
            }
        }
    }


}
