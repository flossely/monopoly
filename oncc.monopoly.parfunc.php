<?php

$subActions = ["buy", "sell", "vendor", "withdraw"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "buy") {
    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objUseItem, $zoneArr);
    $objMoney = $msgBox['left'];
    $subMoney = $msgBox['right'];
} elseif ($subAction == "sell") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subUseItem, $zoneArr);
    $subMoney = $msgBox['left'];
    $objMoney = $msgBox['right'];
} elseif ($subAction == "vendor") {
    $msgBox = initExchange($thisParadigm, $yearToday, '.', $sub, $proUseItem, $zoneArr);
    $proMoney = $msgBox['left'];
    $subMoney = $msgBox['right'];
} elseif ($subAction == "withdraw") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, '.', $subUseItem, $zoneArr);
    $subMoney = $msgBox['left'];
    $proMoney = $msgBox['right'];
}
