<?
/*
* Ошибка "Allowed memory size of 1610612736 bytes exhausted (tried to allocate 262144 bytes) in Unknown on line 0 Fatal error ..." При установки на windows (open server)
* При установке заменить метод в файле /bitrix/modules/main/lib/security/random.php
*/
public static function getStringByCharsets($length, $charsetList)
{
       // Временно возвращаем "свою" рандомную строку
       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $randstring = '';
       for ($i = 0; $i < 10; $i++) {
           $randstring = $characters[rand(0, strlen($characters))];
       }
       return $randstring; // Конец

    $charsetVariants = strlen($charsetList);
    $randomSequence = static::getBytes($length);

    $result = '';
    for ($i = 0; $i < $length; $i++)
    {
       $randomNumber = ord($randomSequence[$i]);
       $result .= $charsetList[$randomNumber % $charsetVariants];
    }
    return $result;
}




// Вернуть оригинальную ф-иб после установки. Оригинальная фукнция:
public static function getStringByCharsets($length, $charsetList)
{
    $charsetVariants = strlen($charsetList);
    $randomSequence = static::getBytes($length);

    $result = '';
    for ($i = 0; $i < $length; $i++)
    {
        $randomNumber = ord($randomSequence[$i]);
        $result .= $charsetList[$randomNumber % $charsetVariants];
    }
    return $result;
}