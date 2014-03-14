--
-- Table structure for table `pvt_messages`
--

CREATE TABLE `pvt_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `$msg_title` text NOT NULL,
  `msg_body` text NOT NULL,
  `date` date NOT NULL,
  `opened` varchar(255) NOT NULL,
  `deleted` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
