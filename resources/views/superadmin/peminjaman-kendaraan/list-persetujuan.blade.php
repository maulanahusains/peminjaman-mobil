@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'List Persetujuan')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/js/forms-pickers.js', 'resources/assets/js/superadmin-peminjaman.js'])
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">List Persetujuan</h3>
      <span>Halaman untuk melihat dan memvalidasi pengajuan peminjam</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tablePersetujuan"
          data-route="{{ route('superadmin.peminjaman-kendaraan.datatable-persetujuan') }}">
          <thead>
            <tr>
              <th>#</th>
              <th>Peminjam</th>
              <th>Kebutuhan Pinjaman</th>
              <th>Tanggal Pinjaman</th>
              <th>Tanggal Kembali</th>
              <th>Jenis Plat</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="modal fade modal-detail" data-bs-focus="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Detail Peminjaman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="response"></div>
      </div>
    </div>
  </div>
@endsection
