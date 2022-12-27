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
                <div class="mt-5 card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <a href="{{ route('dashboard') }}"><span><i class="fa-regular fa-chevron-left"></i></span>
                            Dashboard</a>
                        @if (count($catalogs) != 0)
                            <a href="{{ route('index_add_item') }}">
                                <button type="button" class="pulse-animated-btn"><i class="fa-solid fa-plus"></i>
                                    Tambah
                                    Produk</button>
                            </a>
                        @endif
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
                                            <th class="fw-bolder">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($catalogs as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <img src="/img/product/{{ $item->image }}" alt="avatar"
                                                        class="rounded img-fluid shadow-sm"
                                                        style="width: 80px; height: 80px; object-fit: cover">
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ mb_strimwidth($item->description, 0, 100, '...') }}</td>
                                                <td>Rp {{ number_format($item->price, 0, '', '.') }}</td>
                                                <td>{{ $item->sold }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('detail', $item->id) }}" class="detail-catalog-btn btn btn-primary mx-2"><i class="fa-xl fa-solid fa-pen-to-square"></i></a>
                                                        <form action="{{ route('remove_item', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button id="{{ $item->id }}" type="submit"
                                                                class="remove-catalog-btn btn btn-danger"><i
                                                                    class="fa-xl fa-solid fa-trash-can-xmark"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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
                lengthMenu: [ 5, 10, 25, 50, 100 ]
            });
            $('.dataTables_scroll').addClass('mb-4');
            $('.dataTables_length').addClass('mb-4');
        })
    </script>
@endsection
