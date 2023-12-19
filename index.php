<?php

function getColumnAverage($path){
    $file = fopen($path, 'r');

    if(!$file){
        return 0;
    }

    $lines = 0;
    $medias = [];

    $countColumns = [];
    
    if($file){
        while(!feof($file)){
            $line = fgetcsv($file, null, ';');
    
            if($line){
                foreach($line as $key => $value){
                    if(!isset($countColumns[$key])){
                        $countColumns[$key] = 0;
                    }

                    $countColumns[$key] += (float)$value;
                }
    
                $lines++;
            }
        }
    
        fclose($file);

        foreach($countColumns as $column){
            $medias[] = [
                "media" => isEvenOrOdd($column),
                "value" => $column
            ];
        }
    }

    return $medias;
}

function isEvenOrOdd($number){
    $value = intval($number);
    return $value % 2 === 0 ? "par" : "impar";
}

$medias = getColumnAverage('./data.csv');

foreach($medias as $key => $media){
    echo "Total da coluna " . $key + 1 . " : " . $media["value"] . "<br>";
    echo "Média da coluna " . $key + 1 . " : " . $media["media"];

    echo "<br>";
    echo "<br>";
}