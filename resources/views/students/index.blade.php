@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Student') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Date Of Birth') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->FirstName }}</td>
                                <td>{{ $student->LastName }}</td>
                                <td>
                                {{ $student->DateOfBirth }}<br>
                                Age: {{ date('Y') -  date('Y', strtotime($student->DateOfBirth)) }} years old
                                </td> 
                                <td>
                                    @if(isset($student->deleted_at))
                                    <a href="{{ route('students.restore', [encrypt($student->id)]) }}" class="btn btn-success btn-sm">Restore</a>
                                    @else
                                    <a href="{{ route('students.destroy', [encrypt($student->id)]) }}" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="{{ route('students.edit', [encrypt($student->id)]) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
