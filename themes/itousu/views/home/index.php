<style type="text/css">
.home-process{
	padding: 0;
}
/* -------------------------------- 

Basic Style

-------------------------------- */
.cd-breadcrumb, .cd-multi-steps {
  width: 100%;
  padding: 0.5em 1em;
  margin: 1em auto;
  background-color: #24CE7B;
}
.cd-breadcrumb:after, .cd-multi-steps:after {
  content: "";
  display: table;
  clear: both;
}
.cd-breadcrumb li, .cd-multi-steps li {
  display: inline-block;
  float: left;
  margin: 0.5em 0;
}
.cd-breadcrumb li::after, .cd-multi-steps li::after {
  /* this is the separator between items */
  display: inline-block;
  content: '\00bb';
  margin: 0 .6em;
  color: white;
}
.cd-breadcrumb li:last-of-type::after, .cd-multi-steps li:last-of-type::after {
  /* hide separator after the last item */
  display: none;
}
.cd-breadcrumb li > *, .cd-multi-steps li > * {
  /* single step */
  display: inline-block;
  color: white;
}
.cd-breadcrumb li.current > *, .cd-multi-steps li.current > * {
  /* selected step */
  color: #24CE7B;
}
.no-touch .cd-breadcrumb a:hover, .no-touch .cd-multi-steps a:hover {
  /* steps already visited */
  color: #24CE7B;
}
.cd-breadcrumb.custom-icons li:not(.current):nth-of-type(2) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(2) > *::before {
  /* change custom icon using image sprites */
  background-position: -20px 0;
}
.cd-breadcrumb.custom-icons li:not(.current):nth-of-type(3) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(3) > *::before {
  background-position: -40px 0;
}
.cd-breadcrumb.custom-icons li:not(.current):nth-of-type(4) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(4) > *::before {
  background-position: -60px 0;
}
.cd-breadcrumb.custom-icons li.current:first-of-type > *::before, .cd-multi-steps.custom-icons li.current:first-of-type > *::before {
  /* change custom icon for the current item */
  background-position: 0 -20px;
}
.cd-breadcrumb.custom-icons li.current:nth-of-type(2) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(2) > *::before {
  background-position: -20px -20px;
}
.cd-breadcrumb.custom-icons li.current:nth-of-type(3) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(3) > *::before {
  background-position: -40px -20px;
}
.cd-breadcrumb.custom-icons li.current:nth-of-type(4) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(4) > *::before {
  background-position: -60px -20px;
}
@media only screen and (min-width: 768px) {
  .cd-breadcrumb, .cd-multi-steps {
    padding: 0 1.2em;
  }
  .cd-breadcrumb li, .cd-multi-steps li {
    margin: 1.2em 0;
  }
  .cd-breadcrumb li::after, .cd-multi-steps li::after {
    margin: 0 1em;
  }
  
}

