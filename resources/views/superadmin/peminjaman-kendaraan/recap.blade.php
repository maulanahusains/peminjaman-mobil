@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Rekap')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/js/forms-pickers.js', 'resources/assets/js/superadmin-peminjaman.js'])
@endsection
@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div class="kontainer">
        <h3 class="card-title">List Rekap</h3>
        <span>Halaman untuk melihat dan merekap peminjaman</span>
      </div>
      <button class="btn btn-sm btn-primary btn-recap"
        data-route="{{ route('superadmin.peminjaman-kendaraan.pdf-recap') }}">Download Data</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tableRecap" data-route="{{ route('superadmin.peminjaman-kendaraan.datatable-recap') }}">
          <thead>
            <tr>
              <th>#</th>
              <th>Peminjam</th>
              <th>Kebutuhan Pinjaman</th>
              <th>Tanggal Pinjaman</th>
              <th>Tanggal Kembali</th>
              <th>Jenis Plat</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection
