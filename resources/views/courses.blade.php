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
                    <td><button type="button" data-id="{{ $course->id }}" data-name="{{ $course->title }}" class="btn btn-secondary cont_but" id="startdate">Delete</button></td>
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


@endsection