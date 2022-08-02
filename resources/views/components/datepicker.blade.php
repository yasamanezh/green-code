@props(['id', 'error'])

<input {{ $attributes }} type="text" class="form-control fc-datepicker @error($error) is-invalid @enderror"
       id="{{ $id }}" data-toggle="datetimepicker" data-target="#{{ $id }}"
       onchange="this.dispatchEvent(new InputEvent('input'))"
/>

@push('jsPanel')
    <script type="text/javascript">
        $('#{{ $id }}').datetimepicker({
            format: 'L'
        });
    </script>
@endpush
