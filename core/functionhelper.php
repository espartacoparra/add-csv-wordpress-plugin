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
            $tempcar=array($queryarray =>$cars);
            $newcsv= array_merge($newcsv, $tempcar);
            $temp=array($queryarray =>$queryarray);
            $arrayhelper= array_merge($arrayhelper, $temp);
        }
    }
    return $newcsv;
}
function indexedCsv($csv)
{
    $arrayhelper=[];
    $newcsv=[];
    foreach ($csv as  $value) {
        $queryarray= $value[1].' '.validateName($value[5]);
        if (!$arrayhelper[$queryarray]) {
            $temp=array($queryarray =>$queryarray);
            $arrayhelper= array_merge($arrayhelper, $temp);
            $tempcar=array($queryarray =>array( $value));
            $newcsv= array_merge($newcsv, $tempcar);
        } else {
            $tempcar=array($value);
            $newcsv[$queryarray]= array_merge($newcsv[$queryarray], $tempcar);
        }
    }
    return $newcsv;
}
