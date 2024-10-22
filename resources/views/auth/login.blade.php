@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <!-- Email Field -->
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label> <!-- typo di 'emd' diperbaiki -->
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
