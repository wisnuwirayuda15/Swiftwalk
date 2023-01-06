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
            <!--Catalog--->
            <div class="col-md-12 mb-3">
                <div class="mt-5 card" data-aos="fade-up" data-aos-duration="500">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span><i class="fa-sharp fa-solid fa-box"></i> Catalog
                    </div>
                    <div class="card-body">
                        @if (count($catalogs) == 0)
                            @include('dashboard.empty-catalog')
                        @else
                            <div class="table-responsive ">
                                <table id="users_table" class="stripe hover" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder">ID</th>
                                            <th class="fw-bolder">Foto</th>
                                            <th class="fw-bolder">Nama Produk</th>
                                            <th class="fw-bolder">Deskripsi</th>
                                            <th class="fw-bolder">Harga</th>
                                            <th class="fw-bolder">Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($catalogs as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td><img src="/img/product/{{ $item->image }}" alt="avatar"
                                                        class="rounded img-fluid shadow-sm"
                                                        style="width: 80px; height: 80px; object-fit: cover"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ mb_strimwidth($item->description, 0, 100, '...') }}</td>
                                                <td>Rp {{ number_format($item->price, 0, '', '.') }}</td>
                                                <td>{{ $item->sold }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if (count($catalogs) != 0)
                            <a href="{{ route('catalog') }}">
                                <button class="slide-animated-btn"> See More
                                    <div class="slide-animated-icon">
                                        <svg height="24" width="24" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>


            <!--Users--->
            <div class="col-md-12 mb-3">
                <div class="mt-5 card" data-aos="fade-up" data-aos-duration="500">
                    <div class="card-header">
                        <span><i class="fa-solid fa-users"></i></span> Users
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="users_table2" class="stripe hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">Role</th>
                                        <th class="fw-bolder">Avatar</th>
                                        <th class="fw-bolder">Username</th>
                                        <th class="fw-bolder">Email</th>
                                        <th class="fw-bolder">Jenis Kelamin</th>
                                        <th class="fw-bolder">Nomor Handphone</th>
                                        <th class="fw-bolder">Join Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                @if ($user->is_admin)
                                                    <p class="badge badge-info">Admin</p>
                                                @else
                                                    <p class="badge badge-success">User</p>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('users') }}">
                            <button class="slide-animated-btn"> See More
                                <div class="slide-animated-icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>
                            </button>
                        </a>
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
                pageLength: 3,
                scrollX: true,
                paging: true,
                searching: false,
                info: false,
            });
            $('#users_table2').DataTable({
                pageLength: 3,
                scrollX: true,
                paging: true,
                searching: false,
                info: false,
            });
            $('.dataTables_scroll').addClass('mb-4');
            $('.dataTables_length').addClass('mb-4');

            $('#users_table_length').remove();
            $('#users_table2_length').remove();
            $('#users_table_paginate').remove();
            $('#users_table2_paginate').remove();
        })
    </script>
@endsection
