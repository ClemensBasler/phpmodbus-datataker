<?php

require_once dirname(__FILE__) . '/../Phpmodbus/ModbusMasterTCP.php';

// Create Modbus object
$modbus = new ModbusMaster("192.192.15.51", "TCP");

try {
    // Read input discretes - FC 4
    $cv_start = 2;
    $cv_end = 10;

    $recData = $modbus->readMultipleInputRegisters(0, $cv_start-1, $cv_end);
}
catch (Exception $e) {
    // Print error information if any
    echo $modbus;
    echo $e;
    exit;
}

for ($i = 0; $i <= (($cv_end*2)-4); $i += 4) {
  $a = unpack('f', strrev($recData[$i] . $recData[$i+1] . $recData[$i+2] . $recData[$i+3]));
  echo $a[1];  // 3589825.25
  echo("\n");
}
