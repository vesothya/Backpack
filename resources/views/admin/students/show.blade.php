@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	<section class="container-fluid d-print-none">
    	<a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
		<h2>
	        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
	        <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}.</small>
	        @if ($crud->hasAccess('list'))
	          <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
	        @endif
	    </h2>
    </section>
@endsection

@section('content')

<div class="tab-content">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <tbody class="br-0">
                <tr>
                    <td><strong>Name</strong></td>
                    <td>:</td>
                    <td>{{$entry->name}}</td>
                </tr>
                <tr>
                    <td><strong>Gender</strong></td>
                    <td>:</td>
                    <td>{{$entry->Gender}}</td>
                </tr>
                <tr>
                    <td><strong>Phone</strong></td>
                    <td>:</td>
                    <td>{{$entry->phone}}</td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td>:</td>
                    <td>{{$entry->address}}</td>
                </tr>
                <tr>
                    <td><strong>Subject</strong></td>
                    <td>:</td>
                    <td>{{$entry->subjects->implode('subject',' , ')}}</td>
                </tr>
                <tr>
                    <td><strong>Photo</strong></td>
                    <td>:</td>
                    <td><img class="img-thumbnail" src="{{ asset($entry->image) }}" alt="" width="100px"></td>
                </tr>
            </tbody>
        </table>
    </div> 
</div>

@endsection
