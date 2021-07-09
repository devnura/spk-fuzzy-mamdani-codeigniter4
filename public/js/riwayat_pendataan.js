$(document).ready(function () {
  console.log('riwayat pendataan')
  $("#tabel-keluarga").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });

  $('#tabel-keluarga').on('click','.item-view', function(){
   
        $('input[name="nkk"]').val($(this).attr("data-nkk"));
        $('input[name="kepala_keluarga"]').val($(this).attr("data-kepala-keluarga"));
        $('input[name="kelurahan"]').val($(this).attr("data-kelurahan"));
        $('input[name="rt"]').val($(this).attr("data-rt"));
        $('input[name="rw"]').val($(this).attr("data-rw"));

        $('input[name="nilai"]').val($(this).attr("data-nilai"));

        if($(this).attr("data-nilai")<=50){
          var status = "Tidak sehat";
          $('input[name="status"]').addClass('is-invalid');
        }else if($(this).attr("data-nilai")>50 && $(this).attr("data-nilai")<80){
          var status = "Pra-sehat";
          $('input[name="status"]').addClass('is-warning');
        }else if($(this).attr("data-nilai") >=80){
          var status = "Sehat";
          $('input[name="status"]').addClass('is-valid');
        }
        $('input[name="status"]').val(status);

   $.ajax({
      type: "POST",
      url: "http://localhost:8080/profilkesehatan/get_rekapitulasi",
      dataType: "JSON",
      data: {
        id_pendataan: $(this).attr("data-id_pendataan")
      },
      success: function (data) {
        console.log($(this).attr("data-nkk"))
        var html= "";
        var i;
        
        for (i = 0; i < data.length; i++) {
          html += "<tr><td>"+(1+i)+"</td>"+
          "<td>"+data[i]['kuesioner']+"</td>"+
          "<td>"+data[i][i]+"</td></tr>"
        }
        $("#show-rek").html(html);
        $('#modal-view').modal('show');
      },
    });
    return false;
  })
  $("#tanggal_pendataan").datepicker({
    inline: true,
    dateFormat: "yy-mm-dd",
  });
});
