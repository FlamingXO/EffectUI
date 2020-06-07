<?php

namespace EffectUI;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\form\Form;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

	public function onCommand(CommandSender $sender, Command $command, $label, array $args): bool{
		switch($command) {
            case "fx":
                if(!$sender instanceof Player) {
                    $sender->sendMessage("This command can only be used in-game!");
                    break;
                }
                if (!isset($args[0])) {
                    $api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
                    if ($api === null || $api->isDisabled()) {
                        break;
                    }

                    #region FORM
                    $form = $api->createCustomForm(function (Player $sender, ?array $result = null) {
                        if ($result === null) {
                            return true;
                        }
                        $name = $sender->getName();
                        var_dump($result);
                        $effect = $result[0];
                        $time = $result[1];
                        $amplifier = $result[2];
                        $hideParticles = $result[3];

                        switch($effect) {

                            case 0:
                                $effect = "absorption";
                                break;
                            case 1:
                                $effect = "blindness";
                                break;
                            case 2:
                                $effect = "fatigue";
                                break;
                            case 3:
                                $effect = "fire_resistance";
                                break;
                            case 4:
                                $effect = "haste";
                                break;
                            case 5:
                                $effect = "healing";
                                break;
                            case 6:
                                $effect = "hunger";
                                 break;
                            case 7:
                                $effect = "invisibility";
                                break;
                            case 8:
                                $effect = "jump_boost";
                                break;
                            case 9:
                                $effect = "levitation";
                                break;
                            case 10:
                                $effect = "mining_fatigue";
                                break;
                            case 11:
                                $effect = "nausea";
                                break;
                            case 12:
                                $effect = "night_vision";
                                break;
                            case 13:
                                $effect = "poison";
                                break;
                            case 14:
                                $effect = "regeneration";
                                break;
                            case 15:
                                $effect = "resistance";
                                break;
                            case 16:
                                $effect = "saturation";
                                break;
                            case 17:
                                $effect = "slowness";
                                break;
                            case 18:
                                $effect = "speed";
                                break;
                            case 19:
                                $effect = "strength";
                                break;
                            case 20:
                                $effect = "water_breathing";
                                break;
                            case 21:
                                $effect = "weakness";
                                break;
                            case 22:
                                $effect = "wither";
                                break;
                        }
                        switch($time) {
                            case 0:
                                $time = "30";
                                break;
                            case 1:
                                $time = "60";
                                break;
                            case 2:
                                $time = "300";
                                break;
                            case 3:
                                $time = "600";
                                break;
                            case 4:
                                $time = "1800";
                                break;
                            case 5:
                                $time = "3600";
                                break;
                        }
                        switch($amplifier) {
                            case 0:
                                $amplifier = "1";
                                break;
                            case 1:
                                $amplifier = "2";
                                break;
                            case 2:
                                $amplifier = "3";
                                break;
                            case 3:
                                $amplifier = "4";
                                break;
                            case 4:
                                $amplifier = "5";
                                break;
                            case 5:
                                $amplifier = "6";
                                break;
                            case 6:
                                $amplifier = "7";
                                break;
                            case 7:
                                $amplifier = "8";
                                break;
                            case 8:
                                $amplifier = "9";
                                break;
                            case 9:
                                $amplifier = "10";
                                break;
                        }
                        switch($hideParticles) {
                            case 0:
                                $hideParticles = "false";
                                break;
                            case 1:
                                $hideParticles = "true";
                        }
                        Server::getInstance()->dispatchCommand($sender, "effect ${name} ${effect} ${time} ${amplifier} ${hideParticles}");
                    });

                    $form->setTitle("Effect UI");
                    $form->addDropDown("Effects", [
                        "Absorption",
                        "Blindness",
                        "Fatigue",
                        "Fire Resistance",
                        "Haste",
                        "Healing",
                        "Hunger",
                        "Invisibility",
                        "Jump Boost",
                        "Levitation",
                        "Mining Fatigue",
                        "Nausea",
                        "Night Vision",
                        "Poison",
                        "Regeneration",
                        "Resistance",
                        "Saturation",
                        "Slowness",
                        "Speed",
                        "Strength",
                        "Water Breathing",
                        "Weakness",
                        "Wither"
                    ]);
                    $form->addStepSlider("Time", ["30s","1m", "5m", "10m", "30m", "1h"]);
                    $form->addStepSlider("Amplifier", ["1","2", "3", "4", "5", "6", "7", "8", "9", "10"]);
                    $form->addToggle("Hide Particles");
                    $form->sendToPlayer($sender);
                    #endregion

                } else {
                    $player =$sender->getServer()->getPlayer($args[0]);
                    if(!$player) {
                        $sender->sendMessage("§cI could not find that player!");
                        return true;
                    }
                    $api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
                    if ($api === null || $api->isDisabled()) {
                        break;
                    }

                    $form = $api->createCustomForm(function (Player $sender, ?array $result = null) use ($args) {
                        if ($result === null) {
                            return true;
                        }
                        $player =$sender->getServer()->getPlayer($args[0]);
                        $name = $player->getName();
                        var_dump($name);
                        $effect = $result[0];
                        $time = $result[1];
                        $amplifier = $result[2];
                        $hideParticles = $result[3];

                        switch($effect) {

                            case 0:
                                $effect = "absorption";
                                break;
                            case 1:
                                $effect = "blindness";
                                break;
                            case 2:
                                $effect = "fatigue";
                                break;
                            case 3:
                                $effect = "fire_resistance";
                                break;
                            case 4:
                                $effect = "haste";
                                break;
                            case 5:
                                $effect = "healing";
                                break;
                            case 6:
                                $effect = "hunger";
                                break;
                            case 7:
                                $effect = "invisibility";
                                break;
                            case 8:
                                $effect = "jump_boost";
                                break;
                            case 9:
                                $effect = "levitation";
                                break;
                            case 10:
                                $effect = "mining_fatigue";
                                break;
                            case 11:
                                $effect = "nausea";
                                break;
                            case 12:
                                $effect = "night_vision";
                                break;
                            case 13:
                                $effect = "poison";
                                break;
                            case 14:
                                $effect = "regeneration";
                                break;
                            case 15:
                                $effect = "resistance";
                                break;
                            case 16:
                                $effect = "saturation";
                                break;
                            case 17:
                                $effect = "slowness";
                                break;
                            case 18:
                                $effect = "speed";
                                break;
                            case 19:
                                $effect = "strength";
                                break;
                            case 20:
                                $effect = "water_breathing";
                                break;
                            case 21:
                                $effect = "weakness";
                                break;
                            case 22:
                                $effect = "wither";
                                break;
                        }
                        switch($time) {
                            case 0:
                                $time = "30";
                                break;
                            case 1:
                                $time = "60";
                                break;
                            case 2:
                                $time = "300";
                                break;
                            case 3:
                                $time = "600";
                                break;
                            case 4:
                                $time = "1800";
                                break;
                            case 5:
                                $time = "3600";
                                break;
                        }
                        switch($amplifier) {
                            case 0:
                                $amplifier = "1";
                                break;
                            case 1:
                                $amplifier = "2";
                                break;
                            case 2:
                                $amplifier = "3";
                                break;
                            case 3:
                                $amplifier = "4";
                                break;
                            case 4:
                                $amplifier = "5";
                                break;
                            case 5:
                                $amplifier = "6";
                                break;
                            case 6:
                                $amplifier = "7";
                                break;
                            case 7:
                                $amplifier = "8";
                                break;
                            case 8:
                                $amplifier = "9";
                                break;
                            case 9:
                                $amplifier = "10";
                                break;
                        }
                        switch($hideParticles) {
                            case 0:
                                $hideParticles = "false";
                                break;
                            case 1:
                                $hideParticles = "true";
                        }
                        Server::getInstance()->dispatchCommand($sender, "effect ${name} ${effect} ${time} ${amplifier} ${hideParticles}");
                    });

                    $form->setTitle("Effect UI");
                    $form->addDropDown("Effects", [
                        "Absorption",
                        "Blindness",
                        "Fatigue",
                        "Fire Resistance",
                        "Haste",
                        "Healing",
                        "Hunger",
                        "Invisibility",
                        "Jump Boost",
                        "Levitation",
                        "Mining Fatigue",
                        "Nausea",
                        "Night Vision",
                        "Poison",
                        "Regeneration",
                        "Resistance",
                        "Saturation",
                        "Slowness",
                        "Speed",
                        "Strength",
                        "Water Breathing",
                        "Weakness",
                        "Wither"
                    ]);
                    $form->addStepSlider("Time", ["30s","1m", "5m", "10m", "30m", "1h"]);
                    $form->addStepSlider("Amplifier", ["1","2", "3", "4", "5", "6", "7", "8", "9", "10"]);
                    $form->addToggle("Hide Particles");
                    $form->sendToPlayer($sender);
                }
            break;
            case "fxinfo":
                $sender->sendMessage("EffectUI by FlamingXO. https://github.com/FlamingXO/EffectUI");
                return true;
		}
		return true;
	}
}
