@extends('layout')

@section('css')
<style type="text/css">
	.datatable-column-width{
		overflow: hidden; text-overflow: ellipsis; max-width: 200px;
	}
</style>
@endsection

@section('content')

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i>Setting</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

    <div class="card">
        
        <div class="card-body">
            <form class="form-validate-jquery" action="{{route('settings.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Generate QR</legend>
                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Tanggal</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control border-teal border-1 pickadate-accessibility" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}" required>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-success">Generate QR & Print<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>

                </fieldset>
                
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
        @if ( session('printqrcode'))
		var id = {{session('printqrcode')}};
		// alert(id);
		window.open('{{url('printqr')}}/'+id+'','_blank')
		@endif
        
    });
</script>
@endsection