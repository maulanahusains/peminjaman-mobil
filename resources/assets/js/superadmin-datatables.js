'use strict';

$(function () {
  let indexJenisKendaraan = $('.tableJenis'),
    indexKendaraan = $('.tableKendaraan'),
    indexKaryawan = $('.tableKaryawan');

  if (indexJenisKendaraan.length) {
    let routeJenis = indexJenisKendaraan.data('route');
    indexJenisKendaraan.DataTable({
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

        $('.btn-edit').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').replaceWith(res);
              $('.modal-edit').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routeJenis,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'No'
        },
        {
          data: 'nama_jenis',
          name: 'Jenis'
        },
        {
          name: 'Aksi',
          render: function (data, type, row) {
            return `<div class="d-flex align-items-center gap-2">
            ${row.edit + row.delete}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }

  if (indexKendaraan.length) {
    let routeKendaraan = indexKendaraan.data('route');
    indexKendaraan.DataTable({
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

        $('.btn-edit').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').replaceWith(res);
              $('.modal-edit').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routeKendaraan,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'id'
        },
        {
          data: 'nama',
          name: 'nama'
        },
        {
          data: 'tipe',
          name: 'tipe'
        },
        {
          data: 'pemilik.username',
          name: 'pemilik.username'
        },
        {
          data: 'jenis.nama_jenis',
          name: 'jenis.nama_jenis'
        },
        {
          data: 'jenis_plat',
          name: 'jenis_plat'
        },

        {
          name: 'Aksi',
          render: function (data, type, row) {
            return `<div class="d-flex align-items-center gap-2">
            ${row.edit + row.delete}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }

  if (indexKaryawan.length) {
    let routeKaryawan = indexKaryawan.data('route');
    indexKaryawan.DataTable({
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

        $('.btn-edit').on('click', function (e) {
          e.preventDefault();
          let route = $(this).data('route');
          $.ajax({
            url: route,
            method: 'GET',
            type: 'JSON',
            success: function (res) {
              $('.response').replaceWith(res);
              $('.modal-edit').modal('show');
            }
          });
        });
      },
      ajax: {
        url: routeKaryawan,
        type: 'GET'
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'username',
          name: 'username'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          name: 'isAdmin',
          render: function (data, opt, row) {
            if (row.isAdmin) {
              return 'Ya';
            }
            return 'Tidak';
          }
        },

        {
          name: 'Aksi',
          render: function (data, type, row) {
            return `<div class="d-flex align-items-center gap-2">
            ${row.edit + row.delete}
            </div>`;
          }
        }
      ],
      pageLength: 25
    });
  }
});
