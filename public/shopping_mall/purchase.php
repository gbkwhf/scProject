<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>结算</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"><meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css"/>
    <link rel="stylesheet" href="css/purchase.css">
</head>

<body>

	<div class="wrapper">
		<header>
			<img src="images/edit.png" width="14px" class="edit-icon" />
			<p class="address">收货地址：<span></span></p>
			<div class="user-name" ><img src="images/user-icon.png" width="13px"/><p></p></div>
			<div class="user-phone" ><img src="images/telephone.png" width="15px"/><p></p></div>
			<img src="images/car.png" width="103px" class="illustration" />								
		</header>
		<div class="js-details">
			<div class="tit-box">
				<img src="images/left-line.png" width="55"/>
				<p>结算详情</p>
				<img src="images/right-line.png" width="55"/>
			</div>
			<div class="commodity-align">
				<div class="swiper-container">
			        <div class="swiper-wrapper">
			            <!--<div class="swiper-slide">
			            	<img src="images/zyyp.png" width="100%"/>
			            	<p>¥388.00</p>
			            	<span>*7</span>
			            </div>-->
			        </div>
			    </div>
			    <div class="commodity-exp">
			    	<p></p>
			    	<img src="images/right-arrow.png" width="8"/>
			    </div>
			</div>	
		</div>
		<div class="note">
			<p>备注：</p><input type="text" placeholder="给商家留言（选填）" />
		</div>
		<div class="explain-buy">
			<h4>利润共享返利条件</h4>
			<ul class="xz-list">
				<li>1、会员必须在平台消费1280元/单（含1280）以上，且订单完成（无退货）。</li>
				<li>利润共享标准：每日平台总利润50%÷会员每日订单基数；</li>
				<li>利润共享天数：180天，由系统每天自动返还。</li>
				<li>2、如果一单不能满足利润共享基数，可以凑单并合并结算，总金额达到基数要求，方可享受利润共享。</li>
			</ul>
		</div>
		<footer>
			<p class="actual-payment">实付款：<span>¥3688.00</span></p>
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
		<input type="text" placeholder="请输入会员手机号" maxlength="11" onkeyup="value=value.replace(/[^0-9.]/g,'') "  />
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
	$('.note input').width(winW-(winW*0.04)*2-36);
	
	//获取收货地址
	if($_GET['address_id']){
		//获取指定地址
		$.ajax({
			type:"post",
			url:commonsUrl + "api/gxsc/get/delivery/goods/address" + versioninfos,
			data:{'ss':getCookie('openid'),'address_id':$_GET['address_id']},
			success:function(data){
				if(data.code==1){
					console.log(data);
					$('.address span').html(data.result[0].address);
					$('.user-name p').html(data.result[0].name);
					$('.user-phone p').html(data.result[0].mobile);
					$('header').attr('onclick',"lastpage("+$_GET['address_id']+")");
					
				}else{
	                layer.msg(data.msg);
	            }
			}
		});
	}else{
		//获取所有地址
		$.ajax({
			type:"post",
			url:commonsUrl + "api/gxsc/get/delivery/goods/address" + versioninfos,
			data:{'ss':getCookie('openid')},
			success:function(data){
				if(data.code==1){
					console.log(data);
					if(data.result.length==0){
						//去新增收货地址
						$('header').html('<span onclick="location.href=\'receiving_address.php\'" style="background:url(images/add-icon.png) no-repeat;background-size:22px 22px;background-position:15px 28px;padding-left: 41px;line-height: 78px;color: #333;overflow: hidden;display: block;">添加收货地址<img src="images/right-arrow.png" width="7" style="display: block;float: right;margin: 32px 10px 0px 0px;"></span>');
					}else{
						//筛选默认地址
						for(var i=0;i<data.result.length;i++){
							if(data.result[i].is_default==1){
								$('.address span').html(data.result[i].address);
								$('.user-name p').html(data.result[i].name);
								$('.user-phone p').html(data.result[i].mobile);
								$('header').attr('onclick',"lastpage("+data.result[i].address_id+")");
							}
						}
					}
				}else{
	                layer.msg(data.msg);
	            }
			}
		});
	}
	
	function lastpage(addressId){
		location.href='receiving_address.php?address_id='+addressId;
	}
	
	//身份校验
	
	if(getCookie('is_member')==0){ //会员
		$('.scanCode').hide();
		$('.substitute').hide();
		$('.buy-operation i').hide();
		$('.buy-operation em').css('width','100%');
	}else if(getCookie('is_member')==1){ //员工
		$('.scanCode').hide();
		$('.substitute').show();
	}
	
	var shoppingDetails=JSON.parse(localStorage.getItem('moneyArr'));
	console.log(shoppingDetails);
	var shoppingList = '',
		totals = 0,
		numbers = 0;
	for(var i=0;i<shoppingDetails.length;i++){
		shoppingList+='<div class="swiper-slide">'+
        '	<img src="'+shoppingDetails[i].src+'" width="100%"/>'+
        '	<p>¥'+shoppingDetails[i].price+'</p>'+
        '	<span>x '+shoppingDetails[i].number+'</span>'+
        '</div>';
        
        for(var j=0;j<parseInt(shoppingDetails[i].number);j++){
        	numbers++;
        	totals += parseFloat(shoppingDetails[i].price);
        }
        
	}
	$('.swiper-wrapper').html(shoppingList);
	$('.swiper-slide img').height(winW*0.73/3-20);
	$('.commodity-exp p').html('共'+numbers+'件');
	$('.actual-payment span').html('¥'+totals.toFixed(2));
	
	/*Initialize Swiper*/
	var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        paginationClickable: true,
        spaceBetween: 30,
        freeMode: true
    });
	
	//员工微信扫码确认付款（用户线下支付）
	function scancode(){
		var address = $('.address span').html();
		var	mobile = $('.user-phone p').html();
		var	name = $('.user-name p').html();
		$.ajax({
			type:'post',
			url:commonsUrl + 'api/gxsc/user/create/commodity/order' + versioninfos,
			data:{
				'address':address,
				'flag':2,
				'mobile':mobile,
				'name':name,
				'ss':getCookie('openid')
			},
			success:function(data){
				if(data.code==1){
					console.log(data);
					var tzurl = encodeURIComponent(commonsUrl+"shopping_mall/staff_order_details.php?base_order_id="+data.result.order_id);
					//		生成二维码
			        $('.qccode').qrcode({
			            width: 130, //宽度
			            height:130, //高度 
			            text:"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx97bfadf3a81d8206&redirect_uri="+tzurl+"&response_type=code&scope=snsapi_base&state=123#wechat_redirect"  //任意内容
			        });
			        
			        layer.open({
			        	type: 1,
			        	title:false,
			        	closeBtn:false,
			        	shadeClose: false,
			        	content: $('#codemask')
			        })
				}else{
					layer.msg(data.msg);
				}
			}
		})
  
	}
	
	//替用户创建订单
	function createOrder(){
		indexpop = layer.open({
			type:1,
			closeBtn:false,
			shadeClose:false,
			title:false,
			content:$('.xxsk')
		})
	}
	
	//员工替会员购买
	$('.confirm').click(function(){
		
		if($('header').find('.address').length>0){
			var address = $('.address span').html();
			var	mobile = $('.user-phone p').html();
			var	name = $('.user-name p').html();
			var	phone = $('.xxsk input').val();
			var user_remark = $('.note input').val();
			if(testTel(phone)){
				$.ajax({
					type:'post',
					url:commonsUrl + 'api/gxsc/employee/give/user/create/commodity/order' + versioninfos,
					data:{
						'address':address,
						'flag':2,
						'mobile':mobile,
						'name':name,
						'ss':getCookie('openid'),
						'phone':phone,
						'user_remark':user_remark
					},
					success:function(data){
						if(data.code==1){
							console.log(data);
							layer.msg('提交成功');
							setTimeout(function(){location.href='index.php'},1000);						
						}else{
							layer.msg(data.msg);
							setTimeout(function(){layer.closeAll();},1000);
						}
					}
				})
			}else{
				layer.msg('请填写正确的手机号')
			}
			
		}else{
			layer.close(indexpop);
			layer.msg('请添加收货地址');
		}
		
		
		
	})
	
	
