<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Edit the profile for a given user.
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
    public function showAll($deleted = false)
    {
        return view('overview-companies', [
            'companies' => Company::all(),
            'deleted' => $deleted,
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
}
