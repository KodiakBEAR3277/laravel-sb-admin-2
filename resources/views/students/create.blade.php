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
                    <form method="POST" action="{{ route('students.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="FirstName">{{ __('First Name') }}</label>
                            <input type="text" class="form-control @error('FirstName') is-invalid @enderror" id="FirstName" name="FirstName" value="{{ old('FirstName') }}" required autocomplete="FirstName" autofocus>
                            @error('FirstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="FirstName">Last Name</label>
                            <input type="text" class="form-control @error('LastName') is-invalid @enderror" id="LastName" name="LastName" value="{{ old('LastName') }}" required autocomplete="FirstName" autofocus>
                            @error('LastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="DateOfBirth">{{ __('Date Of Birth') }}</label>
                            <input type="date" class="form-control @error('DateOfBirth') is-invalid @enderror" id="DateOfBirth" name="DateOfBirth" value="{{ old('DateOfBirth') }}" required autocomplete="FirstName" autofocus>
                            @error('DateOfBirth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
