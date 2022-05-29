<?php

namespace Illuminate\Foundation\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $credantial = $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'phone'=>'required|max:13|unique:users'
        ]);



           $user= User::create([
                'name'=>$request['name'],
                'username'=>$request['username'],
                'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'phone'=>$request['phone']
            ]);

            if($user){

                if (Auth::attempt(['username'=>$request['username'],'password'=>$request['password']])) {

                    $request->session()->regenerate();
                    User::where('id',auth()->user()->id)->update(['online'=>1]);

                    return redirect(route('customer_dashboard'));


                }else{
                    return redirect()->route('login');
                }
            }


    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
