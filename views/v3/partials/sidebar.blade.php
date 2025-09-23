@php
    $classes ??= [];
    $classes = (array) ($classes ?: []);
    $classes = apply_filters('Municipio/views/partials/sidebar/classes', $classes, $id);
@endphp
@if(isset($id) && $id)
    @section('sidebar.' . $id . '.before')@show
    @if (is_active_sidebar($id))
        @section('sidebar.active.' . $id . '.before')@show
        <div id="sidebar-{{$id}}" class="s-sidebar s-sidebar-{{$id}} sidebar-{{$id}} {{ implode(' ', $classes) }}">
            @php dynamic_sidebar($id); @endphp
        </div>
        @section('sidebar.active.' . $id . '.after')@show
    @else
        @section('sidebar.inactive.' . $id)@show
    @endif
    @section('sidebar.' . $id . '.after')@show
@endif