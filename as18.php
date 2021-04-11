<?php

//Covid19api.com deaths data
echo "<!DOCTYPE html>
<html lang='en-US'>
    <head>
        <title>default title</title>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' />
    </head>
	
    <body>";
    echo "<div class='text-center'>
    <a 'target='_blank' href='https://github.com/hedgehog100/api.git'>Github Repo</a><br/> </div>";
main();
//b
function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);

    //$deaths_arr = Array();
    $arr1 = Array();
    $arr2 = Array();
    $arr3 = Array();
    foreach($obj->Countries as $i){
        //array_push($deaths_arr, [$i->Country, $i->TotalDeaths]);
        array_push($arr1, $i->Country);
        array_push($arr2, $i->TotalDeaths);
        //echo $i->Country. ":" . $i->TotalDeaths . "<br/>";
        //$data = $obj->Countries[$i]->Country. ":" . $obj->Countries[$i]->TotalDeaths;
    }
    array_multisort($arr2, SORT_DESC, $arr1);
    //print_r($arr1);

    for($i = 0; $i < 10; $i++){
        $arr3[$i] = $arr1[$i];
        $arr4[$i] = $arr2[$i];
    }

    $topTen = json_encode($arr3);
    echo "<br/>";
    
    echo "<div class='text-center'> ";
    echo "<table style='margin-left: auto; margin-right: auto;'>
            <tr>
                <th>Country</th>
                <th>Total Deaths</th>
            </tr>";

    for($i=0;$i<10;$i++){
        echo "<tr> <td>" . $arr3[$i] . "</td><td>" . $arr4[$i] . "</td></tr>"; 
    }



    echo    "</table>";
	//echo $data . "<br/><br/>";

    echo "</div></body>
            </html>";
}



function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}