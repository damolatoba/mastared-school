@extends('layouts.index')
@section('content')
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<h1 class="my-4">{{ $course->title }}</h1>
<p><b>{{ $course->subject }}</b></p>
<p><b>{{ date('l, d M Y',(strtotime($course->start_date))) }}</b></p>
@if(count($students) > 0)
<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Student</th>
            <th scope="col">Start Date&Time</th>
            <th scope="col">Complete Date&Time</th>
            <th scope="col">Duration</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td style="text-transform:capitalize;">{{ $student->info['firstname'].' '.$student->info['lastname'] }}</td>
                    <td>
                        @if(isset($student->attendance['created_at']))
                        {{ date('l, d M Y H:i:s A',(strtotime($student->attendance['created_at']))) }}
                        @endif
                    </td>
                    <td>
                        @if($student->attendance['status'] == 2)
                        {{ date('l, d M Y H:i:s A',(strtotime($student->attendance['updated_at']))).' '.$student->attendance['status'] }}
                        @endif
                    </td>
                    <td>{{ date('H:i:s', (strtotime($student->attendance['updated_at'])-strtotime($student->attendance['created_at']))) }}</td>
                </tr>
            @endforeach

        </tbody>
</table>
@else
<h4 style="text-align:center;">No Students registered to this class.</h4>
@endif
@endsection