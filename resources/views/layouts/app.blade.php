<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{asset('sui/semantic.min.css')}}" rel="stylesheet">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
            min-height:100%;
                  background: #eee; /* Fills the page */
        }
               html{
  max-width: 1400px;
  margin: 0 auto;
      background: #eee; /* Fills the page */
  position: relative; /* Fix for absolute positioning */
}


#content {
    padding: 12px;

}

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body >


<div class = 'ui stacked segment'>
<div class="ui grid">
  <div class="ten wide column">
      <img src="{{asset('img/jizanbanner.jpg')}}">
  </div>
    <div class="three wide column">
    <br>
    <br>
<div class="ui item brown category search">
  <div class="ui icon input">
    <input class="prompt" type="text" placeholder="Search products...">
    <i class="search icon"></i>
  </div>
  <div class="results"></div>
</div>
  </div>
  <div class="three wide column">
        <div class="right aligned secondary menu">        
       <div class="item">
            @if (Auth::guest())
                <a class='ui primary button' href="{{ url('/login') }}">Login</a>
            @else
                <div class="ui dropdown item">
                    {{ Auth::user()->name }} <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class='ui item' href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                    </div>
                </div>
            @endif
        </div><br>
                <a class="ui large label">
  <i class="large brown cart icon"></i>
  
  AED 11,000
</a>
    </div>


  </div>

</div>


    <div class="ui pointing inverted brown secondary menu">
        <div class="item">
            
        </div>
        <a class='active item' href="{{ url('/home') }}"><i class="home icon"></i> Home</a>
        <a class='item' href="{{ url('/items') }}"><i class="cubes icon"></i> Items</a>
    </div>
</div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{asset('sui/semantic.min.js')}}"></script>
    
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script>
     $('.dropdown').dropdown();
    </script>
</body>
</html>
