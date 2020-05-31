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

@if (session('flash_message_danger'))
    <div class="card-body">
        <div class="alert alert-danger">
            {{ session('flash_message_danger') }}
        </div>
    </div>
@endif
<!-- <a href="{{ route('user.create') }}" class="btn btn-secondary" id="course_button">Create New Term</a> -->
<button type="button" id="cont_butt" class="btn btn-secondary">Create New Term</button>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Create A new Term</h3>
    <form action="/terms/create" method="POST">
    @csrf
        <p>Term Name:</p>
        <input type="text" name="term_name" id="term_name" place-holder="Term Name" required/>
        <div class="row">
            <div class="col-md-6">
            <p>Start Date:</p>
            <input type="date" name="start_date" id="start_date" required/>
            </div>
            <div class="col-md-6">
            <p>End Date:</p>
            <input type="date" name="end_date" id="end_date" required/>
            </div>
        </div>
        <input type="submit" name="submit" value="Create Term"/>
    </form>
  </div>

</div>

<div id="secModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Welcome to <span id="deltit"></span></h3>
    <p>Are you sure you want to start the term <span id="deltit2"></span></p>
    <form action="/terms/start" method="POST">
    @csrf
        <input type="hidden" name="term_id" id="term_id"/>
        <input type="submit" name="submit" value="Start Term"/>
    </form>
  </div>

</div>

<div id="secModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Welcome to <span id="deltit3"></span></h3>
    <p>Are you sure you want to complete the term <span id="deltit4"></span></p>
    <form action="/terms/complete" method="POST">
    @csrf
        <input type="hidden" name="term_id" id="term_id2"/>
        <input type="submit" name="submit" value="Complete Term"/>
    </form>
  </div>

</div>


<div class="row">
    <h2>Current Term: <span>
        @if(!$currentTerms == null)
        {{ $currentTerms->term_name }}
        &nbsp;
        {{ date('d-m-Y',(strtotime($currentTerms->start_date))) }} to {{ date('d-m-Y',(strtotime($currentTerms->end_date))) }}
        @else
        No Term in Session At the moment
        @endif
    </span></h2>

</div>
<h4 class="my-4">All Terms</h4>

    @if(count($terms) > 0)
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Term</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Settings</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($terms as $term)
                    <tr>
                        <td>{{ $term['term_name'] }}</td>
                        <td>{{ date('d-m-Y',(strtotime($term['start_date']))) }}</td>
                        <td>{{ date('d-m-Y',(strtotime($term['end_date']))) }}</td>
                        <td>{{ $term->statusmeaning }}</td>
                        <td>
                            @if($term['term_status'] == 0)
                            <button type="button" id="startbut" data-id="{{ $term->id }}" data-name="{{ $term->term_name }}" class="btn btn-secondary cont_but startbut">Start Term</button></td>
                            @endif
                            @if($term['term_status'] == 1)
                            <button type="button" id="endbut" data-id="{{ $term->id }}" data-name="{{ $term->term_name }}" class="btn btn-secondary cont_but endbut">Complete Term</button></td>
                            @endif
                            @if($term['term_status'] == 2)
                            <p>Term completed.</p>
                            @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>
            <h4>You currently have no terms in record.</h4>
        </div>
    @endif
    <script type="text/javascript">
        $("#cont_butt").on("click", function(){
            $('#myModal').css("display", "block");
        });

        $(".startbut").on("click", function(){
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#deltit').text(dataname);
            $('#deltit2').text(dataname);
            $('#term_id').val(dataId);
            $('#secModal').css("display", "block");
        });

        $(".endbut").on("click", function(){
            var dataId = $(this).attr("data-id");
            var dataname = $(this).attr("data-name");
            $('#deltit3').text(dataname);
            $('#deltit4').text(dataname);
            $('#term_id2').val(dataId);
            $('#secModal2').css("display", "block");
        });

        $(".close").on("click", function(){
            $('#myModal').css("display", "none");
            $('#secModal').css("display", "none");
            $('#secModal2').css("display", "none");
        });
</script>
@endsection