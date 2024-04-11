@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Jenis')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/js/superadmin-datatables.js', 'resources/assets/js/superadmin-sweetalert.js'])

@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kelola Jenis Kendaraan</h3>
      <span>Halaman untuk Mengelola jenis-jenis Kendaraan</span>
    </div>
    <div class="card-body">
      <form action="{{ route('kelola-data.jenis-kendaraan.store') }}" method="POST">
        @csrf
        <div class="col mb-2">
          <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
          <input type="text" name="jenis" class="form-control">
          @error('jenis')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <button class="btn btn-primary float-end" type="submit">Tambah Jenis</button>
      </form>
      <br><br>
      <div class="table-responsive">
        <table class="table tableJenis" data-route="{{ route('kelola-data.jenis-kendaraan.indexJSON') }}">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Jenis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="modal fade modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Edit Jenis Kendaraan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="response"></div>
      </div>
    </div>
  </div>
@endsection
