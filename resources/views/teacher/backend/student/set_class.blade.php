@extends('teacher.teacher_dashboard')
@section('teacher')


<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Set Class</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('store.set.class') }}" method="POST">
                                @csrf
                                <div class="form-group"></div>
                                    <label>Class</label>
                                    <input type="text" name="user_id" value="{{ $student->id }}">
                                    <select class="form-control" name="department_id" required>
                                        <option name="null">Select Class</option>
                                        @foreach ($department as $class)
                                            <option value="{{ $class->id }}">{{ $class->depart_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection