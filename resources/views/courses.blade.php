@extends('layouts.index')
@section('content')
<style>

input[type="submit"] {
    background-color: #666666;
    max-width:75px;
    padding:5px 10px;
}

input[type="date"] {
    width:300px;
    padding:5px 10px;
}

#startdate {
    margin-top:10px;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #666666;
  color: white;
}

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

@if (Auth::check() && (Auth::user()->role->first()->name == 'Author'))
    <a href="{{ route('course.create') }}" class="btn btn-secondary" id="course_button">Add New Course</a>


<div id="delmod" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 style="color:#800000;">Please Confirm</h2>
        <p>Are you sure you want to delete the lecture <span id="course_course" style="text-transform: capitalize;color:#cc0000;font-weight:600;"></span> from the subject <span id="course_subject" style="text-transform: capitalize;color:#cc0000;font-weight:600;"></span></p>
        <form action="/course/softdelete" method="POST">
        @csrf
            <input type="hidden" name="course_id" id="course_id"/>
            <input type="submit" name="submit" value="Delete"/>
        </form>
    </div>  

</div>
    <div class="container" id = "coursescontent">
    <div class="row">
        <div class="col-md-12">
        <h1 class="my-4">Lecture Notes</h1>
            <form method="POST"action="home" >
            @csrf
                <input type="date" name="filtdate" required/>
                <input type="submit" name="submit" value="Filter"/>
            </form>
            @if ($courses->isEmpty())
                @if (session('course'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('course') }}
                        </h2>
                    </div>
                @endif
            @else
            <table id="customers">
                <tr>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @foreach ($courses as $course)
                <tr>
                    <td><h2 class="titlecard"><a href = "{{ route('course.show', [$course->id]) }}">{{ $course['title'] }}</a></h2></td>
                    <td>{{$course->subject}}</td>
                    <td><a href="{{ route('course.edit', [$course->id]) }}" class="btn btn-secondary cont_but" id="startdate">Edit</a></td>
                    <td><button type="button" data-id="{{ $course->id }}" data-course="{{ $course->title }}" data-subject="{{ $course->subject }}" class="btn btn-secondary but_del" id="startdate">Delete</button></td>
                </tr>
            @endforeach
            </table>
            @endif
        </div>
    </div>
</div>
@endif

@if (Auth::check() && (Auth::user()->role->first()->name == "Admin"))
    <div class="container" id = "coursescontent">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Lecture Notes</h1>
            <form method="POST"action="home" >
            @csrf
                <input type="date" name="filtdate" required/>
                <input type="submit" name="submit" value="Filter"/>
            </form>
            @if ($courses->isEmpty())
                @if (session('course'))
                    <div class="card-body">
                        <h2 class="alert alert-info">
                            {{ session('course') }}
                        </h2>
                    </div>
                @endif
            @else
            <table id="customers">
                <tr>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Teacher</th>
                </tr>
                @foreach ($courses as $course)
                <tr>
                    <td><p style="text-transform:capitalize;"><a href = "{{ route('course.show', [$course->id]) }}">{{ $course['title'] }}</a></p></td>
                    <td><span style="text-transform:capitalize;">{{$course->subject}}</span></td>
                    <td>{{$course->class}}</td>
                    <td><span style="text-transform:capitalize;">{{$course->teacher->firstname.' '.$course->teacher->lastname}}</span></td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
</div>
@endif
<script>
    $(".but_del").on("click", function(){
            $('#delmod').css("display", "block");
            var dataId = $(this).attr("data-id");
            var dataCourse = $(this).attr("data-course");
            var dataSubject = $(this).attr("data-subject");
            $('#course_id').val(dataId);
            $('#course_course').text(dataCourse);
            $('#course_subject').text(dataSubject);
    });

    $(".close").on("click", function(){
            $('#delmod').css("display", "none");
    });
</script>

@endsection