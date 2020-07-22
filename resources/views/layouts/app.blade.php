<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Сервис публиций текстовых копий</title>
    
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link type="text/css" rel="stylesheet" href="{!! asset('sh/styles/shCoreDefault.css') !!}"/>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Главная
                </a>
                @if (!Auth::guest())
                <a class="navbar-brand" href="{{ url('/pages') }}">
                    >>Мои копии
                </a>  
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Войти</a></li>
                        <li><a href="{{ url('/reg') }}">Регистрация</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <div style="width:80%;float:left;">
            @yield('content')
        </div>
        <div style="width:20%;float:left;">
            <div>
                <div>
                    <div class="panel panel-default">
                        <div class="panel-body">                    
                            <form action="{{ url('/find') }}" method="GET" class="form-horizontal">
                                <label for="find" class="col-sm-3 ">Поиск</label>
                                <input type="text" name="find" id="find" class="form-control" value="{{ old('find') }}">
                                <button type="submit" class="btn btn-default">
                                    Поиск
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- Last public pastes -->
                    @if (count($pastes) > 0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Последние публичные копии
                            </div>

                            <div class="panel-body">
                                <table class="table table-striped task-table">
                                    <tbody>
                                        @foreach ($pastes as $paste)
                                            <tr>
                                                <td class="table-text">
                                                    <a href="{{ url('/' . $paste->link)}}"><div>{{ trim($paste->name)==''?'Без названия':$paste->name }}</div></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif            
                </div>
                <div>
                    <!-- Last public pastes -->
                    @if (!Auth::guest() && count($user_pastes) > 0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Мои копии
                            </div>

                            <div class="panel-body">
                                <table class="table table-striped task-table">
                                    <tbody>
                                        @foreach ($user_pastes as $paste)
                                            <tr>
                                                <td class="table-text">
                                                    <a href="{{ url('/' . $paste->link)}}"><div>{{ trim($paste->name)==''?'Без названия':$paste->name }}</div></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif            
                </div>                
            </div>
        </div>
    </div>    

    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('is')
</body>
</html>
