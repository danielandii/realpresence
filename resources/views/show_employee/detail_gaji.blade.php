@extends('layout')

@section('content')
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i>Detail Gaji</h4>
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
					{{ \Auth::user()->nama }}
				</h1>
			</div>
			<hr class="">
			<div class="card-body">
				<legend class="font-size-sm">
					<div class="form-group row">
						<label class="col-form-label col-lg-2 font-weight-bold text-uppercase">Periode:</label>
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
				</legend>

				<div class="d-flex justify-content-center">
					<div class="col-md-6">
						<div class="card card-body border-top-teal">
							<div class="form-group row">
				                <label class="col-form-label col-lg-2">PPH:</label>
				                <div class="col-lg-2">
				                    <div class="input-group">
				                        <input type="text" class="form-control border-teal border-1" placeholder="PPH" required disabled 
				                        value="{{ $salary->pph_percentage }}%">
				                    </div>
				                </div>

				                <label class="col-form-label col-lg-2">BPJS:</label>
				                <div class="col-lg-2">
				                    <div class="input-group">
				                        <input type="text" class="form-control border-teal border-1" placeholder="BPJS" required disabled 
				                        value="{{ $salary->bpjs_percentage }}%">
				                    </div>
				                </div>

				                <div class="col-lg-4">
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
								<label class="col-form-label col-lg-4">PPH</label>
								<div class="col-lg-8">
									<div class="input-group">
										<input type="text" class="form-control border-teal" value="Rp. {{ number_format($salary->pph,2,",",".") }}" disabled>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-form-label col-lg-4">BPJS</label>
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
			</div>
		</div>
	</div>
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
            @if ( session('printpdf'))
	        var id = {{session('printpdf')}};
	        // alert(id);
	        window.open('{{url('printpdf')}}/'+id+'','_blank')
	        @endif

		});
	</script>
	
@endsection