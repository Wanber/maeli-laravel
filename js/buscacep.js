$(document).ready(function () {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
    }

    $("#cep").keyup(function () {

        $("#bairro").attr('readonly', '');
        $("#rua").attr('readonly');

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#cep_status").html("<i class='fa fa-spin fa-spinner'></i> Buscando CEP...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/" + cep + "/json", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);

                        if (dados.bairro == '')
                            $("#bairro").removeAttr('readonly');
                        if (dados.logradouro == '')
                            $("#rua").removeAttr('readonly');

                        //$(this).removeClass("parsley-error");
                        $("#cep_status").html("");

                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        $("#cep_status").html("<p class='text-danger'>CEP inválido</p>");
                        //(this).addClass("parsley-error");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                //$(this).addClass("parsley-error");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
            $("#cep_status").html("<p class='text-danger'>CEP inválido</p>");
            //$(this).addClass("parsley-error");
        }
    });
});