-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-03-11 04:49:16
-- 服务器版本： 5.7.15-log
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itousu`
--

-- --------------------------------------------------------

--
-- 表的结构 `boone_admin_groups`
--

CREATE TABLE `boone_admin_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_admin_groups`
--

INSERT INTO `boone_admin_groups` (`id`, `name`, `description`) VALUES
(1, 'developer', 'This is a group of developers, to manage the entire system development and maintenance work'),
(2, '律师', '投诉网案件处理');

-- --------------------------------------------------------

--
-- 表的结构 `boone_admin_users`
--

CREATE TABLE `boone_admin_users` (
  `id` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `account` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT '/resources/uploads/avater/default.bmp',
  `forgottenPasswordCode` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginKey` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `createdOn` int(11) NOT NULL,
  `ipAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastLogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_admin_users`
--

INSERT INTO `boone_admin_users` (`id`, `group`, `account`, `password`, `salt`, `avatar`, `forgottenPasswordCode`, `loginKey`, `username`, `mobile`, `active`, `createdOn`, `ipAddress`, `lastLogin`) VALUES
(1, 1, 'developer@boone.red', '$2y$10$j8dL9TyLORhqoufFPuDguepQResx4EAarsvE0BuIjWKdvRza6q6Im', '7da6f852', '/resources/uploads/avater/default.bmp', NULL, '$2y$10$Rb3Zk2dmVuFgICLSVDefzeHouK1oDnxG1E.QEy.sHMMquAzGstFSa', 'Boone', NULL, 1, 1460356714, '127.0.0.1', 1481601547),
(2, 1, 'lewis@2le.com', '$2y$10$9GUS.9d/e6j8Fg2c4zx.c.kRTyzgEvGRqMmon2CXgi8rOSIX.OMjO', 'f3f1bafc', '/resources/uploads/avater/default.bmp', NULL, '$2y$10$nb8CiDoms7Y5CA6/Gx/ioeFlIDzcfRei5K64VBYEN9HJf2iSJjunO', '绝版小强', NULL, 1, 1460379983, '113.118.136.141', 1462059182);

-- --------------------------------------------------------

--
-- 表的结构 `boone_admin_users_profile`
--

CREATE TABLE `boone_admin_users_profile` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `displayName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `gender` enum('female','male') COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressLine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressLineOne` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressLineTwo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedOn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_admin_users_profile`
--

INSERT INTO `boone_admin_users_profile` (`id`, `userId`, `displayName`, `firstName`, `lastName`, `company`, `department`, `job`, `bio`, `gender`, `birthday`, `phone`, `addressLine`, `addressLineOne`, `addressLineTwo`, `postcode`, `website`, `updatedOn`) VALUES
(1, 1, 'Spot', 'Spot', 'Dot', NULL, NULL, NULL, NULL, 'male', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(2, 2, '绝版小强', 'lewis', 'Liu', NULL, NULL, NULL, NULL, 'male', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_applications`
--

