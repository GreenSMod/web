<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP - Итоговый код</title>
</head>
<body>

<?php
echo "<h3>Пункт 1</h3>";
function showInterval($start, $end)
{
    if ($start > $end) {
        echo "<p>Ошибка: начальное значение не может быть больше конечного.</p>";
        return;
    }
    $i = $start;
    do {
        if ($i == 0) {
            echo "{$i} – это ноль.<br>";
        } elseif ($i % 2 == 0) {
            echo "{$i} – чётное число.<br>";
        } else {
            echo "{$i} – нечётное число.<br>";
        }
        $i++;
    } while ($i <= $end);
}

showInterval(0, 10);


echo "<h3>Пункт 2</h3>";
$localities = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин']
];
foreach ($localities as $region => $cities) {
    $citiesString = implode(', ', $cities);
    echo "<b>{$region}:</b><br>";
    echo "{$citiesString}.<br><br>";
}


echo "<h3>Пункт 3</h3>";
$translitMap = [
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
    'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
    'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '',
    'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
];

function transliterate($string, $map) {
    $string = mb_strtolower($string, 'UTF-8');
    return strtr($string, $map);
}

$textToTransliterate = "это текст на русском языке!";
$transliteratedText = transliterate($textToTransliterate, $translitMap);
echo "<p>Оригинал: {$textToTransliterate}</p>";
echo "<p>Результат: {$transliteratedText}</p>";


echo "<h2>пункт 4</h2>";

$menu = array(
    'name' => 'Каталог товаров',
    'hasChildren' => true,
    'items' => array(
        array(
            'name' => '1',
            'hasChildren' => true,
            'items' => array(
                array(
                    'name' => '1.1',
                    'hasChildren' => false,
                    'items' => []
                ),
                array(
                    'name' => '1.2',
                    'hasChildren' => true,
                    'items' => array(
                        array(
                            'name' => '1.2.1',
                            'hasChildren' => false,
                            'items' => []
                        ),
                        array(
                            'name' => '1.2.2',
                            'hasChildren' => false,
                            'items' => []
                        )
                    )
                )
            )
        ),
        array(
            'name' => '2',
            'hasChildren' => false,
            'items' => []
        )
    )

);

function renderParent($data): string
{
    $parent = '';
    $name = $data['name'];
    $parent .= "<li>$name<ul>";
    foreach ($data['items'] as $element){
        if ($element['hasChildren']){
            $parent .= renderParent($element);
        }
        else{
            $parent .= renderChildren($element);
        }
    }
    $parent .= "</li></ul>";
    return $parent;
}
function renderChildren($data): string
{
    $name = $data['name'];
    return "<li>$name</li>";
}

$result_tree = renderParent($menu);

echo "<ul>$result_tree</ul>";


echo "<h3>Пункт 6</h3>";
foreach ($localities as $region => $cities) {
    $citiesStartingWithK = [];
    foreach ($cities as $city) {
        if (mb_substr(mb_strtolower($city, 'UTF-8'), 0, 1) === 'к') {
             $citiesStartingWithK[] = $city;
        }
    }
    
    if (!empty($citiesStartingWithK)) {
        $citiesString = implode(', ', $citiesStartingWithK);
        echo "<b>{$region}:</b><br>";
        echo "{$citiesString}.<br><br>";
    }
}
?>

</body>
</html>