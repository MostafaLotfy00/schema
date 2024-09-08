@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style2">
							<li class="breadcrumb-item">
								<a href="{{ route('products.index') }}">المنتجات</a>
							</li>
							<li class="breadcrumb-item active">قائمة المنتجات</li>
						</ol>
					</nav>
					<div class="d-flex my-xl-auto right-content">
	
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<a class="btn ripple btn-primary" data-target="#modaldemo1" data-toggle="modal" href="">اضافة منتج</a>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="table-responsive">
						@if (session('success'))
						<div class="alert alert-solid-success" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							<strong>{{ session('success') }}</strong>
						</div>
						@endif
						<table class="table mg-b-0 text-md-nowrap">
							<thead>
								<form action="{{ route('products.index') }}" method="GET">
									@csrf
								<div class="d-flex  flex-row bg-gray-100  mg-b-20 ">
									<div class="input-group mb-2">
										<h4 class="content-title mb-0 mg-l-8 mg-r-8 my-auto">الاسم</h4>
										<input type="text" name="name" class="form-control mg-l-8 mg-t-8" value="{{ old('name') }}" placeholder="Searching.....">
									</div>
									<div class="input-group mb-2">
										<h4 class="content-title mb-0 mg-l-8 my-auto">الصنف</h4>
										<select class="form-control select2 mg-l-8 mg-t-8" name="category_id">
											<option label="اختر الصنف">
											</option>
											@foreach ($categories as $category)														
											<option value="{{ $category->id }}">
												{{ $category->name }}
											</option>
											@endforeach
										</select>
									</div>
									<div class="input-group mb-2">
										<h4 class="content-title mb-0 mg-l-10 my-auto">الوحدة</h4>
										<select class="form-control select2 mg-l-8 mg-t-8" name="unit_id">
											<option label="اختر الوحدة">
											</option>
											@foreach ($units as $unit)														
											<option value="{{ $unit->id }}">
												{{ $unit->name }}
											</option>
											@endforeach
										</select>
									</div>
									<div class="input-group mb-2">
										<h4 class="content-title mb-0 mg-l-10 my-auto">العلامة التجارية</h4>
										<select class="form-control select2 mg-l-8 mg-t-8" name="brand_id">
											<option label="اختر العلامة">
											</option>
											@foreach ($brands as $brand)														
											<option value="{{ $brand->id }}">
												{{ $brand->name }}
											</option>
											@endforeach
										</select>
									</div>
									<div class="input-group mb-2">
										<h4 class="content-title mb-0 mg-l-10 my-auto">الفرع</h4>
										<select class="form-control select2 mg-l-8 mg-t-8" name="business_id">
											<option label="اختر الفرع">
											</option>
											@foreach ($businesses as $business)														
											<option value="{{ $business->id }}">
												{{ $business->name }}
											</option>
											@endforeach
										</select>
									</div>
									<div class="input-group mb-2">
										<span class="input-group-append mg-t-8">
											<button class="btn btn-dark-gradient btn-block" type="submit">Filter</button>
										</span>
									</div>
								</div>
							</form>

								<tr>
									<th>ID</th>
									<th>الصورة</th>
									<th>الاسم</th>
									<th>الصنف</th>
									<th>العلامة التجارية</th>
									<th>الوحدة الاساسية</th>
									<th>الوحدة الفرعية</th>
									<th>سعر الشراء</th>
									<th>سعر الوحدة الاساسية</th>
									<th>سعر الوحدة الفرعية</th>
									<th>المخزون الوحدة الاساسية</th>
									<th>المخزون الوحدة الفرعية</th>
									<th>الفرع</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if (count($products) == 0)
								<div class="alert alert-solid-warning" role="alert">
									<button aria-label="Close" class="close" data-dismiss="alert" type="button">
									<span aria-hidden="true">&times;</span></button>
									<strong>  لا يوجد منتجات! </strong>
								</div>
								@else
								@php
									$i=0;
								@endphp
								@foreach ($products as $product)	
								@php
									$i++;
								@endphp								
								<tr>
									<th scope="row">{{ $i }}</th>
									<td><img src="{{ $product->image_url }}" height="50" alt=""></td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->category->name }}</td>
									<td>{{ $product->brand->name }}</td>
									<td>{{ $product->unit->name }}</td>
									<td>{{ $product->subUnit->name }}</td>
									<td>£ {{ $product->purchase_price }}</td>
									<td>£ {{ $product->sell_base_price }}</td>
									<td>£ {{ $product->sell_sub_price }}</td>
									<td>{{ $product->base_quantity }}</td>
									<td>{{ $product->sub_quantity }}</td>
									<td>{{ $product->business->name }}</td>
									<<td>
										<div class="d-flex">
											<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm text-white  mg-l-10">Edit</a>
											<form action="{{ route('products.destroy', $product->id) }}" method="post" class="mb-0">
												@csrf
												@method('DELETE')
												<button class="btn btn-danger btn-sm">Delete</button>
											</form>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
						{{ $products->withQueryString()->links() }}
					</div>

					<div class="modal" id="modaldemo1">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" >
										@csrf
										<div class="">
											<div class="form-group">
												<h6>اسم المنتج</h6>
												<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="ادخل الاسم">
											</div>
											<div class="form-group">
												<h6>كود المنتج</h6>
												<input type="text" class="form-control" id="exampleInputEmail1" name="code" placeholder="ادخل الكود">
											</div>
											<div class="form-group">
												<h6>الصنف</h6>
													<select class="form-control select2" name="category_id">
														<option label="اختر الصنف">
														</option>
														@foreach ($categories as $category)														
														<option value="{{ $category->id }}">
															{{ $category->name }}
														</option>
														@endforeach
													</select>
																						</div>
											<div class="form-group">
												<h6>العلامة التجارية</h6>
												<select class="form-control select2" name="brand_id">
													<option label="اختر العلامة التجارية">
													</option>
													@foreach ($brands as $brand)												
													<option value="{{ $brand->id }}">
														{{ $brand->name }}
													</option>											
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<h6>الفرع</h6>
												<select class="form-control select2" name="business_id">
													<option label="اختر الفرع ">
													</option>
													@foreach ($businesses as $business)												
													<option value="{{ $business->id }}">
														{{ $business->name }}
													</option>											
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">سعر الشراء</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="purchase_price" placeholder="ادخل السعر">
											</div>
	
											<div class="form-group">
												<label for="exampleInputEmail1"> الوحدة الاساسية</label>
												<select class="form-control select2" name="unit_id" id="primary_unit">
													<option label="اختر الوحدة">
													</option>
													@foreach ($units as $unit)												
													<option value="{{ $unit->id }}">
														{{ $unit->name }}
													</option>												
													@endforeach
												</select>
											</div>
										
											<div class="form-group">
												<label for="exampleInputPassword1">سعر البيع للوحدة الاساسية</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="sell_base_price" placeholder="ادخل السعر">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1"> مخزون الوحدة الاساسية</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="base_quantity" placeholder="ادخل المخزون">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1"> الوحدة الفرعية</label>
												<select class="form-control select2" name="sub_unit_id" id="secondary_unit">
													<option label="اختر الوحدة">
													</option>
													{{-- @foreach ($units as $unit)												
													<option value="{{ $unit->id }}">
														{{ $unit->name }}
													</option>												
													@endforeach --}}
												</select>
											</div>
										
											<div class="form-group">
												<label for="exampleInputPassword1">سعر البيع للوحدة الفرعية</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="sell_sub_price" placeholder="ادخل السعر">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1"> مخزون الوحدة الفرعية</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="sub_quantity" placeholder="ادخل المخزون">
											</div>
											<div class="form-group">
												<h6>صورة المنتج</h6>
												<div class="custom-file">
													<input class="custom-file-input" name="image" id="customFile" type="file"> <label class="custom-file-label" for="customFile">Choose file</label>
													<img src=""  height="60" alt="">
												</div>
										</div>
																			
										</div>
										<div class="modal-footer">
											<button class="btn ripple btn-primary" type="submit">Save changes</button>
											<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#primary_unit').change(function() {
            var primaryUnitId = $(this).val();
            $.ajax({
                url: '/units/' + primaryUnitId, // Adjust the URL endpoint to fetch secondary units based on primary unit id
                type: 'GET',
                success: function(response) {
                    $('#secondary_unit').empty();
                    $.each(response, function(key, value) {
                        $('#secondary_unit').append('<option value="">اختر الوحدة</option>');
                        $('#secondary_unit').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection