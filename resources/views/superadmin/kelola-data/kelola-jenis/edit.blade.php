<div class="modal-body">
    <div class="row">
        <form action="{{ route('kelola-data.jenis-kendaraan.update', $jenis->id) }}" method="POST" id="formUpdate{{$jenis->id}}">
            @method('PUT')
            @csrf
            <div class="col mb-2">
                <label for="nameBasic" class="form-label">Jenis Kendaraan</label>
                <input type="text" name="jenis" class="form-control" value="{{ $jenis->nama_jenis }}">
                @error('jenis')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-primary btn-submit" data-form="#formUpdate{{$jenis->id}}">Simpan</button>
</div>


<script>
    $('.btn-submit').on('click', function (e) {
      e.preventDefault();
      let idForm = $(this).data('form');
      let form = $(idForm);
      form.submit();
    });
</script>
