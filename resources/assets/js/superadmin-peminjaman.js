'use strict';

$(function () {
  let indexPersetujuan = $('.tablePersetujuan'),
    indexBerjalan = $('.tableBerjalan'),
    indexRecap = $('.tableRecap');

  $('.btn-recap').on('click', function () {
    let route = $(this).data('route');
    Swal.fire({
      title: 'Apa kamu yakin?',
      text: 'Sistem akan otomatis mendownload file!',
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
        window.location.href = route;
      }
    });
  });

  if (indexPersetujuan.length) {
    let routePersetujuan = indexPersetujuan.data('route');
    indexPersetujuan.DataTable({
      processing: true,
      serverSide: true,
      initComplete: function () {
        $('.btn-detail').on('click', function (e) {
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
        url: routePersetujuan,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'penanggung_jawab.name',
          name: 'penanggung_jawab.name'
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
          data: 'detail',
          name: 'Aksi'
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
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
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
          data: 'penanggung_jawab.name',
          name: 'penanggung_jawab.name'
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
          data: 'detail',
          name: 'Aksi'
        }
      ],
      pageLength: 25
    });
  }

  if (indexRecap.length) {
    let routeRecap = indexRecap.data('route');
    indexRecap.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: routeRecap,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'penanggung_jawab.name',
          name: 'penanggung_jawab.name'
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
        }
      ],
      pageLength: 25
    });
  }
});
