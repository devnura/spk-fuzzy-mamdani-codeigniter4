$(document).ready(function () {
    $("#tabel-tahun").DataTable({
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
  
    //Datemask dd/mm/yyyy
    // $("#tanggal_pendataan").inputmask("dd/mm/yyyy", {
    //   placeholder: "dd/mm/yyyy",
    // });
    // $("#tanggal_pendataan").datepicker({
    //   inline: true,
    //   dateFormat: "dd/mm/yy",
    // });
  });
  