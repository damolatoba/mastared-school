@extends('layouts.index')
@section('content')
<style>
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  max-width: 40%;
  text-align: center;
}

.close {
    text-align: right;
}

input[type="submit"] {
    background-color: #4287f5;
}

</style>
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
@if (session('error_message'))
    <div class="card-body">
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
    </div>
@endif
@if (session('error_message2'))
    <div class="card-body">
        <div class="alert alert-danger">
            {{ session('error_message2') }}
        </div>
    </div>
@endif
<button type="button" id="cont_butt" class="btn btn-secondary">Change Password</button>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Change Password</h3>
    <form action="/changepassword" method="POST">
    @csrf
        <p>Current Password</p>
        <input type="password" name="current_password" placeholder="Current Password" required/>
        <hr/>
        <p>New Password</p>
        <input type="password" name="new_password" placeholder="New Password" required/>
        <p>Confirm Password</p>
        <input type="password" name="confirm_password" placeholder="Comfirm Password" required/>
        <input type="submit" name="submit" value="Change Password"/>
    </form>
  </div>

</div>

<div style="padding:10px; 40px;">
    <h4 class="my-4">Profile</h4>
    <div style="text-align:center;">
        <p><b>Full Name: </b>{{$personal->firstname.' '.$personal->lastname}}</p>
        <p><b>Username: </b>{{$personal->username}}</p>
        <p><b>Current Term: </b>{{$term->term_name}} <b> &nbsp; &nbsp; {{ date('l, d M Y',(strtotime($term->start_date))) }} &nbsp; <b>To:</b> {{ date('l, d M Y',(strtotime($term->end_date))) }}</b></p>
        @if(Auth::user()->role->first()->name == 'Author')
            <p><b>Class: </b>{{$class->class_name}}</p>
        @endif
        @if(Auth::user()->role->first()->name == 'Admin')
            <p><b>Role: </b>Administrator</p>
        @endif
    </div>
</div>

<script type="text/javascript">
    $("#cont_butt").on("click", function(){
        $('#myModal').css("display", "block");
    });

    $(".close").on("click", function(){
        $('#myModal').css("display", "none");
    });

</script>

@endsection