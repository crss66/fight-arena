<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle arena</title>
</head>
<body>
    <div style="text-align: center;">
        <?php if($this->battle->getWinner() == null) { ?>
            <h2>The fight ended in a draw</h2>
        <?php } else { ?>
            <h2>The fight ended. Winner is: <?php echo $this->battle->getWinner()->getName();?></h2>
        <?php } ?>
    </div>
    <br>
    <div style="display: flex;justify-content:center;">
        <div style="margin: 0 20px;">
            <h3><?php echo $this->player_1->getName();?></h3>
            <p>Initial stats</p>
            <?php foreach($this->player_1->getStats() as $slug => $stat) { ?>
                <?php if($slug != 'health') { ?>
                    <p><strong><?php echo $stat->getName() .':';?></strong> <?php echo $stat->getValue();?></p>
                <?php } else { ?>
                    <p><strong><?php echo $stat->getName() .':';?></strong> <?php echo $initial_player_1_health;?></p>
                <?php } ?>
                
            <?php } ?>
        </div>
        <div style="margin: 0 20px;">
            <h3><?php echo $this->player_2->getName();?></h3>
            <p>Initial stats</p>
            <?php foreach($this->player_2->getStats() as $slug => $stat) { ?>
                <?php if($slug != 'health') { ?>
                    <p><strong><?php echo $stat->getName() .':';?></strong> <?php echo $stat->getValue();?></p>
                <?php } else { ?>
                    <p><strong><?php echo $stat->getName() .':';?></strong> <?php echo $initial_player_2_health;?></p>
                <?php } ?>
                
            <?php } ?>
        </div>
    </div>
    <div>
        <?php foreach($this->battle->getRounds() as $index => $round) { 
            $round_data = $round->getData();
            ?>
            <div style="text-align: center;">Round <?php echo $index + 1;?></div>
            <div style="display: flex;justify-content:center; padding:10px; border: 1px solid black;width:fit-content; margin: 0 auto">
                <div style="margin: 0px 20px;">
                    <h3>Atacker data: </h3>
                    <p><?php echo $round_data['atacker']['name'];?></p>
                    <p>Damage done: <?php echo $round_data['atacker']['data']['value'];?></p>
                    <p>Current health: <?php echo $round_data['atacker']['current_health'];?></p>
                    <p>Skills used: <?php foreach($round_data['atacker']['data']['skills_applied'] as $skill) echo $skill->getName() . ' ';?></p>
                </div>
                <div style="margin: 0px 20px;">
                    <h3>Defender data: </h3>
                    <p><?php echo $round_data['defender']['name'];?></p>
                    <p>Damage received: <?php echo $round_data['defender']['data']['value'];?></p>
                    <p>Remaining health: <?php echo $round_data['defender']['current_health'];?></p>
                    <p>Skills used: <?php foreach($round_data['defender']['data']['skills_applied'] as $skill) echo $skill->getName();?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>