@extends('layouts.index')
@section('content')
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-danger">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
    <div class="container">
    <form action="/staffs/store" method="POST">
        @csrf
        <h3>Create A New Teacher Account</h3>
        <span>Please note that default account pass word is mastared@2020</span>
        <h4>Teacher Information</h4>
        <div class="row">
            <div class="col-md-6">
                <p>Firstname:</p>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname" required/>
            </div>
            <div class="col-md-6">
                    <p>Lastname:</p>
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" required/>
            </div>
            <div class="col-md-6">
                <p>Username:</p>
                <input type="text" name="username" id="username" placeholder="Username" required/>
            </div>
            <div class="col-md-6">
                <p>Phone Number:</p>
                <input type="text" name="mobile" id="mobile" placeholder="080XXXXXXXX" required/>
            </div>
        </div>
        <input type="submit" name="submit" value="Create Teacher Account"/>
    </form>
    </div>
@endsection