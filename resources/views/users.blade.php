@extends('main.body')

@section('container')
    <div class="row">
        <h3 class="my-2 mb-3 px-0 mx-0">{{ $title }}</h3>
        <hr class="mb-4">
        <div class="row mt-5 mb-3">
            <div class="table-responsive col-xl-7 small">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ Str::ucfirst($user->level) }}</td>
                                <td>
                                    <form action="/user/delete/{{ $user->id }}" method="GET" class="d-inline m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-danger p-1">
                                            <i class="bi bi-trash text-white fs-6"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
