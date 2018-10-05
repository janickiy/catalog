<?php

/**
 * @param $url
 * @return mixed
 */
function getContentsCurl($url,$timeout=5)
{

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    curl_setopt($ch,CURLOPT_TIMEOUT       ,$timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

/**
 * @param $domain
 * @return bool
 */
function isDomainAvailible($domain, $timeout=5){

    if(!filter_var($domain, FILTER_VALIDATE_URL)) {
        return false;
    }

    $curlInit = curl_init($domain);
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,$timeout);
    curl_setopt($curlInit,CURLOPT_TIMEOUT       ,$timeout);
    curl_setopt($curlInit,CURLOPT_HEADER,false);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

    //Получаем ответ
    $response = curl_exec($curlInit);

    curl_close($curlInit);

    return (bool)($response);
}