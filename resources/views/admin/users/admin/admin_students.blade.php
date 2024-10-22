@extends('admin.layout.masterlayout')
@section('title', 'students details')
@section('page')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
            <button id="add-students" class="btn btn-success">add students</button>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Students</h6>
                <div class="float-right form-group">
                    <form action="{{ url('admin/students/details') }}" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searching" placeholder="Search users"> <span
                                class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    {{-- <span class="glyphicon glyphicon-search"></span> --}}
                                </button>
                            </span>
                        </div>
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
                                        <td><img src="/image/{{ $row->image }}" height="100" width="100%"
                                                alt=""></td>
                                        <td><button value="{{ $row->id }}"
                                                class="adminstudnt btn btn-primary">Edit</button>
                                            <button value="{{ $row->id }}"
                                                class="deletestudent btn btn-danger btn-sm">Delete</button>
                                            <button value="{{ $row->id }}"
                                                class="admin_change_pass btn btn-info">Change-Password</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div>
                                    <h3>no data found</h3>
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
        {{-- modal update --}}
        <div class="modal fade" id="adminstudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin Student Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="as_id" id="as_id">
                            <div id="msgerror"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input name="name" id="name" type="text"class="msgerror form-control"
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
                                <input type="file" id="image" name="image" class="form-control"
                                    placeholder="">
                                <span class="text-danger image-error"></span>
                            </div>
                            <button type="submit" id="studentform" name="submit"
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

    </div>
    {{-- add modal --}}
    <div class="modal fade" id="add-students-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addstudentform" method="post">
                        @csrf

                        <div id="msgerror"></div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" id="" type="text"class="name msgerror form-control"
                                aria-describedby="emailHelp" placeholder="Enter name" autocomplete="off">
                            <span id="" class="name-error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="role_id form-select form-control"
                                aria-label="Default select example">
                                <option value="3">Students</option>
                            </select>
                            <span id="" class="error-role text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" id="" type="email" class="email form-control"
                                aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
                            <span class="email-error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input name="password" id="" type="password" class="password form-control"
                                aria-describedby="emailHelp" placeholder="Enter Password" autocomplete="off">
                            <span id="" class="password-error text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contact</label>
                            <input name="phone" id="phone" type="text" class="phone form-control"
                                placeholder="Contact" autocomplete="off">
                            <span id="" class="phone-error text-danger"></span>
                        </div>

                        <button type="submit" id="student-save" value="add" name="submit"
                            class="btn btn-primary">add students</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    {{-- password modal --}}
    <div class="modal fade" id="studentpasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Student Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="asp_id" id="asp_id" class="">

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

                        <button type="submit" id="change-pass-admin-students" name="submit"
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
            $('.adminstudnt').on('click', function() {
                var as_id = $(this).val();
                // alert(as_id);
                $('#adminstudentModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/admin/students/edit/" + as_id,
                    success: function(response) {
                        // console.log(response.student.name);
                        $('#name').val(response.student.name);
                        $('#email').val(response.student.email);
                        $('#phone').val(response.student.phone);
                        $('#address').val(response.student.address);
                        $('#as_id').val(as_id);
                    },
                    error: function(respons) {
                        alert("Plz fill all the field");
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
            $('#studentform').on('click', function(e) {
                e.preventDefault();
                // $('#msgerror').hide();
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var as_id = $('#as_id').val();
                // console.log(name);
                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('image', image);
                formData.append('as_id', as_id);
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ url('admin/students/update') }}",
                    type: "POST",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(er) {
                        // console.log(er.responseJSON.errors.name);
                        // alert(er.responseJSON.errors.name);
                        $('#name-error').text(er.responseJSON.errors.name);
                        $('#email-error').text(er.responseJSON.errors.email);
                        $('#password-error').text(er.responseJSON.errors.password);
                        $('#phone-error').text(er.responseJSON.errors.phone);
                        $('#address-error').text(er.responseJSON.errors.address);
                        $('.image-error').text(er.responseJSON.errors.image);
                        // $('#msgerror').html('');
                        // $('#msgerror').show();
                        // $.each(er.responseJSON.errors, function(key, value){
                        //     $('#msgerror').append('<div class="alert alert-danger">'+value+'</div>');
                        // });
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);

                    }
                });

            });

            $('.deletestudent').on('click', function(e) {
                if (confirm('do you want to delete this data?')) {
                    var s_id = $(this).val();
                    $.ajax({
                        type: "GET",
                        data: {
                            s_id: s_id
                        },
                        url: "{{ url('admin/students/delete/') }}",
                        success: function(response) {
                            alert(response.success);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                };
            });

            $('#add-students').on('click', function(e) {
                $('#add-students-modal').modal('show');
            });
            $('#student-save').on('click', function(e) {
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

                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/students/add') }}",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                        role_id: role_id
                    },
                    success: function(response) {
                        // console.log(response.success);
                        alert(response.success);
                        $('#adminModal').modal('hide');
                        window.location.reload();

                    },
                    error: function(error) {
                        $('.name-error').text(error.responseJSON.errors.name);
                        $('.email-error').text(error.responseJSON.errors.email);
                        $('.password-error').text(error.responseJSON.errors.password);
                        $('.phone-error').text(error.responseJSON.errors.phone);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });

            $('.admin_change_pass').on('click', function(e) {
                e.preventDefault();
                $('#pform').trigger("reset");
                $('#studentpasswordModal').modal('show');
                var asp_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/admin/students/change-password/" + asp_id,
                    data: {
                        asp_id: asp_id
                    },
                    success: function(response) {
                        // console.log(response.data.id);
                        $('#asp_id').val(response.data.id);
                    }
                });
            });
            $('#change-pass-admin-students').on('click', function(e) {
                e.preventDefault();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var confirm_password = $('#confirm_password').val();
                var asp_id = $('#asp_id').val();

                var formData = new FormData();
                formData.append('oldpassword', oldpassword);
                formData.append('newpassword', newpassword);
                formData.append('confirm_password', confirm_password);
                formData.append('asp_id', asp_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('admin/students/update-password/') }}",
                    data: formData,
                    success: function(response) {
                        alert(response.msg);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error.responseJSON.errors.confirm_password);
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
