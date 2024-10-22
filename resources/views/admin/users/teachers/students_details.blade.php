@extends('admin.layout.masterlayout')
@section('title', 'teacher students details')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
            <button id="add-students" class="btn btn-success">Add Students</button>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="alert alert-block">

            <strong id="success_sms"></strong>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Students</h6>
                <div class="float-right">
                    <form action="">
                        <div class="form-group">
                            <input class="form-control" type="search" name="search" id="search"
                                placeholder="search users">
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
                                <th>Role</th>
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
                                        <td><img src="/image/{{ $row->image }}" height="100px" width="100%"
                                                alt=""></td>
                                        <td>{{ $row->role->user_type }}</td>
                                        <td><button value="{{ $row->id }}" data-id="{{ $row->id }}"
                                                class="studentsbtn btn btn-primary btn-sm">Edit</button>
                                            <button value="{{ $row->id }}" data-id="{{ $row->id }}"
                                                class="btn btn-danger btn-sm deletestudent">Delete</button>
                                            <button value="{{ $row->id }}"
                                                class="teacherstdbtn btn btn-success">Change-Password</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div>
                                    <h4>no record found</h4>
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
        <!-- Modal update-->
        <div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">teacher students update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="s_id" id="s_id">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter name">
                                <span id="error-name" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                                <span id="error-email" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Contact">
                                <span id="error-phone" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="address">
                                <span id="error-address" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" name="image" id="image" class="form-control"
                                    placeholder="">
                                <span id="error-image" class="text-danger"></span>
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
 <!--add Modal-->
 <div class="modal fade" id="students-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    <div class="modal fade" id="teacherstdpassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Teacher Student Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="tsp_id" id="tsp_id">

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

                        <button type="submit" id="change-pass-tstd" name="submit" class="btn btn-primary">Update
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
            $('.studentsbtn').on('click', function() {
                var s_id = $(this).val()
                // alert(s_id);
                $('#studentsModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/teachers/students/edit/" + s_id,
                    success: function(respons) {
                        // console.log(respons.student.name);
                        $('#name').val(respons.student.name);
                        $('#email').val(respons.student.email);
                        $('#phone').val(respons.student.phone);
                        $('#address').val(respons.student.address);
                        $('#s_id').val(s_id);
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
            $('#studentform').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var password = $('#password').val();
                var s_id = $('#s_id').val();

                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('image', image);
                formData.append('s_id', s_id);

                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "post",
                    url: "{{ url('teachers/students/update/') }}",
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        // console.log(response.success);
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.name);
                        // alert(error.responseJSON.errors.name);
                        $('#error-name').text(error.responseJSON.errors.name);
                        $('#error-email').text(error.responseJSON.errors.email);
                        $('#error-phone').text(error.responseJSON.errors.phone);
                        $('#error-address').text(error.responseJSON.errors.address);
                        $('#error-image').text(error.responseJSON.errors.image);
                        setTimeout(() => {
                            $('.text-danger').html('');
                        }, 4000);
                    }
                });
            });
            $('#add-students').on('click', function() {
                $('#students-Modal').modal('show');
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
                // console.log(password);
                $.ajax({
                    type: "POST",
                    url: "{{ url('teachers/students/add') }}",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                        role_id: role_id
                    },
                    success: function(response) {
                        console.log(response.success);
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.name);
                        // alert(error.responseJSON.errors.name);
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
            $('.deletestudent').on('click', function(e) {
                if (confirm("do you want to delete this data?")) {
                    e.preventDefault();
                    var st_id = $(this).val();
                    $.ajax({
                        type: "GET",
                        data: {
                            st_id: st_id
                        },
                        url: "{{ url('teachers/students/delete') }}",
                        success: function(response) {
                            // console.log(response.success);
                            alert(response.success);
                            window.location.reload();
                        },
                        erroe: function(response) {
                            alert('data not deleted');
                        }

                    });
                };
            });

            $('.teacherstdbtn').on('click', function(e) {
                e.preventDefault();
                $('#pform').trigger("reset");
                $('#teacherstdpassModal').modal('show');
                var tsp_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/teachers/students/password-changes/" + tsp_id,
                    data: {
                        tsp_id: tsp_id
                    },
                    success: function(response) {
                        $('#tsp_id').val(response.data.id);
                    }
                });
            });
            $('#change-pass-tstd').on('click', function(e) {
                e.preventDefault();
                var tsp_id = $('#tsp_id').val();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var confirm_password = $('#confirm_password').val();

                var formData = new FormData();
                formData.append('oldpassword', oldpassword);
                formData.append('newpassword', newpassword);
                formData.append('confirm_password', confirm_password);
                formData.append('tsp_id', tsp_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('teachers/students/password-update/') }}",
                    data: formData,
                    success: function(response) {
                        console.log(response.msg);
                        alert(response.msg);
                        window.location.reload();
                    },
                    error: function(error) {
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


        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $search = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ url('teachers/students') }}",
                    data: {
                        search: $search
                    },
                    success: function(response) {

                    }
                });
            });
        });
    </script>
@endsection
