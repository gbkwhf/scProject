	$(function() {
		//获取购物车中的商品信息
		$.ajax({
			type: "post", //请求方式
			dataType: 'json', //数据格式
			url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos, //请求地址
			data: {
				"ss": getCookie('openid') //请求参数  openid
			},
			success: function(data) {
				console.log(data)
				if(data.code == 1) { //请求成功
					var con = data.result.info;

					//					console.log(con);
					var html = '';
					$.each(con, function(c, t) {
						html += "<div class='shopCartCon' suppid=" + con[c].supplier_id + ">" +
							"<div class='storeBox'>" +
							"<div class='checkLeft'>" +
							"<label class='seconLabel'>" +
							"<input type='checkbox' class='input seconParent' sup_id=" + con[c].supplier_id + " />" +
							"</label>" +
							"</div>" +
							"<div class='storeName'>" + t.supplier_name + "</div>" +
							"<div class='storeBack'></div>" +
							"</div>" +
							"<div class='storeCon conStore'>";
						var goodList = t.goods_list;
						$.each(goodList, function(k, v) {
							var car_id = goodList[k].car_id; //购物车id
							var first_class_id = goodList[k].first_class_id;
							var created_at = goodList[k].created_at;
							var goods_id = goodList[k].goods_id; //商品id
							var goods_name = goodList[k].goods_name == "" ? "无" : goodList[k].goods_name; //商品名称
							var goods_price = goodList[k].goods_price == "" ? "无" : goodList[k].goods_price; //商品单价
							var goods_url = goodList[k].goods_url == "" ? "无" : goodList[k].goods_url; //商品图片
							var number = goodList[k].number == "" ? "无" : goodList[k].number; //商品数量
							var state = stateCheck(goodList[k].state, car_id, goods_name, goods_url, goods_id, number, goods_price); //商品状态
							var state1 = goodList[k].state == "0"; //商品状态
							html += "<div class='storeConHei'>" +
								"<div class='nextCheck'>" + state + "</div>" +
								"<div class='nextShopImg'>" +
								"<a href=''><img src=" + goods_url + " alt='' /></a>" +
								"</div>" +
								"<div class='rightDiv'>" +
								"<div class='shopTitle'>" + goods_name + "</div>" +
								"<div class='shopPro'>" +
								"<span class='shopPro1'><span></span><span class='daipen'></span></span>" +
								"<span class='dlecon'><img src='images/deleCon.png' alt='' class='dleconImg' cImg=" + car_id + " /></span>" +
								"</div>" +
								"<div class='shopPriceBox'>" +
								"<div class='shopPrice'>￥" + goods_price + "元</div>" +
								"<div class='addBox'>" +
								"<div class='Jian minClass' muites=" + goods_id + ">-</div>" +
								"<div class='inpuCon'><input type='text' name='' id='' value=" + number + " class='inTeCon' readonly='readonly' /></div>" +
								"<div class='Jian addClass' add=" + goods_id + ">+</div>" +
								"</div>" +
								"</div>" +
								"</div>" +
								"</div>";
						});

						html += "</div>" +
							"<div class='fengexian1'></div>" +
							"<div class='fengexian'></div>" +
							"</div>";
					})
					$(".shopBox1").append(html); //动态显示商品
					allsetTotal();
				}
			}
		});

		function stateCheck(sta, car_id, goods_name, goods_url, goods_id, number, goods_price) {
			if(sta == 0) { //0是未选中 
				return '<label class="childLabel" state=' + sta + ' car_id=' + car_id + ' goods_price=' + goods_price + ' number=' + number + ' goods_name=' + goods_name + ' goods_url=' + goods_url + ' goods_id=' + goods_id + '  ><input type="checkbox"  class="input childInput" incar=' + car_id + ' /></label>';
			} else {
				return '<label class="childLabel checked" state=' + sta + ' car_id=' + car_id + ' goods_price=' + goods_price + ' number=' + number + ' goods_name=' + goods_name + ' goods_url=' + goods_url + ' goods_id=' + goods_id + '  ><input type="checkbox" incar=' + car_id + ' class="input childInput" checkcon="true"/></label>';
			}
		}

		//点击删除按钮出现的弹框
		setTimeout(function() {
			$('.dleconImg').click(function() {
				var mThis = $(this);
				var thPar = $(this).parents('.storeConHei');
				var thgo_id = $(this).attr('thgo_id');
				var seParBox = $(this).parents(".shopCartCon");
				var car_id = $(this).attr('cImg'); //获取car_id的值
				//				console.log(car_id);
				var Layer = layer.open({
					type: 1,
					title: false,
					content: $('.popBox'),
					btnAlign: 'c',
					area: ["278px", ""],
					closeBtn: 0,
					shadeClose: true, //点击遮罩层消失
					yes: function(Layer) {
						//vm.updateGoodsClass();
						layer.close(Layer);
					},
					//关闭按钮的回调函数
					cancel: function() {
						layer.close();
					}
				});
				$('#confirmkk').click(function() { //确定
					//请求删除的接口 成功之后做下面的逻辑-----------------------ajax
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/delete/goods/car/commodity' + versioninfos, //请求地址
						data: {
							"car_id": car_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							//							console.log(data)
							$(thPar).remove();
							allsetTotal();
							jisNum();
							layer.closeAll();
							var getStrC = $(seParBox).find('.storeConHei').length;
							if(getStrC == 0) { //做店铺的删除
								$(seParBox).remove();
							}

							//获取所有的input   -------店铺的全选
							var getAllIn = $(seParBox).find('.childInput').length;
							//获取所有选中的input
							var getCheckIn = $(seParBox).find(".childInput[checkcon='true']").length;
							if((getAllIn == getCheckIn) && (getCheckIn > 0)) {
								//店铺的全选
								$(seParBox).find('.seconLabel').addClass('checked');
								$(seParBox).find('.seconParent').attr('checkCon', 'true');
							} else {
								//店铺的全选
								$(seParBox).find('.seconLabel').removeClass('checked');
								$(seParBox).find('.seconParent').attr('checkCon', 'false');
							}

							//获取所有的input ---------总全选
							var getLarge_In = $(".shopBox1").find("input[type='checkbox']").length;
							//获取所有选中的input
							var getCheck_In = $(".shopBox1").find("input[checkcon='true']").length;
							//							console.log(getCheck_In);
							if((getLarge_In == getCheck_In) && (getCheck_In > 0)) {
								$(".label1").addClass("checked");
								$(".oneParent").attr('checkCon', 'true');
							} else {
								$(".label1").removeClass("checked");
								$(".oneParent").attr('checkCon', 'false');
							}

							//如果shopBox没有内容(最大的全选)
							var numNew = $(".shopBox1 .shopCartCon").length;
							if(numNew == 0) { //最大的全选
								$("label").removeClass("checked");
								$(".input").attr('checkCon', 'false');
							}
						}
					});

				})
			})
		}, 300)

		//点击取消删除框的事件
		$('#cancelsId').click(function() {
			layer.closeAll()
		})

		setTimeout(function() {
			//判断页面加载时候前面的店铺是否全选
			var shopCa = $(".shopCartCon");
			$.each(shopCa, function(k, v) {
				//				console.log(v);
				var getAllIn = $(v).find(".storeCon .childInput").length;
				//获取所有选中的input
				var getCheckIn = $(v).find(".storeCon .childInput[checkcon='true']").length;
				var supid = $(this).attr('suppid');
				if(getAllIn == getCheckIn) {
					$(v).find('.seconLabel').addClass('checked');
					$(v).find('.seconParent').attr('checkCon', 'true');

				} else {
					$(v).find('.seconLabel').removeClass('checked');
					$(v).find('.seconParent').attr('checkCon', 'false');

				}

			})

			//获取所有的input---------总的全选
			var getLarge_In = $(".shopBox1").find("input[type='checkbox']").length;
			//获取所有选中的input
			var getCheck_In = $(".shopBox1").find("input[checkcon='true']").length;
			var tHTN = $(".shopBox1").html();
			if(tHTN == null || tHTN == undefined) {
				$(".label1").removeClass("checked");
				$(".oneParent").attr('checkCon', 'false');
			} else if((getLarge_In == getCheck_In) && (getLarge_In != 0)) {
				$(".label1").addClass("checked");
				$(".oneParent").attr('checkCon', 'true');
			} else {
				$(".label1").removeClass("checked");
				$(".oneParent").attr('checkCon', 'false');
			}

			//点击加号

			$(".addClass").click(function() {
				var goods_id = $(this).attr('add'); //获取car_id的值
				//				console.log(goods_id + '点击出现商品id');
				var addSib = $(this).parents(".addBox").find(".inTeCon"); //找数字input框
				var addVal = $(this).parents(".addBox").find(".inTeCon").val(); //取数子框的值
				//console.log(addVal + "这是数量++++");
				//调用加号的ajax接口
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
						allsetTotal();
						jisNum();
						console.log(data);
						//单品数量增加
						addSib.val(parseInt(addVal) + 1);
						console.log((parseInt(addVal) + 1) + "ddddd");

					}
				});

			})

			//点击减号
			$(".minClass").click(function() {
				var goods_id = $(this).attr('muites'); //获取car_id的值
				console.log(goods_id + '点击出现商品id');
				var minSib = $(this).parents(".addBox").find(".inTeCon"); //找数字input框
				var minVal = $(this).parents(".addBox").find(".inTeCon").val(); //取数子框的值
				//console.log(minVal + "这是数量----")
				//调用加号的ajax接口
				$.ajax({
					type: "post", //请求方式
					dataType: 'json', //数据格式
					url: commonsUrl + '/api/gxsc/update/goods/car/commodity/number' + versioninfos, //请求地址
					data: {
						"symbol": 2, //点击加号传1
						"goods_id": goods_id, //请求参数
						"ss": getCookie('openid') //请求参数  openid
					},
					success: function(data) { //请求成功
						allsetTotal();
						jisNum();
						console.log(data);
						//单品数量增加
						minSib.val(parseInt(minVal) - 1);
						if(parseInt(minVal) <= 1) {
							minSib.val(1);
							layer.msg('亲，这个数量不能再少了');
						}
					}
				});

			})

			//总多选
			var allInput = $(".oneParent");
			allInput.click(function() {
				if(this.checked == true) {
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/update/goods/car/commodity/state' + versioninfos, //请求地址
						data: {
							"flag": 2, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) {
							$("label").addClass("checked");
							$(".input").attr('checkCon', 'true');
							allsetTotal();
						}
					});

				} else {
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/update/goods/car/commodity/state' + versioninfos, //请求地址
						data: {
							"flag": 1, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) {
							$("label").removeClass("checked");
							$(".input").attr('checkCon', 'false');
							allsetTotal();
						}
					});

				}
			});

			//店铺（全选）选择
			$(".seconParent").click(function() {
				$(this).parent().toggleClass("checked");
				var checkTrue = $(this).parent().hasClass('checked');
				var sup_id = $(this).attr('sup_id');
				if(checkTrue == true) {

					//这里也掉下那个接口  店铺的选中
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + 'api/gxsc/update/goods/car/supply/all/commodity/state' + versioninfos, //请求地址
						data: {
							"flag": 2, //全选
							"supplier_id": sup_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							allsetTotal();
							console.log(data);

						}
					});
					$(this).attr('checkCon', 'true');
					$(this).parent().parent().parent().parent().find(".childLabel").addClass("checked");
					$(this).parent().parent().parent().parent().find(".childInput").attr('checkCon', 'true');
				} else {
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + 'api/gxsc/update/goods/car/supply/all/commodity/state' + versioninfos, //请求地址
						data: {
							"flag": 1, //全不选
							"supplier_id": sup_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							allsetTotal();
							//							console.log(data);

						}
					});
					$(this).attr('checkCon', 'false');
					$(this).parent().parent().parent().parent().find(".childLabel").removeClass("checked");
					$(this).parent().parent().parent().parent().find(".childInput").attr('checkCon', 'false');

				}

				//获取所有的input---------总的全选
				var getLarge_In = $(this).parents(".shopBox1").find("input[type='checkbox']").length;
				//获取所有选中的input
				var getCheck_In = $(this).parents(".shopBox1").find("input[checkcon='true']").length;
				if(getLarge_In == getCheck_In) {
					$(".label1").addClass("checked");
					$(".oneParent").attr('checkCon', 'true');
				} else {
					$(".label1").removeClass("checked");
					$(".oneParent").attr('checkCon', 'false');
				}

			});
			//点击单选（单个商品的选中）
			var childInput = $('.childInput');
			childInput.click(function() {
				//找他属于商铺的父级
				var sePar = $(this).parents(".shopCartCon");
				//var car_id = $(this).parent().parent().parent().parent().find("input[class*=childInput]").val(); //获取car_id的值
				//点击添加样式，再次点击隐藏（父级）
				$(this).parent().toggleClass("checked");
				var car_id = $(this).attr("incar");
				//如果父级有选中，则让本身添加选中，否则不选中
				if($(this).parent().hasClass('checked')) {
					$(this).attr('checkCon', 'true');
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/update/goods/car/commodity/state' + versioninfos, //请求地址
						data: {
							"car_id": car_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							//							console.log('这是对的');
							//							console.log(data)
							allsetTotal();
						}
					});

				} else {

					$(this).attr('checkCon', 'false');
					$.ajax({
						type: "post", //请求方式
						dataType: 'json', //数据格式
						url: commonsUrl + '/api/gxsc/update/goods/car/commodity/state' + versioninfos, //请求地址
						data: {
							"car_id": car_id, //请求参数
							"ss": getCookie('openid') //请求参数  openid
						},
						success: function(data) { //请求成功
							//							console.log('这是对的');
							//							console.log(data);
							allsetTotal();

						}
					});

				}
				//获取所有的input   -------店铺的全选
				var getAllIn = $(this).parents(".storeCon").find('.childInput').length;
				//获取所有选中的input
				var getCheckIn = $(this).parents(".storeCon").find(".childInput[checkcon='true']").length;
				if(getAllIn == getCheckIn) {
					$(sePar).find('.seconLabel').addClass('checked');
					$(sePar).find('.seconParent').attr('checkCon', 'true');
				} else {
					$(sePar).find('.seconLabel').removeClass('checked');
					$(sePar).find('.seconParent').attr('checkCon', 'false');
				}
				//获取所有的input---------总的全选
				var getLarge_In = $(this).parents(".shopBox1").find("input[type='checkbox']").length;
				//获取所有选中的input
				var getCheck_In = $(this).parents(".shopBox1").find("input[checkcon='true']").length;
				if(getLarge_In == getCheck_In) {
					$(".label1").addClass("checked");
					$(".oneParent").attr('checkCon', 'true');
				} else {
					$(".label1").removeClass("checked");
					$(".oneParent").attr('checkCon', 'false');
				}

			})

		}, 300)

		//公共的底部
