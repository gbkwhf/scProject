<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>商品详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/shopDetails.css" />
		<link rel="stylesheet" type="text/css" href="css/swiper-3.4.0.min.css">
	</head>
	<script>
		//解决IOS微信webview后退不执行JS的问题
		window.onpageshow = function(event) {
			if(event.persisted) {
				window.location.reload();
			}
		};
	</script>

	<body>
		<!-----------顶部固定----------->
		<div class="shopTitle">
			<a class="shop dd" onclick="click_scroll1();">商品</a>
			<a class="details" onclick="click_scroll2();">详情</a>
		</div>

		<!-----------轮播图------------->
		<div class="swiper-container aa" id="001">
			<div class="swiper-wrapper"></div>
			<div class="swiper-pagination"></div>
		</div>
		<!--------商品名称-->
		<div class="shopIntroduce"></div>
		<!--------------商品单价------>
		<div class="shopPrice">
			<div class="price"></div>
			<div class="bor"></div>
			<div class="super" onclick="location.href='super_return.php'">超级返?</div>
		</div>
		<div class="rebate">
			<h4>利润共享返利条件</h4>
			<ul class="rebate-con">
				<li>
					<em>用户自购利润共享：</em> 必须在平台会员区一次性消费1280元/单（含1280）以上，且订单完成（无退货）。
				</li>
				<li>
					<em>利润共享标准：</em> 每日平台总利润50%÷会员每日订单基数；
				</li>
				<li>
					<em>利润共享天数：</em> 180天，由系统每天自动返还。达到以上条件，平台会根据会员个人所推荐的总人数给予会员个人一定比例的推荐返利，推荐共享的金额每天根据财务数据统计，由系统自动返到会员的平台账户“可用余额”里。
				</li>
			</ul>
		</div>
		<div class="kong"></div>
		<!-----------底部固定------------->
		<div class="shopBuy">
			<div class="addCar" id="addCar">加入购物车</div>
		</div>
		<!------------商品详情------------>
		<div class="detailTitle aa" id="002">商品详情</div>
		<div class="shopImg"></div>
		<!--购物车-->
		<div class="shopping-cart" id="shopping-cart" onclick="location.href='newShop_cart.php'">
			<img src="images/shopping-cart.png" />
			<span></span>
		</div>
	</body>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/config.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/swiper-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/shopDetails.js"></script>
	<script type="text/javascript" src="js/layer/layer.js"></script>
	<script type="text/javascript" src="js/jquery.fly.min.js"></script>
	<script type="text/javascript" src="js/requestAnimationFrame.js"></script>
	<script type="text/javascript">
		//根据商品id获取商品详情
		$(function() {
			shopCarts(); //页面加载的时候显示购物车的数量
			var goods_id = $_GET['goods_id']; //获取商品id
			console.log(goods_id + '+++++');
			$.ajax({
				type: "get",
				dataType: 'json',
				url: commonsUrl + 'api/gxsc/get/commodity/info/' + goods_id + versioninfos,
				data: {
					"goods_id": goods_id //商品id
				},
				success: function(data) {
					console.log(data)
					if(data.code == 1) { //请求成功
						var con = data.result; //
						var content = con.content; //商品详情
						var goods_id = con.goods_id; //商品id
						var goods_name = con.goods_name; //商品名称
						var img_url = con.img_url; //商品图片列表
						var num = con.num; //商品数量
						var price = con.price; //商品单价
						var sales = con.sales; //商品销量
						//------------进行赋值---------------
						$('.swiper-pagination-total').html(img_url.length); //轮播图计数
						$('.shopIntroduce').html(goods_name); //商品名
						$('.price').html('¥' + price); //商品单价
						$('.shopImg').html(content); //商品内容
						//---------------循环图片（轮播图）-----
						$.each(img_url, function(k, v) {
							var src = img_url[k].image;
							var imgId = img_url[k].img_id;
							var t = "<div class='swiper-slide'><image src=" + src + "/></div>";
							$('.swiper-wrapper').append(t)
						});
						$('.addCar').attr('pic', img_url[0].image);

					}
					//swiper插件实现轮播图
					var mySwiper = new Swiper('.swiper-container', {
						paginationType: 'fraction', //分页器
						loop: true,
						pagination: '.swiper-pagination',
					});

				}
			});

			var offset = $("#shopping-cart").offset(); //结束的地方的元素
			//------------创建购物车------------
			$(".addCar").click(function(event) {
					console.log($(document).scrollTop());
					console.log(offset.top);
					var addcar = $(this);
					var goods_id = $_GET['goods_id'];
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/update/goods/car/commodity/number' + versioninfos, //请求地址
						data: {
							"symbol": 1, //点击加号传1
							"goods_id": goods_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							console.log(data);

							//获取该商品的图片
							var img = addcar.attr('pic');
							var flyer = $('<img class="u-flyer" src="' + img + '">');
							flyer.fly({
								start: {
									left: event.pageX,
									top: event.pageY
								},
								end: {
									left: offset.left + 10,
									top: offset.top + 10,
									width: 0,
									height: 0
								},
								onEnd: function() {
									this.destory();
								}
							});
							shopCarts();
						}
					});
				})
				//获取购物车中的商品数量
			function shopCarts() {
				var tarr = [];
				var numberShop = 0;
				$.ajax({
					type: "post",
					url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos,
					data: {
						"ss": getCookie('openid')
					},
					success: function(data) {
						if(data.code == 1) { //请求成功
							console.log(data);
							var arr = data.result.info;
							$.each(arr, function(k, v) {
								$.each(v.goods_list, function(key, value) {
									//console.log(value.number);
									numberShop += parseInt(value.number)
								})
							})
							console.log(numberShop + 'iiiiiii')
							$('.shopping-cart span').html(numberShop);

						} else {
							layer.msg(data.msg);
						}
					}
				});
			};
		});
	</script>
	<script type="text/javascript">
		function click_scroll1() {
			var scroll_offset = $("#001").offset(); //得到pos这个div层的offset，包含两个值，top和left 
			$("body,html").animate({
				scrollTop: scroll_offset.top //让body的scrollTop等于pos的top，就实现了滚动 
			}, 0);
		}

		function click_scroll2() {
			var scroll_offset = $("#002").offset(); //得到pos这个div层的offset，包含两个值，top和left 
			$("body,html").animate({
				scrollTop: scroll_offset.top //让body的scrollTop等于pos的top，就实现了滚动 
			}, 0);
		}

		function click_scroll3() {
			var scroll_offset = $("#003").offset(); //得到pos这个div层的offset，包含两个值，top和left 
			$("body,html").animate({
				scrollTop: scroll_offset.top //让body的scrollTop等于pos的top，就实现了滚动 
			}, 0);
		}
	</script>

</html>