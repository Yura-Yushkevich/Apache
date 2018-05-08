<?php
global $utm_openstat_referer;
global $invite_code;
global $pageURL, $page_url;
global $is_subscribe_user;

$pageURL = 'http';
//    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
};
$page_url = $pageURL;

$utm_openstat_referer = $_SERVER['HTTP_REFERER'];
if (isset($utm_openstat_referer) && stristr($utm_openstat_referer, $_SERVER["SERVER_NAME"]) === FALSE) {
    $utm_openstat_referer = 'HTTP_REFERER : ' . $utm_openstat_referer . '<br>';
} else {
    $utm_openstat_referer = '';
}
if($_GET['_openstat']){
    $utm_openstat_referer = $utm_openstat_referer . '_openstat : ' . $_GET['_openstat'] . '<br>';
}
if($_GET['utm_source']){
    $utm_openstat_referer = $utm_openstat_referer . 'utm_source : ' . $_GET['utm_source'] . '<br>';
}
if($_GET['utm_medium']){
    $utm_openstat_referer = $utm_openstat_referer . 'utm_medium : ' . $_GET['utm_medium'] . '<br>';
}
if($_GET['utm_campaign']){
    $utm_openstat_referer = $utm_openstat_referer . 'utm_campaign : ' . $_GET['utm_campaign'] . '<br>';
}
if($_GET['utm_content']){
    $utm_openstat_referer = $utm_openstat_referer . 'utm_content : ' . $_GET['utm_content'] . '<br>';
}
if($_GET['utm_term']){
    $utm_openstat_referer = $utm_openstat_referer . 'utm_term : ' . $_GET['utm_term'] . '<br>';
}
if($_GET['gclid']){
    $utm_openstat_referer = $utm_openstat_referer . 'gclid : ' . $_GET['gclid'] . '<br>';
}
if($_GET['yclid']){
    $utm_openstat_referer = $utm_openstat_referer . 'yclid : ' . $_GET['yclid'] . '<br>';
}
if($_GET['partnerid']){
    $utm_openstat_referer = $utm_openstat_referer . 'partnerid : ' . $_GET['partnerid'] . '<br>';
}
if (!$utm_openstat_referer == ''){
    $utm_openstat_referer = 'user_datetime : ' . gmdate('Y-m-d-H-i-s',time()+(3*3600)) . '<br>' .  $utm_openstat_referer;
    if (isset($_COOKIE['utm_openstat_referer'])){
        $utm_openstat_referer = $_COOKIE['utm_openstat_referer'] . '<br>' .  $utm_openstat_referer;
    }
    setcookie('utm_openstat_referer', $utm_openstat_referer, time()+60*60*24*365, '/');
}

$invite_code = $_GET["invite_code"];
if (!$invite_code == ''){
    setcookie('invite_code', $invite_code, time()+60*60*24*7, '/');//время жизни - одна неделя
}

if (isset($_COOKIE['is_subscribe_user']) || $_GET['utm_source'] == 'email' || $_GET['utm_source'] == 'e-mail' || $_GET['is_subscribe'] == 'true'){
    setcookie('is_subscribe_user', true, time()+60*60*24*365, '/');
    $is_subscribe_user = true;
} else {
    $is_subscribe_user = false;
}
