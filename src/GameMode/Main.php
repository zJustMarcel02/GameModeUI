<?php
/*
GameModeUI made by 》zJustMarcel02《
*/
namespace GameMode;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "GameModeUI Enable");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "GameModeUI Disable");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "gmui":
                if ($sender->hasPermission("gmui.cmd")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have the permission to execute this command.");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->sendMessage(TextFormat::YELLOW . "Your GameMode is set to: 0!");
            $sender->setGameMode(0);
                break;
                case 1:
            $sender->sendMessage(TextFormat::YELLOW . "Your GameMode is set to: 1!");
            $sender->setGameMode(1);
                break;				
                case 2:
            $sender->setGameMode(3);
            $sender->sendMessage(TextFormat::GRAY . "Your Gamemode set to: §93§7!");
                break; 
                case 3:
            $sender->setFood(20);
            $sender->setHealth(20);
            $sender->sendMessage(TextFormat::YELLOW . "You have been feed!");
		break;	     
                case 4:
            $sender->addTitle(TextFormat::YELLOW . "GameModeUI Closed");
                break;				
            }
            
            
            });
            $form->setTitle("§7-= §l§eGMUI§r §7=-");
			$form->setContent("§o§7GameModeUI By zJustMarcel02");
			$form->addButton("§l§bSurvival\n§r§o§7Tap to change GM", 0);
			$form->addButton("§l§bCreative\n§r§o§7Tap to change GM", 1);
			$form->addButton("§l§bSpectator\n§r§o§7Tap to change GM", 2);
			$form->addButton("§l§6Feed\n§r§o§7Tap for §7Eat and Health", 3);
            $form->addButton("§l§6CLOSE", 4);
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
