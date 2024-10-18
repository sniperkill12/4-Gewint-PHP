CREATE TABLE `user_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE latin1_german1_ci DEFAULT NULL,
  `first_name` varchar(20) COLLATE latin1_german1_ci DEFAULT NULL,
  `nickname` varchar(20) COLLATE latin1_german1_ci NOT NULL,
  `email` varchar(40) COLLATE latin1_german1_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(10) COLLATE latin1_german1_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `securitytoken` varchar(255) COLLATE latin1_german1_ci NOT NULL UNIQUE,
  `picture_filepath` varchar(255) COLLATE latin1_german1_ci DEFAULT '../IMG/anonymous.png',
  PRIMARY KEY (`id`)
) 

ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
