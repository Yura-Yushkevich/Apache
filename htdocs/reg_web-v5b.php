<?

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

//if ($_POST['phone'] == '+74951341801') {
//    exit();
//};

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
        $email_to   = 'info@lidtreyd.ru';/*'i-retail-sales@i-retail.com'; info@alborg.ru*/
//        $email_to   = 'crm_report@i-retail.com, yuriyglushkov@gmail.com, smirnoff.andrey@gmail.com';
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
        $web_phone = '+' . $web_phone;
    };
    $web_email   = $_POST['email'];
    $web_company   = $_POST['company'];
    $web_message   = $_POST['message'];
    $web_subject = $_POST['subject'];
    $web_calc_result   = $_POST['calc-result'];
    if (!empty($web_calc_result)){
        $web_message = $web_calc_result;
    }
    $web_short   = $_POST['msg_short'];
    $web_url   = '';
    $web_url   = $_POST['url'];
    $web_domain   = $_POST['domain'];
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

    if (!empty($web_subject)){
        $subject = $web_subject;
    }

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
        . "MIME-Version: 1.0\r\n"
        . "Content-Type: text/plain; charset=$sc\r\n"
        . "Content-Transfer-Encoding: 8bit\r\n\r\n"
    ;
    date_default_timezone_set('Europe/Moscow'); //для штампа
    $date = date("Y-m-d");
    $time = date("H:i:s");

    //обрабатываем строку labels
    $pieceswbr = explode("\n", $web_labels);
    foreach ($pieceswbr as $value) {
        $string = explode(" : ", $value);
        switch ($string[0]) {
            case 'user_datetime':
                $utm_http_reterer = '';
                $utm_source = '';
                $utm_medium = '';
                $utm_campaign = '';
                $utm_content = '';
                $utm_term = '';
                $gclid = '';
                $yclid = '';
                $openstat = '';
                break;
            case 'HTTP_REFERER':
                $utm_http_reterer = $string[1];
                break;
            case 'utm_source':
                $utm_source = $string[1];
                break;
            case 'utm_medium':
                $utm_medium = $string[1];
                break;
            case 'utm_campaign':
                $utm_campaign = $string[1];
                break;
            case 'utm_content':
                $utm_content = $string[1];
                break;
            case 'utm_term':
                $utm_term = $string[1];
                break;
            case 'gclid':
                $gclid = $string[1];
                break;
            case 'yclid':
                $yclid = $string[1];
                break;
            case '_openstat':
                $openstat = $string[1];
                break;
            default:
                # code...
                break;
        };
    };


    $arLeadFields = [
        'SOURCE' => $web_domain, //Источник, можно вписать домен
        'TYPE_SOURCE' => $web_short, //тип данных (регистрация, форма обратной связи, статусы заказов)
        'PRODUCT' => $web_product, //Продукт (IRETAIL, PIPO)
        'PARTNER_CODE' => $invite_code,
        'URL' => $web_url,
        'NAME' => $web_name, //ФИО
        'EMAIL' => $web_email, //Email
        'MOBILE' => $web_phone, //Телефон
        'MESSAGE' => $web_message, //Сообщение из формы обратной связи, вопрос и т.п.
        'COMPANY' => $web_company, //название компании
        'UTM' => json_encode([
            'HTTP_REFERER' => $utm_http_reterer,
            'utm_source' => $utm_source,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign,
            'utm_content' => $utm_content,
            'utm_term' => $utm_term,
            'gclid' => $gclid,
            'yclid' => $yclid,
            '_openstat' => $openstat,
        ]),
        'USER_ID' => '', //уникальный идентификатор пользователя, если есть
        'TYPE_CUSTOMER' => '', //1 - Юридическое лицо РФ, 2 - Юридическое лицо нерезидент, 3 - Физическое лицо РФ, 4 - Физическое лицо нерезидент
        'POSITION' => '', //должность
        'ADDRESS' => '', //адрес,
    ];

//пример на curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://a-lk.net/local/ajax/lead_add/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $arLeadFields);
    $response = curl_exec($curl);
//    echo $response;
    curl_close($curl);

////или пример file_get_contents
//    $data = http_build_query($arLeadFields);
//    $context_options = array (
//        'http' => array (
//            'method' => 'POST',
//            'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
//                . "Content-Length: " . strlen($data) . "\r\n",
//            'content' => $data
//        )
//    );
//    $context = stream_context_create($context_options);
////    file_get_contents('https://a-lk.net/local/ajax/lead_add/', false, $context);
//    $response = file_get_contents('https://a-lk.net/local/ajax/lead_add/', false, $context);


//    $response_success = stristr($response, "'error':'201'");

//    LEAD
//    CONTACT
//    COMPANY
//    ID_ENTITY
//    ID_SUPPORT

//    $LEAD = strpos($response, 'LEAD');
//    $CONTACT = strpos($response, 'CONTACT');
//    $COMPANY = strpos($response, 'COMPANY');
//    $ID_ENTITY = strpos($response, 'ID_ENTITY');
//    $ID_SUPPORT = strpos($response, 'ID_SUPPORT');
//    if ($LEAD === 0 || $CONTACT === 0 || $COMPANY === 0 || $ID_ENTITY === 0 || $ID_SUPPORT === 0) {

    $response_success = '';

    $response_success = strpos($response, 'LEAD');
    if (!$response_success === 0) {
        $response_success = strpos($response, 'CONTACT');
        if (!$response_success === 0) {
            $response_success = strpos($response, 'COMPANY');
            if (!$response_success === 0) {
                $response_success = strpos($response, 'ID_ENTITY');
                if (!$response_success === 0) {
                    $response_success = strpos($response, 'ID_SUPPORT');
                }
            }
        }
    }

    if (!$response_success === 0){
        $subject = '[!ОШИБКА!] '.$subject.'';
        $message = $message . "\n\n" . 'Отправило массив: ' . $arLeadFields . "\n\n" . 'Строка ошибки: ' . $response;
        if (mail($email_to, $subject, $message, $header)) {
            echo 'error crm email success';
        } else {
            echo 'error crm email failed';
        }
    } else {
        echo 'success';

//        if (!stristr($_POST['url'], '://demo') === FALSE) { // temp
//            $subject = '[!ТЕСТ ПРОШЕЛ!] ' . $subject . ''; // temp
//            $message = $message . "\n\n" . 'Отправило массив: ' . $arLeadFields . "\n\n" . 'Вернуло строку: ' . $response; // temp
//            if (mail($email_to, $subject, $message, $header)) { // temp
//                echo 'success crm email success'; // temp
//            } else { // temp
//                echo 'success crm email failed'; // temp
//            } // temp
//        } // temp
    }
} else {
    echo $error0.$error1.$error2;//.'<br>';
}
//echo "\nОтправило массив:\n"; // temp
//var_dump($arLeadFields); // temp
//echo "\nСтрока ответа:\n"; // temp
//var_dump($response); // temp
?>
