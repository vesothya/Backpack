<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><em class="la la-download"></em> Import</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <input type="file" name="file"  class="form-control" accept=".xls, .xlsx, .csv" id="input_fileUpload" enctype="multipart/form-data">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save">Save</button>
      </div>
    </div>
  </div>
</div>

@push('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
          $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          })
            $('body').on('click', '.btn-save', function() {
                var jform = new FormData();
                jform.append('file', $('#input_fileUpload').get(0).files[0]);

                $.ajax({
                    // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: jform,
                    enctype: 'multipart/form-data',
                    url: '/admin/product/import',
                    // data: {
                    //   _token: '{{ csrf_token() }}'
                    // },
                    success: function (response) {
                        if(response.success) {
                            new Noty({
                                type: 'success',
                                text: response.message
                            }).show();
                            setTimeout(function() {
                                $('.close').click();
                                crud.table.ajax.reload();
                            }, 500);
                        } else {
                            new Noty({
                                type: 'error',
                                text: response.message
                            }).show();  
                        }
                    },
                    error: function(error) {
                        new Noty({
                                type: 'error',
                                text: "Import failed"
                        }).show();
                    }
                });
            });
        });
        
    </script>

@endpush