<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>邀请的伙伴</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/invitationList.css">
	</head>
    <style>
        .invitationList {
            display: none;
        }

        .invitationList_classify {
            display: flex;
            align-items: center;
            height: 45px;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
        }

        .invitationList_classify > p {
            width: 50%;
            margin: 0 15%;
            height: 45px;
            text-align: center;
            display: inline-block;
            line-height: 43px;
            height: 43px;
            font-weight: bold;
        }

        .select {
            color: #eb3737;
            border-bottom: 2px solid #eb3737;
        }
    </style>
	<body>
    <div class="invitationList">
        <div class="invitationList_classify">
            <p class="select" id="1">一级伙伴</p>
            <p id="2">二级伙伴</p>
        </div>
    </div>
		<div class="wrapper">
			<!--<div class="inviter">
			<div class="photo">				
				<img src="images/head-portrait.png" width="55"/>
			</div>
			<p class="invi_userName">赵婉婷</p>
			<p class="invi_date">2017.11.14</p>
		</div>-->

		</div>

	</body>
	<script src="js/jquery.min.js"></script>
	<script src="js/layer/layer.js"></script>
	<script src="js/common.js"></script>
	<script src="js/config.js"></script>
	<script type="text/javascript">
        var winH = $(window).height();
        $('.wrapper').height(winH);
        $(function () {
            var url = 'api/gxsc/get/invite/user/info/list';
            var state = true;
            $('.invitationList_classify p').click(function () {
                $(this).addClass('select').siblings().removeClass('select');
                var id = $(this).attr('id');
                state = false;
                if(id == 1){
                    url = 'api/gxsc/get/invite/user/info/list';
                    invitation(url)
                }else{
                    url = 'api/gxsc/get/invite/user/info/getInviteListtwo';
                    invitation(url)
                }
            })
            invitation(url)
            function invitation(url){
                $.ajax({ //获取邀请伙伴信息
                    type: "post",
                    dataType: 'json',
                    url: commonsUrl + url + versioninfos,
                    data: {
                        "ss": getCookie('openid') //请求参数  openid
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.code == 1) { //请求成功
                            $('.invitationList').show();
                            var con = data.result;
                            if (con.length != 0) {
                                console.log(con);
                                $('.wrapper').children().remove();
                                var html = '';
                                $.each(con, function (k, v) {
                                    var address = con[k].address; //用户地址
                                    console.log(address);
                                    var mobile = con[k].mobile; //用户手机号码
                                    var name = con[k].name; //用户名
                                    var sex = con[k].sex; //用户性别
                                    var thumbnail_image_url = con[k].thumbnail_image_url; //用户头像
                                    if (thumbnail_image_url == '') {
                                        thumbnail_image_url = 'images/head-portrait.png'
                                    }
                                    var user_id = con[k].user_id; //用户id
                                    var created_at = con[k].created_at;//注册时间
                                    console.log(user_id);
                                    html += "<div class='inviter' url=" + thumbnail_image_url + " name=" + name + " id=" + user_id + ">"+
                                    "<div class='photo'><img src=" + thumbnail_image_url + " width='55'/></div>"+
                                    "<div class='inviteBox'><p class='invi_userName'>" + name + "</p><p class='user_mobile'>"+mobile+"</p></div>"+
                                    "<p class='invi_date'>" + created_at + "</p>"+
                                    "</div>"
                                });
                                $('.wrapper').append(html); //动态显示邀请列表
                            } else {
                                if(state){
                                    $('.invitationList').hide();
                                }
                                $('.wrapper').html('<p>还没有邀请的伙伴哦!</p>');
                                $('.wrapper p').css({
                                    'text-align': 'center',
                                    'color': '#c6bfbf',
                                    'line-height': winH + 'px'
                                });
                            }

                        }

                    }
                });
            }
        })
	</script>
	<style type="text/css">
		.layui-layer.layui-anim.layui-layer-page {
			border-radius: 5px;
		}
	</style>

</html>