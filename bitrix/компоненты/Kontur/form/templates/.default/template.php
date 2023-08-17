<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>

<form id="<?=$arResult["form_id"]?>" class="order_call_form" method="post" action="" enctype="multipart/form-data">
    <div class="text">
        <div class="title">Заказать звонок</div>
    </div>
    <div class="input_cont">
        <input placeholder="+7" name="phone" type="text" class="phone phone-mask"/>
        <span class="success hide">Заявка отправлена</span>
        <button type="submit"></button>
    </div>
    <div class="error_placement"></div>
</form>

<script>
	var form_id = <?=CUtil::PhpToJSObject($arResult["form_id"])?>;
</script>