$(function() {

	var tarr = [];
	var numberShop = 0;
	//获取购物车的数量
	$.ajax({
		type: "post",
		url: commonsUrl + '/api/gxsc/v2/get/goods/car/info' + versioninfos,
		data: {
			"ss": getCookie('openid')
		},
		success: function(data) {
			if(data.code == 1) { //请求成功
				console.log(data);
				var arr = data.result.info;
				$.each(arr, function(k, v) {
					$.each(v.others, function(key, value) {
						//console.log(value.number);
						numberShop += parseInt(value.number)
					})
				})
				console.log(numberShop + 'iiiiiii');
				$('.shopCar span').html(numberShop);
			} else {
				layer.msg(data.msg);
			}
		}
	});
	//----------------动态显示一级分类--------------

	$.ajax({ //获取商品一级分类
		type: "post",
		dataType: 'json',
		url: commonsUrl + "api/gxsc/get/index/data" + versioninfos,
		data: {
			"ss": getCookie('openid'), //请求参数  openid
			"page": 1
		},
		success: function(data) {
			console.log(data)
			if(data.code == 1) { //请求成功
				var con = data.result.goods_first_list;
				if(con.length != 0) {
					console.log(con);
					var html = '';
					$.each(con, function(k, v) {
						var goods_first_id = con[k].goods_first_id; //一级分类id
						console.log(goods_first_id);
						var imgsrc = 'images/classifyImg' + k + '.png'
						var first_name = con[k].goods_first_name; //分类名称
						html += "<li goods_first_id=" + goods_first_id + "  class='secClick'><img src=" + imgsrc + " /><em>" + first_name + "</em></li>"
					});
					$('.shopContent').append(html); //动态显示分类名称
					$("li").filter(":lt(10)").show().end().filter(":gt(9)").hide(); //多余的分类隐藏
//					$(".secClick").click(function() {
//						var goods_first_id = $(this).attr("goods_first_id");
//						var first_name = $(this).text();
//						location.href = "member_mall_list.php?goods_first_id=" + goods_first_id + "&goods_first_name=" + first_name;
//
//					})
				} else {
					layer.msg(data.msg);
				}

			}

		}
	});

	//获取新发布的商品
	page = 1;
	showajax(page);
	var winH = $(window).height();
	function showajax(page) {
		layer.ready(function() {
			layer.load(2);
		})
		$.ajax({
			type: "post",
			dataType: 'json',
			url: commonsUrl + 'api/gxsc/get/index/data' + versioninfos,
			data: {
				"ss": getCookie('openid'),
				"page": page
			},
			success: function(data) {
				console.log(data)
				layer.closeAll();
				if(data.code == 1) { //请求成功
					var con = data.result.new_goods;
					if(con.length == 0 && page == 1) {
						layer.closeAll();
						$('.shop_Box').html('<p>暂无商品,敬请期待!</p>');
						$('.shop_Box p').css({
							'line-height': winH - 51 + 'px',
							'text-align': 'center',
							'color': '#c6bfbf'
						});
						mui('#refreshContainer').pullRefresh().endPullupToRefresh(true);
					} else {
						console.log(con);
						var html = '';
						$.each(con, function(k, v) {
							var goods_id = con[k].goods_id; //商品id
							var ext_id = con[k].ext_id; //扩展表id
							var goods_name = con[k].goods_name; //商品名称
							var images = con[k].image; //商品图片
							var price = con[k].price; //商品价格
							var market_price = con[k].market_price; //市场价
							var spec_name = con[k].spec_name; //规格名称
							console.log(goods_id);
							html += '<div class="shopBox" goods_id=' + goods_id + ' ext_id=' + ext_id + '>' +
								'<div class="shopImg"><img src=' + images + ' /></div>' +
								'<div class="shopName">' + goods_name + '</div>' +
								'<div class="shopMessage">' +
								'<div class="shops">' +
								'<span class="shopPrice">￥' + price + '</span>' +
								'<span class="fan"></span>' +
								'</div>' +
								//							'<div class="toBuy">立即抢购</div>' +
								'</div>' +
								'</div>'
						});
						$('.shop_Box').append(html); //动态显示商品列表
					}
					if(con.length > 0) {
						mui('#refreshContainer').pullRefresh().endPullupToRefresh(false);
					} else {
						layer.msg("已经到底了");
						mui('#refreshContainer').pullRefresh().endPullupToRefresh(true);
					}

				} else {
					layer.msg(data.msg);
				}

			}

		});
	}
	mui.init({
		pullRefresh: {
			container: '#refreshContainer', //待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
			auto: true, // 可选,默认false.自动上拉加载一次
			height: 50,
			up: {
				callback: function() {
						page++;
						showajax(page);
						mui('#refreshContainer').pullRefresh().endPullupToRefresh();

					} //必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
			}

		}
	});
	//----------------banner图轮播-------------
	$.ajax({
		type: "post",
		dataType: 'json',
		url: commonsUrl + 'api/gxsc/get/index/data' + versioninfos,
		data: {
			"ss": getCookie('openid'),
			"page": 1
		},
		success: function(data) {
			console.log(data)
			if(data.code == 1) { //请求成功
				var con = data.result.banner; //
				var len = con.length;
				console.log(len + "我是轮播图的数量");
				var sort = con.sort; //排序
				//---------------循环图片（轮播图）-----
				$.each(con, function(k, v) {
					var src = con[k].img_url; //图片地址
					var imgId = con[k].id; //图片id
					var sort = con[k].sort; //排序
					var imgurl = con[k].url; //商品id
					console.log(imgurl);
					var t = "<div class='swiper-slide'><a href='javascript:void(0)' imgId=" + imgId + " class='atts' imgurl=" + imgurl + " > <img src=" + src + "  imgurl=" + imgurl + "  /></a></div>";
					$('.swiper-wrapper').append(t)

				});
			};
			if(len <= 1) {
				console.log("不能滑动");
				//swiper插件实现轮播图
				var mySwiper = new Swiper('.swiper-container', {
					//autoplay: false, //可选选项，自动滑动
					loop: false,
//					pagination: '.swiper-pagination',
					paginationType: 'custom', //这里分页器类型必须设置为custom,即采用用户自定义配置
					paginationCustomRender: function(swiper, current, total) {
						var customPaginationHtml = "";
						for(var i = 0; i < total; i++) {
							//判断哪个分页器此刻应该被激活  
							if(i == (current - 1)) {
								customPaginationHtml += '<span class="swiper-pagination-customs swiper-pagination-customs-active"></span>';
							} else {
								customPaginationHtml += '<span class="swiper-pagination-customs"></span>';
							}
						}
						return customPaginationHtml;
					}
				});
			} else {
				console.log("可以滑动");
				//swiper插件实现轮播图
				var mySwiper = new Swiper('.swiper-container', {
					autoplay: 5000, //可选选项，自动滑动
					loop: true,
					pagination: '.swiper-pagination',
					autoplayDisableOnInteraction: false, //手动滑动后可以自动滑动
					paginationType: 'custom', //这里分页器类型必须设置为custom,即采用用户自定义配置
					paginationCustomRender: function(swiper, current, total) {
						var customPaginationHtml = "";
						for(var i = 0; i < total; i++) {
							//判断哪个分页器此刻应该被激活  
							if(i == (current - 1)) {
								customPaginationHtml += '<span class="swiper-pagination-customs swiper-pagination-customs-active"></span>';
							} else {
								customPaginationHtml += '<span class="swiper-pagination-customs"></span>';
							}
						}
						return customPaginationHtml;
					}
				});
			}
		}
	});
	//-----------搜索----------
	$(function() {
			$(".searchSub").click(function() {
				var shopName = $(".insearch").val();
				console.log(shopName);
				if(shopName == "" || shopName == undefined) {
					layer.msg("商品名称不能为空");
				} else {
					location.href = "searchShopList.php?shopName=" + shopName;

				}

			});
			$(".popBox").show();
			$(".close").click(function(){
				$(".popBox").hide();
			});
			$('.collect').click(function(){
				location.href="http://sckjshop.com/shopping_mall/reclassify.php?store_id=84&name=套餐活动专区"
			})
		})
		//改变搜索框的背景色
	$(window).scroll(function() {
		var top = $(".container").offset().top; //获取指定位置
		var scrollTop = $(window).scrollTop(); //获取当前滑动位置
		if(scrollTop > top) { //滑动到该位置时执行代码
			$(".searchTop").addClass("active");
			$(".active .searchSub").addClass("insearchs");
		} else {
			$(".searchTop").removeClass("active");
			$(".searchSub").removeClass("insearchs");
		}
	});
});

