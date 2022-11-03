<?php

$subActions = ["vendor", "withdraw"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "vendor") {
    $msgBox = initExchange($thisParadigm, $yearToday, '.', $sub, $proUseItem, $zoneArr);
    $proMoney = $msgBox['left'];
    $subMoney = $msgBox['right'];
} elseif ($subAction == "withdraw") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, '.', $subUseItem, $zoneArr);
    $subMoney = $msgBox['left'];
    $proMoney = $msgBox['right'];
}
