$(document).ready(() => {
  $("#formLogin").on("submit", function (e) {
    login(e);
  });
});

let login = (e) => {
  e.preventDefault();
  const user = $("#user").val();
  const pass = $("#password").val();
  const url=`${base_url}sesion/validar`;
  if (user == "") {
    $("#password").removeClass("is-invalid");
    $("#user").addClass("is-invalid");
    $("#user").focus();
  } else if (pass == "") {
    $("#user").removeClass("is-invalid");
    $("#password").addClass("is-invalid");
    $("#password").focus();
  } else {
    $.post(url, { user, pass }, (result) => {
      const response = JSON.parse(result);
      Swal.fire({
        position: "center",
        icon: response.icon,
        title: response.msg,
        showConfirmButton: false,
        timer: 2500,
      });
      if (response.status == 200) {
        setTimeout(() => {
          window.location = `${base_url}usuarios`;
        }, 1000);
      }
    });
  }
};
