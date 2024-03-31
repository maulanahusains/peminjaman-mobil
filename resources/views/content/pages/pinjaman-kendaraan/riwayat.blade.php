@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pengajuan Pinjaman')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/js/forms-pickers.js', 'resources/assets/js/user-peminjaman.js'])
@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Riwayat Peminjaman Kendaraan</h3>
      <span>Halaman untuk melihat riwayat peminjaman kendaraan anda yang sudah selesai</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tableRiwayat" data-route="{{ route('peminjaman-kendaraan.list-riwayat-json') }}">
          <thead>
            <tr>
              <th>#</th>
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

  <div class="modal fade modal-detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Detail Peminjaman</h5>
        </div>
        <div class="response"></div>
      </div>
    </div>
  </div>
@endsection