/* -------------------------------- 

Triangle breadcrumb

-------------------------------- */
@media only screen and (min-width: 768px) {
  .cd-breadcrumb.triangle {
    /* reset basic style */
    background-color: transparent;
    padding: 0;
  }
  .cd-breadcrumb.triangle li {
    position: relative;
    padding: 0;
    margin: 4px 4px 4px 0;
  }
  .cd-breadcrumb.triangle li:last-of-type {
    margin-right: 0;
  }
  .cd-breadcrumb.triangle li > * {
    position: relative;
    padding: 15px 15px 15px 25px;
    color: #2c3f4c;
    background-color: #24CE7B;
    /* the border color is used to style its ::after pseudo-element */
    border-color: #24CE7B;
  }
  .cd-breadcrumb.triangle li.current > * {
    /* selected step */
    color: #ffffff;
    background-color: #24CE7B;
  }
  .cd-breadcrumb.triangle li:first-of-type > * {
    padding-left: 1.6em;
  }
  .cd-breadcrumb.triangle li:last-of-type > * {
    padding-right: 1.6em;
  }
  .no-touch .cd-breadcrumb.triangle a:hover {
    /* steps already visited */
    color: #ffffff;
    background-color: #2c3f4c;
  }
  .cd-breadcrumb.triangle li::after, .cd-breadcrumb.triangle li > *::after {
    content: '';
    position: absolute;
    top: 0;
    left: 100%;
    content: '';
    height: 0;
    width: 0;
    /* 48px is the height of the <a> element */
    border: 24px solid transparent;
    border-right-width: 0;
    border-left-width: 20px;
  }
  .cd-breadcrumb.triangle li::after {
    /* this is the white separator between two items */
    z-index: 1;
    -webkit-transform: translateX(4px);
    -moz-transform: translateX(4px);
    -ms-transform: translateX(4px);
    -o-transform: translateX(4px);
    transform: translateX(4px);
    border-left-color: #ffffff;
    /* reset style */
    margin: 0;
  }
  .cd-breadcrumb.triangle li > *::after {
    /* this is the colored triangle after each element */
    z-index: 2;
    border-left-color: inherit;
  }
  .cd-breadcrumb.triangle li:last-of-type::after, .cd-breadcrumb.triangle li:last-of-type > *::after {
    /* hide the triangle after the last step */
    display: none;
  }
  .cd-breadcrumb.triangle.custom-separator li::after {
    /* reset style */
    background-image: none;
  }
  .cd-breadcrumb.triangle.custom-icons li::after, .cd-breadcrumb.triangle.custom-icons li > *::after {
    /* 50px is the height of the <a> element */
    border-top-width: 25px;
    border-bottom-width: 25px;
  }

  @-moz-document url-prefix() {
    .cd-breadcrumb.triangle li::after,
    .cd-breadcrumb.triangle li > *::after {
      /* fix a bug on Firefix - tooth edge on css triangle */
      border-left-style: dashed;
    }
  }
}
/* -------------------------------- 

Custom icons hover effects - breadcrumb and multi-steps

-------------------------------- */
@media only screen and (min-width: 768px) {
  .no-touch .cd-breadcrumb.triangle.custom-icons li:first-of-type a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:first-of-type em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:first-of-type a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:first-of-type em::before {
    /* change custom icon using image sprites - hover effect or current item */
    background-position: 0 -40px;
  }
  .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(2) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(2) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(2) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(2) em::before {
    background-position: -20px -40px;
  }
  .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(3) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(3) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(3) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(3) em::before {
    background-position: -40px -40px;
  }
  .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(4) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(4) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(4) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(4) em::before {
    background-position: -60px -40px;
  }
}
/* -------------------------------- 

Multi steps indicator 

-------------------------------- */
@media only screen and (min-width: 768px) {
  .cd-multi-steps {
    /* reset style */
    background-color: transparent;
    padding: 0;
    text-align: left;
  }

  .cd-multi-steps li {
    position: relative;
    float: none;
    margin: 0.4em 40px 0.4em 0;
  }
  .cd-multi-steps li:last-of-type {
    margin-right: 0;
  }
  .cd-multi-steps li::after {
    /* this is the line connecting 2 adjacent items */
    position: absolute;
    content: '';
    height: 4px;
    background: #24CE7B;
    /* reset style */
    margin: 0;
  }
  .cd-multi-steps li > *, .cd-multi-steps li.current > * {
    position: relative;
    color: #2c3f4c;
  }

  .cd-multi-steps.custom-separator li::after {
    /* reset style */
    height: 4px;
    background: #d0d9e7;
  }

  .cd-multi-steps.text-center li::after {
    width: 100%;
    top: 50%;
    left: 100%;
    -webkit-transform: translateY(-50%) translateX(-1px);
    -moz-transform: translateY(-50%) translateX(-1px);
    -ms-transform: translateY(-50%) translateX(-1px);
    -o-transform: translateY(-50%) translateX(-1px);
    transform: translateY(-50%) translateX(-1px);
  }
  .cd-multi-steps.text-center li > * {
    z-index: 1;
    padding: .6em 1em;
    background-color: #24CE7B;
    color: white;
  }
  .no-touch .cd-multi-steps.text-center a:hover {
    background-color: #2c3f4c;
  }
  .cd-multi-steps.text-top li, .cd-multi-steps.text-bottom li {
    width: 80px;
    text-align: center;
  }
  .cd-multi-steps.text-top li::after, .cd-multi-steps.text-bottom li::after {
    /* this is the line connecting 2 adjacent items */
    position: absolute;
    left: 50%;
    /* 40px is the <li> right margin value */
    width: calc(100% + 40px);
  }
  .cd-multi-steps.text-top li > *::before, .cd-multi-steps.text-bottom li > *::before {
    /* this is the spot indicator */
    content: '';
    position: absolute;
    z-index: 1;
    left: 50%;
    right: auto;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    height: 12px;
    width: 12px;
    border-radius: 50%;
    background-color: #24CE7B;
  }
  .no-touch .cd-multi-steps.text-top a:hover, .no-touch .cd-multi-steps.text-bottom a:hover {
    color: #24CE7B;
  }
  .no-touch .cd-multi-steps.text-top a:hover::before, .no-touch .cd-multi-steps.text-bottom a:hover::before {
    box-shadow: 0 0 0 3px rgba(150, 192, 61, 0.3);
  }

  .cd-multi-steps.text-top li::after {
    /* this is the line connecting 2 adjacent items */
    bottom: 4px;
  }
  .cd-multi-steps.text-top li > * {
    padding-bottom: 20px;
  }
  .cd-multi-steps.text-top li > *::before {
    /* this is the spot indicator */
    bottom: 0;
  }

  .cd-multi-steps.text-bottom li::after {
    /* this is the line connecting 2 adjacent items */
    top: 3px;
  }
  .cd-multi-steps.text-bottom li > * {
    padding-top: 20px;
  }
  .cd-multi-steps.text-bottom li > *::before {
    /* this is the spot indicator */
    top: 0;
  }
}
/* -------------------------------- 

Add a counter to the multi-steps indicator 

-------------------------------- */
.cd-multi-steps.count li {
  counter-increment: steps;
}

