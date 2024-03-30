'use strict';

$(function () {
  $('.btn-change-access').on('click', function (e) {
    e.preventDefault();
    let form = $(this).closest('form');
    Swal.fire({
      title: 'Apa kamu yakin?',
      text: 'User tersebut tidak dapat mengakses fitur admin!',
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
});
