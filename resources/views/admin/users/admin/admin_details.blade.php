@extends('admin.layout.masterlayout')
@section('title', 'details')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="success-sms">

          </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->role->user_type }}</td>
                            <th><button value="{{ $data->id }}" class="adminbtn btn btn-primary">Edit</button>
                                <button value="{{ $data->id }}"
                                    class="passwordbtn btn btn-info">Change-Password</button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!--admin update Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="" method="POST">
                        @csrf
                        <input type="hidden" name="a_id" id="a_id">
                        <div id="errormsg"> </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" id="name" type="text"class="form-control"
                                aria-describedby="emailHelp" placeholder="Enter name" autocomplete="off">
                            <span id="error-name" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" id="email" type="email" class="form-control"
                                aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
                            <span id="error-email" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contact</label>
                            <input name="phone" id="phone" type="text" class="form-control" placeholder="Contact"
                                autocomplete="off">
                            <span id="error-phone" class="text-danger"></span>
                        </div>
                        {{-- <div class="form-group">
                         <label for="exampleInputPassword1">Password</label>
                         <input name="password" id="password" type="password" class="password form-control"
                             placeholder="password" autocomplete="off">
                         <span id="error-password" class="text-danger"></span>
                     </div> --}}

                        <button type="submit" id="save-admin" name="submit" class="btn btn-primary">update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    {{-- password modal --}}
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="af_id" id="af_id">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input name="oldpassword" id="oldpassword" type="password" class="oldpassword form-control"
                                placeholder="old password" autocomplete="off">
                            <span id="error-oldpassword" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input name="newpassword" id="newpassword" type="password" class="newpassword form-control"
                                placeholder="New password" autocomplete="off">
                            <span id="error-newpassword" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input name="c_password" id="c_password" type="password" class="c_password form-control"
                                placeholder="Confirm password" autocomplete="off">
                            <span id="error-cpassword" class="text-danger"></span>
                        </div>

                        <button type="submit" id="change-pass-admin" name="submit" class="btn btn-primary">Update
                            Password</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function(){
                $("div.alert").remove();
            },4000);
            $('.adminbtn').on('click', function(e) {
                var a_id = $(this).val();
                // console.log(a_id);
                $('#adminModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/admin/edit/" + a_id,
                    headers: {
                        Accept: "text/plain; charset=utf-8",
                        "Content-Type": "text/plain; charset=utf-8"
                    },
                    success: function(response) {
                        $('#name').val(response.admin.name);
                        $('#email').val(response.admin.email);
                        $('#phone').val(response.admin.phone);
                        $('#a_id').val(a_id);
                    },
                    error: function(error) {
                        alert("all fields required");
                    }
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#save-admin').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                var a_id = $('#a_id').val();
                // console.log(password);
                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('password', password);
                formData.append('a_id', a_id);

                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('admin/update/') }}",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        // console.log(data.success);
                        alert(data.success);
                        // $('.success-sms').fadeIn().html(data.success);
                        // $('#adminModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.name);
                        // alert(error.responseJSON.errors.name);
                        $('#error-name').text(error.responseJSON.errors.name);
                        $('#error-email').text(error.responseJSON.errors.email);
                        $('#error-phone').text(error.responseJSON.errors.phone);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });

            $('.passwordbtn').on('click', function(e) {
                e.preventDefault();
                var af_id = $(this).val();
                // console.log(af_id);
                $('#pform').trigger("reset");
                $('#passwordModal').modal('show');

                $.ajax({
                    type: "get",
                    url: "/admin/change_password/" + af_id,
                    data: {
                        af_id: af_id
                    },
                    headers: {
                        Accept: "text/plain; charset=utf-8",
                        "Content-Type": "text/plain; charset=utf-8"
                    },
                    success: function(response) {
                        // console.log(response.data.id);
                        $('#af_id').val(response.data.id);
                    }
                });
            });
            $('#change-pass-admin').on('click', function(e) {
                e.preventDefault();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var c_password = $('#c_password').val();
                var af_id = $('#af_id').val();
                // console.log(c_password);
                var formData = new FormData();
                formData.append('oldpassword', oldpassword);
                formData.append('newpassword', newpassword);
                formData.append('c_password', c_password);
                formData.append('af_id', af_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('admin/update_password/') }}",
                    data: formData,
                    success: function(response) {
                        alert(response.msg);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error.responseJSON.errors.c_password);
                        $('#error-oldpassword').text(error.responseJSON.errors.oldpassword);
                        $('#error-newpassword').text(error.responseJSON.errors.newpassword);
                        $('#error-cpassword').text(error.responseJSON.errors.c_password);

                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);

                    }
                });
            });

        });
    </script>
@endsection
