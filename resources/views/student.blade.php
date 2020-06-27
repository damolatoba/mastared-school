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
<a href="{{ route('students.create') }}" class="btn btn-secondary" id="course_button">Create New Student Account</a>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Select Class <span id="ctcn"></span></h3>
    <form action="/student/assign" method="POST">
    @csrf
        <select name="class_id" required>
            <option value="">Select Class</option>
            @foreach ($classes as $class)
            <option value="{{$class['id']}}">{{$class['class_name'].'- Level '.$class['class_level']}}</option>
            @endforeach
        </select>
        <input type="hidden" name="user_id" id="student_id"/>
        <input type="submit" name="submit" value="Assign"/>
    </form>
  </div>

</div>


<div id="delmod" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Delete <span id="stud_name" style="text-transform: capitalize;"></span>'s account</h3>
    <form action="/student/harddelete" method="POST">
    @csrf
        <input type="hidden" name="user_id" id="stud_id"/>
        <input type="hidden" name="class_id" value="noclass"/>
        <input type="submit" name="submit" value="Delete"/>
    </form>
  </div>

</div>


<h1 class="my-4">Students With No Class</h1>

<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Enrolled Date</th>
            <th>Assign Class</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td><span style="text-transform: capitalize;">{{ $student->firstname.' '.$student->lastname }}</span></td>
                    <td>{{ $student->username }}</td>
                    <td>{{ $student->created_at->toFormattedDateString() }}</td>
                    <td><button type="button" id="startbut" data-id="{{ $student->id }}" class="btn btn-secondary cont_but startbut">Assign Class</button></td>
                    <td><button type="button" id="delstud" data-id="{{ $student->id }}" data-name="{{ $student->firstname.' '.$student->lastname }}" class="btn btn-secondary cont_but delstud">Delete</button></td>
                </tr>
            @endforeach

        </tbody>
      </table>
<script>
    $(".startbut").on("click", function(){
            $('#myModal').css("display", "block");
            var dataId = $(this).attr("data-id");
            $('#student_id').val(dataId);
    });
    
    $(".delstud").on("click", function(){
            $('#delmod').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#stud_id').val(dataId);
            $('#stud_name').text(dataname);
    });

    $(".close").on("click", function(){
            $('#myModal').css("display", "none");
            $('#delmod').css("display", "none");
    });
</script>
@endsection