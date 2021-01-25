@extends('layout')

@section('content')
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Salary Employee</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<!-- Hover rows -->
		<div class="card">
			<div class="card-header header-elements-inline pt-4 pb-0">
				<h1 class="">
					{{ $user->nama }}
				</h1>
			</div>
			<hr class="">
			<div class="card-body">
				<legend class="font-size-sm">
					<form class="form-validate-jquery" action="" method="get">
						<div class="form-group row">
							<label class="col-form-label col-lg-2 font-weight-bold text-uppercase">Choose Date:</label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<select class="form-control form-control-uniform" name="month">
												<option disabled>Choose Month</option>
												@if (Request::input('month'))
												    @foreach ($months as $key => $value)
														<option value="{{$key}}" {{ (Request::input('month') == $key) ? 'selected' : '' }}>{{$value}}</option>
				                                    @endforeach
				                                @else
				                                	@foreach ($months as $key => $value)
														<option value="{{$key}}" {{ (date('F') == $key) ? 'selected' : '' }}>{{$value}}</option>
				                                    @endforeach
												@endif
			                                </select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<select class="form-control form-control-uniform" name="year">
												<option disabled>Choose Year</option>
			                                    @if (Request::input('year'))
												    @for ($i = 2015; $i <= 2050; $i++)
														<option value="{{$i}}" {{ (Request::input('year') == $i) ? 'selected' : '' }}>{{$i}}</option>
				                                    @endfor
				                                @else
				                                	@for ($i = 2015; $i <= 2050; $i++)
														<option value="{{$i}}" {{ (date('Y') == $i) ? 'selected' : '' }}>{{$i}}</option>
				                                    @endfor
												@endif    
			                                </select>
										</div>
									</div>
									<div style="line-height: 36px">
					                	<button type="submit" class="btn btn-primary py-0 px-2">Check </button>
				                	</div>
								</div>
							</div>
						</div>
					</form>
				</legend>

				@if ($salary)
					@if (Request::input('month') == $salary->month && Request::input('year') == $salary->year && $user->user_id == $salary->user_id)
						<div class="d-flex justify-content-center">
							<div class="col-md-6">
								<div class="card card-body border-top-teal">
									<div class="form-group row">
						                <div class="col-lg-12">
						                	@if ($salary->status == 0)
						                		<span class="badge badge-danger float-right">Belum Di Serahkan</span>
						                	@else
						                		<span class="badge badge-success float-right">Sudah Di Serahkan</span>
						                	@endif
						                </div>
						            </div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Gaji Pokok</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->gaji_pokok_salary,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Uang Makan</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->uang_makan_salary,2,",",".") }}" disabled>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Bonus</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->bonus,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Gaji Kotor</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->gaji_kotor,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">PPH ({{ $salary->pph_percentage }}%)</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->pph,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">BPJS ({{ $salary->bpjs_percentage }}%)</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->bpjs,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Potongan Lain</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->potongan_lain,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Gaji bersih</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->gaji_bersih,2,",",".") }}" disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit">Edit <i class="far fa-edit ml-2"></i></button>
							<button type="button" class="btn bg-teal" data-toggle="modal" data-target="#modal_pdf">Print PDF <i class="far fa-file-pdf ml-2"></i></button>
						</div>
					@endif
				@endif

				@if (!$salary)
					@if (Request::input('month') && Request::input('year'))
					<form id="submituser" class="form-validate-jquery" action="{{ route('salaries.store')}}" method="post">
					@csrf
						<input type="hidden" name="user_id" value="{{$user->user_id}}">
						<input type="hidden" name="month" value="{{ Request::input('month') }}">
						<input type="hidden" name="year" value="{{ Request::input('year') }}">
						<input type="hidden" name="gaji_pokok_salary" value="{{@$user->employee->gaji_pokok_employee}}">
						<input type="hidden" name="uang_makan_salary" value="{{@$user->employee->uang_makan_employee}}">
						<input type="hidden" name="pph_percentage" value="{{$deduction->pph_percentage}}">
						<input type="hidden" name="bpjs_percentage" value="{{$deduction->bpjs_percentage}}">

						<div class="d-flex justify-content-center">
							<div class="col-md-6">
								<div class="card card-body border-top-teal">
									<div class="form-group row">
						                <label class="col-form-label col-lg-2">PPH:</label>
						                <div class="col-lg-3">
						                    <div class="input-group">
						                        <input type="text" class="form-control border-teal border-1 text-center" placeholder="PPH" required disabled 
						                        value="{{ $deduction->pph_percentage }}%">
						                    </div>
						                </div>

						                <label class="col-form-label col-lg-2">BPJS:</label>
						                <div class="col-lg-3">
						                    <div class="input-group">
						                        <input type="text" class="form-control border-teal border-1 text-center" placeholder="BPJS" required disabled 
						                        value="{{ $deduction->bpjs_percentage }}%">
						                    </div>
						                </div>
						            </div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Gaji Pokok</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format(@$user->employee->gaji_pokok_employee,2,",",".") }}" disabled>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Uang Makan</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="text" class="form-control border-teal" value="Rp. {{ number_format(@$user->employee->uang_makan_employee,2,",",".") }}" disabled>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-lg-4">Bonus</label>
										<div class="col-lg-8">
											<div class="input-group">
												<span class="input-group-prepend border-teal">
													<span class="input-group-text">Rp.</span>
												</span>
												<input type="number" name="bonus" class="form-control border-teal border-1 @error('bonus') is-invalid @enderror" placeholder="Bonus" required value="{{ old('bonus') }}">
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-4">Potongan Lain</label>
										<div class="col-lg-8">
											<div class="input-group">
												<span class="input-group-prepend border-teal">
													<span class="input-group-text">Rp.</span>
												</span>
												<input type="number" name="potongan_lain" class="form-control border-teal border-1 @error('potongan_lain') is-invalid @enderror" placeholder="Potongan Lain" required value="{{ old('potongan_lain') }}">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="btn badge-success createbutton" style="color: white; cursor: pointer" data-toggle="modal" data-target="#modal_theme_success" data-uri="{{ route('salaries.store') }}">Save <i class="icon-paperplane ml-2"></i></a>
						</div>

						{{-- Modal save --}}
							<div id="modal_theme_success" class="modal fade" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header bg-success" align="center">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

											<div class="modal-body" align="center">
												<h2> Apakah data sudah di cek dengan benar? </h2>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn bg-danger">Ya</button>
											</div>
									</div>
								</div>
							</div>
						{{-- /Modal save --}}
					</form>
					@endif
				@endif
			</div>
		</div>
		<!-- /hover rows -->
	</div>
	<!-- /content area -->

