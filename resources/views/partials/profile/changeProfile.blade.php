<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Profile
                    </h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<section class="content">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                    src="{{ URL::asset("storage/images/$user->profile_image") }}"
                                    alt="User profile picture" style="width:120px; height: 120px;">
                                    <button type="submit" class="my-2 btn btn-primary" data-toggle="modal" data-target="#changeImgModal">Change Profile Image</button>
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">My Shop</p>

                        {{-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Current Password:</b> <p><u>{{ $userAndShop->password }}</u></p>
                            </li>
                            <form  action="{{ route('shops.changePassword', $userAndShop->users_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @elseif(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <li class="list-group-item">
                                    <b>New Password:</b>
                                    <input type="password" name="new_pass"
                                                class="form-control"
                                                style="width: 100%;" required>
                                </li>
                                <li class="list-group-item">
                                    <b>Confirm Passsword:</b>
                                    <input type="password" name="confirm_pass"
                                    class="form-control"
                                    style="width: 100%;" required>
                                </li>
                                <button type="submit" class="mt-2 btn btn-primary">Save changes</button>
                            </form>
                        </ul> --}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <div class="col-md-9">
                <!-- Main row -->
                <div class="row">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Profile Page</h3>
                            <div class="card-tools">
                            </div>
                        </div> 
                        {{-- //.card-header  --}}
                            <form method="POST" action="{{ route('user.updateProfile' , $user->id) }}">
                                @csrf
                                @method('PUT')
                                  <div class="card-body">
                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @elseif(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @elseif(session('updateImg'))
                                    <div class="alert alert-success">
                                        {{ session('updateImg') }}
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input id="shop_name" type="text" name="name" class="form-control" value="{{ $user->name }}" style="width: 100%;" required="">
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="email" type="text" name="email" class="form-control" value="{{ $user->email }}" style="width: 100%;" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Date Created</label>
                                                <input id="name" type="text" name="created_at" class="form-control" value="{{ date('F j, Y, g:i a', strtotime($user->created_at)) }}" style="width: 100%;" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label>Your Account Status</label>
                                                <select id="status" name="status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" disabled="">
                                                    <option value="1" selected="selected">
                                                        Active
                                                    </option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New Password:</label>
                                                <input id="address" type="password" name="new_pass" class="form-control" style="width: 100%;">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input id="address" type="password" name="confirm_pass" class="form-control" style="width: 100%;">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (main row) -->
                <!-- /.card -->
            </div>
         </div>
    </div>


         <!-- Profile Image Modal -->
         <div class="modal fade" id="changeImgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Profile Image</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('user.changeProfileImage' , $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                            <input type="file" name="profile_image" accept="image/png, image/gif, image/jpeg" required/>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
</section>
@yield('changeProfile')