.cd-multi-steps.count li > *::before {
  content: counter(steps) " - ";
}

@media only screen and (min-width: 768px) {
  .cd-multi-steps.text-top.count li > *::before,
  .cd-multi-steps.text-bottom.count li > *::before {
    /* this is the spot indicator */
    content: counter(steps);
    height: 26px;
    width: 26px;
    line-height: 26px;
    color: #ffffff;
  }

  .cd-multi-steps.text-top.count li:not(.current) em::before,
  .cd-multi-steps.text-bottom.count li:not(.current) em::before {
    /* steps not visited yet - counter color */
    color: #2c3f4c;
  }

  .cd-multi-steps.text-top.count li::after {
    bottom: 11px;
  }

  .cd-multi-steps.text-top.count li > * {
    padding-bottom: 34px;
  }

  .cd-multi-steps.text-bottom.count li::after {
    top: 11px;
  }

  .cd-multi-steps.text-bottom.count li > * {
    padding-top: 34px;
  }
}


</style>
<section class="home-process">
	<div class="container">
		<ol class="cd-multi-steps text-center custom-icons">
			<li><a class="current">曝光</a></li>
			<li><a>编写受骗经历</a></li>
			<li><a>记录数据存档</a></li>
			<li><a>分析受骗漏洞</a></li>
			<li><a>加强防骗意识</a></li>
		</ol>

		<ol class="cd-multi-steps text-center custom-icons">
			<li><a class="current">维权</a></li>
			<li><a>编写受骗经历</a></li>
			<li><a>记录数据存档</a></li>
			<li><a>专家给出方案</a></li>
			<li><a>阐述维权需求</a></li>
			<li><a>给出解决方案</a></li>
			<li><a>相关部门解决</a></li>
		</ol>

		<ol class="cd-multi-steps text-center custom-icons">
			<li><a class="current">起诉</a></li>
			<li><a>编写受骗经历</a></li>
			<li><a>记录数据存档</a></li>
			<li><a>选择专业律师</a></li>
			<li><a>阐述起诉需求</a></li>
			<li><a>整理案件资料</a></li>
			<li><a>起诉维护权益</a></li>
		</ol>
	</div>

</section>

