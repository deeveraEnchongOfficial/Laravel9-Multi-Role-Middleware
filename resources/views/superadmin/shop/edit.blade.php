@extends('layouts.app')
@include('partials.superadmin.left-sidebar')
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



                    {{-- +"id": 1
      +"active": 0
      +"name": "testName"
      +"email": "test@email.com"
      +"email_verified_at": null
      +"password": "$2y$10$H7X4Kh8LMFl3PX0L1aL0YehGlmiA.HNC/0Wb6vp10XaM/n1/uk9WO"
      +"remember_token": null
      +"role": 2
      +"created_at": "2023-04-06 04:40:58"
      +"updated_at": "2023-04-06 04:40:58"
      +"shop_name": "testShop"
      +"user_role_id": 2
      +"users_id": 4
      +"status": "0"
      +"logo": "default.png"
      
      name
      email
      shop_name
      status
      
      
      
      --}}


      <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">List of Shops</h3>
    
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{ route('shops.update', $id) }}">
            @csrf
            @method('PUT')
            @foreach ($usersAndShops as $userAndShop)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shop Name</label>
                                <input type="text" class="form-control" value="{{ $userAndShop->shop_name }}"
                                    style="width: 100%;">
                            </div>
    
                            <!-- /.form-group -->
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" value="{{ $userAndShop->email }}"
                                  style="width: 100%;">
                          </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Owner Name</label>
                              <input type="text" class="form-control" value="{{ $userAndShop->name }}"
                                  style="width: 100%;">
                          </div>
    
                            <!-- /.form-group -->
                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option selected="selected">{{ $userAndShop->status == 1 ? 'Active' : 'Not Active' }}</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                              </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            @endforeach
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        <!-- /.card-body -->
        <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div>
    </div>
    






                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection