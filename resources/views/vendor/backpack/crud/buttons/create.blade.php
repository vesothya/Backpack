@if ($crud->hasAccess('create'))
	<a href="{{ url($crud->route.'/create') }}" class="btn btn-info" data-style="zoom-in"><span class="ladda-label"><i class="la la-plus"></i> Add New</span></a>
@endif