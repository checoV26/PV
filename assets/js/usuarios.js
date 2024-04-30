let tblUsuarios;
$(document).ready(() => {
  $("#formNewUser").on("submit", function (e) {
    saveUser(e);
  });
  listUser();
});

let saveUser = (e) => {
  e.preventDefault();
  const idUser = $("#idUser").val();
  const nombre = $("#nombre").val();
  const apellidoP = $("#apellidoP").val();
  const apellidoM = $("#apellidoM").val();
  const caja = $("#caja").val();
  const user = $("#user").val();
  const pass = $("#pass").val();
  const cPass = $("#cPass").val();

  if (idUser == "") {
    if (
      nombre == "" ||
      apellidoP == "" ||
      apellidoM == "" ||
      caja == "" ||
      user == "" ||
      pass == "" ||
      cPass == ""
    ) {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Todos los campos son obligatorios!",
        showConfirmButton: false,
        timer: 2500,
      });
    } else if (pass != cPass) {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Las contraseña no coincide!",
        showConfirmButton: false,
        timer: 2500,
      });
    } else {
      $.post(
        `${base_url}usuarios/registrar`,
        { idUser, nombre, apellidoP, apellidoM, caja, user, pass, cPass },
        (result) => {
          const response = JSON.parse(result);
          Swal.fire({
            position: "center",
            icon: response.icon,
            title: response.msg,
            showConfirmButton: false,
            timer: 2500,
          });
          if (response.status == 200) {
            tblUsuarios.ajax.reload();
            $("#modalClose").click();
            $("#mPass").text("");
            $("#mCPass").text("");
          }
        }
      );
    }
  } else {
    if (
      nombre == "" ||
      apellidoP == "" ||
      apellidoM == "" ||
      caja == "" ||
      user == ""
    ) {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Todos los campos son obligatorios!",
        showConfirmButton: false,
        timer: 2500,
      });
    } else if (pass != cPass) {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Las contraseña no coincide!",
        showConfirmButton: false,
        timer: 2500,
      });
    } else {
      $.post(
        `${base_url}usuarios/registrar`,
        { idUser, nombre, apellidoP, apellidoM, caja, user, pass, cPass },
        (result) => {
          console.log(result);
          const response = JSON.parse(result);
          Swal.fire({
            position: "center",
            icon: response.icon,
            title: response.msg,
            showConfirmButton: false,
            timer: 2500,
          });
          if (response.status == 200) {
            tblUsuarios.ajax.reload();
            $("#modalClose").click();
            $("#mPass").text("");
            $("#mCPass").text("");
          }
        }
      );
    }
  }
};
let editarUsuario = (id) => {
  listarCajas();
  const url = `${base_url}usuarios/editar/${id}`;
  $("#modalU").modal("show");
  $("#titleModalUsuario").text("Actualizar usuario");
  $("#saveUser").html("Actualizar");
  $("#pass").attr("required", false);
  $("#cPass").attr("required", false);
  $.post(url, (result) => {
    const response = JSON.parse(result);
    $("#idUser").val(id);
    $("#nombre").val(response.nombre);
    $("#apellidoP").val(response.apellidoP);
    $("#apellidoM").val(response.apellidoM);
    $("#caja").val(response.idCaja);
    $("#user").val(response.usuario);
  });
};
let statusUser = (id, status) => {
  const url = `${base_url}usuarios/status`;
  $.post(url, { id, status }, (result) => {
    const response = JSON.parse(result);
    Swal.fire({
      position: "center",
      icon: response.icon,
      title: response.msg,
      showConfirmButton: false,
      timer: 1500,
    });
    tblUsuarios.ajax.reload();
  });
};
let listUser = () => {
  tblUsuarios = $("#userTable")
    .dataTable({
      language: {
        search: "BUSCAR",
        info: "_START_ A _END_ DE _TOTAL_ ELEMENTOS",
      },
      dom: "Bfrtip",
      buttons: ["copy", "excel", "pdf"],
      autoFill: true,
      colReorder: true,
      rowReorder: true,
      ajax: {
        url: `${base_url}usuarios/listar`,
        type: "post",
        dataType: "json",
        error: (e) => {
          console.log("Error función listar() \n" + e.responseText);
        },
      },
      columns: [
        { data: "id" },
        { data: "nombre" },
        { data: "usuario" },
        { data: "caja" },
        { data: "status" },
        { data: "acciones" },
      ],
      bDestroy: true,
      iDisplayLength: 20,
      order: [[0, "asc"]],
    })
    .DataTable();
};
let listarCajas = () => {
  $.post(`${base_url}usuarios/listarCajas`, (result) => {
    $("#caja").html(result);
  });
};

$("#modalClose").click(function () {
  $("#btnLimpiarF").click();
  $("#idUser").val("");
  $("#mPass").text("");
  $("#mCPass").text("");
  $("#pass").removeClass("is-invalid");
  $("#cPass").removeClass("is-invalid");
});

$("#pass").on("keyup", function () {
  $("#mPass").text($(this).val());
});

$("#cPass").on("keyup", function () {
  var pass = $("#pass").val();
  var cPass = $(this).val();
  $("#mCPass").text($(this).val());
  if (pass != cPass) {
    $("#pass").addClass("is-invalid");
    $(this).addClass("is-invalid");
  } else {
    $("#pass").removeClass("is-invalid");
    $(this).removeClass("is-invalid");
  }
});

$("#btnNA").click(function () {
  listarCajas();
  $("#titleModalUsuario").text("Nuevo usuario");
  $("#saveUser").html("Guardar");
  $("#pass").prop("required", true);
  $("#cPass").prop("required", true);
});
