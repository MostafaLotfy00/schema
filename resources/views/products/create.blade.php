@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة منتج </span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
					
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					
					<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<div class="card  box-shadow-0 ">
							<div class="card-header">
								<h1 class="card-title mb-1">بيانات المنتج</h1>
							</div>
							<div class="card-body pt-0">
								<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
									@csrf
									<div class="">
										<div class="form-group">
											<label for="exampleInputEmail1">اسم المنتج</label>
											<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="ادخل الاسم">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">كود المنتج</label>
											<input type="text" class="form-control" id="exampleInputEmail1" name="code" placeholder="ادخل الكود">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">الصنف</label>
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
											<label for="exampleInputEmail1">العلامة التجارية</label>
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
											<label for="exampleInputEmail1">الفرع</label>
											<select class="form-control select2" name="business_id">
												<option label="اختر  الفرع">
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
											<label for="exampleInputPassword1">صورة المنتج</label>
											<div class="custom-file">
												<input class="custom-file-input" name="image" id="customFile" type="file"> <label class="custom-file-label" for="customFile">Choose file</label>
												<img src=""  height="60" alt="">
											</div>
									</div>
																		
									</div>
									<button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
								</form>
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
                        $('#secondary_unit').append('<option value="' + value.id + '">' + value.name + '</option>');                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection