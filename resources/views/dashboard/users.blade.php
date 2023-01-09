@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('head-script')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
@endsection

@section('main')
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="mt-5 card" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-header">
                            <a href="{{ route('dashboard') }}"><span><i class="fa-regular fa-chevron-left"></i></span>
                                Dashboard</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table id="users_table" class="stripe hover" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder">ID</th>
                                            <th class="fw-bolder">Role</th>
                                            <th class="fw-bolder">Avatar</th>
                                            <th class="fw-bolder">Username</th>
                                            <th class="fw-bolder">Email</th>
                                            <th class="fw-bolder">Jenis Kelamin</th>
                                            <th class="fw-bolder">Nomor Handphone</th>
                                            <th class="fw-bolder">Join Date</th>
                                            <th class="fw-bolder">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    @if ($user->is_admin)
                                                        <button id="{{ $user->id }}" is_admin="{{ $user->is_admin }}" class="admin-role-btn badge badge-info no-border"
                                                            data-bs-toggle="modal" data-bs-target="#modal">Admin</button>
                                                    @else
                                                        <button id="{{ $user->id }}" is_admin="{{ $user->is_admin }}" class="admin-role-btn badge badge-success no-border"
                                                            data-bs-toggle="modal" data-bs-target="#modal">User</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->avatar)
                                                        <img src="/img/avatar/{{ $user->avatar }}" alt="avatar"
                                                            class="rounded-circle img-fluid shadow-sm"
                                                            style="width: 50px; height: 50px; object-fit: cover">
                                                    @else
                                                        <img src="/img/{{ $user->gender == 'Laki-laki' ? 'male-avatar.jpg' : 'female-avatar.jpg' }}"
                                                            alt="avatar" class="rounded-circle img-fluid shadow-sm"
                                                            style="width: 50px; height: 50px; object-fit: cover">
                                                    @endif
                                                </td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-around">
                                                        <form action="{{ route('remove_user', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button id="{{ $user->id }}" type="submit" class="remove-user-btn btn btn-sm btn-danger"><i
                                                                    class="fa-xl fa-solid fa-trash-can-xmark"></i></button>
                                                        </form>
                                                    </div>
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
        </div>
@endsection

@section('script')
    <script>
        //Data Tables
        $(document).ready(function() {
            $('#users_table').DataTable({
                pageLength: 5,
                scrollX: true,
                paging: true,
                searching: true,
                info: true,
                stateSave: true,
                lengthMenu: [ 5, 10, 25, 50, 100 ]
            });
            $('.dataTables_scroll').addClass('mb-4');
            $('.dataTables_length').addClass('mb-4');
        })
    </script>
@endsection