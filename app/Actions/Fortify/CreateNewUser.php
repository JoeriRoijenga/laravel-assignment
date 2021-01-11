<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return 
     */
    public function create(array $input)
    {       
        $company_id = auth()->user()->company_id;

        if (auth()->user()->role == 2) {
            $company_id = $input["company"];
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ]
        ])->validate();
        
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make("best-secret-password-in-the-world!"),
            'role' => 0,
            'job_id' => $input['job'],
            'company_id' => $company_id
        ]);
        
        $user->sendEmailVerificationNotification();
    }
}
