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
                        <h1 class="m-0">Available Shops</h1>
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
       
        <style>
            .card-link {
              text-decoration: none;
            }
          </style>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="row">
                  @foreach ($usersAndShops as $userAndShop)
                  <div class="col-md-4">
                    <a href="{{ route('shops.userShopView', $userAndShop->id) }}" class="card-link">
                    <div class="card card-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header text-white" style="background: url('{{asset("storage/images/$userAndShop->logo")}}') center center;">
                        <h3 class="widget-user-username text-right">{{ $userAndShop->shop_name}}</h3>
                        <h5 class="widget-user-desc text-right"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $userAndShop->address}}</h5>
                      </div>
                      <div class="widget-user-image">
                        <img class="img-circle" src="{{asset('admin-assets/dist/img/user3-128x128.jpg')}}" alt="User Avatar">
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-4 border-right">
                            {{-- <div class="description-block">
                              <h5 class="description-header">3,200</h5>
                              <span class="description-text">SALES</span>
                            </div> --}}
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 border-right">
                            <div class="description-block">
                              <h5 class="description-header">{{ $userAndShop->name}}</h5>
                              <span class="description-text">Owner</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4">
                            {{-- <div class="description-block">
                              <h5 class="description-header">35</h5>
                              <span class="description-text">PRODUCTS</span>
                            </div> --}}
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                </a>
                  </div>
                  @endforeach
                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
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
