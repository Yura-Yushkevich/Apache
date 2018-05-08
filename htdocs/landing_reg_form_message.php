<?php
global $utm_openstat_referer;
global $landing_reg_form_message_stat_form;
global $landing_reg_form_message_title;
global $landing_reg_form_message_stat_btn;
global $landing_reg_form_message_label_title;
global $landing_reg_form_message_label_text;
global $landing_reg_form_message_label_message;
if (!strlen($utm_openstat_referer)) {
$utm_openstat_referer = $_COOKIE['utm_openstat_referer'];
}
?>
            <div class="form-wrapper" id="form-wrapper4">
                <form action="javascript:void(0)" id="reg_web4" method="post" role="form" class="form-horizontal form-flex" <?php echo $landing_reg_form_message_stat_form; ?>>

                        <div class="form-group">
                            <label for="name3" class="col-lg-3 hidden-xs hidden-sm hidden-md">Имя*</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="name3" name="name" placeholder="Имя*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email3" class="col-lg-3 hidden-xs hidden-sm hidden-md">E-mail</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="email3" name="email" placeholder="E-mail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone3" class="col-lg-3 hidden-xs hidden-sm hidden-md">Телефон*</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="phone3" name="phone" value="7" placeholder="Телефон*">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-sm-16 mb-30">
                                <input type="hidden" class="form-control" id="subject" name="subject" placeholder="Тема письма">
                            </div>
                        </div>

                        <div class="form-group">

                            <label for="message3" class="col-lg-3 hidden-xs hidden-sm hidden-md">Сообщение</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" cols="30" rows="4" id="message3" name="message" placeholder="Сообщение"></textarea>
                            </div>
                        </div>

                    <div class="row">
                        <div class="submitButtonMessage questions-btn">
                            <div class="d-h"><?php
                                ?><textarea cols="40" rows="5" name="labels" tabindex="-1">(Get from Cookies)<br><?php echo $utm_openstat_referer; ?></textarea><?php
                                ?><input type="hidden" name="rel" value="<?php echo $landing_reg_form_message_title; ?>"><?php
                                ?><input type="hidden" name="url"><?php
                                ?><input type="hidden" name="invite_code" value="<?php echo $invite_code; ?>"><?php
                                ?><input type="hidden" name="msg_short" value="Встроенная форма на странице"><?php
                                ?><input type="hidden" name="domain" value="<?php echo $_SERVER['SERVER_NAME']; ?>"><?php
                            ?></div>
                            <div class="form-group">
                                <div class="col-lg-9 col-lg-push-3">
                                    <div class="links">
                                        <div><button type="submit" id="submit3" class="btn btn-primary btn-lg" <?php echo $landing_reg_form_message_stat_btn; ?>>Отправить</button></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <div class="answerBgWrp">
                    <div class="form-answer" id="results3">
                        <div class="d-tr">
                            <div class="d-tc">
                                <div class="row">
                                    <div class="p-15">
                                        <div class="form-is-error" style="display: none;">
                                            <p class="h1 text-danger">Упс...</p>
                                            <div class="form-notify">
                                                <div class="text-danger js-form-dangers" id="dangers3">
                                                    <p>Что-то пошло не так. Пожалуйста, попробуйте еще</p>
                                                </div>
                                                <div class="text-center">
                                                    <a class="text-block-close" href="javascript:void(0)">Попробовать еще раз &cularr;</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-is-success" style="display: none;">
                                            <p class="h1 text-success">Спасибо!</p>
                                            <div class="form-notify">
                                                <p class="text-success">
                                                    Ваша заявка принята!<br>
                                                    Наши менеджеры свяжутся с вами в рабочее время в течение нескольких часов.
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <div class="lead"><a class="text-block-close" href="javascript:void(0)">&times;</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>