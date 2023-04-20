<?php 
require "shared/config.php";
require "shared/functions.php";

$definedBattleCards = [
    // B001- B010
    ["name" => "Sprinter","power" => 0,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "This card has as much |Power| power as unspent |Energy| Energy","description" => "Gotta go fast","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "Henk the Stone" ,"power" => 1,"energy" => 0,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "You are my rock","special" => "","image" => "assets/images/B002.png","type" => "Earth","series" => "Henk"],
    ["name" => "GLaDOS","power" => 2,"energy" => 0,"balance" => 3,"onReveal" => "Afflict all other cards with -1 |Power| power","onGoing" => "","description" => "Neurotoxins go brrrr","special" => "","image" => "assets/images/B003.png","type" => "Electric","series" => ""],
    ["name" => "Easter Chicks", "supportExtraAmount" => 8,"power" => 1,"energy" => 1,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "cluck cluck","special" => "","image" => "","type" => "Water","series" => "revolution"],
    ["name" => "Egg", "amount"=>4,"deck"=> "S","power" => 2,"energy" => 1,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "Fried unborn Chick","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "Forced Parking","power" => 3,"energy" => 1,"balance" => 4,"onReveal" => "pick someones card (blindly) they have to play it (if they have 3 |Energy| Energy left), the cost of that card is now 3","onGoing" => "","description" => "","special" => "","image" => "","type" => "Earth","series" => ""],
    ["name" => "Customization","power" => 2,"energy" => 2,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "Wait, that's illegal?","special" => "","image" => "","type" => "Wind","series" => ""],
    ["name" => "Firefighter","power" => 3,"energy" => 2,"balance" => 1,"onReveal" => "Remove the |Fire| fire type card(s) with the most power.","onGoing" => "","description" => "","special" => "You can play this at any player.","image" => "","type" => "Water","series" => ""],
    ["name" => "Meteorite","power" => 4,"energy" => 2,"balance" => 0,"onReveal" => "Play a rock (B070) at someone else","onGoing" => "","description" => "","special" => "","image" => "","type" => "Fire","series" => ""],
    ["name" => "Softlock","power" => 3,"energy" => 3,"balance" => 0,"onReveal" => "","onGoing" => "","description" => "There is no way back.","special" => "","image" => "","type" => "Wind","series" => ""],
    // B011 - B020
    ["name" => "Inspired Chick","power" => 4,"energy" => 3,"balance" => 1,"onReveal" => "","onGoing" => "","description" => "i am ironcluck","special" => "","image" => "","type" => "Earth","series" => "revolution"],
    ["name" => "You are on cooldown!","power" => 5,"energy" => 3,"balance" => 3,"onReveal" => "","onGoing" => "Players can only play 1 card per turn","description" => "","special" => "","image" => "","type" => "Water","series" => ""],
    ["name" => "", "power" => "4", "energy" => "4", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire"],
    ["name" => "Strategic Fort", "power" => "5", "energy" => "4", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "en... een barbeque sausje?", "type" => "Earth"],
    ["name" => "Hate Comment", "power" => "6", "energy" => "4", "balance" => "3", "onReveal" => "", "onGoing" => "This card has 6 extra |Power| power if it's the only card you have played", "special" => "", "description" => "very anonymous", "type" => "Wind"],
    ["name" => "", "power" => "5", "energy" => "5", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "", "type" => "Water"],  
    ["name" => "Burning Bob", "power" => "6", "energy" => "5", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "This is fine.", "type" => "Fire"],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "3", "onReveal" => "", "onGoing" => "Disable all |onReveal| on reveal effects for everyone", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "Meeple Army", "power" => "12", "energy" => "6", "balance" => "2", "onReveal" => "", "onGoing" => "loses 1 |Power| Power for every |revolution| card", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Easter Chick Army", "power" => "7", "energy" => "6", "balance" => "1", "onReveal" => "", "onGoing" => "", "special" => "", "description" => "We cluck Everywhere", "type" => "Water", "series" => "revolution"],
    // B021 - B030
    ["name" => "Duckter Strange", "power" => "8", "energy" => "6", "balance" => "2", "onReveal" => "Remove all |onGoing| ongoing effects from all cards in everyone's hands", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire", "series" => "GGCU"],
    ["name" => "Big Goober", "power" => "7", "energy" => "7", "balance" => "0", "onReveal" => "Place this card on your head. If it falls off you return it to your hand.", "onGoing" => "", "special" => "", "description" => "this goober really silly", "type" => "Earth", "series" => "Fun"],
    ["name" => "Elmo", "power" => "8", "energy" => "7", "balance" => "1", "onReveal" => "Add 2 Tuna (B100) to your hand", "onGoing" => "All |Water| water type cards have 1 less |Power| power", "special" => "", "description" => "", "type" => "Wind", "series" => "GGCU"],
    ["name" => "Super Soaker", "power" => "10", "energy" => "7", "balance" => "3", "onReveal" => "", "onGoing" => "Dissapears if there is any |Fire| fire type card you played", "special" => "Costs 1 |Energy| less for every |Water| water type card played by you", "description" => "", "type" => "Water", "series" => ""],
    ["name" => "Giftcard", "power" => "7", "energy" => "3", "balance" => "0", "onReveal" => "", "onGoing" => "", "special" => "when played, after battle is over give this card to the player in last place", "description" => "", "type" => "Fire", "series" => "", "deck" => "A"],
    ["name" => "The Killer Bunny", "power" => "8", "energy" => "3", "balance" => "3", "onReveal" => "", "onGoing" => "", "special" => "you can only have a total of 2 cards", "description" => "The guardian beast.", "type" => "Earth", "series" => ""],
    ["name" => "Quirk-Destroying Drug", "power" => "4", "energy" => "2", "balance" => "3", "onReveal" => "", "onGoing" => "Your cards don't have abilities anymore (except this one)", "special" => "", "description" => "", "type" => "Wind", "series" => "GGCU"],
    ["name" => "Tractor Chick", "power" => "5", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "all cards lose their abilities (except this one)", "special" => "", "description" => "Cluck vroom cluck", "type" => "Water", "series" => "revolution"],   
    ["name" => "Failed Experiment", "power" => "5", "energy" => "4", "balance" => "2", "onReveal" => "", "onGoing" => "all cards cost 2 |Energy| Energy", "special" => "", "description" => "Don't cluck with fire cluck", "type" => "Fire", "series" => "revolution"],
    ["name" => "Duck Compress", "power" => "10", "energy" => "4", "balance" => "3", "onReveal" => "choose 1 battlecard from every player's hand (blindly) they will play that card for free", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => "GGCU"],
    // B031 - B040
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "let an opponent choose a card from your hand (blindly) you will play that card for free", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Quack for One", "power" => "2", "energy" => "3", "balance" => "1", "onReveal" => "next card you play will get it's |Power| power doubled", "onGoing" => "", "special" => "", "description" => "", "type" => "Water", "series" => "GGCU"],     
    ["name" => "Confusing traffic", "power" => "4", "energy" => "3", "balance" => "1", "onReveal" => "next card you play will get it's |Power| power and |Energy| Energy doubled", "onGoing" => "", "special" => "", "description" => "Not enough signs", "type" => "Fire", "series" => ""],
    ["name" => "Fire Flower", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all |Fire| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Fire", "series" => "Mushroom"],
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all your |Water| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Electric", "series" => ""],
    ["name" => "Curse","deck" => "S", "power" => "-8", "energy" => "2", "balance" => "1", "onReveal" => "This card moves to the player on the left.", "onGoing" => "", "special" => "", "description" => "The forbidden function", "type" => "Earth", "series" => "Henk"],
    ["name" => "", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "give all your |Wind| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Fire Magic", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your |Fire| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "Electrician Chick", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your |Water| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "Cluck Cluck bzztt", "type" => "Electric", "series" => "revolution"],     
    ["name" => "", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "all your |Earth| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    // B041 - B050
    ["name" => "Fire Tornado", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "You can move one (any) |Fire| fire type card from anywhere to anywhere, this card takes it's place.", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Lava Monster", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your |Fire| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "Blaaarg", "type" => "Fire", "series" => "Mushroom"],
    ["name" => "Electric Ball", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your |Water| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "bzzt", "type" => "Electric", "series" => "Mushroom"],
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your |Earth| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],       
    ["name" => "", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "give all your |Wind| type cards 1 extra |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "DIY Forge", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your |Fire| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "Quacki Kaminari", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your |Water| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "", "type" => "Electric", "series" => "GGCU"],     
    ["name" => "Boulder Mushroom", "power" => "7", "energy" => "5", "balance" => "4", "onReveal" => "", "onGoing" => "all your |Earth| type cards cost 1 less |Energy| Energy", "special" => "", "description" => "", "type" => "Earth", "series" => "Mushroom"],
    ["name" => "Forbidden room", "power" => "5", "energy" => "4", "balance" => "2", "onReveal" => "", "onGoing" => "", "special" => "The next card you play turns into Curse (B036)", "description" => "", "type" => "Wind", "series" => "Henk"],
    ["name" => "Hidden Mcdonalds", "power" => "-1", "energy" => "0", "balance" => "1", "onReveal" => "steal 1 |Energy|energy from all other players (if they have any left)", "onGoing" => "", "special" => "", "description" => "Chicken nuggies hunt", "type" => "Earth", "series" => ""],
    // B051 - B060
    ["name" => "Volcano", "power" => "14", "energy" => "0", "balance" => "3", "onReveal" => "", "onGoing" => "", "special" => "This cards |Energy| Energy cost is the amount of (unplayed) cards you have in your hand", "description" => "", "type" => "Fire", "series" => ""],
    ["name" => "Nuclear Powerplant", "power" => "-1", "energy" => "0", "balance" => "1", "onReveal" => "For every |Electric| type card in the game (played by any player), give this card +2 |Power| power", "onGoing" => "", "special" => "This cards |Energy| Energy cost is the amount of (unplayed) cards you have in your hand", "description" => "", "type" => "Electric", "series" => ""],
    ["name" => "Dwayne", "power" => "3", "energy" => "8", "balance" => "2", "onReveal" => "For every |Earth| type card in the game (played by any player), give this card +1 |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Earth", "series" => ""],
    ["name" => "", "power" => "3", "energy" => "9", "balance" => "1", "onReveal" => "For every |Wind| type card in the game (played by any player), give this card +1 |Power| power", "onGoing" => "", "special" => "", "description" => "", "type" => "Wind", "series" => ""],
    ["name" => "Lloyd", "power" => "-15", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "Has +10 |Power| power for every card of the |Green| Type played (anywhere in the game)", "special" => "", "description" => "", "type" => "Green", "series" => "brick"],
    ["name" => "Dragon", "power" => "1", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "Has +10 |Power| power if Lloyd (B055) is also played (anywhere)", "description" => "", "special" => "", "type" => "Green", "series" => "brick", "image" => ""],
    ["name" => "Golden Mech", "power" => "2", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "Has +10 |Power| power if Lloyd (B055) or Mech Sword (B058) is also played (anywhere)", "description" => "", "special" => "", "type" => "Green", "series" => "brick", "image" => ""],
    ["name" => "Mech Sword", "power" => "3", "energy" => "2", "balance" => "3", "onReveal" => "", "onGoing" => "Has +10 |Power| power if Golden Mech (B057) is also played (anywhere)", "description" => "", "special" => "", "type" => "Electric", "series" => "brick", "image" => ""],
    ["name" => "Hot Potato", "supportExtraAmount" => "4", "power" => "4", "energy" => "2", "balance" => "2", "onReveal" => "This replaces the last card you played.", "onGoing" => "", "description" => "A certain Spud that has entered the system", "special" => "", "type" => "Fire", "series" => "blockgame", "image" => ""],
    ["name" => "Wet chick", "power" => "4", "energy" => "2", "balance" => "2", "onReveal" => "Reactivate everyones |Water| water type cards their |onReveal| on reveal abillities", "onGoing" => "", "description" => "Blub", "special" => "", "type" => "Electric", "series" => "revolution", "image" => ""],
    // B061 - B070
    ["name" => "Toaster", "power" => "5", "energy" => "4", "balance" => "2", "onReveal" => "Give every |Electric| type card in game (played by any player) +2 |Power| power", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Lakitunder", "power" => "4", "energy" => "2", "balance" => "2", "onReveal" => "For your |Electric| type cards, give this card +1 |Power| power", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "Mushroom", "image" => ""],
    ["name" => "Electric Box", "power" => "5", "energy" => "4", "balance" => "2", "onReveal" => "", "onGoing" => "|Electric| Electric type cards cost 1 |Energy| Energy", "description" => "", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "P-switch", "power" => "8", "energy" => "6", "balance" => "4", "onReveal" => "Reactivate all your on reveal abillities", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "Mushroom", "image" => ""],
    ["name" => "Cloning", "power" => "0", "energy" => "3", "balance" => "1", "onReveal" => "", "onGoing" => "", "description" => "", "special" => "This card becomes the last card you played", "type" => "???", "series" => "Mushroom", "image" => ""],
    ["name" => "Tsunami", "power" => "2", "energy" => "4", "balance" => "2", "onReveal" => "Everyone (you too) takes all played cards (except this one) back into their hand (they don't get their |Energy| Energy back)", "onGoing" => "", "description" => "", "special" => "This does not have effect on (B052) Nuclear Powerplant", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Paper airplane", "power" => "-1", "energy" => "0", "balance" => "0", "onReveal" => "", "onGoing" => "", "description" => "BRRRRRR", "special" => "Play this at someone else, they keep this card after this battle is over", "type" => "Wind", "series" => "Fun", "image" => ""],
    ["name" => "Hypnosis", "power" => "8", "energy" => "1", "balance" => "4", "onReveal" => "", "onGoing" => "Someone else (opponent) choses (blindly) what cards you play, all your cards cost 3 |Energy| Energy", "description" => "", "special" => "Needs to be the first or second card you play in a battle, this can't be the last card you play.", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Cardboard airplane", "power" => "-3", "energy" => "1", "balance" => "0", "onReveal" => "", "onGoing" => "", "description" => "", "special" => "Play this at someone else, they keep this card after this battle is over", "type" => "Wind", "series" => "Fun", "image" => ""],
    ["name" => "Rock", "amount"=>"4", "deck" => "S", "power" => "0", "energy" => "1", "balance" => "", "onReveal" => "", "onGoing" => "", "description" => "Dwayne the pebbel johnson", "special" => "", "type" => "Earth", "series" => "GGCU", "image" => ""],
    // B071 - B080
    ["name" => "Bleach", "power" => "3", "energy" => "2", "balance" => "2", "onReveal" => "next card you play has it's effects removed", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Mr Proper", "power" => "4", "energy" => "2", "balance" => "3", "onReveal" => "remove all effects from all cards in everyones hands (yourself too)", "onGoing" => "", "description" => "With multiple tastes", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Black Hole Gun", "power" => "3", "energy" => "3", "balance" => "4", "onReveal" => "change the location to black hole (L013)", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "Question Block", "power" => "1", "energy" => "3", "balance" => "2", "onReveal" => "next card you play has it's |onReveal| on reveal effects doubled", "onGoing" => "", "description" => "", "special" => "", "type" => "Fire", "series" => "Mushroom", "image" => ""],
    ["name" => "Double Cherry", "power" => "2", "energy" => "3", "balance" => "2", "onReveal" => "next card you play has it's |onGoing| ongoing effects doubled", "onGoing" => "", "description" => "", "special" => "", "type" => "Earth", "series" => "Mushroom", "image" => ""],
    ["name" => "Revenge", "power" => "4", "energy" => "5", "balance" => "5", "onReveal" => "", "onGoing" => "after an opponents card effect applies to this card, double the |Power| power of this card", "description" => "", "special" => "", "type" => "Wind", "series" => "revolution", "image" => ""],
    ["name" => "Error", "power" => "4", "energy" => "2", "balance" => "2", "onReveal" => "change the location to 404-NOTFOUND (L010) (nothing happens)", "onGoing" => "", "description" => "", "special" => "", "type" => "ErrorType", "series" => "", "image" => "assets/images/error.png"],
    ["name" => "Nuke launch", "power" => "3", "energy" => "2", "balance" => "3", "onReveal" => "change the location to Nuclear launch (L016) (turns into Nuked world (L017) next turn)", "onGoing" => "", "description" => "", "special" => "", "type" => "Fire", "series" => "", "image" => ""],
    ["name" => "Leaking faucet", "power" => "3", "energy" => "2", "balance" => "2", "onReveal" => "change the location to Flooding (L019)", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "", "image" => ""],
    ["name" => "BBQ Duck","amount"=>"12", "deck"=> "S","power" => "4", "energy" => "3", "balance" => "4", "onReveal" => "", "onGoing" => "when there are more BBQ ducks played (anywhere), double this BBQ duck his |Power| power", "description" => "", "special" => "", "type" => "Water", "series" => "Henk", "image" => ""],
    // B081 - B090
    ["name" => "Vugtman", "power" => "4", "energy" => "2", "balance" => "2", "onReveal" => "give a BBQ duck (B080) to yourself and an opponent of choice", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "Henk", "image" => ""],
    ["name" => "Henk", "power" => "6", "energy" => "3", "balance" => "3", "onReveal" => "give a BBQ duck (B080) to yourself", "onGoing" => "", "description" => "", "special" => "", "type" => "Water", "series" => "Henk", "image" => ""],
    ["name" => "Mirror", "power" => "0", "energy" => "4", "balance" => "1", "onReveal" => "", "onGoing" => "double your total |Power| power ", "description" => "", "special" => "", "type" => "Fire", "series" => "", "image" => ""],
    ["name" => "EMP", "power" => "5", "energy" => "3", "balance" => "2", "onReveal" => "", "onGoing" => "", "description" => "", "special" => "disable all |Electric| type cards their abillities", "type" => "Wind", "series" => "", "image" => ""],
    ["name" => "Harumi", "power" => "2", "energy" => "1", "balance" => "2", "onReveal" => "Invert the effect of |Green| type cards that are already played", "onGoing" => "", "description" => "", "special" => "", "type" => "Wind", "series" => "brick", "image" => ""],
    ["name" => "Sushi nr 3", "power" => "3", "energy" => "2", "balance" => "1", "onReveal" => "add 2 Bread (B087) to your hand", "onGoing" => "", "description" => "", "special" => "", "type" => "Fire", "series" => "GGCU", "image" => ""],
    ["name" => "Bread", "amount"=>"8", "deck" => "S", "power" => "2", "energy" => "1", "balance" => "1", "onReveal" => "", "onGoing" => "", "description" => "Grain", "special" => "", "type" => "Earth", "series" => "blockgame", "image" => ""],
    ["name" => "Grian", "power" => "4", "energy" => "2", "balance" => "3", "onReveal" => "Play an Hot potato (B059) at an opponent of choice.", "onGoing" => "", "description" => "", "special" => "", "type" => "Wind", "series" => "blockgame", "image" => ""],
    ["name" => "Mumbo Jumbo", "power" => "4", "energy" => "2", "balance" => "3", "onReveal" => "Change the location to Hollywood (L008)", "onGoing" => "", "description" => "", "special" => "", "type" => "Wind", "series" => "blockgame", "image" => ""],
    ["name" => "Redstone", "power" => "4", "energy" => "3", "balance" => "1", "onReveal" => "", "onGoing" => "", "description" => "", "special" => "", "type" => "Earth", "series" => "blockgame", "image" => ""],
    // B091 - B100
    ["name" => "14x14 piston door", "power" => "3", "energy" => "3", "balance" => "1", "onReveal" => "", "onGoing" => "Has 7 total |Power| power if redstone is played anywhere this game", "description" => "it's actually quite simple", "special" => "", "type" => "Earth", "series" => "blockgame", "image" => ""],
    ["name" => "2nd dimension", "power" => "3", "energy" => "2", "balance" => "1", "onReveal" => "change this location into another location (choose blindly)", "onGoing" => "", "description" => "", "special" => "", "type" => "Fire", "series" => "", "image" => ""],
    ["name" => "DIO", "power" => "3", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "you won't reveal your cards till the end of the game", "description" => "", "special" => "", "type" => "Fire", "series" => "", "image" => ""],
    ["name" => "Ariana Griande", "power" => "2", "energy" => "2", "balance" => "1", "onReveal" => "", "onGoing" => "", "description" => "Mumbojumbo you are AFK", "special" => "", "type" => "Wind", "series" => "blockgame", "image" => ""],
    ["name" => "0-point", "power" => "1", "energy" => "2", "balance" => "4", "onReveal" => "all cards get their |Power| power set to 1 (if a card had a booster from +1 and loses it after this card, it will subtract the lost booster from 1 |Power| power)", "onGoing" => "", "description" => "", "special" => "", "type" => "Earth", "series" => "", "image" => ""],
    ["name" => "Shortcut", "power" => "10", "energy" => "3", "balance" => "1", "onReveal" => "", "onGoing" => "Has 1 less |Power| power for each |Water| type card played by any player", "description" => "Very safe shortcut", "special" => "", "type" => "Earth", "series" => "", "image" => ""],
    ["name" => "I am lost?", "power" => "2", "energy" => "1", "balance" => "1", "onReveal" => "Every opponent loses 2 |Energy| Energy (if they have any left)", "onGoing" => "", "description" => "I want to go home.", "special" => "", "type" => "Earth", "series" => "", "image" => ""],
    ["name" => "Poultry Man", "power" => "3", "energy" => "1", "balance" => "3", "onReveal" => "give 2 (B004) Easter Chicks cards to yourself and 1 (B005) Egg card to an opponent of choice", "onGoing" => "", "description" => "Poultry man strikes again!", "special" => "", "type" => "Fire", "series" => "revolution blockgame", "image" => ""],
    ["name" => "Pesky Bird", "power" => "2", "energy" => "2", "balance" => "2", "onReveal" => "Give all |blockgame| series cards that you have played 2 extra |Power| power", "onGoing" => "", "description" => "Pesky bird!", "special" => "", "type" => "Wind", "series" => "blockgame", "image" => ""],
    ["name" => "Tuna", "deck"=> "S", "amount"=>"8", "power" => "3", "energy" => "2", "balance" => "2", "onReveal" => "", "onGoing" => "", "description" => "Flop Flop", "special" => "", "type" => "Water", "series" => "GGCU", "image" => ""],
    // B101 - B110
    ["name" => "Gift", "deck"=> "A", "power" => "5", "energy" => "1", "balance" => "0", "onReveal" => "", "onGoing" => "", "description" => "❤ A friendly gift ❤", "special" => "Play this at someone elses.", "type" => "Wind", "series" => "Fun", "image" => ""]
];

$emptyBattleCardModel = [
    "power" => 0,
    "energy" => 0,
    "balance" => 0,
    "onReveal" => "",
    "onGoing" => "",
    "special" => "",
    "type" => "",
    "series" => ""
];

$blacklistedBattlecardKeys = ["id", "image", "name","description", "amount", "supportExtraAmount"];

$possibleBattlecardOptions = [
    "power" => [],
    "energy" => [],
    "balance" => [],
    "onReveal" => [],
    "onGoing" => [],
    "special" => [],
    "type" => [],
    "series" => [],
    "shopCost" => [],
    "deck" => [],
];


function calculateCost($card, $index, $BattleCardConfig) {
    if (isset($card["balance"])) {
        $card["shopCost"] = ((int)$card["balance"] * (int)$BattleCardConfig["CostBalanceMultiplier"]) + (int)$BattleCardConfig["CostAddition"];
        return $card;
    } else {
        return $card;
    }
}

function calculateDeck($card, $index, $BattleCardConfig) {
    if (!isset($card["deck"])) {
        if ((int)$card["balance"] < (int)$BattleCardConfig["DeckMaxBalanceLevel"] && (int)$card["power"] < (int)$BattleCardConfig["DeckMaxPowerLevel"]) {
            $card["deck"] = "A";
        } else {
            $card["deck"] = "B";
        }
        return $card;
    } else {
        return $card;
    }
    return $card;
}

function getImage($card, $index, $BattleCardConfig) {
    if (!isset($card["image"]) || $card["image"] == "") {
        $card["image"] = $BattleCardConfig["defaultImage"];
        return $card;
    } else {
        return $card;
    }
}

function createCard($card, $index, $BattleCardConfig) {
    $card = calculateCost($card, $index, $BattleCardConfig);
    $card = calculateDeck($card, $index, $BattleCardConfig);
    $card = calculateId($card, $index + 1, $BattleCardConfig["id"]);
    if (!isset($card["amount"]) || $card["amount"] == "") {
        $card["amount"] = $BattleCardConfig["defaultAmount"];
    }
    if (!isset($card["name"]) || $card["name"] == "") {
        $card["name"] = $BattleCardConfig["defaultName"];
    }
    if ((!isset($card["image"]) || $card["image"] == "") && file_exists("assets/images/" . $card["id"] . ".png")) {
        $card["image"] = "assets/images/" . $card["id"] . ".png";
    }
    $card = getImage($card, $index, $BattleCardConfig);
    return $card;
}

function getCorrectNumber($cards) {
    if (isset($_GET['doubles']) && strtolower($_GET['doubles']) == "false") {
        return $cards;
    } else {
        $correctList = [];
        foreach($cards as $singleCard) {
            for ($i=0; $i < (int)$singleCard["amount"]; $i++) { 
                array_push($correctList, $singleCard);
            }
            if (isset($singleCard["supportExtraAmount"]) && $singleCard["supportExtraAmount"] != "") {
                for ($i=0; $i < (int)$singleCard["supportExtraAmount"]; $i++) { 
                    $tempCard = $singleCard;
                    $tempCard["deck"] = "S";
                    array_push($correctList, $tempCard);
                }
            }
        }
        return $correctList;
    }
    
}

for ($x = 0; $x < count($definedBattleCards); $x++) {
    $definedBattleCards[$x] = createCard($definedBattleCards[$x], $x, $BattleCardConfig);
}

$possibleBattlecardOptions = getAllOptions($definedBattleCards, $blacklistedBattlecardKeys, $possibleBattlecardOptions);

?>