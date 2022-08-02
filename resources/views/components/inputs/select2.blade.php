@props(['placeholder' => 'Select Options', 'id'])

<div wire:ignore>
    <select {{ $attributes }} id="{{ $id }}" multiple="multiple" data-placeholder="{{ $placeholder }}" style="width: 100%;">
        {{ $slot }}
    </select>
</div>

@once
@push('customcss')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@endonce

@once
@push('jsAfterCustomJs')
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
@endpush
@endonce

