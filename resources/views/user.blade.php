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
</style>
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<a href="{{ route('user.create') }}" class="btn btn-secondary" id="course_button">Create New Teacher Account</a>
<!-- Delete -->
<div id="myDel" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Delete Staff Account</h3>
    <form action="/user/delete" method="POST">
    <p>Are you sure you want to delete <span id="deltss" style="color:#3250a8;font-weight:600;text-transform: capitalize;"></span></p>
    @csrf
        <input type="hidden" name="user_id" id="subId"/>
        <input type="submit" name="submit" value="Delete"/>
    </form>
  </div>

</div>
<h1 class="my-4">All Teachers</h1>

    @if($users->isEmpty())
    <h4 style="text-align:center;">You currently have no teachers registered</h4>
    @else
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Class</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td style="text-transform: capitalize;">{{ $user->firstname.' '.$user->lastname }}</td>
                    <td>{{ $user->username }}</td>
                    <td><a class="btn btn-secondary" href="{{ url('user/edit/'.$user->id) }}">Edit</a></td>
                    <td><a class="btn btn-secondary delbut" data-id="{{ $user->id }}" data-name="{{ $user->firstname.' '.$user->lastname }}">Delete</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
    @endif
<script>
    $(".delbut").on("click", function(){
            $('#myDel').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#subId').val(dataId);
            $('#deltss').text(dataname);
    });

    $(".close").on("click", function(){
            $('#myDel').css("display", "none");
    });
</script>
@endsection