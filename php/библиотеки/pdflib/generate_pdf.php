<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

//подключение библиотек
include( $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/aspro-scorp/libs/pdflib/include.php");
// ======================Генерация_PDF======================
// ПУТИ К ФОТО НУЖНО УКАЗЫВАТЬ АБСОЛЮТНЫЕ ОТ КОРНЯ САЙТА
$dompdf = new Dompdf();

$id = $is_ur_substring." ".$current_count;
$theme = $PROP["APPEAL_SUBJECT"];

// Генерируем pdf
ob_start();
require( $_SERVER["DOCUMENT_ROOT"]."/include/pdf/header.php");
echo $arFields["DESCRIPTION"];
require( $_SERVER["DOCUMENT_ROOT"]."/include/pdf/footer.php");
$html = ob_get_contents();
ob_end_clean();

// ------------bag_fix------------
// ф-ия validate_pdf находится в pdflib/include.php (использует стороннюю библиотеку DomPDF)
$html = validate_pdf( str_get_html($html) );
// ------------bag_fix------------

// Наполняем pdf-объект
$dompdf->loadHtml( $html );
$dompdf->render();
$output = $dompdf->output();

$filepath = $_SERVER["DOCUMENT_ROOT"]."/PDF_AutoAnswer.pdf";
file_put_contents( $filepath, $output);

// ======================Сохранение файла======================
$fid = CFile::MakeFileArray($filepath);//ссылку на файл
$fid["name"] = $arFields["NAME"]." ".$id.".pdf"; //название с расширением

$fileId = CFile::SaveFile($fid, "files");

// Отправляем почтовое событие пользователю
CEvent::Send("FOS_FORM", "s1", $PROP, "N", "", [$fileId] ); // автоответ приходит с названием темы и числом (кол-во заявок пользователя по email)
?>