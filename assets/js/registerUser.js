$(() => {
	$("#registerRut").rut({
		minimumLength: 8, // limit to char
		validateOn: "change", //change to formate
		
	}); 
});


registerUser = () => {
	let data = {
		name: $("#name").val(),
		rut: $("#registerRut").val(),
		email: $("#email").val(),
		passwd: $("#registerPass").val(),
		rango: $("#rango").val(),
    };

    let url = "api/createUser";

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
            
               });
            }
      });
};
        

$("#addUser").on("click", () => {
	registerUser();
});



