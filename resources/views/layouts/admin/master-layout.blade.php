<!DOCTYPE html>
<html lang="en">

<head>

  @include('layouts.admin.includes.meta')

  <title>PM-Encoder-IT</title>

  @include('layouts.admin.includes.css')

  @yield('header-script')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.admin.includes.sidebar')

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layouts.admin.includes.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('layouts.admin.includes.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>


    @include('layouts.admin.includes.js')
    @yield('footer-script')
</body>

</html>
