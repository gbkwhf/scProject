<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>个人中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/personal_center.css">
    <link rel="stylesheet" type="text/css" href="css/commfooter.css"/>

</head>
<script>
    //解决IOS微信webview后退不执行JS的问题
    window.onpageshow = function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
</script>
<body>

<div class="wrapper">
    <header>
        <div class="user-info" onclick="location.href='personal_data.php'">
            <div class="head-portrait">
                <img src="images/head-portrait.png" width="55"/>
            </div>
            <p><span class="user_names"></span><img class="member" src="images/huiyuan.png" width="13"/></p>
            <div class="rank"><span class="userRank"></span><img src="images/personBack.png" width="6"/></div>
        </div>

        <div class="account-info">
            <a class="balance">
                <em></em>
                <p>0</p>
                <span>余额（积分）</span>
            </a>
            <div class="cashback">
                <em>¥</em>
                <p>0</p>
                <span>截至上月累计消费（元）</span>
            </div>
        </div>
    </header>
    <div class="user-Box">
        <div class="obligation" orderId='0' onclick="location.href='myOrderList.php?orderId=1'">
            <div></div>
            <dl>
                <dt><img src="images/obligation.png"/></dt>
                <dd>待付款</dd>
            </dl>
        </div>
        <div class="receipt" orderId='1' onclick="location.href='myOrderList.php?orderId=2'">
            <div></div>
            <dl>
                <dt><img src="images/receipt.png"/></dt>
                <dd>待收货</dd>
            </dl>
        </div>
        <div class="evaluated" orderId='2' onclick="location.href='myOrderList.php?orderId=3'">
            <div></div>
            <dl>
                <dt><img src="images/evaluated.png"/></dt>
                <dd>待评价</dd>
            </dl>
        </div>
        <!--<div class="return" orderId='3' onclick="location.href='myOrderList.php?orderId=3'">
            <dl>
                <dt><img src="images/return.jpg"/></dt>
                <dd>退/换货</dd>
            </dl>
        </div>-->
    </div>
    <div class="kong"></div>
    <ul class="menu-list">
        <li onclick="location.href='myOrderList.php?orderId=0'">
            我的订单
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li onclick="location.href='riches.php'">
            我的财富
            <img src="images/right-arrow.png" width="8"/>
        </li>
         <!--<li onclick="location.href='regulation.php'">
            平台规则
            <img src="images/right-arrow.png" width="8"/>
        </li>-->
        <li class="myinviat" onclick="location.href = 'invitation.php'">
            我的邀请
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li class="substitute" onclick="location.href='destoon_finance_cash.php?identity=1'">
            替用户提现
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li onclick="location.href='withdrawals_record.php?identity=0'">
            提现记录
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li onclick="location.href='afterSale.php'">
            售后交流
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li class="substitute" onclick="location.href='sale_record.php'">
            销售记录
            <img src="images/right-arrow.png" width="8"/>
        </li>
        <li onclick="location.href='setTing.php '">
            设置
            <img src="images/right-arrow.png" width="8"/>
        </li>
    </ul>
</div>
<!---------底部----->
<!--<div id="commId"></div>-->
<!---------底部----->
<div class="shopBottom">
    <div class="memberIndex" onclick="location.href='memberPages.php'">
        <dl>
            <dt><img src="images/in1.jpg"/></dt>
            <dd style="color: #333333;">首页</dd>
        </dl>
    </div>
    <div class="shopCar" onclick="location.href='newShop_cart.php'">
        <dl>
            <dt>
                <img src="images/che1.jpg"/>
                <span>0</span>
            </dt>
            <dd style="color: #333333;">购物车</dd>
        </dl>
    </div>
    <div class="personal">
        <dl>
            <dt><img src="images/my2.jpg"/></dt>
            <dd style="color: #e63636;">我的</dd>
        </dl>
    </div>
</div>
<!--购物车-->
<!--<div class="shopping-cart" onclick="location.href='shopCart.php'">
    <img src="images/shopping-cart.png"/>
    <span></span>
