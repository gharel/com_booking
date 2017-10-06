DROP TABLE IF EXISTS `#__booking_room`;

CREATE TABLE `#__booking_room` (
  `id`    INT(11)       NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(150)  NOT NULL,
  `space` MEDIUMINT(8)  NOT NULL,
  `price` DECIMAL(8, 2) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 0
  DEFAULT CHARSET = utf8;

INSERT INTO `#__booking_room` (`name`, `space`, `price`) VALUES
  ('Unicorn room', 50, 999.99),
  ('Panda room', 500, 4000),
  ('Poney room', 190, 50.00);

DROP TABLE IF EXISTS `#__booking`;

CREATE TABLE `#__booking` (
  `id`        INT(11)      NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(150) NOT NULL,
  `lastname`  VARCHAR(150) NOT NULL,
  `email`     VARCHAR(100) NOT NULL,
  `phone`     VARCHAR(100) NOT NULL,
  `startDate` DATETIME     NOT NULL,
  `endDate`   DATETIME     NOT NULL,
  `idRoom`    INT(11)      NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idRoom`) REFERENCES `#__booking_room` (`id`)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 0
  DEFAULT CHARSET = utf8;