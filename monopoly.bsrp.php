<?php

function parseArrayFile($name): array {
    $str = file_get_contents($name);
    $arr = explode('|[1]|', $str);
    $obj = [];
    foreach ($arr as $line) {
        $div = explode('|[>]|', $line);
        $prop = $div[0];
        $val = $div[1];
        $obj[$prop] = $val;
    }
    
    return $obj;
}

function parseGetData($data): array {
    $parse = explode('|[1]|', $data);
    $arr = [];
    foreach ($parse as $load) {
        $line = explode('|[>]|', $load);
        $prop = $line[0];
        $value = $line[1];
        $arr[$prop] = $value;
    }
    
    return $arr;
}

function gitExecute($host = 'https://github.com', $repo, $branch, $user) {
    if (file_exists($repo)) {
        chmod($repo, 0777);
        unlink($repo);
    }
    if ($branch != '') {
        exec('git clone -b '.$branch.' '.$host.'/'.$user.'/'.$repo);
    } else {
        exec('git clone '.$host.'/'.$user.'/'.$repo);
    }
    exec('chmod -R 777 .');
    chmod($repo, 0777);
}

function gitPerform($host = 'https://github.com', $repo, $branch, $user, $file, $dest, $name) {
    if (file_exists($repo)) {
        chmod($repo, 0777);
        rename($repo, $repo.'.d');
    }
    if ($branch != '') {
        exec('git clone -b '.$branch.' '.$host.'/'.$user.'/'.$repo);
    } else {
        exec('git clone '.$host.'/'.$user.'/'.$repo);
    }
    exec('chmod -R 777 .');
    chmod($repo, 0777);
    gitOperation($repo, $file, $dest, $name);
    exec('chmod -R 777 .');
    exec('rm -rf '.$repo);
    if (file_exists($repo.'.d')) {
        chmod($repo.'.d', 0777);
        rename($repo.'.d', $repo);
    }
}

function gitOperation($repo, $filename, $dest, $newname) {
    if (file_exists('./'.$repo.'/'.$filename)) {
        copy('./'.$repo.'/'.$filename, './'.$dest.'/'.$newname);
        chmod('./'.$dest.'/'.$newname, 0777);
    }
}

if (file_exists('paradigm')) {
    $paradigm = file_get_contents('paradigm');
} else {
    $paradigm = 'default';
}
$paradigmData = parseArrayFile($paradigm.'.par');

if (file_exists('year')) {
    $today = file_get_contents('year');
} else {
    $today = $paradigmData['default_year'];
}

if (file_exists('locale')) {
    $localeOpen = file_get_contents('locale');
    $locale = ($localeOpen != '') ? $localeOpen : $paradigmData['default_zone'];
} else {
    $locale = $paradigmData['default_zone'];
}
$lingua = $locale;

$add = $_REQUEST['id'];
$dataString = $_REQUEST['data'];

$objMeta = parseGetData($dataString);

if (!file_exists($add)) {
    mkdir($add);
    chmod($add, 0777);
}

if (!file_exists($add.'/coord')) {
    file_put_contents($add.'/coord', $paradigmData['default_coord']);
    chmod($add.'/coord', 0777);
}
if (!file_exists($add.'/rating')) {
    file_put_contents($add.'/rating', $paradigmData['default_rating']);
    chmod($add.'/rating', 0777);
}
if (!file_exists($add.'/mode')) {
    file_put_contents($add.'/mode', $paradigmData['default_mode']);
    chmod($add.'/mode', 0777);
}
if (!file_exists($add.'/score')) {
    file_put_contents($add.'/score', $paradigmData['default_score']);
    chmod($add.'/score', 0777);
}
if (!file_exists($add.'/money')) {
    file_put_contents($add.'/money', $paradigmData['default_money']);
    chmod($add.'/money', 0777);
}
if (!file_exists($add.'/born')) {
    file_put_contents($add.'/born', $today);
    chmod($add.'/born', 0777);
}
file_put_contents($add.'/locale', $lingua);
chmod($add.'/locale', 0777);
file_put_contents($add.'/zones', $paradigmData['default_zones']);
chmod($add.'/zones', 0777);
$lallzones = explode(',', $paradigmData['default_zones']);
foreach ($lallzones as $key=>$value) {
    if (!file_exists($add.'/'.$value.'.cur')) {
        file_put_contents($add.'/'.$value.'.cur', $paradigmData['default_currency_sign']);
        chmod($add.'/'.$value.'.cur', 0777);
    }
    if (!file_exists($add.'/'.$value.'.curval')) {
        file_put_contents($add.'/'.$value.'.curval', $paradigmData['default_currency_value']);
        chmod($add.'/'.$value.'.curval', 0777);
    }
}

if (isset($objMeta['name'])) {
    file_put_contents($add.'/name', $objMeta['name']);
    chmod($add.'/name', 0777);
}

if (isset($objMeta['favicon'])) {
    gitPerform('https://github.com', 'raw', 'main', 'wholemarket', $objMeta['favicon'], $add, 'favicon.png');
}
