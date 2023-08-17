<?
// /bitrix/modules/kontur/admin/название.php

// подключим все необходимые файлы:
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php"); // первый общий пролог
$APPLICATION->SetTitle("Excel парсер реестров");
// получим права доступа текущего пользователя на модуль
$POST_RIGHT = $APPLICATION->GetGroupRight("kontur");
// если нет прав - отправим к форме авторизации с сообщением об ошибке
if ($POST_RIGHT == "D"){
    $APPLICATION->AuthForm("ДОСТУП ЗАПРЕЩЕН");
};

$aTabs = array(
    array("DIV" => "excel_parse", "TAB" => "Парсер реестров", "TITLE" => "Парсер реестров", "ICON" => "main_user_edit", ),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);
?>
<?
// серверная обработка данных
CJSCore::Init(array("jquery"));
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php"); // второй общий пролог
?>
<?// здесь будет вывод страницы с формой?>

<style>
    .excel_parse, .input_cont{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .input_cont,.description{
        margin-bottom: 12px;
    }
    .input_cont span{
        margin-bottom: 4px;
    }
</style>

<div class="excel_parse">
   <span class="description">
      * Парсится всё в инфолок:<br>Контент => Выгрузка из excel 
   </span>
   <form id="excel_parse" action="" method="post">
      <div class="input_cont">
         <span>Excel файл:</span>
         <input required type="file" name="excel_file" id="">
      </div>
      <button type="submit">Спарсить</button>
   </form>
</div>

<script>
    $("#excel_parse").on("submit",function(event){
        event.preventDefault();

        var form_data = new FormData( document.getElementById("excel_parse") );
        $.ajax({
            url: '/ajax/excel_parse.php',
            method: 'post',
            dataType: 'html',
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
            }
        });

    });
</script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>