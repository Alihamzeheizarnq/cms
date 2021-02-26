<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use http\Env\Response;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function getValueAttr(Request $request)
    {
        $nameAttr = Attribute::whereName($request->name)->first();

        if (!$nameAttr) return response()->json(['data' => []]);


        return \response()->json(['data' => $nameAttr->values->pluck('name')]);

    }
}
