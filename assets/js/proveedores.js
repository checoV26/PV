let tblProveedor;
$(document).ready(() => {
  $("#formNewProveedor").on("submit", function (e) {
    saveProveedor(e);
  });
  listarProveedores();
});

let saveProveedor = (e) => {
  e.preventDefault();
  const idProveedor = $("#idProveedor").val();
  const nombre = $("#nombre").val();
  const telefono = $("#telefono").val();
  const correo = $("#correo").val();
  const pWeb = $("#pWeb").val();
  const desc = $("#desc").val();

  if (nombre == "" || telefono == "" || correo == "") {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "¡Todos los campos son obligatorios!",
      showConfirmButton: false,
      timer: 2500,
    });
  } else {
    $.post(
      `${base_url}proveedores/save`,
      { idProveedor, nombre, telefono, correo, pWeb, desc },
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
          tblProveedor.ajax.reload();
          $("#modalClose").click();
        }
      }
    );
  }
};
let listarProveedores = () => {
  tblProveedor = $("#proveedorTable")
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
        url: `${base_url}proveedores/listar`,
        type: "post",
        dataType: "json",
        error: (e) => {
          console.log("Error función listar() \n" + e.responseText);
        },
      },
      columns: [
        { data: "id" },
        { data: "nombre" },
        { data: "telefono" },
        { data: "correoElectronico" },
        { data: "paginaWeb" },
        { data: "descripcion" },
        { data: "status" },
        { data: "acciones" },
      ],
      bDestroy: true,
      iDisplayLength: 20,
      order: [[0, "asc"]],
    })
    .DataTable();
};

let statusProveedor = (id, status) => {
  $.post(`${base_url}proveedores/status`, { id, status }, (result) => {
    const response = JSON.parse(result);
    Swal.fire({
      position: "center",
      icon: response.icon,
      title: response.msg,
      showConfirmButton: false,
      timer: 1500,
    });
    tblProveedor.ajax.reload();
  });
};

let datosProv = (id) => {
  const url = `${base_url}proveedores/datos/${id}`;
  $("#modalP").modal("show");
  $("#titleModalP").text("Actualizar usuario");
  $("#savePro").html("Actualizar");
  $.post(url, (result) => {
    const response = JSON.parse(result);
    console.log(result);
    $("#idProveedor").val(id);
    $("#nombre").val(response.nombre);
    $("#telefono").val(response.telefono);
    $("#correo").val(response.correoElectronico);
    $("#pWeb").val(response.paginaWeb);
    $("#desc").val(response.descripcion);
  });
};
$("#btnP").click(function () {
  $("#titleModalP").text("Nuevo proveedor");
  $("#savePro").html("Guardar");
});

$("#modalClose").click(function () {
  $("#btnLimpiarF").click();
  $("#idProveedor").val("");
});
