<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mastared Learning</title>
        <!-- <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        {!! Html::style('bootstrap/css/bootstrap.min.css') !!}
        <!-- <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet"> -->
        {!! Html::style('bootstrap/css/bootstrap-responsive.min.css') !!}
        <!-- <link type="text/css" href="css/theme.css" rel="stylesheet"> -->
        {!! Html::style('css/theme.css') !!}
        <!-- <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet"> -->
        {!! Html::style('images/icons/css/font-awesome.css') !!}
        <!-- <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'> -->
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600') !!}
        {!! Html::script('https://code.jquery.com/jquery-3.2.1.slim.min.js') !!}
        {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') !!}
    </head>
    <body>
    @include('layouts.navbar')
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                    @include('layouts.sidebar')
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                        @yield('content')
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        @include('layouts.portalfoot')
      
    </body>
