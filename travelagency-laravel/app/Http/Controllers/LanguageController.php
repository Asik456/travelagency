<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('lang');

        if (in_array($locale, ['en', 'ru', 'kk'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
