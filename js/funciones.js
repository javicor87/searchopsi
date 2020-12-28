//Función para busqueda
    $(document).ready(function () {
            (function ($) {

                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar table').hide();
                    $('.buscar table').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });


