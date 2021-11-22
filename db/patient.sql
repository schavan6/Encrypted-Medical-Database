SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ads_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--


CREATE TABLE `patients` (
  `c_id` varchar(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_birth` varchar(100),
  `c_address` varchar(255),
  `dx1` varchar(100) NOT NULL,
  `cdr` varchar(100) NOT NULL,
  `homehobb` varchar(100) NOT NULL,
  `judgement` varchar(100) NOT NULL,
  `memory` varchar(100) NOT NULL,
  `orient` varchar(100) NOT NULL,
  `sumbox` varchar(100) NOT NULL,
  `MR_scanner` varchar(100) NOT NULL,
  `t1w` LONGBLOB,
  `t2w` longblob,
  `t1w_url` varchar(100) NOT NULL,
  `t2w_url` varchar(100) NOT NULL
  )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`c_id`, `c_name`, `c_birth`, `c_address`, `dx1`, `cdr`, `homehobb`, `judgement`,`memory`, `orient`, `sumbox`) VALUES('OAS30001', 'name1', 'birth1', 'address1','Cognitively normal',0,0,0,0,0,0);

--

ALTER TABLE `patients` ADD PRIMARY KEY (`c_id`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
