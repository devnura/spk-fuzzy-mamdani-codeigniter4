//--------------------------------------------------------------------
// untu manajemen user
//--------------------------------------------------------------------
$(document).ready(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
  });
  $("#tabel-user").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
  });

  function notif(icon, title) {
    Toast.fire({
      icon: icon,
      title: title,
    });
  }

  // tampil_data_user();

  // GET UPDATE
  $("#tabel-user").on("click", ".user_edit", function () {
    var id = $(this).attr("data");
    $.ajax({
      type: "POST",
      url: "http://localhost:8080/admin/read_user",
      dataType: "JSON",
      data: {
        result: "json",
        id: id,
      },
      success: function (data) {
        $.each(data, function (i, item) {
          $('input[name="name"]').val(data[i].name);
          $('input[name="email"]').val(data[i].email).attr("readonly", true);
          $('input[name="id"]').val(data[i].id);
          if (data[i].active == "1") {
            $('input[name="active"]').prop("checked", true);
          } else {
            $('input[name="active"]').prop("checked", false);
          }
          $('input[name="jenis_user"][value="' + data[i].level + '"]').attr(
            "checked",
            true
          );
          // tampil_data_user();
          $("#form-user").attr(
            "action",
            "http://localhost:8080/admin/update_user"
          );
        });
      },
      error: (error) => {
        alert(JSON.stringify(error));
        console.log(JSON.stringify(error));
      },
    });
    return false;
  });

  // RESET FORM
  $("#btn-cancel").on("click", function () {
    reset_form_user();
  });

  // DELETE USER
  $("#tabel-user").on("click", ".user_delete", function () {
    $.ajax({
      type: "POST",
      url: "http://localhost:8080/admin/delete_user",
      dataType: "JSON",
      data: {
        id: $(this).attr("data"),
      },
      success: function (data) {
        Toast.fire({
          icon: "success",
          title: "data berhasil disimpan",
        });
        tampil_data_user();
        reset_form_user();
      },
      error: (error) => {
        Toast.fire({
          icon: "error",
          title: "data gagal disimpan",
        });
      },
    });
    return false;
  });

  // READ DATA
  function tampil_data_user() {
    $.ajax({
      type: "POST",
      url: "/admin/read_user",
      async: true,
      dataType: "json",
      data: {
        table: "users",
      },
      success: function (data) {
        var html = "";
        var i;
        var active = "";
        var user_group = "";
        for (i = 0; i < data.length; i++) {
          if (data[i].active == 1) {
            active = '<span class="badge badge-success">aktif</span>';
          } else if (data[i].active == 2) {
            active = '<span class="badge badge-danger">non-aktif</span>';
          }
          if (data[i].level == 1) {
            user_group = '<span class="badge badge-danger">admin</span>';
          } else if (data[i].level == 2) {
            user_group = '<span class="badge badge-warning">supervisor</span>';
          } else if (data[i].level == 3) {
            user_group = '<span class="badge badge-success">surveyor</span>';
          }
          html +=
            "<tr>" +
            "<td>" +
            i +
            "</td>" +
            "<td>" +
            data[i].name +
            "</td>" +
            "<td>" +
            data[i].email +
            "</td>" +
            '<td class="text-center">' +
            active +
            "</td>" +
            '<td class="text-center">' +
            user_group +
            "</td>" +
            '<td class="text-right">' +
            '<button class="btn btn-warning btn-sm user_edit mr-2" data="' +
            data[i].id +
            '"><i class="fas fa-pencil-alt"></i></button>' +
            '<button class="btn btn-danger btn-sm user_delete" data="' +
            data[i].id +
            '"><i class="fas fa-trash"></i></button>' +
            "</td></tr>";
        }
        $("#show-data").html(html);
        $("#tabel-user").DataTable({
          paging: true,
          lengthChange: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: true,
          responsive: true,
        });
      },
      error: (error) => {
        console.log(error);
      },
    });
  }

  function reset_form_user() {
    $("#form-user").trigger("reset");
    $("#form-user").attr("action", "/admin/create_user");
    $('input[name="name"]').attr("readonly", false);
    $('input[name="jenis_user"]').attr("checked", false);
    $('input[name="active"]').attr("checked", false);
  }

  function save_user() {
    $.ajax({
      type: "POST",
      url: $("#form-user").attr("action"),
      dataType: "JSON",
      data: {
        id: $('input[name="id"]').val(),
        name: $('input[name="name"]').val(),
        email: $('input[name="email"]').val(),
        password: $('input[name="password"]').val(),
        active: $('input[name="active"]').val(),
        jenis_user: $('input[name="jenis_user"]:checked').val(),
      },
      success: function (data) {
        Toast.fire({
          icon: "success",
          title: "data berhasil disimpan",
        });
        tampil_data_user();
        reset_form_user();
      },
      error: (error) => {
        Toast.fire({
          icon: "error",
          title: "data gagal disimpan",
        });
      },
    });
    return false;
  }
});

//--------------------------------------------------------------------
