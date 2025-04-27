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
                                    <th>{{ __('Contact Information') }}</th>
                                    <th>{{ __('Academic Details') }}</th>
                                    <th>{{ __('Emergency Contact') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->StudentNumber }}</td>
                                    <td>
                                        <div>{{ $student->LastName }}, {{ $student->FirstName }} 
                                            {{ $student->MiddleName ? $student->MiddleName[0].'.' : '' }}</div>
                                        <small class="text-muted">{{ $student->Gender }}</small>
                                    </td>
                                    <td>{{ $student->Course }}</td>
                                    <td>
                                        <div>Year {{ $student->YearLevel }}-{{ $student->Section }}</div>
                                    </td>
                                    <td>
                                        <small>
                                            @if($student->TelephoneNumber)
                                                <div><i class="fas fa-phone-alt"></i> {{ $student->TelephoneNumber }}</div>
                                            @endif
                                            @if($student->ContactNumber)
                                                <div><i class="fas fa-mobile-alt"></i> {{ $student->ContactNumber }}</div>
                                            @endif
                                            @if($student->Email)
                                                <div><i class="fas fa-envelope"></i> {{ $student->Email }}</div>
                                            @endif
                                            @if($student->Address)
                                                <div><i class="fas fa-map-marker-alt"></i> {{ $student->Address }}</div>
                                            @endif
                                        </small>
                                    </td>
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
                                            @if($student->EmergencyContact)
                                                <div>{{ $student->EmergencyContact }}</div>
                                                @if($student->EmergencyContactNumber)
                                                    <div><i class="fas fa-phone"></i> {{ $student->EmergencyContactNumber }}</div>
                                                @endif
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
                                               class="btn btn-success btn-sm" title="Restore">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        @else
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('students.edit', [encrypt($student->id)]) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('students.destroy', [encrypt($student->id)]) }}" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this student?')"
                                                   title="Delete">
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
<style>
    .table td small { font-size: 85%; }
    .table td small div { margin-bottom: 2px; }
    .table td { vertical-align: middle !important; }
</style>
@endpush

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [[1, "asc"]], // Sort by name by default
            "pageLength": 25 // Show 25 entries per page
        });
    });
</script>
@endpush
