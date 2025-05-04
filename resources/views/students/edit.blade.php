@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Student') }}</h1>

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
                <form method="POST" action="{{ route('students.update') }}">
                    @csrf
                    @method('PUT')  <!-- Make sure this is present -->
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="StudentNumber">Student Number</label>
                                    <input type="text" class="form-control @error('StudentNumber') is-invalid @enderror" 
                                           id="StudentNumber" name="StudentNumber" 
                                           value="{{ old('StudentNumber', $student->StudentNumber ?? '') }}"
                                           placeholder="YYYY-XXXXX" required>
                                    <small class="form-text text-muted">
                                        Format: Year (YYYY) followed by dash and 5 digits (e.g., 2022-00907)
                                    </small>
                                    @error('StudentNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Course">Course</label>
                                    <input type="text" class="form-control @error('Course') is-invalid @enderror" 
                                           id="Course" name="Course" 
                                           value="{{ old('Course', $student->Course) }}" required>
                                    @error('Course')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control @error('FirstName') is-invalid @enderror" 
                                           name="FirstName" value="{{ old('FirstName', $student->FirstName) }}" required>
                                    @error('FirstName')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control @error('MiddleName') is-invalid @enderror" 
                                           name="MiddleName" value="{{ old('MiddleName', $student->MiddleName) }}">
                                    @error('MiddleName')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control @error('Password') is-invalid @enderror" 
                                           id="Password" name="Password">
                                    <small class="form-text text-muted">
                                        Leave blank to keep current password. New password must be minimum 8 characters with letters and numbers.
                                    </small>
                                    @error('Password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control @error('LastName') is-invalid @enderror" 
                                           name="LastName" value="{{ old('LastName', $student->LastName) }}" required>
                                    @error('LastName')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Year Level</label>
                                    <select class="form-control @error('YearLevel') is-invalid @enderror" 
                                            name="YearLevel" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" 
                                                {{ old('YearLevel', $student->YearLevel) == $i ? 'selected' : '' }}>
                                                Year {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('YearLevel')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Section</label>
                                    <input type="text" class="form-control @error('Section') is-invalid @enderror" 
                                           name="Section" value="{{ old('Section', $student->Section) }}" required>
                                    @error('Section')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control @error('DateOfBirth') is-invalid @enderror" 
                                           name="DateOfBirth" value="{{ old('DateOfBirth', $student->DateOfBirth) }}" required>
                                    @error('DateOfBirth')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Gender">Gender</label>
                                    <select class="form-control @error('Gender') is-invalid @enderror" 
                                            id="Gender" name="Gender" required>
                                        <option value="">Select Gender</option>
                                        @foreach(['Male', 'Female', 'Other'] as $gender)
                                            <option value="{{ $gender }}" 
                                                {{ old('Gender', $student->Gender) == $gender ? 'selected' : '' }}>
                                                {{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="AcademicStatus">Academic Status</label>
                                    <select class="form-control @error('AcademicStatus') is-invalid @enderror" 
                                            id="AcademicStatus" name="AcademicStatus" required>
                                        <option value="">Select Status</option>
                                        @foreach(['Regular', 'Irregular', 'LOA', 'Graduated'] as $status)
                                            <option value="{{ $status }}" 
                                                {{ old('AcademicStatus', $student->AcademicStatus) == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('AcademicStatus')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control @error('Email') is-invalid @enderror" 
                                           id="Email" name="Email" value="{{ old('Email', $student->Email) }}">
                                    @error('Email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <textarea class="form-control @error('Address') is-invalid @enderror" 
                                              id="Address" name="Address" rows="2">{{ old('Address', $student->Address) }}</textarea>
                                    @error('Address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TelephoneNumber">Telephone Number</label>
                                    <input type="text" class="form-control @error('TelephoneNumber') is-invalid @enderror" 
                                           id="TelephoneNumber" name="TelephoneNumber" 
                                           value="{{ old('TelephoneNumber', $student->TelephoneNumber) }}"
                                           placeholder="e.g., 028xxxxxxx or +632xxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 02 or +632 followed by 7 digits
                                    </small>
                                    @error('TelephoneNumber')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ContactNumber">Mobile Number</label>
                                    <input type="text" class="form-control @error('ContactNumber') is-invalid @enderror" 
                                           id="ContactNumber" name="ContactNumber" 
                                           value="{{ old('ContactNumber', $student->ContactNumber) }}"
                                           placeholder="09xxxxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 11 digits starting with 09
                                    </small>
                                    @error('ContactNumber')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmergencyContact">Emergency Contact Person</label>
                                    <input type="text" class="form-control @error('EmergencyContact') is-invalid @enderror" 
                                           id="EmergencyContact" name="EmergencyContact" 
                                           value="{{ old('EmergencyContact', $student->EmergencyContact) }}">
                                    @error('EmergencyContact')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmergencyContactNumber">Emergency Contact Number</label>
                                    <input type="text" class="form-control @error('EmergencyContactNumber') is-invalid @enderror" 
                                           id="EmergencyContactNumber" name="EmergencyContactNumber" 
                                           value="{{ old('EmergencyContactNumber', $student->EmergencyContactNumber) }}"
                                           placeholder="09xxxxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 11 digits starting with 09
                                    </small>
                                    @error('EmergencyContactNumber')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Student') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
document.getElementById('StudentNumber').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^0-9]/g, '');
    if (value.length > 4) {
        value = value.substr(0, 4) + '-' + value.substr(4, 5);
    }
    e.target.value = value;
});
</script>
@endpush
