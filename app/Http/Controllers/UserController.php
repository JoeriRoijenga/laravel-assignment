<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        if (!auth()->user()->two_factor_secret) {
            $tfAuth = "Disabled";
            $btnAuthClass = "danger";
        }

        if (session('status') == "two-factor-authentication-disabled" || session('status') == "two-factor-authentication-enabled") {
            $tfUpdated = true;
        }

        return view('user.edit', [
            'user' => User::findOrFail($id),
            'tfAuth' => $tfAuth,
            'btnAuthClass' => $btnAuthClass,
            'tfUpdated' => $tfUpdated,
        ]);
    }

    /**
     * Show the Two Factor Authentication QR-code and the recovery codes.
     *
     * @return \Illuminate\View\View
     */
    public function showTwoFactor()
    {
        return view('user.two-factor-auth', [
            
        ]);
    }
}
