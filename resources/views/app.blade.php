<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>


    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Conference Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('client.conferences.index') }}">Client Conferences</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('employee.conferences.index') }}">Employee Conferences</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        </li>

      </ul>
 
    </div>
  </div>
</nav>


    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="bg-gray py-4 text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 BPV. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
