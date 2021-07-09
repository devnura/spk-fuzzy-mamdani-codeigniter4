$(document).ready(function () {
  $("#tabel-tahun-aktif").DataTable({
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
  
      //Date range picker
      // $('#reservation').daterangepicker()
});
