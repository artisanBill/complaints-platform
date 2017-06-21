<style type="text/css">
#cd-timeline {
	position: relative;
	padding: 2em 0;
	margin-top: 2em;
	margin-bottom: 2em;
}
#cd-timeline::before {
  /* this is the vertical line */
	content: '';
	position: absolute;
	top: 0;
	left: 18px;
	height: 100%;
	width: 4px;
	background: #d7e4ed;
}
@media only screen and (min-width: 1170px) {
	#cd-timeline {
	margin-top: 3em;
	margin-bottom: 3em;
	}
	#cd-timeline::before {
		left: 50%;
		margin-left: -2px;
	}
}

.cd-timeline-block {
	position: relative;
	margin: 2em 0;
}
.cd-timeline-block:after {
	content: "";
	display: table;
	clear: both;
}
.cd-timeline-block:first-child {
	margin-top: 0;
}
.cd-timeline-block:last-child {
	margin-bottom: 0;
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-block {
		margin: 4em 0;
	}
	.cd-timeline-block:first-child {
		margin-top: 0;
	}
	.cd-timeline-block:last-child {
		margin-bottom: 0;
	}
}

.cd-timeline-version {
	position: absolute;
	top: 0;
	left: 0;
	width: 60px;
    height: 60px;
    margin-left: -10px;
	line-height: 60px;
	text-align: center;
	border-radius: 50%;
	color: white;
	box-shadow: 0 0 0 4px white, inset 0 2px 0 rgba(0, 0, 0, 0.02), 0 3px 0 4px rgba(0, 0, 0, 0.04);
}
.cd-timeline-version.cd-danger {
	background: #FF3240;
}
.cd-timeline-version.cd-success {
	background: #24CE7B;
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-version {
		width: 60px;
		height: 60px;
		left: 50%;
		margin-left: -30px;
		/* Force Hardware Acceleration in WebKit */
		-webkit-transform: translateZ(0);
		-webkit-backface-visibility: hidden;
	}
	.cssanimations .cd-timeline-version.is-hidden {
		visibility: hidden;
	}
	.cssanimations .cd-timeline-version.bounce-in {
		visibility: visible;
		-webkit-animation: cd-bounce-1 0.6s;
		-moz-animation: cd-bounce-1 0.6s;
		animation: cd-bounce-1 0.6s;
	}
}

.cd-timeline-content {
	position: relative;
	margin-left: 72px;
	background: white;
	padding: 1em;
	box-shadow: 0 3px 0 #EFF2F7;
}
.cd-timeline-content:after {
	content: "";
	display: table;
	clear: both;
}
.cd-timeline-content .cd-date {
	font-size: 14px;
	font-size: 0.8125rem;
}
.cd-timeline-content .cd-date {
	display: inline-block;
}

.cd-timeline-content .cd-date {
	float: left;
	padding: .8em 0;
	opacity: .7;
}
.cd-timeline-content::before {
	content: '';
	position: absolute;
	top: 16px;
	right: 100%;
	height: 0;
	width: 0;
	border: 7px solid transparent;
	border-right: 7px solid white;
}
@media only screen and (min-width: 768px) {
  .cd-timeline-content .cd-date {
    font-size: 14px;
    font-size: 0.875rem;
  }
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-content {
		margin-left: 0;
		padding: 1.6em;
		width: 45%;
	}
	.cd-timeline-content::before {
		top: 24px;
		left: 100%;
		border-color: transparent;
		border-left-color: white;
	}
	.cd-timeline-content .cd-date {
		position: absolute;
		width: 100%;
		left: 122%;
		top: 6px;
		font-size: 16px;
		font-size: 1rem;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content {
		float: right;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content::before {
		top: 24px;
		left: auto;
		right: 100%;
		border-color: transparent;
		border-right-color: white;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
		left: auto;
		right: 122%;
		text-align: right;
	}
	.cssanimations .cd-timeline-content.is-hidden {
		visibility: hidden;
	}
	.cssanimations .cd-timeline-content.bounce-in {
		visibility: visible;
		-webkit-animation: cd-bounce-2 0.6s;
		-moz-animation: cd-bounce-2 0.6s;
		animation: cd-bounce-2 0.6s;
	}
}

@media only screen and (min-width: 1170px) {
	/* inverse bounce effect on even content blocks */
	.cssanimations .cd-timeline-block:nth-child(even) .cd-timeline-content.bounce-in {
		-webkit-animation: cd-bounce-2-inverse 0.6s;
		-moz-animation: cd-bounce-2-inverse 0.6s;
		animation: cd-bounce-2-inverse 0.6s;
	}
}

</style>
<div class="container">
	<section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-version cd-danger">
				RC
			</div>

			<div class="cd-timeline-content">
				<h4>
					<span class="featured featured-danger">V 1.0.0</span>
					投诉网1.0RC1版本发布.
				</h4>
				<ol>
					<li>新增团队博客</li>
					<li>独立博客</li>
					<li>支持更换博客主题</li>
					<li>修改平台BUG</li>
				</ol>
				<span class="cd-date">2016-06-06</span>
			</div>
		</div>

		<div class="cd-timeline-block">
			<div class="cd-timeline-version cd-success">
				BETA
			</div>

			<div class="cd-timeline-content">
				<h4>
					<span class="featured featured-danger">V 1.1.0</span>
					平台重构（前端整体视觉效果到后台功能模块）
				</h4>
				<ol>
					<li>用户模块</li>
					<li>投诉模块</li>
					<li>评论模块</li>
					<li>新增文章模块</li>
					<li>新增帮助中心模块</li>
					<li>新增团队入驻模块</li>
				</ol>
				<span class="cd-date">2016-03-22</span>
			</div>
		</div>

		<div class="cd-timeline-block">
			<div class="cd-timeline-version cd-danger">
				<span>BETA</span>
			</div>

			<div class="cd-timeline-content">
				<h4>
					<span class="featured featured-danger">V 1.0.1</span>
					BUG修复
				</h4>
				<ol>
					<li>修复注册BUG</li>
					<li>修复上传文件BUG</li>
					<li>更新首页页面呈现效果</li>
					<li>增加平台信息内容</li>
					<li>用户中心投诉列表</li>
					<li>用户身份信息验证</li>
					<li>回应功能, 支持回复, 对回应表示支持和否决.</li>
				</ol>
				<span class="cd-date">2016-03-23</span>
			</div>
		</div>

		<div class="cd-timeline-block">
			<div class="cd-timeline-version cd-success">
				BETA
			</div>

			<div class="cd-timeline-content">
				<h4>
					<span class="featured featured-danger">V 1.0.0</span>
					平台测试版上线
				</h4>
				<ol>
					<li>用户注册</li>
					<li>用户资料完善</li>
					<li>发布投诉</li>
				</ol>
				<span class="cd-date">2016-03-22</span>
			</div>
		</div>

	</section>
</div>	