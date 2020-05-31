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
<a href="{{ route('classes.create') }}" class="btn btn-secondary" id="course_button">Create New Class</a>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Assign Teacher To Class <span id="ctcn"></span></h3>
    <form action="/class/assign" method="POST">
    @csrf
        <p>Select Class Teacher</p>
        <select name="user_id" required>
            <option value="">Select Teacher</option>
            @foreach ($class_teachers as $teacher)
            <option value="{{$teacher['id']}}">{{$teacher['firstname'].' '.$teacher['lastname'].': '.$teacher['username']}}</option>
            @endforeach
        </select>
        <input type="hidden" name="class_id" id="selectclass"/>
        <input type="submit" name="submit" value="Assign"/>
    </form>
  </div>

</div>
<h1 class="my-4">All Classes</h1>
@if(count($classes) > 0)
<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Class Name</th>
            <th scope="col">Class Level</th>
            <th scope="col">Class Teacher</th>
            <th scope="col">Class Settings</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($classes as $class)
                <tr>
                    <td><a href="{{ route('students', [$class->id]) }}">{{ $class->class_name }}</a></td>
                    <td>{{ $class->class_level }}</td>
                    @if($current_term != null)
                        @if($class->teacher_info == null)
                        <td>
                            <span>No Class Teacher</span>
                        </td>
                        <td>
                            <button type="button" id="startbut" data-id="{{ $class->id }}" data-name="{{ $class->class_name }}" class="btn btn-secondary cont_but startbut">Assign Class Teacher</button>
                        </td>
                        @else
                        <td>
                            {{ $class->teacher_info['firstname'].' '.$class->teacher_info['lastname'] }}
                        </td>
                        <td>
                            <button type="button" id="startbut" data-id="{{ $class->id }}" data-name="{{ $class->class_name }}" class="btn btn-secondary cont_but startbut">Change Class Teacher</button>
                        </td>
                        @endif  
                    @else
                    <td>
                        <span>No Class Teacher</span>
                    </td>
                    <td>
                    <span>Start Term To Assign Teacher To Class</span>
                    </td>
                    @endif
                </tr>
            @endforeach

        </tbody>
</table>
@else
<h4 style="text-align:center;">You are yet to create a class</h4>
@endif
<script>
    $(".startbut").on("click", function(){
            $('#myModal').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#selectclass').val(dataId);
            $('#ctcn').text(dataname);
    });

    $(".close").on("click", function(){
            $('#myModal').css("display", "none");
            $('#secModal').css("display", "none");
            $('#secModal2').css("display", "none");
    });
</script>
@endsection