<section id="features">
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-plus-square fa-4x text-muted text-primary"></i>
							<h3>
								正直
								<br>			
								<small>公正无私、刚直坦率</small>
							</h3>
							<p>
								正直就是要不畏强势，敢做敢为，要能够坚持正道，要勇于承认错误。正直意味着有勇气坚持自己的信念。
							</p>
						</div>
						<span class="card-corner card-corner-primary"></span>
					</div>
				</div>

				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-users fa-4x text-muted text-warning"></i>
							<h3>
								责任
								<br>			
								<small>对事对他人对己对社会都有应尽的义务</small>
							</h3>
							<p>
								作为确定的人，现实的人，你就有规定、就有使命、就有任务，至于你是否意识到这一点，那是无所谓的。
							</p>
						</div>
						<span class="card-corner card-corner-warning"></span>
					</div>
				</div>

				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-heart fa-4x text-muted text-danger"></i>
							<h3>
								爱心
								<br>			
								<small>感谢是爱心的第一步</small>
							</h3>
							<p>
								慈悲不是出于勉强，它是像甘露一样从天上降下尘世；它不但给幸福于受施的人，也同样给幸福于施与的人。
							</p>
						</div>
						<span class="card-corner card-corner-danger"></span>
					</div>
				</div>

				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-shield fa-4x text-muted text-danger"></i>
							<h3>
								申明
								<br>			
								<small>严格保护资料</small>
							</h3>
							<p>
								身份信息严格加密。在本站对任何人不透露任何隐私(不含他人泄漏)。除非有法律文件的支持或得到用户本人的许可！
							</p>
						</div>
						<span class="card-corner card-corner-danger"></span>
					</div>
				</div>

				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-pencil-square fa-4x text-muted text-info"></i>
							<h3>
								服务
								<br>			
								<small>我为人人，人人为我</small>
							</h3>
							<p>
								提供受害人、他人帮助、对他人请求等信息发布，严格审核真实性。投诉人的请求由社会人士、专家、投诉网平台或法律帮助。
							</p>
						</div>
						<span class="card-corner card-corner-info"></span>
					</div>
				</div>

				<div class="col-lg-4 col-sm-6">
					<div class="card text-center">
						<div class="card-block">
							<i class="fa fa-share-alt fa-4x text-muted text-success"></i>
							<h3>
								公益
								<br>			
								<small>绿色和平是一个非牟利的组织</small>
							</h3>
							<p>
								[匡扶正义] 投诉网，正义公益平台。为社会各类人士提供诈骗诉求提供帮助。揭漏任何诈骗手段！
							</p>
						</div>
						<span class="card-corner card-corner-success"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section class="home-intro" id="home-intro">
	<div class="jumbotron jumbotron-fluid">
		<div class="container text-center">
			<h2 class="boone fadeInUp">随着科技的发展, 各种各样的骗招让我们<strong>防不胜防</strong>!</h2>
			<h2 class="boone fadeInDown">我们要做的是尽可能维护我们的权益.</h2>
			<div class="btn">
				<?php if ( isset($this->currentUser->id) ): ?>
					<a href="<?php echo app_url('user', 'honesty/create') ?>" class="btn btn-lg boone pulse" data-boone-iteration="infinite" data-boone-duration="1400ms">
						创建对 TA 投诉
					</a>
				<?php else: ?>
					<a href="<?php echo app_url('.', 'login') ?>" class="btn btn-lg boone pulse" data-boone-iteration="infinite" data-boone-duration="1400ms">
						立即登录投诉 TA
					</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>

<section id="designers">
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img class="img-responsive boone bounceInLeft" src="/resources/images/itousu/devices.png"></div>
				<div class="col-md-6">
					<h2>了解我们</h2>
					<p>
						针对消费者投诉需求的平台,用户可以通过该公共账号直接进行商业投诉，也可以通过该平台查询别人的投诉结果。目前“投诉网”支持图片、文字、地理位置等多种投诉形式。并对所有投诉信息进行汇总和整理及处理，用于商家,个人，组织等曝光和投诉查询，对一些严重事件通过法律手段维护受害者权益。
					</p>
					<h2>我们希望</h2>
					<p>让更多消费者懂得如何维权，同时提高消费警惕性，避免被侵权；也希望通过曝光促使商家能够积极改善产品与服务，完善消费体验。</p>
					<h2>支持设备</h2>
					<p>
						<label class="label label-success label-lg">
							<i class="fa fa-mobile"></i>
							手机
						</label>&nbsp;
						<label class="label label-success label-lg">
							<i class="fa fa-laptop"></i>
							平板
						</label>&nbsp;
						<label class="label label-success label-lg">
							<i class="fa fa-desktop"></i>
							电脑
						</label>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="parallax-counter parallaxBg" style="background-position: 50% -210px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-xs-6">
				<div class="counters">
					<span class="counter">0</span>
					<h4>总投诉量</h4>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="counters">
					<span class="counter">0</span>
					<h4>处理案件</h4>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="counters">
					<span class="counter"><?php echo $this->member_model->countAll() ?></span>
					<h4>注册用户</h4>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="counters">
					<span class="counter">2</span>
					<h4>团队人数</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/resources/site/script/jquery/animate.js"></script>
<script type="text/javascript">
	booneAnimated = new BOONE_ANIMATE(
	{
		animateClass: 'animated',
		offset: 100,
		offset: 0,
		mobile: true,
		live: true,
	});
	booneAnimated.init();
</script>