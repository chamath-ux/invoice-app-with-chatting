<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {



        return view('customer.customer_dashboard');

    }

    public function change_email()
    {
        return view('customer.change_email');
    }

    public function create(Request $request)
    {

      $email= User::where('id',auth()->user()->id)->update([
           'email'=>$request['change_email'],
           'email_verified_at'=>NUll
       ]);

       if($email){
           return redirect(route('customer_dashboard'));
       }


    }
}
