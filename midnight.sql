-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2014 at 04:40 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `midnight`
--

-- --------------------------------------------------------

--
-- Table structure for table `admingeneraltool_tbl`
--

CREATE TABLE IF NOT EXISTS `admingeneraltool_tbl` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `widgetname` varchar(255) NOT NULL,
  `tools` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `admingeneraltool_tbl`
--

INSERT INTO `admingeneraltool_tbl` (`id`, `username`, `widgetname`, `tools`) VALUES
(1, 'admin', 'User Management', 'yes'),
(2, 'admin', 'Change Password', 'yes'),
(7, 'admin', 'Error Logs', 'yes'),
(8, 'admin', 'Site Settings', 'yes'),
(9, 'admin', 'Manage Tools', 'yes'),
(61, 'admin', 'File Management', 'yes'),
(62, 'admin', 'Email Management', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `adminspecific_tbl`
--

CREATE TABLE IF NOT EXISTS `adminspecific_tbl` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `widgetname` varchar(255) NOT NULL,
  `tools` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `adminspecific_tbl`
--

INSERT INTO `adminspecific_tbl` (`id`, `username`, `widgetname`, `tools`) VALUES
(1, 'admin', 'Error Logs111asdf', 'yes'),
(3, 'admin', 'Change Password', 'yes'),
(4, 'leanne', 'Change Password', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `adminwidget_tbl`
--

CREATE TABLE IF NOT EXISTS `adminwidget_tbl` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `widgetname` varchar(100) NOT NULL,
  `tools` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `adminwidget_tbl`
--

INSERT INTO `adminwidget_tbl` (`id`, `username`, `widgetname`, `tools`) VALUES
(9, 'admin', 'Widgets', 'yes'),
(89, 'admin', 'User Management', 'yes'),
(107, 'admin', 'Flavors', 'yes'),
(108, 'admin', 'Boxes and Packages', 'yes'),
(109, 'admin', 'Comments', 'yes'),
(110, 'admin', 'Website Content', 'yes'),
(111, 'admin', 'Header Images', 'yes'),
(112, 'admin', 'Settings', 'yes'),
(113, 'leanne', 'Widgets', 'no'),
(114, 'leanne', 'Flavors', 'yes'),
(115, 'leanne', 'Boxes and Packages', 'yes'),
(116, 'leanne', 'Comments', 'yes'),
(117, 'leanne', 'Website Content', 'yes'),
(118, 'leanne', 'Header Images', 'yes'),
(119, 'leanne', 'Settings', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE IF NOT EXISTS `boxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flavor_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `active` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flavor_id` (`flavor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `flavor_id`, `size`, `price`, `active`) VALUES
(1, 1, '1/2 lbs.', 50, 'yes'),
(2, 5, '1/2 lbs.', 15, 'yes'),
(3, 1, '1 lbs.', 12, 'yes'),
(4, 2, '1/2 lbs.', 45, 'yes'),
(5, 2, '1 lbs.', 42, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `comment` text,
  `address` varchar(255) DEFAULT NULL,
  `flavor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `address`, `flavor_id`) VALUES
(1, 'Shelly', 'I served EnjoyMint over Christmas and New year and my guests couldn''t stop talking about how cool and decadent it was.', 'Dallas TX', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `cityzip` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lat_long` varchar(255) DEFAULT NULL,
  `direction` text,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `address1`, `address2`, `cityzip`, `phone`, `fax`, `email`, `lat_long`, `direction`, `facebook`, `twitter`) VALUES
(1, '1266 Hidden Ridge', 'APT 3028', 'Irving, Texas 75038', '214-609-2127', 'N/A', 'samtimalsina@gmail.com', 'N/A', 'Use GPS', 'http://facebook.com', 'http://twitter.com');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page`, `title`, `content`, `photo`) VALUES
(1, 'home', 'The Grooviest Fudge On the Planet', 'Get your feet ready for an uncontrollable Happy Dance. In fact, youâ€™d better prepare your whole body from taste buds to toes. Youâ€™re about to experience the grooviest fudge on the planet. Made from only the finest ingredients like bittersweet chocolate, fresh cream, natural cane sugar and organic fruits and nuts, Fudgedelic fudge is impossibly rich, creamy and utterly addictive. This is the fudge youâ€™ve always dreamt about. <br>', 'home-page-photo.jpg'),
(2, 'about', 'How Leanne got her Groove on', 'By day, she works turning out tasty words for clients like Lay''s and Stacy''s Pita Chips. But making people happy by creating culinary delights has always been a passion. Inspired by her husband, John, to follow her dreams, Fudgedelic was born on a long walk in the Texas Sun. (Funny how 100+ degrees can make you see things.) So spread the word and the Fudgedelic-Love!<br>', 'Leanne.jpg'),
(3, 'flavors', 'Where the fudgelic flavors come from and how they become the grooviest.', 'We only use the real farm-fresh milk products... <br>', 'thumbnail.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `daily_hours`
--

CREATE TABLE IF NOT EXISTS `daily_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(50) DEFAULT NULL,
  `fromto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `daily_hours`
--

INSERT INTO `daily_hours` (`id`, `day`, `fromto`) VALUES
(1, 'Sunday', '7AM - 7PM'),
(2, 'Monday', '7AM - 7PM'),
(3, 'Tuesday', '7AM - 7PM'),
(4, 'Wednesday', '7AM - 7PM'),
(5, 'Thursday', '7AM - 7PM'),
(6, 'Friday', '7AM - 7PM'),
(7, 'Saturday', '7AM - 7PM');

-- --------------------------------------------------------

--
-- Table structure for table `flavors`
--

CREATE TABLE IF NOT EXISTS `flavors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_thumb` varchar(255) DEFAULT NULL,
  `img_big` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `flavors`
--

INSERT INTO `flavors` (`id`, `name`, `description`, `img_thumb`, `img_big`) VALUES
(1, 'Enjoy Mint', 'Cool, refreshing and totally sophisticated in a grown-up-Girl-Scout-cookie kind of way.', 'thumbnail.jpg', 'Enjoy-Mint.jpg'),
(2, 'Cherry Bomb', 'Rich bittersweet chocolate studded with tart chewy dried cherries. Itâ€™s the Bomb.', 'cherry-bomb-thumbnail.jpg', 'cherry-bomb.jpg'),
(3, 'Nogalicious', 'Made with real egg nogg and nutmeg this flavor is frothy, creamy and totally Nogalicious.', 'Nosta-thumbnail.jpg', 'nogalicious.jpg'),
(4, 'Mocha Madness', 'Wake up to the possibilities of nirvana morning, noon and night with this espresso infused flavor.', 'mocha-thumbnail.jpg', 'mocha-madness.jpg'),
(5, 'Nuttinâ€™ Better', 'Feeling nuts? Let our crunchy walnuts break up the sanity of rich creamy bittersweet fudge.', 'nut-thumbnail.jpg', 'Enjoy-Mint.jpg'),
(6, 'Not So Plain Jane', 'Melt-in-your-mouth sweetness with just enough edge to keep you coming back for more. The creamy smooth texture of this bittersweet fudge will blow your mind. ', 'jane-thumbnail.jpg', 'not-so-plain-jane.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `instruction` varchar(256) NOT NULL,
  `form_name` varchar(50) NOT NULL,
  `steps` int(11) NOT NULL,
  `submit_type` enum('add','edit') NOT NULL,
  `submit_value` varchar(50) NOT NULL,
  `success_message` varchar(255) DEFAULT NULL,
  `visible` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_id` (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `widget_id`, `title`, `instruction`, `form_name`, `steps`, `submit_type`, `submit_value`, `success_message`, `visible`) VALUES
(2, 3, 'Create Widget', 'Please supply all the fields carefully', 'widgets', 3, 'add', 'Create Widget', 'The Widget has been successfully', 'yes'),
(3, 3, 'Add Form', 'This will create a new form to be used in your widget', 'forms', 1, 'add', 'Create Form', 'The Form has been successfully', 'yes'),
(6, 3, 'Add List', 'This will create a new table to view the data in your widget', 'tables', 1, 'add', 'Create List', 'The List has been successfully', 'yes'),
(8, 3, 'Add Form Elements', 'Add Form Elements', 'form_elements', 1, 'add', 'Add', 'The Form Element has been successfully', 'yes'),
(16, 3, 'Add List Elements', 'Add List Elements', 'table_elements', 1, 'add', 'Add Element', 'The List Element has been successfully', 'yes'),
(93, 94, 'Add a Flavor', 'Add a new Flavor to your website!', 'flavors', 0, 'add', 'Add Flavor', 'Flavor successfully', 'yes'),
(94, 95, 'Add Price', 'Add price and box for a flavor', 'boxes', 0, 'add', 'Add Price', 'The price was successfully', 'yes'),
(95, 95, 'Add Shipping', 'Add Shipping details to be used by the website.', 'shipping', 0, 'add', 'Add Shipping', 'Shipping was successfully', 'yes'),
(96, 96, 'Edit Comment', 'Edit Comment.', 'comments', 0, 'add', 'Add Comment', 'Comment was successfully', 'yes'),
(97, 97, 'Edit Content', 'Edit the content that appears on the website.', 'contents', 0, 'add', 'Edit Content', 'Content was successfully', 'no'),
(98, 98, 'Edit Header Images', 'Edit Header Images', 'header_images', 0, 'add', 'Edit Header', 'Header Image was successfully', 'yes'),
(99, 99, 'Edit Contact Details', 'Edit your contact details', 'contact', 0, 'add', 'Edit Contact', 'Contact Information successfully', 'no'),
(100, 99, 'Opening Hours', 'Change Opening Hours', 'daily_hours', 0, 'add', 'Change', 'Opening Hour', 'no'),
(101, 99, 'Edit Tagline', 'Edit Tagline', 'tagline', 0, 'add', 'Edit', 'Tagline was Successfully', 'no'),
(102, 99, 'Printable Menu', 'Printable Menu', 'printable_menu', 0, 'add', 'Edit', 'The Menu was Successfully', 'no'),
(103, 99, 'Holidays', 'Add Holiday information in the contact page.', 'holidays', 0, 'add', 'Edit', 'Successfully', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `form_elements`
--

CREATE TABLE IF NOT EXISTS `form_elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `type` enum('text','password','textarea','file','hidden','select','date','richtext') NOT NULL,
  `compulsory` enum('yes','no') NOT NULL,
  `name` varchar(50) NOT NULL,
  `instruction` varchar(256) NOT NULL,
  `error_message` varchar(256) NOT NULL DEFAULT 'An error has occured',
  `validation` enum('none','text','image','number','email','website') NOT NULL DEFAULT 'none',
  `step` int(11) NOT NULL,
  `row_name` varchar(256) NOT NULL,
  `options` varchar(256) NOT NULL,
  `table_element_type` varchar(50) NOT NULL,
  `is_editable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=324 ;

--
-- Dumping data for table `form_elements`
--

INSERT INTO `form_elements` (`id`, `form_id`, `label`, `type`, `compulsory`, `name`, `instruction`, `error_message`, `validation`, `step`, `row_name`, `options`, `table_element_type`, `is_editable`) VALUES
(3, 2, 'Widget Name', 'text', 'yes', 'name', 'Please fill in the correct value', 'Widget Name has not been supplied', 'text', 1, '', '', 'VARCHAR', 'yes'),
(4, 2, 'Description', 'textarea', 'yes', 'description', 'Please fill in the correct value', 'Description has not been provided.', 'text', 1, '', '', 'INT', 'yes'),
(5, 2, 'Widget Logo', 'file', 'yes', 'logo', 'Please upload a file for the widget Logo.', 'Please upload a valid image...', 'image', 1, '', '', 'VARCHAR', 'yes'),
(6, 2, 'Type of Widget', 'select', 'yes', 'type', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', 'common,tools', '', 'yes'),
(7, 3, 'Add to this widget', 'select', 'yes', 'widget_id', 'Please fill in the correct value', 'You have not choosed any function', 'none', 1, 'widgets.name', '', 'INT', 'yes'),
(8, 3, 'Title', 'text', 'yes', 'title', 'Please fill in the correct value', 'Please choose a title', 'none', 1, '', '', '', 'yes'),
(9, 3, 'Instruction', 'textarea', 'yes', 'instruction', 'Please fill in the correct value', 'Please write an instruction', 'none', 1, '', '', '', 'yes'),
(10, 3, 'Form Name', 'text', 'yes', 'form_name', 'Please fill in the correct value', 'Form Name is compulsory', 'none', 1, '', '', '', 'yes'),
(11, 3, 'Steps', 'text', 'yes', 'steps', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(12, 3, 'Submit Type', 'select', 'yes', 'submit_type', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', 'add,edit', '', 'yes'),
(13, 3, 'Submit Value', 'text', 'yes', 'submit_value', 'Please fill in the correct value', 'Please write a submit value', 'none', 1, '', '', '', 'yes'),
(14, 8, 'Choose Form', 'select', 'yes', 'form_id', 'Please fill in the correct value', 'Please choose a form first', 'none', 1, 'forms.title', '', '', 'yes'),
(15, 8, 'Label', 'text', 'yes', 'label', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(16, 8, 'Type of Element', 'select', 'yes', 'type', 'Please fill in the correct value', 'Please choose a form element type', 'none', 1, '', 'text,textarea,richtext,password,file,hidden,select,date', '', 'yes'),
(17, 8, 'Is this a compulsory Field?', 'select', 'yes', 'compulsory', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', 'yes,no', '', 'yes'),
(18, 8, 'Name', 'text', 'yes', 'name', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(19, 8, 'Instruction', 'textarea', 'yes', 'instruction', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(20, 8, 'Error Message', 'textarea', 'no', 'error_message', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(21, 8, 'Validation', 'select', 'yes', 'validation', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', 'none,text,email,website,image,price,number', 'ENUM', 'yes'),
(22, 8, 'Steps', 'text', 'no', 'step', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(23, 8, 'Row Name', 'text', 'no', 'row_name', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', '', '', 'yes'),
(26, 8, 'Add Options', 'text', 'no', 'options', 'Please fill in the correct value', 'Some error', 'none', 1, '', '', '', 'yes'),
(27, 6, 'Add to this widget', 'select', 'yes', 'widget_id', 'Please fill in the correct value', 'No widget selected', 'none', 1, 'widgets.name', '', '', 'yes'),
(28, 6, 'Title', 'text', 'yes', 'title', 'Please fill in the correct value', 'Title is not selected', 'none', 1, '', '', '', 'yes'),
(29, 6, 'Description', 'textarea', 'no', 'description', 'Please fill in the correct value', '', 'none', 1, '', '', '', 'yes'),
(30, 6, 'table', 'text', 'yes', 'table_name', 'Please fill in the correct value', 'No table has been selected.', 'none', 1, '', '', '', 'yes'),
(31, 6, 'Do you want the delete Function?', 'select', 'yes', 'delete_yn', 'Please fill in the correct value', '', 'none', 1, '', 'yes,no', '', 'yes'),
(32, 6, 'Do you want the Edit Function?', 'select', 'yes', 'edit_yn', 'Please fill in the correct value', '', 'none', 1, '', 'yes,no', '', 'yes'),
(33, 6, 'Choose the Form to redirect for Editing', 'select', 'no', 'edit_function_id', 'Please fill in the correct value', '', 'none', 1, 'forms.title', '', '', 'yes'),
(34, 16, 'Choose the Table to Add this element to', 'select', 'yes', 'table_id', 'Please fill in the correct value', 'Table has not been choosen', 'none', 1, 'tables.title', '', '', 'yes'),
(36, 16, 'Name of the Row', 'text', 'yes', 'row_name', 'Please fill in the correct value', 'Row Name is compulsory. Data cannot be displayed without it.', 'none', 1, '', '', '', 'yes'),
(44, 3, 'Success Message', 'text', 'no', 'success_message', 'Please fill in the correct value', '', 'none', 1, '', '', '', 'yes'),
(45, 8, 'Table Element Type', 'select', 'yes', 'table_element_type', 'Please fill in the correct value', 'An error has occured', 'none', 1, '', 'INT,VARCHAR(50),VARCHAR(255),TEXT,DATE,ENUM', 'ENUM', 'yes'),
(46, 16, 'View More Link', 'select', 'no', 'view_more_link', 'Please fill in the correct value', '', 'none', 0, 'tables.title', '', 'VARCHAR', 'yes'),
(47, 6, 'Is this List visible by default?', 'select', 'yes', 'visible', 'Please fill in the correct value', '', 'none', 1, '', 'yes,no', 'VARCHAR', 'yes'),
(89, 3, 'Do you want to display this form?', 'select', 'yes', 'visible', 'Please fill in the correct value', '', 'none', 1, '', 'yes,no', 'ENUM', 'yes'),
(118, 16, 'Is this table connected?', 'select', 'yes', 'connected', 'Please fill in the correct value', '', 'none', 0, '', 'yes,no', 'ENUM', 'yes'),
(185, 6, 'Do you need search Function?', 'select', 'yes', 'need_search', 'If you need to be able to have the search function, choose yes...', 'Choose one', 'text', 0, '', 'yes,no', 'VARCHAR(50)', 'yes'),
(186, 8, 'Editable?', 'select', 'yes', 'is_editable', 'If you want this element to be not editable, then choose no', 'error', 'text', 0, '', 'yes,no', 'VARCHAR(50)', 'yes'),
(187, 16, 'Make Searchable?', 'select', 'yes', 'is_searchable', 'If you want the user to be able to make this field searchable, choose yes', 'Error', 'text', 0, '', 'yes,no', 'VARCHAR(50)', 'yes'),
(191, 16, 'Title', 'text', 'yes', 'title', 'please fill in the correct value', 'no value has been entered', 'none', 0, '', '', 'VARCHAR(50)', 'yes'),
(286, 93, 'Name your Flavor', 'text', 'yes', 'name', 'This name appears on the website.', 'A name is compulsory.', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(287, 93, 'Describe your flavor', 'textarea', 'yes', 'description', 'Write a short description about your flavor.', 'A description is compulsory.', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(288, 93, 'Thumbnail Image', 'file', 'yes', 'img_thumb', 'Please upload an image (jpeg, png or gif) with the dimensions 76px x 76px', 'A thumbnail image is compulsory', 'image', 0, '', '', 'VARCHAR(255)', 'yes'),
(289, 93, 'Flavor Image', 'file', 'yes', 'img_big', 'Please upload an image for your flavor. Keep the size no more than 485px (width) and 350px (height)', 'An image is compulsory. Please choose a valid image.', 'image', 0, '', '', 'VARCHAR(255)', 'yes'),
(290, 94, 'Choose Flavors', 'select', 'yes', 'flavor_id', 'Choose the Flavor to begin with.', 'Error', 'text', 0, 'flavors.name', '', 'INT', 'yes'),
(291, 94, 'Box Size/Weight (in lb):', 'text', 'yes', 'size', 'Please input a box size/weight for this package.', 'Not a valid size/weight', 'text', 0, '', '', 'INT', 'yes'),
(292, 94, 'Price', 'text', 'yes', 'price', 'Add a price for this size/weight.', 'A price is compulsory.', 'text', 0, '', '', 'INT', 'yes'),
(293, 94, 'Active?', 'select', 'yes', 'active', 'If you want to hide this from the website now, choose no.', 'error', 'none', 0, '', 'yes,no', 'VARCHAR(50)', 'yes'),
(294, 95, 'Name', 'text', 'yes', 'name', 'This is the name that appears on the dropdown on the shipping types on order page.', 'A shipping name is compulsory', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(295, 95, 'Shipping Cost', 'text', 'yes', 'cost', 'This is the cost for this shipping kind.', 'A cost for shipping is compulsory. If the shipping is free, just put 0 on the price.', 'text', 0, '', '', 'INT', 'yes'),
(296, 96, 'Name:', 'text', 'yes', 'name', 'The name of the person who left the comment', 'The name is compulsory', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(297, 96, 'Comment', 'textarea', 'yes', 'comment', 'The comment left by the person', 'The comment is compulsory', 'text', 0, '', '', 'TEXT', 'yes'),
(298, 96, 'Address', 'text', 'yes', 'address', 'The Address of the person leaving the Comment.', 'The address is compulsory', 'text', 0, 'flavors.name', '', 'VARCHAR(255)', 'yes'),
(299, 96, 'Flavor', 'select', 'yes', 'flavor_id', 'The Flavor for which the comment was made.', 'The flavor is compulsory', 'text', 0, 'flavors.name', '', 'INT', 'yes'),
(300, 97, 'Page', 'text', 'yes', 'page', 'This is the page in which the content appears', 'Error', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(303, 97, 'Title', 'text', 'no', 'title', 'This is the title of the content.', '', 'none', 0, '', '', 'VARCHAR(255)', 'yes'),
(304, 97, 'Content', 'richtext', 'yes', 'content', 'This is the actual content on that page', 'Content is compulsory', 'text', 0, '', '', 'TEXT', 'yes'),
(305, 97, 'Optional Photo', 'file', 'yes', 'photo', 'If you do need to add a photo to the content, please make it no more than 135px x 135px', '', 'image', 0, '', '', 'VARCHAR(255)', 'yes'),
(306, 98, 'Page', 'text', 'yes', 'page', 'This is the page in the website for which you are changing the images.', 'Error', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(307, 98, 'Image', 'file', 'yes', 'image', 'Please upload an image (jpeg, png or gif) roughly 980px (wide) by 410px. Remember to keep the left hand side empty so that the logo can show.', 'Image is compulsory', 'image', 0, '', '', 'VARCHAR(255)', 'yes'),
(308, 99, 'Address 1', 'text', 'yes', 'address1', 'Address 1', 'Address 1 is compulsory', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(309, 99, 'Address 2', 'text', 'no', 'address2', 'Address 2', '', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(310, 99, 'City, State and Zip', 'text', 'yes', 'cityzip', 'Add your City, State and Zip', 'Error', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(311, 99, 'Phone', 'text', 'yes', 'phone', 'Your business phone number', 'Phone number is compulsory', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(312, 99, 'Business Fax', 'text', 'no', 'fax', 'Your Business Fax', '', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(313, 99, 'Email Address', 'text', 'yes', 'email', 'Your Email Address', 'Email is compulsory', 'email', 0, '', '', 'VARCHAR(255)', 'yes'),
(314, 99, 'Location for Google Maps', 'text', 'no', 'lat_long', 'The latitude and longitude of your business address. Here''s a link to visit to know how to get one: <a href="http://support.google.com/maps/bin/answer.py?hl=en&answer=1334236" target="_blank">Link</a>', 'Error', 'none', 0, '', '', 'VARCHAR(255)', 'yes'),
(315, 99, 'Directions', 'textarea', 'no', 'direction', 'You can even write a direction yourself.', '', 'text', 0, '', '', 'TEXT', 'yes'),
(316, 100, 'Day', 'text', 'yes', 'day', 'Day', 'Error', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(317, 100, 'From-To', 'text', 'yes', 'fromto', 'Example: 7AM - 7PM.', 'Error', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(318, 101, 'Tagline', 'text', 'yes', 'message', 'This is the tagline that appears at the footer.', 'The tagline cannot be empty', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(319, 102, 'File', 'text', 'no', 'menu', 'Please upload any kind of file (Image, pdf, Word Document.) Visitors will be able to download this document.', 'Error', 'none', 0, '', '', 'VARCHAR(255)', 'yes'),
(320, 102, 'Date', 'date', 'yes', 'date', 'This is the date the file is uploaded. This way the visitors can know how old the menu is.', 'Error', 'text', 0, '', '', 'VARCHAR(50)', 'yes'),
(321, 103, 'Message', 'richtext', 'no', 'message', 'Write the message to display on the contact page.', 'Error', 'text', 0, '', '', 'VARCHAR(255)', 'yes'),
(322, 99, 'Facebook Link', 'text', 'yes', 'facebook', 'The link to the facebook.', 'Error', 'none', 0, '', '', 'VARCHAR(255)', 'yes'),
(323, 99, 'Twitter', 'text', 'yes', 'twitter', 'The link to your twitter account', 'Error', 'none', 0, '', '', 'VARCHAR(255)', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `header_images`
--

CREATE TABLE IF NOT EXISTS `header_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `header_images`
--

INSERT INTO `header_images` (`id`, `page`, `image`) VALUES
(1, 'home', 'homepage-background.jpg'),
(2, 'about', 'homepage-background.jpg'),
(3, 'flavors', 'homepage-background.jpg'),
(4, 'order', 'homepage-background.jpg'),
(5, 'contact', 'homepage-background.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `message`) VALUES
(1, 'We have a holiday on Martin Luther''s Day.<br>');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE IF NOT EXISTS `login_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','sub-admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '0c9abf94c5aa5ec119c9e051ec5f66ced529f57e7c37e94a85e6351405515fd261904c43fc5022c6b790d2d13cfaf6fda8053c979e975956d18b24facd9b5c6b07e14b3f', 'admin'),
(2, 'leanne', '340767d0d178f15ffe6b291a6ca71ffc482fd2290746fad75f671e447c1dbbf30cb01d6af90f8453baeed5e7c0bab30b7a5833ddd986b8cf5f6b514f053b25ef21906110', 'sub-admin');

-- --------------------------------------------------------

--
-- Table structure for table `printable_menu`
--

CREATE TABLE IF NOT EXISTS `printable_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `printable_menu`
--

INSERT INTO `printable_menu` (`id`, `date`, `menu`) VALUES
(1, '2012-01-15', 'Leanne.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `cost`) VALUES
(1, 'USPS Standard', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `delete_yn` enum('yes','no') NOT NULL,
  `edit_yn` enum('yes','no') NOT NULL,
  `edit_function_id` int(11) NOT NULL,
  `visible` enum('yes','no') DEFAULT NULL,
  `need_search` enum('yes','no') DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `widget_id` (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `widget_id`, `title`, `description`, `table_name`, `delete_yn`, `edit_yn`, `edit_function_id`, `visible`, `need_search`) VALUES
(1, 3, 'View Widgets', 'View all the available widgets in the website', 'widgets', 'yes', 'yes', 2, 'yes', 'yes'),
(10, 3, 'View Forms', 'View Forms', 'forms', 'yes', 'yes', 3, 'no', 'yes'),
(11, 3, 'View Lists', 'Lets you view Lists', 'tables', 'yes', 'yes', 6, 'no', 'yes'),
(24, 3, 'View Form Elements', 'View Form Elements', 'form_elements', 'yes', 'yes', 8, 'no', 'yes'),
(25, 3, 'View List Elements', 'View List Elements', 'table_elements', 'yes', 'yes', 16, 'no', 'yes'),
(78, 94, 'View Flavors', 'View Flavors', 'flavors', 'yes', 'yes', 93, 'yes', 'yes'),
(79, 95, 'View Prices', 'View the Prices and Packages for different flavors.', 'boxes', 'yes', 'yes', 94, 'yes', 'yes'),
(80, 95, 'View Shipping', 'View the Shipping informations.', 'shipping', 'yes', 'yes', 95, 'yes', 'yes'),
(81, 96, 'View Comments', 'View Comments left by visitors', 'comments', 'yes', 'yes', 96, 'yes', 'yes'),
(82, 97, 'View Content', 'View the website content', 'contents', 'no', 'yes', 97, 'yes', 'yes'),
(83, 98, 'View Header Images', 'View Header Images', 'header_images', 'no', 'yes', 98, 'yes', 'yes'),
(84, 99, 'View Contact Details', 'View Contact Details', 'contact', 'no', 'yes', 99, 'yes', 'no'),
(85, 99, 'Opening Hours', 'View Opening Hours', 'daily_hours', 'no', 'yes', 100, 'yes', 'no'),
(86, 99, 'View Tagline', 'View Tagline', 'tagline', 'no', 'yes', 101, 'yes', 'no'),
(87, 99, 'Printable Menu', 'Printable Menu', 'printable_menu', 'no', 'yes', 102, 'yes', 'no'),
(88, 99, 'Holidays', 'Holiday message', 'holidays', 'no', 'yes', 103, 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `table_elements`
--

CREATE TABLE IF NOT EXISTS `table_elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `row_name` varchar(50) NOT NULL,
  `view_more_link` varchar(255) DEFAULT NULL,
  `connected` enum('yes','no') NOT NULL DEFAULT 'yes',
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=282 ;

--
-- Dumping data for table `table_elements`
--

INSERT INTO `table_elements` (`id`, `table_id`, `title`, `row_name`, `view_more_link`, `connected`, `is_searchable`) VALUES
(1, 1, 'Widget', 'name', '', 'yes', 'yes'),
(2, 1, 'Description', 'description', NULL, 'yes', 'yes'),
(3, 1, 'Widget Type', 'type', NULL, 'yes', 'yes'),
(7, 10, 'Form Name', 'title', '', 'yes', 'yes'),
(8, 10, 'Instruction', 'instruction', NULL, 'yes', 'yes'),
(9, 11, 'List Name', 'title', '', 'yes', 'yes'),
(51, 1, 'Forms', '0', '10', 'yes', 'yes'),
(52, 1, 'Lists', '0', '11', 'yes', 'yes'),
(53, 11, 'Description', 'description', '', 'yes', 'yes'),
(54, 10, 'Elements', '0', '24', 'yes', 'yes'),
(55, 11, 'Elements', '0', '25', 'yes', 'yes'),
(56, 24, 'Label', 'label', '', 'yes', 'yes'),
(57, 24, 'Type', 'type', '', 'yes', 'yes'),
(58, 24, 'Compulsory?', 'compulsory', '', 'yes', 'yes'),
(59, 24, 'Validation', 'validation', '', 'yes', 'yes'),
(60, 25, 'Title', 'title', '', 'yes', 'yes'),
(61, 25, 'Row Name', 'row_name', '', 'yes', 'yes'),
(62, 25, 'View More Link', 'view_more_link', '', 'yes', 'yes'),
(163, 25, 'Searchable?', 'is_searchable', '', 'no', 'yes'),
(164, 10, 'Display?', 'visible', '', 'yes', 'no'),
(248, 78, 'name', 'name', '', 'no', 'yes'),
(249, 78, 'Description', 'description', '', 'no', 'yes'),
(250, 78, 'Photo', 'img_big', '', 'no', 'no'),
(251, 78, 'Thumbnail', 'img_thumb', '', 'no', 'no'),
(252, 79, 'Flavor', 'flavors.name.flavor_id', '', 'yes', 'yes'),
(253, 79, 'Size', 'size', '', 'no', 'yes'),
(254, 79, 'Price', 'price', '', 'no', 'yes'),
(255, 79, 'Active?', 'active', '', 'no', 'yes'),
(256, 80, 'Name', 'name', '', 'no', 'yes'),
(257, 80, 'Cost', 'cost', '', 'no', 'yes'),
(261, 78, 'View Packages', '0', '79', 'yes', 'yes'),
(262, 81, 'Flavor Name', 'flavors.name.flavor_id', '', 'no', 'yes'),
(263, 81, 'name', 'name', '', 'no', 'yes'),
(264, 81, 'Address', 'address', '', 'no', 'yes'),
(265, 81, 'Comment', 'comment', '', 'no', 'yes'),
(266, 82, 'Page', 'page', '', 'no', 'yes'),
(267, 82, 'Title of Page', 'title', '', 'no', 'yes'),
(268, 82, 'Content', 'content', '', 'no', 'yes'),
(269, 82, 'Photo', 'photo', '', 'no', 'yes'),
(270, 83, 'Page', 'page', '', 'no', 'yes'),
(271, 83, 'Header Image', 'image', '', 'no', 'no'),
(272, 84, 'Address 1', 'address1', '', 'no', 'yes'),
(273, 84, 'City, State and Zip', 'cityzip', '', 'no', 'yes'),
(274, 84, 'Phone', 'phone', '', 'no', 'yes'),
(275, 84, 'Email', 'email', '', 'no', 'yes'),
(276, 85, 'Day of the week', 'day', '', 'no', 'yes'),
(277, 85, 'From - To', 'fromto', '', 'no', 'yes'),
(278, 86, 'Tagline', 'message', '', 'no', 'yes'),
(279, 87, 'Printable Menu', 'menu', '', 'no', 'yes'),
(280, 87, 'Date', 'date', '', 'no', 'yes'),
(281, 88, 'Holiday Message', 'message', '', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tagline`
--

CREATE TABLE IF NOT EXISTS `tagline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tagline`
--

INSERT INTO `tagline` (`id`, `message`) VALUES
(1, 'Have a Fudgedelic Day!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `grand_amount` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `pay_time` varchar(50) NOT NULL,
  `pay_date` varchar(50) NOT NULL,
  `token_id` varchar(50) NOT NULL,
  `txn_id` varchar(50) NOT NULL,
  `mc_gross` varchar(50) NOT NULL,
  `mc_fee` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `mc_currency` varchar(50) NOT NULL,
  `payer_email` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `notify_version` varchar(50) NOT NULL,
  `date_creation` varchar(50) NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483647 ;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`invoice_id`, `grand_amount`, `payment_method`, `item_id`, `payment_status`, `pay_time`, `pay_date`, `token_id`, `txn_id`, `mc_gross`, `mc_fee`, `tax`, `mc_currency`, `payer_email`, `payment_type`, `notify_version`, `date_creation`) VALUES
(8888, '15.00', 'paypal', '0,5', 'Completed', '01:26:50 PM', '18:01:12', 'EC-58Y85954HT139660B', '7JR30929FP208350G', '15.00', '0.74', '0.00', 'USD', '8H425WSXS72MC', 'instant', '65.1', '2012-01-18T13:27:31Z'),
(123456789, '15.00', 'paypal', '0,5', 'Incomplete', '01:17:07 PM', '18:01:12', '', '', '', '', '', '', '', '', '', ''),
(1234567899, '15.00', 'paypal', '0,5', 'Incomplete', '01:20:24 PM', '18:01:12', '', '', '', '', '', '', '', '', '', ''),
(2147483647, '15.00', 'paypal', '0,5', 'Incomplete', '01:24:43 PM', '18:01:12', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `type` enum('common','specific','tools') NOT NULL,
  `system` enum('default','installed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `description`, `logo`, `type`, `system`) VALUES
(3, 'Widgets', 'View and edit members', 'new_widget.gif', 'common', 'default'),
(50, 'Change Password', 'Change your password', 'Images/password.gif', 'specific', 'default'),
(51, 'Error Logs', 'Error Logs', 'Images/pages.gif', 'tools', 'default'),
(52, 'Site Settings', 'Edit Common Site Settings', 'Images/settings.gif', 'tools', 'default'),
(53, 'Manage Tools', 'Install third party tools from here.', 'Images/settings.gif', 'tools', 'default'),
(63, 'File Management', 'Manage Images and Files in your Server', 'images/users.gif', 'tools', 'default'),
(64, 'Email Management', 'Manage Emails.', 'Images/users.gif', 'tools', 'default'),
(85, 'User Management', 'User Management', 'users.gif', 'tools', 'default'),
(94, 'Flavors', 'Add/Edit Flavors', 'item.gif', 'common', 'default'),
(95, 'Boxes and Packages', 'Add Box, Price etc to Flavors', 'menu.gif', 'common', 'default'),
(96, 'Comments', 'Comments on the Flavors', 'feedback.gif', 'common', 'default'),
(97, 'Website Content', 'Edit Website Content', 'pages.gif', 'common', 'default'),
(98, 'Header Images', 'Edit Header Images', 'gallery.gif', 'common', 'default'),
(99, 'Settings', 'Website Settings', 'settings.gif', 'common', 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
