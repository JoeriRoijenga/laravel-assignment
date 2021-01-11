<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            'updated' => $updated
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

        if (Company::where('company_id', $id)->delete()) {
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

        if ($company->company_name !== $request->company_name) {
            $explPath = explode('/', $company->path_to_logo);
            $path = 'images/' . $request->company_name . "/" . $explPath[2];
            Storage::move($company->path_to_logo, $path);
            $test = '/' . $explPath[0] . '/' . $explPath[1];
            Storage::deleteDirectory($test);
        }

        if ($request->logo != null) {
            $path = $request->logo->storeAs("images/" . $request->company_name, $fileName);
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
            'path_to_logo' => 'logo.png',
            'city' => 1,
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