//function goDetails(imgId, imgurl) {
//	console.log(imgurl + "ooooo");
//	console.log(imgId);
//	if(imgurl == '' || imgurl == undefined || imgurl == null) {
//		console.log("imgId是空的，不跳转到列表页");
//	} else {
//		location.href = "promotionPage.php?imgId=" + imgId //
//	}
//}

//mui点击跳转到详情页
mui('body').on('tap', '.shopBox', function() {
	var ext_id = $(this).attr('ext_id');
	console.log(ext_id);
	mui.openWindow({
		url: "newShop_details.php?ext_id=" + ext_id
	})
})

//-------------分类跳转------------
mui('body').on('tap', '.secClick', function() {
		var goods_first_id = $(this).attr("goods_first_id");
		var first_name = $(this).text();
		mui.openWindow({
			url: "member_mall_list.php?goods_first_id=" + goods_first_id + "&goods_first_name=" + first_name
		})
	})
mui('body').on('tap', '.leftBox', function() {
		mui.openWindow({
			url: "Super.php?store_first_id=1"
		})
	})
mui('body').on('tap', '.localSpecialty', function() {
		mui.openWindow({
			url: "Super.php?store_first_id=3"
		})
	})
mui('body').on('tap', '.boutiqueGallery', function() {
		mui.openWindow({
			url: "Super.php?store_first_id=2"
		})
	})
//mui('body').on('tap', '.mealBox', function() {
//		mui.openWindow({
//			url: "setMeal.php"
//		})
//	})
	//-----------------礼品区----------
mui('body').on('tap', '.inviteImg', function() {
		mui.openWindow({
			url: 'invitation.php'
		})
	})
mui('body').on('tap', '.gift_img', function() {
		mui.openWindow({
			url: 'setMeal.php'
		})
	})
	//mui点击事件跳转到促销页面
mui('body').on('tap', '.atts', function() {
	var imgId = $(this).attr('imgId');
	var imgUrl = $(this).attr('imgUrl');
	console.log(imgUrl + "ooooo");
	console.log(imgId);
	if(imgUrl == '' || imgUrl == undefined || imgUrl == null) {
		console.log("imgId是空的，不跳转到列表页");
	} else {
		mui.openWindow({
			url: "promotionPage.php?imgId=" + imgId //
		})

	}
})

function waitting() {
	layer.msg('暂未开通，敬请期待哦！')
};