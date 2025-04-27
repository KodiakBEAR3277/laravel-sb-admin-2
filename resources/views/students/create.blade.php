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
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('students.store') }}">
                        @csrf
                        
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
                                           id="Course" name="Course" value="{{ old('Course') }}" required>
                                    @error('Course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" class="form-control @error('FirstName') is-invalid @enderror" 
                                           id="FirstName" name="FirstName" value="{{ old('FirstName') }}" required>
                                    @error('FirstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="MiddleName">Middle Name</label>
                                    <input type="text" class="form-control @error('MiddleName') is-invalid @enderror" 
                                           id="MiddleName" name="MiddleName" value="{{ old('MiddleName') }}">
                                    @error('MiddleName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control @error('Password') is-invalid @enderror" 
                                           id="Password" name="Password" required>
                                    <small class="form-text text-muted">
                                        Minimum 8 characters, must contain letters and numbers
                                    </small>
                                    @error('Password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" class="form-control @error('LastName') is-invalid @enderror" 
                                           id="LastName" name="LastName" value="{{ old('LastName') }}" required>
                                    @error('LastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="YearLevel">Year Level</label>
                                    <select class="form-control @error('YearLevel') is-invalid @enderror" 
                                            id="YearLevel" name="YearLevel" required>
                                        <option value="">Select Year Level</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('YearLevel') == $i ? 'selected' : '' }}>
                                                Year {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('YearLevel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Section">Section</label>
                                    <input type="text" class="form-control @error('Section') is-invalid @enderror" 
                                           id="Section" name="Section" value="{{ old('Section') }}" required>
                                    @error('Section')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="DateOfBirth">Date of Birth</label>
                                    <input type="date" class="form-control @error('DateOfBirth') is-invalid @enderror" 
                                           id="DateOfBirth" name="DateOfBirth" value="{{ old('DateOfBirth') }}" required>
                                    @error('DateOfBirth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                        <option value="Male" {{ old('Gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('Gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('Gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('Gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="AcademicStatus">Academic Status</label>
                                    <select class="form-control @error('AcademicStatus') is-invalid @enderror" 
                                            id="AcademicStatus" name="AcademicStatus" required>
                                        <option value="">Select Status</option>
                                        <option value="Regular" {{ old('AcademicStatus') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Irregular" {{ old('AcademicStatus') == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                        <option value="LOA" {{ old('AcademicStatus') == 'LOA' ? 'selected' : '' }}>LOA</option>
                                        <option value="Graduated" {{ old('AcademicStatus') == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                                    </select>
                                    @error('AcademicStatus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control @error('Email') is-invalid @enderror" 
                                           id="Email" name="Email" value="{{ old('Email') }}">
                                    @error('Email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <textarea class="form-control @error('Address') is-invalid @enderror" 
                                              id="Address" name="Address" rows="2">{{ old('Address') }}</textarea>
                                    @error('Address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                           value="{{ old('TelephoneNumber') }}" 
                                           placeholder="e.g., 028xxxxxxx or +632xxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 02 or +632 followed by 7 digits
                                    </small>
                                    @error('TelephoneNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                           value="{{ old('ContactNumber') }}"
                                           placeholder="09xxxxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 11 digits starting with 09
                                    </small>
                                    @error('ContactNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmergencyContact">Emergency Contact Person</label>
                                    <input type="text" class="form-control @error('EmergencyContact') is-invalid @enderror" 
                                           id="EmergencyContact" name="EmergencyContact" value="{{ old('EmergencyContact') }}">
                                    @error('EmergencyContact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmergencyContactNumber">Emergency Contact Number</label>
                                    <input type="text" class="form-control @error('EmergencyContactNumber') is-invalid @enderror" 
                                           id="EmergencyContactNumber" name="EmergencyContactNumber" 
                                           value="{{ old('EmergencyContactNumber') }}"
                                           placeholder="09xxxxxxxxx">
                                    <small class="form-text text-muted">
                                        Format: 11 digits starting with 09
                                    </small>
                                    @error('EmergencyContactNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Student') }}
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
