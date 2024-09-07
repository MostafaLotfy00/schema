<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
      */
      public function index()
      {
          $brands= Brand::paginate(10);
          return view('brands.index',compact('brands'));
      }
  
      /**
       * Show the form for creating a new resource.
       */
      public function create()
      {
          return view('brands.create');
      }
  
      /**
       * Store a newly created resource in storage.
       */
      public function store(Request $request)
      {
          $data= $request->validate([
              'name' => 'required|string|min:3'
          ]);
          Brand::create($data);
          return to_route('brands.index')->with('success', 'تم اضافة علامة تجارية بنجاح');
      }
  
      /**
       * Display the specified resource.
       */
      public function show(Brand $brand)
      {
      }
  
      /**
       * Show the form for editing the specified resource.
       */
      public function edit(Brand $brand)
      {
          return view('brands.edit', ['brand' => $brand]);
  
      }
  
      /**
       * Update the specified resource in storage.
       */
      public function update(Request $request, Brand $brand)
      {
          $data= $request->validate([
              'name' => 'required|string|min:3'
          ]);
          $brand->update($data);
          return to_route('brands.index')->with('success', 'تم تعديل العلامة التجارية بنجاح');
      }
  
      /**
       * Remove the specified resource from storage.
       */
      public function destroy(Brand $brand)
      {
          $brand->delete();
          return to_route('brands.index')->with('success', 'تم حذف العلامة التجارية بنجاح');
      }
  }
  