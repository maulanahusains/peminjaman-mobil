@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Kendaraan')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/js/forms-selects.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/js/superadmin-datatables.js', 'resources/assets/js/superadmin-sweetalert.js', 'resources/assets/js/superadmin-jquery.js'])

@endsection
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kelola Kendaraan</h3>
      <span>Halaman untuk Mengelola Kendaraan-Kendaraan Pengguna</span>
    </div>
    <div class="card-body">
      <button class="btn btn-primary btn-sm" id="btnAddKendaraan">Tambah Data</button>
      <div class="table-responsive">
        <table class="table tableKendaraan" data-route="{{ route('kelola-data.kendaraan.indexJSON') }}">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tipe</th>
              <th>Pemilik</th>
              <th>Jenis</th>
              <th>Plat</th>
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
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Kendaraan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form action="{{ route('kelola-data.kendaraan.store') }}" method="POST" id="formAdd">
              @csrf
              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
                <select name="jenis" class="form-control select2">
                  <option value=""></option>
                  @foreach ($jenis as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_jenis }}</option>
                  @endforeach
                </select>
                @error('jenis')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Pemilik</label>
                <select name="pemilik" class="form-control select2">
                  <option value=""></option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                  @endforeach
                </select>
                @error('pemilik')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Kendaraan">
                @error('nama')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Tipe</label>
                <input type="text" name="tipe" class="form-control" placeholder="Tipe Kendaraan">
                @error('tipe')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" placeholder="Plat Nomor Kendaraan">
                @error('plat_nomor')
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
