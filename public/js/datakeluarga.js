$(document).ready(function () {
  $("#tabel-keluarga").DataTable({
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

  $("#show-data").on('click', '.item-edit', function(){

    $('input[name="nkk"]').val($(this).attr("data-nkk"));
    $('input[name="kepala_keluarga"]').val($(this).attr("data-kepala-keluarga"));
    $('input[name="jumlah_art"]').val($(this).attr("data-jumlah-art"));
    $('input[name="rt"]').val($(this).attr("data-rt"));
    $('input[name="rw"]').val($(this).attr("data-rw"));
    $('#form-keluarga').attr('action', 'http://localhost:8080/datakeluarga/update_keluarga');
    $('#modal-keluarga').modal('show');
  })
});
