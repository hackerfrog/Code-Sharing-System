-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 11:53 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `code` text NOT NULL,
  `lang` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privacy` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `title`, `code`, `lang`, `user`, `datetime`, `privacy`) VALUES
(1, 'C Demo', '#include', 5, 1, '2017-11-13 09:47:26', 'pub'),
(5, 'chef', 'code', 19, 2, '2017-11-13 15:01:34', 'pro'),
(6, 'C++ Hello', '#include<iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n	cout<<"Hello World";\r\n    return 0;\r\n}', 6, 2, '2017-11-13 16:09:33', 'pri');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `lang` varchar(128) NOT NULL,
  `script` varchar(1024) NOT NULL,
  `mode` varchar(128) NOT NULL,
  `ext` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `lang`, `script`, `mode`, `ext`) VALUES
(1, 'APL', '<script src="vendor/codemirror/mode/apl/apl.js"></script>', 'text/apl', 'apl'),
(2, 'ASN.1', '<script src="vendor/codemirror/mode/asn.1/asn.1.js"></script>', 'text/x-ttcn-asn', 'asn'),
(3, 'Asterisk Dialplan', '<script src="vendor/codemirror/mode/asterisk/asterisk.js"></script>', 'text/x-asterisk', 'conf'),
(4, 'Brainfuck', '<script src="vendor/codemirror/mode/brainfuck/brainfuck.js"></script>', 'text/x-brainfuck', 'bf'),
(5, 'C', '<script src="vendor/codemirror/mode/clike/clike.js"></script>', 'text/x-csrc', 'c'),
(6, 'C++', '<script src="vendor/codemirror/mode/clike/clike.js"></script>', 'text/x-c++src', 'cpp'),
(7, 'C#', '<script src="vendor/codemirror/mode/clike/clike.js"></script>', 'text/x-csharp', 'cs'),
(8, 'Ceylon', '<script src="vendor/codemirror/mode/clike/clike.js"></script>', 'text/x-ceylon', ''),
(9, 'Clojure', '<script src="vendor/codemirror/mode/clojure/clojure.js"></script>', 'text/x-clojure', ''),
(10, 'Closure Stylesheets', '<script src="vendor/codemirror/mode/css/css.js"></script>', 'text/x-gss', ''),
(11, 'CMake', '<script src="vendor/codemirror/mode/cmake/cmake.js"></script>', 'text/x-cmake', ''),
(12, 'COBOL', '<script src="vendor/codemirror/mode/cobol/cobol.js"></script>', 'text/x-cobol', ''),
(13, 'CoffeeScript', '<script src="vendor/codemirror/mode/coffeescript/coffeescript.js"></script>', 'text/x-coffeescript', ''),
(14, 'Common Lisp', '<script src="vendor/codemirror/mode/commonlisp/commonlisp.js"></script>', 'text/x-common-lisp', ''),
(15, 'Crystal', '<script src="vendor/codemirror/mode/crystal/crystal.js"></script>', 'text/x-crystal', ''),
(16, 'CSS', '<script src="vendor/codemirror/mode/css/css.js"></script>', 'text/x-css', 'css'),
(17, 'Cypher', '<script src="vendor/codemirror/mode/cypher/cypher.js"></script>', 'text/x-cypher-query', ''),
(18, 'Django', '<script src="vendor/codemirror/mode/django/django.js"></script>', 'text/x-django', ''),
(19, 'Java', '<script src="vendor/codemirror/mode/clike/clike.js"></script>', 'text/x-java', 'java'),
(20, 'Javascript', '<script src="vendor/codemirror/mode/javascript/javascript.js"></script>', 'text/javascript', 'js'),
(21, 'PHP', '<script src="vendor/codemirror/mode/php/php.js"></script>', 'text/x-php', 'php'),
(22, 'Perl', '<script src="vendor/codemirror/mode/perl/perl.js"></script>', 'text/x-perl', 'perl'),
(23, 'Ruby', '<script src="vendor/codemirror/mode/ruby/ruby.js"></script>', 'text/x-ruby', 'ruby'),
(24, 'SQL', '<script src="vendor/codemirror/mode/sql/sql.js"></script>', 'text/x-sql', 'sql');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Full Name',
  `doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of Joining',
  `active` tinyint(1) DEFAULT '1' COMMENT '1:active|0:inactive',
  `salt` varchar(32) DEFAULT NULL,
  `settings` varchar(1024) NOT NULL DEFAULT '{"default":1}' COMMENT 'JSON'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `doj`, `active`, `salt`, `settings`) VALUES
(1, 'lsingh4all@gmail.com', 'password', 'Lovepreet Singh', '2017-10-05 11:03:37', 1, 'df0d7c96d671cca1b738b48d78d69303', '{"default":1}'),
(2, 'rochansrivastav2@gmail.com', 'rochan123', 'Rochan Srivastav', '2017-11-13 14:56:47', 1, '39b2c0f741b374f498a88e60db205675', '{"default":1}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
