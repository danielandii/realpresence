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

<div class="content">
    <div class="card">
        
        <div class="card-body">
            <form class="form-validate-jquery" action="{{route('settings.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Generate QR</legend>
                    
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Tanggal</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control border-teal border-1 pickadate-accessibility" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}" required>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-success">Generate QR & Print<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>
                </form>
                
            </fieldset>
            
            <hr>
            
            
        </div>
    </div>
    
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-semibold">QR Data</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            
            @foreach($qrdatas as $qrdata)
            <div class="form-group row">
                <div class="col-lg-3">
                    {{$qrdata->tanggal}}
                </div>
                <div class="col-lg-9">    
                    {{$qrdata->token_qr}}
                </div>
            </div>
                @endforeach
            
            
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
    var DatatableBasic = function() {
        
        // Basic Datatable examples
        var _componentDatatableBasic = function() {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }
            
            // Setting datatable defaults
            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{ 
                    orderable: false,
                    width: 100,
                    targets: [ 4 ]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                }
            });
            
            // Basic datatable
            $('.datatable-basic').DataTable();
            
            // Alternative pagination
            $('.datatable-pagination').DataTable({
                pagingType: "simple",
                language: {
                    paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
                }
            });
            
            // Datatable with saving state
            $('.datatable-save-state').DataTable({
                stateSave: true
            });
            
            // Scrollable datatable
            var table = $('.datatable-scroll-y').DataTable({
                autoWidth: true,
                scrollY: 300
            });
            
            // Resize scrollable table when sidebar width changes
            $('.sidebar-control').on('click', function() {
                table.columns.adjust().draw();
            });
        };
        
        // Select2 for length menu styling
        var _componentSelect2 = function() {
            if (!$().select2) {
                console.warn('Warning - select2.min.js is not loaded.');
                return;
            }
            
            // Initialize
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        };
        
        
        //
        // Return objects assigned to module
        //
        
        return {
            init: function() {
                _componentDatatableBasic();
                _componentSelect2();
            }
        }
    }();
    
    
    // Initialize module
    // ------------------------------
    
    document.addEventListener('DOMContentLoaded', function() {
        DatatableBasic.init();
    });
    
    
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