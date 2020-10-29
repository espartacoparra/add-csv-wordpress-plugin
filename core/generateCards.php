<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
function cardGenerator($carName, $description, $description2, $csvlist, $header, $ivory)
{
    $date=date("j/n/Y");
    if ($description != "") {
        $resultado = str_replace("#date", $date, $description);
        $descriptionResult = str_replace("#carName", $carName, $resultado);
    } else {
        $descriptionResult='<p><strong>Lista de precios actualizada '.$date.'</strong> para los todos los vehículos <strong>'.$carName.'</strong> en sus diferentes versiones, revise detalladamente cual es su versión correcta para que obtenga el valor comercial correcto para su vehículo y compartalo con quien desee desde el botón que se encuentra en la parte inferior.</p>';
    }
    $content = ' 
    <figure class="wp-block-table php">
    <div style="color: rgb(65, 64, 64);">
    <h3 class="text-center" style="color: rgb(128, 128, 128);">'.$csvlist[$carName][0][1]." ".validateName($csvlist[$carName][0][5]).'</h3>
    
     <div class="container">
     <div class="ml-1">
     [ivory-search id="'.$ivory.'" title="Default Search Form"]
     </div>
     <div class="mb-4">'.$descriptionResult.' </div>';
    $count=1;
    foreach ($csvlist[$carName] as $car) {
        $data = "";
        if ($count == 1) {
            $content.= '<div class="row">';
        }
        for ($i=0; $i < count($car); $i++) {
            if ($i!=0 && $i!=4 && ($i<11 || $i > 40)) {
                if ($header[$i] == "Peso" && $car[$i] > 0) {
                    $data.=$header[$i]." : ".$car[$i]." Kg <br>";
                } elseif ($header[$i] == "CapacidadCarga" && $car[$i] > 0) {
                    $data.=$header[$i]." : ".$car[$i]." Kg <br>";
                } elseif ($header[$i] == "Puertas") {
                    $ejesIndex=count($header)-6;
                    $data.=$header[$i]." : ".$car[$i].", ".$header[$ejesIndex]." : ".$car[$ejesIndex]." <br>";
                } elseif ($header[$i] >=2000) {
                    if ($car[$i]!=0) {
                        $var =number_format(((int)$car[$i])*1000);
                        $car[$i]="$".str_replace(',', '.', $var);
                        $data.='Año '.$header[$i]." : ".$car[$i]."<br>";
                    }
                } elseif ($header[$i]!="" && $header[$i]!="Bcpp" && $header[$i]!="Ejes"  && $header[$i]!="Estado" && $header[$i]!="Um" && $header[$i]!="PesoCategoria" && $header[$i]!="Marca" && $header[$i]!="CapacidadCarga" && $header[$i]!="Peso" && $header[$i]!="IdServicio" && $header[$i]!="Importado" && $header[$i]!="Potencia" && $header[$i]!="TipoCaja" && $header[$i]!="Nacionalidad" && $header[$i]!="Cilindraje" && $header[$i]!="Referencia1" && $header[$i]!="Referencia2" && $header[$i]!="Referencia3" && $header[$i]!="Um" && $header[$i]!="PesoCategoria") {
                    $data.=$header[$i]." : ".$car[$i]."<br>";
                }
            }
        }
        $transmisionIndex=count($header)-3;
        $content .='<div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 ">
            <div class="thumbnail">
            <div class="caption">
                <h5 >'.$car[1]." ".validateName($car[5])." ".$car[7]." ".$car[$transmisionIndex].'</h5>
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
    $content .='<div class="mb-4">'.$description2.'<div> </div> </figure>'    ;
    return $content;
}
