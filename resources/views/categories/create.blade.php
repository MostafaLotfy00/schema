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
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة صنف </span>
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
								<h1 class="card-title mb-1">بيانات الصنف</h1>
							</div>
							<div class="card-body pt-0">
								<form method="POST" action="{{ route('categories.store') }}" >
									@csrf
									<div class="">
										<div class="form-group">
											<label for="exampleInputEmail1">اسم الصنف</label>
											<input type="text" required class="form-control" id="exampleInputEmail1" name="name" placeholder="ادخل الاسم">
										</div>	
										@error('name')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror								
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