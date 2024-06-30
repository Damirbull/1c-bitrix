<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Подключаем модуль инфоблоков
use Bitrix\Main\Loader;
Loader::includeModule('iblock');

// Функция для импорта данных из JSON и добавления в инфоблок
function importJsonData($iblockId, $numRecords) {
    // URL для получения JSON данных
    $url = 'https://jsonplaceholder.typicode.com/posts';

    // Получаем данные
    $jsonData = file_get_contents($url);
    if ($jsonData === false) {
        die('Не удалось получить данные.');
    }

    // Парсим JSON данные в массив
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Ошибка при парсинге JSON данных.');
    }

    // Ограничиваем количество записей
    $data = array_slice($data, 0, $numRecords);

    // Добавляем записи в инфоблок
    foreach ($data as $record) {
        $el = new CIBlockElement;

        // Параметры нового элемента
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

        // Добавляем элемент в инфоблок
        if (!$el->Add($arLoadProductArray)) {
            echo 'Ошибка добавления записи: ' . $el->LAST_ERROR . '<br>';
        } else {
            echo 'Запись успешно добавлена!<br>';
        }
    }
}

// Проверяем, является ли запрос Ajax
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'importData') {
    // Вызываем функцию импорта данных
    importJsonData(4, 3); // Пример: Добавит 3 записи в инфоблок с ID 5
    exit; // Выходим после обработки Ajax запроса
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
