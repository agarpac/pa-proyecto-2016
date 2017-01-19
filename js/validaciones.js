function clearForm(oForm) {

    var elements = oForm.elements;

    oForm.reset();

    for (i = 0; i < elements.length; i++) {

        field_type = elements[i].type.toLowerCase();

        switch (field_type) {

            case "text":
            case "password":
            case "textarea":
            case "hidden":

                elements[i].value = "";
                break;

            case "radio":
            case "checkbox":
                if (elements[i].checked) {
                    elements[i].checked = false;
                }
                break;

            case "select-one":
            case "select-multi":
                elements[i].selectedIndex = -1;
                break;

            default:
                break;
        }
    }
}

function limpiaTexto(input) {
    var campoTexto = document.getElementById("autoc");
    campoTexto.value = "";
    campoTexto.disabled = false;
    var botonEnviar = document.getElementById("amistad");
    botonEnviar.style.display = "none";
    input.style.display = "none";
}

//Funcion que valida los datos del registro, en caso de errores muestra un mensaje por cada error y devuelve false
function validacionRegistro() {
    var exp = new RegExp(/^[A-Z]{1,2}\s\d{4}\s([B-D]|[F-H]|[J-N]|[P-T]|[V-Z]){3}$/);
    var passExp = new RegExp(/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/);
    var emailExp = new RegExp(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var nombre = document.getElementById("nombre");
    var apellido1 = document.getElementById("apellido1");
    var apellido2 = document.getElementById("apellido2");
    var pass = document.getElementById("password");
    var email = document.getElementById("email");

    var bool = true;

    //Borramos mensajes de error anteriores si los hay
    if ($("#nombreError").length !== 0) {
        $("#nombreError").remove();
    }

    if ($("#apellido1Error").length !== 0) {
        $("#apellido1Error").remove();
    }
    if ($("#apellido2Error").length !== 0) {
        $("#apellido2Error").remove();
    }

    if ($("#passError").length !== 0) {
        $("#passError").remove();
    }

    if ($("#emailError").length !== 0) {
        $("#emailError").remove();
    }


    //Comprobamos todos los campos, mostrando un error en aquellos que los haya
    if (nombre.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "nombreError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un nombre.";
        $("#nombre").after(aux);
        bool = false;
    } else {
        if (exp.test(String(nombre.value))) {
            var aux = document.createElement("p");
            aux.setAttribute("id", "nombreError");
            aux.setAttribute("class", "error");
            aux.innerHTML = "Introduzca un nombre correcto.";
            $("#nombre").after(aux);
            bool = false;
        }
    }

    if (apellido1.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "apellido1Error");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un apellido.";
        $("#apellido1").after(aux);
        bool = false;
    } else {
        if (exp.test(String(nombre.value))) {
            var aux = document.createElement("p");
            aux.setAttribute("id", "apellido1Error");
            aux.setAttribute("class", "error");
            aux.innerHTML = "Introduzca un apellido correcto.";
            $("#apellido1Error").after(aux);
            bool = false;
        }
    }
    if (apellido2.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "apellido2Error");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un apellido.";
        $("#apellido2").after(aux);
        bool = false;
    } else {
        if (exp.test(String(nombre.value))) {
            var aux = document.createElement("p");
            aux.setAttribute("id", "apellido2Error");
            aux.setAttribute("class", "error");
            aux.innerHTML = "Introduzca un apellido correcto.";
            $("#apellido2").after(aux);
            bool = false;
        }
    }

    if (pass.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "passError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca una contrase&ntilde;a.";
        $("#password").after(aux);
        bool = false;
    } else {
        if (passExp.test(String(pass.value))) {
            var aux = document.createElement("p");
            aux.setAttribute("id", "passError");
            aux.setAttribute("class", "error");
            aux.innerHTML = "Introduzca una contraseña correcta.";
            $("#password").after(aux);
            bool = false;
        }
    }



    if (email.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "emailError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un correo electronico.";
        $("#email").after(aux);
        bool = false;
    } else {
        if (!emailExp.test(String(email.value))) {
            var aux = document.createElement("p");
            aux.setAttribute("id", "emailError");
            aux.setAttribute("class", "error");
            aux.innerHTML = "Introduzca un email valido.";
            $("#email").after(aux);
            bool = false;
        }
    }


    return bool;
}
//Funcion que comprueba la fortaleza de la contraseña
function passStrenght() {
    $("#password").pStrength({
        'changeBackground': false,
        'passwordValidForm': 50,
        'backgrounds': [['#cc0000', '#FFF'], ['#cc3333', '#FFF'], ['#cc6666', '#FFF'], ['#ff9999', '#FFF'],
            ['#e0941c', '#FFF'], ['#efd09e', '#FFF'],
            ['#ccffcc', '#FFF'], ['#66cc66', '#FFF'], ['#339933', '#FFF'], ['#006600', '#FFF'], ['#105610', '#FFF']],
        'onValidatePassword': function (percentage) {
            $('#' + $(this).data('display')).html($('#' + $(this).data('display')).html() + 'La contraseña es optima para registro');
            $('#formulario').submit(function () {
                return true;
            });
        },
        'onPasswordStrengthChanged': function (passwordStrength, percentage) {
            if ($(this).val()) {
                $.fn.pStrength('changeBackground', this, passwordStrength);
            } else {
                $.fn.pStrength('resetStyle', this);
            }
            $('#' + $(this).data('display')).html('Porcentaje de seguridad:' + percentage + '%');
        }
    });
}

