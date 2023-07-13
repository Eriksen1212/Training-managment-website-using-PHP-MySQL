CREATE TABLE feedback (
    feedback_id int NOT NULL AUTO_INCREMENT,
    player_id int,
    coach_id int,
    feedback_content varchar(20),
    feedback_date date,
    PRIMARY KEY (feedback_id),
    FOREIGN KEY (player_id) REFERENCES player(player_id),
    FOREIGN KEY (coach_id) REFERENCES coach(coach_id)
)engine=InnoDB;