<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- title placeholder -->
    <title>@yield('title')</title>

    <!-- CSS for masterpage goes here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <!-- JS for masterpage goes here -->
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- inline CSS -->
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color:#f7f7f7;
        }
        .navbar{
            background-color: #f7344b;
        }
        .dropdown-menu{
            background-color: #f7344b;
        }
        .navbar-brand{
            color: white;
        }
        .nav-link{
            color: white;
        }
        .navbar-brand:hover{
            color: white;
        }
        .nav-link:hover{
            color: white;
        }

        .dropdown-item:hover{
            background-color: #f7344b;
            color: white;
        }
    </style>

    <!-- CSS placeholder -->
    @yield('css_placeholder')

    <!-- JS placeholder1 -->
    @yield('js_placeholder1')

</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg d-flex flex-row justify-content-between">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="{{asset('storage/img/PHizzaHutLogo.jpg')}}" alt="PHizzaHutLogo.jpg" width="30" height="30" class="d-inlign-block align-top">
                PHizza Hut
            </a>
            @if(!\Illuminate\Support\Facades\Auth::check())
            <!----------------- for guest ----------------->
            <!------------------------------------------------>
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">|</span>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link"  href="/register">Register</a>
                    </li>
                </ul>
            <!------------------------------------------------->
                
            @else
            <!----------------- for customer and admin ----------------->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav d-flex flex-row ml-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">View Transaction History</a>
                         <!-- if admin --> 
                        <a class="nav-link" href="#">View All User Transaction</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">|</span>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link"  href="#">View Cart</a>
                         <!-- if admin -->
                        <a class="nav-link"  href="#">View All User</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">|</span>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right mt-1" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-item">
                                <a class="nav-link" href="#">Action</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="#">Action</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="#">Action</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>

    <!-- content placeholder -->
    @yield('content_placeholder')

    <!-- JS placeholder2 -->
    @yield('js_placeholder2')

</body>
</html>