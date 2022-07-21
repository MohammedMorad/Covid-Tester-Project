<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class Covid19RegisterController extends Controller
{
    public function Register(Request $request)
    {
        /*   $data = User::create([
              'name' => $request->name,
              'email Address' => $request->email_Address,
              'Phone Number' => $request->Phone_Number,
              'password' =>Hash::make($request->password),
              'confirm password' =>Hash::make($request->confirm_password),
              'api_token' => Str::random(60),
          ]);
          return $data; */
        $rules =[
            'name' => 'required|max:191|string',
            'emailAddress' => 'required|max:191|unique:users|string',
            'PhoneNumber' =>'required|max:11|string',
            'password' => 'required|min:8|string',
            'confirmPassword' => 'required|min:8|string|same:password'
        ];
        $messages =[
            'name.required' => 'الإسم مطلوب',
            'name.max' => 'الإسم مطلوب',
            'emailAddress.unique' => 'الإيميل موجود بالفعل الرجاء تغييره',
            'emailAddress.required' =>'يجب ادخال الايميل',
            'PhoneNumber.max'=> 'رقم الهاتف لا يقل عن 11 رقم ',
            'password.required'=>'الباسورد مطلوب',
            'password' => 'password:api',
            'confirmPassword.required'=>'الباسورد مطلوب',
            'confirmPassword.same' =>'تاكيد الباسورد غلط',
            'confirmPassword.min' => 'الباسورد يجب اكتر من 8 ارقام'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $data = User::create([
                'name' => $request->name,
                'emailAddress' => $request->emailAddress,
                'PhoneNumber' => $request->PhoneNumber,
                'password' =>Hash::make($request->password),
                'confirmPassword' =>Hash::make($request->confirmPassword),
                'api_token' => Str::random(60),
            ]);
            return $data;
        }
    }
}
