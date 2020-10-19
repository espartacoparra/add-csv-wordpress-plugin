<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once("readCsv.php");

function cardGenerator($carName, $description, $description2)
{
    $csvData =readCsv()['csv'];
    $header = readCsv()['header'];
    $csv=[];
    foreach ($csvData as  $car) {
        $car[5]=validateName($car[5]);
        if ($car[5] == $carName) {
            $temp=[];
            foreach ($car as  $value) {
                array_push($temp, $value);
            }
            $res = [];
            for ($i = 0; $i < count($header); $i++) {
                array_push($res, $temp[$i]);
            }
            array_push($csv, $res);
        }
    }
    $date=date("j/n/Y");
    $carName=$csv[0][1].' '.$csv[0][5];
    if ($description != "") {
        $resultado = str_replace("#date", $date, $description);
        $descriptionResult = str_replace("#carName", $carName, $resultado);
    } else {
        $descriptionResult='<p><strong>Lista de precios actualizada '.$date.'</strong> para los todos los vehículos <strong>'.$carName.'</strong> en sus diferentes versiones, revise detalladamente cual es su versión correcta para que obtenga el valor comercial correcto para su vehículo y compartalo con quien desee desde el botón que se encuentra en la parte inferior.</p>';
    }
    $content = ' 
    <figure class="wp-block-table php">
    <form class="form-inline" method="get" class="search-form" action="http://localhost/credivehiculos/">
    <input type="hidden" name="id" value="1853" />
    <div class="form-group">
    <input type="text" name="s" class="form-control mb-2" id="Search" placeholder="Buscar">
    <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </div>
  
    </form>
     <div class="container">
     <div class="mb-4">'.$descriptionResult.' </div>
     <div class="row">';
    foreach ($csv as $car) {
        $data = "";
        for ($i=0; $i <count($car) ; $i++) {
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
                } elseif ($header[$i]!="Bcpp" && $header[$i]!="Ejes"  && $header[$i]!="Estado" && $header[$i]!="Um" && $header[$i]!="PesoCategoria" && $header[$i]!="Marca" && $header[$i]!="CapacidadCarga" && $header[$i]!="Peso" && $header[$i]!="IdServicio" && $header[$i]!="Importado" && $header[$i]!="Potencia" && $header[$i]!="TipoCaja" && $header[$i]!="Nacionalidad" && $header[$i]!="Cilindraje" && $header[$i]!="Referencia1" && $header[$i]!="Referencia2" && $header[$i]!="Referencia3") {
                    $data.=$header[$i]." : ".$car[$i]."<br>";
                }
            }
        }
        $transmisionIndex=count($header)-3;
        $content .='<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-lg-4 mb-2">
        <div class="thumbnail">
          <div class="caption">
            <h5 >'.$car[1]." ".$car[5]." ".$car[7]." ".$car[$transmisionIndex].'</h5>
            <p >
             '.$data.'
            </p>
          </div>
        </div>
      </div>';
    }
    if ($description2 != "") {
        $description2 = str_replace("#date", $date, $description2);
        $description2 = str_replace("#carName", $carName, $description2);
    }
    $content .='</div><div class="mb-4">'.$description2.' </div> </figure>'    ;
    return $content;
}

function validateName($name)
{
    if (strpbrk($name, "[")) {
        return explode("[", $name)[0];
    } else {
        return $name;
    }
}