{{-- modal edit --}}
@if ($salary)
	<div id="modal_edit" class="modal fade" tabindex="-1">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header" style="border-bottom: 1px solid #ddd; padding-bottom:20px;">
	                <h5 class="modal-title">Edit Salary Employee</h5>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <form class="form-validate-jquery" action="{{ route('salaries.update', $salary->id) }}" method="post">
	            @method('PATCH')
	            @csrf
	            	<input type="hidden" name="pph_percentage" value="{{$salary->pph_percentage}}">
					<input type="hidden" name="bpjs_percentage" value="{{$salary->bpjs_percentage}}">
					<input type="hidden" name="gaji_pokok_salary" value="{{$salary->gaji_pokok_salary}}">
					<input type="hidden" name="uang_makan_salary" value="{{$salary->uang_makan_salary}}">

	                <div class="modal-body">
	                	<div class="form-group row">
							<label class="col-form-label col-lg-2 font-weight-bold text-uppercase">Date:</label>
							<div class="col-lg-10">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control text-center" value="{{ $salary->month }}" disabled>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control text-center" value="{{ $salary->year }}" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
	                        <label class="col-form-label col-lg-3">Bonus:</label>
	                        <div class="col-lg-4">
	                            <div class="input-group">
	                                <span class="input-group-append">
	                                    <span class="input-group-text">Rp.</span>
	                                </span>
	                                <input type="number" name="bonus" class="form-control border-teal border-1 " placeholder="Bonus" required value="{{ $salary->bonus }}">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-form-label col-lg-3">Potongan Lain:</label>
	                        <div class="col-lg-4">
	                            <div class="input-group">
	                                <span class="input-group-append">
	                                    <span class="input-group-text">Rp.</span>
	                                </span>
	                                <input type="number" name="potongan_lain" class="form-control border-teal border-1 " placeholder="Potongan Lain" required value="{{ $salary->potongan_lain }}">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-form-label col-lg-3">Status:</label>
	                        <div class="col-lg-8">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<select class="form-control form-control-uniform" name="status">
												<option value="0" {{ ($salary->status == 0) ? 'selected' : '' }}>Belum Di Serahkan</option>
												<option value="1" {{ ($salary->status == 1) ? 'selected' : '' }}>Sudah Di Serahkan</option>
											</select>
										</div>
									</div>
								</div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn bg-primary">Save changes</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

