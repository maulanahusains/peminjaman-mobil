<div class="modal-body">
  <div class="row">
    <form action="{{ route('kelola-data.kendaraan.update', $kendaraan->id) }}" method="POST"
      id="formUpdate{{ $kendaraan->id }}">
      @method('PUT')
      @csrf
      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
        <select name="jenis" class="form-control select2">
          <option value=""></option>
          @foreach ($jenis as $item)
            <option value="{{ $item->id }}" {{ $item->id == $kendaraan->id_jenis ? 'selected' : '' }}>
              {{ $item->nama_jenis }}</option>
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
            <option value="{{ $user->id }}" {{ $user->id == $kendaraan->id_user ? 'selected' : '' }}>
              {{ $user->username }}</option>
          @endforeach
        </select>
        @error('pemilik')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $kendaraan->nama }}"
          placeholder="Nama Kendaraan">
        @error('nama')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Tipe</label>
        <input type="text" name="tipe" class="form-control" value="{{ $kendaraan->tipe }}"
          placeholder="Tipe Kendaraan">
        @error('tipe')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Plat Nomor</label>
        <input type="text" name="plat_nomor" class="form-control" value="{{ $kendaraan->plat_nomor }}"
          placeholder="Plat Nomor Kendaraan">
        @error('plat_nomor')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
  <button type="submit" class="btn btn-primary btn-submit" data-form="#formUpdate{{ $kendaraan->id }}">Simpan</button>
</div>


<script>
  $('.btn-submit').on('click', function(e) {
    e.preventDefault();
    let idForm = $(this).data('form');
    let form = $(idForm);
    form.submit();
  });
</script>
