'use strict';

$(function () {
  let indexPengajuan = $('.tablePengajuan'),
    indexRiwayat = $('.tableRiwayat'),
    indexBerjalan = $('.tableBerjalan');

  $('#btnAddPengajuan').on('click', function () {
    $('.modal-add-pengajuan').modal('show');
  });

  $('.btn-add').on('click', function (e) {
    e.preventDefault();
    let idForm = $(this).data('form');
    let form = $(idForm);
    form.submit();
  });

  if (indexPengajuan.length) {
    let routePengajuan = indexPengajuan.data('route');
    indexPengajuan.DataTable({
      processing: true,
      serverSide: true,
      initComplete: function () {
        $('.btn-delete').on('click', function (e) {
          e.preventDefault();
          let form = $(this).closest('form');
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
          }).then(function (result) {
            if (result.value) {
              form.submit();
            }
          });
        });

        $('.btn-detail').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').replaceWith(res);
              $('.modal-detail').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routePengajuan,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'kebutuhan',
          name: 'kebutuhan'
        },
        {
          data: 'tanggal_pinjam',
          name: 'tanggal_pinjam'
        },
        {
          data: 'tanggal_kembali',
          name: 'tanggal_kembali'
        },
        {
          data: 'kendaraan.jenis_plat',
          name: 'kendaraan.jenis_plat'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          name: 'Aksi',
          render: function (data, type, row) {
            return `<div class="d-flex align-items-center gap-2">
            ${row.detail + row.delete}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }

  if (indexBerjalan.length) {
    let routeBerjalan = indexBerjalan.data('route');
    indexBerjalan.DataTable({
      processing: true,
      serverSide: true,
      initComplete: function () {
        $('.btn-detail').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').replaceWith(res);
              $('.modal-detail').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routeBerjalan,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'kebutuhan',
          name: 'kebutuhan'
        },
        {
          data: 'tanggal_pinjam',
          name: 'tanggal_pinjam'
        },
        {
          data: 'tanggal_kembali',
          name: 'tanggal_kembali'
        },
        {
          data: 'kendaraan.jenis_plat',
          name: 'kendaraan.jenis_plat'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          name: 'Aksi',
          render: function (data, type, row) {
            console.log(row);
            return `<div class="d-flex align-items-center gap-2">
            ${row.detail}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }

  if (indexRiwayat.length) {
    let routeRiwayat = indexRiwayat.data('route');
    indexRiwayat.DataTable({
      processing: true,
      serverSide: true,
      initComplete: function () {
        $('.btn-detail').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').empty();
              $('.response').html(res);
              $('.modal-detail').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routeRiwayat,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'kebutuhan',
          name: 'kebutuhan'
        },
        {
          data: 'tanggal_pinjam',
          name: 'tanggal_pinjam'
        },
        {
          data: 'tanggal_kembali',
          name: 'tanggal_kembali'
        },
        {
          data: 'kendaraan.jenis_plat',
          name: 'kendaraan.jenis_plat'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          name: 'Aksi',
          render: function (data, type, row) {
            return `<div class="d-flex align-items-center gap-2">
            ${row.detail}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }
});
