<?php

$subActions = ["buy", "sell", "vendor", "withdraw"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "buy") {
    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objUseItem);
    $objMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == "sell") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subUseItem);
    $subMoney = $msgBox['debit'];
    $objMoney = $msgBox['credit'];
} elseif ($subAction == "vendor") {
    $msgBox = initExchange($thisParadigm, $yearToday, '.', $sub, $proUseItem);
    $proMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == "withdraw") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, '.', $subUseItem);
    $subMoney = $msgBox['debit'];
    $proMoney = $msgBox['credit'];
}
