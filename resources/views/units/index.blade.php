@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-style2">
								<li class="breadcrumb-item">
									<a href="{{ route('products.index') }}">المنتجات</a>
								</li>
								<li class="breadcrumb-item active">الوحدات </li>
							</ol>
						</nav>
					</div>
					<div class="d-flex my-xl-auto right-content">
	
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<a class="btn ripple btn-primary" data-target="#modaldemo1" data-toggle="modal" href="">اضافة وحدة</a>
									{{-- <a href="{{ route('units.create') }}" class="btn btn-primary  btn-block  text-white">اضافة وحدة</a> --}}
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
						<table class="table mg-b-0 text-md-nowrap">
							@if (session('success'))
							<div class="alert alert-solid-success" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>{{ session('success') }}</strong>
							</div>
							@endif
							<thead>
								<tr>
									<th>ID</th>
									<th>الاسم</th>
									<th>الوحدة الاساسية</th>
									<th>الوحدة الفرعية</th>
									<th>Actions</th> <!-- New column for buttons -->
								</tr>
							</thead>
							<tbody>
								@if (count($units) == 0)
								<div class="alert alert-solid-warning" role="alert">
									<button aria-label="Close" class="close" data-dismiss="alert" type="button">
									<span aria-hidden="true">&times;</span></button>
									<strong> لا يوجد وحدات!</strong>
								</div>
								@else
								@php
								$i=0;
							    @endphp
								@foreach ($units as $unit)
								@php
								$i++;
						    	@endphp
								<tr>
									<th scope="row">{{ $i }}</th>
									<td>{{ $unit->name }}</td>
									<td>{{ $unit->unit->name ?? null }}</td>
									<td>{{ $unit->unit_multiplier ?? 0 }}</td>
									<td>
										<div class="d-flex">
											<a href="{{ route('units.edit', $unit->id) }}" class="btn btn-primary btn-sm text-white  mg-l-10">Edit</a>
											<form action="{{ route('units.destroy', $unit->id) }}" method="post" class="mb-0">
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
						{{ $units->withQueryString()->links() }}
					</div>

					<div class="modal" id="modaldemo1">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">اضافة وحدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form method="POST" action="{{ route('units.store') }}" >
										@csrf
										<div class="">
											<div class="form-group">
												<h6>اسم الوحدة</h6>
												<input type="text" required class="form-control" id="exampleInputEmail1" name="name" placeholder="ادخل الاسم">
											</div>	
											@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
											@enderror								
										</div>
										<div class="">
											<div class="form-group">
												<label for="exampleInputEmail1">الوحدة الاساسية </label>
												<select class="form-control select2" name="unit_id">
													<option label="اختر الوحدة الاساسية">
													</option>
													@foreach ($units as $unit)	
													<option value="{{ $unit->id }}">
														{{ $unit->name }}
													</option>
													@endforeach
												</select>										</div>	
											@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
											@enderror								
										</div>
										<div class="">
											<div class="form-group">
												<h6> جزء الوحدة</h6>
												<input type="text"  class="form-control" id="exampleInputEmail1" name="unit_multiplier" placeholder="ادخل الرقم">
											</div>	
											@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
											@enderror								
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
@endsection