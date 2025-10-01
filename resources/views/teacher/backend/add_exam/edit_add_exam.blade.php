@extends('teacher.teacher_dashboard')
@section('teacher')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Exam</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Exam</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Exam Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Exam Info</h4>

                        <form action="{{ route('update.teacher.add.exam') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $addexam->id }}">

                            <div class="row mb-3">
                                <!-- Department -->
                                <div class="col-md-6">
                                    <label class="col-form-label">Department</label>
                                    <select name="department_id" class="form-select" id="department-dropdown">
                                        <option value="">Select Department</option>
                                        @foreach ($depart as $dept)
                                            <option value="{{ $dept->id }}"
                                                {{ $addexam->department_id == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->depart_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-md-6">
                                    <label class="col-form-label">Subject</label>
                                    <select name="subject_id" class="form-select" id="subject-dropdown">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $addexam->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->subject_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Exam Title -->
                                <div class="col-md-6">
                                    <label class="col-form-label">Exam Title</label>
                                    <select name="user_id" class="form-select" id="subject-dropdown">
                                        <option value="">Select Subject</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $addexam->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Start Time -->
                                <div class="col-md-6">
                                    <label class="col-form-label">Start Time</label>
                                    <input type="time" name="exam_time" class="form-control"
                                        value="{{ $addexam->exam_time }}">
                                    @error('exam_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update AddExam</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#department-dropdown').select2();
            $('#subject-dropdown').select2();

            // Dynamic Subjects on Department Change
            $('#department-dropdown').change(function() {
                var deptID = $(this).val();
                if (deptID) {
                    $.ajax({
                        url: '/get-teacher_subjects/' + deptID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#subject-dropdown').empty();
                            $('#subject-dropdown').append(
                                '<option value="">Select Subject</option>');
                            $.each(data, function(key, value) {
                                $('#subject-dropdown').append('<option value="' + value
                                    .id + '">' + value.subject_name + '</option>');
                            });
                            $('#subject-dropdown').trigger('change'); // Refresh Select2
                        }
                    });
                } else {
                    $('#subject-dropdown').empty();
                    $('#subject-dropdown').append('<option value="">Select Subject</option>');
                    $('#subject-dropdown').trigger('change'); // Refresh Select2
                }
            });
        });
    </script>
@endsection
