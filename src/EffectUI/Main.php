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

    private $effectList = [
        "Absorption","Blindness","Fatigue","Fire Resistance","Haste","Healing","Hunger",
        "Invisibility","Jump Boost","Levitation","Mining Fatigue","Nausea","Night Vision",
        "Poison","Regeneration","Resistance","Saturation",
        "Slowness","Speed","Strength","Water Breathing", "Weakness","Wither"
    ];

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
                    $form = new CustomForm(function (Player $sender, $data){
                        if ($data){
                            $time = $data[1];
                            $amplifier = $data[2];
                            $hideParticles = $data[3];

                            Server::getInstance()->dispatchCommand($sender, 
                            "Effect: {$this->effectList[$data[0]]} | Time: {$time} | 
                            Amplifer: {$amplifier} | HideParticles: {$hideParticles}");
                        }// try this
                    });

                    $form->setTitle("Effect UI");
                    $form->addDropDown("Effects", $this->effectList);
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
