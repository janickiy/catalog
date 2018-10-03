<?php

/**
 * @param $status
 * @return string
 */
function linkStatus($status)
{
    switch ($status) {
        case 'new':
            return 'ожидает проверку';
            break;

        case 'publish':
            return 'опубликован';
            break;

        case 'hide':
            return 'скрыта';
            break;

        case 'block':
            return 'в черном списке';
            break;

        default: return $status;
    }
}

/**
 * @param $text
 * @return mixed
 */
function ru2Lat($text)
{
    $cyr = [
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
        'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
        'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
        'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
        'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
    ];

    $lat = [
        'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
        'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
        'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'IA',
        'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
        'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
        'h', 'c', 'ch', 'sh', 'sh', '`', 'y', '`', 'e', 'iu', 'ia'
    ];

    $text = str_replace($cyr, $lat, $text);
    $text = str_replace("_", " ", $text);

    return $text;
}

/**
 * @param $str
 * @return string
 */
function ucfirst_utf8($str)
{
    return mb_substr(mb_strtoupper($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str) - 1, 'utf-8');
}

/**
 * @param $string
 * @return mixed
 */
function Lat2ru($string)
{
    $cyr = [
        "Щ", "Ш", "Ч", "Ц", "Ю", "Я", "Ж", "А", "Б", "В",
        "Г", "Д", "Е", "Ё", "З", "И", "Й", "К", "Л", "М", "Н",
        "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ь", "Ы", "Ъ",
        "Э", "Є", "Ї", "І", "В",
        "щ", "ш", "ч", "ц", "ю", "я", "ж", "а", "б", "в",
        "г", "д", "е", "ё", "з", "и", "й", "к", "л", "м", "н",
        "о", "п", "р", "с", "т", "у", "ф", "х", "ь", "ы", "ъ",
        "э", "є", "ї", "і", "в"
    ];

    $lat = [
        "Shch", "Sh", "Ch", "C", "Yu", "Ya", "J", "A", "B", "V",
        "G", "D", "E", "E", "Z", "I", "y", "K", "L", "M", "N",
        "O", "P", "R", "S", "T", "U", "F", "H", "",
        "Y", "", "E", "E", "Yi", "I", "W",
        "shch", "sh", "ch", "c", "Yu", "Ya", "j", "a", "b", "v",
        "g", "d", "e", "e", "z", "i", "y", "k", "l", "m", "n",
        "o", "p", "r", "s", "t", "u", "f", "h",
        "", "y", "", "e", "e", "yi", "i", "w"
    ];

    $string = str_replace($lat, $cyr, $string);
    $string = str_replace("_", " ", $string);
    return $string;
}

/**
 * @param $text
 * @return false|mixed|null|string|string[]
 */
function slug($text)
{
    $text = trim($text);

    $tr = [
        "А" => "A",
        "Б" => "B",
        "В" => "V",
        "Г" => "G",
        "Д" => "D",
        "Е" => "E",
        "Ё" => "E",
        "Ж" => "J",
        "З" => "Z",
        "И" => "I",
        "Й" => "Y",
        "К" => "K",
        "Л" => "L",
        "М" => "M",
        "Н" => "N",
        "О" => "O",
        "П" => "P",
        "Р" => "R",
        "С" => "S",
        "Т" => "T",
        "У" => "U",
        "Ф" => "F",
        "Х" => "H",
        "Ц" => "TS",
        "Ч" => "CH",
        "Ш" => "SH",
        "Щ" => "SCH",
        "Ъ" => "",
        "Ы" => "YI",
        "Ь" => "",
        "Э" => "E",
        "Ю" => "YU",
        "Я" => "YA",
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "e",
        "ж" => "j",
        "з" => "z",
        "и" => "i",
        "й" => "y",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "u",
        "ф" => "f",
        "х" => "h",
        "ц" => "ts",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "sch",
        "ъ" => "y",
        "ы" => "yi",
        "ь" => "",
        "э" => "e",
        "ю" => "yu",
        "я" => "ya",
        "«" => "",
        "»" => "",
        "№" => "",
        "Ӏ" => "",
        "’" => "",
        "ˮ" => "",
        "_" => "-",
        "'" => "",
        "`" => "",
        "^" => "",
        "\." => "",
        "," => "",
        ":" => "",
        ";" => "",
        "<" => "",
        ">" => "",
        "!" => "",
        "\(" => "",
        "\)" => ""
    ];

    foreach ($tr as $ru => $en) {
        $text = mb_eregi_replace($ru, $en, $text);
    }

    $text = mb_strtolower($text);
    $text = str_replace(' ', '-', $text);
    return $text;
}

