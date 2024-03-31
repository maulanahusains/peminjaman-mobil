<div class="modal-body">
  <div class="row">
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Penangggung Jawab</label>
      <input type="text" class="form-control" value="{{ $peminjaman->PenanggungJawab->username }}" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Kebutuhan Pinjaman</label>
      <input type="text" class="form-control" value="{{ $peminjaman->kebutuhan }}" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
      <input type="text" class="form-control" value="{{ $peminjaman->Kendaraan->Jenis->nama_jenis }}" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Tanggal Pinjam</label>
      <input type="text" id="flatpickr-today" name="tanggal" class="form-control"
        placeholder="Tanggal Mulai to Tanggal Selesai" value="{{ $peminjaman->tanggal_pinjam }}" readonly>
    </div>
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Tanggal Kembali</label>
      <input type="text" id="flatpickr-today" name="tanggal" value="{{ $peminjaman->tanggal_kembali }}"
        class="form-control" placeholder="Tanggal Mulai to Tanggal Selesai" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col mb-2">
      <label for="nameBasic" class="form-label">Agenda</label>
      <textarea name="agenda" id="" cols="30" rows="5" class="form-control" readonly>{{ $peminjaman->agenda }}</textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-sm">
      <small class="text-light fw-medium">Jenis Plat</small>
      <div class="d-flex mt-2 gap-4">
        <div class="form-check">
          <input class="form-check-input" name="jenis_plat" type="radio" value="Ganjil" id="defaultRadio1" checked />
          <label class="form-check-label" for="defaultRadio1">
            {{ $peminjaman->Kendaraan->jenis_plat }}
          </label>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
