<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
use App\Providers\RouteServiceProvider;

class CompanyController extends Controller
{
    /**
     * Edit the given company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('company.edit', [
            'company' => Company::where('company_id', $id)->first(),
        ]);
    }

    /**
     * Show all companies.
     *
     * @return \Illuminate\View\View
     */
    public function showAll($deleted = false, $updated = false)
    {
        return view('overview-companies', [
            'companies' => Company::all(),
            'deleted' => $deleted,
            'updated' => $updated,
        ]);
    }

    /**
     * Delete the given compay, if exists
     *
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        User::where('company_id', $id)->delete();
        $company = Company::where('company_id', $id)->first();
        $explPath = explode('/', $company->path_to_logo);
        Storage::deleteDirectory('public/' . $explPath[0] . '/' . $explPath[1]);
        
        if ($company->delete()) {
            return $this->showAll(true);
        }

        

        return $this->showAll();
    }

    /**
     * Save the given company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function update(Request $request) {
        $request->validate([
            'logo' => 'dimensions:max_width=250,max_height=250',
        ]);
        
        $path = "";
        $company = Company::findOrFail($request->id);
        $fileName = $company->path_to_logo;

        if ($request->logo != null) {
            $fileName = $request->logo->getClientOriginalName();
        }

        if ($company->company_name !== $request->company_name && $company->path_to_logo != 'images/logo.png') {
            $explPath = explode('/', $company->path_to_logo);
            $path = 'images/' . $request->company_name . "/" . $explPath[2];
            Storage::move('public/' . $company->path_to_logo, 'public/' . $path);
            Storage::deleteDirectory('public/' . $explPath[0] . '/' . $explPath[1]);
        }

        if ($request->logo != null) {
            $request->logo->storeAs("public/images/" . $request->company_name, $fileName);
            $path = "images/" . $request->company_name . "/" . $fileName;
        } elseif ($path == "") {
            $path = $company->path_to_logo;
        }

        $company->fill([
            'company_name' => $request->company_name,
            'path_to_logo' => $path,
            'city' => $request->city,
            'zip' => $request->zip,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
        ]);
    
        $company->save();
        
        if (auth()->user()->role !== 2) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $this->showAll(false, true);
    }

    /**
     * Add new company.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function add(Request $request) {
        $company = Company::create([
            'company_name' => $request->company_name,
            'path_to_logo' => 'images/logo.png',
            'city' => "city",
            'zip' => 'xxxxx',
            'street' => 'street',
            'housenumber' => 1,
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make("best-secret-password-in-the-world!"),
            'role' => 1,
            'job_id' => 1,
            'company_id' => $company->company_id
        ]);
        
        $user->sendEmailVerificationNotification();
        
        return $this->showAll(false, true);
    }
}
