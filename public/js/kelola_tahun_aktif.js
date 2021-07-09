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
 //Date range picker with time picker
 $('#reservation').daterangepicker({
  locale: {
    format: 'YYYY/MM/DD'
  }
});

$('#btn-add-tahun').on('click', function(){
  $('#alert-tahun').hide();
  $('#form-add').attr('action', 'http://localhost:8080/admin/create_tahun_aktif');
  $('#modal-add').modal('show');
});

$('#btn-submit').on('click', function(){
  var tahun_aktif = $('input[name="tahun_aktif"]').val();
  if(tahun_aktif == ""){
    $('input[name="tahun_aktif"]').addClass('is-invalid')
    return false;
  }else{
  $.ajax({
    type: "POST",
    url: "http://localhost:8080/admin/check_tahun/",
    async: true,
    dataType: "json",
    data: {
      tahun_aktif: tahun_aktif,
    },
    success: function (data) {
      if(data.status == true){
        $('#alert-tahun').show()
        $('input[name="tahun_aktif"]').addClass('is-invalid')
      }else{
        $('#alert-tahun').hide(); 
        $('#form-add').submit(); 
      }
    }
  });
  }
})

  $('#indikator').val(new Date().getFullYear());
});
