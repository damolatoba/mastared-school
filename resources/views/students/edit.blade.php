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
        <h3>Update Student Account</h3>
        <h4>Student Information</h4>
        <div class="row">
            <div class="col-md-6">
                <p>Firstname:</p>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="{{$user->firstname}}" required/>
            </div>
            <div class="col-md-6">
                    <p>Lastname:</p>
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="{{$user->lastname}}" required/>
            </div>
            <div class="col-md-6">
                <p>Username:</p>
                <input type="text" name="username" id="username" placeholder="Username" value="{{$user->username}}" required/>
            </div>
            <div class="col-md-6">
                <p>Phone Number:</p>
                <input type="text" name="mobile" id="mobile" placeholder="080XXXXXXXX" value="{{$user->mobile}}" required/>
                <input type="hidden" name="user_id" value="{{$user->id}}" required/>
                <input type="hidden" name="class_id" value="{{$class->id}}" required/>
            </div>
        </div>
        <input type="submit" name="submit" value="Update Student Account Account"/>
    </form>
    </div>
@endsection