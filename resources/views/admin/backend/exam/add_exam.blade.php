@extends('admin.admin_dashboard')
@section('admin')


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">paid Admission</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Admission</li>
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
                <h4 class="card-title">Fill Student Info</h4>
                <form action="{{ route('store.exam') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <!-- Name -->
                      
                        <div class="col-md-6">
                            <label class="col-sm-4 col-form-label">Department</label>
                            <div class="col-sm-10">
                                <select name="department_id" class="form-select" id="department-dropdown">
                                    <option value="">Select</option>
                                    @foreach ($depart as $info)
                                        <option value="{{ $info->id }}">{{ $info->depart_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="col-sm-4 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <select name="subject_id" class="form-select" id="subject-dropdown">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">exam_title</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="exam_title" name="exam_title" type="text" placeholder="paid">
                            </div>
                        </div>

                           <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">time</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="start_time" type="time" placeholder="paid_date">
                            </div>
                        </div>

                    </div>

                      
                    </div>
                    {{-- row 4 --}}
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add exam</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>


    <!-- Select2 Initialization Script -->
<script>
    $(document).ready(function() {
        $('#student-select').select2({
            placeholder: "Search or select a student",
            allowClear: true,
            width: '100%'
        });
    });
</script>



    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function calculateRemaining() {
            let total = parseFloat($('#total_fees').val()) || 0;
            let paid = parseFloat($('#paid').val()) || 0;
            let remaining = total - paid;
            $('#remaining_fees').val(remaining >= 0 ? remaining : 0);
        }


        $(document).ready(function () {
            // Recalculate on input changes
            $('#amount, #paid').on('input', calculateRemaining);

            // Initialize on page load
            calculateRemaining();
        });
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#department-dropdown').on('change', function () {
            var depart_id = this.value;
            $('#subject-dropdown').html('<option value="">Loading...</option>');

            if (depart_id) {
                $.ajax({
                    url: "/get-subjects/" + depart_id,
                    type: "GET",
                    success: function (res) {
                        $('#subject-dropdown').html('<option value="">Select Subject</option>');
                        $.each(res, function (key, value) {
                            $('#subject-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        $('#subject-dropdown').html('<option value="">Error loading subjects</option>');
                    }
                });
            } else {
                $('#subject-dropdown').html('<option value="">Select Subject</option>');
            }
        });
    });
</script>

@endsection