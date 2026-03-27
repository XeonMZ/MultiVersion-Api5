<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/AkmalFairuz/MultiVersion/network/ProtocolConstants.php';

use AkmalFairuz\MultiVersion\network\ProtocolConstants;

$expected = [944, 942, 910, 898];
$actual = ProtocolConstants::SUPPORTED_PROTOCOLS;

sort($expected);
$sortedActual = $actual;
sort($sortedActual);

if($sortedActual !== $expected){
    fwrite(STDERR, "SUPPORTED_PROTOCOLS mismatch: " . json_encode($actual) . PHP_EOL);
    exit(1);
}

$resourceDir = __DIR__ . '/../resources/vanilla';
$requiredFiles = [
    'canonical_block_states_944.nbt',
    'canonical_block_states_942.nbt',
    'canonical_block_states_910.nbt',
    'canonical_block_states_898.nbt',
    'r12_to_current_block_map_944.bin',
    'r12_to_current_block_map_942.bin',
    'r12_to_current_block_map_910.bin',
    'r12_to_current_block_map_898.bin',
    'required_item_list_944.json',
    'required_item_list_942.json',
    'required_item_list_910.json',
    'required_item_list_898.json',
];

$missing = [];
foreach($requiredFiles as $file){
    if(!is_file($resourceDir . '/' . $file)){
        $missing[] = $file;
    }
}

if($missing !== []){
    fwrite(STDERR, "Missing resource files: " . implode(', ', $missing) . PHP_EOL);
    exit(1);
}

echo "Protocol matrix check passed for 944/942/910/898" . PHP_EOL;
