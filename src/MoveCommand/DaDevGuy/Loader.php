<?php
declare(strict_types=1);

namespace MoveCommand\DaDevGuy;

use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase
{
    public function onEnable(): void
    {
        $this->saveDefaultConfig();
    }

    public function onMove(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $block = $player->getWorld()->getBlock($player->getPosition());
        if ($block->getId() == $this->getConfig()->get("block-id")) {
            $cmd = str_replace("{username}", $name, $this->getConfig()->get("command"));
            Server::getInstance()->dispatchCommand($player, $cmd);
        }
    }
}