{{-- /modal edit --}}

{{-- print Pdf --}}

	<div id="modal_pdf" class="modal fade" tabindex="-1">
	    <div class="modal-dialog">
	    	<div class="modal-content" style="width: 685px">
	    		<div class="modal-header" style="border-bottom: 1px solid #ddd; padding-bottom:20px;">
	                <h5 class="modal-title">Print PDF</h5>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <form class="form-validate-jquery" action="{{ route('salarypdf', $salary->id) }}" method="post">
	            @method('PATCH')
	            @csrf
	                <div class="order-wrapper">
						<div class="title pt-10">
							<h2>Slip Gaji Karyawan</h2>
							<p>Periode: {{ $salary->month }}, {{ $salary->year }}</p>
						</div>

						<div class="menu px-10 col-lg-12">
							<div class="col-md-5 float-left">
								<div class="col-md-12">
									<h5 class="mr-1 d-inline">Nama:</h5>
									<span>{{ $user->nama }}</span>
								</div>
								
								<div class="col-md-12">
									<h5 class="mr-1 d-inline">Jabatan:</h5>
									<span>{{config('custom.role_karyawan.'.$user->role)}}</span>
								</div>
							</div>

							<div class="col-md-7 float-left">
								<div class="col-md-12">
									<h5 class="mr-1 d-inline">Email:</h5>
									<span >{{ $user->email }}</span>
								</div>
								
								<div class="col-md-12">
									<h5 class="mr-1 d-inline">Telepon:</h5>
									<span>{{ @$user->employee->phone_number }}</span>
								</div>
							</div>
						</div>
						<div class="clear"></div>

						<hr>

						<div class="detail">
							<div class="title-detail">
								<h3>Detail Gaji</h3>
							</div>

							<div class="col-lg-12">
								<div class="col-md-3">
									<div class="float-left">
										<h6>Gaji Pokok</h6>
										<h6>Uang Makan</h6>
										<h6>Bonus</h6>
										<div class="garis-kosong"></div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="float-right">
										<h6 class="mr-3">Rp. {{ number_format($salary->gaji_pokok_salary,2,",",".") }}</h6>
										<h6 class="mr-3">Rp. {{ number_format($salary->uang_makan_salary,2,",",".") }}</h6>
										<h6 class="mr-3">Rp. {{ number_format($salary->bonus,2,",",".") }}</h6>
										<div class="garis-plus"></div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="float-left">
										<h6>Gaji Kotor</h6>
										<h6>PPH ({{ $salary->pph_percentage }}%)</h6>
										<h6>BPJS ({{ $salary->bpjs_percentage }}%)</h6>
										<h6>Potongan Lain</h6>
										<div class="garis-kosong"></div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="float-right">
										<h6 class="mr-3">Rp. {{ number_format($salary->gaji_kotor,2,",",".") }}</h6>
										<h6 class="mr-3">Rp. {{ number_format($salary->pph,2,",",".") }}</h6>
										<h6 class="mr-3">Rp. {{ number_format($salary->bpjs,2,",",".") }}</h6>
										<h6 class="mr-3">Rp. {{ number_format($salary->potongan_lain,2,",",".") }}</h6>
										<div class="garis-min"></div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="float-left">
										<h6>Gaji Bersih/Total</h6>
										<div class="garis-kosong"></div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="float-right">
										<h6 class="mr-3">Rp. {{ number_format($salary->gaji_bersih,2,",",".") }}</h6>
									</div>
								</div>
							</div>
						</div>

						<div class="clear"></div>

						<hr>

						<div class="float-left ml-50 ttd">
							<h4>Penerima</h4>
							<div class="garis-kosong-ttd"></div>
							<h5>{{ $user->nama }}</h5>
						</div>

						<div class="float-right mr-50 ttd">
							<h4>Direktur</h4>
							<div class="garis-kosong-ttd"></div>
							<h5>Nama Direktur</h5>
						</div>

						<div class="clear"></div>
					</div>

					<div class="modal-footer">
	                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn bg-primary">Print Pdf</button>
	                </div>
	            </form>  
	        </div> 
	    </div>
	</div>

