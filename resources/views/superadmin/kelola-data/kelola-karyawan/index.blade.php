@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Manajemen Akses')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/js/superadmin-datatables.js', 'resources/assets/js/superadmin-sweetalert.js', 'resources/assets/js/superadmin-jquery.js'])

@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kelola Karyawan</h3>
      <span>Halaman untuk Mengelola Pengguna</span>
    </div>
    <div class="card-body">
      <button class="btn btn-primary btn-sm" id="btnAddKaryawan">Tambah Data</button>
      <div class="table-responsive">
        <table class="table tableKaryawan" data-route="{{ route('kelola-data.karyawan.indexJSON') }}">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Admin</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="modal fade modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form action="{{ route('kelola-data.karyawan.store') }}" method="POST" id="formAdd">
              @csrf
              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Karyawan">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Nik</label>
                <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" name="nik"
                  class="form-control" placeholder="Nik Karyawan">
                @error('nik')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username Karyawan">
                @error('username')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email Karyawan">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password karyawan">
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Admin</label>
                <select name="isAdmin" class="form-control select2">
                  <option value="1">Ya</option>
                  <option value="0" selected>Tidak</option>
                </select>
                @error('isAdmin')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary btn-add" data-form="#formAdd">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Edit Kendaraan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="response"></div>
      </div>
    </div>
  </div>
@endsection
