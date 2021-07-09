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
  $("#tabel-tambah-keluarga").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });
  $("#btn-add-keluarga").on('click', function(){
    $('#alert-keluarga').hide()
    $('#modal-add').modal('show');
  })
  // $("#tabel-user").on("click", ".user_edit", function () {
  $('#tabel-tambah-keluarga').on('click','#item-add', function(){
    $('#alert-keluarga').hide()
    var nkk = $(this).attr("data-nkk");
    var tahun_aktif = $(this).attr("data-tahun-aktif");
    $.ajax({
      type: "POST",
      url: "http://localhost:8080/pendataan_keluarga/check_pendataan",
      dataType: "JSON",
      data: {
        nkk: nkk,
        tahun_aktif: tahun_aktif
      },
      success: function (data) {
        if(data.status == true){
          $('#alert-keluarga').show()
        }else{
          $('#alert-keluarga').hide();  
          $('input[name="nkk"]').val(nkk); 
        }
      },
    });
    return false;
  })
  $("#tanggal_pendataan").datepicker({
    inline: true,
    dateFormat: "yy-mm-dd",
  });
});
