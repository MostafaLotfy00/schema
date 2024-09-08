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
									<a href="{{ route('contacts.index') }}">جهات الاتصال</a>
								</li>
								<li class="breadcrumb-item active">الموردين</li>
							</ol>
						</nav>
					</div>
					<div class="d-flex my-xl-auto right-content">
	
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<a class="btn ripple btn-primary" data-target="#modaldemo1" data-toggle="modal" href="">اضافة جهة اتصال</a>
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
								<tr>
									<th>ID</th>
									<th>الاسم</th>
									<th>اسم النشاط</th>
									<th>معرف الاتصال</th>
									<th>الموبايل</th>
									<th>الايميل</th>
									<th>العنوان</th>
									<th>البلد</th>
									<th>المدينة</th>
									<th>المحافظة</th>
									<th>ساعات العمل</th>
									<th>الرصيد الافتتاحي</th>
									<th>الرصيد المستحق</th>
									<th>الرصيد المتبقي</th>
									<th>Actions</th> <!-- New column for buttons -->
								</tr>
							</thead>
							<tbody>
								@if (count($contacts) == 0)
								<div class="alert alert-solid-warning" role="alert">
									<button aria-label="Close" class="close" data-dismiss="alert" type="button">
									<span aria-hidden="true">&times;</span></button>
									<strong> لا يوجد  جهات اتصال!</strong>
								</div>
								@else
							 @php
								 $i=0;
							 @endphp
								@foreach ($contacts as $contact)	
								@php
								$i++;
							   @endphp
								<tr>
									<th scope="row">{{ $i }}</th>
									<td>{{ $contact->name }}</td>
									<td>{{ $contact->contact_name }}</td>
									<td>{{ $contact->contact_code }}</td>
									<td>{{ $contact->phone }}</td>
									<td>{{ $contact->email }}</td>
									<td>{{ $contact->address }}</td>
									<td>{{ $contact->country }}</td>
									<td>{{ $contact->city }}</td>
									<td>{{ $contact->town }}</td>
									<td>{{ $contact->working_hours }}</td>
									<td>{{ $contact->opening_balance }}</td>
									<td>{{ $contact->balance_due }}</td>
									<td>{{ $contact->remaining_balance }}</td>
									<td>
										<div class="d-flex">
											<a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm text-white  mg-l-10">Edit</a>
											<form action="{{ route('contacts.destroy', $contact->id) }}" method="post" class="mb-0">
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
						{{ $contacts->withQueryString()->links() }}
					</div>

					<div class="modal" id="modaldemo1">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">اضافة جهة اتصال</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
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