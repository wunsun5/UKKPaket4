@include('main.head')

<div class="container fluid d-flex align-items-center justify-content-center" style="min-height: 80vh">
    <div class="container col-md-5 col-xl-4 p-4 bg-white shadow">
        <h3 class="text-center my-3">Login</h3>
        <form action="/login" method="POST">
            @csrf
            <label class="form-label ms-1" for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" />
            @error('email')
                <div class="text-danger small ms-1">
                    {{ $message }}
                </div>
            @enderror
            <label class="form-label ms-1" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" />
            @error('password')
                <div class="text-danger small ms-1">
                    {{ $message }}
                </div>
            @enderror

            <button class="btn btn-primary mb-4 mt-5 w-100" type="submit">Login</button>
        </form>
    </div>
</div>

@include('main.footer')
