@extends('layouts.app')
@include('partials.user.left-sidebar')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Shops</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Shops</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">


                    <div class="card">
                        {{-- <div class="card-body">
                            {{$usersAndShops}}
                            <br>
                            <hr>
                            <br>
                            {{$vehicle_lists}}
                        </div> --}}
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form id="service_form" method="POST" action="{{ route('bookingList.store') }}">
                            @csrf

                            <div class="col-md-12  mt-4">
                                @foreach ($usersAndShops as $userAndShop)
                                    <input id="shop_id" type="text" name="shop_id" class="form-control d-none"
                                        value="{{ $userAndShop->id }}" style="width: 100%;" required readonly>
                                @endforeach
                                <div class="form-group">
                                    <label>Name</label>
                                    <input id="name" type="text" name="name" class="form-control"
                                        value="{{ $user->name }}" style="width: 100%;" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" type="email" name="email" class="form-control"
                                        value="{{ $user->email }}" style="width: 100%;" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input id="address" type="text" name="address" class="form-control" value=""
                                        style="width: 100%;" required>
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input id="date" type="date" name="date" class="form-control" value=""
                                        style="width: 100%;" required>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_list">Vehicle List</label>
                                    <select name="vehicle_list" id="vehicle_list" class="form-control">
                                        <option value="">-- Select Vehicle --</option>
                                        @foreach ($vehicle_lists as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="service_list">Service List</label>
                                    <table id="service_table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Service Name</th>
                                                <th>Service Price</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="total_price">Total Price:</label>
                                    <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>










                    <style>
                        #service_table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        #service_table td,
                        #service_table th {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }

                        #service_table th {
                            background-color: #f2f2f2;
                        }
                    </style>

                    <script>
                        $(document).ready(function() {
                            $('#vehicle_list').change(function() {
                                var vehicle_lists_id = $(this).val();

                                $.ajax({
                                    url: "{{ route('getServices') }}",
                                    type: "GET",
                                    data: {
                                        vehicle_lists_id: vehicle_lists_id
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var options = '';
                                        $.each(data, function(key, value) {
                                            options +=
                                                '<tr><td><input type="checkbox" name="services[]" value="' +
                                                value.id + '" data-price="' + value.price +
                                                '"></td><td>' + value.service + '</td><td>$' + value
                                                .price + '</td></tr>';
                                        });
                                        $('#service_table tbody').html(options);
                                    }
                                });
                            });

                            $('#service_table').on('change', 'input[type="checkbox"]', function() {
                                var total = 0;

                                $('input[name="services[]"]:checked').each(function() {
                                    total += parseFloat($(this).data('price'));
                                });

                                $('#total_price').val(total.toFixed(2));
                            });

                            // $('#service_form').submit(function(e) {
                            //     e.preventDefault();

                            //     var form = $(this);

                            //     $.ajax({
                            //         url: form.attr('action'),
                            //         type: form.attr('method'),
                            //         data: form.serialize(),
                            //         success: function(response) {
                            //             // handle success response
                            //         },
                            //         error: function(xhr, status, error) {
                            //             // handle error response
                            //         }
                            //     });
                            // });
                        });
                    </script>




                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
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