</div>-->
</body>
<script src="js/jquery.min.js"></script>
<script src="js/layer/layer.js"></script>
<script src="js/common.js"></script>
<script src="js/config.js"></script>
<script>
   
    if (getCookie('is_member') == 1) {
        $('.substitute').show();
    }

    //获取微信个人信息
    //		$.ajax({
    //			type:'post',
    //			url:commonsUrl+ 'api/gxsc/get/user/weixin/info' +versioninfos,
    //			data:{'ss':getCookie('openid')},
    //			success:function(data){
    //				if(data.code==1){
    //					console.log(data);
    //					$('.head-portrait img').attr('src',data.result.headimgurl);
    //					$('.user-info p').html(data.result.nickname);
    //				}else{
    //					layer.msg(data.msg);
    //				}
    //			}
    //		})


    //获取购物车中的商品数量
    var tarr = [];
    var numberShop = 0;
    //获取购物车的数量
    $.ajax({
        type: "post",
        url: commonsUrl + '/api/gxsc/v2/get/goods/car/info' + versioninfos,
        data: {
            "ss": getCookie('openid')
        },
        success: function (data) {
            if (data.code == 1) { //请求成功
                console.log(data);
                var arr = data.result.info;
                $.each(arr, function (k, v) {
                    $.each(v.others, function (key, value) {
                        //console.log(value.number);
                        numberShop += parseInt(value.number)
                    })
                })
                console.log(numberShop + 'iiiiiii')
                $('.shopCar span').html(numberShop);

            } else {
                layer.msg(data.msg);
            }
        }
    });

    //获取用户基本信息
    $.ajax({
        type: "post",
        url: commonsUrl + "api/gxsc/user/profile" + versioninfos,
        data: {'ss': getCookie('openid')},
        success: function (data) {
            if (data.code == 1) {
                console.log(data);
                if (data.result.thumbnail_image_url != "") {
                    $('.head-portrait img').attr('src', data.result.thumbnail_image_url);
                }
                $('.user-info .user_names').html(data.result.name);
                $('.balance p').html(data.result.balance);
               
                $('.cashback p').html(data.result.total_amount);
                $('.userRank').html('会员等级：' + data.result.user_lv);
                $('.balance').attr('href', 'remaining.php?balance=' + data.result.balance);
//              if (data.result.user_lv == 0) {
//                  $(".myinviat").hide()
//                  $(".member").hide()
//              }
            } else if (data.code == 1011) {
                layer.msg('身份已失效，请重新绑定');
                setTimeout(function () {
                    location.href = 'register.php';
                }, 1000);
            } else {
                layer.msg(data.msg)
            }
        }
    });

//  function invitation() {
//      $.ajax({
//          type: 'post',
//          url: commonsUrl + 'api/gxsc/user/profile' + versioninfos,
//          data: {'ss': getCookie('openid')},
//          success: function (data) {
//              invite_role = data.result.invite_role
//              var user_id = data.result.user_id;//用户id
//              console.log(data);
//              if (invite_role == 0) {
//                  if (data.result.deposit == "0.00") {
//                      location.href = 'myinvite.php'
//                  } else {
//                      location.href = 'deposit.php?degId=1'
//                  }
//              } else {
//                  location.href = 'invitation.php'
//              }
//          }
//      })
//  }
	var payment = "api/gxsc/v2/get/order/info/obligation/list"
    var shipping = "api/gxsc/v2/get/order/info/list"
    var evaluate = "api/gxsc/v2/get/order/info/comment/list"
    encapsulation(payment)
    encapsulation(shipping)
    encapsulation(evaluate)
    function encapsulation(params) {
        $.ajax({
            type: "post",
            url: commonsUrl + params + versioninfos,
            data: {
                ss: getCookie('openid')
            },
            success: (res) => {
                console.log(res)
                try {
                    if (res.code == "1") {
                        switch (params) {
                            case payment:
                                if (res.result.length != 0) {
                                    $(".obligation>div").text(res.result.length)
                                } else {
                                    $(".obligation>div").hide()
                                }
                                break;
                            case shipping:
                                if (res.result.length != 0) {
                                    $(".receipt>div").text(res.result.length)
                                } else {
                                    $(".receipt>div").hide()
                                }
                                break;
                            case evaluate:
                                if (res.result.length != 0) {
                                    $(".evaluated>div").text(res.result.length)
                                } else {
                                    $(".evaluated>div").hide()
                                }
                                break;
                        }
                    }
                } catch (e) {
                    console.log(e)
                }
            }
        })
    }
</script>
<style type="text/css">
    .layui-layer.layui-anim.layui-layer-page {
        border-radius: 5px;
    }
</style>
</html>