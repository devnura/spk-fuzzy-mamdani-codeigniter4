$(document).ready(function () {
  $("#tabel-anggota-keluarga").DataTable({
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

  $('#btn-modal-add').on('click',  function(){
    
   

    $('input[name="action"]').val("insert");
    $('#alert-nik').hide(); 
    $('#modal-add').modal('show');
    
  })

  $("#show-data").on('click', '.item-edit', function(){
   
    $('input[name="nkk"]').val($(this).attr("data-nkk"));
    $('input[name="nik"]').val($(this).attr("data-nik"));
    $('input[name="nik"]').attr('readonly', 'readonly');
    $('input[name="nama"]').val($(this).attr("data-nama"));
    $('input[name="tanggal_lahir"]').val($(this).attr("data-tanggal-lahir"));
    $('#jenis_kelamin option[value="'+$(this).attr("data-jenis-kelamin")+'"]').attr('selected', 'selected');
    $('#hubungan_keluarga option[value="'+$(this).attr("data-hubungan-keluarga")+'"]').attr('selected', 'selected');

    $('#form-anggota').attr('action', 'http://localhost:8080/anggotakeluarga/update_data');

  })
   
function check_nik(){
  $.ajax({
    type: "POST",
    url: "http://localhost:8080/anggotakeluarga/check_nik",
    async: true,
    dataType: "json",
    data: {
      nik: $('input[name="nik"]').val(),
    },
    success: function (data) {
      if (data.status == true){
        $('#alert-nik').show();
        $('input[name="nik"]').addClass('is-invalid');
      }else{
        $('#form-anggota').attr('action', 'http://localhost:8080/anggotakeluarga/add_anggotas');
        $('#form-anggota').submit();
      }
    }
  });
  return false;
}

});
