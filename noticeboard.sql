-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 08:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noticeboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`) VALUES
(3, 'master', 'master@mail.com', '$2y$10$5jrtXJH9G89nQuHggm6VfuDqMz2RgHMScgNFu7Ea94A/B7nyEWm7O'),
(4, 'maidiebanda', 'maidie@mail.com', '$2y$10$7lATiwRfezLvl7wI81BwMOCnQSnXS3J80ROpx8zhG60HNuhGF5knK');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `seo_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `has_category`
--

CREATE TABLE `has_category` (
  `post` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `category` text NOT NULL,
  `author` text NOT NULL,
  `cover_photo` text NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `category`, `author`, `cover_photo`, `date`, `important`) VALUES
(9, 'Subject: Annual Spring Festival - Save the Date!', 'Dear Students,\r\n\r\nWe are thrilled to announce that our annual Spring Festival will be held on Friday, April 15th, from 2:00 PM to 8:00 PM. The festival will take place in the university quad and will feature live music, food trucks, games, and various activities.\r\n\r\nThis is a fantastic opportunity to come together as a university community, enjoy the vibrant atmosphere, and create lasting memories. We encourage everyone to attend and bring your friends and family along.\r\n\r\nStay tuned for more details, including the complete schedule of performances and participating vendors. We can\'t wait to celebrate with you!\r\n\r\nBest regards,\r\nThe University Events Committee\r\n', 'students', '1', '648ac2bce576a_pexels-mikhail-nilov-9391354.jpg', '2023-06-15 07:50:20', 0),
(10, 'Call for Research Papers - Annual University Research Symposium', 'Dear Faculty and Students,\r\n\r\nWe are pleased to announce our annual University Research Symposium, which will be held on Wednesday, May 10th. This event provides an excellent platform for researchers and scholars across various disciplines to showcase their work.\r\n\r\nWe invite faculty members and students from all departments to submit abstracts for research papers or posters. This is an invaluable opportunity to share your findings, exchange ideas, and contribute to the intellectual discourse within our university community.\r\n\r\nPlease review the submission guidelines and deadlines available on our university website. We look forward to receiving your submissions and hosting a successful Research Symposium.\r\n\r\nKind regards,\r\nThe Symposium Organizing Committee\r\n', 'students', '1', '648ac37f3b30b_dan-dimmock-3mt71MKGjQ0-unsplash.jpg', '2023-06-15 07:53:35', 1),
(11, 'Important Safety Reminder - Campus Emergency Procedures', 'Dear Students, Faculty, and Staff,\r\n\r\nEnsuring the safety and well-being of our university community is our utmost priority. In light of recent events, we want to take this opportunity to remind everyone about the campus emergency procedures.\r\n\r\nPlease familiarize yourself with the evacuation routes, assembly points, and emergency contact numbers provided on the university website. It is crucial to be prepared and aware of the necessary actions to take in case of any emergencies.\r\n\r\nWe encourage all students, faculty, and staff to review these procedures and report any concerns or suspicious activities to the campus security office. Together, we can maintain a safe and secure learning environment.\r\n\r\nThank you for your cooperation.\r\n\r\nSincerely,\r\nThe Campus Safety Committee\r\n', 'general', '1', '648ac8a369947_pexels-monicore-134065.jpg', '2023-06-15 08:15:31', 1),
(12, 'Internship Opportunity - Industry Partnership Program', 'Dear Students,\r\n\r\nWe are excited to announce the launch of our Industry Partnership Program, offering internship opportunities for students across various disciplines. This program aims to provide valuable hands-on experience and foster connections between our university and industry professionals.\r\n\r\nIf you are interested in gaining practical experience in your field of study and developing valuable skills, we encourage you to explore the available internship positions listed on our university website. The application process and eligibility criteria are outlined in detail on the internship portal.\r\n\r\nDon\'t miss this chance to jump-start your career and gain valuable industry exposure. Apply today and take advantage of this exciting opportunity.\r\n\r\nBest regards,\r\nThe Career Services Department', 'students', '1', '648ac8e30b1c4_pexels-anamul-rezwan-1216589.jpg', '2023-06-15 08:16:35', 1),
(13, 'Join a Student Club - Explore Your Passions!', 'Dear Students,\r\n\r\nAre you looking to enhance your university experience, meet new people, and explore your passions? Joining a student club is a fantastic way to do just that!\r\n\r\nWe have a wide range of active student clubs covering various interests, including arts, sports, community service, academic disciplines, and more. These clubs offer opportunities for personal growth, leadership development, and the chance to make a positive impact on campus.\r\n\r\nVisit our university website to explore the list of student clubs and find contact information for each club\'s leadership. Feel free to reach out to them, attend their meetingsand events, and get involved in activities that align with your interests. Joining a student club will not only provide you with a sense of belonging but also enable you to develop new skills and create lifelong friendships.\r\n\r\nTake the first step towards an enriching university experience by joining a student club today. Don\'t miss out on the chance to make the most of your time here and create memories that will last a lifetime.\r\n\r\nBest regards,\r\nThe Student Affairs Office\r\n', 'students', '1', '648ac9357bdba_jaime-lopes-0RDBOAdnbWM-unsplash.jpg', '2023-06-15 08:17:57', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
