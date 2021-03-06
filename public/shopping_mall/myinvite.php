<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的邀请</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="css/common.css">
</head>
<style>
    .invite>img{
        width: 100%;
    }
    .invite>div>div:nth-of-type(1){
        text-align: center;
        margin: 60px auto 15px;
        color: #000;
    }
    .invite>div{
        width: 92%;
        margin: auto;

    }
    .invite p{
        color: #c94d10;
        line-height: 25px;
    }
    button{
        width: 100%;
        height: 40px;
        border: none;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #fff;
        background: #eb3738;
        margin-bottom: 20px;
    }
</style>
<body>
    <div class="invite">
        <img src="images/banimg.png" alt="">
        <div>
            <div class="dredge">尚未开通邀请权限</div>
            <button onclick="location.href='dredgeInvite.php'">邀请开通</button>
            <p>邀请操作说明</p>
            <p>1、开通邀请权限，必须是平台注册用户。</p>
            <p>2、开通邀请权限需要支付相应级别的押金。</p>
            <p>3、若用户中途退出，在我的-个人信息-退回押金中申请退回，退出后用户将无法享受平台日返和月返。</p>
        </div>
    </div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/layer/layer.js"></script>
<script src="js/common.js"></script>
<script src="js/config.js"></script>
<script>
    $.ajax({
			type: "post",
			url: commonsUrl + "api/gxsc/user/profile" + versioninfos,
			data: {
				"ss": getCookie('openid')	
			},
			success: function(data) {
				if(data.code == 1) {
					console.log(data.result)
                    if(data.result.need_deposit!=0){
                        $(".dredge").text("您的会员等级升级啦，去补齐对应级别的金额")
                    }
				} else {
					layer.msg(data.msg);
				}
			}
		});
</script>