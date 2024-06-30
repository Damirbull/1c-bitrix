<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


use Bitrix\Main\Loader;
Loader::includeModule('iblock');


function importJsonData($iblockId, $numRecords) {
    
    $url = 'https://jsonplaceholder.typicode.com/posts';

    
    $jsonData = file_get_contents($url);
    if ($jsonData === false) {
        die('Не удалось получить данные.');
    }

    
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Ошибка при парсинге JSON данных.');
    }

    
    $data = array_slice($data, 0, $numRecords);

    
    foreach ($data as $record) {
        $el = new CIBlockElement;

        
        $arLoadProductArray = array(
            "IBLOCK_ID"      => $iblockId,
            "NAME"           => "Next level opportunities are creating dynamic worlds", 
            "ACTIVE"         => "Y",
            "PREVIEW_TEXT"   => "Business strategy guides decisions and actions towards long-term goals, allocating resources and adapting to market.",
            "DETAIL_TEXT"    => "John Jonas",
            "PREVIEW_PICTURE" => CFile::MakeFileArray("/home/bitrix/www/local/img/blog-posts-pic.png"),
            "DETAIL_PICTURE" => CFile::MakeFileArray("/home/bitrix/www/local/img/Profile.png"),
            "PROPERTY_VALUES" => array(
                "JOB" => "Web Developer", 
            ),
        );

        
        if (!$el->Add($arLoadProductArray)) {
            echo 'Ошибка добавления записи: ' . $el->LAST_ERROR . '<br>';
        } else {
            echo 'Запись успешно добавлена!<br>';
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'importData') {

    importJsonData(4, 3); // Пример: Добавит 3 записи в инфоблок 4
    exit; 
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
