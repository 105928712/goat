-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 02:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goat_solutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `reference` varchar(10) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skills` int(11) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `reference`, `fullname`, `address`, `email`, `phone`, `skills`, `other`, `status`) VALUES
(1, 'sdev1', 'Joey Manani', '24 Wakefield Street, Hawthorn, VIC 3122', 'joey@JOEYMANANI.COM', '0400000001', 7, 'I make a killer coffee', 'New'),
(2, 'sdev1', 'Sienna Virtuoso', '24 Wakefield Street, Hawthorn, VIC 3122', 'sienna@SIENNAVIRTUOSO.COM', '0400000001', 7, 'I like the colour purple!', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `reference` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `salary` int(11) NOT NULL,
  `report_to` text NOT NULL,
  `responsibilities` text NOT NULL,
  `required_skills` text NOT NULL,
  `preferred_skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`reference`, `name`, `description`, `salary`, `report_to`, `responsibilities`, `required_skills`, `preferred_skills`) VALUES
('clen1', 'Cloud Engineer', 'This position involves designing, implementing, and managing cloud-based infrastructure and services, ensuring efficient data storage, security, and scalability. This role also involves troubleshooting and optimizing cloud systems and applications.\r\n', 105000, 'Senior Cloud Engineer (Level 3 Position)', '<li>Assessing the infrastructure of a company\'s technological systems and making necessary migrations to the cloud</li>\r\n<li>To oversee the working standards of cloud-based systems and improving them when necessary</li>\r\n<li>Establish and correct the configuring of various processes, including computer, network, and security systems</li>\r\n<li>Ensuring all the necessary security issues are managed, including the need to keep company data protected in the cloud</li>', '<li>Proficiency in cloud platforms, primarily Microsoft Azure</li>\r\n<li>Understanding of networking concepts, conventions and technologies.</li>\r\n<li>Knowledge of server administration on operating systems, specifically Windows</li>\r\n<li>Familiarity with database technologies and how to manage them</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in a Cloud Engineering related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Advanced understanding of networking concepts, conventions and technologies</li>'),
('cssp1', 'Cybersecurity Specialist', 'This position involves protecting a company\'s computer system and network from cyber threats by identifying vulnerabilities, implementing security measures, and responding to security incidents. The role also requires the creation, installation, continuous monitoring and maintenance of company security systems.\r\n', 105000, 'Senior Cybersecurity Specialist (Level 3 Position)', '<li>Identifying potential vulnerabilities in software, hardware, networks, and data centers, then assessing the risks associated with those vulnerabilities</li>\r\n<li>The designing, implementation, and maintenance of security systems, including firewalls, intrusion detection systems, and access control measures</li>\r\n<li>Respond to security incidents, such as malware infections, data breaches, and denial-of-service attacks</li>', '<li>Knowledge and understanding of networking, operating systems, security protocols, and security tools.</li>\r\n<li>The ability to analyse data, identify patterns, and make reasonable and logical judgments about security threats</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in a Cybersecurity Specialist related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Knowledge of operating systems other than Windows, such as macOS and Linux</li>\r\n<li>Advanced understanding of network and security software tools</li>'),
('daan1', 'Data Analyst', 'This position involves collecting, analysing, and interpreting data to identify trends, solve problems, and inform company decisions. This role takes our company’s raw data, and works to find ways to make it easier for others to understand, as well as finding trends and making predictions of what might happen in the company’s future. Data Analysts help businesses turn extensive, unorganised collections of information into useful tools to help with company forecasting.\r\n', 85000, 'Senior Data Analyst (Level 3 Position)', '<li>The creation and maintenance of information architecture for data sets, as well as ensuring easy accessibility of the information provided</li>\r\n<li>Making recommendations on how the organisation can best use the data they have collected to their advantage or making suggestions as to what new data they should collect</li>\r\n<li>Looking at how other businesses in our industry are using their data analysis tools</li>\r\n<li>Tying together previously unrelated sets of information so that they are easier to analyse</li>', '<li>Experience with virtualisation technologies such as charts, graphs and plots to represent data</li>\r\n<li>Familiarity with databases and data structures</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in a Data Analysis related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Adept knowledge of Microsoft Excel</li>'),
('itst1', 'IT Support Technician', 'This position involves technical assistance to end-users and other IT professionals within our company, ensuring the smooth functionality of computer systems, networks, and other related technologies. This role also handles troubleshooting, software and hardware installations, and provides ongoing end-user training through remote support, phone, and email.\r\n', 70000, 'Senior IT Support Technician (Level 3 Position)', '<li>Identifying and resolving technical issues with computer hardware, software, and network connectivity through troubleshooting</li>\r\n<li>Establishing new software and hardware, including peripherals like monitors and printers</li>\r\n<li>Assisting and supporting users of our software with technical problems, answering questions, and providing guidance on using software and hardware</li>\r\n<li>Documenting and maintaining records of issues, solutions, and actions taken</li>\r\n<li>Providing training and support to users on software and hardware</li>', '<li>Strong understanding of computer hardware, software, and network concepts</li>\r\n<li>Providing friendly and helpful customer service support to users of our software</li>\r\n<li>Understanding how to troubleshoot and resolve issues remotely through tools like remote desktop software</li>\r\n<li>The ability to adapt to and learn new technologies and software, as well as adapting to differences in users who need assistance</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in an IT Support Technician related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Advanced knowledge of troubleshooting processes and tools used in those processes</li>'),
('neta1', 'Network Administrator', 'This position involves installing, maintaining, and troubleshooting computer networks and systems, as well as ensuring smooth operation and security. These networks and systems are used to house applications, software, and expansive amounts of data. This role also involves the monitoring of changes in a company\'s network, and providing troubleshooting and technical support where problems arise.', 92000, 'Senior Network Administrator (Level 3 Position)', '<li>The installation, configuration, and maintenance of network hardware and software, including routers, switches, firewalls, and servers</li>\r\n<li>The maintenance of accurate documentation of network configurations, procedures, and troubleshooting steps</li>\r\n<li>Implementation and maintenance of security measures to protect the network and systems from unauthorized access and cyber threats</li>\r\n<li>To manage our company\'s inventory by tracking and managing network hardware and software assets</li>\r\n<li>The monitoring of network performance, including identifying possible issues within the network and systems, and the implementation of solutions to improve efficiency</li>\r\n', '<li>Knowledge of operating systems, primarily Windows</li>\r\n<li>Familiarity and understanding of network hardware, including routers, switches, firewalls, and servers</li>\r\n<li>Proficiency in network monitoring and management tools, primarily SolarWinds</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in a Network Administrator related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Knowledge of operating systems other than Windows, such as macOS and Linux</li>\r\n<li>Advanced understanding of network hardware, including routers, switches, firewalls, and servers</li>\r\n<li>Advanced understanding of our company\'s network management tool, SolarWinds</li>'),
('sdev1', 'Software Developer', 'This position requires the designing, building, testing, and maintenance of computer applications and programs. The role also involves translating user and client needs and requirements into functional code, while also identifying and resolving issues. Software Developers also ensure software performance, security, and reliability. ', 90000, 'Senior Software Developer (Level 3 Position)', '<li>To develop efficient and effective software that meets user and clients\' needs</li>\r\n<li>Ensuring that projects are secure with the necessary protections</li>\r\n<li>Maintaining and updating existing software applications</li>\r\n<li>Providing technical support to users and stakeholders</li>\r\n<li>Testing software applications to identify and resolve bugs</li>\r\n<li>Ensures software meets quality standards and performance requirements</li>', '<li>Understanding the conventions within software and specific programming languages, including sorting and searching algorithms, binary, HTTP, interoperability, abstractions and object oriented programming.</li>\r\n<li>Experience with at least TWO of the following languages: JavaScript, HTML/CSS, Python, SQL, Java, C#</li>\r\n<li>Knowledge of software development methodologies including including Agile</li>\r\n<li>Familiarity with databases and data structures</li>\r\n<li>Problem Solving: Understanding how to identify, diagnose, and break down a problem where innovative solutions can be created</li>\r\n<li>Teamwork: The ability to work well in a team for bigger projects</li>\r\n<li>Communication: The ability to effectively communicate with colleagues and management</li>', '<li>Experience working in a Software Development related position:\r\n<ol class=\"no-number\">\r\n<li>3 or more years</li>\r\n<li>2 or more years</li>\r\n<li>1 or more years</li>\r\n</ol>\r\n</li>\r\n<li>Knowledge of all the following coding languages and/or more: JavaScript, HTML/CSS, Python, SQL, Java, and C#</li>');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lockout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `username`, `password`, `failed_attempts`, `lockout_time`) VALUES
(1, 'sienna', '$2y$10$eoolo3PJZb4TJxhH4kLNseK/1n2AIBqVlxEi44wjkiuJVKVUkyHVS', 0, NULL),
(2, 'joey', '$2y$10$6jz..B3D6tbV3uQS2/.2.uoWFnjaV/WMAKC7bCoKn3pmp.wWmqLem', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`reference`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
