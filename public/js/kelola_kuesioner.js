$(document).ready(function () {
  $("#tabel-kuesioner").DataTable({
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

  $("#show-indikator").on("click", ".item-edit", function () {
    var id = $(this).attr("data-id");
    var jenis = $(this).attr("data-jenis-indikator");
    var indikator = $(this).attr("data-indikator");
    var kriteria = $(this).attr("data-kriteria");
    $("#for-id")
    console.log(id,indikator,kriteria);
    $("#form-indikator").attr("action", "http://localhost:8080/admin/save_indikator");
    $("#form-indikator").append('<input type="hidden" name="id_indikator" value="'+id+'">');
    $('#id_kriteria').val(kriteria);
    $('textarea[name="indikator"]').val(indikator);
    $("#modal-add").modal("show");
  });


});
