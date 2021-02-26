<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query();

        if ($search = request('search')) {
            $products->where('title', 'LIKE', "%{$search}%")
                ->orWhere('id', $search)
                ->orWhere(function ($query) {
                    $user = User::where('name', \request('search'))->get();
                    if ($user->count()) {
                        return $query->where('user_id', $user->pluck('id'));
                    }
                });
        }
        $products = $products->latest()->simplePaginate(10);
        return view('admin.products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'inventory' => 'required|int',
            'price' => 'required|int',
            'category' => 'required',
            'attributes' => 'array'

        ]);

        $product = $request->user()->products()->create($request->all());
        $product->category()->sync($request->input('category'));


        $this->setAttributeProduct($request, $product);
        alert()->success('محصول با موفقیت ایجاد شد');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (!session()->has('sr')) {
            session()->flash('sr', session('_previous.url'));
        } else {
            session()->reflash();
        }
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $Data = \Illuminate\Support\Facades\Validator::make($request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'inventory' => 'required|int',
                'price' => 'required|int',
                'category' => 'required',
                'attributes' => 'array'


            ]
        );
        if ($Data->fails()) {
            session()->flash('sr', session('sr'));
            return back()->withErrors($Data);
        }
        $product->update($request->all());
        $product->category()->sync($request->input('category'));

        $product->attributes()->detach();

        $this->setAttributeProduct($request, $product);

        alert()->success('با موفقیت ویرایش شد');
        return redirect(session('sr'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        alert()->warning('محصول حذف گردید');
        return back();
    }

    /**
     * @param Request $request
     * @param $product
     */
    public function setAttributeProduct(Request $request, $product)
    {
        $attributes = collect($request->input('attributes'));
        $attributes->each(function ($item) use ($product) {

            if (is_null($item['name']) || is_null($item['value'])) return;
            $attr = Attribute::firstOrCreate([
                'name' => $item['name']
            ]);
            $val = $attr->values()->firstOrCreate(
                ['name' => $item['value']]
            );

            $product->attributes()->attach($attr->id, ['value_id' => $val->id]);

        });
    }
}
