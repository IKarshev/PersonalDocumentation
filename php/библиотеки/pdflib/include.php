<?
// подключаем библиотеку для создания pdf
require(__DIR__."/lib/DomPDF/autoload.inc.php");
// подключаем библиотеку - php парсер html
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/aspro-scorp/libs/php_dom_parser/simple_html_dom.php");

// Ф-ия преобразования url в корректный
function getImage($url){
    $type = pathinfo($url, PATHINFO_EXTENSION);
    $data = file_get_contents($url);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

function validate_pdf( $old_html ){
    $html = $old_html;
    // fix img
    $img = $html->find("img");
    foreach ($img as $arkey => $arItem) {
        $arItem->src = getImage($_SERVER["DOCUMENT_ROOT"].$arItem->src);// Конвертируем ссылку под pdf-формат
        $arItem->outertext = ('<div class="img_cont">'.$arItem.'</div>'); // Оборачиваем картинки в div для корректного отображения
    }
    // фиксим жирность шрифтов
    $tag_b = $html->find("b");
    foreach ($tag_b as $arkey => $arItem) {
        $arItem->style = ('font-family: times-new-roman-bold;');
    }

    return $html;
}
?>