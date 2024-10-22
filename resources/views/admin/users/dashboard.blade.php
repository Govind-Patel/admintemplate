@extends('admin.layout.masterlayout')
@section('title', 'dashboard')
@section('page')
    <style>
        .anyClass {
            height: 500px;
            overflow-y: scroll;
        }
    </style>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard {{ session()->get('loginUser')->role->user_type }}</h1>

        </div>
        <div class="">
            {{-- <button id="add-model" class="btn btn-success">Add User</button> --}}
        </div>
        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif --}}
    </div>
    <!-- /.container-fluid -->
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-3">
                <h5 class="text-center">User List</h5>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="anyClass">
                    <table class="table">
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td><button value="{{$row->id}}"  type="button" id="chat_btn" class="chat_btn btn"><img src="/image/{{ $row->image }}"
                                                class="rounded-circle " height="80" width="80" alt=""></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" id="chat_box" style = "visibility:hidden">
                    <h4 class="card-title p-3" id="user_name"></h4>
                    <div class="card-body">

                        <form action=" " id="chatform" method="type">
                            <input type="hidden" id="to_user_id" value="" />
                            <div class="form-group">
                                <input class="form-control" name="chat" id="chat" placeholder="Write your message here...">
                                <button class="btn btn-primary btn-sm mt-1" id="chat_save" type="button">
                                    <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></button>
                            </div>
                    </form>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="card" id="chatData" style = "visibility:hidden">
                    <div class="card-body">
                        <p class="chatheading"></p>
                        <input type="text" id="chat_id">
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <h4>notification receved</h4>
                <div class="" style="height: 250px;  overflow-y: scroll;">
                    <table class="table">
                        <tbody>
                            @foreach ($data1 as $row)
                                <tr>
                                    <td>{{$row->user->name}}</td>
                                    <td >{{$row->status}}</td>
                                    <td><a href=""><img src="/image/{{$row->user->image}}" class="rounded-circle" height="60" width="60" alt=""></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>
    </div>

    <!-- Modal update-->
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
                                <input type="text" value="{{ old('name') }}" name="name"
                                    class="form-control form-control-user" id="name" placeholder="Enter Name">
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
                            <input type="email" value="{{ old('email') }}" name="email"
                                class="form-control form-control-user" id="email" placeholder="Email Address">
                            <span id="error-email" class="text-danger"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user" id="password"
                                    placeholder="Password">
                                <span id="error-password" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <input type="text" value="{{ old('phone') }}" name="phone"
                                    class="form-control form-control-user" id="phone" placeholder="Contact Number">
                                <span id="error-phone" class="text-danger"></span>
                            </div>

                            <button type="submit" id="user-save" value="add" name="submit"
                                class=" btn btn-primary btn-user btn-block">
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
@section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function(){
                $("div.alert").remove();
            },4000);
            $('#add-model').click(function() {
                $('#myform').trigger("reset");
                $('#user-Modal').modal('show');
            });
            $('#user-save').click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var phone = $('#phone').val();
                var role_id = $('#role_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/adduser') }}",
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
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        // alert('all fields required');
                        console.log(error.responseJSON.errors.name);
                        $('#error-name').text(error.responseJSON.errors.name);
                        $('#error-email').text(error.responseJSON.errors.email);
                        $('#error-password').text(error.responseJSON.errors.password);
                        $('#error-phone').text(error.responseJSON.errors.phone);
                        $('#error-role').text(error.responseJSON.errors.role_id);
                    }
                });
            });

            $('.chat_btn').on('click',function(){
                $('#chatform').trigger("reset");
                var to_user_id = $(this).val();
                // console.log(to_user_id);
                $.ajax({
                    type:"GET",
                    url:"/chatrequest/"+to_user_id,
                    data:{to_user_id:to_user_id},
                    success:function(data){
                        // console.log(data.data.name);
                        $('#user_name').text(data.data.name);
                        $('#to_user_id').val(data.data.id);
                    }
                });

            });
            $('#chat_save').on('click',function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                var userid = $('#to_user_id').val();
                var chat = $('#chat').val();
                // console.log(chat);
                $.ajax({
                    type:"POST",
                    url:"{{url('chat_save/')}}",
                    data:{userid:userid,chat:chat},
                    success:function(data){
                        $('.send_msg').text(data.message);
                        // console.log(data.message);
                        // alert(data.message);
                        $('#chatform').trigger("reset");
                    }
                });
            });
            $('.chat_btn').on('click',function(){
                var chat_id = $(this).val();
                $.ajax({
                    type:"GET",
                    url:"/chat/show/"+chat_id,
                    data:{chat_id:chat_id},
                    success:function(response){
                        // console.log(response.data.to_user_id);
                        if(response.data == undefined){
                            $('.chatheading').text('');
                        }else{
                            $('#chat_id').val(response.data.to_user_id);
                            $('.chatheading').text(response.data.chat);
                        }

                    }
                });
            });

        });

        const btn = document.getElementsByClassName('chat_btn');
        for (var i = 0 ; i < btn.length; i++)
        {
            btn[i].addEventListener('click' , () => {
            const chatbox = document.getElementById('chat_box');
            const chatData = document.getElementById('chatData');
            if (chatbox.style.visibility === 'hidden') {
                    chatbox.style.visibility = 'visible';
                }
                if (chatData.style.visibility === 'hidden') {
                    chatData.style.visibility = 'visible';
                }
            }) ;
        }


    </script>
@endsection
