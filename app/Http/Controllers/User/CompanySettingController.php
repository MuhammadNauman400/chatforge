<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanySettingController extends Controller
{
    public function CompanySetting() {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back('error', 'You are not associated with a company');
        }

        return view('client.website.company_setting', compact('company'));
    }
}
