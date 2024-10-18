CREATE TABLE `games` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `state_of_game` VARCHAR(42) NOT NULL , 
  `player1` VARCHAR(255) NOT NULL , 
  `player2` VARCHAR(255), 
  `turn` VARCHAR(255) NOT NULL , 
  PRIMARY KEY (`id`)) 
   
ENGINE = InnoDB;
