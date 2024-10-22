@extends('admin.layout.masterlayout')
@section('title','student dashboard')
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
        <!-- Content Row -->
        <div class="row">


            <!-- Earnings (Monthly) Card Example -->

            <!-- Earnings (Monthly) Card Example -->

            <!-- Earnings (Monthly) Card Example -->


            <!-- Pending Requests Card Example -->

        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->


            <!-- Pie Chart -->

        </div>

        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

    </div>
@endsection
