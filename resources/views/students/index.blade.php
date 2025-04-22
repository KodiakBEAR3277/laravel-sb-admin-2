@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Student Management') }}</h1>

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
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Students List</h6>
                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Student
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('Student Number') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Course') }}</th>
                                    <th>{{ __('Year & Section') }}</th>
                                    <th>{{ __('Gender') }}</th>
                                    <th>{{ __('Academic Status') }}</th>
                                    <th>{{ __('Contact Info') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->StudentNumber }}</td>
                                    <td>
                                        {{ $student->LastName }}, {{ $student->FirstName }} 
                                        {{ $student->MiddleName ? $student->MiddleName[0].'.' : '' }}
                                    </td>
                                    <td>{{ $student->Course }}</td>
                                    <td>{{ $student->YearLevel }}-{{ $student->Section }}</td>
                                    <td>{{ $student->Gender }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'Regular' => 'success',
                                                'Irregular' => 'warning',
                                                'LOA' => 'danger',
                                                'Graduated' => 'info'
                                            ];
                                            $color = $statusColors[$student->AcademicStatus] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $color }}">
                                            {{ $student->AcademicStatus }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>
                                            @if($student->ContactNumber)
                                                <div><i class="fas fa-phone"></i> {{ $student->ContactNumber }}</div>
                                            @endif
                                            @if($student->Email)
                                                <div><i class="fas fa-envelope"></i> {{ $student->Email }}</div>
                                            @endif
                                        </small>
                                    </td>
                                    <td>
                                        @if($student->deleted_at)
                                            <span class="badge badge-danger">Inactive</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->deleted_at)
                                            <a href="{{ route('students.restore', [encrypt($student->id)]) }}" 
                                               class="btn btn-success btn-sm">
                                                <i class="fas fa-undo"></i> Restore
                                            </a>
                                        @else
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('students.edit', [encrypt($student->id)]) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('students.destroy', [encrypt($student->id)]) }}" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this student?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
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
    </div>
@endsection

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
