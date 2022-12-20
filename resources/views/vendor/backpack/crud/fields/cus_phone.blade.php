@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <div class="form-group">
        <input type="text" id="phone" name="phone" class="form-control">
    </div>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

@push('after_styles')
    <link rel="stylesheet" href="{{asset('css/intlTelInput.css')}}">
@endpush

@push('after_scripts')
        <script src="{{asset('js/intlTelInput.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="{{asset('js/intlTelInput-jquery.min.js')}}"></script>
        <script>
            $("#phone").intlTelInput({
                utilsScript: "(js/utils.js)",
                initialCountry: 'kh',
                separateDialCode: true,
                formatOnDisplay:true,
            });
        </script>
@endpush
