<?php

declare(strict_types=1);

namespace AkmalFairuz\MultiVersion\command;

use AkmalFairuz\MultiVersion\MultiVersion;
use AkmalFairuz\MultiVersion\network\ProtocolConstants;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use function count;

class MultiVersionCommand extends Command{

    private const PREFIX = TextFormat::YELLOW . "[" . TextFormat::GREEN . "Multi" . TextFormat::GOLD . "Version" . TextFormat::YELLOW . "] " . TextFormat::LIGHT_PURPLE;

    public function __construct(){
        parent::__construct("multiversion", "MultiVersion command", null, ["mv"]);
        $this->setPermission("multiversion.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(count($args) === 0) {
            $sender->sendMessage(self::PREFIX . "Usage: /multiversion <player|all>");
            return true;
        }

        switch($args[0]) {
            case "player":
                if(count($args) !== 2) {
                    $sender->sendMessage(self::PREFIX . "Usage: /multiversion player <name>");
                    return true;
                }
                $target = Server::getInstance()->getPlayerExact($args[1]);
                if(!$target instanceof Player) {
                    $sender->sendMessage(self::PREFIX . "Player " . $args[1] . " is not found!");
                    return true;
                }
                $protocol = MultiVersion::getProtocol($target);
                $ver = ProtocolConstants::MINECRAFT_VERSION[$protocol] ?? ("Protocol " . $protocol);
                $sender->sendMessage(self::PREFIX . $target->getName() . " is using version " . $ver . " (Protocol: " . $protocol . " )");
                return true;

            case "all":
                foreach(Server::getInstance()->getOnlinePlayers() as $player) {
                    $protocol = MultiVersion::getProtocol($player);
                    $ver = ProtocolConstants::MINECRAFT_VERSION[$protocol] ?? ("Protocol " . $protocol);
                    $msg = $player->getName() . " [Protocol: " . $protocol . ", Version: " . $ver . "]";
                    $sender->sendMessage(self::PREFIX . $msg);
                }
                return true;

            default:
                $sender->sendMessage(self::PREFIX . "Usage: /multiversion <player|all>");
                return true;
        }
    }
}