{{-- /print Pdf --}}

@endif
@endsection

@section('js')
	<!-- Theme JS files -->
	<script src="{{asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/spin.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/buttons/ladda.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/anytime.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_inputs.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/form_checkboxes_radios.js')}}"></script>
	<script type="text/javascript">

		//modal create
		$(document).on("keypress", "form", function (e) {
		     var code = e.keyCode || e.which;
		     if(code == 13) {
		     	e.preventDefault();
		     	return false;
		     }
		});		
        // Accessibility labels
        $('.pickadate-accessibility').pickadate({
            labelMonthNext: 'Go to the next month',
            labelMonthPrev: 'Go to the previous month',
            labelMonthSelect: 'Pick a month from the dropdown',
            labelYearSelect: 'Pick a year from the dropdown',
            selectMonths: true,
            selectYears: true,
            format: 'yyyy-mm-dd',
        });
				
		var FormValidation = function() {

		    // Validation config
		    var _componentValidation = function() {
		        if (!$().validate) {
		            console.warn('Warning - validate.min.js is not loaded.');
		            return;
		        }

		        // Initialize
		        var validator = $('.form-validate-jquery').validate({
		            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		            errorClass: 'validation-invalid-label',
		            //successClass: 'validation-valid-label',
		            validClass: 'validation-valid-label',
		            highlight: function(element, errorClass) {
		                $(element).removeClass(errorClass);
		            },
		            unhighlight: function(element, errorClass) {
		                $(element).removeClass(errorClass);
		            },
		            // success: function(label) {
		            //    label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
		            //},

		            // Different components require proper error label placement
		            errorPlacement: function(error, element) {

		                // Unstyled checkboxes, radios
		                if (element.parents().hasClass('form-check')) {
		                    error.appendTo( element.parents('.form-check').parent() );
		                }

		                // Input with icons and Select2
		                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
		                    error.appendTo( element.parent() );
		                }

		                // Input group, styled file input
		                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
		                    error.appendTo( element.parent().parent() );
		                }

		                // Other elements
		                else {
		                    error.insertAfter(element);
		                }
		            },
		            messages: {
		                nama: {
		                    required: 'Mohon diisi.'
		                },
		                email: {
		                    required: 'Mohon diisi.'
		                },
		                telp: {
		                    required: 'Mohon diisi.'
		                },
		                username: {
		                    required: 'Mohon diisi.'
		                },
		                // password: {
		                //     required: 'Mohon diisi.'
		                // },
		                role: {
		                    required: 'Mohon diisi.'
		                },
		            },
		        });

		        // Reset form
		        $('#reset').on('click', function() {
		            validator.resetForm();
		        });
		    };

		    // Return objects assigned to module
		    return {
		        init: function() {
		            _componentValidation();
		        }
		    }
		}();


		// Initialize module
		// ------------------------------

		document.addEventListener('DOMContentLoaded', function() {
		    FormValidation.init();
		});
	</script>
	<script type="text/javascript">
		$( document ).ready(function() {

			var $select = $('.form-control-select2').select2();

	        // Default style
	        @if(session('error'))
	            new PNotify({
	                title: 'Error',
	                text: '{{ session('error') }}.',
	                icon: 'icon-blocked',
	                type: 'error'
	            });
            @endif
            @if ( session('success'))
	            new PNotify({
	                title: 'Success',
	                text: '{{ session('success') }}.',
	                icon: 'icon-checkmark3',
	                type: 'success'
	            });
            @endif
            @if ($errors->any())
				@foreach ($errors->all() as $error)
					new PNotify({
						title: 'Error',
						text: '{{ $error }}.',
						icon: 'icon-blocked',
						type: 'error'
					});
				@endforeach
			@endif
            @if ( session('printpdf'))
	        var id = {{session('printpdf')}};
	        // alert(id);
	        window.open('{{url('printpdf')}}/'+id+'','_blank')
	        @endif

		});
	</script>
	
@endsection