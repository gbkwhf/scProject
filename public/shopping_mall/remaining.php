<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="css/common.css">
    <title>余额</title>
</head>
<style>
    .remaining {
        width: 92%;
        margin: 0 auto;
    }

    .remaining > a {
        text-align: right;
        display: block;
        margin-top: 19px;
        color: #000;
    }

    .remaining > div {
        text-align: center;
        margin: 50px 0 70px 0;
    }

    button {
        width: 100%;
        height: 40px;
        border: none;
        border-radius: 5px;
        background: #4d6dfc;
        color: #fff;
    }

    .rule > p {
        text-align: left;
        color: #c94d10;
        font-size: 12px;
        line-height: 18px;
    }
</style>
<body>
<div class="remaining">
    <a href="remainingDetail.php">余额明细</a>
    <div>
        <p style="font-size: 15px;">账户余额 (积分)</p>
        <p style="font-size: 28px;margin-top: 20px;" class="balance"></p>
    </div>
    <button class="Deposit" style="color: #fff;">提现</button>
    <div style="margin: 20px auto;" class="rule">
        <p>积分提现规则 :  </p>
        <p>1、积分可在平台消费获得相应的积分;</p>
        <p>2、积分仅可在双创平台使用，可用于兑换积分兑换区的商品;</p>
        <p>3、平台消费所获得积分可用于提现，但需扣除8%的手续费、每天最多提现余额的10%;</p>
        <p>4、提现时间为周一至周五，周六、周日不进行提现。</p>
    </div>
</div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/layer/layer.js"></script>
<script src="js/common.js"></script>
<script src="js/config.js"></script>
<script>
    //
    $(function () {
        console.log($_GET['balance']);
        $(".balance").text($_GET['balance']);
        var now = new Date();
        var days = now.getDay();//得到周几
	  	console.log(days);
        $(".Deposit").click(function () {
            if ($_GET['balance'] <= 0) {
                layer.msg("您的账户余额为0，无法提现！")
            }else if(days==0 || days==6){
            	layer.msg("周末不能进行提现哦！")
            }else{
                location.href = "remainingDeposit.php?balance=" + $_GET['balance']
            }
        })

    })
</script>