<?php

$subActions = ["buy", "sell", "vendor", "withdraw"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "buy") {
    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseItem);
    $objMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == "sell") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseItem);
    $subMoney = $msgBox['debit'];
    $objMoney = $msgBox['credit'];
} elseif ($subAction == "vendor") {
    $msgBox = initExchange($thisParadigm, $yearToday, '.', $sub, $proMoney, $subMoney, ratioCalc($proEconVal, $subEconVal), $proUseItem);
    $proMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == "withdraw") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, '.', $subMoney, $proMoney, ratioCalc($subEconVal, $proEconVal), $subUseItem);
    $subMoney = $msgBox['debit'];
    $proMoney = $msgBox['credit'];
}
