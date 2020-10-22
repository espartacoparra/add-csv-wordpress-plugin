<?php
function validateName($name)
{
    if (strpbrk($name, "[")) {
        return explode("[", $name)[0];
    } else {
        return $name;
    }
}

function reduceCsv($csv)
{
    $arrayhelper=[];
    $newcsv=[];
    foreach ($csv as $key => $cars) {
        $queryarray= $cars[1].' '.validateName($cars[5]);
        if (!$arrayhelper[$queryarray]) {
            $tempcar=array("".$queryarray."" =>$cars);
            $newcsv= array_merge($newcsv, $tempcar);
            $temp=array("".$queryarray."" =>$queryarray);
            $arrayhelper= array_merge($arrayhelper, $temp);
        }
    }
    return $newcsv;
}
function indexedCsv($csv)
{
    $arrayhelper=[];
    $newcsv=[];
    for ($i=0; $i <= count($csv) ; $i++) {
        $queryarray= $csv[$i][1].' '.validateName($csv[$i][5]);
        if (!$arrayhelper[$queryarray]) {
            $temp=array("".$queryarray."" =>$csv[$i]);
            $arrayhelper= array_merge($arrayhelper, $temp);
        } else {
            $arrayhelper= array_merge($arrayhelper, $csv[$i]);
        }
    }

    // print_r($arrayhelper);
    return $arrayhelper;
}
