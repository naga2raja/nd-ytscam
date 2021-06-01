<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request) {
        return 'OK';
        dd($request->all());
    }
}
