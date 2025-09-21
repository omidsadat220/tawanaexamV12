@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Update Department</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Update</a></li>
                            <li class="breadcrumb-item active">Department</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admission Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Department & subject</h4>
                        <form action="{{ route('update.depart', $depart->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">

                                <!-- Father name -->
                                <div class="col-md-6">
                                    <label class="col-sm-6 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="depart_name" value="{{ $depart->depart_name }}"
                                            type="text" placeholder="Department name">
                                    </div>
                                </div>


                                <!-- Department name -->
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label mb-0" style="margin-top:-8px">Department Subjects</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-2" id="add-subject"
                                            style="margin-top:-8px">
                                            + Add Subject
                                        </button>
                                    </div>

                                    <div class="col-sm-10" id="subject-container">
                                        @foreach ($depart->subjects as $subject)
                                            <div class="input-group mb-2">

                                                <input class="form-control" name="depart_subjects[]"
                                                    value="{{ $subject->subject_name }}" type="text"
                                                    placeholder="Department subject">
                                                <button type="button" class="btn btn-danger remove-subject">Remove</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success">Add department</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        // Add a new subject input
        $('#add-subject').on('click', function() {
            $('#subject-container').append(`
        <div class="input-group mb-2">
            <input type="text" name="depart_subjects[]" class="form-control" placeholder="Department subject" required>
            <button type="button" class="btn btn-danger remove-subject">Remove</button>
        </div>
    `);
        });

        // Remove a subject input
        $(document).on('click', '.remove-subject', function() {
            $(this).closest('.input-group').remove();
        });
    </script>
@endsection
