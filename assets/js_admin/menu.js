$(() => {});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	}
});

cerrarSesion = () => {
	$.ajax({
		data: null,
		type: "POST",
		url: host_url + "api/logout",
		crossOrigin: false,
		dataType: "json",
		success: () => {
			let size = window.location.pathname.split('/').length;
			if (size > 3) window.open('../login', '_self');
			else window.open('./login', '_self');
		},
		error: () => {
			swal({
				title: "Error",
				icon: "error",
				text: "Ocurrio un error al cerra Sesión"
			});
		}
	});
}

$("#logout").on("click", cerrarSesion);
