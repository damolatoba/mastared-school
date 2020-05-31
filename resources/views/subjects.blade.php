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
<a class="btn btn-secondary startbut" id="course_button">Create New Subject</a>

<!-- Create -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Create New Subject</h3>
    <form action="/subjects/create" method="POST">
    @csrf
        <input type="text" name="subject" placeholder="Subject"/>
        <input type="submit" name="submit" value="Create"/>
    </form>
  </div>

</div>

<!-- Edit -->
<div id="myEdit" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Edit Subject</h3>
    <form action="/subjects/edit" method="POST">
    @csrf
        <input type="text" name="subject" id="subname"/>
        <input type="hidden" name="sub_id" id="subid"/>
        <input type="submit" name="submit" value="Edit"/>
    </form>
  </div>

</div>

<!-- Delete -->
<div id="myDel" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Delete Subject</h3>
    <form action="/subjects/delete" method="POST">
    <p>Are you sure you want to delete <span id="deltss" style="color:#3250a8;font-weight:600;"></span></p>
    @csrf
        <input type="hidden" name="sub_id" id="subId"/>
        <input type="submit" name="submit" value="Delete"/>
    </form>
  </div>

</div>
<h1 class="my-4">All Subjects</h1>
@if(count($subjects) > 0)
<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Subject</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject }}</td>
                    <td><a class="btn btn-secondary editbut" data-id="{{ $subject->id }}" data-name="{{ $subject->subject }}">Edit</a></td>
                    <td><a class="btn btn-secondary delbut" data-id="{{ $subject->id }}" data-name="{{ $subject->subject }}">Delete</a></td>
                </tr>
            @endforeach

        </tbody>
</table>
@else
<h4 style="text-align:center;">You are yet to create a subject</h4>
@endif
<script>
    $(".startbut").on("click", function(){
            $('#myModal').css("display", "block");
    });

    $(".editbut").on("click", function(){
            $('#myEdit').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#subid').val(dataId);
            $('#subname').val(dataname);
    });

    $(".delbut").on("click", function(){
            $('#myDel').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#subId').val(dataId);
            $('#deltss').text(dataname);
    });

    $(".close").on("click", function(){
            $('#myModal').css("display", "none");
            $('#myEdit').css("display", "none");
            $('#myDel').css("display", "none");
    });
</script>
@endsection