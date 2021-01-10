<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Input;

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
        $company = Company::findOrFail($request->id);
        
        $company->fill([
            'company_name' => $request->company_name,
            'path_to_logo' => $request->logo,
            'city' => $request->city,
            'zip' => $request->zip,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
        ]);
    
        $company->save();

        return $this->showAll(false, true);
    }
}
