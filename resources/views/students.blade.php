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
<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($students as $key => $student)
                <tr>
                    <td>{{ $key+1 }}</td>
                    @if (Auth::check() && (Auth::user()->role->first()->name == 'Author'))
                    <td><span style="text-transform: capitalize;">{{ $student->firstname.' '.$student->lastname }}</span></td>
                    @endif
                    @if (Auth::check() && (Auth::user()->role->first()->name == 'Admin'))
                    <td><span style="text-transform: capitalize;"><a href="{{url('/profile/'.$student->id)}}">{{ $student->firstname.' '.$student->lastname }}</a></span></td>
                    @endif
                    <td>{{ $student->username }}</td>
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

    $(".close").on("click", function(){
            $('#myModal').css("display", "none");
    });
</script>
@endsection