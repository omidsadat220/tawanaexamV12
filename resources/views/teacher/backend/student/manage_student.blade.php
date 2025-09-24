@extends('teacher.teacher_dashboard')
@section('teacher')

 <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h4 class="card-title">View Student Info</h4>
                <a href="{{ route('add.teacher.exam') }}" class="btn btn-primary waves-effect waves-light mb-4">Create
                    exam</a>
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
                        <th>name</th>
                        <th>email</th>
                        <th>role</th>
                        <th>phone</th>
                        <th class="all">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->phone }}</td>



                            {{-- <td style="text-align:center; font-size: 20px;">
                                <a href="{{ route('edit.teacher.exam', $exam->id) }}">
                                    <i class="fas fa-edit btn btn-primary"></i>
                                </a>
                                <a href="{{ route('delete.teacher.exam', $exam->id) }}" id="delete">
                                    <i class="fas fa-trash-alt btn btn-danger"></i>
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection