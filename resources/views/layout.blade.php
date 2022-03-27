<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" crossorigin="anonymous">
    {{-- custom --}}
    <link rel="stylesheet" href="{{asset('custom.css')}}">
    {{-- icon title --}}
    <link rel="shortcut icon" href="{{asset('assets/bogor.png')}}" />
    <title>Pengaduan Masyarakat</title>
  </head>
  <body>
    <nav class="navbar" style="background: #FFB72B; color: #fff">
        <a class="navbar-brand mb-0 h1 text-white" href="{{route('index')}}">Aspirasi Masyarakat Kab. Bogor</a>
        @if (auth()->user())
            <a href="{{route('logout')}}" class="text-white" onclick="return confirm(`Yakin untuk logout dari akun {{auth()->user()->name}} ?`)">Logout</a>
        @else
            <a href="{{route('check_for_login')}}" class="text-white">Administrator</a>
        @endif
    </nav>

    <div>
        @yield('content')
    </div>

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    {{-- datatables --}}
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
  </body>
</html>