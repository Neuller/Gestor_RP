$.validator.setDefaults({
    ignore: []
});

const camposObrigatorios = function (nomeCampos, bool) {
    bool = bool !== undefined ? bool : true;
    nomeCampos = Array.isArray(nomeCampos) ? nomeCampos : nomeCampos.split(",");

    nomeCampos.forEach(function (valor) {
        if (bool == true) {
            $("#" + valor).rules("add", {
                required: true
            });
        } else {
            $("#" + valor).rules("remove");
        }
    });
};

function validarForm(nomeForm) {
    $("#" + nomeForm).validate({
        errorClass: "form-error",
        errorElement: 'div',
        success: function (label, element) {
            label.parent().removeClass("form-error");
            label.remove();
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent());
        }
    });
}