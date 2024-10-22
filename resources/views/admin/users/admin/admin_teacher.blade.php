@extends('admin.layout.masterlayout')
@section('title', 'teachers details')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
        </div>
        <div>
            <button id="add-model" class="btn btn-success">Add Teachers</button>

        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Teachrers</h6>
                <div class="float-right form-group">
                    <form action="{{ url('admin/teachers/details') }}" method="GET">
                        <input type="search" class="form-control" id="search" name="search" placeholder="searching">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.n</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isNotEmpty())


                                @foreach ($data as $k => $row)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->address }}</td>
                                        <td><img src="/image/{{ $row->image }}" height="80" width="100%"
                                                alt=""></td>
                                        <td><button value="{{ $row->id }}" data-id="{{ $row->id }}"
                                                class="adminedit btn btn-primary btn-sm">Edit</button>
                                            <button value="{{ $row->id }}"
                                                class="deleteteacher btn btn-danger">Delete</button>
                                            <button value="{{ $row->id }}"
                                                class="adminteacherbtn btn btn-info">Change-Password</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div>
                                    <h3>no teachrers data found</h3>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{ $data->links() }}
        </div>
        <!-- Modal -->
        <div class="modal fade" id="adminteacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin Teacher Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="submitform1" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="at_id" id="at_id">
                            <div id="errormsg"> </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="name" id="name" type="text"class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter name" autocomplete="off">
                                <span id="name-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" id="email" type="email" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
                                <span id="email-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact</label>
                                <input name="phone" id="phone" type="text" class="form-control"
                                    placeholder="Contact" autocomplete="off">
                                <span id="phone-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input name="address" id="address" type="text" class="form-control"
                                    placeholder="address" autocomplete="off">
                                <span id="address-error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" id="image" name="image" class="form-control" required
                                    placeholder="">
                                <span id="image-error" class="text-danger"></span>
                            </div>
                            <button type="submit" id="submitform" name="submit"
                                class="btn btn-primary">update</button>
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
    {{-- add modal --}}
    <div class="modal fade" id="user-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Teachers!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user " id="myform" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" value="{{ old('name') }}" name="name"
                                    class="name form-control form-control-user" id="" placeholder="Enter Name">
                                <span id="" class="error-name text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <select name="role_id" id="role_id" class="role_id form-select form-control"
                                    aria-label="Default select example">
                                    <option value="2">Teachers</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" value="{{ old('email') }}" name="email"
                                class="email form-control form-control-user" id="" placeholder="Email Address">
                            <span id="" class="error-email text-danger"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="password form-control form-control-user"
                                    id="" placeholder="Password">
                                <span id="" class="error-password text-danger"></span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <input type="text" value="{{ old('phone') }}" name="phone"
                                    class="phone form-control form-control-user" id=""
                                    placeholder="Contact Number">
                                <span id="" class="error-phone text-danger"></span>
                            </div>

                            <button type="submit" id="user-save" value="add" name="submit"
                                class=" btn btn-primary btn-user btn-block">
                                Add Teachers
                            </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Add Modal -->
    {{-- password modal --}}
    <div class="modal fade" id="teacherpasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Teachers Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="atp_id" id="atp_id" class="">

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

                        <button type="submit" id="change-pass-admin-teacher" name="submit"
                            class="btn btn-primary">Update Password</button>
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
            $('.adminedit').on('click', function() {
                var at_id = $(this).val();
                // alert(at_id);
                $('#adminteacherModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/admin/teachers/edit/" + at_id,
                    headers: {
                        Accept: "text/plain; charset=utf-8",
                        "Content-Type": "text/plain; charset=utf-8"
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#name').val(response.teacher.name);
                        $('#email').val(response.teacher.email);
                        $('#phone').val(response.teacher.phone);
                        $('#address').val(response.teacher.address);
                        $('#at_id').val(at_id);
                    },
                    error: function(error) {
                        console.log(error);
                        alert("all fields required");
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let image;
            $('#image').change(function(e) {
                image = e.target.files[0];
            });
            $('#submitform').on('click', function(e) {
                e.preventDefault();
                // $('#errormsg').hide();
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var at_id = $('#at_id').val();

                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('image', image);
                formData.append('at_id', at_id);
                // console.log(formData);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ url('admin/teachers/update') }}",
                    type: "POST",
                    method: "POST",
                    data: formData,
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
                        $('#password-error').text(error.responseJSON.errors.password);
                        $('#phone-error').text(error.responseJSON.errors.phone);
                        $('#address-error').text(error.responseJSON.errors.address);
                        $('#image-error').text(error.responseJSON.errors.image);
                        // $('#errormsg').html('');
                        // $('#errormsg').show();
                        // $.each(error.responseJSON.errors, function(key, value){
                        //     $('#errormsg').append('<div class="alert alert-danger">'+value+'</div>');
                        // });
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });

            $('.deleteteacher').on('click', function() {
                if (confirm('do you want to delete this data?')) {
                    var t_id = $(this).val();
                    $.ajax({
                        type: "GET",
                        data: {
                            t_id: t_id
                        },
                        url: "{{ url('admin/teachers/delete') }}",
                        success: function(response) {
                            // console.log(response.success);
                            alert(response.success);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                };
            });

        });
        $(document).ready(function() {
            $('#add-model').click(function() {
                $('#user-Modal').modal('show');
            });
            $('#user-save').click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var name = $('.name').val();
                var email = $('.email').val();
                var password = $('.password').val();
                var phone = $('.phone').val();
                var role_id = $('.role_id').val();
                // console.log(name);
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/add/teachers') }}",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                        role_id: role_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response.success);
                        alert(response.success);
                        // setTimeout(() => {
                        //         location.reload();
                        //     }, 1000);
                        $('#adminModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(error) {
                        // alert('all fields required');
                        console.log(error.responseJSON.errors.name);
                        $('.error-name').text(error.responseJSON.errors.name);
                        $('.error-email').text(error.responseJSON.errors.email);
                        $('.error-password').text(error.responseJSON.errors.password);
                        $('.error-phone').text(error.responseJSON.errors.phone);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });

            $('.adminteacherbtn').on('click', function(e) {
                e.preventDefault();
                var atp_id = $(this).val();
                $('#pform').trigger("reset");
                // console.log(atp_id);
                $('#teacherpasswordModal').modal('show');

                $.ajax({
                    type: "get",
                    url: "/admin/teachers/change-password/" + atp_id,
                    data: {
                        atp_id: atp_id
                    },
                    headers: {
                        Accept: "text/plain; charset=utf-8",
                        "Content-Type": "text/plain; charset=utf-8"
                    },
                    success: function(response) {
                        // console.log(response.data.id);
                        $('#atp_id').val(response.data.id);
                    }
                });
            });
            $('#change-pass-admin-teacher').on('click', function(e) {
                e.preventDefault();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var confirm_password = $('#confirm_password').val();
                var atp_id = $('#atp_id').val();

                var formData = new FormData();
                formData.append('oldpassword', oldpassword);
                formData.append('newpassword', newpassword);
                formData.append('confirm_password', confirm_password);
                formData.append('atp_id', atp_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('admin/teachers/update-password') }}",
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
