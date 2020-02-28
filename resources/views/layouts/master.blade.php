<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>Hello, world!</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/dashboard') }}">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03"
      aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample03">
      <ul class="navbar-nav mr-auto">
        <li class="{{ request()->is('dashboard') ? 'nav-item active' : 'nav-item'}}">
          <a class="nav-link" href="{{ url('/dashboard') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="{{ request()->is('*category*') ? 'nav-item active' : 'nav-item'}}">
          <a class="nav-link" href="{{ url('/category') }}">Category</a>
        </li>
        <li class="{{ request()->is('brand*') ? 'nav-item active' : 'nav-item'}}">
          <a class="nav-link" href="{{ url('/brand') }}">Brand</a>
        </li>
        <li class="{{ request()->is('products*') ? 'nav-item active' : 'nav-item'}}">
          <a class="nav-link" href="{{ url('/products') }}">Products</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/" target="_blank">Website</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ URL::to('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              
              <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
            </a> --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        @yield('admin_content')
      </div>
    </div>
  </div>
</body>
<script src="{{ asset('js/input.js') }}"></script>
<script>
  $(document).ready(function(){
    setTimeout(function(){ $(".alert").alert("close"); }, 5000);
  })
</script>

</html>