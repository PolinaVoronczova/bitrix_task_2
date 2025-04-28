<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
*/

if ($arResult["isFormErrors"] == "Y") : ?>
    <?php echo $arResult["FORM_ERRORS_TEXT"];?>
<?php endif;?>

<?php echo $arResult["FORM_NOTE"] ?? '' ?>

<?php if ($arResult["isFormNote"] != "Y") {
        echo $arResult["FORM_HEADER"];
    ?>

    <div class="contact-form">
        <div class="contact-form__head">

            <?php if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y") { ?>

                <?php if ($arResult["isFormTitle"]) { ?>
                    <div class="contact-form__head-title"><?php echo $arResult["FORM_TITLE"]?></div>
                <?php } ?>

                <?php if ($arResult["isFormDescription"]) { ?>
                    <div class="contact-form__head-text"><?php echo $arResult["FORM_DESCRIPTION"]?></div>
                <?php } ?>

                <?php
            } ?>
        </div>
    
        <form class="contact-form__form" action="/" method="POST">
        <div class="contact-form__form-inputs">
        <?php
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {

            if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                echo $arQuestion["HTML_CODE"];
            } elseif ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] !== 'textarea') { ?>
    
                <div class="input contact-form__input">
                    <label class="input__label" 
                        for="form_<?php echo $arQuestion["STRUCTURE"][0]["FIELD_TYPE"]?>_<?php echo $arQuestion["STRUCTURE"][0]["ID"]?>">
                        <div class="input__label-text">
                            <?php echo $arQuestion["CAPTION"]?>

                            <?php if ($arQuestion["REQUIRED"] == "Y") : ?>
                                <?php echo $arResult["REQUIRED_SIGN"];?>
                            <?php endif;?></div>

                           <?php echo $arQuestion["HTML_CODE"]?>

                            <?php if (isset($arResult["FORM_ERRORS"][$FIELD_SID])) : ?>
                                <div class="input__notification"><?php htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?></div>
                            <?php endif;?>

                    </label>
                </div>
    
                <?php
            } 
        } //endwhile
        ?>
        </div>
        <div class="contact-form__form-message">
            <div class="input">
                <label class="input__label" for="form_<?php echo $arResult["QUESTIONS"]["medicine_message"]["STRUCTURE"][0]["FIELD_TYPE"]?>_<?php echo $arResult["QUESTIONS"]["medicine_message"]["STRUCTURE"][0]["ID"]?>">
                    <div class="input__label-text">
                        <?php echo $arResult["QUESTIONS"]["medicine_message"]["CAPTION"]?>

                        <?php if ($arResult["QUESTIONS"]["medicine_message"]["REQUIRED"] == "Y") : ?>
                            <?php echo $arResult["QUESTIONS"]["medicine_message"]["REQUIRED_SIGN"];?>
                        <?php endif;?>

                    </div>
                        <?php echo $arResult["QUESTIONS"]["medicine_message"]["HTML_CODE"]?>

                        <?php if (isset($arResult["FORM_ERRORS"][$FIELD_SID])) : ?>
                                <div class="input__notification"><?php htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?></div>
                        <?php endif;?>

                </label>
            </div>   
        </div>
        <?php

        if ($arResult["isUseCaptcha"] == "Y") { ?>
        
            <div class="captcha-title">
                <b><?php echo GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
            </div>
            <div class="captcha-img">
                <input type="hidden" name="captcha_sid" value="<?php echo htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?php echo htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" alt=""/>
            </div>
            <div class="captcha-word">
                <td><?php GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?php echo $arResult["REQUIRED_SIGN"];?></td>
                <td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
            </div>
        
            <?php
        }
        ?>
        
            <div class="contact-form__bottom">
                    <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                        ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                        данных&raquo;.
                    </div>
                    <input <?php echo(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" class="form-button contact-form__bottom-button" 
                    value="<?php echo htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
            </div>
        
        </form>
    </div>
        <?php echo $arResult["FORM_FOOTER"]?>
<?php } //endif (isFormNote)