//		$('#commId').load('commfooter.php');
//		setTimeout(function() { //#e63636
//			$(".memberIndex dd").css('color', '#333333');
//			$(".memberIndex dt img").attr("src", "images/in1.jpg")
//			$(".shopCar dt img").attr("src", "images/che2.jpg");
//			$(".shopCar dd").css('color', '#e63636');
//			$(".personal dt img").attr("src", "images/my.png");
//			$(".personal dd").css('color', '#333333');
//
//			$('.personal').click(function() {
//				location.href = "personal_center.php";
//			});
//			$('.memberIndex').click(function() {
//
//				location.href = "memberPages.php";
//
//			})
//		}, 100)

		var tarr = [];
		var numberShop = 0;
		//获取购物车的数量
		$.ajax({
			type: "post",
			url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos,
			data: {
				"ss": getCookie('openid')
			},
			success: function(data) {
				if(data.code == 1) { //请求成功
					//					console.log(data);
					var arr = data.result.info;
					$.each(arr, function(k, v) {
							$.each(v.goods_list, function(key, value) {
								//console.log(value.number);
								numberShop += parseInt(value.number)
							})
						})
						//					console.log(numberShop + 'iiiiiii')
					$('.shopCar span').html(numberShop);

				} else {
					layer.msg(data.msg);
				}
			}
		});

		function jisNum() {
			var tarr = [];
			var numberShop = 0;
			//获取购物车的数量
			$.ajax({
				type: "post",
				url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos,
				data: {
					"ss": getCookie('openid')
				},
				success: function(data) {
					if(data.code == 1) { //请求成功
						//					console.log(data);
						var arr = data.result.info;
						$.each(arr, function(k, v) {
								$.each(v.goods_list, function(key, value) {
									//console.log(value.number);
									numberShop += parseInt(value.number)
								})
							})
							//					console.log(numberShop + 'iiiiiii')
						$('.shopCar span').html(numberShop);

					} else {
						layer.msg(data.msg);
					}
				}
			});
		}
		$('#cancelsubmit').click(function() {
			layer.closeAll()
		})
		$('#confirmsubmit').click(function() {
				var arrId = []; //car_id,
				var shopArrId = []; //商品id
				var nameArr = []; //名称
				var priceArr = []; //单价
				var imgUrl = []; //商品图片
				var shopNum = []; //商品数量
				var len = $(".storeConHei").length;
				console.log(len);
				var storeConHei = $(".storeConHei");
				$.each(storeConHei, function(k, v) {
					var ch = $(v).find(".childLabel").hasClass("checked");
					var conjie = $(v).find(".childLabel");
					//					console.log(ch);
					//					console.log(conjie);
					if(ch) {
						for(var i = 0; i < len; i++) {
							var thisVal = $(conjie).attr("car_id"); //car_id
							var shopId = $(conjie).attr('goods_id'); ////商品id
							var thisNum = $(conjie).parents(".storeConHei").find(".inTeCon").val(); //商品数量
							var thisName = $(conjie).attr('goods_name'); //商品名称
							var thisPrice = $(conjie).attr('goods_price'); //商品单价
							var thisImg = $(conjie).attr('goods_url'); //商品图片
						}
						shopArrId.push(shopId); //商品id
						arrId.push(thisVal); //car_id
						nameArr.push(thisName); //商品名称
						priceArr.push(thisPrice); //单价
						imgUrl.push(thisImg); //商品图片
						shopNum.push(thisNum); //商品数量
					}
				});

				var dataArr = [];
				for(var i = 0; i < arrId.length; i++) {
					var param = {
						"id": arrId[i],
						"shopId": shopArrId[i],
						"name": nameArr[i],
						"price": priceArr[i],
						"src": imgUrl[i],
						"number": shopNum[i]
					}
					dataArr.push(param);
				}
				console.log(dataArr);
				localStorage.setItem("moneyArr", JSON.stringify(dataArr));
				window.location.href = 'purchase.php';
			})
			//全选的价格计算
		function allsetTotal() {
			$.ajax({
				type: "post", //请求方式
				dataType: 'json', //数据格式
				url: commonsUrl + '/api/gxsc/get/goods/car/commodity/info' + versioninfos, //请求地址
				data: {
					"ss": getCookie('openid') //请求参数  openid
				},
				success: function(data) {
					if(data.code == 1) { //请求成功
						pricenum = data.result.no_return + data.result.return;
						$(".totalPrice").text(pricenum);
						$("#returnprice").val(data.result.return);
						$("#noreturnprice").val(data.result.no_return);
					}
				}
			});
		}
		//--------------------点击结算--------------
		setTimeout(function() {
			$(".storeBack1").click(function() {
				var nval = $('.totalPrice').text();
				var returnprice = $('#returnprice').val();
				var noreturnprice = $('#noreturnprice').val();
				console.log('fff');
				if(nval != 0.00 || nval != 0) {
					if(returnprice >= 1280) {
						var arrId = []; //car_id,
						var shopArrId = []; //商品id
						var nameArr = []; //名称
						var priceArr = []; //单价
						var imgUrl = []; //商品图片
						var shopNum = []; //商品数量
						var len = $(".storeConHei").length;
						console.log(len);
						var storeConHei = $(".storeConHei");
						$.each(storeConHei, function(k, v) {
							var ch = $(v).find(".childLabel").hasClass("checked");
							var conjie = $(v).find(".childLabel");
							//					console.log(ch);
							//					console.log(conjie);
							if(ch) {
								for(var i = 0; i < len; i++) {
									var thisVal = $(conjie).attr("car_id"); //car_id
									var shopId = $(conjie).attr('goods_id'); ////商品id
									var thisNum = $(conjie).parents(".storeConHei").find(".inTeCon").val(); //商品数量
									var thisName = $(conjie).attr('goods_name'); //商品名称
									var thisPrice = $(conjie).attr('goods_price'); //商品单价
									var thisImg = $(conjie).attr('goods_url'); //商品图片
								}
								shopArrId.push(shopId); //商品id
								arrId.push(thisVal); //car_id
								nameArr.push(thisName); //商品名称
								priceArr.push(thisPrice); //单价
								imgUrl.push(thisImg); //商品图片
								shopNum.push(thisNum); //商品数量
							}
						});

						var dataArr = [];
						for(var i = 0; i < arrId.length; i++) {
							var param = {
								"id": arrId[i],
								"shopId": shopArrId[i],
								"name": nameArr[i],
								"price": priceArr[i],
								"src": imgUrl[i],
								"number": shopNum[i]
							}
							dataArr.push(param);
						}
						console.log(dataArr);
						localStorage.setItem("moneyArr", JSON.stringify(dataArr));
						window.location.href = 'purchase.php';
					} else {
						$('.submitbox').children('p').text('您返利区的价钱为￥' + returnprice + "，非返利区的价钱为￥" + noreturnprice + "，返利区商品需大于等于￥1280才有返利，确认提交吗？");
						var Layer = layer.open({
							type: 1,
							title: false,
							content: $('.submitbox'),
							btnAlign: 'c',
							area: ["278px", ""],
							closeBtn: 0,
							shadeClose: true
						});
					}
				} else {
					layer.msg('请选择你要结算的宝贝');
				}

			})
		}, 300)

	})