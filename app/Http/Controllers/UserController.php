<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    /**
     * Edit the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tfAuth = "Enabled";
        $btnAuthClass = "success";
        $tfUpdated = false;
        $userItself = false;

        $jobs = Job::all();
        $companies = Company::all();

        if (!auth()->user()->two_factor_secret) {
            $tfAuth = "Disabled";
            $btnAuthClass = "danger";
        }

        if (session('status') == "two-factor-authentication-disabled" || session('status') == "two-factor-authentication-enabled") {
            $tfUpdated = true;
        }

        if (auth()->user()->id == $id) {
            $userItself = true;
        }

        return view('user.edit', [
            'user' => User::findOrFail($id),
            'tfAuth' => $tfAuth,
            'btnAuthClass' => $btnAuthClass,
            'tfUpdated' => $tfUpdated,
            'userItself' => $userItself,
            'jobs' => $jobs,
            'companies' => $companies,
        ]);
    }

    /**
     * Show the Two Factor Authentication QR-code and the recovery codes.
     *
     * @return \Illuminate\View\View
     */
    public function showTwoFactor()
    {
        return view('user.two-factor-auth');
    }

    /**
     * Show all users.
     *
     * @return \Illuminate\View\View
     */
    public function showAll($deleted = false)
    {
        $user = DB::table('users')
            ->join('jobs', 'users.job_id', '=', 'jobs.job_id')
            ->join('companies', 'users.company_id', '=', 'companies.company_id');
            
        if (auth()->user()->role != 2) {
            $user->where('users.company_id', auth()->user()->company_id);
        }

        $logo = DB::table('companies')->where('company_id', auth()->user()->company_id)->first();

        return view('overview-users', [
            'users' => $user->get(),
            'deleted' => $deleted,
            'logo' => $logo,
        ]);
    }


    /**
     * Delete the given user, if exists
     *
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        if (User::where('id', $id)->delete()) {
            return $this->showAll(true);
        }

        return $this->showAll();
    }

    /**
     * Verify new User, show view
     *
     * @return \Illuminate\View\View
     */
    public function verifyView($id, $hash)
    {
        return view('auth.verify-by-email', [
            'id' => $id,
        ]);
    }

    /**
     * Verify new User and save passwords
     *
     * @return \Illuminate\View\View
     */
    public function verify(Request $request)
    {
        // Not the best way, yet couldn't fix it in time
        if (isset($request->password) && $request->password !== $request->password_confirmation) {
            Validator::make($request->all(), [
                'password' => ['required', 'string'],
                'password_confirmation' => ['required', 'string', new Password, 'confirmed'],
            ])->after(function ($validator) use ($request) {
                $validator->errors()->add('password', __('The provided password does not match your current password.'));
            })->validate();
        }
        
        $user = User::findOrFail($request->id);
        $user->forceFill([
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($request->password),
        ])->save();
        
        return view('home');
    }
}
