<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>  
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @yield('css')


        <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('template/css/styles.css')}}" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        @if(session('status'))
            <script>
                swal("{{ session('status') }}");
            </script>    
        @endif  
      @include('layout.nav')
      <div id="layoutSidenav">
             @include('layout.sidebar')
             <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-3 px-4">
                        @if(session()->has('status'))
                            <div class="alert alert-success" role="alert">
                                    {{session('status')}}   
                            </div>                
                        @endif
                        @if(session()->has('danger'))
                            <div class="alert alert-danger" role="alert">
                                    {{session('danger')}}   
                            </div>                
                        @endif
                        @yield('content')
                    </div>        
                </main>
            </div>   
      </div>
      @include('layout.footer')

@yield('js')
<script src="{{asset('bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>
</html>


