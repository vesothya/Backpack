{{-- @extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection --}}

{{-- @section('content') --}}
  {{-- Default box --}}
  {{-- <div class="row">
    <div class="col-md-12 mb-2">
        <div class="row mb-0">
          <div class="col-sm-6">
            <div class="hidden-print with-border" id="import_button" data-subheading={{$crud->entity_name_plural}}>
              <form method="POST" id="form_upload_file">
                @csrf
                <label for="input_fileUpload" class="btn btn-secondary">
                  <span id="input_file" class="ladda-label"><em class="la la-cloud-download-alt"></em> Import File</span>
                </label>
                <input type="file" name="file"  class="d-none" accept=".xls, .xlsx, .csv" id="input_fileUpload" enctype="multipart/form-data">
              </form>
            </div>
          </div>
        </div>
      </div>
  </div> --}}

{{-- @endsection --}}

{{-- @section('after_styles') --}}
  {{-- DATA TABLES --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"> --}}

  {{-- CRUD LIST CONTENT - crud_list_styles stack --}}
  {{-- @stack('crud_list_styles')
@endsection

@section('after_scripts')
  @include('crud::inc.datatables_logic') --}}

  {{-- CRUD LIST CONTENT - crud_list_scripts stack --}}
  {{-- @stack('crud_list_scripts')
@endsection --}}
