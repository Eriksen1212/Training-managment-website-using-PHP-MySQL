CREATE TABLE training_schedule ( 
  training_schedule_id int, 
  player_id int, 
  training_content varchar(20), 
  training_date date, 
  ground_id int, 
  PRIMARY KEY (training_schedule_id, player_id, ground_id), 
  FOREIGN KEY (player_id) REFERENCES player(player_id), 
  FOREIGN KEY (ground_id) REFERENCES ground(ground_id) 
) engine=InnoDB;