{{-- @extends(backpack_view('blank'))

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
<div class="card no-padding no-border">
    <table class="table table-striped mb-0">
        <tbody>
            @foreach ($crud->columns() as $column)
            <tr>
                <td>
                    <strong>{!! $column['label'] !!}:</strong>
                </td>
                <td>
                    @php
                        // create a list of paths to column blade views
                        // including the configured view_namespaces
                        $columnPaths = array_map(function($item) use ($column) {
                            return $item.'.'.$column['type'];
                        }, \Backpack\CRUD\ViewNamespaces::getFor('columns'));

                        // but always fall back to the stock 'text' column
                        // if a view doesn't exist
                        if (!in_array('crud::columns.text', $columnPaths)) {
                            $columnPaths[] = 'crud::columns.text';
                        }
                    @endphp
                    @includeFirst($columnPaths)
                </td>
            </tr>
            <img src="{{ asset($entry->image) }}" alt="" width="200px">
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