/**
 * @param $originalDate
 * @return false|string
 */
function date_format_ru($originalDate)
{
    return date("d.m.Y", strtotime($originalDate));
}

/**
 * @param string $datestr
 * @param bool $short
 * @return string
 */
function mysql_russian_date($datestr = '', $short = false)
{
    if ($datestr == '') return '';

    list($day) = explode(' ', $datestr);

    switch ($day) {
        case date('Y-m-d'):
            $result = 'Сегодня';
            break;

        case date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"))):
            $result = 'Вчера';
            break;

        default:
            {
                list($y, $m, $d) = explode('-', $day);
                $month_str = $short == true ? ['янв', 'фев', 'март', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноябр', 'дек'] : ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
                $month_int = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $m = str_replace($month_int, $month_str, $m);
                $result = $d . ' ' . $m . ' ' . $y;
            }
    }

    return $result;
}

/**
 * @param string $datestr
 * @param bool $short
 * @return string
 */
function mysql_english_date($datestr = '', $short = false)
{
    if ($datestr == '') return '';

    list($day) = explode(' ', $datestr);

    switch ($day) {
        case date('Y-m-d'):
            $result = 'today';
            break;

        case date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"))):
            $result = 'yesterday';
            break;

        default:
            {
                list($y, $m, $d) = explode('-', $day);
                $month_str = $short == true ? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Augt', 'Sept', 'Oct', 'Nov', 'Dec'] : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $month_int = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $m = str_replace($month_int, $month_str, $m);
                $result = $d . ' ' . $m . ' ' . $y;
            }
    }

    return $result;
}

/**
 * @param string $datestr
 * @param bool $short
 * @return string
 */
function mysql_russian_datetime($datestr = '', $short = false)
{
    if ($datestr == '') return '';

    $dt_elements = explode(' ', $datestr);

    $date_elements = explode('-', $dt_elements[0]);
    $time_elements = explode(':', $dt_elements[1]);

    $result1 = mktime($time_elements[0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]);
    $monthes = $short == true ? [' ', 'янв', 'фев', 'март', 'апр', 'мая', 'июн', 'июл', 'авг', 'сент', 'окт', 'ноябр', 'дек'] : [' ', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    $days = $short == true ? [' ', 'пон', 'вт', 'ср', 'чет', 'пят', 'суб', 'воск'] : [' ', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];
    $day = date("j", $result1);
    $month = $monthes[date("n", $result1)];
    $year = date("Y", $result1);
    $hour = date("G", $result1);
    $minute = date("i", $result1);
    $dayofweek = $days[date("N", $result1)];
    $result = $day . ' ' . $month . ' ' . $year;

    return $result;
}

/**
 * @param string $datestr
 * @param bool $short
 * @return string
 */
function mysql_english_datetime($datestr = '', $short = false)
{
    if ($datestr == '') return '';

    $dt_elements = explode(' ', $datestr);

    $date_elements = explode('-', $dt_elements[0]);
    $time_elements = explode(':', $dt_elements[1]);

    $result1 = mktime($time_elements[0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]);
    $monthes = $short == true ? [' ', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'] : [' ', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $days = $short == true ? [' ', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'] : [' ', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $day = date("j", $result1);
    $month = $monthes[date("n", $result1)];
    $year = date("Y", $result1);
    $hour = date("G", $result1);
    $minute = date("i", $result1);
    $dayofweek = $days[date("N", $result1)];
    $result = $day . ' ' . $month . ' ' . $year;

    return $result;
}

/**
 * @param $str
 * @param int $chars
 * @return string
 */
function shortText($str, $chars = 500)
{
    $pos = strpos(substr($str, $chars), " ");
    $srttmpend = strlen($str) > $chars ? '...' : '';

    return substr($str, 0, $chars + $pos) . (isset($srttmpend) ?  $srttmpend : '');
}