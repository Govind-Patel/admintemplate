@extends('admin.layout.masterlayout')
@section('title','teacher dashboard')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard  {{session()->get('loginUser')->role->user_type}}</h1>
        </div>
        <div>
            {{-- <button id="user-add" class="btn btn-success">Add User</button> --}}
        </div>
        @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
        @endif
        <!-- Content Row -->
    </div>
    <!-- /.container-fluid -->

    </div>
    <div class="modal fade" id="user-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create an Account!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user " id="myform" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" value="{{old('name')}}" name="name" class="form-control form-control-user"
                                    id="name" placeholder="Enter Name">
                               <span id="error-name" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <select name="role_id" id="role_id" class="form-select form-control"
                                    aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="2">Teachers</option>
                                    <option value="3">Students</option>
                                </select>
                                <span id="error-role" class="text-danger"></span>

                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" value="{{old('email')}}" name="email" class="form-control form-control-user"
                                id="email" placeholder="Email Address">
                                <span id="error-email" class="text-danger"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="password" placeholder="Password">
                                    <span id="error-password" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <input type="text" value="{{old('phone')}}" name="phone" class="form-control form-control-user"
                                    id="phone" placeholder="Contact Number">
                                    <span id="error-phone" class="text-danger"></span>
                        </div>

                        <button type="submit" id="user-save" value="add" name="submit" class=" btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                     </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
