@include('main.head')

<div class="modal fade" data-bs-toggle="modal" id="modalLogout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Logout</div>
            </div>
            <div class="modal-body">
                <h6>Yakin ingin logout ?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalLogout">Cancel</button>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')
        <main class="col-md-9 col-xl-10 py-3 px-md-5 px-4 min-vh-100">
            @yield('container')
        </main>
    </div>
</div>

@include('main.footer')
