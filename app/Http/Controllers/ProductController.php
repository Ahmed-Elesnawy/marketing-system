<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\Category;
use App\Services\ProductService;
use App\DataTables\ProductsDataTable;
use App\Http\Requests\Dashboard\ProductRequest;

class ProductController extends Controller
{


    protected $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $datatable)
    {

        if ( user()->is_markter )
        {
            return view('dashboard.markters.products',[

                'title'    => trans('software.products'),

                'products' => $this->productService->paginatedProducts(), 
                
            ]);
        }

        return $datatable->render('dashboard.products.index', [
            
            'title' => trans('software.products'),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'title'          => trans('software.add_product'),
            'cat_choices'    => Category::latest()->pluck('name_ar','id'),
            'colors_choices' => Color::latest()->pluck('name','id'), 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        
        
        $data = $request->validated();

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','products',350,350);
        }

        $product = Product::create($data);

        if ( $request->has('colors') )
        {
            $product->colors()->attach($request->colors);
        }

        toast()->success(trans('software.success_added'));

        return redirect()->route('dashboard.products.index');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [

            'title'          => "تعديل منتج($product->name)",
            'cat_choices'    => Category::latest()->pluck('name_ar','id'),
            'colors_choices' => Color::latest()->pluck('name','id'), 
            'product'        => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        
        $this->productService->update($product,$request);   

        if ( $request->has('colors') )
        {
            $product->colors()->sync($request->colors);
        }

        if (!$request->has('colors')) 
        {
            $product->colors()->detach();
        }


        toast()->success(trans('software.success_updated'));



        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->destroy($product);

        toast()->success(trans('software.success_deleted'));
        
        return redirect()->route('dashboard.products.index');
    }
}
