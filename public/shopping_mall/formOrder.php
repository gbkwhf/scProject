<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>确认订单</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/swiper.min.css" />
		<link rel="stylesheet" href="css/formOrder.css">
	</head>

	<body>

		<div class="wrapper">
			<header>
				<div class="user-name">收货人：
					<p></p>
				</div>
				<div class="user-phone">
					<p></p>
				</div>
				<p class="address"><img src="images/address.png" class="addressImg" /><span></span><img src="images/addback.png" class="backImg" /></p>
				<div class="prompt">（收货不便时，可选择免费待收货服务）</div>
				<img src="images/caitiao.png" width="100%" class="illustration" />
			</header>
			<div class="js-details">

				<!--<div class="commodityBox">-->

				<!--<div class="shopNames">
						<div class="shopIcon"><img src="images/shop_image.png" /></div>
						<div class="shop_name"></div>
					</div>
					<div class="shop_message">
						<div class="product_img"><img src="images/productImg.png"/></div>
					<div class="messageBox">
						<p class="shopName">多肉植物组合套餐多肉童子肉肉 花卉盆栽多肉植物组合套餐多肉童子肉肉 花卉盆栽多肉植物组合套餐多肉童子肉肉 花卉盆栽</p>
						<p class="shop_attr">小盆多肉   带盆</p>
						<p class="moneyBox">
							<span class="price">￥10.00元</span>
							<span class="shop_num">+1</span>
						</p>
						
					</div>-->
				<!--<div class="kong"></div>
				<div class="note">
					<p>备注：</p><input type="text" placeholder="给商家留言（选填）" />
				</div>
				<div class="amountBox">
					<div class="amount">商品金额</div>
					<div class="moneys">￥10.00</div>
				</div>
				<div class="amountBox">
					<div class="amount">运费</div>
					<div class=
						"moneys">￥10.00</div>
				</div>-->

				<!--</div>-->

			</div>
			<div class="accoreBox">
				<!--<div class="amountBox">
				 <div class="amount">兑换积分</div>
				 <div class="moneys"></div>
			  </div>-->
			</div>
			<div class="select">
				<p>选择门店：
					<select name="sel">
						<option value="请选择所在门店">请选择所在门店</option>
						<!--<option >兴庆店</option>-->
					</select>
				</p>
			</div>
			<div class="enameBox">
				<p>员工姓名：</p><input type="text" placeholder="请输入员工姓名" class="unames"/>
			</div>
			<div class="note">
				<p>备注：</p><input type="text" placeholder="给商家留言（选填）" />
			</div>
		</div>

		<footer>
			<p class="actual-payment">实付款：<span>¥0.00</span></p>
			<div class="buy-operation">
				<p onclick="scancode()" class="scanCode">进店扫码<span>到门店付款</span></p>
				<p onclick="createOrder()" class="substitute" style="display: none;"><span style="padding: 10px 0px 11px ;">替用户创建订单</span></p>
				<i></i>
				<em onclick="submit()">提交</em>
			</div>
		</footer>
		</div>
		<!--扫码付款-->
		<div id="codemask">
			<div class="qccode"></div>
		</div>
		<!--线下收款-->
		<div class="xxsk">
			<h4>线下收款</h4>
			<p style="line-height: 21px;">员工输入会员手机号直接完成付款（<span style="color:#ff0000">请收到用户款后点击确认，确认通过即完成订单，不可取消！</span>）</p>
			<input type="text" placeholder="请输入会员手机号" maxlength="11" onkeyup="value=value.replace(/[^0-9.]/g,'') " />
			<div class="btn-box-pop">
				<a href="javascript:void(0);" class="cancel" onclick="cancelPop()">取消</a>
				<a href="javascript:void(0);" class="confirm">确认</a>
			</div>
		</div>
	</body>
	<script src="js/jquery.min.js"></script>
	<script src="js/layer/layer.js"></script>
	<script src="js/swiper.min.js"></script>
	<script src="js/jquery.qrcode.min.js"></script>
	<script src="js/common.js"></script>
	<script src="js/config.js"></script>
	<script>
		var winW = $(window).width();
		$('.note input').width(winW - (winW * 0.04) * 2 - 36);

		//获取收货地址
		if($_GET['address_id']) {
			//获取指定地址
			$.ajax({
				type: "post",
				url: commonsUrl + "api/gxsc/get/delivery/goods/address" + versioninfos,
				data: {
					'ss': getCookie('openid'),
					'address_id': $_GET['address_id']
				},
				success: function(data) {
					if(data.code == 1) {
						console.log(data);
						$('.address span').html(data.result[0].address);
						$('.user-name p').html(data.result[0].name);
						$('.user-phone p').html(data.result[0].mobile);
						$('header').attr('onclick', "lastpage(" + $_GET['address_id'] + ")");

					} else {
						layer.msg(data.msg);
					}
				}
			});
		} else {
			//获取所有地址
			$.ajax({
				type: "post",
				url: commonsUrl + "api/gxsc/get/delivery/goods/address" + versioninfos,
				data: {
					'ss': getCookie('openid')
				},
				success: function(data) {
					if(data.code == 1) {
						console.log(data);
						if(data.result.length == 0) {
							//去新增收货地址
							$('header').html('<span onclick="location.href=\'address.php\'" style="background:url(images/add-icon.png) no-repeat;background-size:22px 22px;background-position:15px 28px;padding-left: 41px;line-height: 78px;color: #333;overflow: hidden;display: block;">添加收货地址<img src="images/right-arrow.png" width="7" style="display: block;float: right;margin: 32px 10px 0px 0px;"></span>');
						} else {
							//筛选默认地址
							for(var i = 0; i < data.result.length; i++) {
								if(data.result[i].is_default == 1) {
									$('.address span').html(data.result[i].address);
									$('.user-name p').html(data.result[i].name);
									$('.user-phone p').html(data.result[i].mobile);
									$('header').attr('onclick', "lastpage(" + data.result[i].address_id + ")");
								}
							}
						}
					} else {
						layer.msg(data.msg);
					}
				}
			});
		}

		function lastpage(addressId) {
			location.href = 'address.php?address_id=' + addressId + '&id=3';
		}

		//身份校验

		if(getCookie('is_member') == 0) { //会员
			$('.scanCode').hide();
			$('.substitute').hide();
			$('.buy-operation i').hide();
			$('.buy-operation em').css('width', '100%');
		} else if(getCookie('is_member') == 1) { //员工
			$('.scanCode').hide();
			$('.substitute').show();
		}
		var shoppingDetails = JSON.parse(localStorage.getItem('moneyArr'));
		console.log(shoppingDetails);
		var score = $_GET['score'];
		console.log(score);

		var reallPrice = 0;
		for(var i = 0; i < shoppingDetails.length; i++) {
			//				console.log(shoppingDetails[i].sumprice);
			//				console.log(shoppingDetails[i].mianYou);
			if(shoppingDetails[i].mianYou == '包邮') {
				shoppingDetails[i].mianYou = 0;
			}
			var prCon = parseFloat(shoppingDetails[i].sumprice) + parseFloat(shoppingDetails[i].mianYou);
			reallPrice += prCon;
		}
		console.log(reallPrice + 'hhhhhhhhhhhhhh');
		$(".actual-payment span").html('￥' + reallPrice.toFixed(2));
		var shoppingList = '',
			totals = 0,
			numbers = 0;
		var html = ''
		$.each(shoppingDetails, function(c, t) {
			html += '<div class="commodityBox"><div class="shopNames">' +
				'<div class="shopIcon"><img src="images/shop_image.png" /></div>' +
				'<div class="shop_name">' + t.supcontent + '</div>' +
				'</div>'
			var shopList = t.arrCon;
			$.each(shopList, function(k, v) {
				var ext_id = shopList[k].ext_id;
				var id = shopList[k].id;
				var name = shopList[k].name;
				var numbers = shopList[k].number;
				var price = shopList[k].price;
				var shopId = shopList[k].shopId;
				var spec_name = shopList[k].spec_name;
				var img = shopList[k].src;
				var use_score = shopList[k].use_score; //商品单积分
				var goods_gift = shopList[k].goods_gift;
				console.log("商品类别" + goods_gift);
				if(goods_gift == 2) {
					price = price + "元"
				} else {
					price = '￥' + price
				}
				var show = isForm(shopList[k].goods_gift);
				console.log(show)
				var ht = '';
				ht += ' <div class="amountBox" style="display:' + show + '">' +
					'<div class="amount">兑换积分</div>' +
					' <div class="money1">' + score + '</div>' +
					'</div>';
				$('.accoreBox').html(ht);
				html += '<div class="product_img">' +
					'<img src="' + img + '"/>' +
					'</div>' +
					'<div class="messageBox">' +
					'<p class="shopName">' + name + '</p>' +
					'<p class="shop_attr">' + spec_name + '</p>' +
					'<p class="moneyBox">' +
					'<span class="price1" style="display:' + show + '"> ' + use_score + '积分+</span>' +
					'<span class="price">' + price + '</span><span class="shop_num">+' + numbers + '</span>' +
					'</p>' +
					'</div>';
			});
			html += '<div class="amountBox">' +
				'<div class="amount">商品金额（小计）</div>' +
				'<div class="moneys">' + '¥' + t.sumprice + '</div>' +
				'</div>' +
				'<div class="amountBox">' +
				'<div class="amount">运费</div>' +
				'<div class="moneys">¥' + t.mianYou + '</div>' +
				'</div></div><div class="kong"></div>';
			$('.js-details').html(html);

		});

		function isForm(goods_gift) {
			if(goods_gift == 1) {
				return 'none';
			} else {
				return 'block'
			}
		};
		//'<p>备注：</p><input type="text" placeholder="给商家留言（选填）" />' 
		//		for(var i = 0; i < shoppingDetails.length; i++) {
		//			shoppingList += '<div class="product_img">' +
		//				'<img src="' + shoppingDetails[i].src + '"/>' +
		//				'</div>' +
		//				'<div class="messageBox">' +
		//				'<p class="shopName">' + shoppingDetails[i].name + '</p>' +
		//				'<p class="shop_attr">' + shoppingDetails[i].spec_name + '</p>' +
		//				'<p class="moneyBox"><span class="price">¥' + shoppingDetails[i].price + '</span>' +
		//				'<span class="shop_num">+' + shoppingDetails[i].number + '</span>' +
		//				'</p>' +
		//				'</div>'
		//			for(var j = 0; j < parseInt(shoppingDetails[i].number); j++) {
		//				numbers++;
		//				totals += parseFloat(shoppingDetails[i].price);
		//			}
		//
		//		}
		//		$('.shop_message').html(shoppingList);
		//		$('.actual-payment span').html('¥' + totals.toFixed(2));
		//员工微信扫码确认付款（用户线下支付） 
		function scancode() {
			var address = $('.address span').html();
			var mobile = $('.user-phone p').html();
			var name = $('.user-name p').html();
			$.ajax({
				type: 'post',
				url: commonsUrl + '/api/gxsc/v2/user/create/order' + versioninfos,
				data: {
					'address': address,
					'flag': 2,
					'mobile': mobile,
					'name': name,
					'ss': getCookie('openid')
				},
				success: function(data) {
					if(data.code == 1) {
						console.log(data);
						var tzurl = encodeURIComponent(commonsUrl + "shopping_mall/staff_order_details.php?base_order_id=" + data.result.order_id);
						//		生成二维码
						$('.qccode').qrcode({
							width: 130, //宽度
							height: 130, //高度 
							text: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx97bfadf3a81d8206&redirect_uri=" + tzurl + "&response_type=code&scope=snsapi_base&state=123#wechat_redirect" //任意内容
						});

						layer.open({
							type: 1,
							title: false,
							closeBtn: false,
							shadeClose: false,
							content: $('#codemask')
						})
					} else {
						layer.msg(data.msg);
					}
				}
			})

		}

		//替用户创建订单
		function createOrder() {
			indexpop = layer.open({
				type: 1,
				closeBtn: false,
				shadeClose: false,
				title: false,
				content: $('.xxsk')
			})
		}

		//员工替会员购买
		$('.confirm').click(function() {

			if($('header').find('.address').length > 0) {
				var address = $('.address span').html();
				var mobile = $('.user-phone p').html();
				var name = $('.user-name p').html();
				var phone = $('.xxsk input').val();
				var user_remark = $('.note input').val();
				if(testTel(phone)) {
					$.ajax({
						type: 'post',
						url: commonsUrl + '/api/gxsc/v2/employee/give/user/create/order' + versioninfos,
						data: {
							'address': address,
							'flag': 2,
							'mobile': mobile,
							'name': name,
							'ss': getCookie('openid'),
							'phone': phone,
							'user_remark': user_remark
						},
						success: function(data) {
							if(data.code == 1) {
								console.log(data);
								layer.msg('提交成功');
								setTimeout(function() {
									location.href = 'myOrderList.php?orderId=0'
								}, 1000);
							} else {
								layer.msg(data.msg);
								setTimeout(function() {
									layer.closeAll();
								}, 1000);
							}
						}
					})
				} else {
					layer.msg('请填写正确的手机号')
				}

			} else {
				layer.close(indexpop);
				layer.msg('请添加收货地址');
			}

		})
		
		function type_meal() {
			$.ajax({
				type: "post",
				dataType: 'json',
				url: commonsUrl + "api/gxsc/get/supplier/get_supplier" + versioninfos,
				success: function(data) {
					console.log(data)
					if(data.code == 1) { //请求成功
						var con = data.result;
						if(con.length != 0) {
							console.log(con);
							var type_obj = {
								id: '0',
								name: '其他'
							}
							con.unshift(type_obj); //向数组开头追加一个对象
							var html = '';
							$.each(con, function(k, v) {
								var type_id = con[k].id; //套餐id
								console.log(type_id);
								var type_name = con[k].name; //套餐名称
								html += "<option value=" + type_id + ">" + type_name + "</option>"
							});
							$('select').append(html); //动态显示下拉列表数据
						} else {

						}
					}

				}
			});
		}
		type_meal();
		//	提交订单
		function submit() {
			var address = $('.address span').html();
			var mobile = $('.user-phone p').html();
			var name = $('.user-name p').html();
			var user_remark = $('.note input').val();
			var type_sel = $("select").val();
			var uname=$(".enameBox input").val();
			if($('header').find('.address').length == 0){
				layer.msg('请添加收货地址');
			}else if(type_sel=="请选择所在门店"){
				layer.msg("请选择所在门店");
			}else if(type_sel!=0 && uname ==""){
				layer.msg("请输入员工姓名");
			}else{
				//创建订单
				$.ajax({
					type: 'post',
					url: commonsUrl + 'api/gxsc/v2/user/create/order' + versioninfos,
					data: {
						'address': address,
						'flag': 2,
						'mobile': mobile,
						'name': name,
						'ss': getCookie('openid'),
						'user_remark': user_remark,
						'employee_name':uname,
						'supplier_id':type_sel
					},
					success: function(data) {
						if(data.code == 1) {
							console.log(data);
							//支付订单
							$.ajax({
								type: "post",
								url: commonsUrl + "api/gxsc/pay/goods" + versioninfos,
								data: {
									'base_order_id': data.result.order_id,
									'filling_type': 3,
									'open_id': getCookie('openid'),
									'ss': getCookie('openid')
								},
								success: function(data) {
									if(data.code == 1) {
//										var newDeArr = JSON.parse(localStorage.getItem('moneyArr'));
//										console.log(newDeArr);
//										tnewarr = [];
//										$.each(newDeArr, function(k, v) {
//											$.each(v.arrCon, function(key, value) {
//												tnewarr.push(value.first_id)
//											})
//										})
//										console.log(tnewarr);
										console.log(data);
										data.result.timeStamp = data.result.timeStamp.toString();
										retStr = data.result;
										callpay();
										//调用微信JS api 支付
										function jsApiCall() {
											WeixinJSBridge.invoke(
												'getBrandWCPayRequest',
												retStr,
												function(res) {
													if(res.err_msg == "get_brand_wcpay_request:ok") {
														//支付成功
														location.href = 'myOrderList.php?orderId=0';
//														if(tnewarr.indexOf("109") > -1 || tnewarr.indexOf("111") > -1) { //0 代表有
//															location.href = "customService.php"
//														} else { //-1 没有找到109或者111
//															location.href = 'myOrderList.php?orderId=0'
//														}
														
													} else {
														//												             alert(res.err_msg);
													}
												}
											);
										}

										function callpay() {
											if(typeof WeixinJSBridge == "undefined") {
												if(document.addEventListener) {
													document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
												} else if(document.attachEvent) {
													document.attachEvent('WeixinJSBridgeReady', jsApiCall);
													document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
												}
											} else {
												jsApiCall();
											}
										}
									} else {
										layer.msg(data.msg);
									}
								}
							});
						} else {
							layer.msg(data.msg);
						}
					}
				})
			} 

		}
	</script>
	<style type="text/css">
		.layui-layer.layui-anim.layui-layer-page {
			border-radius: 5px;
		}
	</style>

</html>