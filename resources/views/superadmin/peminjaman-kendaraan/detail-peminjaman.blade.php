<div class="modal-body">
  <div class="row">
    <div class="col-md-7">
      <table class="table table-bordered">
        <tr>
          <th colspan="2">Peminjaman</th>
        </tr>
        <tr>
          <th>#</th>
          <td>#{{ $peminjaman->id }}</td>
        </tr>
        <tr>
          <th>Penanggung Jawab</th>
          <td>{{ $peminjaman->PenanggungJawab->name }}</td>
        </tr>
        <tr>
          <th>Kebutuhan Pinjam</th>
          <td>{{ $peminjaman->kebutuhan }}</td>
        </tr>
        <tr>
          <th>Tanggal Pinjam</th>
          <td>{{ $peminjaman->tanggal_pinjam }}</td>
        </tr>
        <tr>
          <th>Tanggal Selesai</th>
          <td>{{ $peminjaman->tanggal_kembali }}</td>
        </tr>
        <tr>
          <th>Jenis Plat</th>
          <td>{{ $peminjaman->Kendaraan->jenis_plat }}</td>
        </tr>
        <tr>
          <th>Agenda</th>
          <td>{{ $peminjaman->agenda }}</td>
        </tr>
      </table>
    </div>

    {{-- Kendaraan --}}
    <div class="col-md-5">
      <table class="table table-bordered">
        <tr>
          <th colspan="2">Detail Kendaraan</th>
        </tr>
        <tr>
          <th>Id Kendaraan</th>
          <td>#{{ $peminjaman->Kendaraan->id }}</td>
        </tr>
        <tr>
          <th>Pemilik</th>
          <td>{{ $peminjaman->Kendaraan->Pemilik->name }}</td>
        </tr>
        <tr>
          <th>Jenis Kendaraan</th>
          <td>{{ $peminjaman->Kendaraan->Jenis->nama_jenis }}</td>
        </tr>
        <tr>
          <th>Jenis Plat</th>
          <td>{{ $peminjaman->Kendaraan->jenis_plat }}</td>
        </tr>
        <tr>
          <th>Nama Kendaraan</th>
          <td>{{ $peminjaman->Kendaraan->nama }}</td>
        </tr>
        <tr>
          <th>Tipe Kendaraan</th>
          <td>{{ $peminjaman->Kendaraan->tipe }}</td>
        </tr>
      </table>
    </div>
  </div>
</div>

<div class="modal-footer">
  <button class="btn btn-success btn-submit"
    data-route="{{ route('superadmin.peminjaman-kendaraan.setuju', $peminjaman->id) }}">Setuju</button>
  <button class="btn btn-danger btn-tolak"
    data-route="{{ route('superadmin.peminjaman-kendaraan.tolak', $peminjaman->id) }}"">Tolak</button>
  {{-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button> --}}
</div>

<script>
  $(function() {
    let csrfToken = $('meta[name="csrf_token"]').attr('content');

    $('.btn-submit').on('click', function(e) {
      e.preventDefault();
      let form = $(this).data('route');
      Swal.fire({
        title: 'Apa kamu yakin?',
        text: 'Anda tidak dapat mengembalikannya!',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
          cancelButton: 'btn btn-label-secondary waves-effect waves-light'
        },
        buttonsStyling: false
      }).then(function(result) {
        if (result.value) {
          let dataToSend = {
            _token: csrfToken,
          };

          $.ajax({
            url: form,
            method: 'PUT',
            headers: {
              "X-CSRF-TOKEN": csrfToken
            },
            data: dataToSend,
            success: function(res) {
              window.location.href =
                "{{ route('session-message') }}?type=success&message=Sukses+Validasi+Peminjaman!"
            },
            error: function(err) {
              window.location.href =
                "{{ route('session-message') }}?type=error&message=Gagal+Validasi+Peminjaman!"
            }
          });
        }
      });
    });

    $('.btn-tolak').on('click', function(e) {
      e.preventDefault();
      let form = $(this).data('route');
      let {
        value: alasan
      } = Swal.fire({
        title: 'Apa kamu yakin?',
        text: 'Berikan Alasan Penolakan',
        icon: 'warning',
        input: 'text',
        inputValue: '',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Tolak',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
          cancelButton: 'btn btn-label-secondary waves-effect waves-light'
        },
        buttonsStyling: false,
        inputValidator: (value) => {
          if (!value) {
            return "Alasan Harus diisi!";
          }
        }
      }).then(function(result) {
        if (result.value) {
          let dataToSend = {
            _token: csrfToken,
            alasan: result.value
          };

          $.ajax({
            url: form,
            method: 'PUT',
            headers: {
              "X-CSRF-TOKEN": csrfToken
            },
            data: dataToSend,
            success: function(res) {
              window.location.href =
                "{{ route('session-message') }}?type=success&message=Sukses+Menolak+Peminjaman!"
            },
            error: function(err) {
              window.location.href =
                "{{ route('session-message') }}?type=error&message=Gagal+Menolak+Peminjaman!"
            }
          })
        }
      });
    });
  });
</script>
