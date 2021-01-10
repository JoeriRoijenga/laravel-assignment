<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\UserController;


class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $dbUser = User::findOrFail($input['id']);
        
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($dbUser->id),
            ],
        ])->validate();
        // No idea why, but this failed.
        //->validateWithBag('updateProfileInformation');
        
        if ($input['email'] !== $dbUser->email && $dbUser instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($dbUser, $input);
        } else {
            $dbUser->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => $input['role'],
            ])->save();
        }
        
        // Redirect won't work
        // return redirect()->action([UserController::class, 'showAll']);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $dbUser->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'role' => $input['role'],
        ])->save();

        $dbUser->sendEmailVerificationNotification();
    }
}
