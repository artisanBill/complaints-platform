<?php

$lang = array(
	'setting.siteName.title'		=> '网站名称',
	'setting.siteName.desc'			=> '在这里设定的名称会应用在标题标签以及整个网站。',

	'setting.siteLang.title'		=> '站点语言',

	'setting.contactEmail.title'	=> '网站预设信箱',
	'setting.contactEmail.desc'		=> '所有来自于网站中用户或访客的信件，都将会寄到这个信箱里。',

	'setting.metaTopic.title'		=> 'Meta 标题',
	'setting.metaTopic.desc'		=> '简述贵 公司/网站 的种类。',

	'setting.serverEmail.title'		=> '伺服器信箱',
	'setting.serverEmail.desc'		=> '简述贵 公司/网站 的种类。',

	'setting.siteLnaguage.title'	=> '网站语言',
	'setting.siteLnaguage.desc'		=> '网站的预设母语，用于选择内部通知、电子邮件模板和接受访客的联系和其他功能的语言。',

	'setting.currency.title'		=> '货币',
	'setting.currency.desc'			=> '货币符号，这将会应用在产品等相关服务上。',

	'setting.dashboardRss.title'	=> '控制台 RSS Feed',
	'setting.dashboardRss.desc'		=> '连结到会显示在控制台的 RSS feed。',

	'setting.dashboardRssCount.title'=> '控制台 RSS 项目',
	'setting.dashboardRssCount.desc'=> '您想要多少RSS 项目显示在控制台中呢？',

	'setting.dateFormat.title'		=> '日期格式',
	'setting.dateFormat.desc'		=> '设定网站前后台的日期显示格式。请参考<a href="http://php.net/manual/en/function.date.php" target="_black">date format</a> from PHP - 或是- 参考​​<a href="http ://php.net/manual/en/function.strftime.php" target="_black">strings formated as date</a> from PHP。',

	'setting.frontendActive.title'	=> '网站状态',
	'setting.frontendActive.desc'	=> '您可使用这个选项将网站关闭或开启。若您想要暂时关闭网站以进行维护工作，这会非常有用。',

	'setting.robots.title'			=> 'Robots.txt',
	'setting.robots.desc'			=> 'Define the robots.txt file for your site. <a href="https://moz.com/learn/seo/robotstxt">Learn more.</a>',

	//	Email
	'setting.mailProtocol.title'	=> 'Mail Protocol',
	'setting.mailProtocol.desc'		=> '请选择所需的电子邮件沟通协议。',

	'setting.mailSendmailPath.title'=> 'Sendmail 路径',
	'setting.mailSendmailPath.desc'	=> '服务器中 sendmail binary 的路径。',

	'setting.mailSmtpHost.title'	=> 'SMTP Host',
	'setting.mailSmtpHost.desc'		=> '您的 SMTP 名称。',

	'setting.mailSmtpPass.title'	=> 'SMTP 密码',
	'setting.mailSmtpPass.desc'		=> '您的 SMTP 密码。',

	'setting.mailSmtpPort.title'	=> 'SMTP Port',
	'setting.mailSmtpPort.desc'		=> 'SMTP 通讯端口。',

	'setting.mailSmtpUser.title'	=> 'SMTP User Name',
	'setting.mailSmtpUser.desc'		=> 'SMTP 使用者名称。',

	'setting.activationEmail.title'	=> '发送启动信件',
	'setting.activationEmail.desc'	=> '当用户注册会员时，自动发送内含帐号启动连结的信件。如果关闭这个项目，那么只有管理员能够启动使用者帐户。',

	//	site
	'setting.unavailableMessage.title'=> '网站关闭讯息',
	'setting.unavailableMessage.desc'=> '当网站关闭或有重大问题时，这段讯息将会显示给前端网站的浏览者。',

	//	pageigation
	'setting.recordsPerPage.title'	=> '每页显示的资料数',
	'setting.recordsPerPage.desc'	=> '在管理系统中，每页所显示的资料笔数。',

	//	language
	'setting.sitePublicLang.title'	=> '前端的語言',
	'setting.sitePublicLang.desc'	=> '这个网站前端支援什么语言？',

	'setting.adminForceHttps.title'	=> '在管理后台强制使用 HTTPS？',
	'setting.adminForceHttps.desc'	=> '只允许使用HTTPS 协定来使用此管理后台？',

	'setting.mailLineEndings.title'	=> 'Email Line Endings',
	'setting.mailLineEndings.desc'	=> 'Change from the standard \r\n line ending to PHP_EOL for some email servers.',

	//	payment
	'setting.paymentEnable.title'	=> '订单支付',
	'setting.paymentEnable.desc'	=> '是否启用支付? 关闭支付, 用户将无法线上进行付款. ',

	//	api
	'setting.apiEnabled.title'	=> 'Allow API',
	'setting.apiEnabled.desc'	=> 'Allow API access to all modules which have an API controller.',

	#checkbox and radio options
	'option.form_option_Open'			=> '开放',
	'option.form_option_Closed'			=> '关闭',
	'option.form_option_Enabled'		=> '启用',
	'option.form_option_Disabled'		=> '禁用',
	'option.form_option_Required'		=> '必要',
	'option.form_option_Optional'		=> '可选择',
	'option.form_option_Oldest First'	=> '最旧优先',
	'option.form_option_Newest First'	=> '最新优先',
	'option.form_option_Text Only'		=> '仅限纯文字',
	'option.form_option_Allow Markdown'	=> '允许 Markdown',
	'option.form_option_Yes'			=> '是',
	'option.form_option_No'				=> '否',

	// titles
	'title.save'						=> '编辑设定',

	// messages
	'message.noSettings'				=> '目前没有设定',
	'message.saveSuccess'				=> '您的设定已经储存',

	'slug.general'		=> '一般',
	'slug.addon'		=> '附加功能',
	'slug.users'		=> '用户',
	'slug.comments'		=> '回应',
	'slug.api'			=> 'API',
	'slug.file'			=> '档案',
	'slug.email'		=> '邮件',
	'slug.statistics'	=> '统计',
	'slug.integration'	=> '整合',
	'slug.comment'		=> '回应',
	'slug.payment'		=> '支付',
	'slug.store'		=> '商店'
);