CREATE TABLE `boone_applications` (
  `id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(52) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `skipXss` tinyint(1) NOT NULL,
  `isFrontend` tinyint(1) NOT NULL,
  `isBackend` tinyint(1) NOT NULL,
  `isUser` tinyint(1) NOT NULL,
  `menu` varchar(52) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `installed` tinyint(1) NOT NULL,
  `isCore` tinyint(1) NOT NULL,
  `updatedOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_applications`
--

INSERT INTO `boone_applications` (`id`, `slug`, `name`, `description`, `version`, `skipXss`, `isFrontend`, `isBackend`, `isUser`, `menu`, `enabled`, `installed`, `isCore`, `updatedOn`) VALUES
(1, 'addon', 'a:1:{s:2:"cn";s:12:"附加功能";}', 'a:1:{s:2:"cn";s:54:"管理员可以检视目前已经安装模组的列表";}', '1.0.0', 0, 0, 1, 0, 'application', 1, 1, 1, 1462741615),
(2, 'settings', 'a:1:{s:2:"cn";s:18:"系统偏好设置";}', 'a:1:{s:2:"cn";s:99:"网站管理者可更新的重要网站设定。例如：网站名称、讯息、电子邮件等。";}', '1.0.0', 0, 0, 1, 0, 'setting', 1, 0, 1, 1462741615),
(3, 'users', 'a:1:{s:2:"cn";s:6:"团队";}', 'a:1:{s:2:"cn";s:35:"后台管理, 公司员工, 团队.";}', '1.0.0', 0, 0, 1, 0, 'root', 1, 1, 1, 1462741615),
(4, 'member', 'a:1:{s:2:"cn";s:6:"用户";}', 'a:1:{s:2:"cn";s:27:"注册成员, 网站成员.";}', '1.0.0', 0, 0, 1, 1, 'root', 1, 1, 1, 1465180703),
(5, 'database', 'a:1:{s:2:"cn";s:9:"数据库";}', 'a:1:{s:2:"cn";s:33:"数据库维护，优化，备份";}', '1.0.0', 0, 0, 1, 0, 'application', 1, 0, 1, 1461964779),
(6, 'honesty', 'a:1:{s:2:"cn";s:6:"投诉";}', 'a:1:{s:2:"cn";s:28:"投诉网平台核心模组.";}', '1.0.0', 0, 1, 1, 1, 'data', 1, 1, 1, 1462741615),
(7, 'post', 'a:1:{s:2:"cn";s:6:"文章";}', 'a:1:{s:2:"cn";s:55:"文章分类一个多才多艺的文章和帖子模组.";}', '1.0.0', 0, 1, 1, 0, 'content', 1, 1, 1, 1462741615),
(8, 'file', 'a:1:{s:2:"cn";s:6:"档案";}', 'a:1:{s:2:"cn";s:33:"管理网站中的档案与目录";}', '1.0.0', 1, 0, 1, 1, 'content', 1, 1, 1, 1462741615),
(9, 'comments', 'a:2:{s:2:"en";s:8:"Comments";s:2:"cn";s:6:"回应";}', 'a:2:{s:2:"en";s:76:"Users and guests can write comments for content like blog, pages and photos.";s:2:"cn";s:75:"用户和访客可以针对新闻、页面与照片等内容发表回应。";}', '1.0.0', 0, 0, 1, 1, 'content', 1, 1, 1, 1464039752),
(10, 'inspector', 'a:1:{s:2:"cn";s:6:"日志";}', 'a:1:{s:2:"cn";s:25:"系统错误日志报告.";}', '1.0.0', 0, 0, 1, 0, 'application', 1, 0, 1, 1462741615),
(11, 'wysiwyg', 'a:1:{s:2:"cn";s:18:"富文本编辑器";}', 'a:1:{s:2:"cn";s:51:"提供 Boone 所见即所得（WYSIWYG）编辑器.";}', '1.0.0', 0, 1, 1, 1, 'setting', 1, 1, 1, 1462741615),
(12, 'helper', 'a:1:{s:2:"cn";s:6:"帮助";}', 'a:1:{s:2:"cn";s:37:"一个能解决用户疑问的模组.";}', '1.0.0', 0, 1, 1, 1, 'content', 1, 1, 1, 1462741615),
(13, 'blog', 'a:1:{s:2:"cn";s:6:"博客";}', 'a:1:{s:2:"cn";s:43:"一个多才多艺的博客和帖子模组.";}', '1.0.0', 0, 1, 1, 0, 'content', 1, 1, 1, 1465180703),
(14, 'message', 'a:1:{s:2:"cn";s:12:"站内信息";}', 'a:1:{s:2:"cn";s:76:"管理员和用户之间的沟通信息，或用户与用户之间的沟通.";}', '1.0.0', 0, 0, 1, 0, 'data', 1, 1, 1, 1465180703);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog`
--

CREATE TABLE `boone_blog` (
  `id` int(11) NOT NULL,
  `categories` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentCount` int(11) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `previewCount` int(11) NOT NULL DEFAULT '0',
  `createOn` int(11) NOT NULL,
  `publishAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog`
--

INSERT INTO `boone_blog` (`id`, `categories`, `userId`, `slug`, `summary`, `tags`, `metaTitle`, `image`, `images`, `commentCount`, `featured`, `status`, `previewCount`, `createOn`, `publishAt`) VALUES
(3, 3, 1, '2016061817113757525599', '您相信，这些是圈套。这时，请您不要贪图小利，利令智昏，打110报警是您的第一选择。有可能的话稳住骗子，以利公安机关打击违法犯罪。', 's:6:"防骗";', '日常防骗常识', NULL, NULL, 3, 1, 0, 229, 1465208081, NULL),
(4, 6, 1, '2016070913161198495452', 'Markdown是一种轻量级的标记语言，轻到你甚至可以不叫他语言，因为Markdown很容易上手，就是简单地记住几个常用的标签用法就OK了，Markdown有诸多好处：专注于文字，简单，高效.', 's:8:"markdown";', 'Markdown 常用语法', NULL, NULL, 1, 0, 0, 207, 1465501991, NULL),
(5, 8, 1, '2016091221424048974855', '这是基于apple公测版MacOS Sierra 安装home brew 和php遇见的问题解决方案。', 's:31:"brew,homebrew,php7,MacOS Sierra";', 'MacOS Sierra(10.12) Install Homebrew and php7', NULL, NULL, 0, 0, 0, 1315, 1468039626, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog_body`
--

CREATE TABLE `boone_blog_body` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `enableComment` tinyint(1) NOT NULL DEFAULT '1',
  `updateOn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog_body`
--

INSERT INTO `boone_blog_body` (`id`, `postId`, `content`, `enableComment`, `updateOn`) VALUES
(3, 3, '&lt;p&gt;日常防骗常识&lt;/p&gt;&lt;p&gt;　　一、遇到上门推销怎么办?&lt;/p&gt;&lt;p&gt;　　生活中常遇到上门推销的情况，请记住天上不会掉馅饼，一概拒绝，不要与其纠缠，更不要开门让其进屋。&lt;/p&gt;&lt;p&gt;　　二、遇到骗门怎么办?&lt;/p&gt;&lt;p&gt;　　有陌生人称替你家人或朋友代送物品，你不妨先打个电话核实一下，问清情况后，再开门，千万不要轻信马上开门。&lt;/p&gt;&lt;p&gt;　　三、日常碰到以下情况怎么办?&lt;/p&gt;&lt;p&gt;　　1、当有人以和尚、道士、尼姑等各种名义化缘、乞讨或花言巧语说您有天灾人祸时;&lt;/p&gt;&lt;p&gt;　　2、当您在外遇到有人跟您套近乎，给您敬烟、送饮料或请您吃饭时，要婉言谢绝，警惕其中有麻醉药物;&lt;/p&gt;&lt;p&gt;　　3、当有人拿“中奖”的易拉环或其他中奖标志以低价销售，并有多人围观争相抢购时;&lt;/p&gt;&lt;p&gt;　　4、当有人持有所谓的“外币”、“金砖”、“金元宝”、“金佛像”、“古文物”、“人参”、“灵芝”等名贵药材或金银首饰，以遇有天灾人祸等理由，要与您兑换人民币时;&lt;/p&gt;&lt;p&gt;　　5、当有人以各种理由找您兑换人民币时;当有人打着“××神医”的幌子，向您收取化解“血光之灾”的费用时;&lt;/p&gt;&lt;p&gt;　　6、名烟名酒商店，一人在店子时，注意中青年男性购买大量高档香烟，特别是又要又不要时，谨防对方使用假钞。&lt;/p&gt;&lt;p&gt;　　7、取款机取款，留意身后的陌生人，注意输入密码时，防止他人偷看，取款完毕及时抽回银行卡&lt;/p&gt;&lt;p&gt;　　您相信，这些是圈套。这时，请您不要贪图小利，利令智昏，打110报警是您的第一选择。有可能的话稳住骗子，以利公安机关打击违法犯罪。&lt;/p&gt;', 1, 1466241097),
(4, 4, '&lt;p&gt;现在Markdown特别流行阿！支持很多社交平台开始对此支持。也确实很轻量级！比如简书&lt;/p&gt;&lt;p&gt;以下的符号请全部以英文输入法为准！！！&lt;/p&gt;&lt;p&gt;下面来详细说说那几个标签（真的只有几个）：&lt;/p&gt;&lt;p&gt;常用标题&lt;/p&gt;&lt;pre&gt;&lt;code&gt;&lt;em&gt;&lt;span&gt;# 代表h1（一级标题）     ## 代表h2（二级标题）     ###代表h3（三级标题） &lt;/span&gt;&lt;/em&gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;效果是这样的：&lt;/p&gt;&lt;h1&gt;代表h1（一级标题）&lt;/h1&gt;&lt;h2&gt;代表h2（二级标题）&lt;/h2&gt;&lt;h3&gt;代表H3（三级标题）&lt;/h3&gt;&lt;p&gt;链接（有两种写法）&lt;/p&gt;&lt;p&gt;第一种&lt;code&gt;[text](url)&lt;/code&gt;：&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    &lt;span class=&quot;hljs-attr_selector&quot;&gt;[text]&lt;/span&gt;(&lt;span class=&quot;hljs-tag&quot;&gt;url&lt;/span&gt;)     比如说：&lt;span class=&quot;hljs-attr_selector&quot;&gt;[itousu]&lt;/span&gt;(&lt;span class=&quot;hljs-rule&quot;&gt;&lt;span class=&quot;hljs-attribute&quot;&gt;http&lt;/span&gt;:&lt;span class=&quot;hljs-value&quot;&gt;//itousu.net)&lt;/span&gt;&lt;/span&gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;第二种&lt;code&gt;[text][id] [id]:url&lt;/code&gt;：&lt;/p&gt;&lt;pre&gt;&lt;code&gt;     &lt;span class=&quot;hljs-attr_selector&quot;&gt;[text]&lt;/span&gt;&lt;span class=&quot;hljs-attr_selector&quot;&gt;[id]&lt;/span&gt;          &lt;span class=&quot;hljs-attr_selector&quot;&gt;[id]&lt;/span&gt;&lt;span class=&quot;hljs-pseudo&quot;&gt;:url&lt;/span&gt; &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;比如说：&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    &lt;span class=&quot;hljs-attr_selector&quot;&gt;[itousu]&lt;/span&gt;&lt;span class=&quot;hljs-attr_selector&quot;&gt;[1]&lt;/span&gt;          &lt;span class=&quot;hljs-attr_selector&quot;&gt;[1]&lt;/span&gt;: &lt;span class=&quot;hljs-rule&quot;&gt;&lt;span class=&quot;hljs-attribute&quot;&gt;http&lt;/span&gt;:&lt;span class=&quot;hljs-value&quot;&gt;//itousu.net &lt;/span&gt;&lt;/span&gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;text代表你要链接的文字，URL就是连接地址，第二种的id你可以随便定，但建议是用数字就OK，而且在段落中也推荐使用第二种方法并且把&lt;br&gt;[id]:url放在段落之后；因为链接很多时候都很长，会影响编写文档的美感。而且这样反而会更高效.以上效果是这样的：&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;https://itousu.net&quot;&gt;投诉网 诚信公益平台&lt;/a&gt;&lt;/p&gt;&lt;p&gt;插入图片&lt;code&gt;![](image-url)&lt;/code&gt;：&lt;/p&gt;&lt;p&gt;跟链接的第一种方式很像&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    !&lt;span class=&quot;hljs-attr_selector&quot;&gt;[]&lt;/span&gt;(&lt;span class=&quot;hljs-tag&quot;&gt;image-url&lt;/span&gt;) &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;比如&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    !&lt;span class=&quot;hljs-attr_selector&quot;&gt;[]&lt;/span&gt;(&lt;span class=&quot;hljs-rule&quot;&gt;&lt;span class=&quot;hljs-attribute&quot;&gt;http&lt;/span&gt;:&lt;span class=&quot;hljs-value&quot;&gt;//itousu.net/images.svg) \r\n&lt;/span&gt;&lt;/span&gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;加粗&lt;code&gt;****&lt;/code&gt;：&lt;br&gt;&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    **这是要加粗的文字**   四个星号中间就是你要加粗的内容 &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;我觉得这一个就够了，效果：&lt;/p&gt;&lt;p&gt;这是要加粗的文字 四个星号中间就是你要加粗的内容&lt;/p&gt;&lt;p&gt;斜体&lt;code&gt;**&lt;/code&gt;：&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    *这是你要斜体的文字*   两个星号中间就是要斜体的文字 &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;也是这个就够了，效果如下：&lt;/p&gt;&lt;p&gt;&lt;em&gt;这是你要斜体的文字&lt;/em&gt; 两个星号中间就是要斜体的文字&lt;/p&gt;&lt;h4&gt;无序列表:*&lt;/h4&gt;&lt;pre&gt;&lt;code&gt;    * 无序列表内容1     * 无序列表内容2     * 无序列表内容3     一个星号加一个空格，注意星号与文字之间有一个空格 &lt;/code&gt;&lt;/pre&gt;&lt;h5&gt;效果：&lt;/h5&gt;&lt;ul&gt;&lt;li&gt;无序列表内容1&lt;/li&gt;&lt;li&gt;无序列表内容2&lt;/li&gt;&lt;li&gt;无序列表内容3&lt;/li&gt;&lt;/ul&gt;&lt;h4&gt;有序列表：&lt;/h4&gt;&lt;pre&gt;&lt;code&gt;    1. 有序列表内容1     2. 有序列表内容2     3. 有序列表内容3     一个数字加一个点，文子与点之间有一个空格 &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;效果是这样的：&lt;/p&gt;&lt;ol&gt;&lt;li&gt;有序列表内容1&lt;/li&gt;&lt;li&gt;有序列表内容2&lt;/li&gt;&lt;li&gt;有序列表内容3&lt;/li&gt;&lt;/ol&gt;&lt;h5&gt;引用&gt;：&lt;/h5&gt;&lt;pre&gt;&lt;code&gt;    &gt;这是你要引用的内容 &lt;/code&gt;&lt;/pre&gt;&lt;p&gt;向右的尖括号表示引用&lt;/p&gt;&lt;p&gt;效果：&lt;/p&gt;&lt;p&gt;这是你要引用的内容&lt;/p&gt;&lt;p&gt;水平分割线&lt;code&gt;***&lt;/code&gt;：&lt;/p&gt;&lt;pre&gt;&lt;code&gt;    ***这是一条水平分割线&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;用连续的三个星号表示&lt;/p&gt;&lt;p&gt;效果：&lt;/p&gt;&lt;hr&gt;&lt;h4&gt;代码插入:&lt;/h4&gt;&lt;p&gt;&lt;span xss=&quot;removed&quot;&gt;&lt;span xss=&quot;removed&quot;&gt;&lt;span xss=&quot;removed&quot;&gt;代码写在`&lt;span class=&quot;javascript&quot; xss=&quot;removed&quot;&gt;这里是你要写的代码&lt;/span&gt;`之间，``号（windows下）就是ESC下面的那个按键，如果是代码块，请放在六个这个符号中间，然后按Tab缩进 &lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;pre&gt;``` php\r\n\r\nclass demo {\r\n    # code ...  \r\n}\r\n\r\n```&lt;/pre&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h5&gt;效果 :&lt;/h5&gt;&lt;pre&gt;&amp;lt;?php\r\n\r\nclass demo {\r\n    # code ...\r\n}&lt;/pre&gt;&lt;h5&gt;总结一下：&lt;/h5&gt;&lt;p&gt;其实Markdown语法无非就是几个常用的符号： &lt;code&gt;#&lt;/code&gt;,&lt;code&gt;*&lt;/code&gt;,&lt;code&gt;()&lt;/code&gt;,&lt;code&gt;[]&lt;/code&gt;, &lt;code&gt;&gt;&lt;/code&gt;&lt;/p&gt;&lt;p&gt;五个常用的而已，他们的组合也不多，就上面的介绍几个，把他们用熟练，对于个人的写作效率会有很大的提升。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, 1468041371),
(5, 5, '&lt;p xss=&quot;removed&quot;&gt;下载MacOS Sierra 请到apple官方下载。&lt;a href=&quot;https://beta.appple.com&quot;&gt;https://beta.appple.com&lt;/a&gt;&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;不是开发者，普通用户也可以登陆apple id下载安装。&lt;/p&gt;&lt;h4 xss=&quot;removed&quot;&gt;1. 安装xcode8 beta2，安装完成后打开terminal 输入以下命令安装。&lt;/h4&gt;&lt;pre xss=&quot;removed&quot;&gt;xcode-select --install&lt;/pre&gt;&lt;h4 xss=&quot;removed&quot;&gt;2.下载homebrew &lt;/h4&gt;&lt;p xss=&quot;removed&quot;&gt;官网：&lt;a href=&quot;http://brew.sh&quot;&gt;http://brew.sh&lt;/a&gt;&lt;/p&gt;&lt;pre xss=&quot;removed&quot;&gt;/usr/bin/ruby -e &quot;$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)&quot;\r\n&lt;/pre&gt;&lt;p&gt;3. 安装php&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/1ccd8889032259ea4ca6a748910a1365.png&quot;&gt;&lt;/p&gt;&lt;pre&gt;brew install homebrew/php/php71&lt;/pre&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/210d6bfbdef219066861dbdbeb2f9aa0.png&quot;&gt;&lt;/p&gt;&lt;p&gt;错误解决&lt;/p&gt;&lt;pre&gt;brew install homebrew/apache/httpd24\r\n&lt;/pre&gt;&lt;p&gt;再次安装&lt;/p&gt;&lt;pre&gt;brew install homebrew/php/php71&lt;/pre&gt;&lt;p&gt;安装成功&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/bcc3f2ab8bc624612a2f5a6987e9b3ae.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;pre&gt;To enable PHP in Apache add the following to httpd.conf and restart Apache:\r\n\r\n    LoadModule php7_module    /usr/local/opt/php71/libexec/apache2/libphp7.so\r\n\r\n    \r\n\r\n    &lt;FilesMatch&gt;\r\n\r\n        SetHandler application/x-httpd-php\r\n\r\n    &lt;/FilesMatch&gt;\r\n\r\n\r\n\r\n\r\nFinally, check DirectoryIndex includes index.php\r\n\r\n    DirectoryIndex index.php index.html\r\n\r\n\r\n\r\n\r\nThe php.ini file can be found in:\r\n\r\n    /usr/local/etc/php/7.1/php.ini\r\n\r\n\r\n&lt;/pre&gt;&lt;pre&gt;✩✩✩✩ Extensions ✩✩✩✩\r\n\r\n\r\n\r\n\r\nIf you are having issues with custom extension compiling, ensure that\r\n\r\nyou are using the brew version, by placing /usr/local/bin before /usr/sbin in your PATH:\r\n\r\n\r\n\r\n\r\n      PATH=&quot;/usr/local/bin:$PATH&quot;\r\n\r\n\r\n\r\n\r\nPHP71 Extensions will always be compiled against this PHP. Please install them\r\n\r\nusing --without-homebrew-php to enable compiling against system PHP.\r\n\r\n\r\n\r\n\r\n✩✩✩✩ PHP CLI ✩✩✩✩\r\n\r\n\r\n\r\n\r\nIf you wish to swap the PHP you use on the command line, you should add the following to ~/.bashrc,\r\n\r\n~/.zshrc, ~/.profile or your shell\'s equivalent configuration file:\r\n\r\n\r\n\r\n\r\n      export PATH=&quot;$(brew --prefix homebrew/php/php71)/bin:$PATH&quot;\r\n\r\n\r\n\r\n\r\n✩✩✩✩ FPM ✩✩✩✩\r\n\r\n\r\n\r\n\r\nTo launch php-fpm on startup:\r\n\r\n    mkdir -p ~/Library/LaunchAgents\r\n\r\n    cp /usr/local/opt/php71/homebrew.mxcl.php71.plist ~/Library/LaunchAgents/\r\n\r\n    launchctl load -w ~/Library/LaunchAgents/homebrew.mxcl.php71.plist\r\n\r\n\r\n\r\n\r\nThe control script is located at /usr/local/opt/php71/sbin/php71-fpm\r\n\r\n\r\n\r\n\r\nOS X 10.8 and newer come with php-fpm pre-installed, to ensure you are using the brew version you need to make sure /usr/local/sbin is before /usr/sbin in your PATH:\r\n\r\n\r\n\r\n\r\n  PATH=&quot;/usr/local/sbin:$PATH&quot;&lt;/pre&gt;', 1, 1473687760);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog_categories`
--

CREATE TABLE `boone_blog_categories` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog_categories`
--

INSERT INTO `boone_blog_categories` (`id`, `userId`, `name`, `description`) VALUES
(3, 1, 'Live', NULL),
(5, 1, 'PHP', NULL),
(6, 1, 'Editor', NULL),
(8, 1, 'MacOS', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog_heart_log`
--

CREATE TABLE `boone_blog_heart_log` (
  `id` int(11) NOT NULL,
  `sendUser` int(11) NOT NULL,
  `concernUser` int(11) NOT NULL,
  `createOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog_heart_log`
--

INSERT INTO `boone_blog_heart_log` (`id`, `sendUser`, `concernUser`, `createOn`) VALUES
(1, 4, 1, 1465186903),
(2, 1, 1, 1465187227),
(3, 31, 1, 1465863589);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog_settings`
--

CREATE TABLE `boone_blog_settings` (
  `id` int(11) NOT NULL,
  `blogName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `concern` int(11) NOT NULL DEFAULT '0',
  `blogCount` int(11) NOT NULL DEFAULT '0',
  `domain` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankCard` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `reward` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(8,2) NOT NULL DEFAULT '1.00',
  `bio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog_settings`
--

INSERT INTO `boone_blog_settings` (`id`, `blogName`, `userId`, `concern`, `blogCount`, `domain`, `bank`, `bankCard`, `theme`, `reward`, `price`, `bio`, `createOn`) VALUES
(1, '◈决战天下♡', 1, 5, 0, 'yong', 'ccb', '', 'default', 1, '1.00', '劳动和人，人和劳动，这是所有真理的父母亲。', 1465180838);

-- --------------------------------------------------------

--
-- 表的结构 `boone_blog_tags`
--

CREATE TABLE `boone_blog_tags` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `item` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_blog_tags`
--

INSERT INTO `boone_blog_tags` (`id`, `postId`, `item`) VALUES
(10, 3, '防骗'),
(31, 4, 'markdown'),
(32, 5, 'brew'),
(33, 5, 'homebrew'),
(34, 5, 'php7'),
(35, 5, 'MacOS Sierra');

-- --------------------------------------------------------

--
-- 表的结构 `boone_comments`
--

CREATE TABLE `boone_comments` (
  `id` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  `isTeam` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(52) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(52) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `urlSlug` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(52) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public',
  `createdOn` int(11) NOT NULL,
  `approvalCount` int(11) NOT NULL DEFAULT '0',
  `contraCount` int(11) NOT NULL DEFAULT '0',
  `ipAddress` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_comments`
--

INSERT INTO `boone_comments` (`id`, `isActive`, `userId`, `isTeam`, `email`, `title`, `urlSlug`, `content`, `module`, `createdOn`, `approvalCount`, `contraCount`, `ipAddress`) VALUES
(1, 1, 1, 0, '', '', 14, '测试留言', 'post', 1464516021, 0, 0, '中国广东省&nbsp;移动'),
(2, 1, 1, 0, '', '', 14, '请认真描述您的内容, 非相关话题请勿介入.\r\n', 'post', 1464516042, 0, 0, '中国广东省&nbsp;移动'),
(3, 1, 1, 0, '', '', 15, '莆田系，天理难容竟逍遥法外这么多年，包括魏泽西事件后，仍看不到什么大动作？', 'post', 1464643052, 0, 0, '中国广东省深圳市&nbsp;电信'),
(4, 1, 1, 0, '', '', 3, '测试一条留言信息', 'blog', 1465185120, 1, 0, '中国广东省深圳市&nbsp;电信'),
(5, 1, 4, 0, '', '', 3, '我也来了。。。。', 'blog', 1465186788, 1, 0, '中国广东省深圳市&nbsp;电信'),
(6, 1, 1, 0, '', '', 3, '手机车测试效果', 'blog', 1465203794, 1, 0, '中国贵州省贵阳市&nbsp;联通'),
(7, 1, 1, 0, '', '', 4, 'markdown还是非常简单的，在文字编辑的时候我们明显也要比编辑快速很多呀。这个也是一种趋势！投诉网留言板也将支持emoji表情和markdown留言', 'blog', 1465502450, 0, 0, '中国广东省深圳市&nbsp;电信'),
(10, 1, 1, 0, '', '', 1, '请大家认真描述咋骗经过，越详细越好。您可以在用户中心申请帮助。lics团队帮助您解决当前的困惑。', 'honesty', 1465807175, 0, 0, '中国广东省深圳市&nbsp;电信'),
(11, 1, 1, 0, '', '', 1, '请务必填写所有真实信息，以便帮助您更快速的解决问题。', 'honesty', 1465807631, 0, 0, '中国广东省深圳市&nbsp;电信');

-- --------------------------------------------------------

--
-- 表的结构 `boone_comment_log`
--

CREATE TABLE `boone_comment_log` (
  `id` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `approval` tinyint(1) NOT NULL DEFAULT '0',
  `contra` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_comment_log`
--

INSERT INTO `boone_comment_log` (`id`, `commentId`, `userId`, `approval`, `contra`) VALUES
(1, 4, 1, 1, 0),
(2, 5, 4, 1, 0),
(3, 6, 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `boone_comment_reply`
--

CREATE TABLE `boone_comment_reply` (
  `id` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT '0',
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parentId` int(11) NOT NULL,
  `createdOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `boone_files`
--

CREATE TABLE `boone_files` (
  `id` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `folderId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  `memberId` int(11) NOT NULL DEFAULT '0',
  `type` enum('a','v','d','i','o','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `width` int(5) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `filesize` int(11) NOT NULL DEFAULT '0',
  `altAttribute` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `downloadCount` int(11) NOT NULL DEFAULT '0',
  `createOn` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_files`
--

INSERT INTO `boone_files` (`id`, `folderId`, `userId`, `memberId`, `type`, `name`, `filename`, `path`, `description`, `extension`, `mimetype`, `keywords`, `width`, `height`, `filesize`, `altAttribute`, `downloadCount`, `createOn`, `sort`) VALUES
('054def24ccd0dd5', 1, 1, 0, 'i', '2BF2EA86A28911410DDFA682B9DC49D7.jpg', '9319f1a74c79fab82991c7a53db32afd.jpg', '/uploads/users/images/1f160638/9319f1a74c79fab82991c7a53db32afd.jpg', '', '.jpg', 'image/jpeg', '', 550, 733, 58, NULL, 0, 1463931915, 0),
('1fa668372302873', 1, 1, 0, 'i', '24D62AF1618ACEA4EF54CCC7539F75CE_(1).jpg', '97d0846fa767d84960fd4172c508d951.jpg', '/uploads/users/images/1f160638/97d0846fa767d84960fd4172c508d951.jpg', '', '.jpg', 'image/jpeg', '', 550, 413, 39, NULL, 0, 1463931915, 0),
('207ee142662184e', 1, 1, 0, 'i', 'Screen_Shot_2016-07-09_at_12_29_10_PM.png', 'bcc3f2ab8bc624612a2f5a6987e9b3ae.png', '/uploads/users/images/1f160638/bcc3f2ab8bc624612a2f5a6987e9b3ae.png', '', '.png', 'image/png', '', 1876, 470, 275, NULL, 0, 1468039845, 0),
('21d291ba3453279', 1, 1, 0, 'i', '4F8B4A89B2DBF748DF90F3FD54FB4F5C.jpg', '250ca8ad14aabae08f09baaa0fd24f45.jpg', '/uploads/users/images/1f160638/250ca8ad14aabae08f09baaa0fd24f45.jpg', '', '.jpg', 'image/jpeg', '', 1920, 1441, 416, NULL, 0, 1467796748, 0),
('289601730feb244', 1, 1, 0, 'i', 'afsdfs-2.jpg', '2763e97f69ec620649d4ffff6caa2233.jpg', '/uploads/users/images/1f160638/2763e97f69ec620649d4ffff6caa2233.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 22, NULL, 0, 1462185980, 0),
('3268901bbb7488d', 1, 1, 0, 'i', '6Qgg-fxsqxxu4409187.jpg', '291bfb4759e2ee8be2e85d6a1e83e3bf.jpg', '/uploads/users/images/1f160638/291bfb4759e2ee8be2e85d6a1e83e3bf.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 129, NULL, 0, 1464203210, 0),
('32cd6d034c5cf55', 1, 31, 0, 'i', 'IMAG2268.jpg', '49a0e81779c0270dcb0bd701af51bb49.jpg', '/uploads/users/images/3c40a88e/49a0e81779c0270dcb0bd701af51bb49.jpg', '', '.jpg', 'image/jpeg', '', 3136, 4224, 2545, NULL, 0, 1465863464, 0),
('362a1eecdc8ddf3', 1, 1, 0, 'i', 'banner.png', 'af51d098d0932ecfbbdae5a9317c231c.png', '/uploads/users/images/1f160638/af51d098d0932ecfbbdae5a9317c231c.png', '', '.png', 'image/png', '', 2048, 1260, 311, NULL, 0, 1462381467, 0),
('3861f7f834c285d', 1, 1, 0, 'i', '4C0498707F0C249FB792050179889343.jpg', '6f0055577bd3ac86a476b3d258d42dfb.jpg', '/uploads/users/images/1f160638/6f0055577bd3ac86a476b3d258d42dfb.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 88, NULL, 0, 1464025667, 0),
('399d2378b13128b', 1, 1, 0, 'i', '135080419.jpg', 'fefca16b9e489fce07927aa41bd00652.jpg', '/uploads/users/images/1f160638/fefca16b9e489fce07927aa41bd00652.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 65, NULL, 0, 1464726457, 0),
('442b2d84c8bf438', 1, 1, 0, 'i', 'Photo_on_9-9-16_at_11_13_PM_2.jpg', 'd9819b0bb43ad99b3e376c21d37a5147.jpg', '/uploads/users/images/1f160638/d9819b0bb43ad99b3e376c21d37a5147.jpg', '', '.jpg', 'image/jpeg', '', 1080, 720, 422, NULL, 0, 1474569954, 0),
('5266198e93892db', 1, 1, 0, 'i', 'QQ20160613-2@2x.png', 'f8ddca3bcc56f2821fdd40cb2ea9a319.png', '/uploads/users/images/1f160638/f8ddca3bcc56f2821fdd40cb2ea9a319.png', '', '.png', 'image/png', '', 2332, 668, 124, NULL, 0, 1465806688, 0),
('54cac1696acee73', 1, 1, 0, 'i', '24D62AF1618ACEA4EF54CCC7539F75CE.jpg', '3b01e40258e036f7a6f4d1efeae695df.jpg', '/uploads/users/images/1f160638/3b01e40258e036f7a6f4d1efeae695df.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 97, NULL, 0, 1463931823, 0),
('60842a73aaa2a50', 1, 31, 0, 'i', 'IMAG2269.jpg', 'b70fc16777cdc464566f6412f80dad4e.jpg', '/uploads/users/images/3c40a88e/b70fc16777cdc464566f6412f80dad4e.jpg', '', '.jpg', 'image/jpeg', '', 3136, 4224, 2713, NULL, 0, 1465863424, 0),
('628d27a1e8c3e80', 1, 1, 0, 'i', '0-3.jpeg', '8b6930d4ddc8ba0284b99427be5cb5df.jpeg', '/uploads/users/images/1f160638/8b6930d4ddc8ba0284b99427be5cb5df.jpeg', '', '.jpeg', 'image/jpeg', '', 600, 800, 62, NULL, 0, 1463390277, 0),
('6a97192775d2f2b', 1, 1, 0, 'i', 'front-cover.png', 'f549024fe1ac2da6402e61c834a57882.png', '/uploads/users/images/1f160638/f549024fe1ac2da6402e61c834a57882.png', '', '.png', 'image/png', '', 720, 340, 9, NULL, 0, 1463240174, 0),
('751cc17df1d51de', 1, 1, 0, 'i', 'Isles.jpg', '146f2d56e4d571d457c9ff3ac5dd88a7.jpg', '/uploads/users/images/1f160638/146f2d56e4d571d457c9ff3ac5dd88a7.jpg', '', '.jpg', 'image/jpeg', '', 3200, 2000, 1870, NULL, 0, 1462805675, 0),
('7662ae1d96871eb', 1, 1, 0, 'i', '3B5F1F68D3EC5DDE4D0E5B6464333D9B.jpg', '982e0625e22e1e4020c0bfeb322a5020.jpg', '/uploads/users/images/1f160638/982e0625e22e1e4020c0bfeb322a5020.jpg', '', '.jpg', 'image/jpeg', '', 550, 322, 38, NULL, 0, 1464109962, 0),
('7ac8a0ad9e08e6f', 1, 1, 0, 'i', '0-5.jpeg', 'afb75299426f0e06431a7f06fec8088c.jpeg', '/uploads/users/images/1f160638/afb75299426f0e06431a7f06fec8088c.jpeg', '', '.jpeg', 'image/jpeg', '', 600, 800, 75, NULL, 0, 1463390279, 0),
('8f9458cb8f3918f', 1, 1, 0, 'i', 'QQ20160613-1@2x.png', '17afc410607c7c117adc04722d309458.png', '/uploads/users/images/1f160638/17afc410607c7c117adc04722d309458.png', '', '.png', 'image/png', '', 2294, 1270, 166, NULL, 0, 1465806692, 0),
('933e3393129ea8a', 1, 1, 0, 'i', 'bg.jpg', '0b65fc175b6e1298a691d9ae89e62ecc.jpg', '/uploads/users/images/1f160638/0b65fc175b6e1298a691d9ae89e62ecc.jpg', '', '.jpg', 'image/jpeg', '', 2540, 1422, 672, NULL, 0, 1462382327, 0),
('9798897959083eb', 1, 1, 0, 'i', 'QQ20160613-5@2x.png', 'f999d4cefc7c4b147b8af4675b04654c.png', '/uploads/users/images/1f160638/f999d4cefc7c4b147b8af4675b04654c.png', '', '.png', 'image/png', '', 2396, 1468, 277, NULL, 0, 1465806691, 0),
('98233a13e609ded', 1, 1, 0, 'i', 'banner.png', 'b19bfee1aa8f8dbf44268f1133eda552.png', '/uploads/users/images/1f160638/b19bfee1aa8f8dbf44268f1133eda552.png', '', '.png', 'image/png', '', 2048, 1260, 311, NULL, 0, 1461968726, 0),
('98e1705d2b95705', 1, 1, 0, 'i', 'avd.jpg', '014d89cf517244b2fa248fe746512534.jpg', '/uploads/users/images/1f160638/014d89cf517244b2fa248fe746512534.jpg', '', '.jpg', 'image/jpeg', '', 2540, 1429, 1380, NULL, 0, 1462892203, 0),
('9ea4cf9d00a8b91', 1, 1, 0, 'i', 'QQ20160613-3@2x.png', 'f2cad27a43d50a0d1cb1513dc5b75341.png', '/uploads/users/images/1f160638/f2cad27a43d50a0d1cb1513dc5b75341.png', '', '.png', 'image/png', '', 2486, 738, 212, NULL, 0, 1465806689, 0),
('a5e4b5296fbe547', 1, 1, 0, 'i', '20160509031707d0e0d.jpg', 'cef5efb4107e23753293dcc8e8b5d9b6.jpg', '/uploads/users/images/1f160638/cef5efb4107e23753293dcc8e8b5d9b6.jpg', '', '.jpg', 'image/jpeg', '', 337, 600, 138, NULL, 0, 1462742046, 0),
('b4c3b27a31eb9d1', 1, 1, 0, 'i', 'Screen_Shot_2016-07-09_at_12_27_00_PM.png', '1ccd8889032259ea4ca6a748910a1365.png', '/uploads/users/images/1f160638/1ccd8889032259ea4ca6a748910a1365.png', '', '.png', 'image/png', '', 1830, 762, 464, NULL, 0, 1468039324, 0),
('bd1212f0edec0f6', 1, 1, 0, 'i', 'QQ20160501-0@2x-2.png', '493b94920406aa1da57a54fcad9d9aa6.png', '/uploads/users/images/1f160638/493b94920406aa1da57a54fcad9d9aa6.png', '', '.png', 'image/png', '', 720, 341, 45, NULL, 0, 1462085446, 0),
('c06a6111e71b3d6', 1, 1, 0, 'i', 'D1FE5961F3EB0A6DAB5C7B312D4CA31C.jpg', 'ca5effa92cabfc73c8f32a37cf99471d.jpg', '/uploads/users/images/1f160638/ca5effa92cabfc73c8f32a37cf99471d.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 99, NULL, 0, 1464109784, 0),
('c29d0e0dcd3bc64', 1, 1, 0, 'i', 'front-cover.png', '5356382fe21f288df621518b014d2e71.png', '/uploads/users/images/1f160638/5356382fe21f288df621518b014d2e71.png', '', '.png', 'image/png', '', 720, 340, 9, NULL, 0, 1462382341, 0),
('c6048f9bfb8c0d0', 1, 1, 0, 'i', 'QQ20160521-0@2x.png', '916558545266fc236e0a580893fb506f.png', '/uploads/users/images/1f160638/916558545266fc236e0a580893fb506f.png', '', '.png', 'image/png', '', 1440, 680, 172, NULL, 0, 1463821232, 0),
('c86ca52e5e327d0', 1, 1, 0, 'i', 'IMG_0023.png', '51568dc9ab3fb52ed6bc995160401d49.png', '/uploads/users/images/1f160638/51568dc9ab3fb52ed6bc995160401d49.png', '', '.png', 'image/png', '', 750, 1334, 1080, NULL, 0, 1468559549, 0),
('ca2dcba071d3ada', 1, 31, 0, 'i', 'IMAG2269.jpg', '10ffbdaa73167ad7ab6b97c548fa00fe.jpg', '/uploads/users/images/3c40a88e/10ffbdaa73167ad7ab6b97c548fa00fe.jpg', '', '.jpg', 'image/jpeg', '', 3136, 4224, 2713, NULL, 0, 1465863483, 0),
('cda30414db13487', 1, 1, 0, 'i', 'IMG_0077.png', '863c9137fab2a534f3650d9d4b400822.png', '/uploads/users/images/1f160638/863c9137fab2a534f3650d9d4b400822.png', '', '.png', 'image/png', '', 750, 1334, 805, NULL, 0, 1468559549, 0),
('cef2bb58d01fe63', 1, 1, 0, 'i', 'nvzibeipian.jpg', '63bcb5006117152a65c0c716650f288d.jpg', '/uploads/users/images/1f160638/63bcb5006117152a65c0c716650f288d.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 121, NULL, 0, 1462300609, 0),
('d600d0bf7fcd830', 1, 1, 0, 'i', 'meituan-2.jpg', 'b9d8c4b8aa02df97f5928067f35e640e.jpg', '/uploads/users/images/1f160638/b9d8c4b8aa02df97f5928067f35e640e.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 35, NULL, 0, 1462222460, 0),
('d6dd07f63f9d151', 1, 1, 0, 'i', '20160509031709311d0-2.jpg', '08dabb5dfdd760cbcefc2bb3547f9d76.jpg', '/uploads/users/images/1f160638/08dabb5dfdd760cbcefc2bb3547f9d76.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 41, NULL, 0, 1462741977, 0),
('d7001daf25ce3bc', 1, 1, 0, 'i', '0-4.jpeg', '3b052bc35e574fd73e19a17282bc800b.jpeg', '/uploads/users/images/1f160638/3b052bc35e574fd73e19a17282bc800b.jpeg', '', '.jpeg', 'image/jpeg', '', 600, 449, 44, NULL, 0, 1463390278, 0),
('de6319fe8342dde', 1, 1, 0, 'i', '20160525091100b94e7.jpg', '091811ab42f4fba3b0903e7a662e6488.jpg', '/uploads/users/images/1f160638/091811ab42f4fba3b0903e7a662e6488.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 97, NULL, 0, 1464642834, 0),
('e5aa4866ad44243', 1, 1, 0, 'i', 'wanggounotice-2.jpg', 'dd740a7b659e629892e5f50e99297641.jpg', '/uploads/users/images/1f160638/dd740a7b659e629892e5f50e99297641.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 56, NULL, 0, 1462423273, 0),
('ea8ff4c3b5a4b44', 1, 1, 0, 'i', 'QQ20160613-0@2x.png', 'e9ddc7337b7a0fe72a55dabc234e1e03.png', '/uploads/users/images/1f160638/e9ddc7337b7a0fe72a55dabc234e1e03.png', '', '.png', 'image/png', '', 1604, 550, 76, NULL, 0, 1465806687, 0),
('ee9b35d8389b8f7', 1, 1, 0, 'i', '0-2.jpeg', 'c02acac0647b3c8cb9810c7f6a540ed3.jpeg', '/uploads/users/images/1f160638/c02acac0647b3c8cb9810c7f6a540ed3.jpeg', '', '.jpeg', 'image/jpeg', '', 600, 450, 52, NULL, 0, 1463390278, 0),
('eef5b5af5bbd15f', 1, 1, 0, 'i', 'Screen_Shot_2016-07-09_at_12_27_45_PM.png', '210d6bfbdef219066861dbdbeb2f9aa0.png', '/uploads/users/images/1f160638/210d6bfbdef219066861dbdbeb2f9aa0.png', '', '.png', 'image/png', '', 2504, 696, 368, NULL, 0, 1468039452, 0),
('f480b06c5a21faa', 1, 1, 0, 'i', 'u3839585668,3640261800fm21gp0.jpg', 'c740f00250343fe1a75b14d3abd98f4c.jpg', '/uploads/users/images/1f160638/c740f00250343fe1a75b14d3abd98f4c.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 79, NULL, 0, 1464395117, 0),
('f6d1087a940e7d2', 1, 1, 0, 'i', 'QQ20160613-4@2x.png', '02453732dfe9b17eb408866b342365a1.png', '/uploads/users/images/1f160638/02453732dfe9b17eb408866b342365a1.png', '', '.png', 'image/png', '', 2286, 1354, 196, NULL, 0, 1465806692, 0),
('fa69898f61952f5', 1, 1, 0, 'i', 'IMG_0001.jpg', 'c5f8a6e530c8af51d3516de68484c03c.jpg', '/uploads/users/images/1f160638/c5f8a6e530c8af51d3516de68484c03c.jpg', '', '.jpg', 'image/jpeg', '', 2048, 1536, 780, NULL, 0, 1468559564, 0),
('fb10a5c267b302c', 1, 1, 0, 'i', 'shaokaoge.jpg', '50edc267d2f0740624d7df6859233765.jpg', '/uploads/users/images/1f160638/50edc267d2f0740624d7df6859233765.jpg', '', '.jpg', 'image/jpeg', '', 720, 340, 96, NULL, 0, 1463390101, 0);

-- --------------------------------------------------------

--
-- 表的结构 `boone_file_folders`
--

CREATE TABLE `boone_file_folders` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'local',
  `location` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'local',
  `createOn` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_file_folders`
--

INSERT INTO `boone_file_folders` (`id`, `slug`, `name`, `description`, `format`, `location`, `createOn`, `sort`) VALUES
(1, 'images', '图片', '', 'jpg,png,svg,jpeg', 'local', 1460882419, 1460882419),
(2, 'docments', 'docments', '', 'doc,word,pages,number,text,json', 'local', 1465200721, 1465200721),
(3, 'git', 'git', '', 'gif', 'local', 1471158658, 1471158658),
(4, 'sdfdsafsdf', 'sdfdsafsdf', '', 'gif,doc,php,json', 'local', 1471159039, 1471159039);

-- --------------------------------------------------------

--
-- 表的结构 `boone_helper`
--

CREATE TABLE `boone_helper` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `categories` int(11) NOT NULL,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metaKeyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `usefulCount` int(11) NOT NULL DEFAULT '0',
  `uselessCount` int(11) NOT NULL DEFAULT '0',
  `createOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_helper`
--

INSERT INTO `boone_helper` (`id`, `adminId`, `slug`, `categories`, `metaTitle`, `metaKeyword`, `featured`, `content`, `usefulCount`, `uselessCount`, `createOn`) VALUES
(1, 1, 'create-honesty-type', 3, '发起类型', '投诉规定,发起,发布', 0, '<h3>发布投诉信息需要遵循以下规范</h3><h4></h4><ul><li>发起人必须满18岁周岁。</li><li>发起人必须通过投诉网实名认证。</li><li>发起事件信息必须是在中国大陆发生的，暂时不开放或者接受港澳台地区投诉事件受理。</li><li>发起事件信息必须真实有效，上传证据的照片不能通过图片编辑软件处理。</li><li>发起事件信息必须详细，有调理。且能得到更多帮助</li><li>发起事件信息必须包含证据，包含合同（含有盖章签字）、网络诈骗包涵聊天记录且自行备份保存。</li></ul>', 0, 0, 1463445756),
(2, 1, 'disable-create-event', 3, '禁止发起事件', '禁止,不能违规', 0, '<h4>发布以下信息将面临投诉网停止服务或冻结审核帐号。</h4>\r\n\r\n<p class="text-danger"><strong>以下行为直接冻结账户或接受法律处罚</strong></p>\r\n\r\n\r\n\r\n<ul><li>对他人进行诽谤的</li><li>发布虚假信息</li><li>不正当非法行为</li><li>造成对他人直接伤害的</li></ul><p><strong>以下行为提供更多信息审核账户</strong></p><ol><li>未满18岁发起投诉事件</li><li>对发起投诉事件不确定性的</li><li>双方产生误会发起投诉事件的</li></ol>', 0, 0, 1463446207),
(3, 1, 'who-can-use', 1, '哪些人能使用？', '投诉网使用,使用群体', 0, '<h2 class="text-center">平台使用及相关人群</h2>\r\n\r\n<p>“<strong class="text-success redactor-inline-converted">投诉网·诚信公益平台</strong>“通过网站、微信等，为有投诉网需求的自然人、法人及其他组织提供信息发布、维权删除信息等相关信息服务。</p>\r\n\r\n\r\n\r\n<p><strong class="text-danger">以下人员不得使用投诉网</strong></p>\r\n\r\n\r\n\r\n<ul><li>政府工作人员，包含国有企业工作人员。职业大小不分！如有案情请直接法律诉讼</li><li>军人。不包含退队人员。</li><li>正在受刑法人员。</li></ul>', 0, 0, 1463446701),
(4, 1, 'user-registration-agreement', 2, '用户注册协议', '用户注册,协议', 0, '\n\n<p>感谢您阅读“投诉网·公益”平台《用户注册协议》（下称“本协议”）并使用“投诉网·公益”平台（下称“平台”）提供的各项服务。您在申请注册成为平台用户之前，应当认真阅读本协议。且您务必审慎阅读、充分理解各条款内容，特别是免除或者限制责任的条款、法律适用和争议解决条款。免除或者限制责任的条款将以粗体标识，您应重点阅读。如您对协议有任何疑问，可向平台及时咨询。</p>\n\n\n\n\n\n<p>用户在仔细阅读并同意所有服务条款完成注册程序后，即时成为平台的正式用户。本注册协议自用户注册成功之日起，在用户与平台之间发生法律效力。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">一、平台的简介</strong></p>\n\n\n\n\n\n<p>“投诉网·公益”平台是毕节布恩电子商务有限公司旗下的公益服务平台，平台通过网站、微信等，为有投诉网需求的自然人、法人及其他组织提供信息发布、维权删除信息等相关信息服务。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">二、账户的使用</strong></p>\n\n\n\n\n\n<p>您有权使用您设置或确认的平台用户名、手机号码（以下简称“账户名称”）及您设置的密码（账户名称及密码合称“账户”）登录平台，并在登陆后对账户信息进行修改。</p>\n\n\n\n\n\n<p>作为平台的经营者，法律并未赋予平台强制要求所有用户进行实名认证的权利，但为使您更好地了解平台展示的投诉信息，并保证您的个人信息以及投诉信息真实有限，平台建议您按照平台要求及我国法律规定完成实名认证（我们承诺已对身份证号码个人隐私信息使用多层加密保护，无法破解）。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">三、注册信息的管理</strong></p>\n\n\n\n\n\n<p> （一）用户需向平台提供您的身份信息（包括但不限于您的姓名、电子邮件地址、联系电话等），并保证信息的真实性、完整性、及时性。因信息不真实、不完整或信息变更后未及时通知平台，导致的一切后果，用户应自行承担责任。</p>\n\n\n\n\n\n<p> （二）您的账户由您自行设置并保管，平台任何时候均不会主动要求您提供您的账户信息。请您务必保管好您的账户，因您主动泄露或遭受他人攻击、诈骗等行为导致的损失及后果，均由您自行承担。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">四、平台的权利与义务</strong></p>\n\n\n\n\n\n<p> （一）平台有权自己或委托第三方对用户进行实名认证和资格审核，并对用户信息的真实性进行必要的形式审查。平台有权拒绝不符合法律法规及平台要求的用户进行注册或取消已注册用户的用户资格。</p>\n\n\n\n\n\n<p> （二）平台有权使用用户资料并承诺对用户信息采取对外保密措施，不向任何第三方披露用户资料，不授权第三方使用用户资料，</p>\n\n\n\n\n\n<p> （三）平台对身份证信息严格加密处理。呈现方式如：52＊＊＊＊－＊＊＊＊－＊＊－＊＊－＊＊＊33</p>\n\n\n\n\n\n<p> （四）在用户违反国家、地方法律法规规定或违反平台相关规则及要求的情况下，平台拥有包括但不限于随时中止、终止对用户提供部分或全部服务并停用其用户帐号的权利。在该情况下，平台对由此产生的损失不承担任何责任。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">五、用户权利和义务</strong></p>\n\n\n\n\n\n<p> （一）用户声明并承诺其为具有完全民事行为能力的自然人，或为依据中国法律设立并有效存续的公司或企业或其他形式的组织，具有一切必要的权利和能力订立、履行本协议下的任何义务和责任。</p>\n\n\n\n\n\n<p> （二）用户有权拥有自己在平台的用户名和密码并有权使用自己的用户名和密码随时登录平台。用户在其权限内有权进行发布信息、删除信息、对他人提供帮助等平台提供的相关服务。</p>\n\n\n\n\n\n<p> （三）用户保证其使用平台提供的服务时将遵守国家、地方法律法规、遵从行业惯例和社会公共道德。用户在注册成功后，不会采用任何方式存储、发布、传播损害国家、社会公共利益和涉及国家安全的信息资料或言论，不得发起、参与任何洗钱类项目。因用户上述行为给平台造成损失的，用户应予赔偿。</p>\n\n\n\n\n\n<p> （四）对于用户通过平台发布的涉嫌违法或涉嫌侵犯他人合法权利或违反本协议的信息或资料，平台有权依据其独立判断对该信息或资料予以修改、编辑、删除，而无需事先通知该用户。用户应独立承担由此造成的一切损失和法律责任，并应确保平台免于承担因此产生的任何损失或费用。</p>\n\n\n\n\n\n<p> （五）用户承诺并保证其在平台上浏览、发布、参与项目的决定是依据自身判断所作出的独立、审慎的决定，因其使用平台服务产生的风险由其自行承担，并保证依法、依协议的约定履行其相应的义务。</p>\n\n\n\n\n\n<p> （六）因互联网自身属性原因，用户承诺并保证其使用投诉网平台服务的风险由其自身承诺，其下载或通过轻松筹平台服务取得的信息和资料，由其自身承担系统受损、资料和信息丢失以及其他相关风险。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">六、隐私声明</strong></p>\n\n\n\n\n\n<p>本平台重视对用户隐私的保护。关于您的身份信息和其他特定资料，将依据本平台的《隐私政策》进行保护和规范，详情请参阅《隐私政策》。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">七、其他</strong></p>\n\n\n\n\n\n<p>用户通过第三方平台的接口注册并登陆平台的，在接受本协议的同时，还要遵守第三方平台的相关要求。因第三方平台导致用户相应损失的，本平台不承担任何责任。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">八、协议的修改</strong></p>\n\n\n\n\n\n<p>为更好的为用户提供服务，本平台保留在任何时间自行修改、增删本平台法律文书中任何内容的权利。平台在修改相关内容后，会及时在平台上进行公告。在公告发布后，用户每次登录或使用本平台时均视为同意接受当时有效协议的制约。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">十、本协议的终止</strong></p>\n\n\n\n\n\n<p>（一）如出现以下情形之一的，用户有权终止本协议：</p>\n\n\n\n\n\n<p>1.本平台相关协议及服务条款变更，变更事项生效前您停止使用并明示不愿接受变更事项的；</p>\n\n\n\n\n\n<p>2.您明示不愿继续使用平台服务，且符合平台终止条件的。</p>\n\n\n\n\n\n<p>（二）如出现以下情形之一的，平台有权解除本协议：</p>\n\n\n\n\n\n<p>1.用户违反本协议相关约定，平台依据协议约定终止本协议的；</p>\n\n\n\n\n\n<p>2.用户参与涉赌、涉黄、套现、洗钱、诈骗及其他违法违规活动；</p>\n\n\n\n\n\n<p>3.用户未通过网站提供真实有效的联系方式，且平台在5个工作日内无法联系到该用户；</p>\n\n\n\n\n\n<p>4.用户损害平台名誉，散播不利于平台的言论，或对其他客户、项目方和银行做出不诚实或欺骗的行为；</p>\n\n\n\n\n\n<p>5.平台收到行政、司法等权力机关出具的要求终止用户资格的书面通知。</p>\n\n\n\n\n\n<p><strong class="redactor-inline-converted">十一、不可抗力及免责条款</strong></p>\n\n\n\n\n\n<p>（一）由于发生地震、台风、水灾、火灾等人力不能预见、不能避免、不能克服的不可抗力事件，致使协议无法履行或不能按约定履行，遭遇不可抗力的一方应于不可抗力发生之日起3个工作日内以书面形式通知对方，并于发生后10个工作日内出具有关部门的证明文件。因不可抗力造成的损失，双方互不承担责任。不可抗力事由消失后双方应在合理期限内协商是否继续履行协议。</p>\n\n\n\n\n\n<p>（二）由于计算机和互联网的特殊性，平台服务过程中可能出现技术性中断、服务延时及安全性问题等(包括但不限于平台系统崩溃或无法正常使用、电信设备故障、网络故障、电力中断、恶意攻击、计算机病毒)。平台用户应了解该类风险内容，若用户因此无法使用平台部分或全部服务的或对用户造成损失的，平台不承担任何责任。</p>\n\n\n\n\n\n<p>（三）平台需要定期或不定期地进行停机维护，平台会在维护前24小时内以平台公告形式及时通知用户，维护期间用户将无法使用部分或全部平台服务，因此对用户造成的损失，平台不承担任何责任。</p>\n\n\n\n\n\n<p><strong>十二、管辖</strong></p>\n\n\n\n\n\n<p>若本协议履行过程中发生争议，双方本着公平公正的态度友好协商解决。协商不成时，任何一方均可向平台所在地人民法院提起诉讼。</p>\n\n\n\n\n\n<p>本协议的每条规定均拟定为可分割的，本协议任何部分的无效或违法都不应影响本协议其余部分的效力或合法性。</p>', 0, 0, 1463446840),
(5, 1, 'disable-create-message', 6, '禁止发布信息', '绿色互联网,文明交流,平台禁止项', 0, '<h3 class="text-center">在平台交流中禁止发布以下类似信息</h3><ol><li>禁止发送任何联系方式！比如：腾讯qq，微信号，电话号码，其他社交平台账号！发现立即冻结账户（至少30天）累计超出3次永久冻结。</li><li>以盈利方式发送url或者任何联系方式直接永久冻结账号。请遵循公益平台相关规定。</li><li>请勿发布非文明语言。严重的账号永久冻结！</li></ol>', 0, 0, 1463839647),
(6, 1, 'related-user-accounts', 2, '用户账号相关', '账号,安全', 0, '<h2 class="text-center">关于投诉网账号使用和注册</h2><p><strong><samp><mark>账号相关</mark></samp></strong></p><ol><li>投诉网采用一人一号方式管理用户，并且实名认证。确保当前投诉人对投诉信息的真实性，合法性和相关投诉事件、评论事件等责任认知。</li><li>用户注册后需要提供真实姓名，身份证号码，身份证图片等证明本人当前使用该账号。</li><li>账号不能借用他人使用。如手机号码变更请在投诉网更换手机号码页面更换。也需要提供相关的注册信息以及身份信息验证。</li></ol><br>', 0, 0, 1464030998),
(7, 1, 'outside-the-station-url-link', 1, '站外网址链接', '网址,其它网站,链接', 0, '<h2 class="text-center">非投诉网之外网站链接说明</h2><h4>页面底部有情链接</h4><ul><li>平台（Lics）团队人员其它成员的组织。</li><li>国家投诉维权信息网。</li><li>均受投诉网信任且能推送给大家的网站。</li><li>交易安全可靠。</li></ul><p><br></p><h4>用户投诉信息内容页链接</h4><ul><li>用户禁止在发起投诉或其它在投诉网操作的任何其它站外链接。（国家网站除外）</li><li>禁止的链接包含，图片，文件，投诉人联系方式，以及其它文本url</li></ul><p><br></p><h4>最新资讯内容页链接</h4><ul><li>文章内容可能会有其它网站链接。仅供大家参考。</li><li>点击链接涉嫌交易的投诉网不负任何责任。交易请走正规交易。</li></ul>', 0, 0, 1464140503),
(8, 1, 'withdraw-complaints', 4, '撤销投诉事件', '撤销投诉', 1, '<h4>投诉发起人撤销投诉事件</h4>\r\n\r\n<ul><li>投诉事件经过发起投诉人创建投诉事件，表示该投诉人经过深思熟虑的。对该投诉事件的社会责任、法律责任、道德等有较强的认知。此类事件不给予删除处理！</li></ul>\r\n\r\n\r\n\r\n\r\n\r\n<h4>被投诉事件撤销</h4>\r\n\r\n\r\n\r\n\r\n\r\n<ul><li>在投诉网查询到 “我，我公司，我组织”被他人投诉的。</li><li>经过能被搜索查询或者在投诉网查询到的投诉事件！投诉发起人对该事件有一定的认知以及能承担相应的法律责任。如您对该投诉事件有任何疑问。可申请法律诉讼！</li><li>发现被投诉或曝光了，但是事件不真实存在的。对于虚假信息曝光的，对他人进行诽谤的，对他人人生攻击的，等不良好的嗜好。投诉网一律追究法律责任。<mark>严重可致刑法 </mark>！</li></ul>\r\n\r\n\r\n\r\n<p><br></p>\r\n\r\n\r\n\r\n<p><mark class="redactor-inline-converted">温馨提示：请大家文明出行，文明沟通，文明工作。缔造文明社会生态环境，人人有责！</mark></p>', 0, 0, 1465239810);

-- --------------------------------------------------------

--
-- 表的结构 `boone_helper_categories`
--

CREATE TABLE `boone_helper_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faIcon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `isDisplay` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_helper_categories`
--

INSERT INTO `boone_helper_categories` (`id`, `title`, `keywords`, `description`, `faIcon`, `parent`, `isDisplay`) VALUES
(1, '平台使用', '平台,投诉网,使用', '用户平台使用帮助', 'fa fa-sitemap', 0, 1),
(2, '用户权益', '投诉网,用户,权益,帮助', '用户权益相关帮助', 'fa fa-group', 0, 1),
(3, '发起投诉', '发起投诉,帮助', '用户发起对他人投诉帮助', 'fa fa-flag', 0, 1),
(4, '投诉管理', '投诉管理,解决投诉,法律起诉', '用户投诉信息管理帮助', 'fa fa-legal', 0, 1),
(6, '评论', '回应,评论', '用户在平台发起交流帮助', 'fa fa-comments', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `boone_honestys`
--

CREATE TABLE `boone_honestys` (
  `id` int(11) NOT NULL,
  `categories` int(11) NOT NULL DEFAULT '0',
  `segmentUrl` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `memberId` int(11) NOT NULL,
  `eventRegion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eventType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expect` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metaKeyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eventDateOn` date DEFAULT NULL,
  `involveAmount` decimal(10,2) DEFAULT NULL,
  `casesReceipt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eventActive` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `siteUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previewCount` int(11) NOT NULL DEFAULT '0',
  `commentCount` int(11) NOT NULL DEFAULT '0',
  `isImportant` tinyint(1) NOT NULL DEFAULT '0',
  `createOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_honestys`
--

INSERT INTO `boone_honestys` (`id`, `categories`, `segmentUrl`, `memberId`, `eventRegion`, `eventType`, `metaTitle`, `expect`, `metaKeyword`, `metaDescription`, `eventDateOn`, `involveAmount`, `casesReceipt`, `eventActive`, `siteUrl`, `previewCount`, `commentCount`, `isImportant`, `createOn`) VALUES
(1, 0, '549vics0beph1465807088.6', 1, 'beijing', 'website', '演示如何发起投诉事件，如何在平台得到帮助', NULL, '演示', '演示如何发起投诉事件，如何在平台得到帮助', '2016-06-13', '0.00', '', 'exposure', '', 0, 2, 0, 1465807088);

-- --------------------------------------------------------

--
-- 表的结构 `boone_honestys_body`
--

CREATE TABLE `boone_honestys_body` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `honestyId` int(11) NOT NULL,
  `allowComment` tinyint(1) NOT NULL DEFAULT '1',
  `ipAddress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `verifyOn` tinyint(1) NOT NULL DEFAULT '0',
  `updateOn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_honestys_body`
--

INSERT INTO `boone_honestys_body` (`id`, `userId`, `honestyId`, `allowComment`, `ipAddress`, `content`, `verifyOn`, `updateOn`) VALUES
(1, NULL, 1, 1, '119.123.69.81', '&lt;h4 xss=removed&gt;本文演示如何发布投诉事件，如何在平台的到处理&lt;/h4&gt;&lt;p xss=removed&gt;&lt;span xss=removed&gt;投诉网承诺：&lt;/span&gt;&lt;span xss=removed&gt;&lt;span xss=removed&gt;使用行业标准的加密技术对您的信息进行加密处理。投诉网不会给您推送任何广告。不会泄露您的个人隐私信息。包含您的姓名。所有的用户显示使用呢称方式呈现。我们只保证用户填写的信息真实有效。对于用户的资料我们不做任何处理。包含您在平台联系律师。律师想知道您的联系方式也需要您的许可。否则您的个人信息在投诉网是完全保密的。&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;h4&gt;用户注册后进入用户中心，完善个人信息。包含用户姓名，身份证号码等&lt;/h4&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/e9ddc7337b7a0fe72a55dabc234e1e03.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/17afc410607c7c117adc04722d309458.png&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/f8ddca3bcc56f2821fdd40cb2ea9a319.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h4&gt;开始发起投诉事件。&lt;/h4&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/f2cad27a43d50a0d1cb1513dc5b75341.png&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/17afc410607c7c117adc04722d309458.png&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/users/images/1f160638/02453732dfe9b17eb408866b342365a1.png&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/f999d4cefc7c4b147b8af4675b04654c.png&quot;&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_member`
--

CREATE TABLE `boone_member` (
  `id` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `wechat` varchar(34) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginKey` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activeCode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `createdOn` int(11) NOT NULL,
  `ipAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(1) DEFAULT '0',
  `donation` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lastLogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_member`
--

INSERT INTO `boone_member` (`id`, `group`, `mobile`, `wechat`, `avatar`, `loginKey`, `activeCode`, `username`, `active`, `createdOn`, `ipAddress`, `position`, `donation`, `lastLogin`) VALUES
(1, 1, '15508571100', '', 'uploads/avatars/a797bb863398060173283d9b660561ad.jpg', 'c424e166b3621278e5df30e8dc8fd9e311240605', '', '15508571100', 1, 1461776957, '127.0.0.1', NULL, '0.00', 1473687569),
(3, 1, '15989103266', '', NULL, '31b9de7c8edf2689ecc9efb593b2421c4265bf48', '', '15989103266', 1, 1462011338, '221.13.1.122', 0, '0.00', 1462011338),
(4, 1, '18898726543', '', 'uploads/avatars/8f56b986675aca3a56b65aa8cab2c518.jpeg', '86122fe69f5c6b23a877e8c3ffa93ffffb74870b', '', '18898726543', 1, 1462050555, '218.18.249.232', 0, '0.00', 1488779833),
(5, 1, '13133032232', '', NULL, NULL, '99273', '13133032232', 1, 1462185365, '114.97.59.121', 0, '0.00', 1462185365),
(6, 1, '15123155590', '', NULL, 'c467c3eae80082e40f7b14a557dac90c7ce069a4', '', '15123155590', 1, 1462188717, '121.34.175.237', 0, '0.00', 1462188717),
(7, 1, '15967982477', '', NULL, NULL, '50847', '15967982477', 1, 1462299839, '183.16.192.92', 0, '0.00', 1462299839),
(8, 1, '18334187913', '', NULL, 'ee8f1ded058d381e33f1db02420156e82ac2f466', '', '18334187913', 1, 1462299944, '183.16.192.92', 0, '0.00', 1486051542),
(9, 1, '18681503259', '', 'uploads/avatars/37ec1468ffdb04494b494f08067340fa.jpg', '634d98bffbb334291e9395566cd3c8b5cdd2be83', '', '18681503259', 1, 1462352388, '113.109.29.232', 0, '0.00', 1463447849),
(10, 1, '18206822954', '', NULL, NULL, '83443', '18206822954', 1, 1462378514, '14.17.44.214', 0, '0.00', 1462379151),
(11, 1, '15885207202', '', NULL, 'd7c8fece42f429e4d2d8fbfe25f4b5c8d14a4344', '', '15885207202', 1, 1462379847, '14.204.134.128', 0, '0.00', 1462379847),
(12, 1, '18710767253', '', NULL, '442769ddcb25be405146d3f21019cca1b7cc1189', '', '18710767253', 1, 1462477835, '183.16.193.180', 0, '0.00', 1465742456),
(13, 1, '13698565848', '', NULL, NULL, '79177', '13698565848', 1, 1462743968, '58.60.170.133', 0, '0.00', 1462743968),
(14, 1, '17773840003', '', NULL, '117f64d206ef7d08b98ff5aba33a56b7ebc094c7', '', '17773840003', 1, 1462968312, '60.182.39.169', 0, '0.00', 1463813821),
(15, 1, '13699774598', '', 'uploads/avatars/8e1f5947cab07603f8b317fa4c9e70ed.jpg', 'fd5ed3b4dbe61d5cdb1749899760f5204f6be52e', '', '13699774598', 1, 1463448620, '139.196.128.185', 0, '0.00', 1463448621),
(16, 1, '13715337618', '', NULL, 'c6160b9b4503218e546e43c2890cb7aca25c95bf', '', '13715337618', 1, 1463710130, '139.196.128.185', 0, '0.00', 1463710130),
(17, 1, '15885850560', '', NULL, '1558ebdb0e7aad19d87d1e7cc2626c0a8ad12990', '', '15885850560', 1, 1463821849, '223.104.24.145', 0, '0.00', 1463821849),
(18, 1, '15969680808', '', NULL, 'c55e766ea3b1e83109c5d889ceb8006c7f00871f', '', '15969680808', 1, 1463830240, '27.211.33.171', 0, '0.00', 1463830240),
(19, 1, '13433851599', '', 'uploads/avatars/93ee57ec5d23406851eca0bdd6ee7cb0.png', '69c01193df19c319b741280697edf17c83fc4213', '', '13433851599', 1, 1463930450, '119.121.35.80', 0, '0.00', 1464269127),
(20, 1, '18820969800', '', 'uploads/avatars/1054eb8c5e93b47e43d782cd8668e296.jpeg', 'eca74f091f1c047ff2a6b3b443ef8ddc26faa159', '', '18820969800', 1, 1464013425, '183.16.191.133', 0, '0.00', 1464013425),
(21, 1, '13984795825', '', NULL, '1d1fd98f60f5b6f3e945a55b5ece92b118f517f1', '', '13984795825', 1, 1464351184, '111.85.242.75', 0, '0.00', 1464351184),
(22, 1, '15599351066', '', NULL, 'b3a7393e27970ff0ef1fbbd75007f5e85b1a3c2a', '', '15599351066', 1, 1464352430, '220.197.208.165', 0, '0.00', 1464352430),
(23, 1, '13208570006', '', NULL, 'b4c091cf5611eb9970db80ac51a27d4beb19472f', '', '13208570006', 1, 1464356583, '117.135.231.51', 0, '0.00', 1464356583),
(24, 1, '13590449261', '', NULL, NULL, '29706', '13590449261', 1, 1464357547, '119.123.253.79', 0, '0.00', 1464360038),
(25, 1, '15986947557', '', NULL, '89673a6968b022027ce3036fc4a4a39f7bd9834c', '', '15986947557', 1, 1464370705, '183.38.79.251', 0, '0.00', 1464370904),
(26, 1, '15954097172', '', NULL, '72da390ee8a5a580ac1b0ff9b1a19b51a1f3d8b5', '', '15954097172', 1, 1465193602, '221.223.79.126', 0, '0.00', 1465193602),
(27, 1, '18833903538', '', NULL, '896d75e402e16bc28f6b72f15ed03efe499b91a1', '', '18833903538', 1, 1465274884, '121.24.139.206', 0, '0.00', 1465274884),
(28, 1, '15128526727', '', NULL, '8533b6aa10d570f701d8b2d29acf0fdb4294a9cf', '', '15128526727', 1, 1465289851, '219.148.132.10', 0, '0.00', 1465289851),
(29, 1, '15124993956', '', NULL, '268a6220216e27e5552a8f0f943b57ccb5cdcc36', '', '15124993956', 1, 1465292935, '180.102.97.85', 0, '0.00', 1465292935),
(30, 1, '15923666979', '', NULL, '6d6fc85c3d1e0d2fc38fae2beb83ec1fc9011a55', '', '15923666979', 1, 1465422679, '113.248.236.72', 0, '0.00', 1465422679),
(31, 1, '15856958138', '', NULL, 'adfdc618ebf1a2c39b75c6e11dab81166f6a2553', '', '15856958138', 1, 1465861374, '183.61.51.190', 0, '0.00', 1465861374),
(32, 1, '15875590882', '', NULL, '3e5a280d207269add10dd4af35bab6ef541e7d34', '', '15875590882', 1, 1465889991, '183.14.4.7', 0, '0.00', 1465889991),
(33, 1, '15081212315', '', NULL, 'd60fe9389c230a207a255e891e0b82ed9bad7eea', '', '15081212315', 1, 1466071420, '125.39.42.218', 0, '0.00', 1466071420),
(34, 1, '15380479830', '', NULL, 'c2f3b00ef9ee02b8cffa30a81f334f9d06dbb57b', '', '15380479830', 1, 1466162781, '49.66.254.225', 0, '0.00', 1466162781),
(35, 1, '15902571963', '', NULL, NULL, '53322', '15902571963', 1, 1466738908, '111.85.62.49', 0, '0.00', 1466738908),
(36, 1, '15117649082', '', NULL, 'ab30244fd763f57877e996ed3f784d64293104af', '', '15117649082', 1, 1466739040, '111.85.62.49', 0, '0.00', 1466739040),
(37, 1, '13126726929', '', NULL, 'bb507d779940117dd972581ea394d01cbade6304', '', '13126726929', 1, 1470326376, '61.148.244.181', 0, '0.00', 1470326376),
(38, 1, '18666212522', '', NULL, 'f10da87e23a405f77b866065c59834115d7cf23b', '', '18666212522', 1, 1470801342, '113.110.220.232', 0, '0.00', 1470801342),
(39, 1, '15761607905', '', NULL, '9692befc8b63c9c2e6fa710fbebfd2b355d19074', '', '15761607905', 1, 1479953739, '58.16.40.242', 0, '0.00', 1479953739),
(40, 1, '13543471687', '', NULL, NULL, '77052', '13543471687', 1, 1481250348, '119.130.186.17', 0, '0.00', 1481250348);

-- --------------------------------------------------------

--
-- 表的结构 `boone_member_group`
--

CREATE TABLE `boone_member_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_member_group`
--

INSERT INTO `boone_member_group` (`id`, `name`, `description`) VALUES
(1, '注册用户', '普通注册用户.可发布一些信息'),
(2, '注册用户', '网站普通用户');

-- --------------------------------------------------------

--
-- 表的结构 `boone_member_profile`
--

CREATE TABLE `boone_member_profile` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `displayName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `gender` enum('female','male') COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `card` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressLine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updatedOn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_member_profile`
--

INSERT INTO `boone_member_profile` (`id`, `userId`, `displayName`, `firstName`, `lastName`, `bio`, `gender`, `birthday`, `card`, `website`, `company`, `department`, `job`, `addressLine`, `updatedOn`) VALUES
(1, 1, '决战天下', '李', '连锦', '有时候并不是能不能做到，而是是否合理!', 'male', '1992-01-02', 'NITH4Rq9b//vChSKYg075/dCiiazNjJP', '', NULL, NULL, '开发者', '', NULL),
(3, 3, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(4, 4, '投诉网官方', '正', '義', NULL, 'male', '2016-04-20', 'NITH4Rq9b/9sc5bzjEoABzi+Je/b5ht/', NULL, NULL, NULL, NULL, '', NULL),
(5, 5, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(6, 6, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(7, 7, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(8, 8, '和天下', '周', '传福', NULL, 'male', '1988-11-11', 'NITH4Rq9b/+NsMTdiC80D1PbXC+1rFs8', NULL, NULL, NULL, NULL, '', NULL),
(9, 9, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(10, 10, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(11, 11, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(12, 12, 'New user', '李', '高', NULL, 'male', '1991-02-01', NULL, NULL, NULL, NULL, NULL, '', NULL),
(13, 13, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(14, 14, 'New user', '1', '2', '', 'male', '2016-05-21', NULL, '', NULL, NULL, '', '', NULL),
(15, 15, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(16, 16, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(17, 17, 'New user', '曾', '航', NULL, 'male', '1997-06-10', NULL, NULL, NULL, NULL, NULL, '', NULL),
(18, 18, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(19, 19, 'xiaojie', '周', '晓杰', NULL, 'male', '2016-05-26', 'ekI4wA03j2CirA40G4smWwWYu+FQPa2z', NULL, NULL, NULL, NULL, '', NULL),
(20, 20, 'New', 'aa', 'bb', NULL, 'male', '2016-05-23', NULL, NULL, NULL, NULL, NULL, '', NULL),
(21, 21, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(22, 22, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(23, 23, 'Sk', '曾', '璞珂', NULL, 'male', '1990-11-07', NULL, NULL, NULL, NULL, NULL, '', NULL),
(24, 24, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(25, 25, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(26, 26, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(27, 27, 'New user', '田 ', '进国', NULL, 'male', '2016-06-07', NULL, NULL, NULL, NULL, NULL, '', NULL),
(28, 28, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(29, 29, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(30, 30, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(31, 31, '维权', '温', '淑君', '肥东县撮镇镇宣临村三友西村民组土地征收补偿费，老百姓的土地补助被村里剥夺，我们农民想要讨个说法，望有关部门能解决此事～', 'female', '2016-06-14', 'fASB1nlQ5wbNcE5/WgxsWz/0mIyaT2rE', '', NULL, NULL, '务农', '', NULL),
(32, 32, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(33, 33, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(34, 34, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(35, 35, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(36, 36, '童龄', '童', '宁', NULL, 'male', '1985-04-12', 'NITH4Rq9b/81ifj/kxipedf2u9fty2Rw', NULL, NULL, NULL, NULL, '', NULL),
(37, 37, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(38, 38, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(39, 39, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(40, 40, 'New user', '', '', NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_member_teams`
--

CREATE TABLE `boone_member_teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `userAvater` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fullname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `industrys` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cardNumber` tinyint(1) NOT NULL,
  `vocational` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `experience` tinyint(4) NOT NULL,
  `isPass` tinyint(1) NOT NULL DEFAULT '0',
  `countHelper` int(11) NOT NULL DEFAULT '0',
  `reasons` text COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_member_teams`
--

INSERT INTO `boone_member_teams` (`id`, `userId`, `userAvater`, `fullname`, `industrys`, `cardNumber`, `vocational`, `experience`, `isPass`, `countHelper`, `reasons`, `createdOn`) VALUES
(1, 19, '/uploads/reality/c0eb9eaebfd7601ac9dcabbfacf06f23.png', '周晓杰', 'lawyer', 1, '', 0, 0, 0, '居民身份证号码，根据〖中华人民共和国国家标准 GB 11643-1999〗中有关公民身份号码的规定，公民身份号码是特征组合码，由十七位数字本体码和一位数字校验码组成', 1464269794),
(2, 1, '/uploads/reality/295e10dcd4864a0059fd64093e52ed67.jpg', '李连锦', 'developer', 1, '', 2, 1, 0, '一种生活一种态度.', 1465180820);

-- --------------------------------------------------------

--
-- 表的结构 `boone_posts`
--

CREATE TABLE `boone_posts` (
  `id` int(11) NOT NULL,
  `categories` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentCount` int(11) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createOn` int(11) NOT NULL,
  `publishAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_posts`
--

INSERT INTO `boone_posts` (`id`, `categories`, `userId`, `slug`, `summary`, `metaTitle`, `tag`, `image`, `commentCount`, `featured`, `status`, `createOn`, `publishAt`) VALUES
(1, 3, 1, 'bllunfu600253b0h', '成都商报记者从成都市食药监局获悉，“饿了么”是因允许未取得餐饮服务许可证的餐馆加入其网络订餐平台开展经营业务而被罚的，“四川省、成都市食品药品监督管理局高度重视网络食品安全监管，将加强第三方网络平台订餐管理作为工作重点。”', '四川对网络订餐平台开首张罚单 重罚“饿了么”15万', 's:36:"四川,首张罚单,重罚,饿了么";', '/uploads/users/images/1f160638/493b94920406aa1da57a54fcad9d9aa6.png', 0, 0, 1, 1461969330, '0000-00-00 00:00:00'),
(2, 3, 1, 'bm2d8j8i000915bf', '许多和我一样没有在这个假期出行的人可能也都和我一样，准备着在这个假期里被朋友圈里的天南海北刷着屏。\r\n我们确实被刷屏了，但不是天南海北，而是一名21岁大学生的死。\r\n一名普通大学生的死，在网络上掀起了狂涛骇浪，必然有其极不普通的地方。事实的部分我想没有必要再重复了，只想写下我的一些思考。', '魏则西之死 被吊打最严重的为什么是百度?', 's:29:"百度推广,魏则西,百度";', '/uploads/users/images/1f160638/2763e97f69ec620649d4ffff6caa2233.jpg', 0, 0, 1, 1462186227, '0000-00-00 00:00:00'),
(3, 3, 1, '880-bm1avjel00014aed', '涉黄会所藏身豪华公寓，借大众点评、美团网以团购方式销售色情服务。会所通过招聘网站招聘19岁高职女生接送顾客，提供从880元到2980元不等的各类色情服务。\r\n近日，海淀公安分局万寿路社区警务团队发现并锁定一个涉黄团伙。4月27日下午，警务团队会同分局治安支队一举端掉该涉黄团伙，抓获10名涉黄人员，起获大批涉案物品。', '曝美团等团购网站存色情服务 明码标价880元起', 's:34:"美团,大众,团购,涉黄,色情";', '/uploads/users/images/1f160638/b9d8c4b8aa02df97f5928067f35e640e.jpg', 0, 0, 1, 1462222609, '0000-00-00 00:00:00'),
(4, 4, 1, 'bm6fqtf600014aed-1400', '都说不能太信网上的东西，更何况是转账。1日，家住沙坪坝劳动村的刘女士丢失了一部苹果6S，她没有报警，却在百度上搜索定位公司，结果被诈骗1400元。\r\n百度搜个公司寻手机\r\n1日中午，20多岁的刘女士坐出租车到二郎走亲戚。下车时将新买的苹果6S落在出租车后座上，连车牌都没记录下来，\r\n刘女士马上用朋友的电话拨打手机，响了几声后却被挂断。再次拨打时已关机。', '女子为找手机百度搜定位公司 结果被骗1400元', 's:26:"百度,定位公司,转账";', '/uploads/users/images/1f160638/63bcb5006117152a65c0c716650f288d.jpg', 0, 1, 1, 1462300766, '0000-00-00 00:00:00'),
(5, 5, 1, 'wanggou-2016-5-5', '在网络上购物，都离不开网银支付。但网络支付时，你的钱安全吗?据央视新闻报道，近期警方破获一个网络诈骗团伙，他们设置假冒购物网站，将受害者网银内的钱全部转走!\r\n对此，央视特别提醒，完成网购订单进入支付页面，网址前缀会变成“https”，表示已加密;若支付页面仍是“http”，一定提高警惕!扩散周知!', '网购族注意！央视最新提醒 你必须知道', 's:40:"网购,购物安全,https, 诈骗陷阱 ";', '/uploads/users/images/1f160638/dd740a7b659e629892e5f50e99297641.jpg', 0, 1, 1, 1462423881, '0000-00-00 00:00:00'),
(7, 4, 1, '-10-3-bmjha5q70001124j', '每天早上起来打开微信，总会发现朋友圈被各式各样的鸡汤文刷屏。标题往往是这样的：《生活的坑往往是自己挖的》、《给对将来感到不安的你》，抑或是以专家学者口吻告诫你：《姑娘啊！可长点心眼》、《人生不得不提的30个忠告》、《这五种食物千万不能吃》……\r\n令人想不到的是，微信好友们转发的这些文章，是在为别人赚钱，鸡汤文背后暗藏着获利丰厚的“转发”产业链。', '虚假广告傍上鸡汤文 10万加文章转发平台可获3万', 's:39:"鸡汤,转发,虚假广告,网络安全";', '/uploads/users/images/1f160638/08dabb5dfdd760cbcefc2bb3547f9d76.jpg', 0, 0, 1, 1462742798, '0000-00-00 00:00:00'),
(8, 4, 1, 'shc2016051602716703', '克里木和他的烤肉店突然走红。\r\n\r\n一组时尚照片，一条网络报道，让新疆人克里木和他的烤肉店在近几天之内火了起来。\r\n\r\n5月14日，澎湃新闻记者实地探访这家位于上海浦东的烤肉店，排队尝鲜的食客绵延近50米。记者注意到，排队的人群中有专程来吃烤肉的，也不乏有人来一睹烤肉店老板的风采。\r\n\r\n不过，老板克里木坦言，烧烤店开业15天了，但是还未办理相关营业执照、餐饮许可、从业人员健康证等证照，“现在属于试营业，正准备办理相关营业证照……”', '烤肉店帅哥老板走红 食药监：证照还没办', 's:42:"新疆,烤肉店,非法经营,网络走红";', '/uploads/users/images/1f160638/50edc267d2f0740624d7df6859233765.jpg', 0, 0, 1, 1463390630, '0000-00-00 00:00:00'),
(9, 3, 1, '-800yuan-6000-bnjmausa00014aed', '消费者郑先生称自己通过携程网预订房价为800元/晚的酒店房间，网页却在他不知情的情况下“自动跳转”，强制预订了总价6400元的高级套房，导致信用卡内5000元担保金被扣取。\r\n', '男子订800元房自动跳转6000元房 诉携程欺诈被驳', 's:20:"旅游,携程,宾馆";', '/uploads/users/images/1f160638/916558545266fc236e0a580893fb506f.png', 0, 0, 1, 1463821260, '0000-00-00 00:00:00'),
(10, 4, 1, 'bnlqhvc300014aed', '七件套的锦缎寿衣，是范银贵穿过的最好的衣服——在他自杀的时候，身上仍穿着17年前结婚时，四姐给他做的一件灰白格子西服。', '甘肃一乡村教师被骗光购房款后自杀 生前极节俭', 's:29:"范银贵,乡村教师,被骗";', '/uploads/users/images/1f160638/3b01e40258e036f7a6f4d1efeae695df.jpg', 1, 1, 1, 1463932180, '0000-00-00 00:00:00'),
(11, 4, 1, 'bnoq5huf00964ldhmignan', '5月22日中午12点刚过，有读者报料称，嘉兴秀洲区新城街道新义新村东区24幢一间出租房内发生命案，一男一女倒在血泊中，120救护人员到场后确认，两人均已死亡。', '某小区发生命案 一男一女死在租房', 's:26:"命案,租房,一男一女";', '/uploads/users/images/1f160638/6f0055577bd3ac86a476b3d258d42dfb.jpg', 0, 1, 1, 1464025898, '0000-00-00 00:00:00'),
(12, 4, 1, 'bns78v8400011229', '5月24日上午10点左右，一上身赤裸的男子爬上湖南长沙五一大道与黄兴路交汇处的高架桥交通信号灯上疑欲轻生，造成严重交通拥堵。公安、消防和民警积极营救期间，现场有不明身份男子拿长杆鞭打该男子，随后，其从红绿灯上跳下，引发围观群众起哄。', '网曝长沙一男子爬信号灯轻生 遭人挥杆敲打坠落', 's:20:"长沙,轻生,坠落";', '/uploads/users/images/1f160638/ca5effa92cabfc73c8f32a37cf99471d.jpg', 0, 0, 1, 1464110111, '0000-00-00 00:00:00'),
(13, 4, 1, '-8-4ifxsqxxs7633899', '父亲施暴，被患有精神分裂的母亲打死。母亲离家出走，马泮艳三姐妹被托付给大伯父。12岁左右，三姐妹被大伯父以童养媳的方式嫁人。', '女子被当童养媳8年4次逃婚 控告强奸未被立案', 's:16:"童养媳,强奸";', '/uploads/users/images/1f160638/291bfb4759e2ee8be2e85d6a1e83e3bf.jpg', 0, 1, 1, 1464203352, '0000-00-00 00:00:00'),
(14, 4, 1, 'bo4kghug00011229', '信息时报讯 近年来，因与异性网聊被骗进传销组织导致钱财损失、自由受限的事件时有发生。佛山一个年轻小伙被约来穗后却为此付出了生命的代价。近日，白云区检察院依法以涉嫌故意伤害罪批准逮捕犯罪嫌疑人邓某等7人。', '小伙被"女网友"骗进传销组织 欲逃遭群殴致死', 's:29:"女网友,传销组织,群殴";', '/uploads/users/images/1f160638/c740f00250343fe1a75b14d3abd98f4c.jpg', 2, 0, 1, 1464395122, '0000-00-00 00:00:00'),
(15, 4, 1, 'boc8anrb00011229', '5月25日、26日，华商报连续报道了韩城一女性患妇科病，到韩城市阳光妇科门诊部就医，被接诊医生劝说做了阴道紧缩术、留下后遗症一事。韩城市卫计部门现场检查发现，该门诊部还有3名“医生”无资质，已责令其停业整顿，但有读者认为该事件仍存在多个疑问', '女子看妇科却被做整形手术 涉事医生被指已离开', 's:32:"妇科,整形手术,涉事医生";', '/uploads/users/images/1f160638/091811ab42f4fba3b0903e7a662e6488.jpg', 1, 0, 1, 1464642935, '0000-00-00 00:00:00'),
(16, 3, 1, 'e-70', '广东惠州市P2P平台e速贷涉嫌非法集资一事昨日有了最新进展。昨天，惠州警方发布通报称，已查明e速贷为非法融资。目前，e速贷运营公司——广东汇融投资股份公司法人代表简某已于5月30日被惠州警方以涉嫌非法吸收公众存款罪正式逮捕。', 'e速贷法定代表人被逮捕 交易金额超过70亿元', 's:36:"p2p,e速贷,法定代表人被逮捕";', '/uploads/users/images/1f160638/fefca16b9e489fce07927aa41bd00652.jpg', 0, 0, 1, 1464726584, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `boone_posts_body`
--

CREATE TABLE `boone_posts_body` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `metaKeyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `enableComment` tinyint(1) NOT NULL DEFAULT '1',
  `updateOn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_posts_body`
--

INSERT INTO `boone_posts_body` (`id`, `postId`, `metaKeyword`, `metaDescription`, `content`, `enableComment`, `updateOn`) VALUES
(1, 1, 's:36:"四川,首张罚单,重罚,饿了么";', '成都商报记者从成都市食药监局获悉，“饿了么”是因允许未取得餐饮服务许可证的餐馆加入其网络订餐平台开展经营业务而被罚的，“四川省、成都市食品药品监督管理局高度重视网络食品安全监管，将加强第三方网络平台订餐管理作为工作重点。”', '&lt;h5&gt;      日前，网络订餐平台“&lt;a href=&quot;&quot;&gt;饿了么&lt;/a&gt;”因违反《食品安全法》被成都市食药监局从&lt;a href=&quot;&quot;&gt;重罚&lt;/a&gt;款15万元。据悉，这也是&lt;a href=&quot;&quot;&gt;四川&lt;/a&gt;对网络订餐第三方平台开出的&lt;a href=&quot;http://money.163.com/keywords/9/9/99965f207f5a5355/1.html&quot;&gt;首张罚单&lt;/a&gt;。&lt;br&gt;昨日，成都商报记者从成都市食药监局获悉，“饿了么”是因允许未取得餐饮服务许可证的餐馆加入其网络订餐平台开展经营业务而被罚的，“四川省、成都市食品药品监督管理局高度重视网络食品安全监管，将加强第三方网络平台订餐管理作为工作重点。”&lt;/h5&gt;&lt;h1&gt;&lt;br&gt;处罚&lt;/h1&gt;&lt;p&gt;约谈整改后 又现无证经营餐馆&lt;/p&gt;&lt;h5&gt;&lt;br&gt;        据记者了解，2015年，成都市食药监局对在本地开展网络食品销售的饿了么、美团外卖、糯米网等6家第三方交易平台经营者进行了约谈，向经营者强调网络食品销售的风险并宣讲修订后的《食品安全法》相关规定。&lt;/h5&gt;&lt;p&gt;&lt;br&gt;       今年1月，成都市食药监局组织执法人员对主要网络订餐第三方平台履行《食品安全法》相关规定义务的情况进行了执法检查。在抽查“饿了么”网络订餐平台时，执法人员发现有3家餐饮店未取得餐饮服务许可证即加入该网络订餐平台开展经营业务。成都市食品药品稽查总队于1月25日对“饿了么”进行立案调查。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        在立案调查期间，3月15日，媒体曝光成都“咕咕叫快餐”在“饿了么”网络平台上违法提供餐饮服务，经成都食药监部门调查属实。这些涉事餐饮店后被属地监管部门取缔或整改规范。&lt;br&gt;经查，“饿了么”涉嫌未严格审查入网餐饮单位许可证的行为，违反了《食品安全法》的相关规定被处罚。根据规定，网络食品交易第三方平台提供者未对入网食品经营者进行实名登记、审查许可证，或者未履行报告、停止提供网络交易平台服务等义务的，由县级以上人民政府食品药品监督管理部门责令改正，没收违法所得，并处五万元以上二十万元以下罚款。&lt;br&gt;“饿了么”在市食药监局对其约谈后，虽然进行了整改，并对797家不规范的商家进行清理下架，但在此后的检查中仍两次被发现无证餐饮服务经营者在其网络平台上提供餐饮服务。为此，市食品药品稽查总队决定给予营运“饿了么”的上海拉扎斯信息科技有限公司从重处罚，罚款15万元。四川省食药监局相关负责人表示，对网络订餐第三方平台开罚单，这在四川尚属首例。&lt;/p&gt;&lt;h2&gt;&lt;br&gt; 回应&lt;/h2&gt;&lt;p&gt;&lt;br&gt; 已开除两人 28日前缴纳罚款&lt;br&gt;       成都商报记者从成都市食药监局处罚信息上看到，处罚履行期限为2016年4月28日，但目前“饿了么”并未上缴罚款。“饿了么”为何迟迟不缴罚款？该平台相关工作人员表示，是内部流程问题，一定会在要求时间内缴纳罚款。“饿了么”已将两家涉事餐饮店下线，两名相关区域市场部工作人员因审核不严被开除。此外，该平台升级了餐饮服务申请流程，并组建了100多人的品控团队，在申请7个工作日内对经营者的资质、环境进行抽查。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        根据四川省出台的《关于加强第三方平台网络订餐管理的指导意见》，成都市食药监局将加强对入网餐饮服务经营者、网络订餐第三方平台的监督检查，重点检查入网餐饮服务经营者是否持有有效《餐饮服务许可证》、是否存在超范围经营、经营行为是否符合餐饮服务食品操作规范等；重点检查网络订餐第三方平台是否履行其法定审查义务，是否及时下线已入网的无证餐饮服务经营者，对于在检查中发现存在违法行为的第三方平台和入网餐饮服务经营者，坚决依法予以查处。&lt;br&gt;饿了么，连续栽在同一条河里&lt;br&gt; 央视3.15晚会曝光饿了么三宗“罪”&lt;/p&gt;\r\n\r\n&lt;h3&gt;&lt;br&gt;在今年的央视3.15晚会上，央视指出，目前很多网络订餐外卖平台给人们提供了方便，但不少外卖平台的安全问题却让人堪忧。3.15晚会点出饿了么等外卖平台的三宗“罪”：&lt;/h3&gt;&lt;h5&gt;&lt;br&gt;1、涉嫌虚假宣传 央视记者发现，有餐厅地址在居民楼的店铺，与网络上明亮的店铺照片完全不一样。 &lt;/h5&gt;&lt;h5&gt;2、卫生差 在饿了么显示为食速达的商家和实体店厨房相差很大，墙上、饭锅上到处是黑糊糊的油渍，掉进脏东西的饭盒在桌上打一下就直接装菜。 3、无营业执照 北京三元路多家无牌餐馆依然很忙碌。有些店生意兴隆，他们在大门或吧台前贴上了标志，本店已经加盟饿了么。&lt;/h5&gt;', 1, NULL),
(2, 2, 's:29:"百度推广,魏则西,百度";', '许多和我一样没有在这个假期出行的人可能也都和我一样，准备着在这个假期里被朋友圈里的天南海北刷着屏。\r\n我们确实被刷屏了，但不是天南海北，而是一名21岁大学生的死。\r\n一名普通大学生的死，在网络上掀起了狂涛骇浪，必然有其极不普通的地方。事实的部分我想没有必要再重复了，只想写下我的一些思考。', '&lt;p&gt;        许多和我一样没有在这个假期出行的人可能也都和我一样，准备着在这个假期里被朋友圈里的天南海北刷着屏。&lt;/p&gt;&lt;p&gt;&lt;br&gt;       我们确实被刷屏了，但不是天南海北，而是一名21岁大学生的死。&lt;/p&gt;&lt;p&gt;&lt;br&gt;      一名普通大学生的死，在网络上掀起了狂涛骇浪，必然有其极不普通的地方。事实的部分我想没有必要再重复了，只想写下我的一些思考。&lt;/p&gt;&lt;p&gt;&lt;br&gt;       评论这个事件的每一篇文章，都不可能是绝对公正和客观的。包括你正在读的我这篇。&lt;strong&gt;没有这个基本认识，就不可避免会成为勒庞所描述的“乌合之众”，被某一种观点所裹挟。&lt;/strong&gt;但这并不意味着干脆什么都别看。偏信则暗，兼听则明。各种角度的观点都听一听，看一看，想一想，然后再形成自己的判断。不论最终是什么结论，至少经过了一个推敲和论证的过程，就不会带有太大的盲目性。&lt;/p&gt;&lt;p&gt;&lt;br&gt;以上，是我的提醒。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        商业的本性是逐利的。对此，马克思有过精辟的论述：“如果有10%的利润，资本就会保证到处被使用；有20%的利润，资本就能活跃起来；有50%的利润，资本就会铤而走险；为了100%的利润，资本就敢践踏一切人间法律；有300%以上的利润，资本就敢犯任何罪行，甚至去冒绞首的危险。”所以，对于科室、医院、提供发声机会的媒体以及为它们的推广提供渠道的广告服务商，我们要首先从它们各自的逐利角度去理解它们的动机，而不是简单拿起道德大棒抡将过去。&lt;/p&gt;&lt;p&gt;&lt;br&gt;         应该没有人会认为这个事件里的科室是无辜的。早已臭名昭著的莆田系在这个事件里扮演的依然是极不光彩的角色。把国外因为效果不好而弃之不用的技术包装到国内作为新技术推销给病人，这种严重违背医疗伦理的做法无论怎么谴责都不为过。所以，我也就不多做展开。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        莆田系之所以能够得手，显然离不开院方的接纳。抛开将科室对外承包这件事本身合不合规不说，&lt;strong&gt;本该以“治病救人”为根本宗旨的院方明显对于承包方的医疗行为缺乏有效的监督。&lt;/strong&gt;医院作为一类和人命紧密关联着的属性特殊的机构，是天然受到道德约束的。这使得院方不能仅仅拿承包操作是否合规作为解释，而必须对自己的监督失职承担责任。这种失职，本质上也是医院对于医疗伦理的违背。因此，科室方和医院方应该承担的责任，在我看来大致是一样大的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;       接着说说媒体方。上电视，特别是上具有全国影响力的电视，在大多数普通老百姓心里就是一种保证。当然媒体可以说“我们并没有说要对任何播出的内容背书”，但事件中的这家媒体不能这么说。因为只要不是傻子，没人会怀疑它的巨大影响力。&lt;strong&gt;在利好的时候以自己的影响力为傲，而在出现负面的时候把影响力当作不情不愿的强加之物，这般“得了便宜又卖乖”的做法只能被鄙视。&lt;/strong&gt;不过，我们也必须承认，&lt;strong&gt;媒体方的确无法为所有内容的真实性负全责。&lt;/strong&gt;如果媒体对于相关方的欺骗行为事先并不知情，而且制作的内容也不是以广告为目的的话，那么我认为媒体方的责任主要还是道义上的责任，最多也是在可能关乎人命的内容审核上未能采取更为谨慎、严格的机制而已。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        同理，当我们看待这次事件被卷入漩涡中心的&lt;a href=&quot;http://tech.163.com/company/baidu/&quot;&gt;百度&lt;/a&gt;公司，也应该意识到其在这个具体事件上的责任是个媒体方相类似的。只要事先并不知情，我们就不应该将其作为主要责任方拉出来吊打。但是，&lt;strong&gt;与媒体方有一点不同的是，百度公司提供的是广告服务。&lt;/strong&gt;换句话说，它是在乎广告效果的，它是希望看到的人能够被广告吸引的。这使得它在责任上要比媒体方又大了一些。的确，对于广告所要宣传的内容的真实性，需要负责的是广告主。不过，百度公司也是需要做些审核的。&lt;strong&gt;对此，百度并不是没有审核机制，也不是仅仅做了一套空有其表的审核机制。&lt;/strong&gt;从机器的自动审核到人工的审核，你我能想到的百度也都想到并实现了。指责百度毫无作为，也确实有失公允。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        那么问题来了，为什么被吊打最严重的却是对魏则西之死并不负主要责任的百度公司呢？&lt;br&gt;        要回答这个问题，就必须跳离魏则西之死这个单一事件。因为就单一事件而言，百度的确不是主要的过错方，的确不应该遭受被众人唾弃的待遇。但是，批评百度之所以会成为一个“政治正确”的行为，不是因为某一个单一事件，而是源于一系列相似的事件，包括前不久的血友病吧事件。&lt;/p&gt;&lt;p&gt;&lt;br&gt;        百度不是一家足够透明的公司。我们不知道血友病吧到底是怎么被卖的，也不知道到底是怎么又被“公益化”的，同样不知道对于莆田系的所作所为百度究竟是怎么看怎么想的，在审核机制上有没有什么特别的规则或措施……我们所知道的，只有百度一直在重复的“简单可依赖”。但很多人不相信这五个字，因为搜索结果页面的排序并不“简单”，搜索结果内容的正确性并不“可依赖”。&lt;strong&gt;百度被吊打，一个方面的原因就是因为自己说的和人们所看到的太不一致。&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;/strong&gt;        百度不是一家足够谦卑的公司。也许是因为在搜索这个刚性需求上建立了垄断地位的缘故，百度一向不喜欢讨好大众。&lt;strong&gt;在每一次的公关危机中，百度所做的都是在重复自己的傲慢，而未能真正向大众传递应有的解释与关心。&lt;/strong&gt;这就也难怪很多人会将攻击的矛头指向百度的掌舵者李彦宏。因为企业不会傲慢，人会。大众有理由认为自己从百度的反应中所感受到的傲慢从根本上是源自百度的控制者。大众的这种认识，事实是否果真如此，不够透明的百度不会说，不够谦卑的百度不屑于说。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;i&gt;&lt;br&gt;        百度不是一家足够伟大的公司。尽管在文章的最开始我就提到了商业的逐利性，但是逐利性并不等于就要将灵魂卖给魔鬼。&lt;strong&gt;大众对于一家大企业的期望并不只是解决就业问题，而是希望能够对社会体现出有更大的责任感。&lt;/strong&gt;是的，这种社会责任感不是企业必须要有的，但这是大众判断一家企业是否伟大的一个不可缺少的标准。百度公司大概十分讨厌大众经常将百度和&lt;a href=&quot;http://tech.163.com/company/google/&quot;&gt;谷歌&lt;/a&gt;做比较的行为。但换个角度看，大众的这种行为其实表达的是“恨铁不成钢”。只可惜，不够谦卑的百度应该是体会不到这一点的。&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;i&gt;&lt;br&gt;        魏则西的死，严格的说百度只是有些连带责任，算不上错。百度公司甚至李彦宏成为被吊打的对象，与其说是大众认为百度公司应该为这一事件负主要责任，倒不如说是百度公司在这一事件上再一次激怒了大众。这，我想是百度公司，包括李彦宏，应该从中获得的教训。&lt;br&gt;祈愿下一次，不要再出现魏则西式的悲剧。&lt;br&gt;&lt;/i&gt;&lt;/p&gt;', 1, NULL),
(3, 3, 's:34:"美团,大众,团购,涉黄,色情";', '涉黄会所藏身豪华公寓，借大众点评、美团网以团购方式销售色情服务。会所通过招聘网站招聘19岁高职女生接送顾客，提供从880元到2980元不等的各类色情服务。\r\n近日，海淀公安分局万寿路社区警务团队发现并锁定一个涉黄团伙。4月27日下午，警务团队会同分局治安支队一举端掉该涉黄团伙，抓获10名涉黄人员，起获大批涉案物品。', '&lt;p&gt;涉黄会所藏身豪华公寓，借大众点评、美团网以团购方式销售色情服务。会所通过招聘网站招聘19岁高职女生接送顾客，提供从880元到2980元不等的各类色情服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;近日，海淀公安分局万寿路社区警务团队发现并锁定一个涉黄团伙。4月27日下午，警务团队会同分局治安支队一举端掉该涉黄团伙，抓获10名涉黄人员，起获大批涉案物品。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;举报&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;女子频带不同男子上楼&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;4月20日晚上11点多，海淀某高档公寓物业向所在社区警务团队民警老李反映，最近有一名着卡通图案外套的年轻女子频繁出现在小区地下车库，她手拿对讲机不时通话，从地库与步行或开车前来的不同男子见面，后把这些男子带入电梯，然后上楼，不久后又将这些男子送回地库，迅速离开，行为可疑。&lt;/p&gt;\r\n\r\n&lt;p&gt;“有问题，可能是赌博或者涉黄。”听闻消息后，老李立即前往公寓调取了近日的监控录像，发现这些男子随后都被该女子带进了公寓10层的10117房间。每名男子进屋两三小时后才离开房间，由该女子带出，原路送回地库。群众反映情况属实。&lt;/p&gt;\r\n\r\n&lt;p&gt;进入10117室，需业主刷门禁卡乘地库电梯至7层，经过7层大厅再刷门禁卡转乘另一部电梯至10层，随后刷10117室门卡才能完成，返程亦然。老李觉得，进出路线十分隐秘，这名女子持对讲机重复接送，一次只接一男子，男子也是每次一人离开，并非赌博后嫌疑人一同撤离情况，否定了屋内存在赌博行为，推断屋内可能存在卖淫嫖娼情况。&lt;/p&gt;\r\n\r\n&lt;p&gt;经统计视频数据，老李发现，该女子多在每天下午两三点至夜晚12点左右出现，每天能先后带两三名男子入屋。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;侦查&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;物业人员入室探查情况&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;4月21日上午11点半左右，老李向万寿路派出所所长报告了相关情况，所长听闻后，立刻要求由老李带队，组织由小区物业参与的社区警务团队在公寓蹲守，进一步展开调查取证工作。&lt;/p&gt;\r\n\r\n&lt;p&gt;为防止惊动屋内可疑人员，老李和警务团队成员并未贸然直接进屋检查或在屋子附近蹲守，而是通过物业调取视频监控系统实时掌握10117室外部情况。&lt;/p&gt;\r\n\r\n&lt;p&gt;为进一步了解室内情况，4月23日下午3点左右，老李让两名物业工作人员身着工服，以检修空调水暖电器等设备为名，敲开了10117室房门。工作人员发现，屋内装修考究奢华，表面看是一个名为“御境家园”的SPA会所，大厅设有收银台，大厅内有三四名衣着暴露工服的女子，这些女子只让工作人员检查了屋内大厅，称各个卧室内设备运行正常，拒绝两人进入检查。&lt;/p&gt;\r\n\r\n&lt;p&gt;老李和社区警务团队成员们初步认定，这个屋子内疑存在涉黄违法交易。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;抓捕&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;当场抓获10名涉黄人员&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;4月27日下午1点44分到4点多，监控显示，共有4名男子被着卡通外套女子带入房屋，且无人离开。&lt;/p&gt;\r\n\r\n&lt;p&gt;见时机成熟，老李立刻将情况反映给派出所所长，派出所和分局治安支队20多名民警于当日下午5点左右前往公寓地库集结。&lt;/p&gt;\r\n\r\n&lt;p&gt;下午5点多，监控室物业工作人员发现，一名男子被着卡通图案服饰女子带出10117室，集结在地库的民警立刻隐藏起来，当男子被带入地库和女子分开后，民警立刻将其控制。面对民警询问，这名男子承认了在10117室付费让女子为其提供色情服务，随后民警将该男子带回派出所调查。&lt;/p&gt;\r\n\r\n&lt;p&gt;正当民警准备入屋检查时，监控室物业人员再次反映，着卡通服装女子又带着另一名男子下楼，民警随后在地库设伏，随即将两人控制带回派出所调查。&lt;/p&gt;\r\n\r\n&lt;p&gt;民警随后使用女子手中门卡打开10117室冲进屋内，此时屋内共有2名男子和5名女子，其中一名男子和一名女子在屋内一浴室内全裸共浴，另外3名女子均衣着暴露，另一名男子自称为某团购网工作人员，接该会所联系前来修改宣传单据。民警随后将7名嫌疑人带往派出所调查。&lt;/p&gt;\r\n\r\n&lt;p&gt;京华时报记者在10117室内看到，这间面积约400平米的房内共有7室1厅1厨，装潢豪华，灯光被调至昏暗。调亮灯光发现，除一个房间内设上下铺为员工宿舍外，其他4室内均放置有按摩床，其中2室内带卫浴间，另外还设有两个独立的卫浴室。一对裸浴男女就是在大厅前台背后一个隐秘的带浴室的房间内被发现的。在房内东南角的独立卧室墙壁上还设有一个悬挂钟表，钟表的12个数字都被色情图案代替。民警随后在屋内搜出多盒避孕套及御境SPA养生会所的宣传册、会员卡、会员消费记录、会所账本、管理规章及女技师提供色情服务标准技巧手抄本等涉案物品。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;供述&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;涉黄会所服务880元起&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;4月27日晚上9点，10名涉案人员在万寿路派出所接受调查。嫌疑人朱朱(化名)供述，她今年29岁，河南人，来京4年，一直从事销售工作。今年3月8日，她通过招聘网站看到会所招聘销售和记账员，于是通过所留信息取得联系，一名郭姓男子约她在案发高档公寓7层大厅面试，随后她获得这份工作。&lt;/p&gt;\r\n\r\n&lt;p&gt;朱朱供述，她每天的工作是负责给客户介绍项目、推销注册会员、售票记账及派女技师接活儿。会所服务分为880元到2980元不等。女技师会根据不同的客人提供各种各样的淫秽色情服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;聘19岁高职学生接送客&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;据着卡通外套女子亮亮(化名)供述，她是北京市某高职学校的在校学生，今年只有19岁。她称起初是想找一份实习兼职的工作，后来在招聘网站看到了招聘信息，随后前来面试。面试女子告诉她，只需要将客户接送至房间即可，并不需要做其他工作就可以获得丰厚收入。&lt;/p&gt;\r\n\r\n&lt;p&gt;亮亮称她随后答应了做这份工作，只做了几天，就感觉不对，害怕了想不做，她称并不知道自己接送的男子都是来做何服务。当民警询问她会所内抓获嫌疑人有的全身裸体有的衣着暴露，且已在监控视频发现她在此工作多日，她仍以原理由狡辩，拒绝交代。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;团购网员工上门改单被抓&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;据朱朱供述，会所的老板通过某团购网站做宣传，同时提供团购服务，团购的价格相较原价位实惠。&lt;/p&gt;\r\n\r\n&lt;p&gt;据在现场被抓获的涉案人员王某某介绍，他是某团购网负责客户业务的工作人员。案发当日，他前往这家店铺是应店铺要求前来更改商家网页单子，“有一个588元的团购内容要撤销掉”。&lt;/p&gt;\r\n\r\n&lt;p&gt;当记者询问他，现在知道该会所什么性质时，他表示可能“涉黄”，“不会给我们知道内容(具体服务内容)。”&lt;/p&gt;\r\n\r\n&lt;p&gt;王某某表示，其所在团购网站总部运营对注册商家是有审核的，系统有风控审核，会根据商家上传的图片做区分审核，通常情况下有着短裙等暴露服饰、内容“刺激”图片的商家是不能通过审核的。一般商家注册两个月后，通过审核就可以使用团购服务，商家每完成一单团购，获利的百分之十会给网站作为提成。&lt;/p&gt;\r\n\r\n&lt;p&gt;当记者询问，若其所言属实，此次前来修改订单是否发现店铺有问题，王某某称“这家店涉黄”。他表示，该团购网站的审核系统不是很全面，商家通过审核后可以自己改相关信息，审核系统并不完善，无法确保审核准确无误。&lt;/p&gt;\r\n\r\n&lt;p&gt;4月27日晚11点左右，10名涉黄嫌疑人被民警带往海淀区公安分局执法办案中心接受进一步调查。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;调查&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;美团大众点评存色情服务&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;记者随后从警方知情人处确认，被抓员工就职于美团网，是负责客户业务的工作人员。&lt;/p&gt;\r\n\r\n&lt;p&gt;4月27日晚上和4月28日上午，记者在美团和大众点评两家团购网站手机APP内均搜索到了“御境男士SPA养生会所”店铺，地址描述仅详细到其所在公寓。&lt;/p&gt;\r\n\r\n&lt;p&gt;店铺类别分别为“保健／按摩”和“足疗／按摩”。两家软件的团购内容均有688元、888元、1188元、1688元、2980元5种，分别售出22个和25个团购。团购项目的名称有“单人至高无上性经伊朗SPA套餐”、“单人至高无上性经净灵SPA套餐”等包含“性”字样的隐晦词语。&lt;/p&gt;\r\n\r\n&lt;p&gt;在美团网该会所一个标注门市价为5980元、团购价为2980元的团购页面内，记者看到，团购套餐的介绍中写着“极乐风情助浴+深海矿物有机浴盐+极乐互动+角色扮演+丝丝情谊+普世古流+贵妃玉指+鼻划+巴黎臀护+魅欲体疗+臀部指压+丝划+巴黎热疗+极乐意境空间幂想”等具有隐晦色情内容的介绍。在大众点评网该会所的各项团购介绍内，也包含同样内容的文字。&lt;/p&gt;\r\n\r\n&lt;p&gt;记者查询两款APP的该会所店铺图片发现，除了会所内部照片外，APP上还有身着暴露女子为半裸男士按摩的图片或不同暴露程度的照片。&lt;/p&gt;\r\n\r\n&lt;p&gt;两APP该会所团购的评论数量为19和31个，内容包括“我想到的没想到的服务都给我想到了”、“一句话，男人的好去处”等带有隐晦性暗示的评论。&lt;/p&gt;\r\n\r\n&lt;p&gt;昨天下午，记者再次在美团和大众点评两家团购网站和手机APP内均搜索到了“御境男士SPA养生会所”店铺，发现该会所的信息及评论仍在，相关衣着暴露女子照片仍在，只不过所有团购内容已全部下架。&lt;/p&gt;\r\n\r\n&lt;p&gt;昨天，记者从海淀警方获悉，目前7名违法行为人因卖淫嫖娼被治安拘留，其他3人因情节较轻被批评教育后释放。&lt;/p&gt;', 1, NULL),
(4, 4, 's:26:"百度,定位公司,转账";', '都说不能太信网上的东西，更何况是转账。1日，家住沙坪坝劳动村的刘女士丢失了一部苹果6S，她没有报警，却在百度上搜索定位公司，结果被诈骗1400元。\r\n百度搜个公司寻手机\r\n1日中午，20多岁的刘女士坐出租车到二郎走亲戚。下车时将新买的苹果6S落在出租车后座上，连车牌都没记录下来，\r\n刘女士马上用朋友的电话拨打手机，响了几声后却被挂断。再次拨打时已关机。', '&lt;p&gt;都说不能太信网上的东西，更何况是转账。1日，家住沙坪坝劳动村的刘女士丢失了一部苹果6S，她没有报警，却在百度上搜索定位公司，结果被诈骗1400元。&lt;br&gt;&lt;b&gt;&lt;samp class=&quot;redactor-inline-converted&quot;&gt;百度搜个公司寻手机&lt;/samp&gt;&lt;/b&gt;&lt;br&gt;1日中午，20多岁的刘女士坐出租车到二郎走亲戚。下车时将新买的苹果6S落在出租车后座上，连车牌都没记录下来，&lt;br&gt;刘女士马上用朋友的电话拨打手机，响了几声后却被挂断。再次拨打时已关机。&lt;br&gt;“听说苹果手机可以通过定位找到所在位置。”刘女士便在百度搜索引擎中输入“苹果手机掉了怎么办”。这一搜，无数网站就蹦了出来。&lt;br&gt;刘女士在搜索结果首页靠前的位置点开了一个自称“专业找回手机团队”的网站，通过QQ与客服取得联系，对方给她发过来营业执照——北京××通信技术有限公司，并称1400元就可以成功定位并找回丢失手机。&lt;br&gt;这1400元不用一次性付完，只需预付300元，就可以告诉手机位置，找到手机后再支付余款。&lt;br&gt;&lt;b&gt;&lt;var&gt;&lt;samp&gt;转账1400元被对方拉黑&lt;/samp&gt;&lt;/var&gt;&lt;/b&gt;&lt;br&gt;最开始，刘女士还是怀疑，手机关机了，还能不能够定位？客服回答，“只要手机还有电，我们就能通过软件定位！”&lt;br&gt;刘女士想，毕竟1400元是分阶段打，300元也不太多，便通过微信向对方公司转账300元，并提供手机号码和丢失手机时所在位置。&lt;br&gt;刘女士通过手机上网，马上在QQ上收到一张地图截图。客服称，手机目前在石桥铺的一家网吧内。刘女士问，到了网吧门口，怎么确认人。对方说，再付600元，通过木马激活手机响铃，手机就可以找到了。&lt;br&gt;刘女士再转账600元，当她到达所说的网吧时，对方却以系统即将关闭为由，让她将剩余500元转过去。刘女士有所警觉，但还是转了账。&lt;br&gt;“可对方收到钱后，还以手机关机，需要用其他技术手段，再转600元到账上。”刘女士有点气愤，在QQ上质问客服，对方很快就将刘女士的QQ和微信拉黑。&lt;br&gt;2日傍晚，刘女士才打110报警。目前，磁器口派出所已受理刘女士的报案。&lt;br&gt;&lt;b&gt;&lt;mark&gt;苹果店员称关机无法定位&lt;/mark&gt;&lt;/b&gt;&lt;br&gt;昨天，重庆晚报记者咨询了解放碑一家苹果专卖店。店员称，苹果手机确实有定位以及激活铃声提醒功能，但前提都是在手机仍开机的情况下。网上那些所谓的“定位公司”“找回公司”的说法，都是不可信的。&lt;br&gt;民警告诉重庆晚报记者，所谓让丢失者发送丢失地点，是好确认丢失人的具体位置，方便在地图上寻找周边的公共场所，随意给你截图就说是卫星定位。&lt;br&gt;百度回应：涉及违法举报后再调查&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;i&gt;昨日，重庆晚报记者联系上百度西南片区的相关负责人。负责人称，刘女士可能遇到钓鱼网站或是诈骗网站，这些网站名称变化很快，诈骗完了就找不到了。&lt;br&gt;负责人称，百度每年都会对一些正规的公司审核后加V。如果网友在这些通过审核的公司上当受骗，百度会先行赔付。如果是不良网站，调查后会对网站进行下站、暂时封号、永久封号。&lt;br&gt;百度搜索排名，给钱就行？负责人称，目前，不是单纯的看钱排名，这个新系统在2009年就开始使用，有自然结果和推广结果两种情况，自然结果就是不收费的排名，推广结果是收费的排名。对于推广结果，重要的是用户搜索的吻合度。其次是公司实力排名。一旦涉及不良的营销和违法，有人举报，就会调查。&lt;br&gt;&lt;/i&gt;&lt;/p&gt;', 1, NULL),
(5, 5, 's:38:"网购,购物安全,https,诈骗陷阱";', '在网络上购物，都离不开网银支付。但网络支付时，你的钱安全吗?据央视新闻报道，近期警方破获一个网络诈骗团伙，他们设置假冒购物网站，将受害者网银内的钱全部转走!\r\n对此，央视特别提醒，完成网购订单进入支付页面，网址前缀会变成“https”，表示已加密;若支付页面仍是“http”，一定提高警惕!扩散周知!', '&lt;p class=&quot;text-center&quot;&gt;&lt;img src=&quot;http://admin.itousu.net/uploads/users/images/1f160638/dd740a7b659e629892e5f50e99297641.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;在网络上购物，都离不开网银支付。但网络支付时，你的钱安全吗?据央视新闻报道，近期警方破获一个网络诈骗团伙，他们设置假冒购物网站，将受害者网银内的钱全部转走!&lt;br&gt;对此，央视特别提醒，完成网购订单进入支付页面，网址前缀会变成“https”，表示已加密;若支付页面仍是“http”，一定提高警惕!扩散周知!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;a href=&quot;http://itousu.net&quot;&gt;&lt;img src=&quot;http://easyread.ph.126.net/7VZw59bEqGymgTOvEfdzLw==/7916933420246364650.jpg&quot; alt=&quot;&quot; title=&quot;&quot;&gt;&lt;/a&gt;&lt;br&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;h4&gt;如何识别网购诈骗陷阱?&lt;/h4&gt;&lt;p&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;①退款索要验证码的都是诈骗&lt;/strong&gt;&lt;br&gt;任何网购退款均无需提供银行卡密码和CVN2。任何索要短信验证码的行为都是诈骗。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;②不要轻信“低价”购物网站&lt;/strong&gt;&lt;br&gt;在登录网址时，警惕所谓的“安全中心”、“认证中心”，不要轻信“低价”购物网站，并警惕通过邮件、短信、聊天工具发来的所谓“安全中心”、“认证中心”、“担保平台”等钓鱼网站链接。&lt;/p&gt;&lt;h4&gt;&lt;br&gt;网络购物如何安全用卡?&lt;/h4&gt;&lt;p&gt;&lt;br&gt;①在网络购物时应严格保密个人信息，注意识别钓鱼网站。&lt;/p&gt;&lt;p&gt;&lt;br&gt;②身份证号、银行卡号、密码、交易短信验证码，以及信用卡有效期、校验码(CVN2，背面签名条上数字的后三位)等个人信息务必妥善保管。&lt;/p&gt;&lt;p&gt;&lt;br&gt;③为保护终端设备安全，应及时下载并安装由银行或电商提供的用于保护客户端安全的控件，保护账户密码不被窃取。定期更新杀毒软件，防范电脑中毒。&lt;/p&gt;&lt;h4&gt;&lt;br&gt;发现银行卡被盗刷如何补救?&lt;/h4&gt;&lt;p&gt;&lt;br&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;①立即致电发卡银行或支付机构&lt;/strong&gt;&lt;br&gt;发现被骗后，请拨打相关机构的官方客服电话反映情况，越早致电挽回损失的希望就越大。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;②及时冻结或挂失卡片账户&lt;/strong&gt;&lt;br&gt;因为银行卡账户信息已经被骗子获取，为避免损失再度发生，请持卡人记得通知银行或支付机构冻结或挂失卡片账户。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong class=&quot;redactor-inline-converted&quot;&gt;③拨打110并咨询如何取得报警证明&lt;/strong&gt;&lt;br&gt;部分支付机构需持卡人提供报警回执作为否认交易的证明材料，由于公安机关对案件受理地有规定，建议持卡人在前往派出所报案前先拨打110咨询。&lt;/p&gt;&lt;h4&gt;&lt;br&gt;网购被坑了，找他们投诉：&lt;/h4&gt;&lt;p&gt;①消费者投诉举报专线：&lt;mark class=&quot;redactor-inline-converted&quot;&gt;12315&lt;/mark&gt;(异地投诉需加拨区号); &lt;samp class=&quot;redactor-inline-converted&quot;&gt;&lt;a href=&quot;http://itousu.net/login&quot;&gt;投诉网投诉&lt;/a&gt;&lt;/samp&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;②在购买官方平台进行投诉：在购买平台进行投诉，无论你是在&lt;samp class=&quot;redactor-inline-converted&quot;&gt;天猫&lt;/samp&gt;、&lt;code&gt;京东&lt;/code&gt;，&lt;var&gt;还是在&lt;kbd&gt;国美&lt;/kbd&gt;&lt;/var&gt;、&lt;samp&gt;苏宁&lt;/samp&gt;上购买，只要你买的东西有质量方面的问题，就可以上投诉专区按照分类进行投诉举证。&lt;br&gt;另外提醒，慎重保留消费凭据。消费者网购应注意留存好&lt;mark&gt;订货单、发货凭证、发票、网上商品交易图片以及与商家聊天记录等资料&lt;/mark&gt;，并索取有效购物凭证或发票，以备发生消费纠纷时用于维权。&lt;br&gt;如果你在网购时发现自己的权益受到侵害，拿起手机，不要犹豫!&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, NULL),
(7, 7, 's:39:"鸡汤,转发,虚假广告,网络安全";', '每天早上起来打开微信，总会发现朋友圈被各式各样的鸡汤文刷屏。标题往往是这样的：《生活的坑往往是自己挖的》、《给对将来感到不安的你》，抑或是以专家学者口吻告诫你：《姑娘啊！可长点心眼》、《人生不得不提的30个忠告》、《这五种食物千万不能吃》……\r\n令人想不到的是，微信好友们转发的这些文章，是在为别人赚钱，鸡汤文背后暗藏着获利丰厚的“转发”产业链。', '&lt;div&gt;\r\n&lt;img src=&quot;http://itousu.net/uploads/users/images/1f160638/cef5efb4107e23753293dcc8e8b5d9b6.jpg&quot; alt=&quot;虚假广告傍上鸡汤文 10万加文章转发平台可获3万&quot; title=&quot;虚假广告傍上鸡汤文 10万加文章转发平台可获3万&quot;&gt;\r\n                                &lt;p class=&quot;otitle&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;f_center&quot;&gt;某转发平台鸡汤文广告产品——血钻野燕麦。宣称能“壮阳”，实为压片糖果。&lt;/p&gt;&lt;p&gt;每天早上起来打开微信，总会发现朋友圈被各式各样的鸡汤文刷屏。标题往往是这样的：《生活的坑往往是自己挖的》、《给对将来感到不安的你》，抑或是以专家学者口吻告诫你：《姑娘啊！可长点心眼》、《人生不得不提的30个忠告》、《这五种食物千万不能吃》……&lt;/p&gt;&lt;p&gt;令人想不到的是，微信好友们转发的这些文章，是在为别人赚钱，鸡汤文背后暗藏着获利丰厚的“转发”产业链。&lt;/p&gt;&lt;p&gt;近日，新京报记者调查发现，鸡汤文大多由专门的微信公号或者APP等转发平台进行分发，注册人员再通过转发此类附带广告的文章来获取分成，每转发或点击一次1到6分钱；一篇10万+文章，转发平台可获得3万元左右的灰色收入。&lt;/p&gt;&lt;p&gt;鸡汤文除了制造垃圾信息，内置的广告还会给网友带来误导，甚至就是一骗局。&lt;/p&gt;&lt;p&gt;网络安全专家指出，朋友圈鸡汤文逐渐取代电视购物，成为劣质保健品、假冒伪劣药品、减肥丰胸类产品的营销渠道。由于缺乏监管，虚假夸大广告效果，其产品质量甚至会更差。&lt;/p&gt;&lt;p&gt;鸡汤文刷屏背后暗藏虚假广告&lt;/p&gt;&lt;p&gt;27岁的东北女孩宋瑜（化名），备受家人转发的养生帖、鸡汤文困扰。在她父亲的朋友圈里，整日被“人生要交的四位朋友”、“枸杞搭一物，胜吃唐僧肉”等文章刷屏。&lt;/p&gt;&lt;p&gt;去年6月，宋瑜的父亲申请了微信号，之后每天都会给她转发大量的养生和心灵鸡汤文章，最多一天二三十条。&lt;/p&gt;&lt;p&gt;有时早上不到六点钟，手机叮叮的提示音就将宋瑜吵醒，她一看是父亲发来的一条《早晨吃鸡蛋的惊人好处，你知道吗？》”&lt;/p&gt;&lt;p&gt;还没到单位，父亲又来一条《郁闷的时候看看这头驴，改变你的心态！》”&lt;/p&gt;&lt;p&gt;经常会开到一半，宋瑜的手机就响起一连串的“叮叮叮”，她说，不用看，一定又是她老爸转发的养生鸡汤文。&lt;/p&gt;&lt;p&gt;“他不仅单独发给我，还每天发朋友圈，觉得有用的他就转。”宋瑜说。&lt;/p&gt;&lt;p&gt;但宋瑜想不到的是，父亲的热心肠转发可能是在替别人“挣钱”，更有可能会害人。&lt;/p&gt;&lt;p&gt;2015年3月，据《南方日报》报道，广东的老刘在网上花1760元，买了一种“血钻野燕麦”的男性保健品。服用之后，老刘接到骚扰电话。不断有“总监”、“院长”等人物，以治病为借口让老刘买各种乱七八糟的药物；而后出现的“消保委人员”、“财务人员”、“经理”等角色，则说前面“出场”的人有问题，称给老刘补偿，但要其交税。&lt;/p&gt;&lt;p&gt;就这样，短短几个月时间，老刘汇了14笔款，共计54万多元。然而，吃了这么久，一点效果都没有，最终老刘报警。警方经过两个多月调查，在广西南宁一举捣毁这个诈骗团伙，共抓获17人。据悉，为了骗老刘，诈骗团伙先后出动了8人。&lt;/p&gt;&lt;p&gt;“血钻野燕麦”的骗局还在继续，而他们可能正隐藏在鸡汤文当中。4月18日，新京报记者在两家不同转发平台的文章下方广告链接中，找到两个宣称免费领取的商品。&lt;/p&gt;&lt;p&gt;其中《这样减肥，10人有9人成功》文章下方链接的正是上述被曝光的“血钻野燕麦”，广告宣称“进口阿拉伯，瞬间坚挺，服用20到40天，能持续生长4-7厘米”。&lt;/p&gt;&lt;p&gt;记者在广告页填写了电话、住址之后提交。次日，客服打来电话称，商家在武汉，从武汉邮寄两盒产品，需要邮费及材料费共计200元。&lt;/p&gt;&lt;p&gt;4月21日，记者收到了“血钻野燕麦”，包装盒上写有代收200元。快递人员表示，商品寄过来的邮费已经付清，为18元。&lt;/p&gt;&lt;p&gt;“血钻野燕麦”的外包装上则用小字标示“压片糖果”，制造商为广东省的一家生物科技公司，采用的则是食品生产许可证号。通过国家食药监官网查询得知，该企业食品生产许可证号仅为生产糖果。&lt;/p&gt;&lt;p&gt;猎豹移动安全专家李铁军指出，上述付邮免费送实则就是陷阱，消费者所付费用远远高于邮费及商品价值。此种广告通过微转平台传播，平台利用转发文章或者广告链接分成诱导网友在朋友圈大量转发虚假广告。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;转发文章，“躺着月入万元”？&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;新京报记者调查发现，鸡汤文由专门的微信公号或APP等转发平台进行分发，注册人员再通过转发此类文章获得提成。&lt;/p&gt;&lt;p&gt;“转发分享文章就能赚钱，1分钟赚1元，躺着月入万元。”这样的广告语在每个人的朋友圈都有可能出现。&lt;/p&gt;&lt;p&gt;记者通过微信及相关APP平台，搜索“转发文章”，能够搜到很多此类转发任务平台公众号。&lt;/p&gt;&lt;p&gt;认证为“厦门某网络科技有限公司”的转发类公众号中，有“开始赚钱”“新手学堂”等功能，点击“开始赚钱”，会跳转到第三方页面，需要用户用手机号注册登录。&lt;/p&gt;&lt;p&gt;在多款任务平台转发页面，记者发现，转发文章不外“健康”、“育儿”、“风水”、“情感”等类型，每篇文章都有转发及浏览收益，从0.01元到0.06元不等。&lt;/p&gt;&lt;p&gt;厦门这家转发平台客服人员介绍，用户将文章分享到朋友圈后，只要有人阅读，系统会自动统计阅读量，每次有效阅读，用户可以获得0.03元至0.05元，如果有人再次转发的话，阅读提成也同样分给注册用户。&lt;/p&gt;&lt;p&gt;上述任务平台称，用户还可以招收徒弟，当徒弟分享文章获得收入时，每次收入提现成功时，会有提现金额的20%作为初始客户的下线提成。&lt;/p&gt;&lt;p&gt;不难发现，转发平台上的每一篇文章末尾都植入了广告。曾经做过半年转发文章业务的网友“温水杯”说。平台和转发者的收益都来自广告主，当然转发者拿到的只是一小部分。&lt;/p&gt;&lt;p&gt;“温水杯”介绍，2013年左右，各类的转发平台开始在微信中出现，去年达到竞争高峰。“原来好的时候，一天能赚到百十来块，后来转发平台多了，做的人也多，加之腾讯打击，转发文章的收益逐渐下降。”&lt;/p&gt;&lt;p&gt;而那些链接在鸡汤文中的广告，也会视文章内容而定，比如健身类文章，头尾部的广告就会是丰胸、减肥等等。同时，这些鸡汤文的尾部都带有产品推广链接，只要点击进去，就会看到相应产品的功能介绍和购买链接。&lt;/p&gt;&lt;p&gt;“这样在正常转发的人不知道的情况下，有人就把钱赚了。买的人还不少，不然哪来的钱付给转发者。”温水杯说。&lt;/p&gt;&lt;p&gt;“只要给钱，啥广告都可投”&lt;/p&gt;&lt;p&gt;“大多数广告都带有色情性质的，只要给钱，啥广告都可以投。”鸡汤文转发平台内部人士说。&lt;/p&gt;&lt;p&gt;在多个鸡汤文转发平台，每篇文章首尾均有大量广告，多涉及丰胸减肥、保健品等。&lt;/p&gt;&lt;p&gt;一篇“上班族经常感冒需要减减压”的养生文章内，植入大量广告，图片上的女性性感暴露，配文挑逗露骨。“艺校女生被潜规则”、“17岁女友被囚禁当××”。点击进入后，则是一款男性保健用品的广告，当中的康复感言类似于色情文章。&lt;/p&gt;&lt;p&gt;同样在一篇转发10万+的新闻视频文章内，植入了大量的色情广告，点击进入后，发现是一款保健内裤的广告。&lt;/p&gt;&lt;p&gt;经过对比发现，在淘宝上几十元包邮的减肥茶、减肥胶囊、保健内裤等，同品牌、同规格产品在朋友圈里可以卖数百上千元，价格相差十倍以上。&lt;/p&gt;&lt;p&gt;一位转发平台业内人士介绍，转发文章的头尾位置会自动显示广告，植入色情图片的目的就是让人看了就想点，这样才能提高广告转化率。&lt;/p&gt;&lt;p&gt;前述转发平台的负责人称，目前转发平台广告大多针对丰胸减肥、男性保健等产品，这些产品都有虚假宣传的嫌疑，因此这些产品在正规平台投放不了广告。&lt;/p&gt;&lt;p&gt;转发平台也会对广告有所顾忌，一眼就看出危及到人命的虚假广告，转发平台也不敢接。一转发平台负责人透露，例如有广告主要宣传癌症药，告诉人家几个疗程就能治愈，这种广告就不做，相对风险大，“几十块钱的东西对外卖几千，我们也不敢接。”&lt;/p&gt;&lt;p&gt;记者以投放广告为由联系了多家转发平台，工作人员均表示，不需要对记者的产品进行提前检测，即使不在同一城市，也可交钱直接上广告。&lt;/p&gt;&lt;p&gt;对于产品质量，一位平台负责人表示，“不会检验你产品的真假，因为鸡汤文广告本身就有打擦边球嫌疑。只要产品不害人害命，别的都没事。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;非正规平台的生意经&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;碰上10万+的点击，一篇鸡汤文的广告费就达3.5万元，除去转发平台每点击一次0.01元至0.06元的成本，一篇10万+鸡汤文，转发平台可赚3万元左右。&lt;/p&gt;&lt;p&gt;4月12日，新京报记者联系一家名为“微转淘金”的转发平台，该平台位于通州北关桥附近一小区内的三室一厅房间内。&lt;/p&gt;&lt;p&gt;4月14日上午11时许，该平台办公室内，10多名员工正在维护网页。&lt;/p&gt;&lt;p&gt;该平台负责人王业武自称做茶生意，微转淘金只是公司的一款产品。他把这个平台当做赚钱的“机会”，“要是想挣钱就要进行一些规避。就像保健品，正规平台不可能随意夸大宣传。”&lt;/p&gt;&lt;p&gt;王业武的名片显示为问山问水（北京）科技有限公司总经理，自称创办了中国茶道网。而此网站地址正是“微转淘金”的通州办公地点。&lt;/p&gt;&lt;p&gt;“微转淘金主要接一些不能在正规平台投放的保健品广告。”王业武介绍，该平台广告主要按三种方式付费，一种是按文章点击量，通过文章将广告转入到产品页面，0.5元每次；二是按阅读量，把产品写在文章里面，加入产品和个人QQ微信号，一次阅读0.35元；还有一种是留电，广告上会让消费者留电话，平台再以每个电话60元卖给商家。&lt;/p&gt;&lt;p&gt;王业武解释，平台上有个系统，广告主和平台方都能看到，阅读者每天留了多少电话都有登记。广告主让对方留电话，也有噱头，“送些小礼品，对方就会主动留下电话、住址，广告主把这些信息收回来，再给对方打电话进行主动营销。”&lt;/p&gt;&lt;p&gt;在微转淘金平台，王业武把保健丰胸美容产品归类到高风险广告，每点击一次，广告主需付0.5元。广告主通过预付费“充值”方式交费。比如某保健品广告一个月的预算是五万元，广告主就先充值五万，然后按文章点击量消耗，等消耗完了再进行充值。&lt;/p&gt;&lt;p&gt;王业武的说法得到了另一转发平台负责人印证。转发平台用大量的注册用户来吸引广告主。每次点击，广告主按0.35元到0.5元付费。&lt;/p&gt;&lt;p&gt;按照王业武给出的数据，如果碰上10万+的阅读文章，一篇鸡汤文的广告费就达3.5元，除去转发平台每点击一次0.01元至0.06元的成本，一篇10万+鸡汤文，转发平台赚3万元左右。&lt;/p&gt;&lt;p&gt;王业武称，微转淘金平台除了减肥、保健品广告，还有风水类的貔貅及高仿手表广告，这些出现在电视购物上的广告，如今都转战到了微信朋友圈。&lt;/p&gt;&lt;p&gt;有转发平台负责人坦言，想赚钱，就要打擦边球，一些类似微转金的平台还涉及到传销，转发文章按照倒金字塔结构逐一分成，越往上层的用户拿到的分成也就越多。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;无序的市场与监管空白&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;大量存在的转发平台以及背后的广告，该由谁来监管？微信团队及工商部门目前也都是以接受举报和提示风险为主，并无有效的监管措施。&lt;/p&gt;&lt;p&gt;一位转发平台的内部人员介绍，转发平台最初的兴起就是面对微信群体，伴随着微信的发展而泛滥。&lt;/p&gt;&lt;p&gt;“去年年底，转发平台业务量达到高峰。伴随此现象，微信方面的封号屏蔽力度也开始加大。很多积累到大量用户的转发平台都开发了APP。或是通过公众号转入第三方链接来规避。”他说。&lt;/p&gt;&lt;p&gt;“朋友圈的干扰越来越多，只能说明这里面有问题。”网络安全人士说，三四线城市及刚使用微信的中老年人喜欢转发一些骇人听闻事件及养生鸡汤等文章，不法分子正是利用这一点，在文章当中植入虚假广告，以此牟利。&lt;/p&gt;&lt;p&gt;他表示，目前的转发平台，类似互联网时代的个人站长，手法也比较接近，有很多小站，扒其他网站的内容，稍加修改后向外宣传，达到一定流量之后，去换广告。此前一些不正规的保健品、假冒伪劣商品的广告主要投放在一些小网站，如今已将阵地转移至微信朋友圈。&lt;/p&gt;&lt;p&gt;“现在对于这类APP的监管，已不仅仅是漏洞，而是空白。程序本身不违法，但利用程序干违法的事儿，却很难监管。”这位网络安全人士表示。&lt;/p&gt;&lt;p&gt;新京报记者注意到，2016年3月10日，微信公告称，将对“转发赚钱、刷分刷榜类”的诱导行为进行处罚，处罚形式包括删文、限制账号部分能力或封禁账号等。&lt;/p&gt;&lt;p&gt;对此，微信团队回复称，“很多转发平台所进入的均是外部链接，微信有相应的管理规范，主要的措施还是依据用户举报。”&lt;/p&gt;&lt;p&gt;\r\n&lt;/p&gt;&lt;div class=&quot;gg200x300&quot;&gt;\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\r\n&lt;/div&gt;&lt;p&gt;而对于存在的虚假违规广告，微信团队表示，对于此类恶意广告在微信中的出现，微信也是受害者。&lt;/p&gt;&lt;p&gt;据一名工商系统人士介绍，针对朋友圈的广告监管确实为空白。目前，工商能做的也就是提示风险。该人士解释，微信等网络交易行为隐蔽，不能提供发票等相关证据，一旦出现投诉，兜售产品的一方可以随时消失，让监管部门无法找到当事人。“如同微商一样，说到底是没有资质的，也不好监管，像两人之间的私下交易。”&lt;/p&gt;&lt;p&gt;该人士建议，对于微商可通过消费者举报和线上线下一体化管理，重点从商品及服务提供者是否具备相关资质，是否发布虚假宣传信息，是否涉嫌传销等方面开展日常监管。&lt;/p&gt;\r\n                                            &lt;/div&gt;', 1, NULL),
(8, 8, 's:30:"新疆,烤肉店,非法经营 ";', '克里木和他的烤肉店突然走红。\r\n\r\n一组时尚照片，一条网络报道，让新疆人克里木和他的烤肉店在近几天之内火了起来。\r\n\r\n5月14日，澎湃新闻记者实地探访这家位于上海浦东的烤肉店，排队尝鲜的食客绵延近50米。记者注意到，排队的人群中有专程来吃烤肉的，也不乏有人来一睹烤肉店老板的风采。\r\n\r\n不过，老板克里木坦言，烧烤店开业15天了，但是还未办理相关营业执照、餐饮许可、从业人员健康证等证照，“现在属于试营业，正准备办理相关营业证照……”', '&lt;p&gt;&lt;img src=&quot;http://admin.itousu.net/uploads/users/images/1f160638/50edc267d2f0740624d7df6859233765.jpg&quot;&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;克里木和他的烤肉店突然走红。&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;一组时尚照片，一条网络报道，让新疆人克里木和他的烤肉店在近几天之内火了起来。&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;5月14日，澎湃新闻记者实地探访这家位于上海浦东的烤肉店，排队尝鲜的食客绵延近50米。记者注意到，排队的人群中有专程来吃烤肉的，也不乏有人来一睹烤肉店老板的风采。&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;不过，老板克里木坦言，烧烤店开业15天了，但是还未办理相关营业执照、餐饮许可、从业人员健康证等证照，“现在属于试营业，正准备办理相关营业证照……”&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;&lt;img src=&quot;http://www.itousu.net/uploads/users/images/1f160638/c02acac0647b3c8cb9810c7f6a540ed3.jpeg&quot;&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;克里木所开烤肉店外的队伍。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;strong&gt;食客普遍排队两小时&lt;/strong&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;5月14日17时许，位于浦东的烤肉店，招牌下面挤满了人，看不清门口的位置。马路外侧的非机动车道上，有不少人边走动边对着这家烤肉店拍照、录小视频。走近才发现，一条长长的队伍已经延伸到两根电线杆之外，粗略估计有近50米长。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;“我们下午3点多就到了，那时候烤肉店还没开始营业，但已经有人在店里占位，外面也有人排队了。”从徐汇区赶来的的叶女士和丈夫排了两个小时的队，终于挪到了烤炉附近。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;17时30分许，从闵行开车过来的谢女士一家三口终于吃到了烤肉。她说下午3点就来排队，为的就是能一饱口福，“和外面的烤肉相比，这里的肉比较新鲜，肉块够大，价格也还可以。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;烤肉店没有明码标价的菜单，价格都是顾客都从买单处收银人员的口中获知。由于排队时间长，许多顾客都能清晰背出各项单品的菜价。“羊肉串10元3串，30元10串。大里脊羊肉串10元1串，小羊排10元1串，大羊排25元1串。”谢女士和家人总共消费了175元。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;由于点单、烤肉等环节都比较花时间，排队的队伍总体前进的速度较为缓慢。澎湃新闻记者在现场看到，有一对抱着孩子的年轻夫妻甚至为了是否要继续排队争执起来。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img src=&quot;http://www.itousu.net/uploads/users/images/1f160638/8b6930d4ddc8ba0284b99427be5cb5df.jpeg&quot;&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;烤肉店老板新疆人克里木。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;strong&gt;从摊贩到店老板&lt;/strong&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;在排队的食客中，不少年轻女孩趁着排队的空闲，拍下了烤肉店老板的忙碌身影，有一位中年阿姨甚至专门从队伍的最后跑到前头来拍照片。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;在朋友圈被疯狂转载的文章中，有一组克里木的时尚大片。照片里，他身着正装，或休闲或商务，手表、墨镜、腰带等男性时尚元素一应俱全，帅气而迷人的脸庞上看不出沧桑。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img src=&quot;http://www.itousu.net/uploads/users/images/1f160638/3b052bc35e574fd73e19a17282bc800b.jpeg&quot;&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;克里木在烤串。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;在烤炉旁边，克里木专注于炭火上的羊肉，和伙伴一起紧张地在火上放好羊肉串，观察肉色的变化，撒配料、调火候、翻面……&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;趁着烤肉的间隙，克里木和澎湃新闻记者聊起了他的烤肉生意，他说自己未从料到会有这样忙碌的场面，而这家烤肉店从盘下来到今天，才刚刚半个月而已。这之前，克里木的烤肉生意只是一个没有门店的临时摊位。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;他说，自己来上海已有7年，曾在上南路附近流动烤肉，后来因为露天烤肉的烟雾污染问题和流动摆摊的经营方式，他经常遇到城管的清理，最终让他决心要拥有自己的门店。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;安顿下来以后，新的经营方式让他更忙碌了。“开业以来，店里一共5个固定员工，5个临时工。从下午一直忙到深夜一两点，连晚饭都来不及吃。”克里木说，为了集中精力烤肉，他们每天营业之前吃完午饭，要到深夜打烊之后才能吃到第二顿饭。“这两天生意更加好了，门口排队的人越来越多，原来计划可以供应到凌晨两点的食材，一般到晚上十点多就会卖光。”&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img src=&quot;http://www.itousu.net/uploads/users/images/1f160638/afb75299426f0e06431a7f06fec8088c.jpeg&quot;&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;刚出炉的烤肉串。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;记者采访当日近18时，听到排队的人群中有人喊“肉快不够了”。向克里木打听，原来当时，原本可以供应一天的食材只剩30至40人的供应量了，“大概还能维持两个多小时营业时间”。既然生意这么好，当日会不会加货营业？克里木略显疲态地回答记者：“不加了，身体吃不消了。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;strong&gt;“帅气烤肉店”暂无证&lt;/strong&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;p&gt;克里木向记者坦言，他的烧烤店虽然已经开业，但是还未办理相关营业执照、餐饮许可、从业人员健康证等证照。“我们现在属于试营业，准备办理相关营业证照，但没想到一下子就这么火爆，会马上把证照配齐。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;5月15日，澎湃新闻记者从上海市浦东新区市场监管局了解到，该局当日派执法人员前往现场后发现，该店确实没有办理相关营业证照，按规章制度来说，属于不合规经营。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;“我局执法人员已与该店老板约定，明日店老板和其汉族朋友将前往局里配合做进一步调查。”浦东市场监管局人士表示，将在调查后再作进一步处理。澎湃新闻记者从上海市食药监局获悉，在我国现行法律法规中，餐饮开店政策并不因民族差异或国籍不同而有任何不同。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, NULL),
(9, 9, 's:20:"旅游,携程,宾馆";', '消费者郑先生称自己通过携程网预订房价为800元/晚的酒店房间，网页却在他不知情的情况下“自动跳转”，强制预订了总价6400元的高级套房，导致信用卡内5000元担保金被扣取。\r\n', '&lt;p&gt;消费者郑先生称自己通过携程网预订房价为800元/晚的酒店房间，网页却在他不知情的情况下“自动跳转”，强制预订了总价6400元的高级套房，导致信用卡内5000元担保金被扣取。&lt;/p&gt;\r\n\r\n&lt;p&gt;他以携程构成欺诈为由起诉至上海长宁法院，要求被告支付担保金及担保金的三倍赔偿金、差旅费、律师费等共计近3万元。澎湃新闻获悉，此案5月19日在上海长宁法院一审判决，法院判令携程网退还郑先生5000元担保金，郑先生的其他诉请均被驳回。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;携程方称“自动跳转”不可能&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;2015年10月17日，原告郑先生出差至上海，通过携程网手机客户端预订了“上海裕景大饭店”当天的客房一间，入住时间两晚。郑先生称，自己在操作时，手机预订页面显示房价为每晚800多元，于是他就填写了预订信息，并提供信用卡预授权作为入住担保，但提交订单以后，携程网发送的短信却告知他预订的是“高级套房，1间2晚，总价6400元”。郑先生当即与酒店方面以及携程网客服联系，表示不入住该套房，并随后到其他酒店入住。&lt;/p&gt;\r\n\r\n&lt;p&gt;10月30日，郑先生发现自己信用卡内5000元担保金被扣划，他认为，携程公司涉嫌欺诈，通过手机信息界面自动跳转，在他不知情的情况下，企图强行迫使他入住“高级套房”，以攫取高额佣金。所以他将酒店方与携程公司一并起诉至长宁法院，要求酒店归还5000元担保金，要求两被告共同支付以5000元为本金的利息，并支付律师费3000元、差旅费5000元和担保金的三倍赔偿金15000元。&lt;/p&gt;\r\n\r\n&lt;p&gt;但携程公司对此予以坚决否认，称预订页面自动跳转是不可能发生的。通过演示携程网手机客户端操作预订可以发现，每个预订步骤都显示房型及房价，并且原告在填写信用卡担保信息时，也会显示担保金额为5000元等信息，原告不可能在想要预订800多元/晚的房间时，经过上述多个步骤仍然未能发现其提交的订单是3200元/晚的高级套房。两被告同意退还郑先生担保金5000元，但认为郑先生主张的其他损失不应归咎于被告方，所以不予同意。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;b&gt;法院审核预订流程未现异常&lt;/b&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;上海长宁法院认为，原被告双方的争议焦点在于：携程公司在为原告郑先生预订酒店客房的过程中，是否遵从其指令，也就是“上海裕景大饭店高级套房”是否系被告方在郑先生不知情的情况下擅自预订的？&lt;/p&gt;\r\n\r\n&lt;p&gt;根据民事诉讼证据规则，在合同纠纷案件中，主张合同关系成立并生效的一方当事人对合同订立和生效的事实承担举证责任，主张合同关系变更、解除、终止、撤销的一方当事人对引起合同关系变动的事实承担举证责任。然而在本案中，原告对于他所主张的携程网手机客户端页面在操作预订过程中自动跳转、违背其指令生成了高级套房订单的情形，不能提供任何证据加以证实。&lt;/p&gt;\r\n\r\n&lt;p&gt;长宁法院也充分注意到，郑先生作为消费者一方，对此进行举证具有较高难度。基于公平及诚实信用原则，法院对携程旅行网手机客户端预订“上海裕景大饭店”的过程进行了审核。经审核发现，手机客户端中，该酒店首页各房型价格以列表方式逐一陈列，并有独立的预订按钮，在点击相应房型填写入住人等信息时，订单尾部同样载明订单金额，嗣后的担保页面也在显著位置载明了应付担保费总金额。因此，原告郑先生在提交订单之前，有多次机会可以核对房型及订单金额。根据一般常理，在订单主要信息出错的情况下，预订人应能及时发觉并拒绝确认进入下一步骤。故长宁法院认为，原告郑先生提出的“携程公司涉嫌欺诈”的主张，缺乏事实及法律依据，难以采信。&lt;/p&gt;\r\n\r\n&lt;p&gt;由于两被告同意退还郑先生5000元担保金，长宁法院对此予以准许。郑先生的其他诉讼请求均被驳回。&lt;/p&gt;', 1, NULL),
(10, 10, 's:29:"范银贵,乡村教师,被骗";', '七件套的锦缎寿衣，是范银贵穿过的最好的衣服——在他自杀的时候，身上仍穿着17年前结婚时，四姐给他做的一件灰白格子西服。', '&lt;p class=&quot;text-center&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/97d0846fa767d84960fd4172c508d951.jpg&quot;&gt;&lt;/p&gt;\r\n\r\n&lt;p class=&quot;text-center&quot;&gt;范银贵一家三口租住的危房。 澎湃新闻记者 王健 图&lt;br&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p class=&quot;text-center&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/9319f1a74c79fab82991c7a53db32afd.jpg&quot;&gt;&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p class=&quot;text-center&quot;&gt;诈骗嫌犯发给范银贵的“执行令”。 澎湃新闻记者 王健 图&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;七件套的锦缎寿衣，是范银贵穿过的最好的衣服——在他自杀的时候，身上仍穿着17年前结婚时，四姐给他做的一件灰白格子西服。&lt;/p&gt;&lt;p&gt;&lt;br&gt;这个甘肃天水秦安县的乡村教师，以常人难以想象的节俭，积攒了23万元。原本他准备用这些钱，买一套属于自己的房子。&lt;/p&gt;&lt;p&gt;&lt;br&gt;但一个电话击碎了范银贵的全部希望，一个操着蹩脚普通话的男人自称是警察，他说范银贵的账户涉嫌洗钱，要冻结全部资金。&lt;/p&gt;&lt;p&gt;&lt;br&gt;胆小内向的范银贵轻信了，他分两次给对方转去了自己的全部积蓄。等他反应过来，为时已晚。&lt;/p&gt;&lt;p&gt;&lt;br&gt;5月11日中午，范银贵出门前，恨恨地给妻子撂下一句话：“我揍那些人（电信诈骗犯）去！” 人们再次见到他的时候，是在县城一栋住宅的22楼。&lt;/p&gt;&lt;p&gt;&lt;br&gt;他把一条消防水带缠在脖子上，自杀了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong&gt;“我的死与妻子无关，与骗子有关”&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;/strong&gt;接到陌生电话的那天是5月9日，上午，范银贵有事没去学校。他的妻子冯相相说，电话是早上10点多打来的，她隐约听见对方自称是“公安局”的，说了没几句就挂了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;紧接着另一个电话打过来，这回对方是“天津一个区的公安”。一个男人操着不标准的普通话，说范银贵犯了案子，不配合就要逮捕他。&lt;/p&gt;&lt;p&gt;&lt;br&gt;冯相相在范银贵边上，听到只言片语，不是很真切。她要丈夫把电话音量放大些，但范银贵摆手不让她说话，并调低了音量。&lt;/p&gt;&lt;p&gt;&lt;br&gt;通话大概有一个小时，范银贵连午饭都不吃就要出门。冯相相看丈夫拿着存折和身份证，就问：“你拿这干啥？”范银贵没有搭理妻子，急匆匆走了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;5月10日中午，一夜未归的范银贵一进家门就嚷嚷：“不得了了，不得了了，咱的钱都叫人家骗了。”看丈夫神色紧张，冯相相慌了。范银贵又念叨：“再给人家打一万二，冻结的这23万就能退回来。”&lt;/p&gt;&lt;p&gt;&lt;br&gt;冯相相这才注意到，丈夫身上还带着一沓钱。范银贵说这是借郑老师的五千元，还得再跟妻哥借些钱凑够一万二。冯相相说：“不能打了，不能再打了，不能再把郑老师害了。”&lt;/p&gt;&lt;p&gt;&lt;br&gt;之后，冯相相又给哥哥打电话，说不能给范银贵借钱了，已经上当了。哥哥让他们赶紧报警。顾不上吃饭，范银贵出门去了公安局。&lt;/p&gt;&lt;p&gt;&lt;br&gt;下午4点多，范银贵报警归来，他说中山中学一个老师也被骗了5万，还有一个女人被骗了36万。当晚，夫妻二人都很烦躁，彻夜未眠。&lt;/p&gt;&lt;p&gt;&lt;br&gt;11日一大早，冯相相让范银贵再去公安局催催。快11点的时候，范银贵回来了，说报警报晚了，钱已经被转走了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;在家蒙了一会儿，范银贵突然起身往外走，边走边说：“我揍那些人去！”冯相相试图去拦，却没能拦住。&lt;/p&gt;&lt;p&gt;&lt;br&gt;远在新疆农垦兵团的范军贵，在下午2点20分接到范银贵的电话。范银贵连哭带说地告诉大哥，钱被骗光了，是国际诈骗犯骗走的，追不回来了，自己不准备活了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;范军贵顿时慌了，他从未见过弟弟如此激动，连忙安慰：“骗就骗了，你还有工作，再挣。”弟弟却哭诉，辛苦一辈子的钱都被骗了，挣不回来了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;范军贵问：“你死了，老婆娃娃咋办，老人咋办？”范银贵说：“不管了，也管不了了。”范军贵生气了：“你生的娃你不管谁管？老人拉扯你这么大，在你身上花的心血最多，你咋这么不负责任？”然而，任凭软硬话都说不动范银贵。&lt;/p&gt;&lt;p&gt;&lt;br&gt;挂了范军贵的电话，范银贵又给四姐范双女打过去，交代后事。范双女也远在新疆，她劝弟弟，“人活着就啥都有，我先给你打些钱你生活，要不来新疆住一段时间。”&lt;/p&gt;&lt;p&gt;&lt;br&gt;范银贵似乎去意已决：“我反正是不活了，你和哥两个把妈妈看好。”然后就挂了电话，再也无法接通。&lt;/p&gt;&lt;p&gt;&lt;br&gt;预感不好的范军贵和范双女，各自给在秦安县的亲朋打电话，通告情况，让他们赶快报警找人，但众人遍寻无果。&lt;/p&gt;&lt;p&gt;&lt;br&gt;12日下午，“重邦尚城”售楼部的销售人员，带客户到22楼看房时，发现了范银贵的尸体。他用一条消防水带，把自己吊在楼道的水管上。&lt;/p&gt;&lt;p&gt;&lt;br&gt;窗台上有一层灰，范银贵在上面用手指写了遗言：“我的死与妻子无关，与骗子有关。”&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong&gt;一套西服，他一直穿了17年&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;/strong&gt;5月18日，是范银贵下葬的日子。一大早，秦安县莲花镇新庄湾村的男人们，陆续来到范家的小院，为早晨6点开始的葬礼做着准备。范银贵的墓地在一块梯田里，阴阳先生选的风水宝地，乡亲们帮着挖好了墓穴。&lt;/p&gt;&lt;p&gt;&lt;br&gt;按照当地风俗，死在外面的人，遗体不能进村子。范银贵的棺木在墓穴旁放了好几天，等着在良辰吉日入土。陇东虽已入夏，但早晨依旧十分清冷。漫山的洋槐树，白花繁盛。&lt;/p&gt;&lt;p&gt;&lt;br&gt;1972年，范银贵出生在一户贫困农家。他排行老七，前面有两个哥哥和四个姐姐。从小勤奋好学的范银贵，从小学一路读到高中，这在当时的农村实属不易。而他又不负众望地考入天水师专，成了村里的第三个大学生。&lt;/p&gt;&lt;p&gt;&lt;br&gt;范军贵说，弟弟在读大学期间，“脑袋里得了一场病”，因此还休学了，毕业已是1998年。那场病让范银贵的性格变得内向寡言。&lt;/p&gt;&lt;p&gt;&lt;br&gt;1999年，在莲花中学教书的范银贵，经人介绍迎娶了同乡的冯相相。2005年，他们有了一个儿子，一家三口住在学校的教工宿舍里。&lt;/p&gt;&lt;p&gt;&lt;br&gt;公办教师在乡村是个令人羡慕的工作，月薪从最早的三百到现在的三千多，范银贵的收入还算体面。但日子总过得紧巴巴的，儿子从小有支气管炎，妻子先后做了两次手术，范银贵挣点钱都交给医院了。&lt;/p&gt;&lt;p&gt;&lt;br&gt;他的工作也不顺利，冯相相说丈夫“人事关系紧张”，职称评到中教二级后，就再也没能往上评，“争不上”。为了换个环境，2010年范银贵托关系，让自己借调到离县城不远的西川中学。&lt;/p&gt;&lt;p&gt;&lt;br&gt;儿子的病逐渐好了起来，但范银贵的工作依旧不见起色，冯相相说：“他在西川中学教了一学期历史，三年语文，就被调整到后勤上了。”&lt;/p&gt;&lt;p&gt;&lt;br&gt;在西川中学，和范银贵熟络的老师并不多。几位老师介绍，范银贵接触最多的是学校的门卫，他没事的时候，总爱去门卫室看电视。&lt;/p&gt;&lt;p&gt;&lt;br&gt;“就是爱看秦腔，你不问他话，他也不主动和你说。”门卫回忆道：“他教不了书才去干后勤的，就管两个会议室，平时打扫打扫卫生。”门卫对他的上当和自杀感到不解，认为一个老师应该有基本的辨别能力，而自杀是非常不负责任的举动。曾借给范银贵五千元的后勤教工郑景民说，范银贵工作认真负责，踏实肯干，就是性格有些胆小内向。&lt;/p&gt;&lt;p&gt;&lt;br&gt;与此同时，住房成了困扰范银贵夫妻的大问题，“镇上的破房子一年也要两三千块，别人不高兴还就不给你租了，撵来撵去的不好受。”最后，他们在西川镇旁的雒川村找到一户危房，年租金一千元。&lt;br&gt;一直艰难度日的范银贵更节俭了，一个月买两三次菜，一年吃不了几次肉。范双女甚至怀疑，弟弟能不能吃饱肚子。冯相相诺诺地接过话说，“吃是能吃饱，就是吃得不好。”她说一家三口一月的生活费，大概只有四五百元。&lt;/p&gt;&lt;p&gt;&lt;br&gt;范银贵结婚的时候，范双女给他做了一套西服，他一直穿了17年。儿子的鞋是早就没人穿的板儿鞋，没了鞋面，前脚掌上好几个窟窿。范银贵出事后，同事们看孩子可怜，给买了新鞋新衣服换上。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;strong&gt;自杀前他把借来的5000元还了&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;/strong&gt;在雒川村的那户危房里，范银贵一家已经住了两年。正房二十来平米，看着倒也宽敞，只是炕塌了，没法住，上面摆着米面油等物件。他们住的是十来平米的偏房，炕上的被褥也是结婚时做的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;如果说有什么家具的话，正房里放在汽油桶上的电视算一个，那是2001年买的。还有一架缝纫机，目前常见于旧货市场。地上有个落满尘土的单眼煤气灶，它早已被弃用。&lt;/p&gt;&lt;p&gt;&lt;br&gt;买一套属于自己的房子，是范银贵生前最大的愿望。但这个小县城的商品房价格令人咋舌，均价四五千元。夫妻都是公务员的人也抱怨房价太高，何况范银贵是家里唯一挣钱的人。&lt;/p&gt;&lt;p&gt;&lt;br&gt;冯相相说，他们看过几套廉租房，但过不了户，心里不安就没敢买。还看了几套二手房，但也没有合心的，就想着继续存钱吧。&lt;/p&gt;&lt;p&gt;&lt;br&gt;存折上的数字艰难攀升着，这是一家三口从牙缝里抠出来的钱。看上去，他们离梦想也越来越近。直到那个陌生来电，让一切戛然而止。&lt;/p&gt;&lt;p&gt;&lt;br&gt;举行葬礼的时候，范银贵的两个姐姐，在坟前痛哭不止，几近昏厥。他的儿子年龄尚小，并不是很清楚这意味着什么，只是听从大人安排，默默地将一张张冥币放进火盆。&lt;/p&gt;&lt;p&gt;&lt;br&gt;在阴阳先生的诵经声中，男人们小心地把棺木抬起又放下，安置进七八立方米的墓穴，填土掩埋。整版的冥币在坟前堆了一人高，被人引燃，片刻便火光冲天，灰烬腾空直上。&lt;/p&gt;&lt;p&gt;&lt;br&gt;范银贵身后留给了警方两张转款的银行凭证：5月9日这天，他分两次打去18万、5万，汇进了位于广西的一家银行的账号。秦安县公安局政工科警员表示，这起电信诈骗案正在调查中，尚不能对外发布相关信息。&lt;/p&gt;&lt;p&gt;&lt;br&gt;郑景民说，范银贵5月10日找他借了5000元，说亲戚家出事了，第二天又还给了他，说不用了，“如果这钱被骗了，我也不打算跟他要了。”那是范银贵一度准备再打给骗子寄望于“解冻”那23万元的一笔钱。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, NULL),
(11, 11, 's:26:"命案,租房,一男一女";', '5月22日中午12点刚过，有读者报料称，嘉兴秀洲区新城街道新义新村东区24幢一间出租房内发生命案，一男一女倒在血泊中，120救护人员到场后确认，两人均已死亡。', '&lt;p&gt;5月22日中午12点刚过，有读者报料称，嘉兴秀洲区新城街道新义新村东区24幢一间出租房内发生命案，一男一女倒在血泊中，120救护人员到场后确认，两人均已死亡。&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;br&gt;记者闻讯后立即赶往新义新村东区，从小区西门进入小区后，很多居民正朝着24幢楼的方向走去，有的人一边走还一边向身边的人说：“那边杀人了……”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;此时，小区24幢楼前已拉起了警戒线，警戒线外里三层外三层地站满了人，多名警察站在一楼出租房门口，房间里面正在进行勘查工作。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;28幢楼位于24幢楼的斜对面，中间只隔着一条小区道路，一对小夫妻租住在这幢楼的一楼。这对小夫妻，男的姓黄，女的姓王，小王和女死者在同一家企业打工。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;小王说，女死者姓李，年仅23岁，贵州人，“她是组装生产线上的，跟我不是一个工种，我们算认识，也算对门邻居，但交流并不多。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;“我们当时正在烧中饭，突然听到外面有很大动静，来了几个警察，把对面的门踹开了。”小王的丈夫小黄说，“跑过去一看，女的躺在卫生间里，身上都是血，听说男的躺在门口。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;采访中，小黄还告诉记者，上午他看到女死者和一个男的一前一后出门。还有人称，上午还看到女死者在门前洗衣服。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;包括小黄夫妻在内的住在附近的人在接受采访时均称，警察到来前没听到案发出租房内传出打斗等异常动静。&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;读者给晚报报料时还称，命案发生后，有男子曾报警称自己杀了老婆和另外一名男子。另外，事后也有人在网上发帖称，“老公杀了老婆后再自杀。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;至于男死者与女死者到底是什么关系，小王和小黄也确定不了，“我们和她（女死者）老公不怎么打照面，长什么样，还真没啥印象。”不过，据小黄称，事后有警察拿出手机里一张照片让他辨认，“照片里的男的戴着手铐，手上都是血，这个人应该没见过。”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;在现场，还有人猜测此案是否与前一天深夜发生在小区门口一家餐馆内的打架事件有关。“昨天晚上12点多，一对小夫妻跟人吵架，被打了，然后又叫了一帮老乡来，把对方打得头破血流，警察来了后，他们都跑了。”这家餐馆的老板娘说，“不知道这两件事有没有关系，难道是来寻仇的？”&lt;/p&gt;\r\n\r\n\r\n\r\n&lt;p&gt;&lt;br&gt;目前，警方还在进一步调查此案。&lt;/p&gt;', 1, NULL),
(12, 12, 's:20:"长沙,轻生,坠落";', '5月24日上午10点左右，一上身赤裸的男子爬上湖南长沙五一大道与黄兴路交汇处的高架桥交通信号灯上疑欲轻生，造成严重交通拥堵。公安、消防和民警积极营救期间，现场有不明身份男子拿长杆鞭打该男子，随后，其从红绿灯上跳下，引发围观群众起哄。', '&lt;div class=&quot;post_text&quot; id=&quot;endText&quot;&gt;\n&lt;p class=&quot;text-center&quot;&gt;&lt;img src=&quot;/uploads/users/images/1f160638/ca5effa92cabfc73c8f32a37cf99471d.jpg&quot;&gt;&lt;/p&gt;\n                                &lt;p class=&quot;otitle text-center&quot;&gt;&lt;mark class=&quot;redactor-inline-converted&quot;&gt;男子被打。&lt;/mark&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;f_center text-center&quot;&gt;&lt;img alt=&quot;网曝长沙一男子爬信号灯轻生 遭人挥杆敲打坠落&quot; src=&quot;/uploads/users/images/1f160638/982e0625e22e1e4020c0bfeb322a5020.jpg&quot; width=&quot;585&quot; height=&quot;342&quot; xss=removed&gt;&lt;br&gt;&lt;mark&gt;网传视频中拿杆子“鞭打”轻生男子图。&lt;/mark&gt;&lt;/p&gt;&lt;p&gt;5月24日上午10点左右，一上身赤裸的男子爬上湖南长沙五一大道与黄兴路交汇处的高架桥交通信号灯上疑欲轻生，造成严重交通拥堵。公安、消防和民警积极营救期间，现场有不明身份男子拿长杆鞭打该男子，随后，其从红绿灯上跳下，引发围观群众起哄。&lt;/p&gt;&lt;p&gt;从长沙市公安局相关工作人员处证实，目前，该男子已送长沙市第一人民医院抢救，鞭打者已被带至派出所接受调查。&lt;/p&gt;&lt;p&gt;据现场目击者介绍，该男子上身赤裸，一直站在五一路与黄兴路交汇处的信号灯上摇晃，从上午11点左右一直持续到下午2点多。公安、消防、交警前往现场处理，地上铺有高约两米的消防气垫。长沙五一广场一带堵车严重，过往市民抱怨。&lt;/p&gt;&lt;p&gt;多名目击者告诉澎湃新闻，其间，男子一度被前往现场的派出所人员劝下红绿灯，后不知何故再次爬上红绿灯。&lt;/p&gt;&lt;p&gt;现场网友提供的数段视频显示，该男子遭遇桥上一拿有长杆的男子鞭打。另有一名身着迷彩服男子，挥舞着手中的扫帚，朝轻生男子叫嚷并鼓掌。多名目击者称，约下午2点10分，男子从红绿灯上跳下。&lt;/p&gt;&lt;p&gt;现场视频显示，男子在长杆的鞭打下，往桥边跳，双手欲攀爬桥边。结果是，该男子并未攀爬到桥边，也未落在安全气垫上，而是摔在了地上。&lt;/p&gt;&lt;p&gt;该男子为何遭遇“鞭打”？现场一身穿迷彩服的男子接受《长沙政法频道》采访时解释，自己系过路市民，鞭打男子是想救他。&lt;/p&gt;&lt;p&gt;据知情人士透露，该男子30岁左右，四川彝族人，有吸毒史。事发或因产生幻觉追打路人，当地警方制止后，自行爬上了红绿灯杆。但这一说法未获警方证实。&lt;/p&gt;&lt;p&gt;当地媒体新湖南客户端称，目前，网传视频中拿杆子“鞭打”轻生男子的人已被办案民警带至派出所接受调查。&lt;/p&gt;&lt;p&gt;\n&lt;/p&gt;&lt;div class=&quot;gg200x300&quot;&gt;\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\n&lt;/div&gt;&lt;p&gt;24日晚，长沙市公安局通过官方微博通报称：2016年5月24日10时许，开福公安分局通泰街派出所接群众报警称：一男子坐在黄兴路与五一路交叉口的红绿灯横杆上，可能会有坠落的危险。派出所值班民警立即赶往现场进行处置，同时，处警民警拨打119通知消防队员到场协助处置。现场民警立即设置警戒并与该男子进行对话和思想沟通，劝其不要轻生。男子说自己是四川人，并表明自己想回老家却没钱买票。民警表示愿意给他买好回家的车票，并送他去车站。经过半个多小时的劝说，11时许，该男子终于从红绿灯横杆上下来。民警随即对其进行教育，并要其上车护送其离开，该男子趁着民警去开车的间隙，突然跑开并再一次爬到红绿灯横杆，不肯下来。&lt;/p&gt;&lt;p&gt;根据通报，13时50分许，在民警继续劝导该男子时，围观群众中一男子蓝某龙（25岁，籍贯四川省资中县人，街头卖唱人员）用一根长约3米的PVC软杆，欲促使该男子落到消防救生气垫上获救。在此过程中，该男子突然纵身一跃并跌落到消防气垫以外。男子跌落后，现场民警立即协助医务人员将其抬上120急救车送医救治。目前，蓝某龙已被公安机关带回调查，坠落男子的具体身份及相关情况正在进一步调查当中。&lt;/p&gt;\n                                            &lt;/div&gt;\n\n&amp;', 1, NULL),
(13, 13, 's:16:"童养媳,强奸";', '父亲施暴，被患有精神分裂的母亲打死。母亲离家出走，马泮艳三姐妹被托付给大伯父。12岁左右，三姐妹被大伯父以童养媳的方式嫁人。', '&lt;div class=&quot;article article_16&quot; id=&quot;artibody&quot;&gt;\r\n\r\n   \r\n\r\n\r\n      &lt;div class=&quot;img_wrapper&quot;&gt;\r\n  &lt;img alt=&quot;马泮辉在广东的出租屋内晾衣服。&quot; src=&quot;http://n.sinaimg.cn/news/transform/20160526/6Qgg-fxsqxxu4409187.jpg&quot;&gt; &lt;/div&gt;&lt;div class=&quot;img_wrapper&quot;&gt;  马泮辉在广东的出租屋内晾衣服。\r\n &lt;/div&gt;\r\n  &lt;div class=&quot;img_wrapper&quot;&gt;\r\n  &lt;img alt=&quot;马泮艳（左）和妹妹马泮辉在商量母亲的养老问题。京华时报记者韩林君摄&quot; src=&quot;http://n.sinaimg.cn/news/transform/20160526/1u1A-fxsqxyc1503823.jpg&quot;&gt; &lt;/div&gt;&lt;div class=&quot;img_wrapper&quot;&gt;  马泮艳（左）和妹妹马泮辉在商量母亲的养老问题。京华时报记者韩林君摄\r\n &lt;/div&gt;\r\n  &lt;div class=&quot;img_wrapper&quot;&gt;\r\n  &lt;img alt=&quot;马泮艳的女儿已经14岁了。&quot; src=&quot;http://n.sinaimg.cn/news/transform/20160526/ePdh-fxsqxxs7633888.jpg&quot;&gt; &lt;/div&gt;&lt;div class=&quot;img_wrapper&quot;&gt;  马泮艳的女儿已经14岁了。\r\n &lt;/div&gt;\r\n  &lt;div class=&quot;img_wrapper&quot;&gt;\r\n  &lt;img alt=&quot;马泮艳在广东的出租屋内做饭。&quot; src=&quot;http://n.sinaimg.cn/news/transform/20160526/cWfl-fxsqxyc1503825.jpg&quot;&gt; &lt;/div&gt;&lt;div class=&quot;img_wrapper&quot;&gt;  马泮艳在广东的出租屋内做饭。\r\n &lt;/div&gt;\r\n \r\n &lt;p&gt;　　父亲施暴，被患有精神分裂的母亲打死。母亲离家出走，马泮艳三姐妹被托付给大伯父。12岁左右，三姐妹被大伯父以童养媳的方式嫁人。&lt;/p&gt;\r\n&lt;p&gt;　　2000年，12岁的马泮艳嫁给了比她大17岁的陈学生，被迫发生性关系后生下女儿。在为陈家又生下一个儿子后，马泮艳逃到广东。今年5月4日，马泮艳向巫山县人民法院起诉，要与丈夫陈学生离婚。&lt;/p&gt;\r\n&lt;p&gt;　　□成孤&lt;/p&gt;\r\n&lt;p&gt;　　父亲死亡母亲出走三姐妹寄养亲戚家&lt;/p&gt;\r\n&lt;p&gt;　　马 泮艳的老家在重庆市巫山县双龙镇金华村，父亲马正平曾任村大队书记。马正平和方登莲结婚后，育有3个女儿，马泮艳在家中排行老二。马正平因超生被撤了职。 村民们说，村子太偏僻，从巫山县城要先坐船后搭车，再走半个小时才能到。本地女人都希望外嫁，很少有外地的女人愿意嫁进来。&lt;/p&gt;\r\n&lt;p&gt;　　马泮艳告诉京华时报记者，父母夫妻感情逐渐恶化，父亲经常家暴，甚至将母亲脱光衣服吊起来打。1997年，方登莲患上了严重的精神分裂症。当年4月，方登莲用锄头将马正平砸死，因患精神疾病被免于刑事处罚。&lt;/p&gt;\r\n&lt;p&gt;　　马正平死后，方登莲带着3个女儿寄住在大伯哥马正松家。当时，马泮珍12岁，马泮艳9岁，马泮辉7岁，3人都辍学了。不久，方登莲离家出走。马正松说她回湖北老家了，马泮艳则认为母亲是在马正松的殴打下逃走的，父亲的死让他一直记恨母亲和3个侄女。&lt;/p&gt;\r\n&lt;p&gt;　　方 登莲离家后再未与马正松和3个孩子联系过，3个女儿成了孤儿，马正松作为监护人名正言顺领取了国家发放给她们的补助金。马泮艳认为，她们并没得到很好的照 顾，不仅没上学，而且还要做很重的农活，她和妹妹要负责饲养11头猪。马正松却抱怨，马泮艳和马泮辉在家里干活经常偷懒。&lt;/p&gt;\r\n&lt;p&gt;　　&lt;strong&gt;□早嫁&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;　　三姐妹未成年出嫁老二14岁产下女孩&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;　　在大伯父家待了不到一年，13岁的马泮珍就出嫁了。婆家给了马正松一笔数额不详的抚养费作为补偿。&lt;/p&gt;\r\n&lt;p&gt;　　2000年，12岁的马泮艳被嫁给了29岁的陈学生。马泮艳说，马正松从她身上得到了3000元钱的抚养费。但陈学生家却表示，实际给了7000元钱和500斤大米。&lt;/p&gt;\r\n&lt;p&gt;　　2000 年春节后，马泮艳和陈学生到福建打工，其间，陈学生强行与其发生了性关系，马泮艳因反抗受到了殴打。马泮艳后因年纪太小找不到工作回到了双龙镇马正松家， 并到双龙派出所报案。双龙派出所民警当时给马泮艳做过检查，发现她已经不是处女。民警从马正松处得知，马泮艳已经嫁到了陈家，派出所就没有管。京华时报记 者近日就此事致电巫山县双龙派出所。派出所民警表示，马泮艳确实在2000年报过案，派出所对其做了医疗检查，证实她当时已不是处女。派出所与马正松取得 联系，他说马泮艳已经嫁给了陈学生。派出所据此判断这是一起家庭纠纷，所以才没有管。&lt;/p&gt;\r\n&lt;p&gt;　　半年后，陈学生从福建打工回家，把马泮艳带走毒打一顿，禁止马泮艳离开家附近100米的范围。即便是上厕所，陈家也会有专人看守马泮艳，防止她逃跑。之后陈学生继续外出打工，马泮艳就在家里做农活。2002年，年仅14岁的马泮艳诞下一女。&lt;/p&gt;\r\n&lt;p&gt;　　2002年，12岁的马泮辉被大伯父嫁给了24岁的罗品金，马正松从她身上得到了4000元的抚养费。2005年，15岁的马泮辉生下了一个儿子。&lt;/p&gt;\r\n&lt;p&gt;　　马泮艳姐妹两人生育时年龄太小，又是在家接生的，分娩中都遇到了危险。罗家请来的接生婆甚至用刮胡刀片为马泮辉做了“横切”，生产结束后又用普通的线缝上。所幸，两人都母子平安。&lt;/p&gt;\r\n&lt;p&gt;　　多 名村民证实，当地不存在如此早嫁女儿的风俗，马正松的亲生女儿出嫁时已经21岁。马正松在接受京华时报记者采访时称，马泮艳姐妹出嫁时家里确实困难，他妻 子也有精神疾病，自己一个人养活不了一大家子。而且当时亲家双方有约定，孩子送过去只是先养起来，等到了适婚年龄再结婚，就是过去的“童养媳”。&lt;/p&gt;\r\n&lt;p&gt;　　&lt;strong&gt;□逃婚&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;　　四次逃跑终获成功姐妹找到出走母亲&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;　　2007年，19岁的马泮艳又产下一男孩。&lt;/p&gt;\r\n&lt;p&gt;　　在2008年以前，马泮艳一共逃过三次，但都没有成功。2000年去派出所报案是她第一次逃婚，因派出所没有及时干预，她逃婚失败。2004年，马泮艳逃到马正松家，又被陈家的人带回。&lt;/p&gt;\r\n&lt;p&gt;　　2006年，马泮艳和陈学生再次到福建打工，她趁陈学生不注意逃到了邻近城市，靠着自学的制衣手艺找了一份工作。一个多月后，马泮艳在大街上遇到了在外跑长途的陈学生的妹夫，随即被控制并被转交给了陈学生。&lt;/p&gt;\r\n&lt;p&gt;　　2008年，马泮艳得知马泮辉在广东打工，就从姐姐马泮珍处借了1000元钱，独自逃离陈家南下广东打工。因为马泮艳给陈学生生了儿子，此次陈家也没有特别着急地去寻找她。她就和妹妹一家在广东安顿下来，成为一名普通的打工妹。&lt;/p&gt;\r\n&lt;p&gt;　　马 泮艳说，和陈学生结婚本来就不是自己的本意。她对于一双儿女没什么爱意，对于陈学生更是只有恨。而且陈学生经常殴打她，为了“管教”她不再逃跑，陈学生在 床头放了一根半米长、一拳粗的木棍，经常无缘无故地打她，让她“老实一点”，自己现在身上还留有伤痕。陈学生在电话里威胁马泮艳，称如果马泮艳敢找别的男 人过日子，他一定会找到她，把她打死。&lt;/p&gt;\r\n&lt;p&gt;　　2012年前后，马泮辉因家庭矛盾离开了罗家，她和罗品金没有领证的事实婚姻维系了10年，她已经产下一儿一女。&lt;/p&gt;\r\n&lt;p&gt;　　从陈家逃走后，马泮艳试图寻找失踪了十多年的母亲。2013年，马泮辉通过母亲湖北老家的派出所找到失散了16年的母亲。此时，已经52岁的母亲精神疾病症状缓解多了，生活尚能自理。姐妹俩说：“妈妈找到了，我们这个家就算团圆了。”&lt;/p&gt;\r\n&lt;p&gt;　&lt;strong&gt;　□离婚&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;　　莫名领证起诉离婚控告强奸未被立案&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;　　在外打工8年，马泮艳不乏有男性追求者。但到了谈婚论嫁之时，却发现自己早在2008年就已经登记结婚了。马泮艳说，她从来没有办理过任何手续、签署过任何文件，不知道陈学生是怎么把结婚证办下来的。正是因为这个结婚手续，马泮艳至今无法组建家庭。&lt;/p&gt;\r\n&lt;p&gt;　　2011年，马泮艳在巫山县档案馆查到，2008年，20岁的她与陈学生结婚，办理了结婚登记。马泮艳猜测，可能是当时为了给小儿子上户口，陈学生托关系办理了结婚证，儿子的出生日期也被从2007年更改成了2008年。&lt;/p&gt;\r\n&lt;p&gt;　　2011年，马泮艳来到陈家，希望能够办理离婚手续。但是陈家人故技重施，一边对她严加看守，一边打电话给在外打工的陈学生，让他回来管教媳妇。马泮艳害怕再次陷入魔窟，当夜就逃离了陈家，至今5年再也没有回去过。&lt;/p&gt;\r\n&lt;p&gt;　　2015年，马泮艳在广东打工期间遇到一位社工，她劝马泮艳勇敢地站出来，用法律武器保护自己，维护自己的合法权益。&lt;/p&gt;\r\n&lt;p&gt;　　2016 年5月4日，马泮艳正式向巫山县人民法院提起诉讼，要求法院判决自己和陈学生离婚。同日，她向双龙派出所报案，控告陈学生在自己未成年的时候就强行与其发 生性关系，属于强奸幼女。但是，派出所的民警却告诉她，强奸罪的追诉期最高只有10年。马泮艳今年已经28岁了，应该已经超过了追诉期，因此不予立案。&lt;/p&gt;\r\n&lt;p&gt;　　对于马泮艳的离婚要求，陈学生的态度严厉而明确。他告诉马泮艳，如果马泮艳给他10万元作为两个孩子的抚养费，他就同意离婚。不然，就算是马泮艳打官司这婚也离不了。他毫不避讳地说，自己有能力找关系办下来结婚证，就有能力找关系让这个婚离不了。&lt;/p&gt;\r\n&lt;p&gt;　　马泮艳表示，自己在外打工8年，一直是底层女工，虽然攒了一点钱，但是无论如何也掏不出这10万元的“巨资”。她担心，自己会因为没有钱，一辈子都被陈学生给毁了。&lt;/p&gt;\r\n&lt;p&gt;　&lt;strong&gt;　□律师说法&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;　　尝试行政诉讼要求警方立案&lt;/strong&gt;&lt;/p&gt;\r\n&lt;div id=&quot;ad_42120&quot; class=&quot;otherContent_01&quot;&gt;&lt;br&gt;&lt;/div&gt;&lt;p&gt;　　北 京雄志律师事务所律师姜健说，由于马泮艳和陈学生已经分居8年，所以法院判决两人离婚的可能性较大。在一般离婚官司中，分居两年以上就可以视为婚姻实际破 裂。如果法院判决离婚，就将由法院来认定抚养费的具体数额，一般来说，是当事人收入的20%到30%。因此，陈学生要求的10万元抚养费，法院未必会支 持。马泮艳只要如数缴纳法院判定的抚养费，就可以顺利离婚。&lt;/p&gt;\r\n&lt;p&gt;　　姜健说，按照我国刑法的规定，法定最高刑为五年以上不满十年有期徒刑 的，经过十年就不再追诉。而刑法第二百三十六条规定，奸淫不满十四周岁的幼女的，以强奸论，从重处罚。在没有特别严重情节的情况下，强奸罪将处以三年以上 十年以下有期徒刑。因此，一般情况下，强奸罪的最长追诉期确实是10年。而马泮艳14岁生子，今年28岁，中间跨度14年，显然超过了10年。但是，早在 2000年，马泮艳就在双龙派出所报过案了，双龙派出所当时通过医疗检查也证实了她不是处女的事实，但是当时却没有及时立案调查，导致了马泮艳今年再次到 派出所报案。因此，马泮艳的情况存在不适用于追诉期超期的可能。马泮艳可以尝试通过行政诉讼的方式，改变派出所不予立案的结果&lt;/p&gt;&lt;div&gt;&lt;/div&gt;\r\n\r\n\r\n\r\n   \r\n\r\n\r\n   \r\n        &lt;/div&gt;\r\n\r\n', 1, NULL),
(14, 14, 's:29:"女网友,传销组织,群殴";', '信息时报讯 近年来，因与异性网聊被骗进传销组织导致钱财损失、自由受限的事件时有发生。佛山一个年轻小伙被约来穗后却为此付出了生命的代价。近日，白云区检察院依法以涉嫌故意伤害罪批准逮捕犯罪嫌疑人邓某等7人。', '&lt;div class=&quot;post_text&quot; id=&quot;endText&quot;&gt;\r\n                                &lt;p class=&quot;otitle&quot;&gt;信息时报讯 近年来，因与异性网聊被骗进传销组织导致钱财损失、自由受限的事件时有发生。佛山一个年轻小伙被约来穗后却为此付出了生命的代价。近日，白云区检察院依法以涉嫌故意伤害罪批准逮捕犯罪嫌疑人邓某等7人。&lt;br&gt;&lt;/p&gt;&lt;p&gt;\r\n&lt;/p&gt;&lt;div class=&quot;gg200x300&quot;&gt;\r\n&lt;div&gt;&lt;br&gt;&lt;/div&gt;\r\n&lt;/div&gt;&lt;p&gt;据检方介绍，2016年1月31日下午，小华（化名）从佛山来到了广州市白云区鹤边村村内与女网友见面。次日上午，十余人在该房内“上课”，小华发觉自己被骗进了传销组织，他要求离开，但遭到拒绝。小华于是以拳头砸窗，以跳楼的方式相威胁，该传销组织管理人员林某、邓某见状后将小华摁倒在地，并与传销人员姚某等人按住小华的手脚，对其进行拳打脚踢。随后，得知小华想逃跑的另一管理人员朱某也从外面赶回，并加入殴打小华的阵营。小华被殴打时间长达数十分钟，直至失去知觉。&lt;/p&gt;&lt;p&gt;林某、邓某组织人员清理现场，并在请示“上级”后将小华送去医院，同时要求房内其他人员马上撤离，后小华被送至医院抢救时被证实已死亡。&lt;/p&gt;&lt;p&gt;近日，白云区检察院依法以涉嫌故意伤害罪批准逮捕犯罪嫌疑人邓某等7人。犯罪嫌疑人林某仍在追捕中。&lt;/p&gt;\r\n                                            &lt;/div&gt;\r\n\r\n', 1, NULL),
(15, 15, 's:32:"妇科,整形手术,涉事医生";', '5月25日、26日，华商报连续报道了韩城一女性患妇科病，到韩城市阳光妇科门诊部就医，被接诊医生劝说做了阴道紧缩术、留下后遗症一事。韩城市卫计部门现场检查发现，该门诊部还有3名“医生”无资质，已责令其停业整顿，但有读者认为该事件仍存在多个疑问', '&lt;div class=&quot;post_text&quot; id=&quot;endText&quot;&gt;\r\n                                &lt;p class=&quot;otitle&quot;&gt;涉事妇科医院&lt;br&gt;&lt;/p&gt;&lt;p&gt;5月25日、26日，华商报连续报道了韩城一女性患妇科病，到韩城市阳光妇科门诊部就医，被接诊医生劝说做了阴道紧缩术、留下后遗症一事。韩城市卫计部门现场检查发现，该门诊部还有3名“医生”无资质，已责令其停业整顿，但有读者认为该事件仍存在多个疑问。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;疑问一&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;涉事医生究竟离开没有&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;据当事人王女士反映，曾给她做阴道紧缩术的医师是钟瑞华。5月25日，韩城市卫计局在给记者回复中称：“钟瑞华已离开阳光妇科门诊部，无法调查取证。”韩城市卫生和计生综合监督执法大队一名工作人员表示，他们在5月6日、24日、25日的三次检查中，都没有见到钟瑞华。&lt;/p&gt;&lt;p&gt;但5月19日、20日，记者在阳光妇科门诊部，见到并采访了钟瑞华本人，并留下了对方的联系方式。5月27日，华商报记者再次到该门诊部回访时，其办公室主任黄玉林却表示，钟瑞华从三四年前起在该门诊部工作，但今年三四月份已辞职。&lt;/p&gt;&lt;p&gt;韩城市卫计局综合监督科副科长同宇强表示，会继续联系钟瑞华。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;疑问二&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;涉事医师是否取得执业资质&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;在执法人员调查时，该门诊部提供了钟瑞华的《医师执业证书》复印件，该证书颁发时间为2009年，注册的执业地点在江西瑞金。有读者质疑，钟瑞华取得执业证书已有7年时间，至少应该接受三次两年一次的考核，但其是否按时参加？有没有在韩城执业的资格？&lt;/p&gt;&lt;p&gt;韩城市卫计局分管医政工作的副局长郭岁威介绍，没有查询到钟瑞华的注册和备案信息，现在还不能确定钟瑞华是否具有《医师执业证书》，也有可能是异地执业，没有按规定在该部门备案；也有可能钟瑞华并没有执业资质。“但异地执业从卫生行政管理政策上讲是不允许的。”郭岁威说。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;疑问三&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;当事人所受伤害如何解决&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;韩城市卫计局的回复中称，违法事实至今已近4年，《行政处罚法》第29条规定，“违法行为在两年内未被发现的，不再给予行政处罚”。有读者提出，这一条法律条文是否适用此事？王女士受损的身心健康权益该如何维护？&lt;/p&gt;&lt;p&gt;对此，同宇强表示，目前做出的停业整顿处罚，是针对此次检查发现的“擅自聘用非卫生专业技术人员行为”。监管部门两年内并没有发现该门诊有超范围经营等违法行为，也没有市民在两年时限范围内进行投诉。而王女士的遭遇已超过行政处罚时限，所以没法做出关停、吊销证书等处罚措施。至于以非法行医向公安机关移送，目前卫计部门调查获取的证据链不完整，也不符合条件。同宇强建议当事人可通过司法途径进行索赔。&lt;/p&gt;&lt;p&gt;&lt;strong&gt;疑问四&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;停业整顿后将如何处理&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;韩城市卫计局称，本次检查中发现该门诊部还有3名“医生”没有取得《医师执业证书》，因此，市卫计局已在5月25日下达了行政处罚决定书。对于下一步的措施，执法大队一名工作人员介绍，目前该门诊部的《医疗机构执业证书》已被依法暂扣，限期停业一周完成整顿，随后卫计部门会进行检查验收，不合格的将要求二次停业整顿，如果整改仍不合格的话将依法吊销《医疗机构执业证书》。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n                                            &lt;/div&gt;\r\n\r\n', 1, NULL),
(16, 16, 's:36:"p2p,e速贷,法定代表人被逮捕";', '广东惠州市P2P平台e速贷涉嫌非法集资一事昨日有了最新进展。昨天，惠州警方发布通报称，已查明e速贷为非法融资。目前，e速贷运营公司——广东汇融投资股份公司法人代表简某已于5月30日被惠州警方以涉嫌非法吸收公众存款罪正式逮捕。', '&lt;div id=&quot;Cnt-Main-Article-QQ&quot; bosszone=&quot;content&quot;&gt;&lt;p align=&quot;center&quot;&gt;&lt;/p&gt;&lt;div class=&quot;mbArticleSharePic  &quot; r=&quot;1&quot;&gt;&lt;div class=&quot;mbArticleShareBtn&quot;&gt;转播到腾讯微博&lt;/div&gt;&lt;img alt=&quot;e速贷法定代表人被逮捕 交易金额超过70亿元&quot; src=&quot;http://img1.gtimg.com/tech/pics/hv1/34/92/2077/135080419.jpg&quot;&gt;&lt;/div&gt;&lt;p&gt;广东惠州市P2P平台e速贷涉嫌非法集资一事昨日有了最新进展。昨天，惠州警方发布通报称，已查明e速贷为非法融资。目前，e速贷运营公司——广东汇融投资股份公司法人代表简某已于5月30日被惠州警方以涉嫌非法吸收公众存款罪正式逮捕。&lt;/p&gt;&lt;p&gt;本报讯(记者 温婧)广东惠州市P2P平台e速贷涉嫌非法集资一事昨日有了最新进展。昨天，惠州警方发布通报称，已查明e速贷为非法融资，并没有合法营利收入的业务，处于长期亏损的状态，投资者的资金被用作公司股东及家人的投资、消费及对外放贷，目前，e速贷运营公司——广东汇融投资股份公司法定代表人简某已于5月30日被惠州警方以涉嫌非法吸收公众存款罪正式逮捕。&lt;/p&gt;&lt;p&gt;通报称，经依法侦查查明，简某经营的广东汇融投资股份公司打着网络P2P旗号，其实以自融、设立资金池、发虚假标的形式进行非法集资，利用“e速贷”平台非法吸收的资金累计达数亿元。&lt;/p&gt;&lt;p&gt;该公司是惠州市最为老牌的P2P平台之一，自上线以来，总交易金额超过70亿元。惠州警方称，e速贷公司自2010年9月成立以来，除了非法吸存和放贷，基本没有合法营利收入的业务，处于长期亏损状态。公司主要依靠不停吸收新加入投资者本金的方式来维持公司运作，简某及部分公司股东主要依靠私自发卖公司股份等方式吸取资金池数亿元现金。&lt;/p&gt;&lt;p&gt;投资人的资金则部分被简某及家人私自占有并以个人名义进行投资；有部分资金被简某不入公司账目私自拿走不明去向；有部分资金被挪到简某亲戚名下进行放贷收不回来；有部分资金被简某用于购买高档小汽车、豪宅、写字楼等归于自己及妻子名下；还有部分资金用于偿还高额利息和股东分红。&lt;/p&gt;&lt;p&gt;惠州警方表示，经提请检察院批准，e速贷运营公司广东汇融投资股份公司法定代表人简某已于5月30日被惠州警方以涉嫌非法吸收公众存款罪正式逮捕。此前，e速贷发布公告称公司的13名高管正在接受调查，其中就包括董事长简某和总经理邓某。警方表示，目前已将所有涉案财产彻查暂扣，全力追回受害人财产。并请e速贷的投资人迅速向户口所在地或居住地公安机关报案并如实反映投资情况。&lt;/p&gt;\r\n&lt;div id=&quot;tipsWBzf&quot;&gt;&lt;/div&gt;&lt;/div&gt;', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_posts_categories`
--

CREATE TABLE `boone_posts_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `layout` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_posts_categories`
--

INSERT INTO `boone_posts_categories` (`id`, `name`, `parent`, `layout`, `description`) VALUES
(3, '科技', 0, 'default', NULL),
(4, '社会', 0, 'default', NULL),
(6, '网购', 0, 'default', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `boone_settings`
--

CREATE TABLE `boone_settings` (
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type` set('text','textarea','password','select','select-multiple','radio','checkbox') COLLATE utf8_unicode_ci NOT NULL,
  `default` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `options` text COLLATE utf8_unicode_ci,
  `isRequired` int(1) NOT NULL,
  `isGui` int(1) NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'general',
  `order` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_settings`
--

INSERT INTO `boone_settings` (`slug`, `type`, `default`, `value`, `options`, `isRequired`, `isGui`, `module`, `order`) VALUES
('activationEmail', 'select', '1', '0', '0=activate_by_admin|1=activate_by_email|2=no_activation', 0, 1, 'users', 961),
('addonUpload', 'radio', '0', '0', '1=Enabled|0=Disabled', 1, 1, 'addon', 1000),
('autoUsername', 'radio', '1', '', '1=Enabled|0=Disabled', 0, 1, 'users', 964),
('dateFormat', 'select', 'F j, Y', 'Y-m-d', 'Y-m-d H:i:s= 2000-01-01 01:01:00|Y-m-d=2000-01-01|F j, Y=F j, Y|Y/n/j=Y/n/j|F jS, Y=F jS, Y|D M j, Y=D M j, Y', 0, 1, 'general', 9997),
('enableProfiles', 'radio', '1', '', '1=Enabled|0=Disabled', 1, 1, 'users', 963),
('enableRegistration', 'radio', '1', '1', '1=Enabled|0=Disabled', 0, 1, 'users', 961),
('filesCache', 'select', '480', '480', '0=no-cache|1=1-minute|60=1-hour|180=3-hour|480=8-hour|1440=1-day|43200=30-days', 1, 1, 'file', 1000),
('filesMaxParallel', 'select', '1', '5', '1=1|5=5|10=10|20=10', 1, 1, 'file', 997),
('filesUploadLimit', 'text', '5', '5', '', 1, 1, 'file', 998),
('frontendActive', 'radio', '10', '1', '1=Open|0=Closed', 0, 1, 'general', 9993),
('metaTopic', 'text', 'Boone inc', '权威权益维护 诚信 正直 刚正不阿 诚信公益平台', '', 0, 1, 'general', 9998),
('profileVisibility', 'select', 'public', 'public', 'public=profile_public|owner=profile_owner|hidden=profile_hidden|member=profile_member', 0, 1, 'users', 960),
('recordsPerPage', 'select', '10', '10', '10=10|25=25|50=50|100=100', 0, 1, 'general', 9996),
('registeredEmail', 'radio', '1', '', '1=Enabled|0=Disabled', 0, 1, 'users', 962),
('siteLang', 'select', '10', '', 'func:getSupportedLang', 0, 0, 'general', 9994),
('siteLnaguage', 'select', '10', '', 'func:getSupportedLang', 0, 0, 'general', 9995),
('siteName', 'text', 'Boone inc', '权威权益维护 诚信 正直 刚正不阿 正义公益平台', '', 0, 1, 'general', 10000),
('siteSlogan', 'text', 'Boone inc', '诚信公益平台,权威权益维护，信用查询', '', 0, 1, 'general', 9999),
('unavailableMessage', 'textarea', 'Sorry, this website is currently unavailable.', NULL, NULL, 0, 1, 'general', 9992);

-- --------------------------------------------------------

--
-- 表的结构 `boone_site_message`
--

CREATE TABLE `boone_site_message` (
  `id` int(11) NOT NULL,
  `senderUser` text COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `acceptUser` int(11) NOT NULL,
  `isImportant` tinyint(1) NOT NULL DEFAULT '0',
  `isReply` tinyint(1) NOT NULL DEFAULT '0',
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `segmentUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` int(11) NOT NULL,
  `replyOn` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_site_message`
--

INSERT INTO `boone_site_message` (`id`, `senderUser`, `isAdmin`, `acceptUser`, `isImportant`, `isReply`, `isRead`, `segmentUrl`, `title`, `subject`, `content`, `createdOn`, `replyOn`) VALUES
(1, 'a:33:{s:2:"id";s:1:"1";s:5:"group";s:1:"1";s:7:"account";s:19:"developer@boone.red";s:8:"password";s:60:"$2y$10$j8dL9TyLORhqoufFPuDguepQResx4EAarsvE0BuIjWKdvRza6q6Im";s:4:"salt";s:8:"7da6f852";s:6:"avatar";s:37:"/resources/uploads/avater/default.bmp";s:21:"forgottenPasswordCode";N;s:8:"loginKey";s:60:"$2y$10$HLz/x4kK1s7e6qqRjUoyPebV6Timl0cnNrRD.hSlrfX.q4AsfJdf.";s:8:"username";s:5:"Boone";s:6:"mobile";N;s:6:"active";s:1:"1";s:9:"createdOn";s:10:"1460356714";s:9:"ipAddress";s:9:"127.0.0.1";s:9:"lastLogin";s:10:"1465180700";s:9:"groupName";s:9:"developer";s:16:"groupDescription";s:91:"This is a group of developers, to manage the entire system development and maintenance work";s:6:"userId";s:1:"1";s:11:"displayName";s:5:"Boone";s:9:"firstName";s:5:"Boone";s:8:"lastName";s:2:"Li";s:7:"company";N;s:10:"department";N;s:3:"job";N;s:3:"bio";N;s:6:"gender";s:4:"male";s:8:"birthday";N;s:5:"phone";N;s:11:"addressLine";s:0:"";s:14:"addressLineOne";N;s:14:"addressLineTwo";N;s:8:"postcode";N;s:7:"website";N;s:9:"updatedOn";N;}', 1, 1, 1, 0, 0, '0', '恭喜您！成功加入投诉网。', '团队审批', '&lt;h1 class=&quot;text-center&quot;&gt;李连锦&lt;/h1&gt;\n&lt;h4 class=&quot;text-success&quot;&gt;您好！恭喜您已成功加入投诉网团队。&lt;/h4&gt;\n&lt;p&gt;我们将有6个月对新加入团队的成员进行更多资质考核！您需要详细阅读以下内容。&lt;br&gt;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;您需要积极帮助更多的人。&lt;/li&gt;&lt;li&gt;您需要有具备公益事业的精神。&lt;/li&gt;&lt;li&gt;您需要写3篇或以上文章。&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;\n&lt;p class=&quot;text-right&quot;&gt;该信件系统自动发送&lt;/p&gt;&lt;p class=&quot;text-right&quot;&gt;team@itousu.net&lt;/p&gt;\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;\n&lt;h4&gt;&lt;/h4&gt;\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1465180838, 0);

-- --------------------------------------------------------

--
-- 表的结构 `boone_wysiwyg`
--

CREATE TABLE `boone_wysiwyg` (
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `disk` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'local',
  `height` int(11) NOT NULL DEFAULT '400',
  `placeholder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warning` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instructions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buttons` text COLLATE utf8_unicode_ci NOT NULL,
  `plugins` text COLLATE utf8_unicode_ci NOT NULL,
  `lineBreaks` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `boone_wysiwyg`
--

INSERT INTO `boone_wysiwyg` (`slug`, `name`, `disk`, `height`, `placeholder`, `warning`, `instructions`, `buttons`, `plugins`, `lineBreaks`) VALUES
('helper_content', '帮助中心', 'local', 350, NULL, NULL, NULL, '["bold","italic","deleted","lists","link","format","horizontalrule","underline"]', '["source","table","video","inlinestyle","filemanager","imagemanager","fullscreen","alignment"]', 0),
('post_content', '内容', 'local', 350, '', '', '', '["bold","italic","deleted","lists","link","format","horizontalrule","underline"]', '["source","table","video","inlinestyle","filemanager","imagemanager","fullscreen","alignment"]', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boone_admin_groups`
--
ALTER TABLE `boone_admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_admin_users`
--
ALTER TABLE `boone_admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_admin_users_profile`
--
ALTER TABLE `boone_admin_users_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_applications`
--
ALTER TABLE `boone_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_blog`
--
ALTER TABLE `boone_blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `unique_slug` (`slug`),
  ADD KEY `categories` (`categories`);

--
-- Indexes for table `boone_blog_body`
--
ALTER TABLE `boone_blog_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_blog_categories`
--
ALTER TABLE `boone_blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_blog_heart_log`
--
ALTER TABLE `boone_blog_heart_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_blog_settings`
--
ALTER TABLE `boone_blog_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_blog_tags`
--
ALTER TABLE `boone_blog_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_comments`
--
ALTER TABLE `boone_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_comment_log`
--
ALTER TABLE `boone_comment_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commnetId` (`commentId`);

--
-- Indexes for table `boone_comment_reply`
--
ALTER TABLE `boone_comment_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commnetId` (`commentId`);

--
-- Indexes for table `boone_files`
--
ALTER TABLE `boone_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_file_folders`
--
ALTER TABLE `boone_file_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_helper`
--
ALTER TABLE `boone_helper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `boone_helper_categories`
--
ALTER TABLE `boone_helper_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_honestys`
--
ALTER TABLE `boone_honestys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `segmentUrl` (`segmentUrl`);

--
-- Indexes for table `boone_honestys_body`
--
ALTER TABLE `boone_honestys_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_member`
--
ALTER TABLE `boone_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_member_group`
--
ALTER TABLE `boone_member_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_member_profile`
--
ALTER TABLE `boone_member_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_member_teams`
--
ALTER TABLE `boone_member_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_posts`
--
ALTER TABLE `boone_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `unique_slug` (`slug`),
  ADD KEY `categories` (`categories`);

--
-- Indexes for table `boone_posts_body`
--
ALTER TABLE `boone_posts_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_posts_categories`
--
ALTER TABLE `boone_posts_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_settings`
--
ALTER TABLE `boone_settings`
  ADD PRIMARY KEY (`slug`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `unique_slug` (`slug`);

--
-- Indexes for table `boone_site_message`
--
ALTER TABLE `boone_site_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boone_wysiwyg`
--
ALTER TABLE `boone_wysiwyg`
  ADD PRIMARY KEY (`slug`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `unique_slug` (`slug`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `boone_admin_groups`
--
ALTER TABLE `boone_admin_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `boone_admin_users`
--
ALTER TABLE `boone_admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `boone_admin_users_profile`
--
ALTER TABLE `boone_admin_users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `boone_applications`
--
ALTER TABLE `boone_applications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `boone_blog`
--
ALTER TABLE `boone_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `boone_blog_body`
--
ALTER TABLE `boone_blog_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `boone_blog_categories`
--
ALTER TABLE `boone_blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `boone_blog_heart_log`
--
ALTER TABLE `boone_blog_heart_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `boone_blog_settings`
--
ALTER TABLE `boone_blog_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `boone_blog_tags`
--
ALTER TABLE `boone_blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- 使用表AUTO_INCREMENT `boone_comments`
--
ALTER TABLE `boone_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `boone_comment_log`
--
ALTER TABLE `boone_comment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `boone_comment_reply`
--
ALTER TABLE `boone_comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `boone_file_folders`
--
ALTER TABLE `boone_file_folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `boone_helper`
--
ALTER TABLE `boone_helper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `boone_helper_categories`
--
ALTER TABLE `boone_helper_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `boone_honestys`
--
ALTER TABLE `boone_honestys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `boone_honestys_body`
--
ALTER TABLE `boone_honestys_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `boone_member`
--
ALTER TABLE `boone_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `boone_member_group`
--
ALTER TABLE `boone_member_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `boone_member_profile`
--
ALTER TABLE `boone_member_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `boone_member_teams`
--
ALTER TABLE `boone_member_teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `boone_posts`
--
ALTER TABLE `boone_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `boone_posts_body`
--
ALTER TABLE `boone_posts_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `boone_posts_categories`
--
ALTER TABLE `boone_posts_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `boone_site_message`
--
ALTER TABLE `boone_site_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
