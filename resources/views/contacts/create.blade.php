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
							<h4 class="content-title mb-0 my-auto">جهات الاتصال</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة جهة اتصال </span>
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
								<h1 class="card-title mb-1">بيانات جهة الاتصال</h1>
							</div>
							<div class="card-body pt-0">
								<form method="POST" action="{{ route('contacts.store') }}" >
									@csrf
									<div class="">
										<div class="form-group">
											<label for="exampleInputEmail1">نوع النشاط</label>
											<select class="form-control select2" name="contact_type" id="primary_unit">
												<option label="اختر نوع النشاط">
												<option value="customer">عميل</option>
												<option value="supplier">مورد</option>
												<option value="customer_supplier">عميل و مورد</option>
											</select>
										</div>									
										<div class="form-group">
											<label for="exampleInput1">الاسم</label>
											<input type="text" class="form-control" id="exampleInput1" name="name" placeholder="ادخل الاسم" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput2">اسم النشاط</label>
											<input type="text" class="form-control" id="exampleInput2" name="contact_name" placeholder="ادخل اسم النشاط" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput3">معرف الاتصال</label>
											<input type="text" class="form-control" id="exampleInput3" name="contact_code" placeholder="ادخل معرف الاتصال" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput4">رقم الهاتف</label>
											<input type="text" class="form-control" id="exampleInput4" name="phone" placeholder="ادخل رقم الهاتف" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput5">البريد الالكتروني</label>
											<input type="text" class="form-control" id="exampleInput5" name="email" placeholder="ادخل البريد الالكتروني" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput6"> العنوان</label>
											<input type="text" class="form-control" id="exampleInput6" name="address" placeholder="ادخل العنوان" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput7"> البلد</label>
											<input type="text" class="form-control" id="7" name="country" placeholder="ادخل البلد" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput8"> المحافظة</label>
											<input type="text" class="form-control" id="exampleInput8" name="city" placeholder="ادخل المحافظة" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput9"> المدينة</label>
											<input type="text" class="form-control" id="exampleInput9" name="town" placeholder="ادخل المدينة" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput10"> ساعات العمل</label>
											<input type="text" class="form-control" id="exampleInput10" name="working_hours" placeholder="ادخل ساعات العمل" required>
										</div>									
										<div class="form-group">
											<label for="exampleInput11">longitude</label>
											<input type="text" class="form-control" id="exampleInput11" name="longitude"  required>
										</div>									
										<div class="form-group">
											<label for="exampleInput12">latitude</label>
											<input type="text" class="form-control" id="exampleInput12" name="latitude"  required>
										</div>	
										<div class="form-group">
											<label for="exampleInput13"> الرصيد الافتتاحي</label>
											<input type="text" class="form-control" id="exampleInput13" name="opening_balance" placeholder="ادخل الرصيد الافتتاحي" required>
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
@endsection