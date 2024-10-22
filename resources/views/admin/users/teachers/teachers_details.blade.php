@extends('admin.layout.masterlayout')
@section('title', 'teachers')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
            {{-- <button id="add-students" class="btn btn-success">Add Students</button> --}}
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->role->user_type }}</td>
                                <td>{{ $data->address }}</td>
                                <td><img src="/image/{{ $data->image }}" alt="" height="100" width="100%"></td>
                                <td><button value="{{ $data->id }}" data-id="{{ $data->id }}"
                                        class="teacheredit btn btn-primary btn-sm">Edit</button>
                                    <button value="{{ $data->id }}"
                                        class="teacherpasswordbtn btn btn-success btn-sm">Change-Password</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Teacher Modal -->
        <div class="modal fade" id="teacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Teacher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="t_id" id="t_id">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter name">
                                <span id="name-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                                <span id="email-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Contact">
                                <span id="phone-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="address">
                                <span id="address-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" name="image" id="image" class="form-control" placeholder="">
                                <span id="image-error" class="text-danger"></span>
                            </div>
                            <button type="submit" id="teacherform" name="submit" class="btn btn-primary">update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    {{-- password modal --}}
    <div class="modal fade" id="teacherpasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Teacher Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="tp_id" id="tp_id">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input name="oldpassword" id="oldpassword" type="password" class="oldpassword form-control"
                                placeholder="old password" autocomplete="off">
                            <span id="error-oldpassword" class="pform text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input name="newpassword" id="newpassword" type="password" class="newpassword form-control"
                                placeholder="New password" autocomplete="off">
                            <span id="error-newpassword" class="pform text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input name="confirm_password" id="confirm_password" type="password"
                                class="confirm_password form-control" placeholder="Confirm password" autocomplete="off">
                            <span id="error-confirm_password" class="pform text-danger"></span>
                        </div>

                        <button type="submit" id="change-pass-teacher" name="submit" class="btn btn-primary">Update
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
            $('.teacheredit').on('click', function() {
                var t_id = $(this).val();
                // alert(t_id);
                $('#teacherModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/teachers/edit/" + t_id,
                    success: function(response) {
                        // console.log(response.teacher.name);
                        $('#name').val(response.teacher.name);
                        $('#email').val(response.teacher.email);
                        $('#phone').val(response.teacher.phone);
                        $('#address').val(response.teacher.address);
                        $('#t_id').val(t_id);
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#image').change(function(e) {
                image = e.target.files[0];
            });
            $('#teacherform').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var t_id = $('#t_id').val();

                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('image', image)
                formData.append('t_id', t_id);

                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "post",
                    url: "{{ url('teachers/update/') }}",
                    data: formData,
                    method: "post",
                    success: function(response) {
                        // console.log(response.success);
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.name);
                        // alert(error.responseJSON.errors.name);
                        $('#name-error').text(error.responseJSON.errors.name);
                        $('#email-error').text(error.responseJSON.errors.email);
                        $('#phone-error').text(error.responseJSON.errors.phone);
                        $('#address-error').text(error.responseJSON.errors.address);
                        $('#image-error').text(error.responseJSON.errors.image);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });
            $('.teacherdelete').on('click', function(e) {
                if (confirm("do you want to delete this data?")) {
                    var t_id = $(this).val();
                    $.ajax({
                        type: "GET",
                        data: {
                            t_id: t_id
                        },
                        url: "{{ url('teachers/delete/') }}",
                        success: function(response) {
                            alert(response.success);
                            window.location.reload();
                        }
                    });
                };
            });


            $('.teacherpasswordbtn').on('click', function(e) {
                e.preventDefault();
                $('#pform').trigger("reset");
                $('#teacherpasswordModal').modal('show');
                var tp_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/teachers/change-password/" + tp_id,
                    data: {
                        tp_id: tp_id
                    },
                    success: function(response) {
                        $('#tp_id').val(response.data.id);
                    }
                });
            });
            $('#change-pass-teacher').on('click', function(e) {
                e.preventDefault();
                var tp_id = $('#tp_id').val();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var confirm_password = $('#confirm_password').val();

                var formData = new FormData();
                formData.append('oldpassword', oldpassword);
                formData.append('newpassword', newpassword);
                formData.append('confirm_password', confirm_password);
                formData.append('tp_id', tp_id);

                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('teachers/password-update/') }}",
                    data: formData,
                    success: function(response) {
                        alert(response.msg);
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.confirm_password);
                        $('#error-oldpassword').text(error.responseJSON.errors.oldpassword);
                        $('#error-newpassword').text(error.responseJSON.errors.newpassword);
                        $('#error-confirm_password').text(error.responseJSON.errors
                            .confirm_password);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });


        });
    </script>
@endsection
