<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffliateController extends Controller
{
    public function index()
    {
        $class = new \App\Services\GeolocationService( 53.3340285, -6.2535495);
        $affiliates = $class->filterAffiliatesByDistFile(storage_path('app/public/Gambling.com - affiliates.txt'),100);
        return view('welcome',["affiliates"=>$affiliates]);
    }
}
