<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>商城</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/memberPages.css" />
		<link rel="stylesheet" type="text/css" href="css/swiper.min.css" />
		<link rel="stylesheet" type="text/css" href="css/commfooter.css" />
	</head>

	<body>
		<!-----------头部开始（搜索框）-->
		<div class="searchTop">
			<div class="searchBox">
				<div class="seachImg"><img src="images/searchImg.png" /></div>
				<div class="insearchBox"><input type="text" placeholder="请输入需要查找的商品" class="insearch" /></div>
			</div>
			<div class="searchSub">搜索</div>
		</div>
		<!------------轮播图------------->
		<div class="swiper-container" id="001">
			<div class="swiper-wrapper"></div>
			<div class="swiper-pagination "></div>
		</div>
		<!-------------商品分类----->
		<div class="container">
			<ul class="shopContent">
				<!--<li>
					<img src="images/classifyImg0.png" />
					<em>粮油副食</em>
				</li>
				<li>
					<img src="images/classifyImg1.png" />
					<em>双创生鲜</em>
				</li>
				<li>
					<img src="images/classifyImg2.png" />
					<em>茶叶酒水</em>
				</li>
				<li>
					<img src="images/classifyImg3.png" />
					<em>休闲食品</em>
				</li>
				<li>
					<img src="images/classifyImg4.png" />
					<em>日用百货</em>
				</li>
				<li>
					<img src="images/classifyImg5.png" onclick="location.href='member_mall_list.php?first_id=2'"/>
					<em>家居家装</em>
				</li>
				<li>
					<img src="images/classifyImg6.png" onclick="location.href='member_mall_list.php?first_id=3'"/>
					<em>健康商城</em>
				</li>
				<li>
					<img src="images/classifyImg7.png" />
					<em>养生旅游</em>
				</li>
				<li>
					<img src="images/classifyImg8.png" />
					<em>积分兑换</em>
				</li>
				<li>
					<img src="images/classifyImg9.png" onclick="location.href='lyg_index.php?first_id=5'" />
					<em>聆医馆</em>
				</li>-->
				<!--<li>
					<img src="images/shipin_03.png" onclick="location.href='member_mall_list.php?first_id=1'" />
					<em>食品土特产</em>
				</li>
				<li>
					<img src="images/jiaju_03.png" onclick="location.href='member_mall_list.php?first_id=2'" />
					<em>家居家装</em>
				</li>
				<li>
					<img src="images/health_03.png" onclick="location.href='member_mall_list.php?first_id=3'" />
					<em>健康商城</em>
				</li>
				<li>
					<img src="images/linyi.png" onclick="location.href='lyg_index.php?first_id=5'" />
					<em>聆医馆</em>
				</li>
				<li>
					<img src="images/yijing_03.png" onclick="location.href='member_mall_list.php?first_id=6'" />
					<em>非遗景泰蓝</em>
				</li>
				<li>
					<img src="images/shouhou_03.png" onclick="waitting()" />
					<em>售后交流</em>
				</li>-->
			</ul>

		</div>
		<!-------------福利区------->
		<!--<div class="welfare"><img src="images/welfare.png" /></div>-->
		<div class="noDiv"></div>
		<!----------------大分类区------->
		<div class="classfiyTitle">发现好货</div>
		<div class="classfiyBox">
			<div class="leftBox" onclick="location.href='Super.php?store_first_id=1'"><img src="images/supermarketImg.png"/></div>
			<div class="rightBox">
				<div class="localSpecialty" onclick="location.href='Super.php?store_first_id=3'"><img src="images/localImg.png"/></div>
				<div class="boutiqueGallery" onclick="location.href='Super.php?store_first_id=2'"><img src="images/bount.png"/></div>
			</div>
		</div>
		<!-----------新品上线------->
		<div class="newBox">
			<div class="newShopBox">新品上线</div>
			<div class="moreShop"><img src="images/back1.png" /></div>
		</div>

		<!----------商品信息----->
		<div id="refreshContainer" class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<div style="margin-bottom: 70px;" class="shop_Box">
					<!--<div class="shopBox">
				<div class="shopImg"><img src="images/shop_img.png" /></div>
				<div class="shopName">可玉可求 飘香翡翠手镯 女款玉手镯 玉器玉石收手镯子， 送礼自带均可</div>
				<div class="shopMessage">
					<div class="shops">
						<span class="shopPrice">￥22000</span>
						<span class="fan">返利0.2</span>
					</div>
					<div class="toBuy">立即抢购</div>
				</div>
			</div>
			<div class="shopBox">
				<div class="shopImg"><img src="images/shop_img.png" /></div>
				<div class="shopName">可玉可求 飘香翡翠手镯 女款玉手镯 玉器玉石收手镯子， 送礼自带均可</div>
				<div class="shopMessage">
					<div class="shops">
						<span class="shopPrice">￥22000</span>
						<span class="fan">返利0.2</span>
					</div>
					<div class="toBuy">立即抢购</div>
				</div>
			</div>-->

				</div>
			</div>
		</div>
		<!---------底部----->
		<!--<div id="commId" style="clear: both;"></div>-->
		<div class="shopBottom">
			<div class="memberIndex">
				<dl>
					<dt><img src="images/in2.jpg"/></dt>
					<dd style="color: #e63636;">首页</dd>
				</dl>
			</div>
			<div class="shopCar" onclick="location.href='newShop_cart.php'">
				<dl>
					<dt>
						<img src="images/che1.jpg" class="car"/>
						<span>0</span>
					</dt>
					<dd style="color: #333333;">购物车</dd>

				</dl>
			</div>
			<div class="personal" onclick="location.href='personal_center.php'">
				<dl>
					<dt><img src="images/per1.jpg"/></dt>
					<dd style="color: #333333;">我的</dd>
				</dl>
			</div>
		</div>
	</body>

</html>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/layer/layer.js"></script>
<script src="js/common.js"></script>
<script src="js/config.js"></script>
<script type="text/javascript" src="js/swiper-3.4.0.min.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/memberPages.js"></script>

