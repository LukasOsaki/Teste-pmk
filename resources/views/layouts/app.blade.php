<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    @yield('css')
</head>

<body>
    <nav class="navbar bg-body-tertiary" style="background: #01b1af !important;">
        <div class="container-fluid" style="background: #01b1af;">
          <a class="navbar-brand" href="{{route('index')}}">Home</a>
        </div>
      </nav>
    <div class="container" style="padding: 20px">
        <div class="card">
            @yield('content')
        </div>
    </div>
    {{-- Scripts --}}
     {{-- JQuery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
     {{-- DataTables --}}
     <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
     <script>
         $(document).ready(function() {
             $('.datatables').DataTable({
                 language: {
                     url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
                 }
             });
         })
     </script>
     @yield('js')
</body>

</html>
