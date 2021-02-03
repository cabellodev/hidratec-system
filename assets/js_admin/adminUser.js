$(() => {
	$("#rut").rut({
		minimumLength: 8,
		validateOn: "change",
	});
	getUsers();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

var edit = false;
var idEdit = 0;

const tabla = $("#table-usuario").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columns: [
		{ data: "rut" },
		{ data: "nombre" },
		{ data: "estado" },
		{ data: "range" },
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='deleteButton' class='btn btn-danger'>
                                    Bloquear/Desbloquear
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});

addErrorStyle = (errores) => {
	let arrayErrores = Object.keys(errores);
	arrayErrores.map((err) => {
		$(`.${err}`).show();
	});
};

getUsers = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getUsers`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let data = xhr.response.map((u) => {
				if (u.estado == 1) {
					u.estado = "Activo";
				} else {
					u.estado = "Bloqueado";
				}
				return u;
			});
			tabla.clear();
			tabla.rows.add(data);
			tabla.draw();
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los usuarios",
			});
		}
	});
	xhr.send();
};

$("#table-usuario").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Bloquear/Desbloquear usuario`,
			icon: "warning",
			text: `¿Está seguro/a de Bloquear/Desbloquear al usuario: "${data.nombre}"?`,
			buttons: {
				confirm: {
					text: "Bloquear/Desbloquear",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				bloquearDesbloquearUser(data.rut, data.estado);
			} else {
				swal.close();
			}
		});
	} else {
		edit = true;
		idEdit = data.rut;
		cleanInput();
		$("#titulo").text("Modificar usuario");
		$("#rut").prop("disabled", true);
		$("#passdiv").hide();
		$("#name").val(data.nombre);
		$("#rut").val(data.rut);
		$("#email").val(data.email);
		$("#rango").val(data.range);
		$("#agregarUser").modal("show");
	}
});

bloquearDesbloquearUser = (id, state) => {
	let data = {
		state: state == "Activo" ? 0 : 1,
		rut: id,
	};
	$.ajax({
		data: { data },
		type: "POST",
		url: host_url + "api/changeState",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito!",
				icon: "success",
				text: result.msg,
				button: "OK",
			}).then(() => {
				tabla.rows().remove().draw();
				getUsers();
			});
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			});
		},
	});
};

registerUser = () => {
	let data = {
		name: $("#name").val(),
		rut: $("#rut").val(),
		email: $("#email").val(),
		passwd: $("#passwd").val(),
		rango: $("#rango").val(),
	};

	let url = "";
	if (edit) url = "api/editUser";
	else url = "api/createUser";
	Object.keys(data).map((d) => $(`.${d}`).hide());
	$.ajax({
		data: { data },
		type: "POST",
		url: host_url + url,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito!",
				icon: "success",
				text: result.msg,
				button: "OK",
			}).then(() => {
				$("#agregarUser").modal("hide");
				tabla.rows().remove().draw();
				getUsers();
				edit = false;
				idEdit = 0;
			});
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			});
			addErrorStyle(result.responseJSON.err);
		},
	});
};

cleanInput = () => {
	$("#titulo").text("Agregar Usuario");
	$("#passdiv").show();
	$("#rut").prop("disabled", false);

	$("#name").val("");
	$("#rut").val("");
	$("#email").val("");
	$("#passwd").val("");
	$("#rango").val("0");

	$(`.name`).hide();
	$(`.rut`).hide();
	$(`.email`).hide();
	$(`.passwd`).hide();
	$(`.rango`).hide();
};

$("#btn").on("click", () => {
	cleanInput();
	edit = false;
	idEdit = 0;
	$("#agregarUser").modal("show");
});

$("#addUser").on("click", () => {
	registerUser();
});
