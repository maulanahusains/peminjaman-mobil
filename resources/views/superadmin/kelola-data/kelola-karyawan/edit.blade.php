<div class="modal-body">
  <div class="row">
    <form action="{{ route('kelola-data.karyawan.update', $karyawan->id) }}" method="POST"
      id="formUpdate{{ $karyawan->id }}">
      @method('PUT')
      @csrf
      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $karyawan->name }}"
          placeholder="Nama Karyawan">
        @error('name')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Nik</label>
        <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" name="nik" class="form-control"
          value="{{ $karyawan->nik }}" placeholder="Nik Karyawan">
        @error('nik')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="{{ $karyawan->username }}"
          placeholder="Username Karyawan">
        @error('username')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="col mb-2">
        <label for="nameBasic" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $karyawan->email }}"
          placeholder="Email Karyawan">
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
          <option value="1" {{ $karyawan->isAdmin ? 'selected' : '' }}>Ya</option>
          <option value="0" {{ !$karyawan->isAdmin ? 'selected' : '' }}>Tidak</option>
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
  <button type="submit" class="btn btn-primary btn-submit" data-form="#formUpdate{{ $karyawan->id }}">Simpan</button>
</div>


<script>
  $('.btn-submit').on('click', function(e) {
    e.preventDefault();
    let idForm = $(this).data('form');
    let form = $(idForm);
    form.submit();
  });
</script>
