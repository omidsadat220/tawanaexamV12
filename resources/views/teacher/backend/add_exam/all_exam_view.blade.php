@extends('teacher.teacher_dashboard')
@section('teacher')

 <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h4 class="card-title">View Student Info</h4>
                <a href="{{ route('add.teacher.add.exam') }}" class="btn btn-primary waves-effect waves-light mb-4">Create
                    add exam</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>Department</th>
                        <th>subject</th>
                        <th>start_time</th>

                        <th class="all">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($alldata as $key =>  $exam)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $exam->user->name }}</td>
                            <td>{{ $exam->department->depart_name ?? 'N/A' }}</td>
                            <td>{{ $exam->subject->subject_name ?? 'N/A' }}</td>
                            <td>{{ $exam->start_time }}</td>



                            <td style="text-align:center; font-size: 20px;">
                                <a href="{{ route('edit.teacher.add.exam', $exam->id) }}">
                                    <i class="fas fa-edit btn btn-primary"></i>
                                </a>
                                <a href="{{ route('delete.teacher.add.exam', $exam->id) }}" id="delete">
                                    <i class="fas fa-trash-alt btn btn-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection