-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 10:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coldwell`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `role`) VALUES
(1, 33032226, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cell`
--

CREATE TABLE `cell` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `leader` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `worth` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cell`
--

INSERT INTO `cell` (`id`, `cid`, `leader`, `members`, `worth`, `status`, `date`) VALUES
(1, 11111111, 18709309, 6, 9000, 1, '2020-10-14 13:21:43'),
(4, 42016601, 37177191, 6, 0, 1, '0000-00-00 00:00:00'),
(5, 26421440, 13547091, 6, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `currency` varchar(4) NOT NULL,
  `currency_desc` varchar(35) NOT NULL,
  `phone_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `currency`, `currency_desc`, `phone_code`) VALUES
(1, 'Afghanistan', 'AFN\r', 'Afghan afghani', '+93'),
(2, 'Akrotiri and Dhekelia (UK)', 'EUR\r', 'European euro', '+358'),
(3, 'Aland Islands (Finland)', 'EUR\r', 'European euro', '+355\r'),
(4, 'Albania', 'ALL\r', 'Albanian lek', '+213\r'),
(5, 'Algeria', 'DZD\r', 'Algerian dinar', '+1684\r'),
(6, 'American Samoa (USA)', 'USD\r', 'United States dollar', '+376\r'),
(7, 'Andorra', 'EUR\r', 'European euro', '+244\r'),
(8, 'Angola', 'AOA\r', 'Angolan kwanza', '+1264\r'),
(9, 'Anguilla (UK)', 'XCD\r', 'East Caribbean dollar', '+1268\r'),
(10, 'Antigua and Barbuda', 'XCD\r', 'East Caribbean dollar', '+54\r'),
(11, 'Argentina', 'ARS\r', 'Argentine peso', '+374\r'),
(12, 'Armenia', 'AMD\r', 'Armenian dram', '+297\r'),
(13, 'Aruba (Netherlands)', 'AWG\r', 'Aruban florin', '+247\r'),
(14, 'Ascension Island (UK)', 'SHP\r', 'Saint Helena pound', '+61\r'),
(15, 'Australia', 'AUD\r', 'Australian dollar', '+672\r'),
(16, 'Austria', 'EUR\r', 'European euro', '+43\r'),
(17, 'Azerbaijan', 'AZN\r', 'Azerbaijan manat', '+994\r'),
(18, 'Bahamas', 'BSD\r', 'Bahamian dollar', '+1242\r'),
(19, 'Bahrain', 'BHD\r', 'Bahraini dinar', '+973\r'),
(20, 'Bangladesh', 'BDT\r', 'Bangladeshi taka', '+880\r'),
(21, 'Barbados', 'BBD\r', 'Barbadian dollar', '+1246\r'),
(22, 'Belarus', 'BYN\r', 'Belarusian ruble', '+375\r'),
(23, 'Belgium', 'EUR\r', 'European euro', '+32\r'),
(24, 'Belize', 'BZD\r', 'Belize dollar', '+501\r'),
(25, 'Benin', 'XOF\r', 'West African CFA franc', '+229\r'),
(26, 'Bermuda (UK)', 'BMD\r', 'Bermudian dollar', '+1441\r'),
(27, 'Bhutan', 'BTN\r', 'Bhutanese ngultrum', '+975\r'),
(28, 'Bolivia', 'BOB\r', 'Bolivian boliviano', '+591\r'),
(29, 'Bonaire (Netherlands)', 'USD\r', 'United States dollar', '+5997\r'),
(30, 'Bosnia and Herzegovina', 'BAM\r', 'Bosnia and Herzegovina convertible ', '+387\r'),
(31, 'Botswana', 'BWP\r', 'Botswana pula', '+267\r'),
(32, 'Brazil', 'BRL\r', 'Brazilian real', '+55\r'),
(33, 'British Indian Ocean Territory (UK)', 'USD\r', 'United States dollar', '+246\r'),
(34, 'British Virgin Islands (UK)', 'USD\r', 'United States dollar', '+1284\r'),
(35, 'Brunei', 'BND\r', 'Brunei dollar', '+673\r'),
(36, 'Bulgaria', 'BGN\r', 'Bulgarian lev', '+359\r'),
(37, 'Burkina Faso', 'XOF\r', 'West African CFA franc', '+226\r'),
(38, 'Burundi', 'BIF\r', 'Burundi franc', '+257\r'),
(39, 'Cabo Verde', 'CVE\r', 'Cape Verdean escudo', '+855\r'),
(40, 'Cambodia', 'KHR\r', 'Cambodian riel', '+855'),
(41, 'Cameroon', 'XAF\r', 'Central African CFA franc', '+237'),
(42, 'Canada', 'CAD\r', 'Canadian dollar', '+1'),
(43, 'Caribbean Netherlands (Netherlands)', 'USD\r', 'United States dollar', '+599\r'),
(44, 'Cayman Islands (UK)', 'KYD\r', 'Cayman Islands dollar', '+1345\r'),
(45, 'Central African Republic', 'XAF\r', 'Central African CFA franc', '+236\r'),
(46, 'Chad', 'XAF\r', 'Central African CFA franc', '+235\r'),
(47, 'Chatham Islands (New Zealand)', 'NZD\r', 'New Zealand dollar', '+64\r'),
(48, 'Chile', 'CLP\r', 'Chilean peso', '+56\r'),
(49, 'China', 'CNY\r', 'Chinese Yuan Renminbi', '+86\r'),
(50, 'Christmas Island (Australia)', 'AUD\r', 'Australian dollar', '+6189164\r'),
(51, 'Cocos (Keeling) Islands (Australia)', 'AUD\r', 'Australian dollar', '+6189162\r'),
(52, 'Colombia', 'COP\r', 'Colombian peso', '+57\r'),
(53, 'Comoros', 'KMF\r', 'Comorian franc', '+269\r'),
(54, 'Congo', 'XAF\r', 'Central African CFA franc', '+242\r'),
(55, 'Congo, Democratic Republic', 'CDFv', 'Congolese franc', '+243\r'),
(56, 'Cook Islands (New Zealand)', 'USD\r', 'Cook Islands dollar', '+682\r'),
(57, 'Costa Rica', 'CRC\r', 'Costa Rican colon', '+506\r'),
(58, 'Cote d\'Ivoire', 'XOF\r', 'West African CFA franc', '+225\r'),
(59, 'Croatia', 'HRK\r', 'Croatian kuna', '+385\r'),
(60, 'Cuba', 'CUP\r', 'Cuban peso', '+53\r'),
(61, 'Curacao (Netherlands)', 'ANG\r', 'Netherlands Antillean guilder', '+5999\r'),
(62, 'Cyprus', 'EUR\r', 'European euro', '+357\r'),
(63, 'Czech Republic', 'CZK\r', 'Czech koruna', '+420\r'),
(64, 'Denmark', 'DKK\r', 'Danish krone', '+45\r'),
(65, 'Djibouti', 'DJF\r', 'Djiboutian franc', '+253\r'),
(66, 'Dominica', 'XCD\r', 'East Caribbean dollar', '+1767\r'),
(67, 'Dominican Republic', 'DOP\r', 'Dominican peso', '+1849\r'),
(68, 'Ecuador', 'USD\r', 'United States dollar', '+593\r'),
(69, 'Egypt', 'EGP\r', 'Egyptian pound', '+20\r'),
(70, 'El Salvador', 'USD\r', 'United States dollar', '+503\r'),
(71, 'Equatorial Guinea', 'XAF\r', 'Central African CFA franc', '+240\r'),
(72, 'Eritrea', 'ERN\r', 'Eritrean nakfa', '+291\r'),
(73, 'Estonia', 'EUR\r', 'European euro', '+372\r'),
(74, 'Ethiopia', 'ETB\r', 'Ethiopian birr', '+251\r'),
(75, 'Falkland Islands (UK)', 'FKP\r', 'Falkland Islands pound', '+500\r'),
(76, 'Faroe Islands (Denmark)', 'none', 'Faroese krona', '+298\r'),
(77, 'Fiji', 'FJD\r', 'Fijian dollar', '+679\r'),
(78, 'Finland', 'EUR\r', 'European euro', '+358\r'),
(79, 'France', 'EUR\r', 'European euro', '+33\r'),
(80, 'French Guiana (France)', 'EUR\r', 'European euro', '+594\r'),
(81, 'French Polynesia (France)', 'XPF\r', 'CFP franc', '+689\r'),
(82, 'Gabon', 'XAF\r', 'Central African CFA franc', '+241\r'),
(83, 'Gambia', 'GMD\r', 'Gambian dalasi', '+220\r'),
(84, 'Georgia', 'GEL\r', 'Georgian lari', '+995\r'),
(85, 'Germany', 'EUR\r', 'European euro', '+49\r'),
(86, 'Ghana', 'GHS\r', 'Ghanaian cedi', '+233\r'),
(87, 'Gibraltar (UK)', 'GIP\r', 'Gibraltar pound', '+350\r'),
(88, 'Greece', 'EUR\r', 'European euro', '+30\r'),
(89, 'Greenland (Denmark)', 'DKK\r', 'Danish krone', '+299\r'),
(90, 'Grenada	East', 'XCD\r', 'Caribbean dollar', '+1473\r'),
(91, 'Guadeloupe (France)', 'EUR\r', 'European euro', '+590\r'),
(92, 'Guam (USA)', 'USD\r', 'United States dollar', '+1671\r'),
(93, 'Guatemala', 'GTQ\r', 'Guatemalan quetzal', '+502\r'),
(94, 'Guernsey (UK)', 'GGP\r', 'Guernsey Pound', '+44\r'),
(95, 'Guinea', 'GNF\r', 'Guinean franc', '+224\r'),
(96, 'Guinea-Bissau', 'XOF\r', 'West African CFA franc', '+245\r'),
(97, 'Guyana', 'GYD\r', 'Guyanese dollar', '+592\r'),
(98, 'Haiti', 'HTG\r', 'Haitian gourde', '+509\r'),
(99, 'Honduras', 'HNL\r', 'Honduran lempira', '+504\r'),
(100, 'Hong Kong (China)', 'HKD\r', 'Hong Kong dollar', '+852\r'),
(101, 'Hungary', 'HUF\r', 'Hungarian forint', '+36\r'),
(102, 'Iceland', 'ISK\r', 'Icelandic krona', '+354\r'),
(103, 'India', 'INR\r', 'Indian rupee', '+91\r'),
(104, 'Indonesia', 'IDR\r', 'Indonesian rupiah', '+62\r'),
(105, 'Iran', 'IRR\r', 'Iranian rial', '+98\r'),
(106, 'Iraq', 'IQD\r', 'Iraqi dinar', '+964\r'),
(107, 'Ireland', 'EUR\r', 'European euro', '+353\r'),
(108, 'Isle of Man (UK)', 'IMP\r', 'Manx pound', '+44\r'),
(109, 'Israel', 'ILS\r', 'Israeli new shekel', '+972\r'),
(110, 'Italy', 'EUR\r', 'European euro', '+39\r'),
(111, 'Jamaica', 'JMD\r', 'Jamaican dollar', '+1876\r'),
(112, 'Japan', 'JPY\r', 'Japanese yen', '+81\r'),
(113, 'Jersey (UK)', 'JEP\r', 'Jersey pound', '+44\r'),
(114, 'Jordan', 'JOD\r', 'Jordanian dinar', '+962\r'),
(115, 'Kazakhstan', 'KZT\r', 'Kazakhstani tenge', '+7\r'),
(116, 'Kenya', 'KES\r', 'Kenyan shilling', '+254\r'),
(117, 'Kiribati', 'AUD\r', 'Australian dollar', '+686\r'),
(118, 'Kosovo', 'EUR\r', 'European euro', '+381\r'),
(119, 'Kuwait', 'KWD\r', 'Kuwaiti dinar', '+965\r'),
(120, 'Kyrgyzstan', 'KGS\r', 'Kyrgyzstani som', '+996\r'),
(121, 'Laos', 'LAK\r', 'Lao kip', '+856\r'),
(122, 'Latvia', 'EUR\r', 'European euro', '+371\r'),
(123, 'Lebanon', 'LBP\r', 'Lebanese pound', '+961\r'),
(124, 'Lesotho', 'LSL\r', 'Lesotho loti', '+266\r'),
(125, 'Liberia', 'LRD\r', 'Liberian dollar', '+231\r'),
(126, 'Libya', 'LYD\r', 'Libyan dinar', '+218\r'),
(127, 'Liechtenstein', 'CHF\r', 'Swiss franc', '+423\r'),
(128, 'Lithuania', 'EUR\r', 'European euro', '+370\r'),
(129, 'Luxembourg', 'EUR\r', 'European euro', '+352\r'),
(130, 'Macau (China)', 'MOP\r', 'Macanese pataca', '+853\r'),
(131, 'Macedonia (FYROM)', 'MKD\r', 'Macedonian denar', '+389\r'),
(132, 'Madagascar', 'MGA\r', 'Malagasy ariary', '+261\r'),
(133, 'Malawi', 'MWK\r', 'Malawian kwacha', '+265\r'),
(134, 'Malaysia', 'MYR\r', 'Malaysian ringgit', '+60\r'),
(135, 'Maldives', 'MVR\r', 'Maldivian rufiyaa', '+960\r'),
(136, 'Mali', 'XOF\r', 'West African CFA franc', '+223\r'),
(137, 'Malta', 'EUR\r', 'European euro', '+356\r'),
(138, 'Marshall Islands', 'USD\r', 'United States dollar', '+692\r'),
(139, 'Martinique (France)', 'EUR\r', 'European euro', '+596\r'),
(140, 'Mauritania', 'MRU\r', 'Mauritanian ouguiya', '+222\r'),
(141, 'Mauritius', 'MUR\r', 'Mauritian rupee', '+230\r'),
(142, 'Mayotte (France)', 'EUR\r', 'European euro', '+262\r'),
(143, 'Mexico', 'MXN\r', 'Mexican peso', '+52\r'),
(144, 'Micronesia', 'USD\r', 'United States dollar', '+691\r'),
(145, 'Moldova', 'MDL\r', 'Moldovan leu', '+373\r'),
(146, 'Monaco', 'EUR\r', 'European euro', '+377\r'),
(147, 'Mongolia', 'MNT\r', 'Mongolian tugrik', '+976\r'),
(148, 'Montenegro', 'EUR\r', 'European euro', '+382\r'),
(149, 'Montserrat (UK)', 'XCD\r', 'East Caribbean dollar', '+1664\r'),
(150, 'Morocco', 'MAD\r', 'Moroccan dirham', '+212\r'),
(151, 'Mozambique', 'MZN\r', 'Mozambican metical', '+258\r'),
(152, 'Myanmar (Burma)', 'MMK\r', 'Myanmar kyat', '+95\r'),
(153, 'Namibia', 'NAD\r', 'Namibian dollar', '+264\r'),
(154, 'Nauru', 'AUD\r', 'Australian dollar', '+674\r'),
(155, 'Nepal', 'NPR\r', 'Nepalese rupee', '+977\r'),
(156, 'Netherlands', 'EUR\r', 'European euro', '+31\r'),
(157, 'New Caledonia (France)', 'XPF\r', 'CFP franc', '+687\r'),
(158, 'New Zealand', 'NZD\r', 'New Zealand dollar', '+64\r'),
(159, 'Nicaragua', 'NIO\r', 'Nicaraguan cordoba', '+505\r'),
(160, 'Niger', 'XOF\r', 'West African CFA franc', '+227\r'),
(161, 'Nigeria', 'NGN\r', 'Nigerian naira', '+234'),
(162, 'Niue (New Zealand)', 'NZD\r', 'New Zealand dollar', '+683\r'),
(163, 'Norfolk Island (Australia)', 'AUD\r', 'Australian dollar', '+6723\r'),
(164, 'Northern Mariana Islands (USA)', 'USD\r', 'United States dollar', '+1670\r'),
(165, 'North Korea	North', 'KPW\r', 'Korean won', '+850\r'),
(166, 'Norway', 'NOK\r', 'Norwegian krone', '+47\r'),
(167, 'Oman', 'OMR\r', 'Omani rial', '+968\r'),
(168, 'Pakistan', 'PKR\r', 'Pakistani rupee', '+92\r'),
(169, 'Palau', 'USD\r', 'United States dollar', '+680\r'),
(170, 'Palestine', 'ILS\r', 'Israeli new shekel', '+970\r'),
(171, 'Panama', 'USD\r', 'United States dollar', '+507\r'),
(172, 'Papua New Guinea', 'PGK\r', 'Papua New Guinean kina', '+675\r'),
(173, 'Paraguay', 'PYG\r', 'Paraguayan guarani', '+595\r'),
(174, 'Peru', 'PEN\r', 'Peruvian sol', '+51\r'),
(175, 'Philippines', 'PHP\r', 'Philippine peso', '+63\r'),
(176, 'Pitcairn Islands (UK)', 'NZD\r', 'New Zealand dollar', '+64\r'),
(177, 'Poland', 'PLN\r', 'Polish zloty', '+48\r'),
(178, 'Portugal', 'EUR\r', 'European euro', '+351\r'),
(179, 'Puerto Rico (USA)', 'USD\r', 'United States dollar', '+1787\r'),
(180, 'Qatar', 'QAR\r', 'Qatari riyal', '+974\r'),
(181, 'Reunion (France)', 'EUR\r', 'European euro', '+262\r'),
(182, 'Romania', 'RON\r', 'Romanian leu', '+40\r'),
(183, 'Russia', 'RUB\r', 'Russian ruble', '+7\r'),
(184, 'Rwanda', 'RWF\r', 'Rwandan franc', '+250\r'),
(185, 'Saba (Netherlands)', 'USD\r', 'United States dollar', '+5994\r'),
(186, 'Saint Barthelemy (France)', 'EUR\r', 'European euro', '+590\r'),
(187, 'Saint Helena (UK)', 'SHP\r', 'Saint Helena pound', '+290\r'),
(188, 'Saint Kitts and Nevis', 'XCD\r', 'East Caribbean dollar', '+1869\r'),
(189, 'Saint Lucia	East', 'XCD\r', 'Caribbean dollar', '+1758\r'),
(190, 'Saint Martin (France)', 'EUR\r', 'European euro', '+590\r'),
(191, 'Saint Pierre and Miquelon (France)', 'EUR\r', 'European euro', '+508\r'),
(192, 'Saint Vincent and the Grenadines', 'XCD\r', 'East Caribbean dollar', '+1784\r'),
(193, 'Samoa', 'WST\r', 'Samoan tala', '+685\r'),
(194, 'San Marino', 'EUR\r', 'European euro', '+378\r'),
(195, 'Sao Tome and Principe', 'STN\r', 'Sao Tome and Principe dobra', '+239\r'),
(196, 'Saudi Arabia', 'SAR\r', 'Saudi Arabian riyal', '+966\r'),
(197, 'Senegal', 'XOF\r', 'West African CFA franc', '+221\r'),
(198, 'Serbia', 'RSD\r', 'Serbian dinar', '+381\r'),
(199, 'Seychelles', 'SCR\r', 'Seychellois rupee', '+248\r'),
(200, 'Sierra Leone', 'SLL\r', 'Sierra Leonean leone', '+232\r'),
(201, 'Singapore', 'SGD\r', 'Singapore dollar', '+65\r'),
(202, 'Sint Eustatius (Netherlands)', 'USD\r', 'United States dollar', '+5993\r'),
(203, 'Sint Maarten (Netherlands)', 'ANG\r', 'Netherlands Antillean guilder', '+1721\r'),
(204, 'Slovakia', 'EUR\r', 'European euro', '+421\r'),
(205, 'Slovenia', 'EUR\r', 'European euro', '+386\r'),
(206, 'Solomon Islands', 'SBD\r', 'Solomon Islands dollar', '+677\r'),
(207, 'Somalia', 'SOS\r', 'Somali shilling', '+252\r'),
(208, 'South Africa', 'ZAR\r', 'South African rand', '+27\r'),
(209, 'South Georgia Island (UK)', 'GBP\r', 'Pound sterling', '+500\r'),
(210, 'South Korea', 'KRW\r', 'South Korean won', '+82\r'),
(211, 'South Sudan', 'SSP\r', 'South Sudanese pound', '+211\r'),
(212, 'Spain', 'EUR\r', 'European euro', '+34\r'),
(213, 'Sri Lanka', 'LKR\r', 'Sri Lankan rupee', '+94\r'),
(214, 'Sudan', 'SDG\r', 'Sudanese pound', '+249\r'),
(215, 'Suriname', 'SRD\r', 'Surinamese dollar', '+597\r'),
(216, 'Svalbard and Jan Mayen (Norway)', 'NOK\r', 'Norwegian krone', '+4779\r'),
(217, 'Swaziland', 'SZL\r', 'Swazi lilangeni', '+268\r'),
(218, 'Sweden', 'SEK\r', 'Swedish krona', '+46\r'),
(219, 'Switzerland', 'CHF\r', 'Swiss franc', '+41\r'),
(220, 'Syria', 'SYP\r', 'Syrian pound', '+963\r'),
(221, 'Taiwan', 'TWD\r', 'New Taiwan dollar', '+886\r'),
(222, 'Tajikistan', 'TJS\r', 'Tajikistani somoni', '+992\r'),
(223, 'Tanzania', 'TZS\r', 'Tanzanian shilling', '+255\r'),
(224, 'Thailand', 'THB\r', 'Thai baht', '+66\r'),
(225, 'Timor-Leste', 'USD\r', 'United States dollar', '+670\r'),
(226, 'Togo', 'XOF\r', 'West African CFA franc', '+228\r'),
(227, 'Tokelau (New Zealand)', 'NZD\r', 'New Zealand dollar', '+690\r'),
(228, 'Tonga', 'TOP\r', 'Tongan paâ€™anga', '+676\r'),
(229, 'Trinidad and Tobago', 'TTD\r', 'Trinidad and Tobago dollar', '+1868\r'),
(230, 'Tristan da Cunha (UK)', 'GBP\r', 'Pound sterling', '+2908\r'),
(231, 'Tunisia', 'TND\r', 'Tunisian dinar', '+216\r'),
(232, 'Turkey', 'TRY\r', 'Turkish lira', '+90\r'),
(233, 'Turkmenistan', 'TMT\r', 'Turkmen manat', '+993\r'),
(234, 'Turks and Caicos Islands (UK)', 'USD\r', 'United States dollar', '+1649\r'),
(235, 'Tuvalu', 'AUD\r', 'Australian dollar', '+688\r'),
(236, 'Uganda', 'UGX\r', 'Ugandan shilling', '+256\r'),
(237, 'Ukraine', 'UAH\r', 'Ukrainian hryvnia', '+380\r'),
(238, 'United Arab Emirates', 'AED\r', 'UAE dirham', '+971\r'),
(239, 'United Kingdom', 'GBP\r', 'Pound sterling', '+44\r'),
(240, 'United States of America', 'USD\r', 'United States dollar', '+1\r'),
(241, 'Uruguay', 'UYU\r', 'Uruguayan peso', '+598\r'),
(242, 'US Virgin Islands (USA)', 'USD\r', 'United States dollar', '+1340\r'),
(243, 'Uzbekistan', 'UZS\r', 'Uzbekistani som', '+998\r'),
(244, 'Vanuatu', 'VUV\r', 'Vanuatu vatu', '+678\r'),
(245, 'Vatican City (Holy See)', 'EUR\r', 'European euro', '+379\r'),
(246, 'Venezuela', 'VEF\r', 'Venezuelan bolivar', '+58\r'),
(247, 'Vietnam', 'VND\r', 'Vietnamese dong', '+84\r'),
(248, 'Wake Island (USA)', 'USD\r', 'United States dollar', '+808\r'),
(249, 'Wallis and Futuna (France)', 'XPF\r', 'CFP franc', '+681\r'),
(250, 'Yemen', 'YER\r', 'Yemeni rial', '+967\r'),
(251, 'Zambia', 'ZMW\r', 'Zambian kwacha', '+260\r'),
(252, 'Zimbabwe', 'USD', 'United States dollar', '+263');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `profit` double NOT NULL,
  `duration` int(5) NOT NULL,
  `status` int(1) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `uid`, `plan`, `type`, `amount`, `profit`, `duration`, `status`, `start`, `end`) VALUES
(1, 18709309, 2, 'forex', 1000, 122.5, 175, 0, '2020-10-12 17:33:53', '2021-04-11 17:33:53'),
(2, 97639973, 2, 'forex', 1000, 122.5, 175, 0, '2020-10-13 13:30:33', '2021-04-12 13:30:33'),
(3, 74484591, 2, 'forex', 1200, 147, 175, 0, '2020-10-13 13:32:25', '2021-04-12 13:32:25'),
(4, 84589301, 1, 'forex', 590, 61.95, 115, 0, '2020-10-13 13:37:09', '2021-02-11 13:37:09'),
(5, 27536349, 2, 'forex', 1500, 183.75, 175, 0, '2020-10-13 14:13:43', '2021-04-12 14:13:43'),
(6, 81892903, 2, 'forex', 1250, 153.125, 175, 0, '2020-10-13 14:25:30', '2021-04-12 14:25:30'),
(7, 51646592, 1, 'forex', 580, 60.9, 115, 0, '2020-10-13 14:27:48', '2021-02-11 14:27:48'),
(8, 37177191, 2, 'forex', 3500, 428.75, 175, 0, '2020-10-13 14:28:41', '2021-04-12 14:28:41'),
(9, 13547091, 2, 'forex', 3200, 392, 175, 0, '2020-10-13 16:12:08', '2021-04-12 16:12:08'),
(10, 21177842, 2, 'forex', 1000, 122.5, 175, 0, '2020-10-13 16:16:51', '2021-04-12 16:16:51'),
(11, 22639973, 2, 'forex', 2500, 306.25, 175, 0, '2020-10-13 16:24:22', '2021-04-12 16:24:22'),
(17, 97870551, 2, 'forex', 1400, 171.5, 175, 0, '2020-10-13 23:13:42', '2021-04-12 23:13:42'),
(18, 18709309, 2, 'forex', 2430, 297.675, 175, 0, '2020-10-13 23:17:55', '2021-04-12 23:17:55'),
(19, 18709309, 1, 'forex', 100, 10.5, 115, 0, '2020-10-13 23:19:18', '2021-02-11 23:19:18'),
(20, 53298611, 2, 'forex', 1600, 56, 179, 0, '2020-10-14 02:24:56', '2021-04-13 02:24:56'),
(21, 30292426, 2, 'forex', 1000, 35, 179, 0, '2020-10-14 02:25:47', '2021-04-13 02:25:47'),
(22, 67784288, 2, 'forex', 1800, 63, 179, 0, '2020-10-14 02:27:08', '2021-04-13 02:27:08'),
(23, 91172960, 2, 'forex', 2500, 87.5, 179, 0, '2020-10-14 02:28:25', '2021-04-13 02:28:25'),
(24, 13327365, 2, 'forex', 5000, 175, 179, 0, '2020-10-14 02:30:26', '2021-04-13 02:30:26'),
(25, 81608072, 2, 'forex', 3000, 105, 179, 0, '2020-10-14 02:32:06', '2021-04-13 02:32:06'),
(26, 35058593, 2, 'forex', 2000, 70, 179, 0, '2020-10-14 13:11:20', '2021-04-13 13:11:20'),
(27, 30533854, 2, 'forex', 3500, 122.5, 179, 0, '2020-10-14 13:13:37', '2021-04-13 13:13:37'),
(28, 52403428, 2, 'forex', 1000, 35, 179, 0, '2020-10-14 13:19:53', '2021-04-13 13:19:53'),
(29, 93307834, 2, 'forex', 2500, 87.5, 179, 0, '2020-10-14 13:21:42', '2021-04-13 13:21:42'),
(30, 37177191, 1, 'forex', 580, 17.4, 119, 0, '2020-10-14 16:06:25', '2021-02-12 16:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start` double NOT NULL,
  `target` double NOT NULL,
  `reward` double NOT NULL,
  `coordinator` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `start`, `target`, `reward`, `coordinator`) VALUES
(1, 'Investor', 1, 20000, 2000, 1),
(2, 'Leader', 20001, 100000, 20000, 1),
(3, 'Mentor', 100001, 250000, 50000, 1),
(4, 'Legend', 250001, 1000000, 200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'site_title', 'Coldwell Investment'),
(2, 'site_email', 'support@coldwellinvestment.com'),
(3, 'alfcoin_sk', '556613223b5f8d8939118cd2d1dfef70'),
(4, 'alfcoin_shop_name', 'Cryptocurrency Payment'),
(5, 'alfcoin_shop_password', 'C81E728D9D4C2F636F067F89CC14862C'),
(6, 'cell_members', '12'),
(7, 'cell_leader_comm', '4'),
(8, 'cell_members_comm', '2'),
(9, 'referral1', '5'),
(10, 'referral2', '3'),
(11, 'referral3', '1.5'),
(12, 'reinvest_comm', '5'),
(13, 'roi_threshold', '10'),
(14, 'referral_threshold', '20'),
(15, 'group_threshold', '30'),
(16, 'reinvest_threshold', '50'),
(17, 'coordinator_comm', '2.5'),
(18, 'coordinator_threshold', '100'),
(19, 'site_url', 'coldwellinvestment.com'),
(20, 'btc_address', '1NAwNogPNeu8AXS2Sm1MbZcQ9GLbZv9z7z'),
(21, 'usdt_address', '1NAwNogPNeu8AXS2Sm1MbZcQ9GLbZv9z7z'),
(22, 'eth_address', '1NAwNogPNeu8AXS2Sm1MbZcQ9GLbZv9z7z'),
(23, 'site_abv', 'INV'),
(24, 'cert_no', '13103856'),
(25, 'cert_link', 'https://beta.companieshouse.gov.uk/company/13103856'),
(26, 'cert_date', ' 30th December 2020'),
(27, 'site_address', '9 Howard Road, Howard Road, Ilford, England, IG1 2EX'),
(28, 'site_tagline', 'Empowering Growth, Enriching Futures'),
(29, 'site_phone', '+44 453 546 2553');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `pic_url` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abv` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `pic_url`, `name`, `abv`) VALUES
(1, 'assets/img/if_Bitcoin_2745023.png', 'Bitcoin', 'BTC'),
(2, 'assets/img/if_etherium_eth_ethcoin_crypto_2844386.png', 'Etherium', 'ETH'),
(3, 'assets/img/if_dash_dashcoin_2844383.png', 'Dash', 'DASH'),
(4, 'assets/img/if_ripple_xrp_coin_2844396.png', 'Ripple', 'XRP'),
(5, 'assets/img/if_litecion_ltc_lite_coin_crypto_2844390.png', 'Litcoin', 'LTC');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roi` double NOT NULL,
  `min_amt` double NOT NULL,
  `max_amt` double NOT NULL,
  `type` varchar(10) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `cashout` double NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `fid`, `name`, `roi`, `min_amt`, `max_amt`, `type`, `short_desc`, `description`, `duration`, `cashout`, `status`) VALUES
(1, 0, 'Bronze', 1.5, 20, 999, 'forex', 'Best for beginners in crypto investment', 'Min. $20 - $999 Max.', 7, 100, 1),
(2, 0, 'Silver', 1.75, 1000, 9999, 'forex', 'Best for intermediates in crypto investment', 'Min. $1,000 - $9,999 Max.', 7, 100, 1),
(3, 0, 'Gold', 2, 10000, 49999, 'forex', 'Best for experts in crypto investment', 'Min. $10,000 - $49,999 Max.', 30, 100, 1),
(4, 0, 'Diamond', 2.2, 50000, 100000, 'forex', 'Best for veterans in crypto investment', 'Min. $50,000 - $100,000 Max.', 30, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_auth`
--

INSERT INTO `user_auth` (`id`, `uid`, `auth`, `type`, `date`) VALUES
(1, 33032226, 'cf708fc1decf0337aded484f8f4519ae', 'email_verify', '2020-08-08 21:11:05'),
(2, 18709309, '3a24b25a7b092a252166a1641ae953e7', 'email_verify', '2020-08-09 08:43:07'),
(3, 97639973, 'fbfe5ba2ce3309f522c335e949435612', 'email_verify', '2020-10-13 02:07:00'),
(4, 74484591, '7da18d0326a9f46a4817e19c805819ae', 'email_verify', '2020-10-13 02:18:18'),
(5, 84589301, '4d0505284ac5049b4167eb7ebfe0791b', 'email_verify', '2020-10-13 02:20:38'),
(6, 27536349, 'acf922154627f6788918f03c42b123cd', 'email_verify', '2020-10-13 02:28:48'),
(7, 81892903, 'd5438e589313fc0036bbc291299c6fd4', 'email_verify', '2020-10-13 12:03:00'),
(8, 51646592, 'c400db3363b99ee026bc9ed0741b79df', 'email_verify', '2020-10-13 12:14:46'),
(9, 37177191, '43a2348027cdb8d216f4fb15fd9e1e4f', 'email_verify', '2020-10-13 12:24:56'),
(10, 13547091, 'f7fbc4bafcc80cbf690acbef25f2ce1c', 'email_verify', '2020-10-13 15:10:53'),
(11, 21177842, '7b1ce3d73b70f1a7246e7b76a35fb552', 'email_verify', '2020-10-13 15:15:42'),
(12, 22639973, '148d411aeffed8a6f6ad4ecd77d1f904', 'email_verify', '2020-10-13 15:19:13'),
(13, 97870551, 'c47e93742387750baba2e238558fa12d', 'email_verify', '2020-10-13 16:04:13'),
(14, 53298611, '0070d23b06b1486a538c0eaa45dd167a', 'email_verify', '2020-10-14 00:52:33'),
(15, 30292426, '2ea19e760aeeeeeb813a2406d0d31a25', 'email_verify', '2020-10-14 00:54:21'),
(16, 67784288, 'e3f3064ac424a80e0abec999e9ac6d17', 'email_verify', '2020-10-14 00:55:25'),
(17, 91172960, '34ad9bc83e3c72c62281cb2c744ac966', 'email_verify', '2020-10-14 00:56:58'),
(18, 13327365, '2fa6cb0776995363c2a2ae7d57ac3845', 'email_verify', '2020-10-14 01:00:12'),
(19, 81608072, '72007983849f4fcb0ad565439834756b', 'email_verify', '2020-10-14 01:03:45'),
(20, 30533854, 'c3810d4a9513b028fc0f2a83cb6d7b50', 'email_verify', '2020-10-14 01:11:41'),
(21, 35058593, '91e50fe1e39af2869d3336eaaeebdb43', 'email_verify', '2020-10-14 11:48:40'),
(22, 52403428, '9cac2ca53c5fe723c249d012d6091c50', 'email_verify', '2020-10-14 11:52:01'),
(23, 93307834, 'c061abe12b79ffb077e88ecf5e4bcf01', 'email_verify', '2020-10-14 11:55:52'),
(24, 81303157, '89ae0fe22c47d374bc9350ef99e01685', 'email_verify', '2022-08-10 12:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_bonus`
--

CREATE TABLE `user_bonus` (
  `id` double NOT NULL,
  `creditor` int(11) NOT NULL,
  `debitor` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `ref` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_bonus`
--

INSERT INTO `user_bonus` (`id`, `creditor`, `debitor`, `amount`, `type`, `ref`, `status`, `date`) VALUES
(1, 18709309, 0, 50, 'Referral', 'EK1162904432EK', 1, '2020-10-13 12:30:34'),
(2, 18709309, 0, 15, 'Referral', 'RN1339268125RN', 1, '2020-10-13 12:30:34'),
(3, 18709309, 0, 25, 'Coordinator', 'VB1394437090VB', 1, '2020-10-13 12:30:34'),
(4, 18709309, 0, 60, 'Referral', 'LU1278214593LU', 1, '2020-10-13 12:32:25'),
(5, 18709309, 0, 18, 'Referral', 'QH1143471672QH', 1, '2020-10-13 12:32:25'),
(6, 18709309, 0, 30, 'Coordinator', 'QA1278597774QA', 1, '2020-10-13 12:32:26'),
(7, 97639973, 0, 29.5, 'Referral', 'PE1399984093PE', 1, '2020-10-13 12:37:09'),
(8, 18709309, 0, 17.7, 'Referral', 'IE1182583521IE', 1, '2020-10-13 12:37:09'),
(9, 18709309, 0, 14.75, 'Coordinator', 'HO1341758803HO', 1, '2020-10-13 12:37:09'),
(10, 74484591, 0, 75, 'Referral', 'LL1141537520LL', 1, '2020-10-13 13:13:44'),
(11, 18709309, 0, 37.5, 'Coordinator', 'TH1115362597TH', 1, '2020-10-13 13:13:44'),
(12, 84589301, 0, 62.5, 'Referral', 'AY1155733470AY', 1, '2020-10-13 13:25:30'),
(13, 74484591, 0, 37.5, 'Referral', 'CI1405303013CI', 1, '2020-10-13 13:25:30'),
(14, 18709309, 0, 31.25, 'Coordinator', 'OM1332525961OM', 1, '2020-10-13 13:25:31'),
(15, 18709309, 0, 29, 'Referral', 'JZ1325300259JZ', 1, '2020-10-13 13:27:48'),
(16, 18709309, 0, 14.5, 'Coordinator', 'TE1360653284TE', 1, '2020-10-13 13:27:48'),
(17, 18709309, 0, 175, 'Referral', 'LP1191515292LP', 1, '2020-10-13 13:28:41'),
(18, 18709309, 0, 87.5, 'Coordinator', 'CO1136656522CO', 1, '2020-10-13 13:28:41'),
(19, 37177191, 0, 160, 'Referral', 'XX1327626716XX', 1, '2020-10-13 15:12:08'),
(20, 18709309, 0, 96, 'Referral', 'AU1342652892AU', 1, '2020-10-13 15:12:08'),
(21, 18709309, 0, 80, 'Coordinator', 'DP1381144353DP', 1, '2020-10-13 15:12:08'),
(22, 84589301, 0, 50, 'Referral', 'YU1328484312YU', 1, '2020-10-13 15:16:51'),
(23, 97639973, 0, 30, 'Referral', 'PE1217608105PE', 1, '2020-10-13 15:16:51'),
(24, 18709309, 0, 15, 'Referral', 'LR1263033320LR', 1, '2020-10-13 15:16:51'),
(25, 18709309, 0, 25, 'Coordinator', 'CZ1385204248CZ', 1, '2020-10-13 15:16:51'),
(26, 21177842, 0, 125, 'Referral', 'KY1259502579KY', 1, '2020-10-13 15:24:22'),
(27, 84589301, 0, 75, 'Referral', 'ZD1222598583ZD', 1, '2020-10-13 15:24:22'),
(28, 97639973, 0, 37.5, 'Referral', 'PN1390897226PN', 1, '2020-10-13 15:24:22'),
(29, 18709309, 0, 62.5, 'Coordinator', 'CR1368955542CR', 1, '2020-10-13 15:24:22'),
(30, 13547091, 0, 120, 'Referral', 'ZD1125799722ZD', 1, '2020-10-13 16:05:21'),
(31, 37177191, 0, 72, 'Referral', 'VJ1377814326VJ', 1, '2020-10-13 16:05:21'),
(32, 18709309, 0, 36, 'Referral', 'MU1336531117MU', 1, '2020-10-13 16:05:21'),
(33, 18709309, 0, 60, 'Coordinator', 'AE1310100740AE', 1, '2020-10-13 16:05:21'),
(34, 13547091, 0, 120, 'Referral', 'FC1348756421FC', 1, '2020-10-13 21:26:26'),
(35, 37177191, 0, 72, 'Referral', 'AQ1168615656AQ', 1, '2020-10-13 21:26:26'),
(36, 18709309, 0, 36, 'Referral', 'GR1307974997GR', 1, '2020-10-13 21:26:26'),
(37, 18709309, 0, 60, 'Coordinator', 'GJ1167612086GJ', 1, '2020-10-13 21:26:26'),
(38, 13547091, 0, 50, 'Referral', 'MF1276773102MF', 1, '2020-10-13 21:30:41'),
(39, 37177191, 0, 30, 'Referral', 'VS1162831445VS', 1, '2020-10-13 21:30:41'),
(40, 18709309, 0, 15, 'Referral', 'UW1400796073UW', 1, '2020-10-13 21:30:41'),
(41, 18709309, 0, 25, 'Coordinator', 'WO1245470850WO', 1, '2020-10-13 21:30:41'),
(42, 13547091, 0, 50, 'Referral', 'QA1303988088QA', 1, '2020-10-13 21:57:10'),
(43, 37177191, 0, 30, 'Referral', 'ME1389556092ME', 1, '2020-10-13 21:57:10'),
(44, 18709309, 0, 15, 'Referral', 'AJ1154237238AJ', 1, '2020-10-13 21:57:10'),
(45, 18709309, 0, 25, 'Coordinator', 'QM1171854449QM', 1, '2020-10-13 21:57:10'),
(46, 18709309, 0, 394.4, 'Group', 'TX1118783857TX', 1, '2020-10-13 21:57:11'),
(47, 97639973, 0, 394.4, 'Group', 'RS1163625177RS', 1, '2020-10-13 21:57:11'),
(48, 74484591, 0, 394.4, 'Group', 'CU1180111091CU', 1, '2020-10-13 21:57:11'),
(49, 84589301, 0, 394.4, 'Group', 'GQ1183860792GQ', 1, '2020-10-13 21:57:11'),
(50, 27536349, 0, 394.4, 'Group', 'BL1161882615BL', 1, '2020-10-13 21:57:11'),
(51, 33032226, 0, 788.8, 'Group', 'BK1303796497BK', 1, '2020-10-13 21:57:11'),
(52, 13547091, 0, 70, 'Referral', 'BK1307537075BK', 1, '2020-10-13 22:06:54'),
(53, 37177191, 0, 42, 'Referral', 'VL1237825473VL', 1, '2020-10-13 22:06:54'),
(54, 18709309, 0, 21, 'Referral', 'EW1260186831EW', 1, '2020-10-13 22:06:54'),
(55, 18709309, 0, 35, 'Coordinator', 'XP1393159819XP', 1, '2020-10-13 22:06:54'),
(56, 97639973, 0, 394.4, 'Group', 'BW1255314956BW', 1, '2020-10-13 22:06:55'),
(57, 74484591, 0, 394.4, 'Group', 'TK1314790147TK', 1, '2020-10-13 22:06:55'),
(58, 84589301, 0, 394.4, 'Group', 'YM1252048793YM', 1, '2020-10-13 22:06:55'),
(59, 27536349, 0, 394.4, 'Group', 'KO1377577119KO', 1, '2020-10-13 22:06:55'),
(60, 81892903, 0, 394.4, 'Group', 'OL1237542649OL', 1, '2020-10-13 22:06:55'),
(61, 18709309, 0, 788.8, 'Group', 'FM1349130479FM', 1, '2020-10-13 22:06:55'),
(62, 13547091, 0, 70, 'Referral', 'HX1332671935HX', 1, '2020-10-13 22:13:42'),
(63, 37177191, 0, 42, 'Referral', 'VW1125416541VW', 1, '2020-10-13 22:13:42'),
(64, 18709309, 0, 21, 'Referral', 'CS1401881753CS', 1, '2020-10-13 22:13:43'),
(65, 18709309, 0, 35, 'Coordinator', 'UC1376582672UC', 1, '2020-10-13 22:13:43'),
(66, 97639973, 0, 28, 'Group', 'TY1328475189TY', 1, '2020-10-13 22:13:43'),
(67, 74484591, 0, 28, 'Group', 'ZZ1374776247ZZ', 1, '2020-10-13 22:13:43'),
(68, 84589301, 0, 28, 'Group', 'LC1356520401LC', 1, '2020-10-13 22:13:43'),
(69, 27536349, 0, 28, 'Group', 'LF1350051938LF', 1, '2020-10-13 22:13:43'),
(70, 81892903, 0, 28, 'Group', 'AY1272311778AY', 1, '2020-10-13 22:13:44'),
(71, 18709309, 0, 56, 'Group', 'FV1186798514FV', 1, '2020-10-13 22:13:44'),
(72, 0, 18709309, 600, 'Referral', 'NU1325254643NU', 1, '2020-10-13 22:17:55'),
(73, 0, 18709309, 1230, 'Group', 'SD1249631102SD', 1, '2020-10-13 22:17:55'),
(74, 0, 18709309, 600, 'Coordinator', 'AW1173533147AW', 1, '2020-10-13 22:17:55'),
(75, 18709309, 0, 121.5, 'Reinvest', 'ES1177282849ES', 1, '2020-10-13 22:17:55'),
(76, 0, 18709309, 0, 'Referral', 'AL1285942080AL', 1, '2020-10-13 22:19:18'),
(77, 0, 18709309, 0, 'Group', 'OB1355671929OB', 1, '2020-10-13 22:19:18'),
(78, 0, 18709309, 100, 'Reinvest', 'LB1317928584LB', 1, '2020-10-13 22:19:18'),
(79, 0, 18709309, 0, 'Coordinator', 'SL1296935730SL', 1, '2020-10-13 22:19:18'),
(80, 18709309, 0, 5, 'Reinvest', 'ZR1331266938ZR', 1, '2020-10-13 22:19:19'),
(81, 18709309, 0, 80, 'Referral', 'CK1387503335CK', 1, '2020-10-14 01:24:56'),
(82, 18709309, 0, 40, 'Coordinator', 'EY1240462124EY', 1, '2020-10-14 01:24:56'),
(83, 18709309, 0, 50, 'Referral', 'HR1271362948HR', 1, '2020-10-14 01:25:47'),
(84, 18709309, 0, 25, 'Coordinator', 'MJ1388753236MJ', 1, '2020-10-14 01:25:48'),
(85, 18709309, 0, 90, 'Referral', 'KD1369667164KD', 1, '2020-10-14 01:27:09'),
(86, 18709309, 0, 45, 'Coordinator', 'IO1179162261IO', 1, '2020-10-14 01:27:09'),
(87, 18709309, 0, 125, 'Referral', 'YR1282301858YR', 1, '2020-10-14 01:28:25'),
(88, 18709309, 0, 62.5, 'Coordinator', 'CT1285358184CT', 1, '2020-10-14 01:28:25'),
(89, 18709309, 0, 250, 'Referral', 'BS1263653708BS', 1, '2020-10-14 01:30:26'),
(90, 18709309, 0, 125, 'Coordinator', 'TA1161170993TA', 1, '2020-10-14 01:30:26'),
(91, 18709309, 0, 150, 'Referral', 'IU1308193957IU', 1, '2020-10-14 01:32:06'),
(92, 18709309, 0, 75, 'Coordinator', 'YH1281982541YH', 1, '2020-10-14 01:32:06'),
(93, 84589301, 0, 298, 'Group', 'RN1405065806RN', 1, '2020-10-14 01:32:07'),
(94, 27536349, 0, 298, 'Group', 'QC1233537493QC', 1, '2020-10-14 01:32:07'),
(95, 51646592, 0, 298, 'Group', 'FX1287502174FX', 1, '2020-10-14 01:32:07'),
(96, 13547091, 0, 298, 'Group', 'IJ1385806390IJ', 1, '2020-10-14 01:32:07'),
(97, 97870551, 0, 298, 'Group', 'FO1176215415FO', 1, '2020-10-14 01:32:07'),
(98, 18709309, 0, 596, 'Group', 'PO1328894864PO', 1, '2020-10-14 01:32:07'),
(99, 0, 97870551, 270, 'Group', 'SC1127387187SC', 1, '2020-10-14 01:47:04'),
(100, 97870551, 0, 100, 'Referral', 'AN1153434383AN', 1, '2020-10-14 12:11:20'),
(101, 13547091, 0, 60, 'Referral', 'SI1250753276SI', 1, '2020-10-14 12:11:20'),
(102, 37177191, 0, 30, 'Referral', 'JG1273880996JG', 1, '2020-10-14 12:11:20'),
(103, 18709309, 0, 50, 'Coordinator', 'PH1358719131PH', 1, '2020-10-14 12:11:20'),
(104, 97870551, 0, 175, 'Referral', 'GJ1169482375GJ', 1, '2020-10-14 12:13:37'),
(105, 13547091, 0, 105, 'Referral', 'LH1324716364LH', 1, '2020-10-14 12:13:37'),
(106, 37177191, 0, 52.5, 'Referral', 'OZ1254968269OZ', 1, '2020-10-14 12:13:37'),
(107, 18709309, 0, 87.5, 'Coordinator', 'LO1308093600LO', 1, '2020-10-14 12:13:37'),
(108, 97870551, 0, 50, 'Referral', 'IU1154948861IU', 1, '2020-10-14 12:19:53'),
(109, 13547091, 0, 30, 'Referral', 'KP1169865556KP', 1, '2020-10-14 12:19:53'),
(110, 37177191, 0, 15, 'Referral', 'EY1300648938EY', 1, '2020-10-14 12:19:53'),
(111, 18709309, 0, 25, 'Coordinator', 'GR1214916713GR', 1, '2020-10-14 12:19:53'),
(112, 97870551, 0, 125, 'Referral', 'SU1198531157SU', 1, '2020-10-14 12:21:42'),
(113, 13547091, 0, 75, 'Referral', 'HF1350845671HF', 1, '2020-10-14 12:21:42'),
(114, 37177191, 0, 37.5, 'Referral', 'IX1350581093IX', 1, '2020-10-14 12:21:42'),
(115, 18709309, 0, 62.5, 'Coordinator', 'OX1125188457OX', 1, '2020-10-14 12:21:42'),
(116, 0, 37177191, 580, 'Referral', 'SU1289719151SU', 1, '2020-10-14 15:06:24'),
(117, 18709309, 0, 29, 'Referral', 'EY1182200340EY', 1, '2020-10-14 15:06:25'),
(118, 18709309, 0, 14.5, 'Coordinator', 'OX1365826229OX', 1, '2020-10-14 15:06:25'),
(119, 37177191, 0, 29, 'Reinvest', 'KR1278050372KR', 1, '2020-10-14 15:06:25'),
(120, 18709309, 0, 17.5, 'ROI', 'AZ1398296272AZ', 1, '2020-10-14 16:05:25'),
(121, 97639973, 0, 17.5, 'ROI', 'ZA1260122968ZA', 1, '2020-10-14 16:05:25'),
(122, 74484591, 0, 21, 'ROI', 'QD1297519625QD', 1, '2020-10-14 16:05:26'),
(123, 84589301, 0, 8.85, 'ROI', 'CX1311815932CX', 1, '2020-10-14 16:05:26'),
(124, 27536349, 0, 26.25, 'ROI', 'FF1367678272FF', 1, '2020-10-14 16:05:26'),
(125, 81892903, 0, 21.875, 'ROI', 'TO1361027342TO', 1, '2020-10-14 16:05:26'),
(126, 51646592, 0, 8.7, 'ROI', 'CE1138152753CE', 1, '2020-10-14 16:05:26'),
(127, 37177191, 0, 61.25, 'ROI', 'LT1128655334LT', 1, '2020-10-14 16:05:26'),
(128, 13547091, 0, 56, 'ROI', 'PY1212690613PY', 1, '2020-10-14 16:05:26'),
(129, 21177842, 0, 17.5, 'ROI', 'FL1372595763FL', 1, '2020-10-14 16:05:27'),
(130, 22639973, 0, 43.75, 'ROI', 'AU1251464898AU', 1, '2020-10-14 16:05:27'),
(131, 97870551, 0, 24.5, 'ROI', 'EJ1271892103EJ', 1, '2020-10-14 16:05:27'),
(132, 18709309, 0, 42.525, 'ROI', 'AI1241629915AI', 1, '2020-10-14 16:05:27'),
(133, 18709309, 0, 1.5, 'ROI', 'RY1192062694RY', 1, '2020-10-14 16:05:27'),
(134, 18709309, 0, 17.5, 'ROI', 'BX1135050810BX', 1, '2020-10-14 16:06:21'),
(135, 97639973, 0, 17.5, 'ROI', 'CP1351958721CP', 1, '2020-10-14 16:06:21'),
(136, 74484591, 0, 21, 'ROI', 'CB1309142787CB', 1, '2020-10-14 16:06:22'),
(137, 84589301, 0, 8.85, 'ROI', 'RT1378982116RT', 1, '2020-10-14 16:06:22'),
(138, 27536349, 0, 26.25, 'ROI', 'XF1248946850XF', 1, '2020-10-14 16:06:22'),
(139, 81892903, 0, 21.875, 'ROI', 'BK1301926208BK', 1, '2020-10-14 16:06:22'),
(140, 51646592, 0, 8.7, 'ROI', 'AO1333994823AO', 1, '2020-10-14 16:06:22'),
(141, 37177191, 0, 61.25, 'ROI', 'RU1355516831RU', 1, '2020-10-14 16:06:22'),
(142, 13547091, 0, 56, 'ROI', 'AN1299198323AN', 1, '2020-10-14 16:06:22'),
(143, 21177842, 0, 17.5, 'ROI', 'VW1391444627VW', 1, '2020-10-14 16:06:22'),
(144, 22639973, 0, 43.75, 'ROI', 'WB1206450234WB', 1, '2020-10-14 16:06:23'),
(145, 97870551, 0, 24.5, 'ROI', 'CI1252057916CI', 1, '2020-10-14 16:06:23'),
(146, 18709309, 0, 42.525, 'ROI', 'AT1220408977AT', 1, '2020-10-14 16:06:23'),
(147, 18709309, 0, 1.5, 'ROI', 'OA1144055567OA', 1, '2020-10-14 16:06:23'),
(148, 18709309, 0, 17.5, 'ROI', 'KV1172912759KV', 1, '2020-10-14 23:15:54'),
(149, 97639973, 0, 17.5, 'ROI', 'VW1123491512VW', 1, '2020-10-14 23:15:54'),
(150, 74484591, 0, 21, 'ROI', 'VE1380432731VE', 1, '2020-10-14 23:15:54'),
(151, 84589301, 0, 8.85, 'ROI', 'IA1371373233IA', 1, '2020-10-14 23:15:55'),
(152, 27536349, 0, 26.25, 'ROI', 'XD1385195125XD', 1, '2020-10-14 23:15:55'),
(153, 81892903, 0, 21.875, 'ROI', 'DS1243080529DS', 1, '2020-10-14 23:15:55'),
(154, 51646592, 0, 8.7, 'ROI', 'CS1314489076CS', 1, '2020-10-14 23:15:56'),
(155, 37177191, 0, 61.25, 'ROI', 'SR1356374427SR', 1, '2020-10-14 23:15:56'),
(156, 13547091, 0, 56, 'ROI', 'QY1174153536QY', 1, '2020-10-14 23:15:56'),
(157, 21177842, 0, 17.5, 'ROI', 'DX1273333594DX', 1, '2020-10-14 23:15:57'),
(158, 22639973, 0, 43.75, 'ROI', 'VX1222270142VX', 1, '2020-10-14 23:15:58'),
(159, 97870551, 0, 24.5, 'ROI', 'NC1368818692NC', 1, '2020-10-14 23:15:59'),
(160, 18709309, 0, 42.525, 'ROI', 'JJ1147038907JJ', 1, '2020-10-14 23:16:00'),
(161, 18709309, 0, 1.5, 'ROI', 'FS1111485168FS', 1, '2020-10-14 23:16:01'),
(162, 53298611, 0, 28, 'ROI', 'MQ1337333973MQ', 1, '2020-10-14 23:16:02'),
(163, 30292426, 0, 17.5, 'ROI', 'XI1231201913XI', 1, '2020-10-14 23:16:02'),
(164, 67784288, 0, 31.5, 'ROI', 'JC1163716411JC', 1, '2020-10-14 23:16:03'),
(165, 91172960, 0, 43.75, 'ROI', 'FW1402155453FW', 1, '2020-10-14 23:16:03'),
(166, 13327365, 0, 87.5, 'ROI', 'EH1145852870EH', 1, '2020-10-14 23:16:03'),
(167, 81608072, 0, 52.5, 'ROI', 'OW1214451422OW', 1, '2020-10-14 23:16:04'),
(168, 35058593, 0, 35, 'ROI', 'LG1233528370LG', 1, '2020-10-14 23:16:04'),
(169, 30533854, 0, 61.25, 'ROI', 'PS1145716019PS', 1, '2020-10-14 23:16:04'),
(170, 52403428, 0, 17.5, 'ROI', 'JU1180339175JU', 1, '2020-10-14 23:16:04'),
(171, 93307834, 0, 43.75, 'ROI', 'OU1141063105OU', 1, '2020-10-14 23:16:05'),
(172, 37177191, 0, 8.7, 'ROI', 'WO1216339958WO', 1, '2020-10-14 23:16:05'),
(173, 18709309, 0, 17.5, 'ROI', 'DN1181771542DN', 1, '2020-10-16 22:23:20'),
(174, 97639973, 0, 17.5, 'ROI', 'TF1278871475TF', 1, '2020-10-16 22:23:21'),
(175, 74484591, 0, 21, 'ROI', 'SE1187628740SE', 1, '2020-10-16 22:23:21'),
(176, 84589301, 0, 8.85, 'ROI', 'CR1124522451CR', 1, '2020-10-16 22:23:21'),
(177, 27536349, 0, 26.25, 'ROI', 'BM1258736217BM', 1, '2020-10-16 22:23:21'),
(178, 81892903, 0, 21.875, 'ROI', 'MU1270733437MU', 1, '2020-10-16 22:23:21'),
(179, 51646592, 0, 8.7, 'ROI', 'FC1172046039FC', 1, '2020-10-16 22:23:21'),
(180, 37177191, 0, 61.25, 'ROI', 'PG1405704441PG', 1, '2020-10-16 22:23:21'),
(181, 13547091, 0, 56, 'ROI', 'NO1293076548NO', 1, '2020-10-16 22:23:22'),
(182, 21177842, 0, 17.5, 'ROI', 'SK1320401014SK', 1, '2020-10-16 22:23:22'),
(183, 22639973, 0, 43.75, 'ROI', 'TJ1155879443TJ', 1, '2020-10-16 22:23:22'),
(184, 97870551, 0, 24.5, 'ROI', 'XQ1282247118XQ', 1, '2020-10-16 22:23:22'),
(185, 18709309, 0, 42.525, 'ROI', 'LN1331504145LN', 1, '2020-10-16 22:23:22'),
(186, 18709309, 0, 1.5, 'ROI', 'KM1213000807KM', 1, '2020-10-16 22:23:22'),
(187, 53298611, 0, 28, 'ROI', 'AM1410056284AM', 1, '2020-10-16 22:23:22'),
(188, 30292426, 0, 17.5, 'ROI', 'TZ1361401399TZ', 1, '2020-10-16 22:23:23'),
(189, 67784288, 0, 31.5, 'ROI', 'FP1271253468FP', 1, '2020-10-16 22:23:23'),
(190, 91172960, 0, 43.75, 'ROI', 'DW1182090860DW', 1, '2020-10-16 22:23:23'),
(191, 13327365, 0, 87.5, 'ROI', 'FK1159163853FK', 1, '2020-10-16 22:23:23'),
(192, 81608072, 0, 52.5, 'ROI', 'MX1204078160MX', 1, '2020-10-16 22:23:23'),
(193, 35058593, 0, 35, 'ROI', 'UR1159036126UR', 1, '2020-10-16 22:23:23'),
(194, 30533854, 0, 61.25, 'ROI', 'XA1311752068XA', 1, '2020-10-16 22:23:23'),
(195, 52403428, 0, 17.5, 'ROI', 'XU1272038077XU', 1, '2020-10-16 22:23:23'),
(196, 93307834, 0, 43.75, 'ROI', 'VQ1118574020VQ', 1, '2020-10-16 22:23:23'),
(197, 37177191, 0, 8.7, 'ROI', 'OY1191040877OY', 1, '2020-10-16 22:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_cell`
--

CREATE TABLE `user_cell` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_cell`
--

INSERT INTO `user_cell` (`id`, `uid`, `cid`, `date`) VALUES
(2, 18709309, 11111111, '2020-10-13 22:04:37'),
(3, 97639973, 42016601, '2020-10-13 22:13:44'),
(4, 74484591, 42016601, '2020-10-13 22:13:44'),
(5, 84589301, 26421440, '2020-10-14 01:32:08'),
(6, 27536349, 26421440, '2020-10-14 01:32:08'),
(7, 81892903, 42016601, '2020-10-13 22:13:44'),
(8, 51646592, 26421440, '2020-10-14 01:32:08'),
(9, 37177191, 42016601, '2020-10-13 22:13:44'),
(10, 13547091, 26421440, '2020-10-14 01:32:08'),
(11, 21177842, 42016601, '2020-10-13 22:13:44'),
(12, 22639973, 42016601, '2020-10-13 22:13:44'),
(18, 97870551, 11111111, '2020-10-13 22:13:43'),
(19, 53298611, 11111111, '2020-10-14 01:24:56'),
(20, 30292426, 26421440, '2020-10-14 01:32:08'),
(21, 67784288, 11111111, '2020-10-14 01:27:09'),
(22, 91172960, 26421440, '2020-10-14 01:32:08'),
(23, 13327365, 11111111, '2020-10-14 01:30:26'),
(24, 81608072, 11111111, '2020-10-14 01:32:07'),
(25, 35058593, 11111111, '2020-10-14 12:11:20'),
(26, 30533854, 11111111, '2020-10-14 12:13:38'),
(27, 52403428, 11111111, '2020-10-14 12:19:54'),
(28, 93307834, 11111111, '2020-10-14 12:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_main`
--

CREATE TABLE `user_main` (
  `id` double NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pic_url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_main`
--

INSERT INTO `user_main` (`id`, `uid`, `name`, `pic_url`, `status`, `date`) VALUES
(1, 33032226, 'Nweke Godwin', '', 1, '2020-08-08 21:11:05'),
(2, 18709309, 'Patrick Jack', '', 1, '2020-08-09 08:43:07'),
(3, 97639973, 'Liam Isiah', '', 1, '2020-10-13 02:06:59'),
(4, 74484591, 'Oliver Christian', '', 1, '2020-10-13 02:18:17'),
(5, 84589301, 'Benjamin Hunter', '', 1, '2020-10-13 02:20:38'),
(6, 27536349, 'Logan Charles', '', 1, '2020-10-13 02:28:47'),
(7, 81892903, 'Michael Adrian', '', 1, '2020-10-13 12:03:00'),
(8, 51646592, 'James Moore', '', 1, '2020-10-13 12:14:46'),
(9, 37177191, 'Lovelyn Hinger', '', 1, '2020-10-13 12:24:56'),
(10, 13547091, 'Anna Zing', '', 1, '2020-10-13 15:10:53'),
(11, 21177842, 'Miran Loja', '', 1, '2020-10-13 15:15:42'),
(12, 22639973, 'D King', '', 1, '2020-10-13 15:19:12'),
(13, 97870551, 'Amon Groom', '', 1, '2020-10-13 16:04:11'),
(14, 53298611, 'Donald Jacob', '', 1, '2020-10-14 00:52:33'),
(15, 30292426, 'Zara Bush', '', 1, '2020-10-14 00:54:21'),
(16, 67784288, 'Kerry Brown', '', 1, '2020-10-14 00:55:25'),
(17, 91172960, 'Mike Okuzo', '', 1, '2020-10-14 00:56:58'),
(18, 13327365, 'Abigail Sharp', '', 1, '2020-10-14 01:00:12'),
(19, 81608072, 'Billy Job', '', 1, '2020-10-14 01:03:45'),
(20, 30533854, 'Mcbanes', '', 1, '2020-10-14 01:11:40'),
(21, 35058593, 'Aslem B', '', 1, '2020-10-14 11:48:40'),
(22, 52403428, 'Adrian Jogas', '', 1, '2020-10-14 11:52:01'),
(23, 93307834, 'Julz Batch', '', 1, '2020-10-14 11:55:52'),
(24, 81303157, 'Godwin Anthony', '', 1, '2022-08-10 12:08:14'),
(25, 37149533, 'William', '', 1, '2022-08-22 22:04:44'),
(26, 37149018, 'James', '', 1, '2022-08-22 22:04:44'),
(27, 51924498, 'Harper', '', 1, '2022-08-22 22:04:44'),
(28, 63926824, 'Mason', '', 1, '2022-08-22 22:04:44'),
(29, 29897439, 'Evelyn', '', 1, '2022-08-22 22:04:45'),
(30, 12727039, 'Ella', '', 1, '2022-08-22 22:04:45'),
(31, 21873927, 'Jackson', '', 1, '2022-08-22 22:04:45'),
(32, 23594856, 'Avery', '', 1, '2022-08-22 22:04:46'),
(33, 99678954, 'Jack', '', 1, '2022-08-22 22:04:46'),
(34, 74691347, 'Scarlett', '', 1, '2022-08-22 22:04:46'),
(35, 75857275, 'Madison', '', 1, '2022-08-22 22:04:46'),
(36, 16408193, 'Eleanor', '', 1, '2022-08-22 22:04:46'),
(37, 23309346, 'Wyatt', '', 1, '2022-08-22 22:04:46'),
(38, 47762590, 'Carter', '', 1, '2022-08-22 22:04:46'),
(39, 73038544, 'Julian', '', 1, '2022-08-22 22:04:47'),
(40, 75148369, 'Hazel', '', 1, '2022-08-22 22:04:47'),
(41, 68403751, 'Grayson', '', 1, '2022-08-22 22:04:47'),
(42, 85805121, 'Lily', '', 1, '2022-08-22 22:04:47'),
(43, 63855760, 'Ellie', '', 1, '2022-08-22 22:04:47'),
(44, 42768276, 'Lillian', '', 1, '2022-08-22 22:04:47'),
(45, 35674869, 'Lincoln', '', 1, '2022-08-22 22:04:47'),
(46, 77602773, 'Jaxon', '', 1, '2022-08-22 22:04:48'),
(47, 14055320, 'Everly', '', 1, '2022-08-22 22:04:48'),
(48, 69971795, 'Aubrey', '', 1, '2022-08-22 22:04:48'),
(49, 24462173, 'Willow', '', 1, '2022-08-22 22:04:48'),
(50, 63303775, 'Addison', '', 1, '2022-08-22 22:04:48'),
(51, 69791978, 'Lucy', '', 1, '2022-08-22 22:04:48'),
(52, 21605863, 'Audrey', '', 1, '2022-08-22 22:04:48'),
(53, 29157687, 'Hudson', '', 1, '2022-08-22 22:04:48'),
(54, 82291596, 'Christian', '', 1, '2022-08-22 22:04:49'),
(55, 87844305, 'Colton', '', 1, '2022-08-22 22:04:49'),
(56, 40614091, 'Landon', '', 1, '2022-08-22 22:04:49'),
(57, 58580377, 'Hunter', '', 1, '2022-08-22 22:04:49'),
(58, 89494842, 'Ivy', '', 1, '2022-08-22 22:04:49'),
(59, 43525897, 'Kinsley', '', 1, '2022-08-22 22:04:49'),
(60, 59484634, 'Easton', '', 1, '2022-08-22 22:04:49'),
(61, 78645040, 'Greyson', '', 1, '2022-08-22 22:04:50'),
(62, 74083109, 'Cooper', '', 1, '2022-08-22 22:04:50'),
(63, 20208560, 'Piper', '', 1, '2022-08-22 22:04:50'),
(64, 45940997, 'Austin', '', 1, '2022-08-22 22:04:50'),
(65, 15487073, 'Everett', '', 1, '2022-08-22 22:04:50'),
(66, 59755108, 'Madeline', '', 1, '2022-08-22 22:04:50'),
(67, 21951747, 'Peyton', '', 1, '2022-08-22 22:04:50'),
(68, 51526130, 'Parker', '', 1, '2022-08-22 22:04:50'),
(69, 26200378, 'Wesley', '', 1, '2022-08-22 22:04:51'),
(70, 78060921, 'Bryson', '', 1, '2022-08-22 22:04:51'),
(71, 29229809, 'Weston', '', 1, '2022-08-22 22:04:51'),
(72, 56441730, 'Emmett', '', 1, '2022-08-22 22:04:51'),
(73, 41042966, 'Sawyer', '', 1, '2022-08-22 22:04:51'),
(74, 68766767, 'Silas', '', 1, '2022-08-22 22:04:51'),
(75, 20818568, 'Bennett', '', 1, '2022-08-22 22:04:51'),
(76, 59367677, 'Everleigh', '', 1, '2022-08-22 22:04:51'),
(77, 90499711, 'Brooks', '', 1, '2022-08-22 22:04:52'),
(78, 90567522, 'Hadley', '', 1, '2022-08-22 22:04:52'),
(79, 32086963, 'Waylon', '', 1, '2022-08-22 22:04:52'),
(80, 93312576, 'Kingston', '', 1, '2022-08-22 22:04:52'),
(81, 96796980, 'Cole', '', 1, '2022-08-22 22:04:52'),
(82, 92247079, 'Faith', '', 1, '2022-08-22 22:04:52'),
(83, 82878023, 'Ashton', '', 1, '2022-08-22 22:04:53'),
(84, 40328515, 'Braxton', '', 1, '2022-08-22 22:04:53'),
(85, 86882962, 'Tyler', '', 1, '2022-08-22 22:04:53'),
(86, 36657818, 'Bentley', '', 1, '2022-08-22 22:04:53'),
(87, 38231764, 'Charlie', '', 1, '2022-08-22 22:04:53'),
(88, 31831165, 'Taylor', '', 1, '2022-08-22 22:04:53'),
(89, 77665120, 'Ashley', '', 1, '2022-08-22 22:04:53'),
(90, 71124158, 'Brandon', '', 1, '2022-08-22 22:04:53'),
(91, 70025087, 'Andrea', '', 1, '2022-08-22 22:04:53'),
(92, 49745087, 'Parker', '', 1, '2022-08-22 22:04:53'),
(93, 83476642, 'Myles', '', 1, '2022-08-22 22:04:53'),
(94, 73781007, 'Legend', '', 1, '2022-08-22 22:04:54'),
(95, 30326614, 'Eloise', '', 1, '2022-08-22 22:04:54'),
(96, 63747072, 'Josie', '', 1, '2022-08-22 22:04:54'),
(97, 44784742, 'Rhett', '', 1, '2022-08-22 22:04:54'),
(98, 65906477, 'Alyssa', '', 1, '2022-08-22 22:04:54'),
(99, 47655176, 'Dean', '', 1, '2022-08-22 22:04:54'),
(100, 79775928, 'Graham', '', 1, '2022-08-22 22:04:54'),
(101, 42341418, 'Blakely', '', 1, '2022-08-22 22:04:54'),
(102, 87415568, 'Blake', '', 1, '2022-08-22 22:04:55'),
(103, 55655769, 'Hayden', '', 1, '2022-08-22 22:04:55'),
(104, 29576200, 'Lilly', '', 1, '2022-08-22 22:04:55'),
(105, 53801585, 'Edward', '', 1, '2022-08-22 22:04:55'),
(106, 79821482, 'Kimberly', '', 1, '2022-08-22 22:04:56'),
(107, 14698920, 'Tucker', '', 1, '2022-08-22 22:04:56'),
(108, 57382215, 'Steven', '', 1, '2022-08-22 22:04:56'),
(109, 29848918, 'Lauren', '', 1, '2022-08-22 22:04:57'),
(110, 89071928, 'Presley', '', 1, '2022-08-22 22:04:57'),
(111, 17489646, 'Avery', '', 1, '2022-08-22 22:04:57'),
(112, 86037729, 'Georgia', '', 1, '2022-08-22 22:04:57'),
(113, 64721148, 'Oscar', '', 1, '2022-08-22 22:04:57'),
(114, 92653450, 'Journee', '', 1, '2022-08-22 22:04:57'),
(115, 92416522, 'Archer', '', 1, '2022-08-22 22:04:57'),
(116, 14644880, 'Brooke', '', 1, '2022-08-22 22:04:57'),
(117, 90360419, 'Charlie', '', 1, '2022-08-22 22:04:57'),
(118, 61913255, 'Olive', '', 1, '2022-08-22 22:04:57'),
(119, 79705958, 'River', '', 1, '2022-08-22 22:04:57'),
(120, 52834922, 'Payton', '', 1, '2022-08-22 22:04:58'),
(121, 82729112, 'Beckett', '', 1, '2022-08-22 22:04:58'),
(122, 40850284, 'Jeremy', '', 1, '2022-08-22 22:04:58'),
(123, 42968824, 'Preston', '', 1, '2022-08-22 22:04:58'),
(124, 33081129, 'Gracie', '', 1, '2022-08-22 22:04:58'),
(125, 17323879, 'Blake', '', 1, '2022-08-22 22:04:58'),
(126, 20348449, 'Paige', '', 1, '2022-08-22 22:04:58'),
(127, 86466596, 'Remington', '', 1, '2022-08-22 22:04:58'),
(128, 98808178, 'Hope', '', 1, '2022-08-22 22:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` double NOT NULL,
  `uid` double NOT NULL,
  `fid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `net_worth` double NOT NULL,
  `role` int(1) NOT NULL,
  `country` int(11) NOT NULL,
  `password` text NOT NULL,
  `level` int(1) NOT NULL,
  `pin` text NOT NULL,
  `verified` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `uid`, `fid`, `username`, `phone`, `email`, `net_worth`, `role`, `country`, `password`, `level`, `pin`, `verified`, `status`, `date`) VALUES
(1, 33032226, 0, 'winanthony65', '8161555253', 'nwekegodwin65@gmail.com', 1250, 3, 161, 'bndla2VHb2R3aW42NQ==', 1, '', 0, 0, '0000-00-00 00:00:00'),
(2, 18709309, 0, 'pat', '7032902013', 'pat309@gmail.com', 39820, 2, 161, 'bndla2VHb2R3aW42NQ==', 2, '', 0, 0, '0000-00-00 00:00:00'),
(3, 97639973, 0, 'liam', '8452632141', 'liam34@gmail.com', 4680, 0, 239, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(4, 74484591, 0, 'oliver', '7510256374', 'oliverchristian1020@gmail.com', 4250, 0, 239, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(5, 84589301, 0, 'hunter', '6274521452', 'hunterb@gmail.com', 7000, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(6, 27536349, 0, 'logan', '7485621452', 'logan300@gmail.com', 0, 0, 239, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(7, 81892903, 0, 'michael', '8415214195', 'mikeadrian112@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(8, 51646592, 0, 'jamesmoore', '8415654271', 'jamesmoore20@gmail.com', 0, 0, 42, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(9, 37177191, 0, 'lovelyn', '8459621452', 'love4hinger@gmail.com', 24000, 0, 239, 'cGFzc3dvcmQyMDIw', 2, '', 0, 0, '0000-00-00 00:00:00'),
(10, 13547091, 0, 'annaing', '8125665241', 'annaz213@gmail.com', 17600, 0, 86, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(11, 21177842, 0, 'miran', '8521414526', 'lojamiran43@gmail.com', 5000, 0, 85, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(12, 22639973, 0, 'dking', '8415263214', 'dennisking12@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(13, 97870551, 0, 'among365', '8252635478', 'among365@gmail.com', 9000, 0, 42, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(14, 53298611, 0, 'donald', '8452632147', 'donaldjacob23@gmail.com', 0, 0, 42, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(15, 30292426, 0, 'zara4real', '9621452145', 'zara4real@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(16, 67784288, 0, 'kerry43', '5214526378', 'kerrybrown43@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(17, 91172960, 0, 'mikeoku', '2145632152', 'mikeokuzo1@gmail.com', 0, 0, 42, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(18, 13327365, 0, 'abigail234', '8541526321', 'abigailsharp234@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(19, 81608072, 0, 'billyjob50', '4152654187', 'billyjo50@gmail.com', 0, 0, 240, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(20, 30533854, 0, 'mcbanes', '7548596321', 'mcbanesstone@gmail.com', 0, 0, 239, 'cGFzc3dvcmQyMDIw', 1, '', 0, 0, '0000-00-00 00:00:00'),
(21, 35058593, 0, 'aslembaron24', '8452635241', 'aslembaron24@gmail.com', 0, 0, 42, 'NzcyODY3', 1, '', 0, 0, '0000-00-00 00:00:00'),
(22, 52403428, 0, 'adrianj', '4152638741', 'adrianjogas1@gmail.com', 0, 0, 240, 'QUQ1MDE0MTA=', 1, '', 0, 0, '0000-00-00 00:00:00'),
(23, 93307834, 0, 'julzbatch6', '5142536254', 'julzbatch6@gmail.com', 0, 0, 239, 'RlY0MzQwNTQ=', 1, '', 0, 0, '0000-00-00 00:00:00'),
(24, 81303157, 0, 'godwin', '9090879009', 'godwin65@gmail.com', 0, 0, 161, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(25, 37149533, 0, 'William92', '', 'William92@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(26, 37149018, 0, 'James67', '', 'James67@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(27, 51924498, 0, 'Harper40', '', 'Harper40@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(28, 63926824, 0, 'Mason62', '', 'Mason62@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(29, 29897439, 0, 'Evelyn56', '', 'Evelyn56@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(30, 12727039, 0, 'Ella93', '', 'Ella93@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(31, 21873927, 0, 'Jackson25', '', 'Jackson25@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(32, 23594856, 0, 'Avery26', '', 'Avery26@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(33, 99678954, 0, 'Jack59', '', 'Jack59@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(34, 74691347, 0, 'Scarlett85', '', 'Scarlett85@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(35, 75857275, 0, 'Madison90', '', 'Madison90@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(36, 16408193, 0, 'Eleanor34', '', 'Eleanor34@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(37, 23309346, 0, 'Wyatt32', '', 'Wyatt32@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(38, 47762590, 0, 'Carter52', '', 'Carter52@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(39, 73038544, 0, 'Julian80', '', 'Julian80@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(40, 75148369, 0, 'Hazel27', '', 'Hazel27@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(41, 68403751, 0, 'Grayson62', '', 'Grayson62@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(42, 85805121, 0, 'Lily44', '', 'Lily44@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(43, 63855760, 0, 'Ellie44', '', 'Ellie44@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(44, 42768276, 0, 'Lillian39', '', 'Lillian39@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(45, 35674869, 0, 'Lincoln22', '', 'Lincoln22@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(46, 77602773, 0, 'Jaxon59', '', 'Jaxon59@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(47, 14055320, 0, 'Everly45', '', 'Everly45@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(48, 69971795, 0, 'Aubrey85', '', 'Aubrey85@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(49, 24462173, 0, 'Willow79', '', 'Willow79@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(50, 63303775, 0, 'Addison25', '', 'Addison25@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(51, 69791978, 0, 'Lucy66', '', 'Lucy66@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(52, 21605863, 0, 'Audrey27', '', 'Audrey27@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(53, 29157687, 0, 'Hudson17', '', 'Hudson17@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(54, 82291596, 0, 'Christian43', '', 'Christian43@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(55, 87844305, 0, 'Colton46', '', 'Colton46@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(56, 40614091, 0, 'Landon95', '', 'Landon95@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(57, 58580377, 0, 'Hunter81', '', 'Hunter81@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(58, 89494842, 0, 'Ivy34', '', 'Ivy34@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(59, 43525897, 0, 'Kinsley84', '', 'Kinsley84@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(60, 59484634, 0, 'Easton86', '', 'Easton86@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(61, 78645040, 0, 'Greyson17', '', 'Greyson17@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(62, 74083109, 0, 'Cooper36', '', 'Cooper36@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(63, 20208560, 0, 'Piper94', '', 'Piper94@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(64, 45940997, 0, 'Austin95', '', 'Austin95@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(65, 15487073, 0, 'Everett83', '', 'Everett83@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(66, 59755108, 0, 'Madeline11', '', 'Madeline11@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(67, 21951747, 0, 'Peyton59', '', 'Peyton59@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(68, 51526130, 0, 'Parker34', '', 'Parker34@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(69, 26200378, 0, 'Wesley44', '', 'Wesley44@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(70, 78060921, 0, 'Bryson45', '', 'Bryson45@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(71, 29229809, 0, 'Weston74', '', 'Weston74@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(72, 56441730, 0, 'Emmett61', '', 'Emmett61@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(73, 41042966, 0, 'Sawyer19', '', 'Sawyer19@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(74, 68766767, 0, 'Silas98', '', 'Silas98@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(75, 20818568, 0, 'Bennett51', '', 'Bennett51@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(76, 59367677, 0, 'Everleigh55', '', 'Everleigh55@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(77, 90499711, 0, 'Brooks90', '', 'Brooks90@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(78, 90567522, 0, 'Hadley90', '', 'Hadley90@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(79, 32086963, 0, 'Waylon69', '', 'Waylon69@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(80, 93312576, 0, 'Kingston33', '', 'Kingston33@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(81, 96796980, 0, 'Cole55', '', 'Cole55@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(82, 92247079, 0, 'Faith72', '', 'Faith72@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(83, 82878023, 0, 'Ashton45', '', 'Ashton45@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(84, 40328515, 0, 'Braxton30', '', 'Braxton30@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(85, 86882962, 0, 'Tyler46', '', 'Tyler46@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(86, 36657818, 0, 'Bentley54', '', 'Bentley54@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(87, 38231764, 0, 'Charlie69', '', 'Charlie69@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(88, 31831165, 0, 'Taylor42', '', 'Taylor42@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(89, 77665120, 0, 'Ashley23', '', 'Ashley23@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(90, 71124158, 0, 'Brandon80', '', 'Brandon80@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(91, 70025087, 0, 'Andrea45', '', 'Andrea45@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(92, 49745087, 0, 'Parker90', '', 'Parker90@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(93, 83476642, 0, 'Myles99', '', 'Myles99@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(94, 73781007, 0, 'Legend50', '', 'Legend50@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(95, 30326614, 0, 'Eloise94', '', 'Eloise94@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(96, 63747072, 0, 'Josie57', '', 'Josie57@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(97, 44784742, 0, 'Rhett94', '', 'Rhett94@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(98, 65906477, 0, 'Alyssa89', '', 'Alyssa89@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(99, 47655176, 0, 'Dean17', '', 'Dean17@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(100, 79775928, 0, 'Graham50', '', 'Graham50@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(101, 42341418, 0, 'Blakely25', '', 'Blakely25@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(102, 87415568, 0, 'Blake29', '', 'Blake29@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(103, 55655769, 0, 'Hayden34', '', 'Hayden34@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(104, 29576200, 0, 'Lilly37', '', 'Lilly37@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(105, 53801585, 0, 'Edward59', '', 'Edward59@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(106, 79821482, 0, 'Kimberly20', '', 'Kimberly20@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(107, 14698920, 0, 'Tucker50', '', 'Tucker50@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(108, 57382215, 0, 'Steven79', '', 'Steven79@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(109, 29848918, 0, 'Lauren44', '', 'Lauren44@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(110, 89071928, 0, 'Presley85', '', 'Presley85@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(111, 17489646, 0, 'Avery65', '', 'Avery65@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(112, 86037729, 0, 'Georgia34', '', 'Georgia34@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(113, 64721148, 0, 'Oscar80', '', 'Oscar80@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(114, 92653450, 0, 'Journee11', '', 'Journee11@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(115, 92416522, 0, 'Archer69', '', 'Archer69@yahoo.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(116, 14644880, 0, 'Brooke85', '', 'Brooke85@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(117, 90360419, 0, 'Charlie20', '', 'Charlie20@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(118, 61913255, 0, 'Olive25', '', 'Olive25@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(119, 79705958, 0, 'River53', '', 'River53@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(120, 52834922, 0, 'Payton58', '', 'Payton58@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(121, 82729112, 0, 'Beckett95', '', 'Beckett95@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(122, 40850284, 0, 'Jeremy72', '', 'Jeremy72@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(123, 42968824, 0, 'Preston88', '', 'Preston88@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(124, 33081129, 0, 'Gracie64', '', 'Gracie64@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(125, 17323879, 0, 'Blake50', '', 'Blake50@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(126, 20348449, 0, 'Paige15', '', 'Paige15@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(127, 86466596, 0, 'Remington45', '', 'Remington45@gmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00'),
(128, 98808178, 0, 'Hope55', '', 'Hope55@hotmail.com', 0, 0, 0, 'cGFzc3dvcmQ=', 0, '', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_referral`
--

CREATE TABLE `user_referral` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `refID1` int(11) NOT NULL,
  `refID2` int(11) NOT NULL,
  `refID3` int(11) NOT NULL,
  `coordinator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_referral`
--

INSERT INTO `user_referral` (`id`, `uid`, `refID1`, `refID2`, `refID3`, `coordinator`) VALUES
(1, 33032226, 0, 0, 0, 0),
(2, 18709309, 0, 0, 0, 0),
(3, 97639973, 18709309, 0, 18709309, 18709309),
(4, 74484591, 18709309, 0, 18709309, 18709309),
(5, 84589301, 97639973, 18709309, 0, 18709309),
(6, 27536349, 74484591, 0, 0, 18709309),
(7, 81892903, 84589301, 74484591, 0, 18709309),
(8, 51646592, 18709309, 0, 0, 18709309),
(9, 37177191, 18709309, 0, 0, 18709309),
(10, 13547091, 37177191, 18709309, 0, 37177191),
(11, 21177842, 84589301, 97639973, 18709309, 18709309),
(12, 22639973, 21177842, 84589301, 97639973, 18709309),
(13, 97870551, 13547091, 37177191, 18709309, 18709309),
(14, 53298611, 18709309, 0, 0, 18709309),
(15, 30292426, 18709309, 0, 0, 18709309),
(16, 67784288, 18709309, 0, 0, 18709309),
(17, 91172960, 18709309, 0, 0, 18709309),
(18, 13327365, 18709309, 0, 0, 18709309),
(19, 81608072, 18709309, 0, 0, 18709309),
(20, 30533854, 97870551, 13547091, 37177191, 18709309),
(21, 35058593, 97870551, 13547091, 37177191, 18709309),
(22, 52403428, 97870551, 13547091, 37177191, 18709309),
(23, 93307834, 97870551, 13547091, 37177191, 18709309),
(24, 81303157, 18709309, 0, 0, 18709309);

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` double NOT NULL,
  `amount` double NOT NULL,
  `creditor` double NOT NULL,
  `debitor` double NOT NULL,
  `creditor_desc` varchar(150) NOT NULL,
  `debitor_desc` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `extra` varchar(150) NOT NULL,
  `ref` varchar(15) NOT NULL,
  `status` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `amount`, `creditor`, `debitor`, `creditor_desc`, `debitor_desc`, `type`, `extra`, `ref`, `status`, `date`) VALUES
(1, 1000, 18709309, 0, 'Account funding', 'Account funding', 'Funding jsfjjsdj43jk34jklj34kjklj34j', 'Bitcoin $1,000 (jsfjjsdj43jk34jklj34kjklj34j)', 'PS1207773122PS', 1, '2020-10-08 23:38:20'),
(6, 1000, 0, 18709309, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'OH1121767196OH', 1, '2020-10-12 16:33:53'),
(7, 1000, 97639973, 0, 'Account funding', 'Account funding', 'Funding sjjfksjkk34jkj34jh3h4k3j4kj3k', 'Bitcoin $1,000 (sjjfksjkk34jkj34jh3h4k3j4kj3k)', 'TN1359102312TN', 1, '2020-10-13 02:15:20'),
(8, 1200, 74484591, 0, 'Account funding', 'Account funding', 'Funding jkhkjds9898fd789fddd', 'Bitcoin $1,200 (jkhkjds9898fd789fddd)', 'RS1280203485RS', 1, '2020-10-13 02:19:25'),
(9, 590, 84589301, 0, 'Account funding', 'Account funding', 'Funding jsdfj34j3jh43jh3j4j53j4kj3k', 'Perfect Money $590 (jsdfj34j3jh43jh3j4j53j4kj3k)', 'RT1342315328RT', 1, '2020-10-13 02:27:12'),
(10, 1500, 27536349, 0, 'Account funding', 'Account funding', 'Funding jsdfjsfwrk23034ikjsfksdmf', 'Bitcoin $1,500 (jsdfjsfwrk23034ikjsfksdmf)', 'MB1128071439MB', 1, '2020-10-13 02:29:34'),
(11, 580, 51646592, 0, 'Account funding', 'Account funding', 'Funding jejrr34534j3kj4lj34jk4j3j4h3k4lj', 'Ethereum $580 (jejrr34534j3kj4lj34jk4j3j4h3k4lj)', 'AZ1307108277AZ', 1, '2020-10-13 12:15:57'),
(12, 3500, 37177191, 0, 'Account funding', 'Account funding', 'Funding fj34j3kjl3khl4h34hlk3h4h34kh', 'Perfect Money $3,500 (fj34j3kjl3khl4h34hlk3h4h34kh)', 'TD1269410549TD', 1, '2020-10-13 12:26:13'),
(13, 1000, 0, 97639973, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'JJ1179965117JJ', 1, '2020-10-13 12:30:33'),
(14, 1200, 0, 74484591, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'JF1240900046JF', 1, '2020-10-13 12:32:25'),
(15, 590, 0, 84589301, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 1)', 'JZ1119404246JZ', 1, '2020-10-13 12:37:09'),
(16, 1500, 0, 27536349, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'PL1348510090PL', 1, '2020-10-13 13:13:43'),
(17, 1250, 81892903, 0, 'Account funding', 'Account funding', 'Funding sfdhsd8fds9s9sdf89sd8d', 'Ethereum $1,250 (sfdhsd8fds9s9sdf89sd8d)', 'CK1237998817CK', 1, '2020-10-13 13:25:03'),
(18, 1250, 0, 81892903, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'XI1207681888XI', 1, '2020-10-13 13:25:30'),
(19, 580, 0, 51646592, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 1)', 'VU1263535105VU', 1, '2020-10-13 13:27:48'),
(20, 3500, 0, 37177191, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'XN1175877851XN', 1, '2020-10-13 13:28:40'),
(21, 3200, 13547091, 0, 'Account funding', 'Account funding', 'Funding kljsldjf4hj4h3hj345hj34h5jhj3h45', 'Perfect Money $3,200 (kljsldjf4hj4h3hj345hj34h5jhj3h45)', 'YX1194161067YX', 1, '2020-10-13 15:11:29'),
(22, 3200, 0, 13547091, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'UK1297902806UK', 1, '2020-10-13 15:12:08'),
(23, 1000, 21177842, 0, 'Account funding', 'Account funding', 'Funding jsdfuji45i344k3j4j3io4ji3j', 'Ethereum $1,000 (jsdfuji45i344k3j4j3io4ji3j)', 'LF1311514861LF', 1, '2020-10-13 15:16:18'),
(24, 1000, 0, 21177842, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'WS1239057127WS', 1, '2020-10-13 15:16:50'),
(25, 2500, 22639973, 0, 'Account funding', 'Account funding', 'Funding shfh34hhjkh43h43h343343', 'Bitcoin $2,500 (shfh34hhjkh43h43h343343)', 'ZS1304006335ZS', 1, '2020-10-13 15:22:04'),
(26, 2500, 0, 22639973, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'YI1262257834YI', 1, '2020-10-13 15:24:21'),
(27, 2400, 97870551, 0, 'Account funding', 'Account funding', 'Funding sjfkljwerjkwejr234jk3j24j23', 'Bitcoin $2,400 (sjfkljwerjkwejr234jk3j24j23)', 'OL1181151154OL', 1, '2020-10-13 16:04:43'),
(33, 1400, 0, 97870551, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'QE1241128130QE', 1, '2020-10-13 22:13:42'),
(34, 2430, 18709309, 0, 'Commission cashout', 'Commission cashout', 'Cashout', '', 'MW1198412553MW', 1, '2020-10-13 22:17:55'),
(35, 2430, 0, 18709309, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'LO1370095962LO', 1, '2020-10-13 22:17:55'),
(36, 100, 18709309, 0, 'Commission cashout', 'Commission cashout', 'Cashout', '', 'WR1206130917WR', 1, '2020-10-13 22:19:18'),
(37, 100, 0, 18709309, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 1)', 'GA1203959557GA', 1, '2020-10-13 22:19:18'),
(38, 1000, 30292426, 0, 'Account funding', 'Account funding', 'Funding jkht76tgygyg76tggy', 'Bitcoin $1,000 (jkht76tgygyg76tggy)', 'RV1237068234RV', 1, '2020-10-14 01:14:02'),
(39, 1600, 53298611, 0, 'Account funding', 'Account funding', 'Funding kljsdf78sdf78sdf789s7df8s', 'Bitcoin $1,600 (kljsdf78sdf78sdf789s7df8s)', 'AY1299572381AY', 1, '2020-10-14 01:18:38'),
(40, 1800, 67784288, 0, 'Account funding', 'Account funding', 'Funding kjkjusfs89df79s', 'Perfect Money $1,800 (kjkjusfs89df79s)', 'IT1151153542IT', 1, '2020-10-14 01:19:58'),
(41, 2500, 91172960, 0, 'Account funding', 'Account funding', 'Funding jskdjf7s8df8sdfsd7f897sd', 'Ethereum $2,500 (jskdjf7s8df8sdfsd7f897sd)', 'NQ1331723106NQ', 1, '2020-10-14 01:20:39'),
(42, 5000, 13327365, 0, 'Account funding', 'Account funding', 'Funding jkjjj34kj3j4k3j4klj4kljl3j4hjkb', 'Ethereum $5,000 (jkjjj34kj3j4k3j4klj4kljl3j4hjkb)', 'WI1156901260WI', 1, '2020-10-14 01:21:26'),
(43, 3000, 81608072, 0, 'Account funding', 'Account funding', 'Funding sjdfjkj45j3k5j45k343k', 'Bitcoin $3,000 (sjdfjkj45j3k5j45k343k)', 'NT1379775849NT', 1, '2020-10-14 01:22:10'),
(44, 3500, 30533854, 0, 'Account funding', 'Account funding', 'Funding j24j32j424k234j2', 'Perfect Money $3,500 (j24j32j424k234j2)', 'FE1327216165FE', 1, '2020-10-14 01:22:55'),
(45, 1600, 0, 53298611, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'FS1142541090FS', 1, '2020-10-14 01:24:56'),
(46, 2000, 18709309, 0, 'Reward for completion of Investor', 'Reward for completion of Investor', 'Level Reward', '', 'GN1279646960GN', 0, '2020-10-14 01:24:56'),
(47, 1000, 0, 30292426, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'MQ1249886556MQ', 1, '2020-10-14 01:25:47'),
(48, 1800, 0, 67784288, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'LF1377312541LF', 1, '2020-10-14 01:27:08'),
(49, 2500, 0, 91172960, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'LM1240316151LM', 1, '2020-10-14 01:28:24'),
(50, 5000, 0, 13327365, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'NT1317718746NT', 1, '2020-10-14 01:30:26'),
(51, 3000, 0, 81608072, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'CL1327371262CL', 1, '2020-10-14 01:32:06'),
(52, 270, 97870551, 0, 'Commission cashout', 'Commission cashout', 'Cashout', '', 'LG1235398659LG', 1, '2020-10-14 01:47:04'),
(53, 2000, 35058593, 0, 'Account funding', 'Account funding', 'Funding sdjkj43jk4j34k3jk4jk3', 'Bitcoin $2,000 (sdjkj43jk4j34k3jk4jk3)', 'FP1176270156FP', 1, '2020-10-14 12:10:51'),
(54, 2000, 0, 35058593, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'HU1282748903HU', 1, '2020-10-14 12:11:20'),
(55, 1000, 52403428, 0, 'Account top up', 'Account top up', 'Bonus', '', 'CE1233136065CE', 1, '2020-10-14 12:12:26'),
(56, 2500, 93307834, 0, 'Account top up', 'Account top up', 'Bonus', '', 'RN1313877811RN', 1, '2020-10-14 12:12:54'),
(57, 3500, 0, 30533854, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'PN1272448628PN', 1, '2020-10-14 12:13:37'),
(58, 2000, 37177191, 0, 'Reward for completion of Investor', 'Reward for completion of Investor', 'Level Reward', '', 'FA1217106320FA', 1, '2020-10-14 12:13:38'),
(59, 1000, 0, 52403428, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'DC1159747749DC', 1, '2020-10-14 12:19:53'),
(60, 2500, 0, 93307834, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 2)', 'YI1225591046YI', 1, '2020-10-14 12:21:42'),
(61, 100, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Bitcoin (Coinbase, jjjkj234h24h23h4l24234jh234)', 'CY1140771157CY', 2, '2020-10-14 14:24:48'),
(62, 200, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Bitcoin (blockchain.com, jsdjrj3j43j4h3l4jl3jkl4j3j4)', 'UO1145725143UO', 2, '2020-10-14 14:29:45'),
(63, 300, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Bitcoin (coinbase.com, jsdkfjs78f87sdfg6d8sf68d6)', 'MY1145816376MY', 2, '2020-10-14 14:30:23'),
(64, 200, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Bitcoin (blockchain, sdjj34j3klj4k3jkl4j3kl4j)', 'NE1172383604NE', 2, '2020-10-14 14:48:14'),
(65, 200, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Ethereum (blockchain, kjskjd34343)', 'OJ1346530321OJ', 2, '2020-10-14 14:48:43'),
(66, 200, 0, 37177191, 'Withdrawal', 'Withdrawal', 'Withdraw', 'Perfect (sjdf778)', 'GL1122551805GL', 2, '2020-10-14 14:51:25'),
(67, 580, 37177191, 0, 'Commission cashout', 'Commission cashout', 'Cashout', '', 'GM1161143623GM', 1, '2020-10-14 15:06:24'),
(68, 580, 0, 37177191, 'Forex investment', 'Forex investment', 'Investment', 'forex (Tier 1)', 'FD1201231672FD', 1, '2020-10-14 15:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_ex`
--

CREATE TABLE `user_wallet_ex` (
  `id` double NOT NULL,
  `amount` double NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `method` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `ref` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet_ex`
--

INSERT INTO `user_wallet_ex` (`id`, `amount`, `uid`, `type`, `method`, `desc`, `ref`, `status`, `date`) VALUES
(1, 1000, 18709309, 'debit', 0, 'Forex investment', 'AE34502495AE', 1, '2020-10-12 16:33:53'),
(2, 1000, 97639973, 'debit', 0, 'Forex investment', 'LI69330512LI', 1, '2020-10-13 12:30:33'),
(3, 1200, 74484591, 'debit', 0, 'Forex investment', 'RK40345594RK', 1, '2020-10-13 12:32:25'),
(4, 590, 84589301, 'debit', 0, 'Forex investment', 'IS49001736IS', 1, '2020-10-13 12:37:09'),
(5, 1500, 27536349, 'debit', 0, 'Forex investment', 'MB45507812MB', 1, '2020-10-13 13:13:43'),
(6, 1250, 81892903, 'debit', 0, 'Forex investment', 'VE55414496VE', 1, '2020-10-13 13:25:30'),
(7, 580, 51646592, 'debit', 0, 'Forex investment', 'UI11279296UI', 1, '2020-10-13 13:27:48'),
(8, 3500, 37177191, 'debit', 0, 'Forex investment', 'YX27143012YX', 1, '2020-10-13 13:28:41'),
(9, 3200, 13547091, 'debit', 0, 'Forex investment', 'VO63631184VO', 1, '2020-10-13 15:12:08'),
(10, 1000, 21177842, 'debit', 0, 'Forex investment', 'XT57831488XT', 1, '2020-10-13 15:16:51'),
(11, 2500, 22639973, 'debit', 0, 'Forex investment', 'AL64762369AL', 1, '2020-10-13 15:24:22'),
(12, 2400, 97870551, 'debit', 0, 'Forex investment', 'FU57375759FU', 1, '2020-10-13 16:05:21'),
(13, 2400, 97870551, 'debit', 0, 'Forex investment', 'SE36102973SE', 1, '2020-10-13 21:26:26'),
(14, 1000, 97870551, 'debit', 0, 'Forex investment', 'BH63332790BH', 1, '2020-10-13 21:30:40'),
(15, 1000, 97870551, 'debit', 0, 'Forex investment', 'NX60845269NX', 1, '2020-10-13 21:57:10'),
(16, 1400, 97870551, 'debit', 0, 'Forex investment', 'JX63321940JX', 1, '2020-10-13 22:06:54'),
(17, 1400, 97870551, 'debit', 0, 'Forex investment', 'ZO27620442ZO', 1, '2020-10-13 22:13:42'),
(18, 2430, 18709309, 'credit', 0, 'Commission cashout', 'IO67675781IO', 1, '2020-10-13 22:17:55'),
(19, 2430, 18709309, 'debit', 0, 'Forex investment', 'DG57199435DG', 1, '2020-10-13 22:17:55'),
(20, 100, 18709309, 'credit', 0, 'Commission cashout', 'RC88612196RC', 1, '2020-10-13 22:19:18'),
(21, 100, 18709309, 'debit', 0, 'Forex investment', 'VZ99533420VZ', 1, '2020-10-13 22:19:18'),
(22, 1600, 53298611, 'debit', 0, 'Forex investment', 'DZ27495659DZ', 1, '2020-10-14 01:24:56'),
(23, 2000, 18709309, 'credit', 0, 'Reward for completion of Investor', 'VS61707899VS', 1, '2020-10-14 01:24:56'),
(24, 1000, 30292426, 'debit', 0, 'Forex investment', 'EQ54530164EQ', 1, '2020-10-14 01:25:47'),
(25, 1800, 67784288, 'debit', 0, 'Forex investment', 'UL70575629UL', 1, '2020-10-14 01:27:08'),
(26, 2500, 91172960, 'debit', 0, 'Forex investment', 'LF97810872LF', 1, '2020-10-14 01:28:25'),
(27, 5000, 13327365, 'debit', 0, 'Forex investment', 'PS74514431PS', 1, '2020-10-14 01:30:26'),
(28, 3000, 81608072, 'debit', 0, 'Forex investment', 'WA55097113WA', 1, '2020-10-14 01:32:06'),
(29, 270, 97870551, 'credit', 0, 'Commission cashout', 'FA41498480FA', 1, '2020-10-14 01:47:04'),
(30, 2000, 35058593, 'debit', 0, 'Forex investment', 'DW84201388DW', 1, '2020-10-14 12:11:20'),
(31, 1000, 52403428, 'credit', 0, 'Account top up', 'GV75287543GV', 1, '2020-10-14 12:12:26'),
(32, 2500, 93307834, 'credit', 0, 'Account top up', 'RV15028211RV', 1, '2020-10-14 12:12:54'),
(33, 3500, 30533854, 'debit', 0, 'Forex investment', 'KX43758137KX', 1, '2020-10-14 12:13:37'),
(34, 2000, 37177191, 'credit', 0, 'Reward for completion of Investor', 'TI48722330TI', 1, '2020-10-14 12:13:38'),
(35, 1000, 52403428, 'debit', 0, 'Forex investment', 'RD70176866RD', 1, '2020-10-14 12:19:53'),
(36, 2500, 93307834, 'debit', 0, 'Forex investment', 'OF55346679OF', 1, '2020-10-14 12:21:42'),
(37, 100, 37177191, 'debit', 0, 'Withdrawal', 'GY26687282GY', 1, '2020-10-14 14:24:48'),
(38, 200, 37177191, 'debit', 0, 'Withdrawal', 'ZZ73852539ZZ', 1, '2020-10-14 14:29:45'),
(39, 300, 37177191, 'debit', 0, 'Withdrawal', 'CB50984700CB', 1, '2020-10-14 14:30:24'),
(40, 200, 37177191, 'debit', 0, 'Withdrawal', 'HW58536783HW', 1, '2020-10-14 14:48:14'),
(41, 200, 37177191, 'debit', 0, 'Withdrawal', 'NH52851019NH', 1, '2020-10-14 14:48:43'),
(42, 200, 37177191, 'debit', 0, 'Withdrawal', 'SX15616861SX', 1, '2020-10-14 14:51:25'),
(43, 580, 37177191, 'credit', 0, 'Commission cashout', 'LR31410047LR', 1, '2020-10-14 15:06:25'),
(44, 580, 37177191, 'debit', 0, 'Forex investment', 'QH27726236QH', 1, '2020-10-14 15:06:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cell`
--
ALTER TABLE `cell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bonus`
--
ALTER TABLE `user_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cell`
--
ALTER TABLE `user_cell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_main`
--
ALTER TABLE `user_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referral`
--
ALTER TABLE `user_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet_ex`
--
ALTER TABLE `user_wallet_ex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cell`
--
ALTER TABLE `cell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_bonus`
--
ALTER TABLE `user_bonus`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `user_cell`
--
ALTER TABLE `user_cell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_main`
--
ALTER TABLE `user_main`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user_referral`
--
ALTER TABLE `user_referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_wallet_ex`
--
ALTER TABLE `user_wallet_ex`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
