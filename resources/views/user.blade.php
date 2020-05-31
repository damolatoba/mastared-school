@extends('layouts.index')
@section('content')
@if (session('flash_message'))
    <div class="card-body">
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    </div>
@endif
<a href="{{ route('user.create') }}" class="btn btn-secondary" id="course_button">Create New Teacher Account</a>

<h1 class="my-4">All Teachers</h1>

    @if($users->isEmpty())
    <h4 style="text-align:center;">You currently have no teachers registered</h4>
    @else
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Username</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Class</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td style="text-transform: capitalize;">{{ $user->firstname.' '.$user->lastname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>{{ $user->class }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    @endif
@endsection