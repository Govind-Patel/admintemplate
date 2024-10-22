@extends('admin.layout.masterlayout')
@section('title', 'students')
@section('page')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>
        </div>
        <div id="msgsuccess"></div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->address }}</td>
                            <td><img src="/image/{{ $data->image }}" height="80" alt=""></td>
                            <td><button data-id="{{ $data->id }}" class="btn btn-primary editbtn"
                                    value="{{ $data->id }}">Edit</button>
                                <button value="{{ $data->id }}" class="studentpass btn btn-info">Change-Password</button>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    {{-- modal update --}}
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">update student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="std_id" id="std_id">
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control form-control-user"
                                placeholder="Enter Name">
                            <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control form-control-user"
                                placeholder="Email Address">
                            <span class="text-danger" id="error-email"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" class="form-control form-control-user"
                                placeholder="Contact Number">
                            <span class="text-danger" id="error-phone"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" id="address" name="address" class="form-control form-control-user"
                                placeholder="Address">
                            <span class="text-danger" id="error-address"></span>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="image" class="form-control" placeholder="image">
                            <span class="text-danger" id="error-image"></span>
                        </div>

                        <button type="submit" id="studentform" name="submit" class="submit btn btn-primary">
                            Update
                        </button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" name="update" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    {{-- password modal --}}
    <div class="modal fade" id="studentpassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="pform" method="POST">
                        @csrf
                        <input type="hidden" name="sp_id" id="sp_id">

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

                        <button type="submit" id="change-pass-std" name="submit" class="btn btn-primary">Update
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
            $('.editbtn').on('click', function() {
                var std_id = $(this).val();
                // alert(std_id);
                $('#userModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/students/edit/" + std_id,
                    success: function(re) {
                        // console.log(re.student.name);
                        $('#name').val(re.student.name);
                        $('#email').val(re.student.email);
                        $('#phone').val(re.student.phone);
                        $('#address').val(re.student.address);
                        $('#std_id').val(std_id);
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
                var std_id = $('#std_id').val();

                var formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('address', address);
                formData.append('image', image);
                formData.append('std_id', std_id);

                $.ajax({
                    contentType: false,
                    processData: false,
                    type: "POST",
                    url: "{{ url('students/update') }}",
                    data: formData,
                    success: function(response) {
                        // console.log(response.success);
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors.namne);
                        // alert(error.responseJSON.errors.name);
                        $('#error-name').text(error.responseJSON.errors.name);
                        $('#error-email').text(error.responseJSON.errors.email);
                        $('#error-phone').text(error.responseJSON.errors.phone);
                        $('#error-address').text(error.responseJSON.errors.address);
                        $('#error-image').text(error.responseJSON.errors.image);
                        setTimeout(() => {
                            window.location.reload();
                        }, 4000);
                    }
                });
            });

            $('.studentpass').on('click',function(e){
                e.preventDefault();
                $('#pform').trigger("reset");
                $('#studentpassModal').modal('show');
                var sp_id = $(this).val();
                $.ajax({
                    type:"GET",
                    url:"/students/password/"+sp_id,
                    data:{sp_id:sp_id},
                    success:function(response){
                        $('#sp_id').val(response.data.id);
                    }
                });
            });

            $('#change-pass-std').on('click',function(e){
                e.preventDefault();
                var oldpassword = $('#oldpassword').val();
                var newpassword = $('#newpassword').val();
                var confirm_password = $('#confirm_password').val();
                var sp_id = $('#sp_id').val();

                var formData = new FormData();
                formData.append('oldpassword',oldpassword);
                formData.append('newpassword',newpassword);
                formData.append('confirm_password',confirm_password);
                formData.append('sp_id',sp_id);
                $.ajax({
                    contentType: false,
                    processData: false,
                    type:"POST",
                    url:"{{url('students/password/update/')}}",
                    data:formData,
                    success:function(response){
                        console.log(response.message)
                        alert(response.message);
                        window.location.reload();
                    },
                    error:function(error){
                        $('#error-oldpassword').text(error.responseJSON.errors.oldpassword);
                        $('#error-newpassword').text(error.responseJSON.errors.newpassword);
                        $('#error-confirm_password').text(error.responseJSON.errors
                            .confirm_password);
                        setTimeout(() => {
                            $('.text-danger').html('');;
                        }, 4000);
                    }
                });
            });
        });
    </script>
@endsection
