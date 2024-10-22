<!DOCTYPE html>
<html lang="en">

@include('admin.common.header')
@section('title','register')

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{ url('register_data') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" value="{{old('name')}}" name="name" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Enter Name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="role_id" class="form-select form-control"
                                            aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="2">Teachers</option>
                                            <option value="3">Students</option>
                                            {{-- @foreach ($data as $row)
                                                <option value="{{ $row->id}}">{{ $row->user_type }}</option>
                                            @endforeach --}}
                                        </select>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" value="{{old('email')}}" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{old('phone')}}" name="phone" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Contact Number">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                             </form>

                            <div class="text-center">
                                <a class="small" href="{{ url('admin/login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('admin.common.footerjs')


</body>

</html>
