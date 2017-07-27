'use strict';

(function ($) {

    window.Parsley.addValidator('cnpj', {
        validateString: function (value) {
            var cnpj = value.replace(/[^0-9]/g, '')
                , len = cnpj.length - 2
                , numbers = cnpj.substring(0, len)
                , digits = cnpj.substring(len)
                , add = 0
                , pos = len - 7
                , invalidCNPJ = [
                    '00000000000000',
                    '11111111111111',
                    '22222222222222',
                    '33333333333333',
                    '44444444444444',
                    '55555555555555',
                    '66666666666666',
                    '77777777777777',
                    '88888888888888',
                    '99999999999999'
                ]
                , result
            ;

            if (cnpj.length < 11 || $.inArray(cnpj, invalidCNPJ) !== -1) {
                return false;
            }

            for (i = len; i >= 1; i--) {
                add = add + parseInt(numbers.charAt(len - i)) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }

            result = (add % 11) < 2 ? 0 : 11 - (add % 11);
            if (result != digits.charAt(0)) {
                return false;
            }

            len = len + 1;
            numbers = cnpj.substring(0, len);
            add = 0;
            pos = len - 7;

            for (i = 13; i >= 1; i--) {
                add = add + parseInt(numbers.charAt(len - i)) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }

            result = (add % 11) < 2 ? 0 : 11 - (add % 11);
            if (result != digits.charAt(1)) {
                return false;
            }

            return true;
        },
        messages: {
            'pt-br': 'Informe um CNPJ válido'
        }
    });


    window.Parsley.addValidator('cpf', {
        validateString: function (value) {
            var cpf = value.replace(/[^0-9]/g, '')
                , compareCPF = cpf.substring(0, 9)
                , add = 0
                , i, u
                , invalidCPF = [
                    '00000000000',
                    '11111111111',
                    '22222222222',
                    '33333333333',
                    '44444444444',
                    '55555555555',
                    '66666666666',
                    '77777777777',
                    '88888888888',
                    '99999999999'
                ]
            ;

            if (cpf.length < 11 || $.inArray(cpf, invalidCPF) !== -1) {
                return false;
            }

            for (i = 8, u = 2; i >= 0; i--, u++) {
                add = add + parseInt(cpf.substring(i, i + 1)) * u;
            }

            compareCPF = compareCPF + ( (add % 11) < 2 ? 0 : 11 - (add % 11));
            add = 0

            for (i = 9, u = 2; i >= 0; i--, u++) {
                add = add + parseInt(cpf.substring(i, i + 1)) * u;
            }

            compareCPF = compareCPF + ( (add % 11) < 2 ? 0 : 11 - (add % 11));

            if (compareCPF !== cpf) {
                return false;
            }

            return true;
        },
        messages: {
            'pt-br': 'Informe um CPF válido'
        }
    });


    window.Parsley.addValidator('cep', {
        validateString: function (value) {

            return /^[0-9]{5}-[0-9]{3}$/.test(value);
        },
        messages: {
            'pt-br': 'Informe um CEP válido'
        }
    });


}(window.jQuery));