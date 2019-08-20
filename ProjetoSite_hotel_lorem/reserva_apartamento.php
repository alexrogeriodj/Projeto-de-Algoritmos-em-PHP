<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Hotel LOREM IPSUM - Reserva de apartamento</title>
        <link rel="stylesheet" href="css/estilos_gerais.css" type="text/css">
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.4.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
  
        <script>
            $(function() {$(".data").datepicker({
                    showOn: "button",
                    buttonImage: "imagens/calendario.png",
                    buttonImageOnly: true,
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'] } );
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#btnConfirmar").click(function() {
                    var codigo_hotel = $("select[name=Hotel]").val();
                    var numero_apartamento = $("input[name=Apartamento]").val();
                    var data_entrada = $("input[name=DataEntrada]").val();
                    var data_saida = $("input[name=DataSaida]").val();
                    
                    $.ajax({
                        "url": "efetivar_reserva.php",
                        "dataType": "html",
                        "data": { "CodigoHotel":codigo_hotel,
                                  "NumeroApartamento":numero_apartamento,
                                  "DataEntrada":data_entrada,
                                  "DataSaida":data_saida },
                        "success": function(response) { $("div#retorno").html(response);
                                                        setTimeout("location.href = 'index.php'",5000);}
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#btnCancelar").click(function() { $(location).attr("href","index.php"); });
            });
        </script>

    </head>

    <body>
        <?php 
        session_start();

        if(isset($_SESSION["USUARIO_LOGADO"]) && ($_SESSION["USUARIO_LOGADO"] == 1)) {
            $CodigoHospede = $_SESSION["CODIGO_HOSPEDE"];
        }
        else {
            $CodigoHospede = "";
        }
        ?>
        
        <div id="formulario">
            <p class="titulo-formulario">Reserva de apartamento</p>
            <form name=formReserva" class="formulario">
                <?php if($CodigoHospede != "") { ?>
                Hotel: 
                <?php
                require_once("funcoes_diversas.php");
                echo ListaHoteis();
                ?>
                Apartamento:<input maxlength="2" size="2" name="Apartamento"><br>
                Data de entrada:<input maxlength="10" size="10" name="DataEntrada" class="data">
                Data de saída:<input maxlength="10" size="10" name="DataSaida" class="data"><br>
                <button type="button" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
                <input name="btnCancelar" value="Cancelar" type="reset" id="btnCancelar"><br><br>
                <?php } else { ?>
                <p>Para efetuar uma reserva, você precisa estar logado no sistema!</p>
                <input name="btnFechar" value="Fechar" type="reset" id="btnCancelar"><br><br>
                <?php } ?>
            </form>
            <div id="retorno"></div>
        </div>
    </body>
</html>