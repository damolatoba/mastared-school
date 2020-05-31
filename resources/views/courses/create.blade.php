@extends('layouts.index')
@section('content')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <div class="container">
        <form method="POST" action="store" id="course_create_form" enctype="multipart/form-data">
                @csrf

                <!-- @method('PUT') -->

                <div class="form-em">
                    <p>{{ __('Course Title:') }}</p>
                    <div>
                        <input type="text" name="title" required autofocus>
                    </div>
                </div>

                <div class="row form-em">

                    <div class="col-md-4">
                    <label>{{ __('Subject:') }}</label>
                        <div>
                        <select name="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <label>{{ __('Lecture Date:') }}</label>
                        <div>
                        <input type="date" name="start_date" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <label>{{ __('Course Video:') }}</label>
                        <div>
                        <input type="file" name="video" id="profile_image">
                        </div>
                    </div>
                </div>

                <div class="form-em">
                    <div>
                    <label>{{ __('Description/Instruction:') }}</label>
                    <textarea name="editor1" required></textarea>
                        <script>
                                CKEDITOR.replace( 'editor1' );
                        </script>
                    </div>
                </div>

                <div class="row form-em">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" style="width:100%;">
                                {{ __('Submit Lecture') }}
                            </button>
                        </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
    </div>
@endsection