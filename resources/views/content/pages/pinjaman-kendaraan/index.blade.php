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
      <h3 class="card-title">Peminjaman Kendaraan</h3>
      <span>Halaman untuk melihat dan menambah pengajuan anda</span>
    </div>
    <div class="card-body">
      <button class="btn btn-primary btn-sm" id="btnAddPengajuan">Tambah Pengajuan</button>
      <div class="table-responsive">
        <table class="table tablePengajuan" data-route="{{ route('peminjaman-kendaraan.list-pengajuan-json') }}">
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

  <div class="card mt-4">
    <div class="card-header">
      <h3 class="card-title">Peminjaman Berjalan</h3>
      <span>Peminjaman dengan status berjalan</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tableBerjalan" data-route="{{ route('peminjaman-kendaraan.list-berjalan-json') }}">
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

  <div class="modal fade modal-add-pengajuan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Pengajuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form action="{{ route('peminjaman-kendaraan.tambah-pengajuan') }}" method="POST" id="formAdd">
              @csrf
              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Penangggung Jawab</label>
                <input type="text" class="form-control" value="{{ Auth::User()->username }}" readonly>
                <input type="hidden" class="form-control" value="{{ Auth::User()->id }}" name="penanggung_jawab">
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Kebutuhan Pinjaman</label>
                <select name="kebutuhan" id="" class="select2">
                  <option value="Pribadi" selected>Pribadi</option>
                  <option value="Kantor">Kantor</option>
                </select>
                @error('kebutuhan')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
                <select name="jenis" id="" class="select2">
                  <option value="Apapun" selected>Apapun</option>
                  @foreach ($jenis as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_jenis }}</option>
                  @endforeach
                </select>
                @error('kebutuhan')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Tanggal Pinjam dan Kembali</label>
                <input type="text" id="flatpickr-today" name="tanggal" class="form-control"
                  placeholder="Tanggal Mulai to Tanggal Selesai">
                @error('tanggal')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col mb-2">
                <label for="nameBasic" class="form-label">Agenda</label>
                <textarea name="agenda" id="" cols="30" rows="5" class="form-control"></textarea>
                @error('agenda')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-sm">
                <small class="text-light fw-medium">Jenis Plat</small>
                <div class="d-flex mt-2 gap-4">
                  <div class="form-check">
                    <input class="form-check-input" name="jenis_plat" type="radio" value="Ganjil" id="defaultRadio1"
                      checked />
                    <label class="form-check-label" for="defaultRadio1">
                      Ganjil
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="jenis_plat" type="radio" value="Genap" id="defaultRadio2" />
                    <label class="form-check-label" for="defaultRadio2">
                      Genap
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="jenis_plat" type="radio" value="Apapun"
                      id="defaultRadio3" />
                    <label class="form-check-label" for="defaultRadio3">
                      Apapun
                    </label>
                  </div>
                </div>
                @error('jenis_plat')
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

  <div class="modal fade modal-detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