//	提交订单
	function submit(){
		var address = $('.address span').html();
		var	mobile = $('.user-phone p').html();
		var	name = $('.user-name p').html();
		var user_remark = $('.note input').val();
		if($('header').find('.address').length>0){
			//创建订单
			$.ajax({
				type:'post',
				url:commonsUrl + 'api/gxsc/user/create/commodity/order' + versioninfos,
				data:{
					'address':address,
					'flag':2,
					'mobile':mobile,
					'name':name,
					'ss':getCookie('openid'),
					'user_remark':user_remark
				},
				success:function(data){
					if(data.code==1){
						console.log(data);
						//支付订单
						$.ajax({
							type:"post",
							url:commonsUrl+"api/gxsc/pay/goods"+versioninfos,
							data:{
								'base_order_id':data.result.order_id,
								'filling_type':3,
								'open_id':getCookie('openid'),
								'ss':getCookie('openid')
							},
							success:function(data){
								if(data.code==1){
									console.log(data);
									data.result.timeStamp = data.result.timeStamp.toString();
									retStr =data.result;
									callpay();
	                                //调用微信JS api 支付
	                                function jsApiCall(){
	                                    WeixinJSBridge.invoke(
	                                        'getBrandWCPayRequest',
	                                        retStr,
	                                        function(res){
	                                            if(res.err_msg == "get_brand_wcpay_request:ok" ) {
	                                                //支付成功
	                                                location.href='my_orders.php';
	                                            }else{
	//												             alert(res.err_msg);
	                                            }
	                                        }
	                                    );
	                                }
	                                function callpay(){
	                                    if (typeof WeixinJSBridge == "undefined"){
	                                        if( document.addEventListener ){
	                                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
	                                        }else if (document.attachEvent){
	                                            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
	                                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
	                                        }
	                                    }else{
	                                        jsApiCall();
	                                    }
	                                }
								}else{
									layer.msg(data.msg);
								}
							}
						});						
					}else{
						layer.msg(data.msg);
					}
				}
			})
		}else{
			layer.msg('请添加收货地址');
		}
		
	}
	
</script>
<style type="text/css">
	.layui-layer.layui-anim.layui-layer-page{
		border-radius: 5px;
	}
	
</style>
</html>