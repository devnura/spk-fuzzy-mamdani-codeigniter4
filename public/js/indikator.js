$(document).ready(function () {
  $("#tabel-kuesioner-keluarga").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });

  function rowcount() {
    var z = $("#tabel-kuesioner-keluarga item-view").length();
    console.log(z);
  }
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
  $("#tanggal_pendataan").datepicker({
    inline: true,
    dateFormat: "dd/mm/yy",
  });

  // INSERT
  $("#tabel-kuesioner-keluarga").on("click", ".item-add", function () {
    $('input[name="nik"]').val($(this).attr("data-nik"));
    $('input[name="nama"]').val($(this).attr("data-nama"));
    $('input[id="umur"]').val($(this).attr("data-umur"));
    $('input[name="tanggal_lahir"]').val($(this).attr("data-tanggal-lahir"));
    $('input[name="jenis_kelamin"]').val($(this).attr("data-jenis-kelamin"));
    $('input[name="hubungan_keluarga"]').val($(this).attr("data-hubungan-keluarga"));
    $("#form-kuesioner").attr(
      "action",
      "http://localhost:8080/profilkesehatan/insert_result"
    );
    // console.log($('input[id="umur"]').val());
    // if($('input[name="hubungan_keluarga"]').val() != 'Istri'){
    //   $('#jenis-4').hide();
    // }
    // if($('input[name="hubungan_keluarga"]').val() == 'Anak'){
    //   if($('input[id="umur"]').val() < 15 ){
    //   $('#jenis-6').show();
    //   }else{
    //     $('#jenis-5').show();
    //   }
    // }else{
    //   $('#jenis-5').hide();
    //   $('#jenis-6').hide();
    // }
  
    $("#modal-add").modal("show");
        return false;
  });


  function show_kuesioner(){
    $.ajax({
      type: "POST",
      url: "http://localhost:8080/profilkesehatan/get_indikator",
      async: true,
      dataType: "json",
      success: function (data) {
        var html = "";
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<div class="form-group mb-4" id="indikator-'+data[i]["id_indikator"]+'">'+
          '<div class=" jenis-'+data[i]["jenis_indikator"]+'"><label><li>'+data[i]["indikator"]+'</li></label>'+
          '<div class="custom-control custom-radio m-3">'+
              '<input class="custom-control-input" type="radio" id="Y'+data[i]["id_indikator"]+'" name="jawaban_'+data[i]["id_indikator"]+'" value="Y">'+
              '<label for="Y'+data[i]["id_indikator"]+'" class="custom-control-label">Sesuai</label>'+
          '</div>'+

          '<div class="custom-control custom-radio m-3">'+
              '<input class="custom-control-input" type="radio" id="T'+data[i]["id_indikator"]+'" name="jawaban_'+data[i]["id_indikator"]+'" value="T">'+
              '<label for="T'+data[i]["id_indikator"]+'" class="custom-control-label">Tidak sesuai</label>'+
          '</div>'+

          '<div class="custom-control custom-radio m-3">'+
              '<input class="custom-control-input" type="radio" id="N'+data[i]["id_indikator"]+'" name="jawaban_'+data[i]["id_indikator"]+'" value="N">'+
              '<label for="N'+data[i]["id_indikator"]+'" class="custom-control-label">Tidak berlaku</label>'+
          '</div>'+
          '</div>'+
          '</div>'; 
        }
        $("#show-indikator").html(html);
        $("#modal-add").modal("show");
      },
      error: (error) => {
        alert(JSON.stringify(error));
        console.log(JSON.stringify(error));
      },
    });
  }

  // UPDATE
  $("#tabel-kuesioner-keluarga").on("click", ".item-view", function () {
    var nik = $(this).attr("data-nik");
    var idpen = $(this).attr("data-idpen");
    $('input[name="view-nik"]').val($(this).attr("data-nik"));
    $('input[name="view-nama"]').val($(this).attr("data-nama"));
    $('input[name="view-tanggal_lahir"]').val($(this).attr("data-tanggal-lahir"));
    $('input[id="view-umur"]').val($(this).attr("data-umur"));
    $('input[name="view-jenis_kelamin"]').val($(this).attr("data-jenis-kelamin"));
    $('input[name="view-hubungan_keluarga"]').val($(this).attr("data-hubungan-keluarga"));
    $.ajax({
      type: "POST",
      url: "http://localhost:8080/profilkesehatan/get_answer/",
      async: true,
      dataType: "json",
      data: {
        nik: nik,
        id_pendataan: idpen,
      },
      success: function (data) {
        var html = "";
        var i;
        var j = 1;
        for (i = 0; i < data.length; i++) {
          html +=
            "<tr>" +
            "<td>" +
            (j+i) +
            "</td>" +
            "<td>" +
            data[i].indikator +
            "</td>" +
            "<td>" +
            data[i].jawaban +
            "</td>";
        }
        $("#show-data-hasil").html(html);
        $("#modal-view").modal("show");
      },
      error: (error) => {
        alert(JSON.stringify(error));
        console.log(JSON.stringify(error));
      },
    });
    return false;
  });
});
