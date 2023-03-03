<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterUserController extends Controller
{

    /**
     * Display the registration view
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $old = User::where('email' , $validated['email'])->first();

        if($old){
            return redirect('register')->withErrors(['email' => 'Please provide a valid email/password'])->withInput();
        }


        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname']
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.dashboard.index'));
    }

}
