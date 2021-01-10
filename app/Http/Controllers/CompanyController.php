<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
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
}
