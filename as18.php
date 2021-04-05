<?php
echo "<a target='_blank' href='https://github.com/hedgehog100/api.git'>Github Repo<br/>";
//Covid19api.com deaths data

main();
//b
function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);

    $deaths_arr = Array();
    foreach($obj->Countries as $i){
        array_push($deaths_arr, [$i->Country, $i->TotalDeaths]);
        //echo $i->Country. ":" . $i->TotalDeaths . "<br/>";
        //$data = $obj->Countries[$i]->Country. ":" . $obj->Countries[$i]->TotalDeaths;
    }

    print_r($deaths_arr);

	//echo $data . "<br/><br/>";
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