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
  console.log($(this).attr("data-id-kriteria"))
  $('#form-add').append('<input type="hidden" name="id_kriteria" value="'+$('#btn-add').attr("data-id-kriteria")+'">')
  // $('#form-add').attr('action', 'http://localhost:8080/admin/add_kriteria');
  $('#modal-add').modal('show');
});

$("#show-data").on('click', '.item-edit-kategori', function(){
  $('input[name="nama_kategori"]').val($(this).attr("data-nama"));
  $('input[name="left_side"]').val($(this).attr("data-left-side"));
  $('input[name="mid"]').val($(this).attr("data-mid"));
  $('input[name="right_side"]').val($(this).attr("data-right-side"));
  $('#form-add').append('<input type="hidden" name="id_kategori" value="'+$(this).attr("data-id")+'">')
  $('#form-add').append('<input type="hidden" name="id_kriteira" value="'+$(this).attr("data-id-kriteria")+'">')
   $('#modal-add').modal('show');
});

$("#show-data").on('click', '.kelola_kategori', function(){
  // $('input[name="keterangan"]').val($(this).attr("data-keterangan"));
  $('input[name="kriteria"]').val($(this).attr("data-nama"));
console.log($(this).attr("data-nama"))
  // $('#form-add').append('<input type="hidden" name="id_kriteria" value="'+$(this).attr("data-id")+'">')
  // $('#form-add').attr('action', 'http://localhost:8080/admin/add_kriteria');
  $('#modal-kategori').modal('show');
});
$('#btn-add-kategori').on('click', function(){
  $('#form-kategori').submit();
})


  $('#indikator').val(new Date().getFullYear());
});
