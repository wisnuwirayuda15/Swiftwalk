@extends('layouts.main')

@section('main')
    <section class="container h-100 mt-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5><i class="fa-solid fa-user"></i> User Profile</h5>
                    </div>
                    <div class="card-body text-center">
                        @isset(auth()->user()->avatar)
                            <img src="/img/avatar/{{ auth()->user()->avatar }}" alt="avatar"
                                class="rounded-circle img-fluid shadow profile-img">
                        @else
                            <img src="/img/{{ auth()->user()->gender == 'Laki-laki' ? 'male-avatar.jpg' : 'female-avatar.jpg' }}"
                                alt="avatar" class="rounded-circle img-fluid profile-img">
                        @endisset
                        <h5 class="mt-3">{{ auth()->user()->username }}</h5>
                        <div class="container">
                            @can('admin')
                                <p class="badge badge-info">Admin</p>
                                <br>
                                <a class="btn btn-info" href="{{ route('dashboard') }}" role="button">
                                    <i class="fa-solid fa-chart-line"></i> Dashboard
                                </a>
                            @else
                                <p class="badge badge-success">User</p>
                            @endcan
                        </div>
                        <div class="justify-content-center mt-3 mb-2">
                            <hr>
                            @if (auth()->user()->avatar)
                                <button id="edit_avatar" data-bs-toggle="modal" data-bs-target="#modal"
                                    class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit Avatar</button>
                            @else
                                <button id="edit_avatar" data-bs-toggle="modal" data-bs-target="#modal"
                                    class="btn btn-primary"><i class="fa-solid fa-image"></i> Add Avatar</button>
                            @endif
                            <a href="{{ route('logout') }}" class="logout-btn btn btn-warning ms-1"><i
                                    class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                        <div>
                            <form action="{{ route('remove_account') }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="delete-acc-btn btn btn-danger ms-1"><i
                                        class="fa-solid fa-trash-can"></i> Hapus
                                    Akun</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Username</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">{{ auth()->user()->username }}</p>
                                <a class="pulse-animated-btn" id="edit_username" data-bs-toggle="modal"
                                    data-bs-target="#modal" href="">Edit</i></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Email</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Jenis Kelamin</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">{{ auth()->user()->gender }}</p>
                                <a class="pulse-animated-btn" id="edit_gender" data-bs-toggle="modal"
                                    data-bs-target="#modal" href="">Edit</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Phone Number</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">(+62) {{ auth()->user()->number }}</p>
                                <a class="pulse-animated-btn" id="edit_number" data-bs-toggle="modal"
                                    data-bs-target="#modal" href="">Edit</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Bergabung pada</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">{{ $date_created }} • {{ $acc_age }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-3">
                                <p class="mb-0 fw-bold">Password</p>
                            </div>
                            <div class="col-sm-9 d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">**************</p>
                                <a class="pulse-animated-btn" id="edit_password" data-bs-toggle="modal"
                                    data-bs-target="#modal" href="">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                text: '{{ $errors->first() }}',
            })
        </script>
    @endif
@endsection
