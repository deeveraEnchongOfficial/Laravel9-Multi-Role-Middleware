@extends('layouts.app')
@include('partials.user.left-sidebar')
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