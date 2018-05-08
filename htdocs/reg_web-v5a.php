<?php
//Demo
/*$db_host = "localhost";
$db_user = "homestead";
$db_pass = "secret";
$db_base = "payin_pp";*/

//Prod
$db_host = "localhost";
$db_user = "userobr";
$db_pass = "JgN6PGh2tRAh";
$db_base = "dbobr";



$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_base) or die ("<p>Невозможно подключение к MySQL</p>");
$mysqli->query("SET NAMES 'utf8'");


/********************************************************************************************/

//find (Get from Cookies)
$mystring = $_POST['labels'];
$findme   = 'Get from Cookies';
$pos = strpos($mystring, $findme);
if (!isset($_POST['labels']) or empty($_POST['labels']) or !isset($_POST['url']) or empty($_POST['url'])) {
    $error0 = "<p>Что-то пошло не так. Пожалуйста, попробуйте перезагрузить страницу или воспользуйтесь другой формой.</p>";
} elseif ($pos === false) {
    $error0 = "<p>Что-то пошло не так. Пожалуйста, попробуйте перезагрузить страницу или воспользуйтесь другой формой.</p>";
} else $error0 = NULL;

if (!isset($_POST['phone']) or empty($_POST['phone'])) {
    $error1 = "<p>Номер телефона некорректен.</p>";
} else $error1 = NULL;

if (!isset($_POST['name']) or empty($_POST['name'])) {
    $error2 = "<p>Некорректное имя.</p>";
} else $error2 = NULL;

if (empty($error0) and empty($error1) and empty($error2)) {
    function mime_header_encode($str, $data_charset, $send_charset){
        if($data_charset != $send_charset)
            $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
        return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
    }
    $dc='UTF-8';//$data_charset
    $sc='UTF-8';//$send_charset

    $web_name   = $_POST['name'];
    if ($web_name == "My Name") {
        $web_name = '';
    };
//    if (stristr($_POST['url'], '://demo') === FALSE) { // temp
        $subject = $_POST['rel'] . " " . $web_name;
        $email_to = 'info@lid-time.com'; //, yuriyglushkov@gmail.com,i-retail-sales@i-retail.com
//    } else { // temp
//        $subject = "[TEST] " . $_POST['rel'] . " " . $web_name; // temp
//        $email_to   = 'crm_report@i-retail.com, yuriyglushkov@gmail.com, smirnoff.andrey@gmail.com'; // temp
//    } // temp
    $web_phone   = $_POST['phone'];
    if ($web_phone == "+74951341801") {
        $web_phone = '';
    } else {
        $ptn = "/\D/";
        $rpltxt = "";
        $web_phone = preg_replace($ptn, $rpltxt, $web_phone);
    };
    $web_email = $_POST['email'];
    $web_company = $_POST['company'];
    $web_message = $_POST['message'];
    $web_subject = $_POST['subject'];
    $web_calc_result = $_POST['calc-result'];
    if (!empty($web_calc_result)){
        $web_message = $web_calc_result;
    }
    $web_short   = $_POST['msg_short'];
    $web_url   = '';
    $web_url   = $_POST['url'];
    $web_labels   = $_POST['labels'];
    $web_labels = str_replace('(Get from Cookies)<br>','', $web_labels);
    $web_product = 'Lidtreyd';
    $invite_code = $_POST['invite_code'];
    $inviter_name = $_POST['inviter_name'];
    $inviter_phone = $_POST['inviter_phone'];
    if (!empty($inviter_phone)){
        $message = "Имя пригласившего: {$invite_code} \n";
        $message = $message . "Тел пригласившего: {$inviter_phone} \n";
        $message = $message . "\n";
    } else {
        $message = "Контактные данные: \n";
    }
    if (!empty($invite_code)){
        $message = $message . "invite_code: {$invite_code} \n";
    }
    if (!empty($web_name)){
        $message = $message . "Имя: {$web_name} \n";
    }
    $message = $message . "Телефон: {$web_phone} \n";
    if (!empty($web_email)){
        $message = $message . "Email: {$web_email} \n";
    }
    /*if (!empty($web_company)){
        $message = $message . "Компания: {$web_company} \n";
    }*/
    if (!empty($web_message)){
        $message = $message . "\nКомментарий: \n{$web_message} \n\n";
    }
    if (!empty($web_url)){
        $message = $message . "Сообщение со страницы: {$web_url} \n";
    }
    if (!empty($web_short)){
        $message = $message . "Из формы (или формы по кнопке): {$web_short} \n";
    }
    if (!empty($web_labels)) {
        $web_labels = str_replace("<br>", "\n", $web_labels);
        $message = $message . "\nМетки:\n" . $web_labels . "\n";
    };

    $subject2lid = $subject;
    $subject = mime_header_encode($subject,$dc,$sc);
    $message= $dc==$sc ? $message : iconv($dc,$sc.'//IGNORE',$message);
    $uid = md5(uniqid(time()));
    if (stristr($web_email, '@') === FALSE) {
        $from   = 'no-reply@i-retail.com';
    } else {
        $from   = $web_email;
    };
    $header =
        ""
        . "From: " . $from . "\r\n"
//        . "To: " . $email_to . "\r\n"
        . "MIME-Version: 1.0\r\n"
        . "Content-Type: text/plain; charset=$sc\r\n"
        . "Content-Transfer-Encoding: 8bit\r\n\r\n"
    ;
    date_default_timezone_set('Europe/Moscow'); //для штампа
    $date = date("Y-m-d");
    $time = date("H:i:s");

    //отправляем данные в бд
    if (mysqli_connect_errno()) {
        printf("Соединение не установлено: %s\n", mysqli_connect_error());
        exit();
    }
    $query ="INSERT INTO form_email_list (name, phone, email, message, short, url, labels, QDate, QTime, invite_code) VALUES ('".$web_name."', '".$web_phone."', '".$web_email."', '".$web_message."', '".$web_short."', '".$web_url."', '".$web_labels."', '".$date."', '".$time."', '".$invite_code."')";
    $result=$mysqli->query($query);
    echo mysqli_error($mysqli);
    $mysqli->close();

    if (!empty($web_subject)){
        $subject = $web_subject;
    }

    if (mail($email_to, $subject, $message, $header) && $result) {
        echo 'success';
    } else {
        echo "<p>Что-то пошло не так. Пожалуйста, попробуйте еще.</p>";
    }
} else {
    echo $error0.$error1.$error2;//.'<br>';
}
?>
