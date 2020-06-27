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
<a type="button" class="btn btn-secondary" href="{{ url('/profile/edit/'.$user->id) }}">Edit</a>
<button type="button" id="cont_butt" class="btn btn-secondary cont_butt" data-id="{{$user->id}}" data-name="{{$user->firstname.' '.$user->lastname}}">Delete</button>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Delete Profile</h3>
    <form action="/user/delete" method="POST">
    <p>Are you sure you want to delete <span id="deltss" style="color:#3250a8;font-weight:600;text-transform: capitalize;"></span></p>
    @csrf
        <input type="hidden" name="user_id" id="subId"/>
        <input type="hidden" name="class_id" value="{{$class->id}}"/>
        <input type="submit" name="submit" value="Delete"/>
    </form>
  </div>

</div>

<div style="padding:10px; 40px;">
    <h4 class="my-4">Profile</h4>
    <div style="text-align:center;">
        <p><b>Full Name: </b><span style="text-transform:capitalize;">{{$user->firstname.' '.$user->lastname}}</span></p>
        <p><b>Username: </b>{{$user->username}}</p>
        <p><b>Current Term: </b>{{$term->term_name}} <b> &nbsp; &nbsp; {{ date('l, d M Y',(strtotime($term->start_date))) }} &nbsp; <b>To:</b> {{ date('l, d M Y',(strtotime($term->end_date))) }}</b></p>
        <p><b>Current Class: {{ $class->class_name }}</b></p>
        <p"><b>Class Level: {{ $class->class_level }}</b></p>
        @if($teacher != null)
            <p><b>Class Teacher: </b>{{ $teacher->firstname.' '.$teacher->lastname }}</p>
        @else
        <p><b>Class Teacher: </b>No Class Teacher</p>
        @endif
    </div>
</div>

<script type="text/javascript">

    $(".cont_butt").on("click", function(){
            $('#myModal').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#subId').val(dataId);
            $('#deltss').text(dataname);
    });

    $(".close").on("click", function(){
            $('#myModal').css("display", "none");
    });

</script>

@endsection