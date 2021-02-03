$(() => {
	$("#rut").rut({
		minimumLength: 8,
		validateOn: "change"
	});
	
	
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	}
});

login = () => {
	event.preventDefault();
	let rut = $("#rut").val();
	let passwd = $("#passwd").val();
	let data = {
		rut: rut,
		passwd: passwd
	};
	Object.keys(data).map(d => $(`.${d}`).hide());
	$.ajax({
		data: {
			data
		},
		type: "POST",
		url: host_url + "api/login",
		crossOrigin: false,
		dataType: "json",
		success: () => {
			swal({
				title: "Éxito!",
				icon: "success",
				text: "Inicio de Sesión exitoso",
				button: "OK"
			}).then(() => {
				window.open(host_url+"menu", "_self");
			});
		},
		error: result => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg
			});
			if (result.responseJSON.err != undefined) addErrorStyle(result.responseJSON.err);
		}
	});
};

addErrorStyle = errores => {
	let arrayErrores = Object.keys(errores);
	arrayErrores.map(err => {
		$(`.${err}`).show();
	});
};

$("#login").on("click", login);
