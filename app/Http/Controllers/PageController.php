<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompanySetting;
use App\Models\Feedback;

class PageController extends Controller
{
    public function contact()
    {
        // Use first() since there's typically one record, or create a default if missing
        $companySettings = CompanySetting::first(); 
        
        return view('pages.contact', compact('companySettings'));
    }


}
