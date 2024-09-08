<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $products= Product::filter($req->query())->latest()->paginate(10);
        $units= Unit::all();
        $categories= Category::all();
        $brands= Brand::all();
        $businesses= Business::all();
        return view('products.index', compact('products', 'units', 'categories', 'brands', 'businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units= Unit::all();
        $categories= Category::all();
        $brands= Brand::all();
        $businesses= Business::all();
        return view('products.create',compact('units', 'categories', 'brands', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $data['image']= $this->uploadImage($request);
        if($data['base_quantity'] == null)
        $data['base_quantity']= 0;
        if($data['sub_quantity'] == null)
        $data['sub_quantity']= 0;
        Product::create($data);
        return to_route('products.index')->with('success', 'تم اضافة منتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $units= Unit::all();
        $categories= Category::all();
        $brands= Brand::all();
        $businesses= Business::all();
        return view('products.edit',[
        'product' => $product,
        'units'   => $units,
        'categories'=> $categories,
        'brands' => $brands,
        'businesses' => $businesses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data= $request->all();
        $old_image= $product->image;
        $data['image'] = $this->uploadImage($request);
            
        if($data['image'] == null){
            unset($data['image']);
        }
        if($data['base_quantity'] == null)
        $data['base_quantity']= 0;
        if($data['sub_quantity'] == null)
        $data['sub_quantity']= 0;

        $product->update($data);

    if ($old_image && isset($data['image'])) {
        Storage::disk('uploads')->delete($old_image);
    }
        return to_route('products.index')->with('success', 'تم تعديل منتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index')->with('success', 'تم حذف منتج بنجاح');
    }

    protected function uploadImage($request)
    {

        if (!$request->hasFile('image')) {
            return;
        }
        $image = $request->file('image');
        $path = $image->store('products', 'uploads');
        return $path;
    }
}
