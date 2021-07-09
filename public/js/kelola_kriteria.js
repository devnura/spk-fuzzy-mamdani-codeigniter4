$(document).ready(function () {
  $("#tabel-kriteria").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });

  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
  });
  // var yeart = new Date();
 //Date range picker with time picker
 $('#reservation').daterangepicker({
  locale: {
    format: 'YYYY/MM/DD'
  }
});

$('#btn-add').on('click', function(){
  $('input[name="keterangan"]').val('input');
  $('#form-add').attr('action', 'http://localhost:8080/kriteria/save_kriteria');
  $('#modal-add').modal('show');
});

$("#show-data").on('click', '.item-edit-kriteria', function(){
  $('input[name="keterangan"]').val($(this).attr("data-keterangan"));
  $('input[name="nama"]').val($(this).attr("data-nama"));
  $('#form-add').append('<input type="hidden" name="id_kriteria" value="'+$(this).attr("data-id")+'">')
  $('#form-add').attr('action', 'http://localhost:8080/kriteria/save_kriteria');
  $('#modal-add').modal('show');
});

$("#show-data").on('click', '.kelola_kategori', function(){

  $('input[name="kriteria"]').val($(this).attr("data-nama"));
  get_kategori($(this).attr("data-id"));
  // $('#form-add').append('<input type="hidden" name="id_kriteria" value="'+$(this).attr("data-id")+'">')
  // $('#form-add').attr('action', 'http://localhost:8080/kriteria/add_kriteria');
  $('#modal-kategori').modal('show');
});

$('#btn-submit-kategori').on('click', function(){
if($('input[name="keterangan"]').val() != ""){
  $('input[name="kategori"]').addClass('is-invalid');
}  
})


  $('#indikator').val(new Date().getFullYear());
});