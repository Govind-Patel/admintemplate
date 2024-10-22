@extends('admin.layout.masterlayout')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard  {{session()->get('loginUser')->role->user_type}}</h1>
        </div>
        @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
        @endif

            <!-- DataTales Example -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update an Account!</h1>
                        </div>
                        <form class="user" action="{{ url('teachers/update/'.$data->id) }}" method="post">
                            @csrf
                            <div class="form-group">

                                    <input type="text" value="{{$data->name}}" name="name" class="form-control form-control-user"
                                        id="exampleFirstName" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif

                            </div>
                            <div class="form-group">

                                    <input type="email" value="{{$data->email}}" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                            </div>
                            <div class="form-group">

                                    <input type="text" value="{{$data->phone}}" name="phone" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Contact Number">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif

                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                               Teacher Update Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>


    </div>
    <!-- /.container-fluid -->

    </div>
@endsection
