@extends('layouts.portal')
@section('content')
<style>

    input[type=password] {
        width: 100%;
        padding: 22px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        text-align: right;
        background-color: dodgerblue;
    }
</style>
<div class="module">
    <div class="module-head">
        <h3 style="text-transform: capitalize;">Password Change</h3>
    </div>
    <div class="module-body">
        <div class="profile-head media" style="padding:10px 20px;">
        <form action="/changepassword" method="POST">
        @csrf
        @if (session('error_message'))
            <div class="card-body">
                <div class="alert alert-danger">
                    {{ session('error_message') }}
                </div>
            </div>
        @endif
        <p>Current Password</p>
        <input type="password" name="current_password" placeholder="Current Password" required/>
        <hr/>
        @if (session('error_message2'))
            <div class="card-body">
                <div class="alert alert-danger">
                    {{ session('error_message2') }}
                </div>
            </div>
        @endif
        <p>New Password</p>
        <input type="password" name="new_password" placeholder="New Password" required/>
        <p>Confirm Password</p>
        <input type="password" name="confirm_password" placeholder="Comfirm Password" required/>
        <input type="submit" name="submit" value="Change Password"/>
        </form>
        </div>
    </div>
</div>
@endsection