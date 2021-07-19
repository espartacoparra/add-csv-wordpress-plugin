<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
function cardGenerator($carName, $description, $description2, $csvlist, $header, $ivory, $type)
{
    $date=date("j/n/Y");
    $carType=strtolower($csvlist[$carName][0][2]);
    if ($description != "") {
        $resultado = str_replace("#date", $date, $description);
        $descriptionResult = str_replace("#carName", $carName, $resultado);
        $descriptionResult = str_replace("#carType", $carType, $descriptionResult);
    } else {
        $descriptionResult='
    <p>A continuación, encontrarás la <strong>Lista de precios actualizada a '.$date.'</strong> para todas las referencias de '.$carType.' <strong>'.$carName.'</strong> en sus diferentes versiones distribuidos en Colombia, (precios de vehículos en otros países), seleccione el valor comercial correcto.
    
        El precio o valor comercial es útil para calcular el valor asegurable de su '.$carType.' sin incluir el costo de los accesorios (partes no originales del vehículo). El valor asegurado también es útil si quieres hacer un crédito de vehículo, puesto que sobre este valor es que las entidades financieras o bancos te realizarán el préstamo de vehículo.
   
        <strong>El valor comercial del '.$carName.'</strong> es solo una guía, si estás pensando en vender tu vehículo,aunque este precio es aproximado a la realidad, será la oferta, la demanda y el estado de tu vehículo quien determine el precio real de venta.
    
        Estos precios tienen una validez de 30 días desde la fecha de actualización.
        </p>';
    }
    $pagetitle='';
    if ($type=='insert') {
        $pagetitle='<h3 class="text-center" style="color: rgb(128, 128, 128);"> PRECIOS '.$csvlist[$carName][0][1]." ".validateName($csvlist[$carName][0][5]).'</h3>';
    }
    $content = $pagetitle.'
    <figure class="php">
    <div style="color: rgb(65, 64, 64);">
    <div class="container ">
    <div class="container ">
    <div class="container ">
     <div class="mb-5 mt-5" style="margin-top: 20px; margin-bottom: 35px;">'.$descriptionResult.' </div>';
    $count=1;
    foreach ($csvlist[$carName] as $car) {
        $data = "";
        if ($count == 1) {
            $content.= '<div class="row content-ads">';
        }
        for ($i=0; $i < count($car); $i++) {
            if ($i!=0 && $i!=4) {
                if ($header[$i] == "Peso" && $car[$i] > 0) {
                    $data.=$header[$i].": ".$car[$i]." Kg <br>";
                } elseif ($header[$i] == "CapacidadCarga" && $car[$i] > 0) {
                    $data.="Capacidad Carga: ".$car[$i]." Kg <br>";
                } elseif ($header[$i] == "CapacidadPasajeros" && $car[$i] > 0) {
                    $data.="Capacidad Pasajeros: ".$car[$i]."<br>";
                } elseif ($header[$i] == "AireAcondicionado") {
                    $data.="Aire Acondicionado: ".$car[$i]."<br>";
                } elseif ($header[$i] == "Puertas") {
                    $ejesIndex=count($header)-6;
                    $data.=$header[$i].": ".$car[$i].", ".$header[$ejesIndex]." : ".$car[$ejesIndex]." <br>";
                } elseif ($header[$i] >=1970) {
                    if ($car[$i]>0) {
                        if ($header[$i] >=2000) {
                            $var =((int)$car[$i])*1000;
                            $car[$i]="$". number_format($var, 0, ",", ".");
                            $carUsed= $var-($var*0.2035);
                            $carUsed="$".number_format(round($carUsed, -5), 0, ",", ".");
                            $data.='Año '.$header[$i].": ".$car[$i]." - Retoma: ".$carUsed."<br>";
                        } else {
                            $var =number_format(((int)$car[$i])*1000);
                            $car[$i]="$".str_replace(',', '.', $var);
                            $data.='Año '.$header[$i].": ".$car[$i]."<br>";
                        }
                    }
                } elseif ($header[$i]!="" && $header[$i]!="Bcpp" && $header[$i]!="Ejes"  && $header[$i]!="Estado" && $header[$i]!="Um" && $header[$i]!="PesoCategoria" && $header[$i]!="Marca" && $header[$i]!="CapacidadCarga" && $header[$i]!="Peso" && $header[$i]!="IdServicio" && $header[$i]!="Importado" && $header[$i]!="Potencia" && $header[$i]!="TipoCaja" && $header[$i]!="Nacionalidad" && $header[$i]!="Cilindraje" && $header[$i]!="Referencia1" && $header[$i]!="Referencia2" && $header[$i]!="Referencia3" && $header[$i]!="Um" && $header[$i]!="PesoCategoria") {
                    $data.=$header[$i].": ".$car[$i]."<br>";
                }
            }
        }
        $transmisionIndex=count($header)-3;
        $content .='<div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 ">
            <div class="thumbnail">
            <div class="caption">
                <h5 >'.$car[1]." ".validateName($car[5])." ".validateName($car[6])." ".$car[7]." ".$car[$transmisionIndex].'</h5>
                <p >
                '.$data.'
                </p>
            </div>
            </div>
        </div>';
        if ($count == 3) {
            $content.= '</div>';
            $count = 1;
        } else {
            $count++;
        }
    }
    $content.= '</div>';
    if ($description2 != "") {
        $description2 = str_replace("#date", $date, $description2);
        $description2 = str_replace("#carName", $carName, $description2);
    }
    $content .='<div class="mb-4">'.$description2.'<div>
    <div class="mb-4">
    <form  class="form-inline" id="search" method="get" name="searchform" action="'.site_url().'">
        <div class="form-group">
            <label for="ivory">Consultar otra referencia: </label> <input name="s" type="text" class="form-control" id="ivory" placeholder="Nombre del vehículo"> <button type="submit" class="btn btn-primary ml-2">Buscar</button>
            </div>
        <input type="hidden" name="id" value="'.$ivory.'">
        <input type="hidden" name="post_type" value="page">
    </form>
    <div> </div></div> </div>  </figure>'    ;
    return $content;
}
