<?php

function readCsv()
{
    $csv = [];
    $file = fopen('super.csv', 'r');
    $header = [];
    $user = [];
    require_once('generatePost.php');

    while (($result = fgetcsv($file, 1000, ",")) !== false) {
        if (count($header) == 0) {
            foreach ($result as  $value) {
                array_push($header, $value);
            }
        } else {
            $temp=[];
            foreach ($result as  $value) {
                array_push($temp, $value);
            }
            $res = [];
            for ($i = 0; $i < count($header); $i++) {
                array_push($res, $temp[$i]);
            }
            array_push($csv, $res);
        }
    }
    fclose($file);
    return ['csv'=>$csv,'header'=>$header];
}
