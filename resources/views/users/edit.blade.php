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
    <form action="/profile/reform" method="POST">
        @csrf
        <h3>Update Teacher Account</h3>
        <h4>Teacher Information</h4>
        <div class="row">
            <div class="col-md-6">
                <p>Firstname:</p>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="{{$staff->firstname}}" required/>
            </div>
            <div class="col-md-6">
                    <p>Lastname:</p>
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="{{$staff->lastname}}" required/>
            </div>
            <div class="col-md-6">
                <p>Username:</p>
                <input type="text" name="username" id="username" placeholder="Username" value="{{$staff->username}}" required/>
            </div>
            <div class="col-md-6">
                <p>Phone Number:</p>
                <input type="text" name="mobile" id="mobile" placeholder="080XXXXXXXX" value="{{$staff->mobile}}" required/>
                <input type="hidden" name="user_id" value="{{$staff->id}}"/>
            </div>
        </div>
        <input type="submit" name="submit" value="Update Teacher Account"/>
    </form>
    </div>
@endsection