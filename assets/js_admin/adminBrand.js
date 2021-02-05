$(() => {
	getBrand();
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

const tabla = $("#table-brand").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columns: [
        { data: "name" },
		{ data: "states" },
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

getBrand = () => {
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/getBrand`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let data = xhr.response.map((u) => {
				if (u.states == 1) {
					u.states = "En utilización";
				} else {
					u.states = "Suspendido";
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
				text: "Error al obtener las marcas",
			});
		}
	});
	xhr.send();
};

$("#table-brand").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Bloquear/Desbloquear ubicación`,
			icon: "warning",
			text: `¿Está seguro/a de Bloquear/Desbloquear la marca: "${data.name}"?`,
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
				bloquearDesbloquearBrand(data.id_brand, data.states);
			} else {
				swal.close();
			}
		});
	} else {
		edit = true;
		idEdit = data.id_brand;
		cleanInput();
        $("#title").text("Modificar marca");
        $("#name").val(data.name);
		$("#id").val(data.id_brand);
		$("#addBrand").modal("show");
	}
});

bloquearDesbloquearBrand = (id, state) => {
	let data = {
		state: state == "En utilización" ? 0 : 1,
		id: id,
    };
    
	$.ajax({
		data: { data },
		type: "POST",
		url: host_url + "api/changeStateBrand",
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
				getBrand();
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

registerBrand = () => {
	let data = {
		name: $("#name").val(),
        id: $("#id").val(),
    };

 

	let url = "";
	if (edit) url = "api/editBrand";
	else url = "api/createBrand";
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
				$("#addBrand").modal("hide");
				tabla.rows().remove().draw();
				getBrand();
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
    $("#title").text("Crear marca");
    $("#id").val("");
	$("#name").val("");
	$(`.name`).hide();
    $(`.id`).hide();

};

$("#btn").on("click", () => {
	cleanInput();
	edit = false;
	idEdit = 0;
	$("#addBrand").modal("show");
});

$("#createBrand").on("click", () => {
	registerBrand();
});