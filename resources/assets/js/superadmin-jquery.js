'use strict';

$(function () {
  $('#btnAddKendaraan').on('click', function () {
    $('.modal-add').modal('show');
  });

  $('#btnAddKaryawan').on('click', function () {
    $('.modal-add').modal('show');
  });

  $('.btn-add').on('click', function (e) {
    e.preventDefault();
    let idForm = $(this).data('form');
    let form = $(idForm);
    form.submit();
  });
});
