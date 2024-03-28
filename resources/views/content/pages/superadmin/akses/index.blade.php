@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Manajemen Akses')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/js/superadmin-sweetalert.js'])
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manajemen Akses</h3>
            <span>Untuk mengatur akses admin pada user</span>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#manipulateAdmin">Tambah Akses
                User</button>
            <br><br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_admin as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <form action="{{ route('manajemen-akses.manipulate_admin') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        <button class="btn btn-sm btn-danger btn-delete" type="submit"><i
                                                class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="manipulateAdmin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add user access</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('manajemen-akses.manipulate_admin') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Name</label>
                                <select name="user" class="form-control select2">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
