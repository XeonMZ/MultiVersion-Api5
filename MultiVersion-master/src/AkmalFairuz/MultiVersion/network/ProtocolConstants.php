<?php

declare(strict_types=1);

namespace AkmalFairuz\MultiVersion\network;

use function in_array;

class ProtocolConstants{

    public const BEDROCK_1_21_50 = 898;
    public const BEDROCK_1_21_60 = 910;
    public const BEDROCK_1_21_80 = 942;
    public const BEDROCK_1_21_80_1 = 944;

    public const MINECRAFT_VERSION = [
        self::BEDROCK_1_21_50 => "1.21.50",
        self::BEDROCK_1_21_60 => "1.21.60",
        self::BEDROCK_1_21_80 => "1.21.80",
        self::BEDROCK_1_21_80_1 => "1.21.80.1",
    ];

    public const SUPPORTED_PROTOCOLS = [
        self::BEDROCK_1_21_80_1,
        self::BEDROCK_1_21_80,
        self::BEDROCK_1_21_60,
        self::BEDROCK_1_21_50,
    ];

    public static function isSupportedProtocol(int $protocol) : bool{
        return in_array($protocol, self::SUPPORTED_PROTOCOLS, true);
    }
}

