<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;

use App\Models\Job;
use App\Models\Company;

class RegisterUserController extends RegisteredUserController
{
    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(Request $request, CreatesNewUsers $creator): RegisterResponse
    {
        event(new Registered($user = $creator->create($request->all())));
 
        return app(RegisterResponse::class);
    }

    /**
     * 
     * @return \Illuminate\View\View
     */
    public function show() {
        $jobs = Job::all();
        $companies = Company::all();
        
        return view('auth.register', [
            'jobs' => $jobs,
            'companies' => $companies,
        ]);
    }

}
