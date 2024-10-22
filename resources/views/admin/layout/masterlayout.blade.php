
<!DOCTYPE html>
<html lang="en">

@include('admin.common.header')

<body id="page-top">

    <!-- Page Wrapper -->
    @include('admin.common.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
    @include('admin.common.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
    @yield('page')
            <!-- End of Main Content -->

            <!-- Footer -->
    @include('admin.common.footer')

    @include('admin.common.footerjs')

</body>

</html>
