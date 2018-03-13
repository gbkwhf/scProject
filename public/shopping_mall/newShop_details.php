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
		<link rel="stylesheet" type="text/css" href="css/newShop_details.css" />
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
			<a class="pin" onclick="click_scroll3();">评价</a>

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
			<div class="priceBox"><span class="price"></span><span class="originalCost">原价：10000元</span></div>
			<div class="bor"></div>
			<div class="super" onclick="location.href='super_return.php'">超级返?</div>
		</div>
		<div class="saleBox">
			<div class="postage">邮费：<span class="postNum">10</span>元</div>
			<div class="sales">销量：<span class="saleNum">999</span></div>
		</div>
		<!-----------选择商品属性-->
		<div class="selectAttributes">
			<div class="attributes">选择尺码颜色和分类</div>
			<div class="backs"><img src="images/selectBack.png" /></div>
		</div>
		<!-----------选择商品属性弹出层-->
		<div class="selectPopup" style="display: none;" id="dd">
			<div class="hideBox"></div>
			<div class="attributesBox">
				<div class="attrHead">
					<div class="attrImg"><img src="images/attrImg.png" /></div>
					<div class="selectName">
						<p class="shop_name">精美琥珀核桃仁</p>
						<p class="selectAttr">请选择属性</p>
					</div>
					<div class="close"></div>
				</div>
				<div class="attrContent">
					<div class="atrrName">品种</div>
					<div class="attrType">
						<div class="type_one">盒装</div>
						<div class="type_one">袋装</div>
					</div>
					<div class="buyNumBox">
						<div class="buyTitle">购买数量</div>
						<div class="calculateBox">
							<div class="jian">-</div>
							<div class="inputBox"><input type="tel" name="inNum" id="inNum" value="1" readonly="readonly" class="shopNum" /></div>
							<div class="add">+</div>
						</div>
					</div>
				</div>
				<div class="confirm">确定</div>
			</div>
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
		<!--<div class="shopInformation">
			<div class="shopIntoduce">
				<a href="#002">商品介绍</a>
			</div>
			<div class="apprarise">
				<a href="#003">评论</a>
			</div>
		</div>-->
		<!-----------底部固定------------->
		<div class="shopBuy">
			<div class="botBox1">
				<div class="store">
					<dl>
						<dt><img src="images/store.png"/></dt>
						<dd>店铺</dd>
					</dl>
				</div>
				<div class="shop_car">
					<dl>
						<dt>
							<img src="images/shop_car.png" class="carImg"/>
							<span class="carNum">15</span>
						</dt>
						<dd>购物车</dd>
					</dl>
				</div>
			</div>
			<div class="addCar" id="addCar">加入购物车</div>
			<div class="buyNow">立即购买</div>
		</div>
		<!------------商品详情------------>
		<div class="detailTitle aa" id="002">商品详情</div>
		<div class="shopImg"></div>
		<!------------商品评价------------>
		<div class="shopApprarise aa" id="003">商品评价</div>
		<div class="apprariseBox">
			<div class="apprariseNav">
				<div class="userMessage">
					<div class="userImg">
						<img src="images/userImg1.png" />
					</div>
					<div class="userName">
						<p class="user-name">外屏总是碎</p>
						<!--<img src="images/star.png" class="star" />-->
					</div>
					<div class="apprariseDate">2017-02-22</div>
				</div>
				<div class="evaluationContent">不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃</div>
			</div>
			<div class="apprariseNav">
				<div class="userMessage">
					<div class="userImg">
						<img src="images/userImg1.png" />
					</div>
					<div class="userName">
						<p class="user-name">外屏总是碎</p>
						<!--<img src="images/star.png" class="star" />-->
					</div>
					<div class="apprariseDate">2017-02-22</div>
				</div>
				<div class="evaluationContent">不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃</div>
			</div>
			<div class="apprariseNav">
				<div class="userMessage">
					<div class="userImg">
						<img src="images/userImg1.png" />
					</div>
					<div class="userName">
						<p class="user-name">外屏总是碎</p>
						<!--<img src="images/star.png" class="star" />-->
					</div>
					<div class="apprariseDate">2017-02-22</div>
				</div>
				<div class="evaluationContent">不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃不错！很好吃，一直在她家买，下次多买点全 家都非常喜欢吃</div>
			</div>

		</div>
		<!--购物车-->
		<!--<div class="shopping-cart" id="shopping-cart" onclick="location.href='shopCart.php'">
			<img src="images/shopping-cart.png" />
			<span></span>
		</div>-->
	</body>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/shopDetails.js"></script>
	<!--<script type="text/javascript" src="js/common.js"></script>
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
						$('.saleNum').html(sales);//销量
						//---------------循环图片（轮播图）-----
						$.each(img_url, function(k, v) {
							var src = img_url[k].image;
							var imgId = img_url[k].img_id;
							var t = "<div class='swiper-slide'><image src=" + src + "/></div>";
							$('.swiper-wrapper').append(t)
						});

					}
					//swiper插件实现轮播图
					var mySwiper = new Swiper('.swiper-container', {
						paginationType: 'fraction', //分页器
						loop: true,
						pagination: '.swiper-pagination',
					});

				}
			});
			//------------创建购物车------------
			$(".addCar").click(function(event) {
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
							layer.msg("<span style='color: red;font-size: 30px;'>√</span><br/>添加成功，在购物车等亲~~")
							shopCarts();
						}
					});
				})
				//获取购物车中的商品数量
			function shopCarts() {
				$.ajax({
					type: "post",
					url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos,
					data: {
						"ss": getCookie('openid')
					},
					success: function(data) {
						if(data.code == 1) { //请求成功
							console.log(data);
							var numberShop = 0;
							for(var i = 0; i < data.result.info.length; i++) {
								numberShop += parseInt(data.result.info[i].number);
							}
							$('.shop_car span').html(numberShop);

						} else {
							layer.msg(data.msg);
						}
					}
				});
			};
		});
	</script>-->
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
	<script type="text/javascript">
		$(function() {
			$('.selectAttributes').click(function() {
				$('.selectPopup').fadeIn();
			});
			$('.close,.hideBox').click(function() {
				$('.selectPopup').fadeOut();
			});

		})
	</script>
	<script type="text/javascript">
		$('.type_one').click(function() {
			if($(this).hasClass('typeHide')) {
				$(this).removeClass('typeHide');
			} else {
				$(this).addClass('typeHide').siblings().removeClass('typeHide');
			}
		})
		$(".add").click(function() {
			var num = $(this).parent().find('input[class*=shopNum]'); //获取input框的值
			//单品数量增加
			num.val(parseInt(num.val()) + 1);
		});
		$(".jian").click(function() {
			var m = $(this).parent().find('input[class*=shopNum]'); //获取input框的值
			//对input框的值进行判断
			if(m.val() == "" || undefined || null) {
				m.val(1);
			}
			m.val(parseInt(m.val()) - 1) //给input框赋值
				//对input框的值进行判断
			if(parseInt(m.val()) <= 1) {
				m.val(1);
				layer.msg('亲，这个数量不能再少了');
			}
			var val = parseInt($(m).val());
			console.log(val + '数量------');

		})
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(window).scroll(function() {
				var top = $(".swiper-container").offset().top; //获取指定位置
				var scrollTop = $(window).scrollTop(); //获取当前滑动位置
				//               if(scrollTop > top){                 //滑动到该位置时执行代码
				//                 $(".shopTitle").fadeIn();
				//               }else{
				//                 $(".shopTitle").hide();
				//               }
			});
		});
	</script>

</html>