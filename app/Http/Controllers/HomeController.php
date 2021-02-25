<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'required',
            'comment' => 'required'
        ]);

       auth()->user()->comments()->create($request->all());

        alert()->success('با موفقیت ثبت شد');
        return back();


    }
}
