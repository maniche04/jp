<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Login
    </title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{asset('sui/semantic.min.css')}}" rel="stylesheet">
    <style>
    @import url(//fonts.googleapis.com/css?family=Lato:700);

    a,
    a:visited {
        text-decoration: none;
    }
    h1 {
        font-size: 32px;
        margin: 16px 0 0 0;
    }
    body {
        background-image: url('{{asset("img/perfbck.jpg")}}');
        background-size:     cover;                     
        background-repeat:   no-repeat;
        background-position: center center; 
    }
    </style>
</head>
<body>

<div class="ui one column middle aligned relaxed fitted stackable grid" style="padding-right:18%;padding-left:50%; padding-top:10%;padding-bottom:1%">
        <div class="column">

            <div class="ui middle error form piled segment">
                <h2 class="ui brown header">
                  <i class="key icon"></i>
                <div class="content">
                    <img src = "{{asset('img/jizanbanner.jpg')}}">
                </div>

                </h2>

                <div class="ui brown divider"></div>

                <form action="{{ url('/login') }}" method = "POST">
                 {!! csrf_field() !!}

                 @if (($errors->has('email')) OR ($errors->has('password')))
                        <div class="ui error small icon message">
                            <i class="warning icon"></i>
                            <div class="content">
                                <div class="header">
                                    Access Denied!
                                </div>
                                @if ($errors->has('email'))
                                    <strong>{{ $errors->first('email') }}</strong>
                                @endif
                                @if ($errors->has('password'))
                                <br>
                                <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </div>
                        </div>
                @endif

                <div class="field">
                    <label>Email Address</label>
                    <div class="ui labeled icon input">
                        <i class="mail icon"></i>
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>


                <div class="field">
                    <label>Password</label>
                    <div class="ui labeled icon input">
                        <i class="lock icon"></i>
                        <input name="password" type="password">
                    </div>
                </div>
                <input type="submit" value="Login" class='ui submit inverted brown button'>

                </form>
            </div>
            @if (($errors->has('email')) OR ($errors->has('password')))
                <div class="ui bottom attached warning message">
                  <i class="icon info"></i>
                  Forgot your password? Kindly email : info@jizanperfumes.com
                </div>
            @endif


        </div>



    </div>

</body>






