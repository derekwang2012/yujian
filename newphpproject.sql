-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2013 at 11:50 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newphpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `thisisfive_reply`
--

CREATE TABLE IF NOT EXISTS `thisisfive_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `thisisfive_reply`
--

INSERT INTO `thisisfive_reply` (`id`, `content`, `user_id`, `topic_id`, `create_date`) VALUES
(75, 'test', 3, 6, '2013-03-26 23:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `thisisfive_reply_to_certain_users`
--

CREATE TABLE IF NOT EXISTS `thisisfive_reply_to_certain_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `reply_id` (`reply_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `thisisfive_reply_to_certain_users`
--

INSERT INTO `thisisfive_reply_to_certain_users` (`id`, `topic_id`, `user_id`, `reply_id`, `viewed`) VALUES
(6, 6, 2, 75, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thisisfive_topic`
--

CREATE TABLE IF NOT EXISTS `thisisfive_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tag` varchar(2) NOT NULL,
  `tag_num` tinyint(4) NOT NULL,
  `hits` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `thisisfive_topic`
--

INSERT INTO `thisisfive_topic` (`id`, `topic`, `content`, `tag`, `tag_num`, `hits`, `user_id`, `create_date`) VALUES
(2, '我想看《北京遇上西雅图》', '“败金女”文佳佳（汤唯 饰）曾经是美食杂志编辑，对爱情充满了像电影《西雅图夜未眠》一样的浪漫幻想。而在现实中，为了给自己的孩子一个“美利坚公民”的身份，她不远万里只身来到西雅图的月子中心待产生子。\r\n　　在月子中心，文佳佳炫富的作风引发了房东（金燕玲 饰）和其他孕妇周逸（海清 饰）、陈悦（买红妹 饰）的反感，倍感孤独的她只能向司机郝志Frank（吴秀波 饰）倾诉心声。而看上去木讷老实的“落魄叔”Frank并不是一个平庸的男子，他在中国曾是一位一流的心血管疾病方面的名医。在相处中，Frank的体贴包容渐渐融化着文佳佳的刁蛮任性。当文佳佳的富豪男友突然失踪后，一夜之间变成穷人的文佳佳得到了Frank无微不至的照顾，跟Frank和他的女儿Julie（宋美曼 & 宋美慧 饰）一起生活的这段日子，让文佳佳找到了家的温暖。\r\n　　当经历了变故的文佳佳，生下了孩子，就要结束她在西雅图的颠沛之旅时，她与Frank之间已经产生了微妙的化学变化，这时的她才发现自己真正追求的爱情是什么。离开西雅图并不代表结束，离开是下一次相遇的开始……　　    © 豆瓣 ', '', 0, 70, 2, '2013-03-23 20:15:06'),
(4, '锵锵三人行》开播15周年特别节目', '《锵锵三人行》是凤凰卫视出品的谈话类节目，由主持人窦文涛与两岸三地传媒界之精英名嘴，一起针对每日热门新闻事件进行研究，并各抒己见，但却又不属于追求问题答案的正论，而是俗人闲话，一派多少天下事，尽付笑谈中的豪情，达至融汇信息传播，制造乐趣与辨析事理三大元素于一身的目的。看似"平衡一下"的"滑头话"，其实是窦文涛引导嘉宾发表具个人色彩的大胆言论，营造日常聊天的形态、谈笑风生的气氛，力求轻松、惹笑。', '轻松', 3, 66, 2, '2013-03-24 18:57:37'),
(5, '今天在家歇了一天的代码', '有点困了', '编程', 3, 15, 2, '2013-03-24 23:39:50'),
(6, '我遇见你是最美丽的意外', '遇见一个事物，爱上一个国家，又因此遇见一群有爱的盆友。', '遇见', 10, 208, 2, '2013-03-24 23:44:29'),
(7, '今天完成了提醒功能', '庆祝下', '提醒', 13, 12, 3, '2013-03-26 23:20:45'),
(8, '不错的壁纸', 'http://www.duitang.com/album/730095/', '壁纸', 3, 1, 2, '2013-03-26 23:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `thisisfive_user`
--

CREATE TABLE IF NOT EXISTS `thisisfive_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `thisisfive_user`
--

INSERT INTO `thisisfive_user` (`id`, `username`, `email`, `password`, `create_date`, `image`, `description`) VALUES
(2, '热_巧克力', 'derekxiangwang@live.cn', '1234', '2013-03-24 22:47:27', '1364069304.jpg', 'I am coding my life!!!'),
(3, '晴天的橘子', 'derek@g.com', '1234', '2013-03-26 23:31:44', '1364340704.jpg', '蓝色的天，白色的云');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `thisisfive_reply`
--
ALTER TABLE `thisisfive_reply`
  ADD CONSTRAINT `thisisfive_reply_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `thisisfive_topic` (`id`),
  ADD CONSTRAINT `thisisfive_reply_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `thisisfive_user` (`id`);

--
-- Constraints for table `thisisfive_reply_to_certain_users`
--
ALTER TABLE `thisisfive_reply_to_certain_users`
  ADD CONSTRAINT `thisisfive_reply_to_certain_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `thisisfive_user` (`id`),
  ADD CONSTRAINT `thisisfive_reply_to_certain_users_ibfk_2` FOREIGN KEY (`reply_id`) REFERENCES `thisisfive_reply` (`id`),
  ADD CONSTRAINT `thisisfive_reply_to_certain_users_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `thisisfive_topic` (`id`);

--
-- Constraints for table `thisisfive_topic`
--
ALTER TABLE `thisisfive_topic`
  ADD CONSTRAINT `thisisfive_topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `thisisfive_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