//Funcion que valida los datos del registro, en caso de errores muestra un mensaje por cada error y devuelve false
function validacionRegistroNoticias() {

    var titulo = document.getElementById("titulo");
    var cuerpoNoticia = document.getElementById("cuerpoNoticia");
    var fecha = document.getElementById("datepicker");
    var bool = true;

    //Borramos mensajes de error anteriores si los hay
    if ($("#tituloError").length !== 0) {
        $("#tituloError").remove();
    }

    if ($("#cuerpoError").length !== 0) {
        $("#cuerpoError").remove();
    }

    if ($("#fechaError").length !== 0) {
        $("#fechaError").remove();
    }


    //Comprobamos todos los campos, mostrando un error en aquellos que los haya
    if (titulo.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "tituloError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un titulo.";
        $("#titulo").after(aux);
        bool = false;
    } 


    if (cuerpoNoticia.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "cuerpoError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un texto";
        $("#cuerpoNoticia").after(aux);
        bool = false;
    } 

    if (fecha.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "fechaError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca la fecha";
        $("#datepicker").after(aux);
        bool = false;
    } 

    return bool;
}

function confirmDel() { //confirmar borrar noticia
    if (confirm("¿Realmente desea eliminarla?"))
        return true;
    else
        return false;
}

function validacionLogin() {
    var exp = new RegExp(/^[A-Z]{1,2}\s\d{4}\s([B-D]|[F-H]|[J-N]|[P-T]|[V-Z]){3}$/);
    var user = document.getElementById("user");
    var pass = document.getElementById("password");
    var bool = true;

    if ($("#userError").length !== 0) {
        $("#userError").remove();
        $("#user").css("background-color", "#f2d6b5");
    }
    if ($("#passError").length !== 0) {
        $("#passError").remove();
        $("#password").css("background-color", "#f2d6b5");
    }
    

    if (user.value === "") {

        var aux = document.createElement("p");
         aux.setAttribute("id", "userError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un usuario.";
        user.value = "Introduzca su correo";
        $("#user").after(aux);
        $("#user").css("background-color", "#f2dede");
        $("#user").css("color", "#a94442");
        $("#user").css("border-width", "1px");
        $("#user").css("border-style", "solid");
        $("#user").css("border-color", "red");
        $("#user").css("box-shadow", "red");

        bool = false;
    }

    if (pass.value === "") {

        var aux = document.createElement("p");
        aux.setAttribute("id", "passError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca una contrase&ntilde;a.";
        $("#password").after(aux);
        $("#password").css("background-color", "red");
        document.formLogin.password.type = 'text';
        password.value = "Introduzca su password";
        $("#user").after(aux);
        $("#password").css("background-color", "#f2dede");
        $("#password").css("color", "#a94442");
        $("#password").css("border-width", "1px");
        $("#password").css("border-style", "solid");
        $("#password").css("border-color", "red");
        $("#password").css("box-shadow", "red");
        bool = false;
    }

    if (user.value !== "" && exp.test(String(user.value))) {

        var aux = document.createElement("p");
        aux.setAttribute("id", "userError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un nombre de usuario correcto.";
        $("#user").after(aux);
        user.value = "Introduzca un nombre correcto";
        $("#user").css("background-color", "#f2dede");
        $("#user").css("color", "#a94442");
        $("#user").css("border-width", "1px");
        $("#user").css("border-style", "solid");
        $("#user").css("border-color", "red");
        $("#user").css("box-shadow", "red");
        bool = false;
    }
    return bool;
}

function validacionRegistroNoticia() {

    var titulo = document.getElementById("titulo");
    var cuerpoNoticia = document.getElementById("cuerpoNoticia");

    var bool = true;

    //Borramos mensajes de error anteriores si los hay
    if ($("#tituloError").length !== 0) {
        $("#tituloError").remove();
    }

    if ($("#cuerpoError").length !== 0) {
        $("#cuerpoError").remove();
    }

    //Comprobamos todos los campos, mostrando un error en aquellos que los haya
    if (titulo.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "tituloError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un titulo.";
        $("#titulo").after(aux);
        bool = false;
    }


    if (cuerpoNoticia.value === "") {
        var aux = document.createElement("p");
        aux.setAttribute("id", "cuerpoError");
        aux.setAttribute("class", "error");
        aux.innerHTML = "Introduzca un texto";
        $("#cuerpoNoticia").after(aux);
        bool = false;
    }
    return bool;
}