<?
/*
* Событие OnOrderNewSendEmail Позволяет модифицировать массив данных, отправляемый
* в почтовое событие при заказе на сайте.
* Подробнее: https://dev.1c-bitrix.ru/community/webdev/user/50449/blog/4218/
*/
// OnOrderNewSendEmail
AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
function bxModifySaleMails($orderID, &$eventName, &$arFields){
    $arOrder = CSaleOrder::GetByID($orderID);
    
    //-- получаем телефоны и адрес
    $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
    $phone="";
    $index = ""; 
    $country_name = "";
    $city_name = "";  
    $address = "";
    while ($arProps = $order_props->Fetch()){
        if ($arProps["CODE"] == "PHONE"){
            $phone = htmlspecialchars($arProps["VALUE"]);
        }
        if ($arProps["CODE"] == "LOCATION"){
            $arLocs = CSaleLocation::GetByID($arProps["VALUE"]);
            $country_name =  $arLocs["COUNTRY_NAME_ORIG"];
            $city_name = $arLocs["CITY_NAME_ORIG"];
        }
        if ($arProps["CODE"] == "INDEX"){
            $index = $arProps["VALUE"];   
        }
        if ($arProps["CODE"] == "ADDRESS"){
            $address = $arProps["VALUE"];
        }
    }

    $full_address = $index.", ".$country_name."-".$city_name.", ".$address;

    //-- получаем название службы доставки
    $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
    $delivery_name = "";
    if ($arDeliv){
        $delivery_name = $arDeliv["NAME"];
    }

    //-- получаем название платежной системы   
    $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
    $pay_system_name = "";
    if ($arPaySystem){
        $pay_system_name = $arPaySystem["NAME"];
    }

    //-- добавляем новые поля в массив результатов
    $arFields["ORDER_DESCRIPTION"] = $arOrder["USER_DESCRIPTION"]; 
    $arFields["PHONE"] =  $phone;
    $arFields["DELIVERY_NAME"] =  $delivery_name;
    $arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
    $arFields["FULL_ADDRESS"] = $full_address;
}