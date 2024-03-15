@extends('main.body')

@section('container')
    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 80vh">
        <div class="container col-md-7 col-xl-5 p-4 bg-white shadow">
            <h3 class="text-center my-3">Regitrasi</h3>
            <form action="/register" method="POST">
                @csrf
                <label class="form-label ms-1" for="username">Username</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                    value="{{ old('username') }}" />
                @error('username')
                    <div class="text-danger small ms-1">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3 ms-1" for="email">Email</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email') }}" />
                @error('email')
                    <div class="text-danger small ms-1">
                        {{ $message }}
                    </div>
                @enderror
                <label class="form-label mt-3 ms-1" for="level">Level</label>
                <select name="level" id="level" class="form-select mb-3 @error('level') is-invalid @enderror">
                    @if (old('level') == 'petugas')
                        <option value="admin">Admin</option>
                        <option value="petugas" selected>Petugas</option>
                    @else
                        <option value="admin" selected>Admin</option>
                        <option value="petugas">Petugas</option>
                    @endif
                </select>
                <label class="form-label mt-3 ms-1" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                    value="{{ old('password') }}" />
                @error('password')
                    <div class="text-danger small ms-1">
                        {{ $message }}
                    </div>
                @enderror
                <button class="btn btn-primary mb-4 mt-5 w-100" type="submit">Registrasi</button>
            </form>
        </div>
    </div>
@endsection
