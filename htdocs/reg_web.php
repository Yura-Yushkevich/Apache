<?
//if (!isset($_POST['web_code']) or empty($_POST['web_code'])) {
//    $error1 = "Некорректный код<br />";
//} else $error1 = NULL;

if (!isset($_POST['web_name']) or empty($_POST['web_name'])) {
    $error1 = "Некорректное имя<br />";
} else $error1 = NULL;

if (!isset($_POST['web_email']) or empty($_POST['web_email'])) {
    $error2 = "Некорректный Email<br />";
} else {
    if (preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $_POST['web_email'])) {
        $error2 = NULL;
    } else {
        $error2 = "Некорректный Email<br />";
    }
}

if (!isset($_POST['web_phone']) or empty($_POST['web_phone'])) {
    $error3 = "Некорректный телефон<br />";
} else {
    if (preg_match("/^[0-9\+\-\(\)\s]+$/", $_POST['web_phone'])) {
        $error3 = NULL;
    } else {
        $error3 = "Некорректный телефон<br />";
    }
}


if (empty($error1) and empty($error2) and empty($error3)) {//empty($error1) and
    function mime_header_encode($str, $data_charset, $send_charset){
        if($data_charset != $send_charset)
            $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
        return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
    }
    $dc='UTF-8';//$data_charset
    $sc='UTF-8';//$send_charset

    $subject = '[Сообщение с сайта ЛидТрейд] от '. $_POST['web_name'];
    $web_name   = $_POST['web_name'];
    $web_email   = $_POST['web_email'];
    $web_phone   = $_POST['web_phone'];
    $web_message   = $_POST['web_message'];
    $email_to   = 'info@lidtreyd.ru, yuriyglushkov@gmail.com';
//    $email_to   = 'o.ivanov@clickphone.net, yuriyglushkov@gmail.com, smirnoff.andrey@gmail.com';//'ask@cpasearcher.com';//ask@cpasearcher.com
    $message = "Регистрация \nИмя: {$web_name} \nEmail: {$web_email} \nТелефон: {$web_phone} \nСообщение: \n{$web_message} \n";

    $subject = mime_header_encode($subject,$dc,$sc);
    $message= $dc==$sc ? $message : iconv($dc,$sc.'//IGNORE',$message);
    $uid = md5(uniqid(time()));
    $from = str_replace(array("\r", "\n"), '', $web_email); // to prevent email injection
    $header =
          "From: " . $from . "\r\n"
        . "To: " . $email_to . "\r\n"
        . "MIME-Version: 1.0\r\n"
//        . "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n"
//        . "This is a multi-part message in MIME format.\r\n"
        . "Content-Type: text/plain; charset=$sc\r\n"
        . "Content-Transfer-Encoding: 8bit\r\n\r\n"
//        . "--" . $uid . "\r\n"
//        . $message . "\r\n\r\n"
//        . "--" . $uid . "--"
        ;

    if (mail($email_to, $subject, $message, $header)) {
        echo "Ваша заявка отправлена".'<br><br>';
    } else {
        echo "Что-то пошло не так. Пожалуйста, попробуйте еще".'<br><br>';
    };
} else {
    echo $error1.$error2.$error3;//.'<br>';
}
?>