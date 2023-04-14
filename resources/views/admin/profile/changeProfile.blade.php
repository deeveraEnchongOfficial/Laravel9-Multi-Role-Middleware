@extends('layouts.app')
@include('partials.admin.left-sidebar')
@section('content')

@include('partials.profile.changeProfile')
@section('changeProfile')
@endsection

@endsection
@section('js')
    <script>
        $(function() {
            $('#datatable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@stop