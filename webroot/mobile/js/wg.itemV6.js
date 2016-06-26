define('wg.itemV6', function(require, exports, module) {
	var __cacheThisModule__;
    var $ = require('zepto'), urlParam = require('url'),
		loopSrcoll = require('loopScroll'),
		ls = require('loadJs'),
		util = require('util'),
		login = require('login'),
		cookie = require('cookie'),
		address = require('jd.address'),
		ui = require('ui'),
		report = require('report'),
		loc = require('s_detail_loc'),
		sizeTable = require('wq.sizeTable');
//Functions  var a=[]; for(k in window._itemDeatail){ if(typeof(window._itemDeatail[k]) == 'function')a.push(k)} console.log(a.sort().join(' '))
//addCart addCartReport addFavReport addressInit bindEvent checkAd checkBrowser checkChartStatus checkFav checkSkuList chooseAddress convertXuni 
//detItemToSku fav getAppPrice getBuyLink getComboSkuPrice getCoupon getCouponList getFeeBtnStr getPCPrice getPinggouStatus 
//getSingleSkuPrice getSkuDesc getSkuPrice getSkuStock getSkuSummary getSortInd getTabData hideDetPC 
//init initLoadImg initStatus item loadActTitleDesc loadCommDet loadCommDetAct loadCommDetMobile loadCommParam loadCommParamAct 
//loadEval loadGuess loadImg loadPackgeSer loadYanbao login loginLocation qianggou queryWareExpImg reloadEvalAppdl 
//reportAdkey reportPV reports resizeProtal scroll setAddrId setBuyNum setCartNum setDetHeight setDetTab setEvelHead setFavStatus 
//setFullAddr setHeyueStat setItemInfo setP setPostInfo setProtalImg setShareConfig setSkuAttachHe setSkuInfo  
//setYanBao shopInfo showDetTab showDownJzBox showLimit showMarketPrice showPart showPromoteData showStore setStoreArea storeChoose showShopLink showNotice supportSticky tavlHTML yuShou yuShouNoWay
	var ItemDet = function() {
		var opt = {
			protocol:'http:', 
			isAndroid23: false,
			isAndroid:false,
			isWX: true,
			//qqBrowserWx:true,
			isUseSticky: false, //高版本浏览器直接fix
			isZiying: false, //是否自营商品
			isExpByjd : false, //是否京东配送
			isCashDelivery: false, //是否支持货到付款
			isLoadCoupon:true, //是否加载优惠券
			isLoadYanbao:true, //是否加载延保
			bid:'',
			itemId : '',
			showMobileDet:true,
			skuType:"1",   //1普通商品  2表示图书  3表示音像
			cgiTimeout: 4000, //cgi超时上报时间
			loopImg:[],    //protal img列表  用于点击看大图
			sliderProtal:null,
			sliderDetail:null,
			pageHight:0,
			pageWidth:0,
			lockScrollH:0, //大浮层出来的时候  需要锁定窗口的滚动条
			mainViewScroll:0,  //切换时主窗口的滚动条高度
			//detBuyBtnH : 0, //购买按钮高度
			quckIcoShow : false,     //
			detPCshow: false,        //是否在show电脑版商详
			blackCoverShow:false,    //黑色浮层是否出来
			buyBtmFloatShow : false, //购买底部的浮层在展示
			detTabFloatShow : false, //商详tab是否在否动
			gotoTopShow : false,  
			isLoadDet : [1, 0, 1, 0],
			isDetPCStr:'',
			detTabH : 0, //默认的详情tab高度
			detLowH : 0, //详情的最低高度
			detIndex : 0, //当前的详情tab 1 2 3
			lastST : 0, //上次的滚动条位置
			commStr : '', //获取商详的参数
			getAddrTime: 0, //获取地址的次数
			
			skuJson:{},  //原始的sku详情json
			skuPro: {},    //sku id&name的属性对应集
			specName : '',  //第三维度sku name
			specValue : [], //第三维度sku value
			relatedItem:{}, //优惠套装
			timeout:{},  //全局保存timeout对象  局部变量保存不会被销毁
			isInit : true,
			favInfo:{},  // 每个sku的收藏状态
			isHoldFav:false,
			isLoginAct:false, //当前页面是否执行登陆后的跳转
			skuId : '',
			changeSkuId:'',
			baseSkuId : '', //url上的那个初始的sku id
			descriptionId:'',
			specificationId:'',
			shopImLink:'',
			jdCategory:[],  //类目id 三级
			jdPrice:0,
			jdStatus:true,  
			jdSkuIds:[],
			jdSkuInfo:{},      //缓存sku的一些cgi的请求
			jdAddrId:[], //省  市  县 
			jdAddrName:[], //省  市  县 
			jdSkuStatus:true, //sku选择状态
			koStatus:0, //0 非抢购   1抢购前  2 抢购中  3 结束
			yushouStatus:0,
			yushouInfo:null,
			venderId:0,   //pop商家id  自营的是‘’或是null
			venderName:'京东',
			saleNum:[], //销量 7天，30天
			maxBuyNum:200, //最大购买数
			isSpecItem:false, //普通商品 & 非普通商品
			isHYKHSP:false, //合约卡号sp
			isBind:false, //页面事件是否绑定ok
			cpart:'main', //当前的part
			tabInit: true,
			
			isAd: false,
			
			ispg : false,
			pgStatus:0,
			pgInfo:{},
			
			xuniBrandId:0, //虚拟商品的brand id
			isOverseaPurchase:0,//全球购商品 属性值为1：标识全球购POP自营店商品；属性值为2：标识全球购POP商品；属性值为3：标识全球购自营商品；属性值为0或者空：标识非全球购商品；
			infoExpTwice: 0,//info.action 接口状态失败次数，失败两次就都取容灾

			skuAttachNo:-1, //像合约机这种插入多一列sku的
			comboSkuInfo:null,
			cfee: null,//合约机的当前fee
			cfeeType:null,//新版合约机
			skuTpl: '<div class="sku" id="sku{no}" ptag="7001.1.5"><h3>{name}：</h3><div class="sku_list">{option}</div></div>',

			timmer: null, //全局定时器
			itil1:null,

			//抢购的sku id列表  限频用  |  放到页面里
			expId:'',

			//ptag:{back2:'7001.1.2',addrArea:'7001.1.4',sku1:'7001.1.5',sku2:'7001.1.5',buyBtn1:'7001.1.7',buyBtn2:'7001.1.8',minus:'7001.1.11',plus:'7001.1.11',fav:'7001.1.23',pcItemLink:'7001.1.17',goTop:'7001.1.2',addCart2:'7001.1.10'},
			//tabRd:['','7001.1.12','7001.1.14','7001.1.13','7001.1.15'],

			evalHold : false,
			evalTotal: 0, //总条数
			evalPage : 1, //评论总页数
			evalPageCur : 1, //评论当前页数
			evalType:3, //全部(0)|好评(3)|中评(2)|差评(1)|有晒单(4)

			itilList:[],  //需要上报的itil列队
			buyNum : 1, //购买数量

			isYuShouNoWay : false,  //是否预售商品
			yuShouNoWayStatus : 0,  //预售状态
			isChou : false,  //是否筹款商品

			isYanBao : false,  //是否有延保服务
			locShopInfo:{},   //loc门店商品的店铺信息
			miaoErr : { errId : '',errMsg : ''},  //秒杀接口返回错误信息

			promoteTips : {},  //记录已展示的温馨提示,避免重复生成
			promoteTag10:0,  //促销新接口里面  pid为10的促销类型出现的次数
			iconHtml:'',    //用于促销显示控制
			network:'',     //网络类型
			postTip:''   //邮费提示语
		};
		$.extend(this, opt);
	};
	/******************************
	 　初始化配置
	 *******************************/
	ItemDet.prototype.init = function() {
		if(!window.speedTimePoint) window.speedTimePoint = [];
		this.protocol = window.location.protocol || this.protocol;
		speedTimePoint[2] = new Date();
		var  obj=this;
		this.skuId = urlParam.getUrlParam('sku').replace(/%20|\s/g,'');
		if (!this.skuId){
			this.myConfirm({msg:'链接地址错误，请检查。'});
			return;
		}
		this.isZiying = this.skuId.length < 10;  //小于10自营
		this.isLoadCoupon = !(window._loadCoupon === false);
		this.isLoadYanbao = !(window._loadYanbao === false);
		var os = $.os;
		this.isAndroid23 = os && os.android && (os.version.indexOf('2.3') != -1);
		this.isAndroid = os && os.android;
		this.isUseSticky = this.supportSticky();
		if(this.isAndroid23) $('body').addClass('android_23_fix');
		this.baseSkuId = this.skuId;
		this.changeSkuId = this.skuId;
		this.bid = urlParam.getUrlParam('bid');
		this.itemId = urlParam.getUrlParam('ic');
		this.pageHight = $(window).height();
		this.detLowH = this.pageHight - $('#detailTab').height() + 20;
		this.pageWidth = $(window).width();
		this.expId = window._LIMIT_SKUS || '';
		this.isChou = urlParam.getUrlParam('zhongchou') ? true : false;
		window.location.hash = '#main';
		this.checkBrowser();
		this.checkAd();
		this.setAddrId();
		if(this.isAd) $('#summaryEnter .good').hide();
		if(window._itemInfo){
			this.skuJson[this.skuId] = window._itemInfo;
			window._itemInfo = null;
			JD.report.umpBiz({bizid:'25',operation:'16',result:'0',source:'0',message:'item straight success'});
		}else{
			JD.report.umpBiz({bizid:'25',operation:'16',result:'1',source:'0',message:'item straight fail '+this.skuId});
		}
		
		this.setItemInfo({init:true});
		//大家电切换提示
		var huan = urlParam.getUrlParam('huan');
		if(huan){
			ui.alert({
				container : document.body,
				msg : '京东自营商品' + this.skuJson[this.skuId].skuName + '（' + huan + '）无货或暂不支持配送到所选地区，已为您替换为商家提供的相同商品，欢迎购买'
			});
		}
		this.reportAdkey();  //上报adkey
	};
	
	ItemDet.prototype.checkBrowser = function(){
		this.isWX = util.isWX();
		if(!this.isWX){
			try{
				JD.sqapi.ready(function(){
					mqq.ui.setWebViewBehavior({
		             	swipeBack: 0
		        	});
				});		
			}
			catch(e){}
		}
	};

	ItemDet.prototype.checkNetwork = function(images){
		var obj = this;
		if(obj.network){
			obj.setProtalImg(images);
		}else{
			try{
				JD.device.getNetwork(function(nt){
					obj.network = nt;
					obj.setProtalImg(images);
				});
			}
			catch(e){
				obj.setProtalImg(images);
			}
		}
	};
	
	ItemDet.prototype.item = function(){
		if(!this.skuJson[this.skuId] || !this.skuJson[this.skuId].item){
			JD.report.umpBiz({bizid:'25',operation:'15',result:'9',source:'0',message:'itemerror'+this.skuId});
			return {};
		} 
		return this.skuJson[this.skuId].item;
	};
	
	ItemDet.prototype.checkAd = function(){
		var adck=cookie.get('PPRD_P'), reg = new RegExp(this.isWX ? '17047':'17051|17061');
		if(reg.test(adck) || reg.test(location.href)){
			this.isAd = true;
			showTopBack(true);
		}
	};

	ItemDet.prototype.myConfirm = function(opt){
		opt = opt || {};
		var onCancel = opt.onCancel||function(){location.href = (obj.isWX ? '//wq.jd.com/mcoss/mportal/show?tabid=17&tpl=17':'//wq.jd.com/mcoss/mportal/show?tabid=6&tpl=7');},
			onConfirm = opt.onConfirm || function(){location.href =(obj.isWX ? '//wqs.jd.com/portal/wx/category_m.shtml?PTAG=37080.12.9':'//wqs.jd.com/portal/sq/category_q.shtml?ptag=37128.3.1');};
		ui.confirm({msg: opt.msg||'该商品已下架', //提示消息
            icon: opt.icon||"info", //图标类型，none,info,fail,success
            container:opt.container||document.body,
            okText: opt.okText||"搜索商品",
            cancelText: opt.cancelText||"逛逛首页",
            onCancel: onCancel, 
            onConfirm: onConfirm
        });
	};

	//从cookie中取出地区信息
	ItemDet.prototype.setAddrId = function(){
		var obj=this, addr=window.getAddrInfo();
		this.jdAddrId = addr.id.split('_');
		this.jdAddrName = addr.name.split('_');
		for (var i = 0; i < 4; i++) { 
			if(!this.jdAddrId[i])  this.jdAddrId[i] = 0;
			if(!this.jdAddrName[i])  this.jdAddrName[i] = '';
		}
		$('#addrName').html(this.jdAddrName[0]);
	};

	//每切换sku都状态还原
	ItemDet.prototype.initStatus = function(){
		var obj = this;
		this.jdStatus = true;
		this.jdSkuStatus = true;
		this.showMobileDet = true;
		this.cfee = null;
		this.cfeeType = null;
		this.evalPageCur=1;
		this.evalType=3;
		this.promoteTag10=0;
		$('#statusNotice,#relatedEnter,#promoGift,#promotePanel,#ziYingMsg,#outService,#viewGuess,#arrivalNotice').hide();
		$('#buyBtn2,#addCart2').show();
		$('#promShopFullfree').html('').hide();
		$('#priceWQDiscount').addClass('hide');
		$('#serviveArea').addClass('service_wrap_none');
		if(!this.isWX){  //QQ会员专享价
			$('#priceTitle').html('京东价：');
			$('#headEval').show();
			$('#evalQQMem,#qqMemTip').hide();
		}
		this.iconHtml = '';
		if(this.isSpecItem){
			this.maxBuyNum = 200;
			this.koStatus = 0;
			this.yushouStatus = 0;
			this.skuAttachNo = -1;
			this.comboSkuInfo = null;
			if(this.pgStatus != 0) document.title = '京东商城-商品详情';
			this.pgStatus = 0;
			this.ispg = false;
			if(this.timmer) {clearInterval(this.timmer); this.timmer=null;}
			$('#buyBtnExp,#priceGroupStyle,#priceExp,#popSale').hide();
			$('#postNotice1, #postNotice2').html('');
			$('#buyBtn2').html('立即购买').removeClass('btn_blue');
			$('#priceTitle').html('京东价：');
			$('#skuCont,#addCart2,#buyBtn2,#fav,#gotoCart').show();
			$('#addCart2').removeClass('btn_disable');
			$('#skuAttach').remove();
			$('#skuAttach1,#skuAttach2').remove();
			$('#skuAttachDiv').hide();
		}
		this.isSpecItem = false;
	};

	//一个sku下的基本信息
	//注意 如果一个skuid是下柜状态  那么colorsize里面是没有这个skuid的
	ItemDet.prototype.setItemInfo = function(param){
		if(!param) param={};
		var obj = this;
		this.createTimeout('1','item view api fail');//4秒主接口失败，或者执行逻辑出错
		window.skuInfoCB = function(json){
			if(json.huanUrl){  //换区
				location.href = json.huanUrl;
				return;
			}
			if(!obj.isInit && json.redirectUrl){ //跳转url  如秒杀等
                location.href = json.redirectUrl;
                return;
            }  
            if(json.errCode=='20160304') { //sku信息不存在
            	obj.myConfirm();
            	return;
            }       
			if(!speedTimePoint[3]) speedTimePoint[3] = new Date();
			obj.skuJson[obj.changeSkuId] = json;
			obj.skuId = obj.changeSkuId;
			var item = json.item,stock=json.stock;
			JD.report.umpBiz({bizid:'25',operation:'2',result:item.errCode,source:'0',message:'item view api status'}); //报状态码失败率
			if(!item.skuId) {
				item.attr = '';
				item.warestatus = '1';
			}
			/*if(item.areaSkuId && (item.areaSkuId != item.skuId)){ //当前的sku id不是正确的区域sku id，要重新拉取。目前没有发现这种case
				obj.skuId = item.areaSkuId;
				obj.setItemInfo(param);
				return;
			}*/
			if(!obj.skuPro.id) obj.setSkuInfo(item.ColorSize, item.Color, item.Size,item.Spec);   //不能重复执行

			if(!obj.isBind){ 
				$('#btnTools').show();
				obj.bindEvent(); 
			} //把绑定事件提前

			obj.descriptionId = item.description;
			obj.specificationId = item.specification;
			obj.venderId = item.venderID;
			obj.jdCategory = item.category;
			obj.skuType = item.skuType;
			obj.checkNetwork(item.image);
			if(window._jdApp) _jdApp.category = obj.jdCategory[0];
			if(item.spAttr && item.spAttr.isOverseaPurchase > 0) obj.isOverseaPurchase = item.spAttr.isOverseaPurchase;
			if(item.attr.indexOf('isKO') != -1) obj.isLoadCoupon = false;
			if(param.itemType != 'heyue') obj.initStatus();  //合约机里面的正常商品  不需要init
			if(obj.isAd) $('#summaryEnter .good').hide();
			/**
			if(item.attr.indexOf('isXnzt') != -1){ //组合套餐  只能加入购物车
				obj.isSpecItem = true;
				$('#btnTools').addClass('btn_wrap_nobuy');
			}
			*/
			try{
				if(!json.feetype || !json.feetype.datas || !json.feetype.datas.length===0){
					json.feetype = null;
				}
			}catch(e){}
		
			if(param.itemType != "heyue" && json.feetype){ //点击切换  不重写attch sku
				obj.isSpecItem = true;
				obj.maxBuyNum = 1;
				obj.setSkuAttachHeNew(json.feetype);//obj.setSkuAttachHeNew(feeType);
				$('#sku2 h3').html('版本：');
			}

			if(obj.jdCategory[2] == '6980'){//e卡只能购买，不能加车
				$('#addCart2,#gotoCart').addClass('hide');
				obj.isEcard = true;
			}
			//虚拟点卡
			if(obj.jdCategory && item.expandAttr && (obj.jdCategory[2] == '4835' || obj.jdCategory[2] == '4836')){
                //location.href = '//item.m.jd.com/product/'+obj.skuId+'.html';
				obj.convertXuni(item.expandAttr);
				if(obj.xuniBrandId) {
					obj.isSpecItem = true;
					$('#addCart2,#fav,#gotoShop,#gotoCart').hide();
					obj.maxBuyNum = parseInt(500/json.price.p)||1;

					obj.jdStatus = false;
					$('#buyBtn2, #addCart2').addClass('btn_disable');
					$('#postNotice1, #postNotice2').html('');
					$('#statusNotice').show();
					$('#statusNote').html('本商品暂不支持在' + (obj.isWX ? '微信' : 'QQ') + '内购买');
				}
				$('.detail_sendto').hide();  //隐藏配送至
			}

			if(obj.venderId == '117761'){  //易车商品  
				obj.jdStatus = false;
				obj.isSpecItem = true;
				$('#buyBtn2, #addCart2').addClass('btn_disable');
			}
			
			if(item.attr.indexOf('HYKHSP') != -1){ 
				obj.isSpecItem = true;
				obj.isHYKHSP = true;
				$('#addCart2').hide();
			}
			
			//isSpecItem=true是已经有上面的逻辑       虚拟  （obj.jdCategory[2] != '9392'  是指的游戏刊物之类的）                         
			if(!obj.isSpecItem && !obj.xuniBrandId && obj.jdCategory && (((obj.jdCategory[0] == '4938' || obj.jdCategory[2] == '1195'||obj.jdCategory[2] == '13046') && obj.jdCategory[2] != '9392') || (obj.jdCategory[1]=='12632' && obj.isZiying))){ //国际站商品 || 虚拟商品  OTC自营药品
				obj.jdStatus = false;
				$('#buyBtn2, #addCart2').addClass('btn_disable');
				if(obj.jdCategory[1]=='12632'){
					$('#statusNotice').show();
					$('#statusNote').html('抱歉，该商品暂不支持在手机购买');
				}
			}
			else if(item.warestatus != "1"){ //0下柜,1正常,10删除
				$('#statusNotice').show();
				$('#statusNote').html('此商品已经售完');
				$('#buyBtn2, #addCart2').addClass('btn_disable');
				obj.jdStatus = false;
			}
			else if(item.spAttr && (item.spAttr.isSelfService==='1'||item.spAttr.isSelfService==='2'||item.spAttr.isSelfService==='5')){  //isSelfService-1  ：单独购买  isSelfService-2：捆绑销售   isSelfService-5：补购，上述返回参数均不可购买，应该置灰购买按钮；
				$('#statusNotice').show();
				$('#statusNote').html('抱歉，该商品不支持单独购买');
				$('#buyBtn2, #addCart2').addClass('btn_disable');
				obj.jdStatus = false;
			}
			else if(item.attr.indexOf('YuShouNoWay') != -1){  //预售商品
				obj.isSpecItem = true;
				obj.isYuShouNoWay = true;
				$('#addCart2').hide();
				$('#postNotice1, #postNotice2').html('');
				$('#buyBtn2').html('支付定金');
				$('#priceBlock').hide();
				$('#ysPriceBlock').show();
				if(item.spAttr && item.spAttr.YushouStepType==='1'){//1:一阶梯全款（仅全款支付） 2：一阶梯可选（全款和定金选择支付）3：三阶梯定金（仅定金支付） 4：三阶梯可选（全款和定金选择支付） 5：一阶梯仅定金支付
					$('#ysPriceBlock >span.pre_buy').hide();
					$('#ysPriceBlock >div.tip').html('支付定金后享受优先发货特权');
				}else{
					$('#ysPriceBlock >span.pre_buy').show();
					$('#ysPriceBlock >div.tip').html('先付定金，即可获得该预售商品的购买资格');
				}	
				obj.yuShouNoWay();
			}
			else if(item.attr.indexOf('YuShou') != -1){  //预售
				obj.isSpecItem = true;
				//$('#btnTools').addClass('btn_wrap_nocart');
				$('#addCart2').hide();
				$('#postNotice1, #postNotice2').html('');
				$('#buyBtn2').html('立即预约');
				obj.maxBuyNum = 1;
				obj.jdStatus = false;
				obj.yuShou();
				// var t=0;
				// if(json.miao && json.miao.isKo == 1 && json.miao.endTime - json.miao.serverTime > 0 ){
				// 	obj.qianggou();//是为了提前看到抢购的状态，因为预售接口请求有延时
				// 	t=300;
				// }
				// else{
				// 	obj.jdStatus = false;
				// }
				// setTimeout(function(){obj.yuShou();}, t);
			}
			else if(item.attr.indexOf('isKO') != -1){  //秒杀
				obj.isSpecItem = true;
				$('#addCart2').hide();
				$('#postNotice1, #postNotice2').html('');
				obj.maxBuyNum = 1;
				obj.koStatus = 1;
				obj.qianggou();
			}
			else if(item.spAttr && item.spAttr.isLOC * 1 != 1){  //LOC类商品需要判断是否有门店
				obj.getSkuStock(stock);
			}
			
			//拼购的  放到库存之后
			//if(1||window._PING_GOU_SKU && (window._PING_GOU_SKU.indexOf(','+obj.skuId+',') != -1)){
			if(json.pingou && json.pingou==1){
				document.title = '京东商城-好友拼购';
				$('#buyBtn2').removeClass('btn_disable');
				obj.isSpecItem = true;
				obj.ispg = true;
				obj.loginLocation(null, true) ? obj.getPinggouStatus() : obj.login(location.href.replace(obj.baseSkuId, obj.skuId));
			}

			if(obj.isChou){  //好友筹款商品
				$('#addCart2,#fav,#gotoShop,#gotoCart').hide();
				$('#buyBtn2').html('发起好友筹款');
			}
			
			//var p = item.Price * 1 > 0 ? item.Price : 0, m = item.MarketPrice * 1 > 0 ? item.MarketPrice : 0;
			obj.jdPrice = urlParam.getUrlParam('price');
			item.category = item.category || [0,0,0];
			item.sales = item.sales || '-';
			obj.saleNum = item.sales.split('-');
			var promoteIco = urlParam.getUrlParam('extlogo')=='gh'?'<span class="tag">广货</span>':'';
			if(obj.isOverseaPurchase > 0){  //1：标识全球购POP自营店商品； 2：标识全球购POP商品； 3：标识全球购自营商品；
				if(obj.isZiying){//全球购自营商品
					promoteIco += '<div class="mod_sign_tip bg_1 bor"><b><i class="i_global"></i> 全球购</b><span>自营</span></div>';
				}else{ 
					promoteIco += '<div class="mod_sign_tip bg_1 bor"><b><i class="i_global"></i> 全球购</b></div>';
				}
				
				if(item.spAttr.isEbay){
					$('#titNotice').show().html('购买eBay商品需要同意<a href="//wqs.jd.com/help/ebay.html">《购买eBay商品特殊条款》</a>');
				}
				if(item.spAttr.isCartshield==1 || item.spAttr.isCartshield==3){ //全球购促销
					$('#addCart2,#fav,#gotoShop,#gotoCart').hide();
				}
			}
			if(item.spAttr && item.spAttr.isLOC * 1 == 1){
				obj.locShopInfo['isLOC'] = true;
				promoteIco += '<div class="label label_icon_txt" id="storeIcon"><i class="icon_service serv_to_shop"></i><span class="txt">到店服务</span></div>';
				obj.shopInfo(stock);
				obj.showStore();
			}
			if(obj.isZiying && obj.isOverseaPurchase == 0) promoteIco += '<div class="mod_sign_tip"><span>自营</span></div>';
			$id('itemName').innerHTML = promoteIco+json.skuName;
			setTimeout(function(){$id('itemName').innerHTML = promoteIco+json.skuName;}, 300);  //可能这里css有问题，ios下  有时需要重绘
			
			obj.getSkuPrice(json.price, item.areaSkuId);
			
			try{$('#itemDesc').html(json.AdvertCount.ad.replace(/<.*?>/ig, ''));}catch(e){};
						
			obj.detTabH = $('#detailBaseLine').offset().top;
			
			//obj.getSkuSummary();   //评价数
			obj.setBuyNum(obj.buyNum);
			obj.setFavStatus();
			
			obj.loadEval();

			obj.setDetTab();

			obj.getPostPrice(stock);

			//判断是否支持 7天无理由退货
			if(item.spAttr){
				var is7t = item.spAttr['is7ToReturn'],jdqTips='';
				if(is7t === '1' || is7t === null){  //支持
					is7t = '<div class="item"><div class="label"><i class="icon_service icon_7day"></i><div class="txt">支持7天无理由退货</div></div></div>';
				}else if(is7t === '0'){  //不支持
					is7t = '<div class="item"><div class="label"><i class="icon_service icon_7day disabled"></i><div class="txt">不支持7天无理由退换货</div></div></div>';
				}else{
					is7t = '';
				}
				if(item.spAttr.isCanUseDQ=='0') jdqTips += ' 东券';
				if(item.spAttr.isCanUseJQ=='0') jdqTips += ' 京券';
				if(~jdqTips.indexOf('券')){ //不能使用
					jdqTips = '<div class="item"><div class="label"><i class="icon_service icon_coupon"></i><div class="txt"><em class="hl_red">本商品不能使用' + jdqTips + '</em><br/></div></div></div>';
				}
				$('#outServiceNote').html(is7t+jdqTips);
			}

			if(obj.jdSkuInfo['promote'] && obj.jdSkuInfo['promote'][obj.skuId]){
				obj.showPromotion(obj.jdSkuInfo['promote'][obj.skuId]);
			}
			else{
				obj.showPromotion(json.promov2);
			}
			$('#outService div.de_span').text().replace(/\s/g,'') ? $('#outService').show() : $('#outService').hide(); 
			if(obj.isLoadYanbao) obj.loadNewYanBao();//延保服务
			obj.loadRelatedItem();

			if(obj.isInit){
				obj.getCouponList();
				obj.loadGuess();
				obj.showMarketPrice();
				obj.shopInfo(stock);
				obj.checkFav();
				try{obj.getVenderInfo();obj.checkIsFavShop();}catch(e){};
				obj.addressInit();
				obj.setCartNum();
				obj.loadSizeInfo();
				//if(!obj.isAd) try{obj.showDownJzBox();}catch(e){};
				if(obj.isAd){  //广告商品，需要隐藏下载条
					$('#appdlCon,#appdlCon2').addClass('hide');
				}
				if(cookie.get('doAddCart')){
					var cookirStr = cookie.get('doAddCart');
					cookie.del('doAddCart');
					if(cookirStr != 'ok'){
						try{cookirStr = JSON.parse(cookirStr);}catch(e){}
					}
					obj.isLoginAct = true;
					obj.addCart(cookirStr);
				}
				obj.isInit = false;

				obj.reports();
			}
			else{
				obj.getTabData();
			}
			obj.reportPV();
			obj.delTimeout('itil1');
			JD.report.umpBiz({bizid:'25',operation:'1',result:'0',source:'0',message:'item view api loaded'});
		};
		
		if(this.skuJson[this.changeSkuId]){
			skuInfoCB(this.skuJson[this.changeSkuId]);
		}else{
			ls.loadScript(['//wq.jd.com/item/view2?datatype=1&callback=skuInfoCB',
			'sku='+this.changeSkuId,
			'areaid='+this.jdAddrId.join('_'),
			'u_source='+(this.isWX?'weixin':'qq'),
			't='+Math.random()].join('&'));
		}
	};
	
	//渲染sku区   第一次会进入这里
	//不能重复执行
	ItemDet.prototype.setSkuInfo = function(arr, color, size, spec){
		arr = arr || [];
		this.skuPro={color:{}, size:{}, name:{}, id:{}};
		var obj=this, csku=[]; //specName='', specValue=[];
		for (var i=0; i < arr.length; i++) {
			this.jdSkuIds.push(arr[i].SkuId);
			var tmp = [arr[i].Color, arr[i].Size, arr[i].Spec].filterEmp();  
			this.skuPro.name[tmp.join('~~')] = arr[i].SkuId;
			this.skuPro.id[arr[i].SkuId] = tmp;
			//specName = specName || arr[i].SpecName;
			
			//if(arr[i].Spec) specValue.push(arr[i].Spec);
			if(arr[i].SkuId == this.skuId) csku = tmp;
		};
		if(!this.jdSkuIds.length) this.jdSkuIds.push(this.skuId); //只有单个sku
		//this.specName = specName;
		//this.specValue = util.arrayUniq(specValue);
		//var no=0;//str='', skus=this.skuPro, no=1;
		$.each([1,2,3], function(index,item){
			var arr = $('#sku'+item+' span.option');
			if(arr.length>0){
				for(var i=0,len=arr.length;i<len;i++){
					var $arr = $(arr[i]);
					if($arr.text()==csku[item-1]){
						$arr.addClass('option_selected');
						break;
					}
				}
			}
		});
		// var getSkuHtml = function(n, arr){
		// 	if(!arr || !arr.length) return;
		// 	var html=[];
		// 	for (var i=0; i < arr.length; i++) {
		// 		if(!(arr[i].replace(/\s+/g, ''))) continue;
		// 		html.push('<span class="option'+(arr[i] == csku[no-1] ? ' option_selected' : '')+'">'+arr[i]+'</span>');
		// 	}
		// 	if(html.length)str += window._skuTpl.replace('{no}', no++).replace('{name}', n).replace('{option}', html.join(''));
		// };
		// getSkuHtml('颜色', color);
		// getSkuHtml('尺寸', size);
		// getSkuHtml(specName, this.specValue);
		// $id('propertyDiv').innerHTML = str;
		
		var no = csku[0]?1:2;
		this.checkSkuList(no, csku[no-1]);
		$('#sku'+no+' span').removeClass('option_disabled');
	};
	
	//disable 掉另外两列没有sku匹配的项
	ItemDet.prototype.checkSkuList = function(skuNo, cName){
		var obj = this, nameRelated=[],	cindex = skuNo-1;
		$.each(obj.skuPro.id, function(){
			if(this[cindex] == cName) nameRelated.push(this);
		});
		//disable掉与当前cName无关的sku
		$.each([1,2,3], function(i,no){
			if(skuNo == no) return;
			$('#sku'+no+' span').each(function(){
				var isRelate = false, name=$(this).text();
				$.each(nameRelated, function(){
					isRelate = isRelate || this[i] == name;
				});
				isRelate ? $(this).removeClass('option_disabled') : $(this).addClass('option_disabled');
			});
		});
		
		//选择的是第一、第二、第三列时  补充disable第三、第三、第二列无关sku
		if(!$('#sku3 span').length) return;
		var partnerNo=[0,2,1,1][skuNo], checkNo=[0,3,3,2][skuNo], partnerName=$('#sku'+partnerNo+' .option_selected').text();
		if(!partnerName) return;
		$('#sku'+checkNo+' span').addClass('option_disabled');
		$.each(nameRelated, function(){
			var arr=this;
			$('#sku'+checkNo+' span').each(function(){
				if(arr[partnerNo-1] == partnerName && arr[cindex] == cName && arr[checkNo-1]==$(this).text()) $(this).removeClass('option_disabled');
			});
			
		});
	};
	
	//处理虚拟参数
	ItemDet.prototype.convertXuni = function(str){
		var arr = str.split('^');
		for (var i=0; i < arr.length; i++) {
		    var tmp = arr[i].split(':');
		    if(tmp[0]=='8457' || tmp[0]=='8459'){
		    	this.xuniBrandId = tmp[2];
		    	break;
		    }
		}
	};
	
	//设置合约机的附加sku
	ItemDet.prototype.setSkuAttachHe = function(json){
		//json = {"sku":917461,"sp":3,"pid":1,"dis":false,"feeTypes":[{"sids":null,"ft":100,"name":"非合约机","stat":1,"che":1,"ad":"选“购机入网送话费”版，多档超值套餐供您选购：帝都套餐专享大流量短合约、乐享3G上网版/聊天版等劲爆套餐","tip":"","sku":"917461"},{"sids":null,"ft":2,"name":"购机入网送话费","stat":1,"che":0,"ad":"帝都套餐：69元档包打一年！89元即享大流量大语音套餐，最具性价比！乐享3G套餐：上网/语音专属产品","tip":"","sku":"917461"}]};
		this.setSkuAttachHeNew(json);
		return;
		var html = [], fee=json.feeTypes, cno = cookie.get('ftNo');
		cookie.del('ftNo');
		this.comboSkuInfo = fee;
		if(json.dis){ //dis为true  表示不在改地区卖
			this.jdStatus = false;
			$('#buyBtn2, #addCart2').addClass('btn_disable');
			$('#postNotice1, #postNotice2').html('');
			$('#statusNotice').show();
			$('#statusNote').html('无货，或此商品不支持配送至'+this.jdAddrName[1]+this.jdAddrName[2]);	
			return;
		}
		for (var i = 0; i < fee.length; i++) {
			var ots = ' option_selected';
			if(cno > 0){
				ots = cno-1 == i ? ots:'';
			}
			else if(fee[i].che != 1){
				ots = '';
			}
            html.push('<span no='+i+' class="option'+ots+'">'+fee[i].name+'</span>');
			if(ots) {
				this.skuAttachNo = i;
				this.cfee = fee[i];
			}
		};
		$('#skuAttach').remove();
		if(html.length){
			this.jdStatus = true;
			var skuTpl = '<div class="sku" id="sku{no}" ptag="7001.1.5"><h3>{name}：</h3><div class="sku_list">{option}</div></div>';
			$('#buyBtn2').removeClass('btn_disable');
			$('#propertyDiv').append(skuTpl.replace('{no}', 'Attach').replace('{name}', '方式').replace('{option}', html.join('')));
		}
		else{
			this.jdStatus = false;
			$('#buyBtn2').addClass('btn_disable');
		}
		if(this.cfee){
			this.maxBuyNum = this.cfee.ft == 100 ? 200 : 1;
			this.cfee.ft == 12 ? this.getComboSkuPrice(this.cfee.sids) : this.getSingleSkuPrice(this.cfee.sku);
			if(this.cfee.ft != 100){
				//$('#btnTools').addClass('btn_wrap_nocart');
				$('#addCart2').hide();
				$('#buyBtn2').html(this.getFeeBtnStr(this.cfee.ft));
			}
		}
	};
	//设置合约机的附加sku
	ItemDet.prototype.setSkuAttachHeNew = function(json){
		var html = [], fee=json.datas, cno = cookie.get('ftNo');
		cookie.del('ftNo');
		this.comboSkuInfo = fee;
		if(json.dis){ //dis为true  表示不在改地区卖
			this.jdStatus = false;
			$('#buyBtn2, #addCart2').addClass('btn_disable');
			$('#postNotice1, #postNotice2').html('');
			$('#statusNotice').show();
			$('#statusNote').html('无货，或此商品不支持配送至'+this.jdAddrName[1]+this.jdAddrName[2]);	
			return;
		}
		var ots = ' option_selected',feeItem={},skuStrArr=[];
		for (var i = 0,len=fee.length; i < len; i++) {
			feeItem = fee[i];
			ots = ' option_selected';
			if(cno > 0){
				ots = (cno-1 === i ? ots:'');
			}
			else if(feeItem.che != 1){
				ots = '';
			}
            html.push('<span no='+i+' class="option'+ots+'">'+feeItem.name+'</span>');
			if(ots) {
				this.skuAttachNo = i;
				this.cfee = feeItem;
			}
		};
		if(html.length){
			skuStrArr.push(this.skuTpl.replace('{no}', 'Attach1').replace('{name}', '方式').replace('{option}', html.join('')));
		}
		if(this.cfee){
			skuStrArr.push(this.setCfeeType());
			if(skuStrArr.length>0) $('#skuAttachDiv').html(skuStrArr.join('')).show();
		}
	};
	ItemDet.prototype.setCfeeType = function(cno){  
		if(!this.cfee) return '';
		if(!this.cfee.feetypes) this.cfee.feetypes = [];
		var len = this.cfee.feetypes.length,html = [],feeItem={},ots='',outStr='';
		if(cno > 0){
			this.cfeeType = this.cfee.feetypes[cno-1];
		}else if(len > 1){
			for(var i=0;i<len;i++){
				feeItem = this.cfee.feetypes[i];
				ots = '';
				if(feeItem.che===1){
					ots = ' option_selected';
					this.cfeeType = feeItem;
				}
				html.push('<span no='+i+' class="option'+ots+'">'+feeItem.name+'</span>');
			}
			outStr = this.skuTpl.replace('{no}', 'Attach2').replace('{name}', '类型').replace('{option}', html.join(''));
		}else{
			this.cfeeType = this.cfee.feetypes[0];
		}
		feeItem = this.cfeeType;
		if(feeItem){
			this.maxBuyNum = (feeItem.ft == 100 ? 200 : 1);
			(feeItem.ft == 12 && feeItem.sids) ? this.getComboSkuPrice(feeItem.sids) : this.getSingleSkuPrice(feeItem.sku);
			if(feeItem.ft != 100){
				$('#addCart2').hide();
				$('#buyBtn2').html(this.getFeeBtnStr(feeItem.ft));
			}
			if(feeItem.stat==0){
				this.jdStatus = false;
				$('#buyBtn2').addClass('btn_disable');
				return outStr;
			}
			var wxSupport = ((this.skuJson[this.skuId]&&this.skuJson[this.skuId].feetype&&this.skuJson[this.skuId].feetype.group&&this.skuJson[this.skuId].feetype.group.weixin) || '');
			if(~wxSupport.indexOf(feeItem.ft)){ //支持在微信手Q购买
				this.jdStatus = true;
				$('#buyBtn2').removeClass('btn_disable');
			}else{
				this.jdStatus = false;
				$('#buyBtn2').addClass('btn_disable');
				$('#statusNotice').show();
				$('#statusNote').html('此套餐暂不支持在'+(this.isWX ? '微信':'手机QQ')+'内购买');
			}
		}
		return outStr;
	};
	//各种上报赋值
	ItemDet.prototype.setShareConfig = function(){
		window.shareConfig.title = this.item().skuName;
		window.shareConfig.desc = '售价：'+$('#priceSale').attr('price')+(this.isWX ? '。京东商城，正品保证，微信专享。' : '');
		window.shareConfig.link = location.href.replace(this.baseSkuId, this.skuId).replace(/\&huan=/, '&').replace(/#.*/,'');
		if(window.shareConfig.link.indexOf('&logid=') == -1){
			if(window.__logid) window.shareConfig.link += '&logid='+window.__logid;
		}
	};
	
	
	//各种上报赋值
	ItemDet.prototype.reports = function(){
		var obj = this;
		this.setShareConfig();
		JD.store.setHistory({type: '2',key:obj.skuId,refer:document.referrer, url: shareConfig.link, title: shareConfig.title, desc: ($('#priceSale').attr('price')||$('#priceSale').html()), img: shareConfig.img_url});
	};
	//各种上报赋值
	ItemDet.prototype.reportPV = function(){
		var obj = this,
		tmp = {sku:this.skuId, 
			skus:this.jdSkuIds.join(','),
			item:this.itemId,
			shop: this.venderId,
			category:this.item().category[0], 
			leaf:this.item().category[2], 
			isJD:this.venderId*1?1:2
		};
		var objMsgTimmer = setInterval(function(){
			if(window.ECC_cloud_report_pv){
				clearInterval(objMsgTimmer);
				objMsgTimmer = null;

				var jdPvLogobj = {sku_id:obj.skuId, category:'', leaf:obj.item().category.join('_'), vender_id: obj.venderId};
				if(window.jdPvLog){
					window.jdPvLog(jdPvLogobj);
				}else{
					window.ja_data=jdPvLogobj;
				}
			
				$.extend(FOOTDETECT.objMsgPv, tmp);
				ECC.cloud.report.pv(FOOTDETECT.objMsgPv);
			}

		}, 500);
	};
	
	//商品详情的tab
	ItemDet.prototype.setDetTab = function() {
		if(!this.tabInit) return;
		this.tabInit = false;
		var obj = this, isFunRun=true;
		this.sliderDetail = loopSrcoll.init({
			moveDom : $('#detailCont'),
			moveChild : $('#detailCont > div'),
			tab : $('#detailTab span'),
			viewDom:$('#detailCont'),
			//index : window.isRetina ? 1:3,
			index : 1,
			lockScrY:true,
			min : this.pageWidth, //这样就不会被滑动  只有点击事件
			//min : 100,
			step : Math.min(this.pageWidth, 640),
			fun : function(index) {
				//window.scroll(0,0);
				obj.showDetTab(index);
				if(!isFunRun){
					//$countRd(obj.tabRd[index]);
				}
				isFunRun = false;
			}
		});
	};
	
	//显示当前的部分
	ItemDet.prototype.showPart = function(part, func) {
		this.cpart = part, obj=this;
		var arr = ['main','address', 'tab', 'summary', 'yanbao','related'];
		if(part != 'main'){
			this.mainViewScroll = $(window).scrollTop();
			$('#jdBtmLogo').parent().hide();  //隐藏底部logo，防点透
		}else{
			$('#jdBtmLogo').parent().show();
		}
		setTimeout(function(){  //点透
			for (var i=0; i < arr.length; i++) {
			   arr[i] == part ? $('#part_'+arr[i]).show() : $('#part_'+arr[i]).hide();
			};
			if(part == 'tab'){
				obj.setDetTab();
				obj.setDetHeight();
			}
			part == 'main' ? window.scrollTo(0, obj.mainViewScroll) : window.scroll(0,0);
			if(func) func();
		}, 200);
	};
	
	//protal图的滚动
	ItemDet.prototype.setProtalImg = function(images){
		if(!images || images.length==0) return;
		var imgStr=[], tab=[], subfix = '//m.360buyimg.com/mobilecms/s750x750_';
		var wh = 'style="width:'+window._wb+'px; height:'+window._wb+'px;"';
		if(~(' 2g 2G 3g 3G ').indexOf(' '+this.network+' ')) subfix = '//img14.360buyimg.com/n7/';
		//var webp = $.os.android ? '.webp' : '';
		this.loopImg = [];
		for (var i=0; i < images.length; i++) {
			//if(!window.isRetina && i>=3) break;
			tab.push('<li></li>');
			var src = subfix+images[i];
			src = JD.img.getImgUrl(src);
			this.loopImg.push(src.replace(/\s+/g, ''));
		    if(this.isInit && i==0) continue;
		    imgStr.push('<li '+wh+'><img back_src="'+src+'"></li>');
		}
		
		$('#loopImgBar').html(tab.join(''));
		this.isInit ? $('#loopImgUl').append(imgStr.join('')) : $('#loopImgUl').html(imgStr.join(''));
		$('#loopImgUl').css({left:'0px'});  //去掉默认状态的left
		
		this.sliderProtal = loopSrcoll.init({
			tp : 'img', //图片img或是文字text
			//min : 5,
			loadImg:true,
			moveDom : $('#loopImgUl'),
			moveChild: $('#loopImgUl li'),
			tab:$('#loopImgBar li'),
			loopScroll:(this.loopImg.length > 1 ? true:false),
			lockScrY:true,
			imgInitLazy:1000,
			//enableTransX:true,
			index: 1,
			fun:function(index){
			}
		});
		
		if(images.length){
			window.shareConfig.img_url = this.protocol + '//img14.360buyimg.com/n4/'+images[0];
		}
	};
	
	//分发tab事件
	ItemDet.prototype.showDetTab = function(index) {
		var isChange = this.detIndex != index;
		if(!isChange) return;
		var st = $(window).scrollTop();
		this.detTabH = $('#detailBaseLine').offset().top;
		
		this.detIndex = index;
		if(index == 1) this.loadCommDet();
		if(index == 2) {
			this.loadCommParam();
			this.loadPackgeSer();
		}
		if(index == 3) {
			this.loadPackgeSer();
			if(this.isOverseaPurchase > 0){ //全球购商品
				$('#detail3Normal').hide();
				$('#detail3Global').show();
			}else{
				$('#detail3Normal').show();
				$('#detail3Global').hide();
			}
		}
		//if(index == 3 && this.isLoadDet[this.detIndex] != this.skuId) this.loadEval();

		if(st > this.detTabH && isChange) {
			window.scrollTo(0, this.detTabH+20);
			//document.getElementById('detailBaseLine').scrollIntoView(true);
		}
		this.setDetHeight();
	};

	//切换sku时 取对应的内容
	ItemDet.prototype.getTabData = function(){
		if(this.detIndex == 3){
			this.loadPackgeSer();
		}
		else if(this.detIndex == 2){
			this.loadCommParam();
			this.loadPackgeSer();
		}
		else if(this.detIndex == 1){
			this.loadCommDet();
		}
	};
	
	//获取拼购当前状态
	ItemDet.prototype.getPinggouStatus = function(){
		//if(isExp) return;
		var obj = this;
		window.pinggouStat = function(json){
			if(json.iRet == 9999){
				obj.login(location.href.replace(obj.baseSkuId, obj.skuId));
			}
			if(json.iRet != 0 || json.active_time_left < 0){
				return ;
			}
			obj.getAppPrice(obj.skuId);
			obj.pgStatus = json.tuan_status*1; //1:建团 2:快速入团 3:入好友团 4:已经参加了所有未满员团 5:活动满员 6:活动已过期 7:好友团已经满员 8:已经参加好友团 9:好友团已经过期

			obj.pgInfo = json;
			
			$('#priceMarket').hide();
			
			$('#priceTitle').html('<i class="icon_group"></i>');
			$('#priceGroupStyle').show().html(json.tuan_member_count+'人成团价');
			var note = '活动剩余时间:<span id="timeLimit"></span>';
			if(obj.pgStatus < 10) {
				$('#addCart2,#fav,#gotoShop,#gotoCart').hide();
				$('#buyBtn2').html(json.tuan_member_count+'人开团');
				$('#buyBtnExp').show().html('1人购买');
				if(obj.pgStatus > 3) $('#buyBtn2').addClass('btn_disable');
			}
			if(!obj.jdStatus) $('#buyBtn2,#buyBtnExp').addClass('btn_disable');
			switch(obj.pgStatus){
				case 2:
					note += '<br/>开团名额已达上限，您可以快速加入好友团';
				break;
				case 4:
					note += '<br/>您已参加过该商品下所有的拼团活动';
				break;
				case 6:
					note = '拼购活动已结束';
				break;
			}
			
			$('#statusNote').html(note);
			if(obj.pgStatus < 7) $('#statusNotice').show();
			if(obj.pgStatus < 6) obj.showLimit(json.active_time_left, function(){}); //6这个状态，固定显示拼购结束
		};
		ls.loadScript(['//wq.jd.com/pingou/GetTuanStatus?callback=pinggouStat',
			'sku_id='+this.skuId,
			'tuan_id='+(urlParam.getUrlParam('tuanid')||0),
			'active_id='+(urlParam.getUrlParam('activeid')||0),
			'platform='+(this.isWX ? 2 : 1),
			't='+Math.random()].join('&'));
	};
	
	ItemDet.prototype.getSkuPrice = function(json, areaSkuId){
		var obj = this;
		window.skuPrice = function(arr){
			var tmp = {"id":obj.skuId,"p":"0","m":"0","pcp":"0"};
			for (var i=0; i < arr.length; i++) {
			   if(arr[i].id == (obj.skuId) || arr[i].id == areaSkuId){
			       tmp = arr[i];
			       obj.getPCPrice(arr[i]);
			       break;
			   }
			};

			var p = tmp.p * 1 > 0 ? tmp.p : 0, m = tmp.m * 1 > 0 ? tmp.m : 0;
			if(!obj.cfee)obj.setP(p);
			if((obj.venderId*1 || obj.skuType==2 || obj.skuType==3) && obj.jdCategory[1] != '4855' && obj.jdCategory[1] != '6929'){ 
				$('#priceMarket').html(m ? ('&yen;'+m):'');
				if(m*100 > p*100){
					$('#priceDis').html((p*10/m).toFixed(1)+'折');
				}
			}

            //可以保留着  虽然视频已经过期了  但是特殊商品设置价格的时候  可以复用
	        if(window.is_xbox_yuyue && window.xbox_price){
	            $id('priceSale').innerHTML = window.xbox_price;
	            $id('priceMarket').innerHTML = window.xbox_price;
	        }
	        
			obj.setShareConfig();			
		};
		if(!json){
			var price = urlParam.getUrlParam('price');
		    obj.setP(price);
			ls.loadScript('//pe.3.cn/prices/pcpmgets?skuids='+this.skuId+'&origin='+(this.isWX?5:4)+'&source=wxsq&area='+this.jdAddrId.slice(0,3).join('_')+'&callback=skuPrice' + '&t='+Math.random());
			//ls.loadScript('//pe.3.cn/prices/mgets?skuids='+this.jdSkuIds.join(',')+'&origin='+(this.isWX?5:4)+'&area='+this.jdAddrId.slice(0,3).join('_')+'&callback=skuPrice' + '&t='+Math.random());
			//ls.loadScript('//qq.p.3.cn/prices/mgets?skuids=J_'+this.jdSkuIds.join(',J_')+'&origin=2&type=1&callback=skuPrice' + '&t='+Math.random());
		}
		else{
			window.skuPrice([json]);
		}
	};
	//批量价格  获取单一sku价格
	ItemDet.prototype.getSingleSkuPrice = function(sku){
		var obj = this;
		window.singlePrice = function(arr){
			obj.jdSkuInfo['price'+sku] = arr;
			var tmp = arr[0];
			for (var i=0; i < arr.length; i++) {
			   if(obj.jdSkuInfo['price']) obj.jdSkuInfo['price'].push(arr[i]);
			   if(arr[i].id == ('J_'+sku) || arr[i].id == sku){
			       tmp = arr[i];
			       break;
			   }
			};
			var p = tmp.p * 1 > 0 ? tmp.p : 0, m = tmp.m * 1 > 0 ? tmp.m : 0;
			obj.setP(p);
			if(obj.venderId*1) $('#priceMarket').html(m ? ('&yen;'+m):'');

	        if(window.is_xbox_yuyue && window.xbox_price){
	            $id('priceSale').innerHTML = window.xbox_price;
	            $id('priceMarket').innerHTML = window.xbox_price;
	        }
			obj.setShareConfig();
		};
		if(!this.jdSkuInfo['price'+sku]){
			ls.loadScript('//pe.3.cn/prices/pcpmgets?skuids='+sku+'&origin='+(this.isWX?5:4)+'&source=wxsq&area='+this.jdAddrId.slice(0,3).join('_')+'&callback=singlePrice' + '&t='+Math.random());
			//ls.loadScript('//qq.p.3.cn/prices/mgets?skuids=J_'+this.jdSkuIds.join(',J_')+'&origin=2&type=1&callback=skuPrice' + '&t='+Math.random());
		}
		else{
			window.singlePrice(this.jdSkuInfo['price'+sku]);
		}
	};

	ItemDet.prototype.getComboSkuPrice = function(skus){
		var obj = this;
		window.comboPrice = function(json){
			obj.jdSkuInfo['comboPrice'+json.sid] = json;
			if(json.p) obj.setP((json.p).toFixed(2));

		};
		if(!this.jdSkuInfo['comboPrice'+skus]){
			////jprice.360buy.com/contractsuit/主商品编号_商品编号1,商品编号2_省,市,县_站点_来源_CellPhone.setPromotion_html 
			ls.loadScript(['//jprice.360buy.com/contractsuit/'+this.skuId, skus, this.jdAddrId.slice(0,3).join(','),1, this.isWX?5:4,'comboPrice_html'].join('_'));
		}
		else{
			window.comboPrice(this.jdSkuInfo['comboPrice'+skus]);
		}
	};
	
	//批量价格  获取单一sku价格
	ItemDet.prototype.getAppPrice = function(sku){
		var obj = this;
		window.appPrice = function(arr){
			obj.jdSkuInfo['appPrice'+sku] = arr;
			var tmp = arr[0];
			for (var i=0; i < arr.length; i++) {
			   if(obj.jdSkuInfo['appPrice']) obj.jdSkuInfo['appPrice'].push(arr[i]);
			   if(arr[i].id == ('J_'+sku) || arr[i].id == sku){
			       tmp = arr[i];
			       break;
			   }
			};
			var p = tmp.p * 1 > 0 ? tmp.p : 0, m = tmp.m * 1 > 0 ? tmp.m : 0;
			
			if(obj.ispg){
				$('#priceExp').show().html('<div class="group_one"> <span class="tit"><i class="icon_group_one"></i></span> <span class="price">&yen;'+p+'</span> <span class="group">1人购买价</span></div>');
			}
		};
		if(!this.jdSkuInfo['appPrice'+sku]){
			//ls.loadScript('//pe.3.cn/prices/mgets?skuids='+sku+'&origin=2&area='+this.jdAddrId.slice(0,3).join('_')+'&callback=appPrice' + '&t='+Math.random());
			//ls.loadScript('//pe.3.cn/prices/pcpmgets?skuids='+sku+'&origin='+(this.isWX?5:4)+'&source=wxsq&area='+this.jdAddrId.slice(0,3).join('_')+'&callback=appPrice' + '&t='+Math.random());
			ls.loadScript('//p.3.cn/prices/mgets?skuids=J_'+sku+'&type=1&callback=appPrice&t='+Math.random());
		}
		else{
			window.appPrice(this.jdSkuInfo['appPrice'+sku]);
		}
	};

	//获取PC价格，展示微信手Q专享折扣信息
	ItemDet.prototype.getPCPrice = function(price){
		var priceWQDiscount = $("#priceWQDiscount");
		if(!price || !(price.p > 0) || !(price.pcp > 0)){
			return;
		}
        var obj = this,disCount = price.pcp - price.p;
        if(disCount > 0){
        	obj.isWX ? $('#wxSqTip').html('<i class="icon_tit_wx"></i>微信专享') : $('#wxSqTip').html('<i class="icon_tit_qq"></i>手Q专享');
        	$('#pcDesc').html("比电脑买省 &yen;" + disCount.toFixed(2));  
        	$('#wxSqTip').show();
        	$('#pcDesc').show();
        	priceWQDiscount.removeClass("hide");
        }
	};

	//获取QQ会员价
	ItemDet.prototype.showQQMemPrice = function(qqMemPrice){
		var obj = this;
		if(obj.isWX || !qqMemPrice) return;
		var price = $('#priceSale').attr('p');
		qqMemPrice = qqMemPrice.replace('¥','').replace('￥','');
		var disCount = (price*1 - qqMemPrice*1).toFixed(2).replace('.00','').replace('.0','');
		if(disCount > 0){
			var url = '//mc.vip.qq.com/qqwallet/index?aid=' + (obj.isAndroid ? 'mvip.pt.vipsite.cooperation_huiyuanjia':'mios.pt.vipsite.cooperation_huiyuanjia')+'&send=0&ADTAG=jd001';
			$('#priceTitle').html('手Q价：');
			$('#qqMemTip').html('<a class="tag_blue" ptag="7001.1.58" href="'+url+'">QQ会员再减 ¥'+disCount+' <span class="btn_open_qv">去开通/续费</span></a>');
			$('#headEval').hide();
			$('#qqMemTip').show();
			$('#evalQQMem').show();
			$("#priceWQDiscount").removeClass("hide");
		}
	};
	//微信端加入京致衣橱引流
	ItemDet.prototype.showDownJzBox = function(){
		var obj = this,nowTime = new Date().getTime(),endTime = new Date('2016/03/01 00:00:00').getTime();
		if(obj.isWX||nowTime>endTime) return;
		var jzCategory1 = obj.jdCategory[0],jzCategory3 = obj.jdCategory[2],downStr = ' 12062 9777 12060 9780 9778 9776 6912 12061 6906 12067 12068 12066 9781 9782 9783 6911 6910 6909 6908 6907 9775 9774 9772 9770 9769 6920 6918 6917 6916 6915 6914 12064 12063 12029 12030 12037 12038 12039 12018 9740 3982 12089 12001 12004 12002 12003 9742 9741 1350 1349 9724 9725 9737 9726 12005 9728 9729 9730 9731 9732 9733 9734 9735 9736 9739 9738 1348 9720 11993 11991 11989 11988 9705 9706 9707 9708 9710 9711 9712 9713 11987 9714 9715 9716 9717 9718 9719 9721 9722 11985 11986 3983 1356 1355 1354 12000 11999 11998 11996 9751 9749 9748 9747 9745 9744 9743 12013 12008 12009 12010 9753 12011 12012 12015 12006 1369 1368 1365 1364 12014 1371 12025 12021 1376 9790 9792 9793 9794 12022 12023 12024 12026 12027 12028 12123 12141 12142 12128 12130 9758 9760 9761 9768 9754 9755 12101 12100 9759 9756 9757 9762 9765 9764 9763 12106 9766 9767 12103 12104 12107 12105 12108 12120 12158 12159 12160 5154 1491 1489 12131 12127 12125 12132 12133 12134 12135 12136 12126 12137 12138 12139 12140 12129 12124 9187 12069 5260 5259 9188 9189 9190 9191 11934 11937 11936 11935 9186 12076 5271 5265 3997 3998 2589 2588 2580 12070 5256 5257 5258 12073 1455 2584 5262 12071 12072 2587 1362 1470 2632 1471 2690 3999 5263 13049 1452 4688 ';
		var wxDownStr = ' 12218 12259 12379 12473 12813 1320 1620 1713 4051 4052 4053 4938 6196 6233 6322 6325 652 670 6728 6994 737 911 9192 9570 9669 9847 9855 9987 ';
		if(((!obj.isWX) && downStr.indexOf(' '+jzCategory3+' ') < 0) || (obj.isWX && wxDownStr.indexOf(' '+jzCategory1+' ') < 0)) return;
		$('#downJzApp div.tip').html('领券去');	
		if(obj.isWX) $('#downJzApp >div.txt').html(' <i class="icon_zapp"></i>京致衣橱购买服饰类商品立减<span class="tag">20元</span>');
		$('#downJzApp').removeClass('hide');
		$('#downJzApp').on('click',function(){
			location.href = '//wqs.jd.com/item/jzcoupon.shtml?sku='+obj.skuId+'&category='+obj.jdCategory.slice(0,3).join('|');
		});
	};

	ItemDet.prototype.getPostPrice = function(data){   //传递库存数据
		var obj = this;
		if(obj.isExpByjd){  //满79免运费。
           	$('#postPrice').html('满79免运费');
           	obj.postTip = '<p style="text-align:left; font-size:12px;">钻石会员自营订单满59元(含)免运费，其他会员自营订单满79元(含)免运费，不足金额订单收取5元/单运费</p>'+((obj.item().spAttr && obj.item().spAttr.PianYuanYunFei=='1') ? '<p style="text-align:left; font-size:12px;">部分商品因体积或重量超过限制，需加收5元/件的超重超大附加运费</p>':'');
           	$('#ziYingPost').show();
        } else{    //pop商品
        	$('#ziYingPost').hide();
        	if(!data||!data.Dc) return;
        	var dtype0,dcash0,ordermin0,json=data.Dc;
			if(json && json.length > 0 ){
				dtype0 = json[0].dtype;
				dcash0 = json[0].dcash;
				ordermin0 = json[0].ordermin;
				var postPop = '';
	        	switch(dtype0){   //收费类型int 不为空，0.固定，1.满额，2.单品在线支付，3.单品货到付款
	                case 0:
	                	postPop = (dcash0 > 0) ? ('运费' + dcash0 + '元') : '免运费';       	
	                	break;
	                case 1:
	                case 2:
	                case 3:
	                	if(dcash0 > 0 && ordermin0 > 0){
	                		var price = $('#priceSale').attr('p');
	                		if(price){    //价格不存在，则不做任何处理
	                			if(price < ordermin0){
	                				obj.postTip = '<p>店铺单笔订单满'+ ordermin0 + '元，免运费</p>';
	                				postPop = '运费' + dcash0 + '元'+'<span class="de_icon_btn" id = "postIcon" ptag="7001.1.51"><i class="icon_s_addr"></i></span>';
	                			}	
	                			else{
	                				postPop = '免运费';
	                			} 
	                		}
	                	}
	                	else if(ordermin0 == 0){
	                		postPop = dcash0 > 0 ? ('运费' + dcash0 + '元') : '免运费'; 
	                	}
	                	else if(dcash0 == 0){
	                		postPop = '免运费';
	                	}
	                	break;
	                default:    
	                	break;
	        	}
	        	$('#postNotice4').html(postPop ? (' '+postPop) : '');
			}
        }
	};
	
	//批量价格  获取一次
	ItemDet.prototype.getSkuDesc = function(){
		var obj = this;
		window.skuDesc = function(arr){
			obj.jdSkuInfo['desc'] = arr;
			var tmp = {"ad":""};
			for (var i=0; i < arr.length; i++) {
			   if(arr[i].id == ('AD_'+obj.skuId) || arr[i].id == (obj.skuId)){
			       tmp = arr[i];
			       break;
			   }
			};
			$('#itemDesc').html(tmp.ad.replace(/<.*?>/ig, ''));
		};
		if(!this.jdSkuInfo['desc']){
			ls.loadScript('//ad.3.cn/ads/mgets?skuids=AD_'+this.jdSkuIds.join(',AD_')+'&areaCode='+this.jdAddrId.slice(0,3).join('_')+'&callback=skuDesc' + '&t='+Math.random());
		}
		else{
			window.skuDesc(this.jdSkuInfo['desc']);
		}
	};

	ItemDet.prototype.setHeyueStat = function(){
		this.setHeyueStatNew();
		return;
		if(this.cfee && this.cfee.ft != 100){
			$('#buyBtn2').html(this.getFeeBtnStr(this.cfee.ft));
			//$('#btnTools').addClass('btn_wrap_nocart');
			$('#addCart2').hide();
		}
		else{
			$('#buyBtn2').html('立即购买');
			//$('#btnTools').removeClass('btn_wrap_nocart');
			$('#addCart2').show();
		}
	};
	ItemDet.prototype.setHeyueStatNew = function(){
		if(this.cfeeType && this.cfeeType.ft != 100){
			$('#buyBtn2').html(this.getFeeBtnStr(this.cfeeType.ft));
			$('#addCart2').hide();
		}
		else{
			$('#buyBtn2').html('立即购买');
			$('#addCart2').show();
		}
	};
	ItemDet.prototype.getFeeBtnStr = function(ft){
		if(ft == 18) return '选择套餐';
		if(ft == 100) return '立即购买'; //有可能是抢购之类的  要自定义
		return '选择套餐和号码';
	};

	ItemDet.prototype.setP = function(p){
		this.jdPrice = p;
		$('#priceSale').html( p ? ('&yen;' + p) : '暂无定价');
		$('#priceSale').attr('price', $('#priceSale').html());
		$('#priceSale').attr('p', p);
	};

/*
状态1：按钮：立即预约/1分钱预约/1元钱预约，灰色不可点；文案：距预约开始还有：**
状态2：按钮：立即预约/1分钱预约/1元钱预约，可点；文案：已有***人成功预约！
状态3：按钮：立即抢购，灰色不可点；文案：距抢购开始还有：**，已有***人成功预约！
状态4：按钮：立即抢购，可点；文案：距抢购结束还有：**，已有**人成功抢购！ 或  状态4：按钮：立即抢购，灰色不可点；文案：预约期已过！您没有预约，无法抢购！
状态5：按钮：立即购买，灰色不可点；文案：抢购活动已结束。已有**人成功抢购！


state;状态吗：1预约未开始，2预约进行中，3预约已结束  4抢购中，5抢购结束
*/
	ItemDet.prototype.yuShou = function(){
		var obj=this, limit=0, btnStr=this.cfee&&this.cfee.ft!=100 ? '选择套餐和号码' : '';
		$('#buyBtn2').removeClass('btn_blue');
		window.yushouJDCB = function(json){
			if(obj.timeout.itil17){
				obj.delTimeout('itil17');
				JD.report.umpBiz({bizid:'25',operation:'17',result:'0',source:'0',message:'item yushou api success'});
			}
			obj.jdStatus = false;
			if (json.type == 2) { //预售的  暂不支持
				$('#statusNotice').show();
				$('#statusNote').html('此商品已经售完');
				$('#buyBtn2').addClass('btn_disable');
				return;
			};
			var note = '';
			obj.yushouStatus = json.state;
			$('#buyBtn2').html('立即预约');
			$('#statusNotice').hide();
			limit = json.d;

			switch(obj.yushouStatus){
				case 0:
					note = '预约还没有开始';
					$('#buyBtn2').addClass('btn_disable');
				break;
				case 1:
					note = '距预约开始还有：limit';
					$('#buyBtn2').addClass('btn_disable');
				break;
				case 2:
					note = '已有'+json.num+'人成功预约！';
					$('#buyBtn2').removeClass('btn_disable').addClass('btn_blue');
					obj.jdStatus = true;
				break;
				case 3:
					note = limit < 0 ? '开抢时间：敬请期待' : '距抢购开始还有：limit';
					$('#buyBtn2').addClass('btn_disable').html(btnStr||'立即抢购');
				break;
				case 4:
					obj.jdStatus=true, note = '距抢购结束还有：limit';
					if(obj.cfee && obj.cfee.ft != 100) obj.setHeyueStat(); // 合约秒杀的时候要设置一下
					
					if(obj.item().attr.indexOf('isKO') != -1){  //这里还要看看是不是在抢购状态中
						//obj.qianggou(true);
						obj.qianggou();
						return;
					}
					else{
						$('#buyBtn2').removeClass('btn_disable').html(btnStr||'立即抢购').addClass('btn_blue');  //这里是预约的抢购
						obj.getSkuStock();
					}
				break;
				case 5: 
					note = '抢购活动已结束。<br/>已有'+json.num+'人成功抢购！';
					$('#buyBtn2').addClass('btn_disable').html(btnStr||'立即购买');
				break;
				default://有yushou标志，但是已经开放购买，此时返回{"error":"pss info is null"}
					note = '活动已结束，请等待开放正常购买';//不展示提示
					$('#buyBtn2').addClass('btn_disable').html(btnStr||'立即购买');
				break;
			}
			$('#statusNote').html(note.replace('limit','<span id="timeLimit"></span>'));
			if(note.indexOf('limit') > -1) obj.showLimit(limit, function(){ obj.yuShou(); });
			if(note) $('#statusNotice').show();
			// if(obj.yushouStatus == 2){
			// 	ls.loadScript('//wq.jd.com/bases/yuyue/itemstate?callback=yushouWGCB&skuid='+obj.skuId+'&source='+(obj.isWX?1:2));
			// }
		};

		window.yushouWGCB = function(json){
			//if(json.errCode != "0" || !json.data.sale_start_time) {  //没有抢购时间的话  也不让预约
			if(json.errCode != "0") {  //没有抢购时间的话  也不让预约
				obj.jdStatus = false;
				$('#buyBtn2').addClass('btn_disable').html('立即预约');
				return;
			}
			obj.jdStatus = true;
			var data = json.data;
			obj.yushouInfo = data;
			if(data.rest_seconds <= 0){
				obj.jdStatus = false;
				$('#buyBtn2').addClass('btn_disable');
				obj.yushouStatus = 3;
				$('#statusNote').html('开抢时间：'+(data.sale_start_time || '敬请期待'));
				$('#buyBtn2').addClass('btn_disable').html(btnStr||'立即抢购');
			}
			else{
				$('#buyBtn2').removeClass('btn_disable').addClass('btn_blue');
				if(json.data.amount > 0) $('#buyBtn2').html(data.amount=='0.01'? '1分钱预约': (data.amount.replace('.00','')+'元预约'));
			}
		};

		if(obj.skuJson[obj.skuId].yuyue){
			window.yushouJDCB(obj.skuJson[obj.skuId].yuyue);
		}else{
			obj.createTimeout('17','item yushou api fail'+obj.skuId);
			ls.loadScript('//yushou.jd.com/youshouinfo.action?callback=yushouJDCB&sku='+this.skuId + '&t='+Math.random());
		}
	};

	/**
	 * 预售商品
	 * type: "2", 预售类型 (1.预约，2.预售)
	 * ret: {
	 *		d: 415283, 剩余时间(秒)
	 *		dt: "2014-07-11 17时", 发货时间
	 *		w: "1156323873", 商品编号
	 *		cp: "9.90", 当前价格
	 *		t: 1, 预售阶梯类型 (预售类型：1-一阶梯，2-三阶梯)
	 *		s: 1, 预售状态 (0:预售未开始,1:预售进行中,2:预售结束，待付尾款,21:第一次发送短信,3:尾款进行中,31:第二次发送短信状态,4:尾款结束,41:清理违约会员状态)
	 *		pm: "1.00", 定金金额
	 *		url: "//cart.jd.com/cart/dynamic/presale.action?pid=1156323873&pcount=1&ptype=1", 跳转购物车url
	 *		cc: 9967, 预订人数
	 *		cs: 1, 当前所处阶梯
	 *		sa: [{c: 1,m: "1499.00"},{c: 30,m: "1399.00"},{c: 50,m: "1299.00"}]  //三阶梯出现
	 *	}
	 */
	ItemDet.prototype.yuShouNoWay = function(){
		var obj = this;
		window.yushouNoWayJDCB = function(json){
			if (json.type == 1) {  //预约
				return;
			}
			var ret = json.ret||{},ysPrice = (ret.cp*1).toFixed(2),pmPrice=(ret.pm*1).toFixed(2);
			if(ret.expAmount > 0){
				ysPrice = (ret.oriPrice*1).toFixed(2);
				var extPrice = (ret.expAmount*1).toFixed(2),pmExtPrice = (pmPrice*1+extPrice*1).toFixed(2);
				$('#popSale').html('<span>定金可抵&yen;'+pmExtPrice+'</span>').show().off().on('click',function(){
					obj.createPopup({flag:3,str:'<p style="text-align:left; font-size:12px;">支付定金'+pmPrice+'元,可以抵'+pmExtPrice+'元使用。优惠后，尾款只需要支付'+(ysPrice*1-pmExtPrice*1).toFixed(2)+'元</p>'});
				});
			}
			$('#ysPrice1').html('&yen;' + ysPrice);
			$('#ysPrice2').html('&yen;' + pmPrice);
			if(ret.t == 1){  //预售- 一阶梯

			}else{  //三阶梯
				var ysStepShow = $('#ysStepShow'),
					steps = ysStepShow.children('span');
				for(var i = 0, l1 = ret.sa.length, l2 = steps.length; i < l1 && i < l2; ++i){
                    var step = $(steps[i]), 
                    price= ret.hidePrice && l2==3 && i==2 && i != ret.cs - 1 ? '???' : ret.sa[i].m; //有隐藏需求、有三梯队价格  并且当前是第一二梯队时，第三梯队价格才隐藏
                    step.html('满' + ret.sa[i].c + '人&yen;' + price);
					if(i == ret.cs - 1){
						step.addClass('on');
					}
				}
				ysStepShow.show();
			}
			obj.yuShouNoWayStatus = ret.s;
			obj.jdStatus = true;
			switch(ret.s){
				case 0 :  //预售未开始
					obj.jdStatus = false;
					$('#buyBtn2').addClass('btn_disable');
					break;
				case 1 : //预售进行中

					break;
				case 4 : //尾款结束
				case 41 :  //清理违约会员状态
					obj.jdStatus = false;
					$('#buyBtn2').addClass('btn_disable');
				case 2 : //预售结束，待付尾款
				case 21 : //第一次发送短信
				case 3 : //尾款进行中
				case 31 : //第二次发送短信状态
					$('#buyBtn2').html('支付尾款');
					break;
				default :
					break;
			}
			if(ret.s == 0){
				var dd = ret.d,
					d = parseInt(ret.d / 86400, 10);
				dd = dd - d * 86400;
				var h = parseInt(dd / 3600, 10);
				dd = dd - h * 3600;
				var m = parseInt(dd / 60, 10);
				var str =  d + '天' + h + '小时' + m + '分';
				$('#statusNote').text('离预售开始还有：' + str);
				$('#statusNotice').show();
			}else{
				$('#statusNote').html('已有 ' + ret.cc + ' 人支付定金 <br/>预计发货时间：' + ret.dt);
				$('#statusNotice').show();
			}
			obj.getSkuStock();
		};
		ls.loadScript('//yushou.jd.com/youshouinfo.action?callback=yushouNoWayJDCB&sku='+this.skuId + '&t='+Math.random());
	};
	
	ItemDet.prototype.qianggou = function(is_Yushou_KO){
		(new Image).src = '//wq.jd.com/deal/miao/IsMiao?callback=aa&skuid='+this.skuId + '&t='+Math.random();
		var obj=this, limit=0, btnStr=this.cfee&&this.cfee.ft!=100 ? this.getFeeBtnStr(this.cfee.ft) : '立即抢购';
		this.jdStatus=false;
		window.qiangCB = function(json){
			if(obj.timeout.itil18){
				obj.delTimeout('itil18');
				JD.report.umpBiz({bizid:'25',operation:'18',result:'0',source:'0',message:'item miao api success'});
			}
			obj.miaoErr = {errId : json.errId, errMsg : json.errMsg};
			$('#statusNotice').show();
			$('#buyBtn2').addClass('btn_disable').html(btnStr);
			if(json.isKo == 0 && json.errId != '16385') {
				obj.koStatus = 3;
				$('#statusNote').html('活动已结束，请等待开放正常购买');
				return;
			}
			var limit = 0, stat=1;
			if(json.startTime - json.serverTime > 0){
				if(is_Yushou_KO) return;
				$('#statusNote').html('离抢购开始还有：<span id="timeLimit"></span>');
				limit = json.startTime - json.serverTime;
			}
			else if(json.endTime - json.serverTime > 0 || json.errId == '16385'){
				obj.jdStatus = true;
				obj.koStatus = 2;
				stat=2;
				$('#statusNote').html('抢购时间还剩：<span id="timeLimit"></span>');
				$('#buyBtn2').removeClass('btn_disable').html(btnStr).addClass('btn_blue');
				limit = json.endTime - json.serverTime;
				obj.getSkuStock();
				if(json.errId == '16385'){$('#statusNotice').hide();}
			}
			else{
				if(is_Yushou_KO) return;
				obj.koStatus = 3;
				$('#statusNote').html('活动已结束，请等待开放正常购买');
			}
			var setstatus = function(){
				if(limit) obj.showLimit(limit, function(){
					if(stat == 1){  //倒计时结束    1换2的过程
						$('#statusNote').html('抢购时间还剩：<span id="timeLimit"></span>');
						$('#buyBtn2').removeClass('btn_disable').html(btnStr).addClass('btn_blue');

						obj.jdStatus = true;
						obj.koStatus = 2;
						stat = 2;
						limit = json.endTime - json.startTime;
						setstatus();
					}
					else if(stat == 2){  //抢购倒计时结束  结束是有状态
						obj.jdStatus = false;
						$('#statusNote').html('活动已结束，请等待开放正常购买');
						$('#buyBtn2').addClass('btn_disable').html(btnStr);
					}

				}, 300);
			};
			setstatus();
		};
		
		if(this.skuJson[this.skuId].miao){
			qiangCB(this.skuJson[this.skuId].miao);
		}
		else{
			obj.createTimeout('18','item miao api fail'+obj.skuId);
			ls.loadScript('//wq.jd.com/deal/miao/IsMiao?callback=qiangCB&skuid='+this.skuId + '&t='+Math.random());
		}
	};

	ItemDet.prototype.showLimit = function(limit, fun, fen){
		var obj = this;
		if(limit < 0) {
			$('#statusNotice').hide();
			return;
		}
		if(limit > 3600*24) {
			$('#timeLimit').html(parseInt(limit/(3600*24)) + '天');
		}
		else if(fen && limit>fen){ //几分钟（3600秒）内的倒计时  
			$('#timeLimit').html((limit<3600 ? '': (parseInt(limit/3600)+'小时')) + parseInt(limit%3600/60) + '分');
		}
		else if(limit > 3600){
			$('#timeLimit').html(parseInt(limit/3600) + '小时');
		}
		else{
			var t = limit;
			clearInterval(obj.timmer);
			obj.timmer = null;
			obj.timmer = setInterval(function(){
				t--;
				if(t<=0) {
					clearInterval(obj.timmer);
					obj.timmer = null;
					fun();
				}
				else{
					$('#timeLimit').html((t<60?'':(parseInt(t/60)+'分')) + (t%60)+ '秒');
				}
			},1000);
		}

	};
	//获取促销的具体数据，单条展示，多条收起
	ItemDet.prototype.showPromotion = function(data){
		var obj=this, jsonData = {},htmlArr=[],tpl1 = $id('promoteGroupTpl').text,giftArr=[],tpl2=$id('promoteGiftTpl').text,iconHtml='';
		function getNewUserLevel(e){  //会员特价，显示会员身份
			switch(e){case -1:return '未注册';case 50:case 59: return '注册';case 56:return '铜牌';case 60:case 61:return '银牌';case 62:return '金牌';case 63:return '钻石';case 64:return '经销商';case 110:return 'VIP';case 66:return '京东员工';case 88:case 103:case 104:case 105:return '钻石';case 90:return '企业';}return '未知';
		}
		window.promotionCB = function(json){
			if(!json || !json[0] || !json[0]['pis']) return;
			if(!obj.jdSkuInfo['promote']) obj.jdSkuInfo['promote'] = {};
			obj.jdSkuInfo['promote'][obj.skuId] = json;
			var promTip = {'1':'会员特价','2':'直降','3':'限购','4':'京豆优惠购','6':'赠券','7':'赠京豆','9':'限制',
							'10':'赠品','11':'封顶','15':'满减','16':'满送','17':'加价购','18':'满赠','19':'多买优惠',
							'20':'团购','21':'京东帮','22':'QQ会员价','23':'跨店铺满免（满四减一）'},
				promTags = ['1','2','3','4','6','7','9','10','11','15','16','17','18','19','20','21','22','23'],  //促销类型：无促销类型0; 单品促销1; 赠品促销4; 套装促销6; 满增满返10; 封顶15;
				promos = json[0]['pis'],item={},itemContent={},tagTypes=[],content='',conArr=[],tag='',idNo='n_',pid=[],specIds=[],tagName='',itemLen = 0;//满减跳转链接
				function getFullFreeUrl(flag,category3){//http://pmp.jd.com/requirement/info/b9f0628c6ee20607
					var womenWXTime1 = [new Date('2016/03/01 00:00:00').getTime(),new Date('2016/03/04 23:59:59').getTime()],
						womenWXTime2 = [new Date('2016/03/05 00:00:00').getTime(),new Date('2016/03/08 23:59:59').getTime()],
						otherTime = [new Date('2016/03/01 00:00:00').getTime(),new Date('2016/03/08 23:59:59').getTime()],
						url = '',nowTime = new Date().getTime();
					var clothStr = ' 9708 9710 9712 9713 9711 9714 9715 9717 9718 9719 9720 9722 9721 9723 11985 11986 11988 11991 12000 1354 1355 1356 1364 9743 1371 9747 1365 9751 9748 9749 12008 12009 12011 12013 9753 12006 12010 9790 9789 9792 9794 12021 12023 12024 12025 12030 12034 12037 9772 6914 6916 6917 9769 9774 9778 6915 6918 12061 12062 12063 12064 ';
					var fashionStr = ' 4698 5266 12078 11935 11934 9191 9190 9189 9188 9187 9186 12091 12092 6188 6189 6190 6191 6192 6193 13069 6195 6161 6162 6163 6164 6165 6166 6147 13101 13065 6148 6149 6150 13063 13064 13065 13067 13068 6156 6157 6158 13070 6159 11238 6168 6169 6170 6173 6175 6177 6176 6178 6180 6183 6185 6187 6179 6181 6184 6186 13071 13072 13073 13074 13075 13076 13078 13077 12043 12044 12045 12046 12047 12048 12049 12050 12051 12053 12054 12055 12056 12057 12058 2589 3997 3998 5271 2588 5257 5258 5259 2580 5260 5256 12069 12070 ';
					if(~clothStr.indexOf(' '+category3+' ')){// 女人节微信（服饰类目）
						if(flag){
							url = (nowTime > womenWXTime1[0] && nowTime < womenWXTime1[1] ? '//wqs.jd.com/promote/201602/womenday/clothzhu.shtml?ptag=38977.1.1':(nowTime > womenWXTime2[0] && nowTime < womenWXTime2[1] ? '//wqs.jd.com/promote/201602/womenday/clothzhuhot.shtml?ptag=38977.1.1':false));
						}else{
							url = (nowTime > otherTime[0] && nowTime<otherTime[1] ? '//wqs.jd.com/promote/201602/sqwomanday/index.shtml?ptag=38977.1.3':false);
						}
					}else if(~fashionStr.indexOf(' '+category3+' ')){//女人节微信（时尚类目）
						url = (nowTime > otherTime[0] && nowTime<otherTime[1] ? (flag ? '//wqs.jd.com/promote/201602/womenday/index_fashion.shtml?ptag=38977.1.2':'//wqs.jd.com/promote/201602/sqwomanday/index.shtml?ptag=38977.1.3'):false);
					}
					return url;
				}
			for(var i=0;i<promos.length;i++){
				item = promos[i];
				if(item.etg && ~item.etg.indexOf('11'))  continue;//大家电可议价 屏蔽
				tagTypes = [];
				for(var key in item){
					if(promTags.indexOf(key) > -1){
						tagTypes.push(key);
					}
				}
				pid = (item['pid'] ? item['pid'].split('_'):[]);
				if(pid[1] == '10') obj.promoteTag10++;
				itemLen += tagTypes.length;
				for(var j=0;j<tagTypes.length;j++){
					idNo='n_';
					tag = tagTypes[j];
					if(obj.isAd && (tag=='23' || (item['etg'] && (item['etg'].indexOf('4') > -1)))) continue;//广告屏蔽跨店铺满减屏蔽
					tagName = promTip[tag];
					content = item[tag].replace(/\.00/g,'').replace(/\.0/g,'');
					conArr = (content.indexOf('!@@!') > -1 ? content.split('!@@!') : []);
					switch(tag){
						case '1':
							tagName = '会员特价'; 
							if(login.isLogin() && conArr.length > 0){ 
								if(json[0].hit=='1'){ //命中
									content = '您享受' + (conArr[0]*1 > 1000 ? '店铺VIP价: ¥':(getNewUserLevel(conArr[0]*1)+'会员价: ¥')) + conArr[1];
								}else{  //未命中
									content = '成为'+ (conArr[0]*1 > 1000 ? '店铺VIP，':(getNewUserLevel(conArr[0]*1)+'会员，')) +'可享受会员价，最低¥'+ conArr[1]+'起';
								}
							}else{  //未登录
								content = '请登录后确认是否享受优惠';
							}
							if(content.indexOf('未知') > -1) itemLen--;
						break;
						case '10':
							giftArr = [];
							var giftNum = 0;
							try{
								content = JSON.parse(conArr.length > 0 ? conArr[0]:content);
							}catch(e){
								break;
							}
							//赠品可点击，进商详
							for(var k=0;k<content.length;k++){
								itemContent = content[k];
								if(itemContent.gt=='2'){ //gt:赠品类别,1-附件、2-普通赠品、4、满返满赠赠品   注意4目前没有，1显示到包装里面
									jsonData.link = '//wq.jd.com/item/view?sku=' + itemContent['sid'];
									jsonData.giftImg = itemContent['mp'] ? '//img13.360buyimg.com/n5/'+itemContent['mp'] : '//misc.360buyimg.com/product/skin/2012/i/gift.png';
									jsonData.giftName = itemContent['nm'];
									jsonData.giftDesc = 'x '+ itemContent['num'];
									giftArr.push($jsonToTpl(jsonData, tpl2));
									giftNum++;
								}
							}
							if(giftNum>0){
								iconHtml = '<em class="hl_red_bg">赠品</em>' + iconHtml;
								$('#promoGiftEm').html('<em class="hl_red_bg">赠品</em><em class="hl_red">赠下方的热销商品，赠完即止'+(conArr.length > 0 ? ('，'+conArr.slice(1).join('，')):'')+'</em>');
								$('#promoGiftItem').html(giftArr.join(''));
								$('#promoGift').show();
							}else{
								itemLen--;
							}
						break;
						case '15': case '23':
						    var nowTime = new Date().getTime();
							if(tag=='23' || (item['etg'] && (item['etg'].indexOf('4') > -1))){ // pop跨店铺满减4
								if(item['st']*1000 < nowTime){  
									tagName =  (tag=='23' ? '跨店铺满免':'跨店铺满减'); //已开始则显示 【跨店铺满减进行中】满xx减xx..
									jsonData.emRedBg = '<em class="hl_red_bg">'+tagName+'</em>' + '<span class="hl_yellow_bg">进行中</span>';
								}else{
									var stTime = new Date(item['st']*1000);
									tagName =  '活动预告'; 
									content = (stTime.getMonth()+1) + '月' + stTime.getDate() + '日'+ (stTime.getHours() < 10 ? '0'+stTime.getHours() : stTime.getHours()) +':'+ (stTime.getMinutes() < 10 ? '0'+stTime.getMinutes() : stTime.getMinutes()) + '该商品参加跨店铺满'+(tag=='23' ? '免':'减')+'活动，' +content;
									jsonData.emRedBg = '<em class="hl_red_bg">'+tagName+'</em>';
								}
							}
							if(tag=='23'){
								iconHtml = '<em class="hl_red_bg">' + tagName + '</em>' + iconHtml;
								jsonData.link = 'javascript:void(0);';
								jsonData.no = 'n_' +i+(j+1);
								jsonData.emSpan = '<span>'+content +'</span >';
								$('#promShopFullfree').append($jsonToTpl(jsonData, tpl1)).show();
							}
							idNo = 's_';
						break;
						case '22':  //QQ会员价
							obj.showQQMemPrice(content);
							itemLen--;
						break;
						case '16': case '17': case '18': case '19':
							idNo = 's_';
						break;
						default:
						break;
					}
					if(tag != '10' && tag != '22' && tag != '23'&&(content.indexOf('未知')==-1)){
						iconHtml += '<em class="hl_red_bg">' + tagName + '</em>';
						jsonData.link = 'javascript:void(0);';
						if(pid[0] && idNo == 's_'){
							jsonData.link = '//wq.jd.com/search/searchpr?ptag=7001.1.7&promotion_aggregation=yes&activity_id=' + pid[0] + '&pro_d='+(encodeURIComponent(tagName)) + '&pro_s='+(encodeURIComponent(content));
							//if(pid[0]==='2374556426') jsonData.link = (getFullFreeUrl(obj.isWX,obj.jdCategory[2])||jsonData.link);
							specIds.push('promo_item_pos_'+i+(j+1)); // 用于控制特殊促销可点
						}
						jsonData.no = idNo +i+(j+1);
						jsonData.emRedBg = '<em class="hl_red_bg">'+tagName+'</em>';
						jsonData.emSpan = '<span>'+content +'</span >';
						htmlArr.push($jsonToTpl(jsonData, tpl1));
					}
				}
			}
			$('#promoteList').html(htmlArr.join(''));  //促销里面增加item	
			//控制特殊类型的可点
			for(var i=0;i<specIds.length;i++){
				$('#'+specIds[i]).show();
			}
			if(itemLen > 0){   //促销里面有内容
				obj.iconHtml += iconHtml;
				$('#promoteList').show();
			}else{
				$('#promoteList').hide();
			}
			
		};
		if(data && data[0] && data[0]['pis']){
			obj.setDelayTime();
			window.promotionCB(data);
			obj.setPromoteTitle();
		}
	};

	//获取促销的具体数据，单条展示，多条收起
	ItemDet.prototype.showPromoteData = function(data){
		var itemsArr = data.promotionsItemsArr,itemsArrLen=itemsArr.length, itemsType10Arr = data.promotionsItemsType10Arr,
			type10ArrLen = itemsType10Arr.length, type10PromoId = data.promoId,giftsArr=data.giftsItemsData,tips=data.tips,
		    pointId='', jsonData = {no:0,link:'',emRedBg:'',emSpan:''},htmlArr=[],tpl1 = $id('promoteGroupTpl').text,
		    giftData={link:'',giftImg:'',giftName:'',giftDesc:''},tpl2=$id('promoteGiftTpl').text,iconHtml='',itemLen = 0;
		if(!this.jdSkuInfo['promote']) this.jdSkuInfo['promote']={1:1};
		this.jdSkuInfo['promote'][this.skuId] = data;
		//首先获取非10类型的促销
		for(var i=0;i<itemsArrLen;i++){
			var _item = itemsArr[i],_tmpItem = _item.split('</em>'),_proD = '',_proS = '';
			if(_item.indexOf('赠品')!=-1){
				iconHtml = _item + iconHtml;//赠品永远放在最前面显示
				$('#promoGiftEm').html(_item);
				$('#promoGift').show();
				itemLen++;
				continue;
			}
			if(_tmpItem.length > 1){
				_proD = _tmpItem[0].slice(_tmpItem[0].indexOf('hl_red_bg">')+11);
				for(var j=1;j<_tmpItem.length;j++){
					_proS += _tmpItem[j].slice(_tmpItem[j].indexOf('hl_red">')+8);
				}		
			}
			iconHtml += _item;
			jsonData.no = i+1;
			jsonData.link = 'javascript:void(0);';
			jsonData.emRedBg = '<em class="hl_red_bg">'+_proD+'</em>';
			jsonData.emSpan = '<span>'+_proS+'</span >';
			htmlArr.push($jsonToTpl(jsonData, tpl1));
		}
		iconHtml += itemsType10Arr.join('');
		if(type10PromoId.length == type10ArrLen){
			for(var i=0;i<type10ArrLen;i++){
				var itemType10 = itemsType10Arr[i],tmpType10 = itemType10.split('</em>'),proD = '',proS = '';
				//取出'<em class="hl_red_bg">赠品</em><em class="hl_red">赠下方的热销商品，赠完即止</em>'的文字部分
				if(tmpType10.length > 1){
					proD = tmpType10[0].slice(tmpType10[0].indexOf('hl_red_bg">')+11);
					for(var j=1;j<tmpType10.length;j++){
						proS += tmpType10[j].slice(tmpType10[j].indexOf('hl_red">')+8);
					}
					if(proD=='满减'){
						proS = '活动商品'+proS;
					}			
				}
				jsonData.no = i+itemsArrLen+1;
				jsonData.link = '//wq.jd.com/search/searchpr?ptag=7001.1.7&promotion_aggregation=yes&activity_id=' + type10PromoId[i] + '&pro_d='+(encodeURIComponent(proD)) + '&pro_s='+(encodeURIComponent(proS));
				jsonData.emRedBg = '<em class="hl_red_bg">'+proD+'</em>';
				jsonData.emSpan = '<span>'+proS+'</span >';
				htmlArr.push($jsonToTpl(jsonData, tpl1));//对于满减、加价购等促销类型为10的商品单独操作
			}
		}
		$('#promoteList').html(htmlArr.join(''));  //促销里面增加item
		itemLen += htmlArr.length;
		(this.iconHtml) && (itemLen++);  //是否已经有优惠套装
		//控制10类型的可点
		for(var i=itemsArrLen+1;i<itemsArrLen + type10ArrLen+1;i++){
			pointId = '#promo_item_po' + i;//需要控制icon的显示
			$(pointId).show();
		}
		htmlArr = [];
		//赠品可点击，进商详
		for(var i=0;i<giftsArr.length;i++){
			var item = giftsArr[i];
			giftData.link = '//wq.jd.com/item/view?sku=' + item.skuId;
			giftData.giftImg = item.imagePath ? '//img13.360buyimg.com/n5/'+item.imagePath : '//misc.360buyimg.com/product/skin/2012/i/gift.png';
			giftData.giftName = item.name;
			giftData.giftDesc = 'x '+ item.number;
			htmlArr.push($jsonToTpl(giftData, tpl2));
		}
		$('#promoGiftItem').html(htmlArr.join(''));

		tips = tips.replace(/<.*?>/ig, '').replace(/\s/ig, '');
		if(itemLen > 0){   //促销里面有内容
			iconHtml = iconHtml.replace(/<br\/>|<br>/g, '');
			this.iconHtml += iconHtml;
			$('#promotePanel').show();
		}
		else{
			$('#promotePanel').hide();
		}

		if(tips && !this.promoteTips[tips]){
			if(~tips.indexOf('东券') || ~tips.indexOf('京券')){ //不能使用
				$('#outServiceNote').append('<div class="item"><div class="label"><i class="icon_service icon_coupon"></i><div class="txt">' + tips + '</div></div></div>');
			}else{
				$('#outServiceNote').append('<div class="item"><div class="label"><div class="txt">' + tips + '</div></div></div>');
			}
			$('#outService').show();
			this.promoteTips[tips] = true;
		}
		
		this.setPromoteTitle();
	};
	
	ItemDet.prototype.setPromoteTitle = function(){
		if(!this.iconHtml) return;
		var tipProm = '可享受以下促销';
		if(this.promoteTag10 > 1){
			tipProm = '以下促销活动可在购物车内进行切换选择';
			$('#promote').addClass('de_c_red').removeClass('de_span');
		} 
		$('#promote').html(tipProm);
		$('#promoteIcon').removeClass('icon_point_drop').addClass('icon_point_up');
		$('#promotePanel').show();
		setTimeout(function(){$('#promGroup').show();},300); // 防止点透
	};
	
	ItemDet.prototype.tmpFun = function(){   //一个临时函数，主要满足小需求，提示7小时付款以及四免一打开促销
		this.setPromoteTitle();
		if($('#outServiceNote .time6hour').length > 0) return;
		var obj = this,tips = '在线支付订单请您在6小时内完成支付',
			now = new Date().getTime(),
			sevenTipTime = [new Date('2015/11/09 00:00:00').getTime(),new Date('2015/11/12 23:59:59').getTime()],  //提示7小时付款
			fourOneTime = [new Date('2015/11/10 00:00:00').getTime(),new Date('2015/11/12 23:59:59').getTime()];  //四免一时间到，则打开促销信息
		if( (['12273','4833'].indexOf(obj.jdCategory[3])==-1)&&(now>sevenTipTime[0] && now<sevenTipTime[1])){
			$('#outServiceNote').append('<div class="item time6hour"><div class="label"><i class="icon_service sendpay_211"></i><div class="txt">' + tips + '</div></div></div>');
		}
	};
	//获取门店相关信息
	ItemDet.prototype.showStore = function(){
		var obj = this;
		if(!(obj.venderId*1) || (!obj.locShopInfo['isLOC'])) return;
		$("#sendArea").hide();//去掉送货区域
		$('#addCart2').hide();
		$('#buyBtn2').addClass('btn_disable');
		$('#serviceInfo').hide();
		$('#serviveArea .icon_point').hide();
		$('#storeChooseIndx').html('选择门店');
		!obj.locShopInfo['shopCoords'] && (obj.locShopInfo['shopCoords'] = {});
		//先取cookie
		var shopBaseId;
		shopBaseId = cookie.get('shopBaseId');
		shopBaseId = JSON.parse(shopBaseId);
		if (!shopBaseId || !(shopBaseId.locationId && shopBaseId.locationId.split('-').length==3) || !shopBaseId.shopId || shopBaseId.venderId != obj.venderId) {
	        shopBaseId = false;
	        cookie.del('shopBaseId', '/', 'jd.com');
	    }	
		
		var locationId = obj.jdAddrId.slice(0,2).join('-') + '-0',longitude='',latitude='';
		obj.locShopInfo.locGroupId = (obj.item().spAttr ? obj.item().spAttr.locGroupId:'');		
		window.storeInfo = function(json){
			if(!json.locShops || json.shopnum *1 == 0){
				$('#storeName').html('在 '+json.geoloc.provName+' '+json.geoloc.cityName+' 没有找到可到店服务的门店');
				$('#storeAttrPhone').hide();
				return;
			}
			var locShop  = json.locShops[0];
			if(shopBaseId){
				for(var i=0;i<json.shopnum *1;i++){
					if(shopBaseId.shopId == json.locShops[i].id){
						locShop = json.locShops[i];
						break;
					}
				}
			}
			obj.setStoreArea(locShop);
		};
		//有cookie，直接发送请求
		if(shopBaseId){
			obj.locShopInfo['shopBaseId'] = shopBaseId;
			ls.loadScript(['//wq.jd.com/deal/locshop/getshoplist?callback=storeInfo',
				'venderid='+obj.venderId,
				'locationid='+shopBaseId.locationId,
				'sku='+obj.skuId,
				'shopgroupid='+obj.locShopInfo.locGroupId,
				'loctype=1',
				't=' + Math.random()].join('&'));
			$('#storePanel').show();
		}
		else{    //没有cookie时，需要获取经纬度	
			//判断有没有经纬度cookie
			var coords = cookie.get('coords');
			coords = JSON.parse(coords);
			if (!coords || !coords.longitude || !coords.latitude) {
	        	cookie.del('coords', '/', 'jd.com');
	        	$('#storeName').html('暂时未能获取您的当前位置坐标，请手动选择门店');
				$('#storeAttrPhone').hide();
				setTimeout(function(){
					$('#storePanel').show();
				},2000);//定位需要时间，所以延时2s再显示
				obj.createTimeout('12','item getloc api timeout');
		    }
		    else{
		    	obj.locShopInfo['locCoords']=coords;
				$('#storePanel').show();
		    }
			util.getMyLocation(function(json){
				if(obj.timeout.itil12){
					obj.delTimeout('itil12');
					JD.report.umpBiz({bizid:'25',operation:'12',result:'0',source:'0',message:'item getloc api timeout'});
				}
				if(!obj.locShopInfo['locCoords']){
					coords = cookie.get('coords');
					coords = JSON.parse(coords);
					obj.locShopInfo['locCoords']=coords;
				}				
				longitude = json.longitude;
				latitude = json.latitude;
				//防止异步		
				(longitude && latitude) && (ls.loadScript(['//wq.jd.com/deal/locshop/getshoplist?callback=storeInfo',
					'venderid='+obj.venderId,
					'locationid='+locationId,
					'coords='+ longitude + ',' + latitude,
					'sku='+obj.skuId,
					'shopgroupid='+obj.locShopInfo.locGroupId,
					'loctype=0',
					't=' + Math.random()].join('&')));
			});	
		}    
		
	};

	ItemDet.prototype.setStoreArea = function(data){
		var obj = this,shopBaseId = {},val='';//保存cookie
		obj.locShopInfo['shopId'] = data.id;
	    obj.locShopInfo['shopName'] = data.name;
		obj.locShopInfo['shopAttr'] = data.fulladdr; //店铺地址
		obj.locShopInfo['locationId'] = (data.regionId ? data.regionId.split('-').slice(0,2).join('-')+'-0':(data.locationid ||obj.locShopInfo['shopBaseId'].locationId) );//只保存两级
		obj.locShopInfo['shopCoords']['latitude'] = data.coords.indexOf(',') > -1 ? data.coords.split(',')[0] : obj.locShopInfo['shopCoords']['latitude'];
		obj.locShopInfo['shopCoords']['longitude'] = data.coords.indexOf(',') > -1 ? data.coords.split(',')[1] : obj.locShopInfo['shopCoords']['longitude'];
		$('#storeName').html(data.name + ''+ (data.dist ? ('<span class="de_c_orange"> (距离: '+(data.dist/1000).toFixed(1) + ' KM)</span>') : ''));
		$('#storeAttr').html(data.fulladdr);
		$('#storePhone').html(data.phone);
		$('#storeAttrPhone').show();
		if(!data.fulladdr) $('#storeAttrItem').hide();
		if(!data.phone) $('#storePhoneItem').hide();
		if(!data.fulladdr && !data.phone) $('#storeAttrPhone').hide();
		if($('#buyBtn2').hasClass('btn_disable')){
			//$('#buyBtn2').removeClass('btn_disable');
			obj.getSkuStock(obj.skuJson[obj.skuId]['stock']);
		}
		shopBaseId.venderId = obj.venderId;
		shopBaseId.locationId = obj.jdAddrId.slice(0,2).join('-') + '-0';
		if(obj.locShopInfo['locationId'] && obj.locShopInfo['locationId'].split && obj.locShopInfo['locationId'].split('-').length==3){
			shopBaseId.locationId = obj.locShopInfo['locationId']
		}
		shopBaseId.shopId = obj.locShopInfo['shopId'];
		val = JSON.stringify(shopBaseId);
		cookie.set('shopBaseId', val, 60, '/', 'jd.com');
		obj.locShopInfo['shopBaseId'] = shopBaseId;
	};

	ItemDet.prototype.storeChoose = function(){
		var obj = this;  
		if((!obj.locShopInfo['shopBaseId']) && (!obj.locShopInfo['locCoords'])){  //这时，有可能是定位失败
			//定位失败，直接设置北京的位置cookie值
			var coords = {longitude:116.397947,latitude:39.9081726},val = JSON.stringify(coords);
			cookie.set('coords', val, 60, '/', 'jd.com');
		}		
		setTimeout(function(){
				window.scroll(0,0);	//让门店列表进来，就在顶部
				loc.list({
               	 	'locationid': (obj.locShopInfo['locationId'] || (obj.jdAddrId.slice(0,2).join('-') + '-0')),
       				'venderid': obj.venderId, // 这里就是venderid
                	'shopid': obj.locShopInfo['shopId'], // 这里是选中的门店id 就是接口返回的id
                	'locGroupId':obj.locShopInfo.locGroupId,
                	'skuId':obj.skuId
    			}, function (data) {
        		if(!data) return;
        		obj.setStoreArea(data);
				window.scroll(0,0);	//防治用户在门店列表页下滑
			});
		},300);  //延时是因为反映过快，会看到商详页滚动,防止点透
	};

	//自营和pop商品下  分别有这些id 不能显示市场价        fang shang mian
	ItemDet.prototype.showMarketPrice = function(){
		if(!this.jdCategory) return;
		var jdId = ['',1316,5025,737,670,652,4938,6728,9987,1320,12259,9192,12193,1528,1526,1527,1525,1524,1523,1702,''].join(',');
		var popId = ['',1316,5025,12193,1528,1526,1527,1525,1524,''].join(',');
		var cate = ','+this.jdCategory.join(',|,')+',', reg=new RegExp(cate);
		//if(!reg.test(this.venderId*1 ? popId : jdId)) $('#priceMarket').show();  //法务问题  不展示
		if(this.skuType == 2 || this.skuType == 3){ 
			$('#priceMarket, #priceDis').show();
		}
	};

	//库存状态
	ItemDet.prototype.getSkuStock = function(data){
		var obj = this;
		if(!obj.jdStatus) return;
		window.stockCallback = function(json){
			if(!speedTimePoint[4]) speedTimePoint[4] = new Date();
			var stock = json.stock || json;
			//33		有货	现货-下单立即发货
			//39		有货	在途-正在内部配货，预计2~6天到达本仓库
			//40		有货	可配货-下单后从有货仓库配货
			//36		预订
			//34		无货
			$('#postNotice1, #postNotice2, #serviceInfo').html('');
			switch(stock.StockState){
				case 33:case 39:case 40:
					$('#postNotice1').html('有货');
					$('#postNotice2').html('下单后立即发货');
					$('#buyBtn2, #addCart2').removeClass('btn_disable');
					obj.jdStatus = true;
					$('#addrName').html(obj.jdAddrName[0]);
					if(obj.koStatus == 3){  //抢购活动结束&有货
						$('#addCart2').show();
						$('#buyBtn2').removeClass('btn_blue');
						$('#statusNotice').hide();
						$('#buyBtn2').html('立即购买');
					}
				break;
				case 36://预订
					$('#postNotice1').html(stock.ArrivalDate ? ('预订，预计' + stock.ArrivalDate + '日后有货') : '预订，商品到货后发货，现在可下单');
					$('#buyBtn2, #addCart2').removeClass('btn_disable');
					obj.jdStatus = true;
				break;
				case 0:
				case 34:
				default:
				if(obj.koStatus ==2 || obj.yushouStatus==4){
					$('#statusNotice').show();
					$('#statusNote').html('该商品已售罄<br/>未成功支付的订单取消后，库存将被释放，敬请关注');
				}
				else{
					//$('#postNotice1').html('无货，或此商品不支持配送至'+obj.jdAddrName[1]+obj.jdAddrName[2]);
					$('#statusNote').html('无货，或此商品不支持配送至'+obj.jdAddrName[1]+obj.jdAddrName[2]);
					$('#statusNotice').show();
					// if(obj.isSpecItem){ //预约、预售、独立秒杀、选号套餐还是原无货逻辑
					// 	$('#statusNote').html('无货，或此商品不支持配送至'+obj.jdAddrName[1]+obj.jdAddrName[2]);
					// 	$('#statusNotice').show();
					// 	$('#buyBtn2, #addCart2').addClass('btn_disable');
					// }else{  //无货商品，到货通知,实现自营商品无货时，提供“查看相似商品”和“到货通知”功能,实现POP商品无货时，提供“查看相似商品”功能
					// 	$('#buyBtn2, #addCart2').hide();
					// 	$('#viewGuess').show();
					// 	if(obj.isZiying) $('#arrivalNotice').show();
					// }
				}
				$('#buyBtn2, #addCart2').addClass('btn_disable');
				obj.jdStatus = false;
				break;
			}
			
			obj.isExpByjd = obj.isZiying || (stock.D && stock.D.type==1); //是否京东发货

			if(stock.code == 3 || stock.code == 4){ //地址信息有误
				obj.setFullAddr();
			}

			var pr = stock.pr, ir=stock.ir;
			if(pr && pr.resultCode == 1) $('#postNotice2').html(pr.promiseResult);
			if(ir && ir.length){
				var html=[], tpl=$id('serviceTpl').text;
				var icoName={sendpay_211:'211限时达',pop_PaymentCod:'货到付款', sendpay_411:'极速达',appliances_PaymenCod:'货到付款'};
				var icoShow = 'NL_CJBDY,sendpay_411,sendpay_311,sendpay_211,sendpay_nextday,sendpay_aftertomorrow,jingdou_xiankuan,payment_cod,special_ziti,free_delivery,service_home,appliances_NightShip,appliances_211,jingdou_xiankuan_appliances,appliances_PaymenCod,appliances_OpenAhead,appliances_Install,appliances_Delivery,appliances_free_delivery,pop_SendpayTJOnetime,pop_SendpayToday,pop_SendpayNextday,pop_SendpayAftertomorrow,pop_PaymentCod,ps_Jbd,pop_Selfpick,pop_FreightInsurance,POP_freeSend,pop_pinzhixian';
				for (var i = 0; i < ir.length; i++) {
					if(ir[i].iconCode == 'pop_PaymentCod') obj.isCashDelivery = true;
					if(icoShow.indexOf(ir[i].iconCode) == -1) continue; 
					ir[i].iconSrc = icoName[ir[i].iconCode] ? icoName[ir[i].iconCode] : ir[i].iconSrc;
					if(ir[i].resultCode == 1) html.push($jsonToTpl(ir[i], tpl));
				};
				$('#serviceInfo').html(html.join(''));
				if(html.length > 0){
					$('#serviceInfo').show();
					$('#serviveArea .icon_point').show();
				} 
			} 
			if(!obj.skuJson[obj.skuId].stock){
				obj.skuJson[obj.skuId].stock = stock;
				if(obj.locShopInfo['isLOC']){
					obj.shopInfo(stock);
				}else{
					obj.shopInfo(stock);
					obj.getPostPrice(stock);
				}	
			}
			$('#ziYingMsg').text().replace(/\s/g,'') ? $('#ziYingMsg').show() : $('#ziYingMsg').hide();
		};
		
		if(data){
			window.stockCallback(data);
		}
		else{		
			ls.loadScript({
				url:['//c.3.cn/stock?callback=stockCallback&buyNum=1',
							'skuId='+obj.skuId,
							'venderId='+obj.venderId,
							'cat='+obj.jdCategory.slice(0,3).join(','),
							'area='+obj.jdAddrId.slice(0,4).join('_'),
							'ch='+(obj.isWX?4:5),
							'extraParam='+encodeURIComponent('{"originid":"3"}'),
							't='+Math.random()].join('&'),
				charset: 'GBK'
			});
		}
	};

	ItemDet.prototype.setFullAddr = function(){
		this.getAddrTime++;
		if(this.getAddrTime > 4) return;  //防止在getSkuStock和setFullAddr之间死循环
		var index = 0, obj=this;
		for (var i = 0; i < this.jdAddrId.length; i++) {
			if(this.jdAddrId[i]*1 < 1) break;
			index = i;
		};
		window.setAddrCB = function(arr){
			if(arr.length){
				obj.jdAddrId[index+1] = arr[0].id;
				obj.jdAddrName[index+1] = arr[0].name;
				cookie.set('jdAddrId', obj.jdAddrId.join('_'), 999999);
				localStorage.setItem('jdAddrId', obj.jdAddrId.join('_'));
	            cookie.set('jdAddrName', obj.jdAddrName.join('_'), 999999);
	            localStorage.setItem('jdAddrName', obj.jdAddrName.join('_'));
	            obj.setFullAddr();
			}
			else{
				obj.getSkuStock();
			}
		};
		ls.loadScript('//d.jd.com/area/get?fid='+this.jdAddrId[index]+'&callback=setAddrCB&t='+Math.random());
	};
	
	// 运费
	ItemDet.prototype.setPostInfo = function(){
		var obj=this;
		if(!(this.venderId*1)) return;
		ls.loadScript('//fare.shop.jd.com/json/pop/fare.action?venderId='+this.venderId+'&skuId='+this.skuId+'&provinceId='+this.jdAddrId[0]+'&cityId='+this.jdAddrId[1]+'&callback=sopCallback&buyNum=1' + '&t='+Math.random());
		window.sopCallback = function(json){
		    $('#postPrice').html(' '+(json.dcash?('&yen;'+json.dcash):'免邮费'));
		};
	};


	//获取评论条数
	ItemDet.prototype.getSkuSummary = function(){
		var obj = this;
		window.skuSummary = function(json){
			if(!speedTimePoint[6]) speedTimePoint[6] = new Date();
			obj.jdSkuInfo['summary'] = json;
			var arr=json.CommentsCount, tmp = arr[0];
			for (var i=0; i < arr.length; i++) {
			   if(arr[i].SkuId == obj.skuId){
			       tmp = arr[i];
			       break;
			   }
			};
			if(obj.cpart == 'main'){
				$('#evalNo1, #evalNo2,#evalNo3').html(tmp.CommentCount ? tmp.CommentCount:'0');
				$('#evalRate').html(tmp.GoodRateShow ? tmp.GoodRateShow+'%':'0');
			}
			else{
				var no=0;
				$('#evalHead').html($jsonToTpl(tmp, $id('evalHeadTpl').text));
				//$('#evalHead2').html($jsonToTpl(tmp, $id('evalHeadTpl2').text));
			}
		};
		if(!this.jdSkuInfo['summary']){
			ls.loadScript('//club.jd.com/clubservice/summary-m-'+this.jdSkuIds.join(',')+'.html?callback=skuSummary' + '&t='+Math.random());
		}
		else{
			window.skuSummary(this.jdSkuInfo['summary']);
		}
	};
	
	ItemDet.prototype.setEvelHead = function(data){
		if(this.jdSkuInfo['eval'][this.skuId][0] || !data) return;
		data.goodRateShow = data.goodRateShow > 0 ? (data.goodCount*100/data.commentCount).toFixed(1) : '0';
        data.goodRateShow = data.goodRateShow.replace('.0', '');
		data.commentCount == 0 ? $('#evalRate, #evalHead2, #evalTag2').hide() : $('#evalRate, #evalHead2, #evalTag2').show();
		$('#evalNo1, #evalNo2,#evalNo3').html(data.commentCount ? data.commentCount:'0');
		$('#evalRate').html(data.goodRateShow ? data.goodRateShow+'%':'0');
		$('#evalHead').html($jsonToTpl(data, $id('evalHeadTpl').text));
		//$('#evalHead2').html($jsonToTpl(data, $id('evalHeadTpl2').text));
		$('#evalTab span.cur').removeClass('cur');
		$('#evalTab span[no="' + this.evalType + '"]').addClass('cur');
	};
	
	//评论
	ItemDet.prototype.loadEval = function() {
		//if(this.isLoadDet[this.detIndex] == this.skuId)return;
		var obj = this;
		if (this.evalHold || this.evalPageCur > this.evalPage) {
			setTimeout(function(){obj.evalHold = false;},500);
			return;
		}
		$('#eveaLoading').show();
		this.evalHold = this.evalPageCur != 1;
		//if (this.evalPageCur == 1) this.evalHold = false;
		
		window.skuJDEval = function(json){
			if(obj.timeout.itil4){
				obj.delTimeout('itil4');
				JD.report.umpBiz({bizid:'25',operation:'4',result:'0',source:'0',message:'item comments api loaded'});
			}
			if(obj.evalType != json.score) return;
			var isMain = obj.cpart == 'main', evalDom = isMain?$('#evalDet_main'):$('#evalDet_summary');
			var sdImg = function(imgs){
				var str='',p='',imgSrc='', len=imgs.length, isMore=len>4, strMore=isMore?'<span class="tip_more" onclick="$(this).hide().parent().parent().find(\'.more_img\').show()">点击查看更多晒图</span>':'';
				for (var i=0; i < len; i++) {
					//var p = '//img30.360buyimg.com/shaidan/jfs'+imgs[i].imgUrl.replace(/^.*_jfs/, '');
					imgSrc = imgs[i].imgUrl.replace('http://','//');
					p = imgSrc.replace('s128x96_', '');
				    str += '<span class="img"><img ptag="7001.1.29" src="'+imgSrc+'" prview="'+p+'"/>'+(i==3?strMore:'')+'</span>';
				    if(isMore){
				    	if(i==3)str += '<span class="more_img" style="display:none">';
				    	if(i==(len-1))str += '</span>';
				    }
				};
				return str;
			};
			
			obj.setEvelHead(json.productCommentSummary);  // 要在set obj.jdSkuInfo['eval'][obj.skuId][obj.evalType]之前
			
			if(obj.evalPageCur==1) obj.jdSkuInfo['eval'][obj.skuId][obj.evalType] = json;
			$('#eveaLoading').hide();
			var data = json.comments, html = [], tpl = $id('evalTpl').text;
			for (var i = 0; data && i < data.length; i++) {
				if(isMain && i >= 3) break;
				data[i].creationTime = data[i].creationTime.slice(0, 10);
				data[i].name = data[i].anonymousFlag == 1 ? (data[i].nickname.substr(0,1)+'***'+data[i].nickname.substr(-1)) : data[i].nickname;
				data[i].levelName = data[i].anonymousFlag == 1 ? '' : ('('+data[i].userLevelName+')');
				//data[i].sku = (data[i].productColor || data[i].productSize ?('<span>商品：'+data[i].productColor+ ' '+ data[i].productSize):'');
				data[i].sku = (data[i].productColor?('<span>颜色：'+data[i].productColor+'</span>'):'') + (data[i].productSize?('  <span>型号：'+data[i].productSize+'</span>'):'');
				data[i].shaidanImg = data[i].images ? sdImg(data[i].images):'';
				data[i].score_code = Math.min(100, data[i].score*20);
				data[i].reply = '<a href="//wqs.jd.com/my/comment/list.shtml?view=wg.my.commentview-init&from=1&productid=' + data[i].referenceId + '&guid=' + data[i].guid + '&PTAG=37287.3.1" onclick=""  class="btn">' + (data[i].replyCount > 0 ? '<span class="num">' + data[i].replyCount + '</span>' : '') + '回复</a>';  //回复
				html.push($jsonToTpl(data[i], tpl));
			};
			var str = (html.length ? html.join('') : '<li class="null"><center>暂无评价，欢迎您购买之后留下您的宝贵评价：）</center></li>');
            obj.evalPageCur == 1 ? evalDom.html(str) : evalDom.append(str);
            
            if(isMain){
	            if(html.length >= 3){
	            	$('#summaryEnter2, #summaryEnterIco').show();
	            	$('#summaryEnter').attr('hashval', 'summary');
	            }
	            else{
	            	$('#summaryEnter2, #summaryEnterIco').hide();
	            	$('#summaryEnter').removeAttr('hashval');
	            }
            }
            
            var tagHtml = '', tags=json.hotCommentTagStatistics;
            if(obj.evalPageCur == 1 && tags){
	            for (var i=0; i<tags.length; i++) {
	                tagHtml += '<span>'+tags[i].name+'('+tags[i].count+')</span>';
	            }
	            $('#evalTag, #evalTag2').html(tagHtml);
	            if(tagHtml == ''){
	            	$('#evalTag').hide();
	            }
            }
            
			obj.evalHold = false;
			var pcs=json.productCommentSummary, count=[pcs.commentCount, pcs.poorCount, pcs.generalCount, pcs.goodCount, pcs.showCount];
			obj.evalPage = Math.ceil(count[obj.evalType]/10)||1;
			obj.evalTotal = pcs.commentCount;
			obj.evalPageCur++;
			if(!isMain&&obj.evalPageCur > obj.evalPage && html.length){
				evalDom.append('<li class="null">没有更多评价啦 </li>');
			}

			//if(itil6) clearTimeout(itil6);
		};
		
		if(!this.jdSkuInfo['eval']) this.jdSkuInfo['eval']={1:1};
		if(!this.jdSkuInfo['eval'][this.skuId]) this.jdSkuInfo['eval'][this.skuId] = {};

		if(this.jdSkuInfo['eval'][this.skuId][this.evalType] && obj.evalPageCur==1){
			window.skuJDEval(this.jdSkuInfo['eval'][this.skuId][this.evalType]); //缓存第一页
		}
		else{
			//ls.loadScript('//club.jd.com/productpage/p-'+this.skuId+'-s-0-t-3-p-'+(obj.evalPageCur-1)+'.html?callback=skuJDEval&t='+Math.random());
			ls.loadScript('//club.jd.com/productpage/p-'+this.skuId+'-s-'+this.evalType+'-t-0-p-'+(obj.evalPageCur-1)+'.html?callback=skuJDEval&t='+Math.random());
			obj.createTimeout('4','item eval api fail'+obj.skuId);
		}
	};
	//拉取尺码信息,以商品维度，只需运行一次sku
	ItemDet.prototype.loadSizeInfo = function(){
		var obj = this;
		if(!obj.item().description ||(' 11729 1315 1318 1319 ').indexOf(' '+obj.jdCategory[0]+' ')==-1) return;  //只为这四个一级类目引流
		var wareid = (obj.item().description.indexOf('d')==0 ? obj.item().description.slice(1):obj.item().description);
		window.sizeInfoCB = function(json){
			if(!json || !json.cmdetail || !json.cmdetail.oResult) return;
			var htmlArr=[],item={},headerArr=[],theadArr=[],hwSize={},isSizeShow=true,tipStr='您还没有登录京东帐号，<br>请登录后查看尺码建议',tipHelp='去登录',tipHelpUrl='javascript:void(0)';// key:h~~w,value:size
			//尺码建议
			if( json.cmdetail.oResult.RecommendList && json.cmdetail.oResult.RecommendList.length==0){
				isSizeShow = false;
			}
			if(json.errcode==0) {//尺码建议区域必须登录  
				if(!json.personcminfo ||!json.personcminfo.vecCmInfoPoList || json.personcminfo.vecCmInfoPoList.length===0 ){//没有我这个信息
					tipStr = '您还没录入个人尺码信息，<br>无法提供尺码建议';
					tipHelp = '去录入';
					tipHelpUrl = '//wqs.jd.com/item/sizeedit.shtml?istab=1&ptag=7001.1.63&sku='+obj.skuId;
					$('#sizeHelp').addClass('link');
				}else{
					var cmid = urlParam.getUrlParam('cmid'),personList = json.personcminfo.vecCmInfoPoList,itemArr=[];//拉取购买者的尺码ID
					isSizeShow = false;
					itemArr = personList.filter(function(_item, _index) {
			            	return _item.dwIsDefault==1||_item.ddwCmId==cmid;
			        	});
					item = (itemArr.filter(function(_item, _index) {
			            	return _item.ddwCmId==cmid;
			        	})[0]) || (itemArr.filter(function(_item, _index) {
			            	return _item.dwIsDefault==1;
			        	})[0]);
					if(item){ 
						if(item.dwIsDefault==1) item.strCmName = '您';
						tipStr = '根据您录入的尺码信息，<br> '+ (item.strReserve != 'NULL' ? (item.strCmName+'可能适合 <span class="tag">'+item.strReserve+'</span> 码'):('暂时没有找到'+item.strCmName+'合适尺码'));
						cmid = item.ddwCmId;
						isSizeShow = true;
					}else{ //没有推荐
						isSizeShow = false;
					}
					tipHelp = '尺码助手';
					tipHelpUrl = '//wqs.jd.com/item/sizecenter.shtml?ptag=7001.1.64&wareid='+wareid+'&cmid='+cmid+'&sku='+obj.skuId;
				}
			}else if(json.errcode==11002){ //未登录  后台11002表示未登录
				$('#sizeSug').on('click',function(){
					obj.login();
				});
				$('#sizeHelp').addClass('link');
			}else{
				isSizeShow = false;
			}
			if(isSizeShow){
				$('#sizeTip').html(tipStr);
				$('#sizeHelp').html(tipHelp).attr('href',tipHelpUrl);
				$('#sizeSug').show();
			}
			sizeTable.loadSizeInfo({json:json});
		};
		ls.loadScript('//wq.jd.com/cmdetail/GetAllCmdetail?callback=sizeInfoCB&wareid='+wareid);
	};
	//一般商品的参数
	ItemDet.prototype.loadCommParam = function() {
		$('#package').hide();
		if(this.isLoadDet[this.detIndex] == this.skuId)return;
		if(this.skuType == 2 || this.skuType == 3){
			this.loadCommParamAct();
			return;
		}
		var obj = this;
		if(!this.jdSkuInfo['param']) this.jdSkuInfo['param']={1:1};
		window.commParamCallBack = function(json) {
			if(obj.timeout.itil5){
				obj.delTimeout('itil5');
				JD.report.umpBiz({bizid:'25',operation:'5',result:'0',source:'0',message:'item pramas api loaded'});
			}
		
			//$('#commDesc').html('');
			obj.jdSkuInfo['param'][obj.skuId] = json;
			var NOtr='<tr><td>商品编号</td><td>'+obj.skuId+'</td></tr>', str = '<table cellpadding="0" cellspacing="1" width="100%" border="0" class="Ptable">';
			if (json.success != '1') {
				return;
			} else {
				var content = json.content;
				if(content && content.indexOf('table') > -1 && content.indexOf('</td></tr>') > -1){
					str = content;
				}else{
					var expandAttrDesc = obj.item().expandAttrDesc;
					var strTbody = '<tbody>';
					for(var key in expandAttrDesc){
						strTbody += ('<tr><td class="tdTitle">'+key+'</td><td>'+(expandAttrDesc[key][0] ? expandAttrDesc[key][0]:'')+'</td></tr>');
					}
					strTbody += '</tbody>';
					str += strTbody + '</table>';
				} 
				$('#detParam').html(str);
				$('#detParam table').addClass('param_table');
				$('#detParam table').prepend(NOtr);
			}

			obj.isLoadDet[obj.detIndex] = obj.skuId;
		};
		if(!this.jdSkuInfo['param'][this.skuId]){
			ls.loadScript('//yx.3.cn/service/info.action?callback=commParamCallBack&k=' + (this.specificationId ? this.specificationId : 'g'+this.skuId));
			obj.createTimeout('5','item pramas api timeout');
		}
		else{
			window.commParamCallBack(this.jdSkuInfo['param'][this.skuId]);
		}
		
	};

	//图书音像的参数
	ItemDet.prototype.loadCommParamAct = function() {
		var info = this.item(), str = '<table class="param_table">', tr=function(t,n){return '<tr><td>'+t+'</td><td>'+n+'</td></tr>';};
		str+= tr('商品编号', this.skuId);
		var bookKey={ISBN:"ISBN", ISSN:"ISSN", BookName:"营销书名", ForeignBookName:"外文书名", Language:"图书语言", Author:"作者", Editer:"编者", Proofreader:"校对", Remarker:"注释", Transfer:"译者", Drawer:"绘者", Publishers:"出版社", PublishNo:"出版社号", Series:"丛书名", Brand:"品牌", Format:"格式", Package:"包装(装帧)", Pages:"页数", BatchNo:"版次", PublishTime:"出版时间", SizeAndHeight:"尺寸及重量", ChinaCatalog:"中国法分类号", Sheet:"印张", Papers:"用纸", Attachment:"附件", AttachmentNum:"附件数量", PackNum:"套装数量", Letters:"字数", KeyWords:"主题词", PickState:"捡货标记", Compile:"编纂", Photography:"摄影", Dictation:"口述", Read:"朗读", Finishing:"整理", Write:"书写", saleDate:"上架时间", Format:"开本"};
		var actKey={Aka:"又名", Brand:"品牌", Foreignname:"外文名", ISBN:"ISBN", Mvd_Wxjz:"文像进字", Mvd_Gqyz:"国权音字", Mvd_wyjz:"文音进字", ISRC:"ISRC", Mvd_Dcz:"电出字", Mvd_Xcyg:"新出音管", Press:"出版社", Publishing_Company:"发行公司", Production_Company:"出品公司", Copyright:"版权提供", Actor:"演员", Director:"导演", Dub:"配音", Voiceover:"解说者", Screenwriter:"编剧", Producer:"监制", Singer:"演唱者", Performer:"演奏者", Authorsstr:"作词", Compose:"作曲", Command:"指挥", Orchestra:"知名乐团", Media:"介质", Soundtrack:"碟数", Number_Of_Discs:"碟片数", Episode:"集数", Record_Number:"唱片数量", Publication_Date:"出版日期", Release_Date:"投放市场的日期", ReleaseDate:"上映日期", Accessories:"附件", Included_Additional_Item:"附件数量", Set_The_Number_Of:"套装数量", Format:"格式", Color:"色差", Region:"区码", Length:"片长", Screen_Ratio:"屏幕比例", Audio_Encoding_Chinese:"音频格式", Quality_Description:"品质说明", Dregion:"地区", Language:"图书语言", Language_Dubbed:"配音语言", Language_Subtitled:"字幕语言", Version_Language:"版本语言", Language_Pronunciation:"发音语言", Menu_Language:"菜单语言", Version:"版本", Type:"类型", Platform:"操作系统", Minimum_System_Requirement_Description:"最低配置要求", Recommended_System_Description:"推荐配置要求", Online_Play_Description:"在线游戏", Awards:"获奖情况", Type_Keywords:"商品类型关键词", Keywords:"主题词", Readers:"读者对象", Number_Of_Players:"游戏人员数量", Mfg_Minimum:"最小年龄", Mfg_Maximum:"最大年龄", Compile:"编纂", Photography:"摄影", Dictation:"口述", Read:"朗读", Finishing:"整理", Write:"书写", Version:"产品评级（可链入搜索结果页）", Color:"厂牌（可链入搜索结果页）", Type:"录音模式", Format:"画面色彩", saleDate:"上架时间:"};
		if(info.skuType == '2')for(k in bookKey){ if(info[k]) str+= tr(bookKey[k], info[k]);}
		if(info.skuType == '3'){
			if(!info.Authorsstr){
				info.Authorsstr = '';
				var tmp=[], aut=info.Authors;
				for(var i=0; i < aut.length;i++){
					for(var j=0; j< aut[i].author.length;j++){
						tmp.push(aut[i].author[j].author);
					}
				}
				info.Authorsstr = tmp.join('，');
			}
			for(k in actKey){ if(info[k]) str+= tr(actKey[k], info[k]);}
		}
		$('#detParam').html(str+'</table>');
		this.isLoadDet[this.detIndex] = this.skuId;
	};
	//商祥描述  
	ItemDet.prototype.loadCommDet = function() {
		var obj = this;
		if(!this.timeout.loadDetagain){
			this.timeout.loadDetagain = setTimeout(function(){
				obj.timeout.loadDetagain = null;
				if($('#commDesc').html() == ''){
					obj.loadCommDet();
				}
			}, obj.cgiTimeout);
		}
		
		if(this.isLoadDet[this.detIndex] == this.skuId) return;
		if(this.skuType == 2 || this.skuType == 3){ //书籍  音响的 
			this.loadCommDetAct();
			return;
		}
		if(this.showMobileDet){  //先取移动的
			this.loadCommDetMobile();
			return;
		}
		//$('#commDesc').html('<img class="detail_loading" src="//static.paipaiimg.com/wx/img/common/loading.gif">');
		if(!this.jdSkuInfo['det']) this.jdSkuInfo['det']={1:1};	
		window.commDetCallBack = function(json) {
			if(!obj.itemId && !speedTimePoint[5]) speedTimePoint[5] = new Date();
			if(obj.timeout.itil3){
				obj.delTimeout('itil3');
				JD.report.umpBiz({bizid:'25',operation:'3',result:'0',source:'0',message:'item info api loaded'});
			}
			//$('#commDesc').html('');
			obj.jdSkuInfo['det'][obj.skuId] = json;
			var str = '该商品暂无商品详情<br>';
			if (json.success != '1') {
				return;
			} else {
				str = obj.tavlHTML(json.content);
			}
			$('#commDesc').html(str);
            setTimeout(function(){
            	var em = $('#commDesc img').eq(0), init_src=em.attr('init_src');
            	if(init_src) em.attr('src', init_src);
            },2000);

			obj.isLoadDet[obj.detIndex] = obj.skuId;
			obj.initLoadImg('detMobile');
			$('#commDesc tr').each(function(){
				var td = $(this).find('td');
				if(td.length == 1){
					$(td[0]).css('width', obj.pageWidth).css('background-size','contain');
				}
			});
			$('#pcItemLink').hide();
			obj.setDetHeight();
			obj.queryWareExpImg();  //请求商品额外图片信息
		};
		if(!this.jdSkuInfo['det'][this.skuId]){
			ls.loadScript('//yx.3.cn/service/info.action?callback=commDetCallBack&k=' + (this.descriptionId ? this.descriptionId : 'd'+this.skuId));
			obj.createTimeout('3','item info api timeout');
		}
		else{
			window.commDetCallBack(this.jdSkuInfo['det'][this.skuId]);
		}
	};
	
	
	//图书名称下面那些信息
	ItemDet.prototype.loadActTitleDesc = function(){
		var info = this.item(), type=info.skuType, str='';
		var autherStr = function(astr){
			var auther = astr.replace(/\]/g,']<a>').replace(/，\[/g,'</a>,[').replace(/，/g,'</a>,<a>')+'</a>';
			if(auther.indexOf('[') !== 0) auther = '<a>'+auther;
			return auther.replace(/\[/g,'<span class="cup">[').replace(/\]/g,']</span>').replace(/,/g,'，');
		};
		(info.Author && type == 2) && (str += autherStr(info.Author)+'<span class="cup"> 著; </span>');
		(info.Editer && type == 2) && (str += autherStr(info.Editer)+'<span class="cup"> 编; </span>');
		(info.Drawer && type == 2) && (str += autherStr(info.Drawer)+'<span class="cup"> 绘; </span>');
		(info.Photography && type == 2) && (str += autherStr(info.Photography)+'<span class="cup"> 摄影; </span>');
		(info.Write && type == 2) && (str += autherStr(info.Write)+'<span class="cup"> 书写; </span>');
		if(info.Authors && type == 3){
			if(!info.Authorsstr){
				info.Authorsstr = '';
				var tmp=[], aut=info.Authors;
				for(var i=0; i < aut.length;i++){
					var ta = [];
					for(var j=0; j< aut[i].author.length;j++){
						ta.push('<a>'+aut[i].author[j].author+'</a>');
						if(ta.length == 3){
							ta[2] = ta[2] + '...';
							break;
						}
					}
					tmp.push('<span class="cup">'+aut[i].title+'：</span>' + ta.join('，'));
				}
				if(info.Publishing_Company){
					tmp.push('<br/><span class="cup">发行公司：</span><a>'+info.Publishing_Company+'</a>');
				}
				info.Authorsstr = tmp.join(' ');
			}
			str += info.Authorsstr;			
		}
		if(info.Transfer) str += autherStr(info.Transfer.replace('，等',''))+'<span class="cup"> 译</span>';
		if(info.Publishers) str += '<br><a>'+info.Publishers+'</a>';
		str = str.replace(/（/g,'</a>（<a>').replace(/）<\/a>/g,'</a>）');
		if(str) $('#actTitleDesc').show().html(str);
		$('#actTitleDesc a').each(function(){
			this.href = '//wqs.jd.com/search/index.shtml?key='+encodeURIComponent(this.innerHTML);
		});
		//去除最后一个;号
		var spanTag = $('#actTitleDesc').find('span'),spanLen = spanTag.length;
		(spanLen > 0) && spanTag.eq(spanLen-1).text(spanTag.eq(spanLen-1).text().replace('; ',''));
	};

	//图书音像商祥
	ItemDet.prototype.loadCommDetAct = function() {
		var obj = this;
		this.loadActTitleDesc();
		//$('#commDesc').html('<img class="detail_loading" src="//static.paipaiimg.com/wx/img/common/loading.gif">');
		if(!this.jdSkuInfo['det']) this.jdSkuInfo['det']={1:1};
		window.commDetCallBack = function(json) {
			if(obj.timeout.itil3){
				obj.delTimeout('itil3');
				JD.report.umpBiz({bizid:'25',operation:'3',result:'0',source:'0',message:'item info api(book) loaded'});
			}
			obj.jdSkuInfo['det'][obj.skuId] = json;
			var str = '', 
			bookTitle={"productFeatures":"产品特色", "editerDesc":"编辑推荐", "contentDesc":"内容简介", "authorDesc":"作者简介", "image":"内页插图", "comments":"精彩书评", "catalogue":"目录", "bookAbstract":"精彩书摘", "introduction":"前言/序言"},
			actTitle={"productFeatures":"产品特色", "editerDesc":"编辑推荐", "contentDesc":"专辑介绍", "biography":"艺人介绍", "catalogue":"曲目", "comments":"精彩赏评", "image":"精彩剧照", "mvdColor":"色差"};
			if (json.success != '1') {
				return;
			}
			else if(json.isMobileDesc){
				str = obj.tavlHTML(json.content);
				$('#pcItemLink').show();
			}
			else {
				var title = obj.skuType == 2 ? bookTitle : actTitle;
				for(key in title){
					if(json[key]){ 
						if(key == 'image' && json[key].indexOf('>') == -1) json[key] = '<img src="'+json[key].replace(/;/g, '"><img src="')+'">';
						str += '<div class="mod_tit_line"><h3>'+title[key]+'</h3></div>' + json[key];
					}
				}
				if(str == '' && json.content){
					str = json.content;
				}
				str = obj.tavlHTML(str);
				$('#pcItemLink').hide();
			}
			if(str == '') str = '该商品暂无商品详情<br>';
			$('#commDesc').html(str);

			obj.isLoadDet[obj.detIndex] = obj.skuId;
			obj.initLoadImg('detMobile');
			obj.setDetHeight();
			obj.queryWareExpImg();
		};
		if(!this.jdSkuInfo['det'][this.skuId] && this.descriptionId){
			var tmp = this.showMobileDet ? ('&skuId='+this.skuId) : '';
			ls.loadScript('//yx.3.cn/service/info.action?callback=commDetCallBack'+tmp+'&k=' + (this.descriptionId ? this.descriptionId : 'd'+this.skuId));
			obj.createTimeout('3','item info api(book) timeout');
		}
		else{
			window.commDetCallBack(this.jdSkuInfo['det'][this.skuId]);
		}
		
	};

	//取京东移动版
	ItemDet.prototype.loadCommDetMobile = function() {
		var obj = this, key = this.skuId;
		if(!this.jdSkuInfo['det']) this.jdSkuInfo['det']={1:1};
		if(!this.isZiying && this.venderId*1){ 
			key = this.venderId;
			if(this.jdSkuInfo['det'][this.venderId]) return;  //pop商品都公用一份商祥
		}
		
		window.commItemDetMobCB = function(json) {
			//$('#commDesc').html('');
			obj.jdSkuInfo['det'][key] = json;
			var str = '';
			if (json.content) {
				str = obj.tavlHTML(json.content);
			}
			if(!str){
				obj.detItemToSku();
				return;
			}
			$('#commDesc').html(str);
            setTimeout(function(){
            	var em = $('#commDesc img').eq(0), init_src=em.attr('init_src');
            	if(init_src) em.attr('src', init_src);
            },2000);


			obj.isLoadDet[obj.detIndex] = obj.skuId;
			obj.initLoadImg('detMobile');
			if(json.isMobileDesc) $('#pcItemLink').show();
			obj.setDetHeight();
			obj.queryWareExpImg();
		};
		if(!this.jdSkuInfo['det'][key]){
			ls.loadScript('//yx.3.cn/service/info.action?callback=commItemDetMobCB&skuId='+this.skuId+'&k=' + (this.descriptionId ? this.descriptionId : 'd'+this.skuId));
		}
		else{
			window.commItemDetMobCB(this.jdSkuInfo['det'][key]);
		}
	};

	//请求商品额外图片信息
	ItemDet.prototype.queryWareExpImg = function(){
		return;
		var obj = this;
		window._showPopTemplete = function(json){
			var str = (json.wareTemplateContent||'') + (json.wareTemplateBottomContent||''); 
			if(!str) return;
			str = obj.tavlHTML(str);
			str = str.replace(/height/ig, 'h');
			$('#commDesc').append(str);
			obj.initLoadImg('detMobile');
		};
		ls.loadScript('//rms.shop.jd.com/json/wareTemplate/queryWareTemplateContent.action?jsoncallback=_showPopTemplete&skuId=' + this.skuId);
	};

	//获取包装和售后
	ItemDet.prototype.loadPackgeSer = function(){
		var obj = this;
		window.packageService = function(json){
			obj.jdSkuInfo['p_s'][obj.skuId] = json;
			$('#detServer').html(json.afterSale || '');
			if(json.packList){
				$('#detPackage').html(json.packList);
				$('#package').show();
			}
			else{
				$('#package').hide();
			}
		};
		if(!this.jdSkuInfo['p_s']) this.jdSkuInfo['p_s'] = {1:1};
		if(!this.jdSkuInfo['p_s'][this.skuId]){
			ls.loadScript('//yx.3.cn/service/info.action?k1='+this.skuId+'&callback=packageService' + '&t='+Math.random());
		}
		else{
			window.packageService(this.jdSkuInfo['p_s'][this.skuId]);
		}
	};
	
	//拉取优惠套装数据
	ItemDet.prototype.loadRelatedItem = function(){
		var obj = this;
		window.relatedSuit = function(json){
			if(obj.timeout.itil10){ //表示接口返回数据
				JD.report.umpBiz({bizid:'25',operation:'10',result:'0',source:'0',message:'item relate api success'});
				obj.delTimeout('itil10');
			} 	
		 	if(!json || json.suit.status != 200) return;
		 	if(!json.suit.data || ((obj.isZiying) && (!json.suit.data.packResponseList)) ||((!obj.isZiying) && (!json.suit.data.packList))) return;
			var relateds = [], max=0, ct=obj.item(),
				citem = {sku:obj.skuId, name:ct.skuName, num:1, img:obj.loopImg[0], link:'//wq.jd.com/item/view?sku='+obj.skuId+'&ptag=7001.1.45'},
				suitList = obj.isZiying ? json.suit.data.packResponseList : json.suit.data.packList;
			for (var i=0; i < suitList.length; i++) {	
				var pr = suitList[i],item = obj.isZiying ? pr.productList : pr.poolList,tmp = {},sku = [];
			    if(obj.isZiying){
			    	max = Math.max(max, pr.baseDiscount);
					tmp.reid = pr.packId;
					tmp.price = (pr.packPrice.amount).toFixed(2);
					tmp.dis = (pr.baseDiscount).toFixed(2);
					tmp.mprice = (pr.packPrice.amount + pr.baseDiscount).toFixed(2);
					tmp.item = [];
					sku.push(pr.packId);
			    }	
			    else{
			    	max = Math.max(max, pr.packPrice.suitDiscount);
					tmp.reid = pr.packId;
					tmp.price = (pr.packPrice.packPromotionPrice).toFixed(2);
					tmp.dis = (pr.packPrice.suitDiscount).toFixed(2);
					tmp.mprice = (pr.packPrice.packOriginalPrice).toFixed(2);
					tmp.item = [citem];
					sku.push(pr.packId);
					sku.push(obj.skuId);
			    }		
				
				for (var j=0; item[j] && j < item.length; j++) {
					if(obj.isZiying){
						var it = item[j];
						sku.push(it.skuId);
					    tmp.item.push({
					    	sku: it.skuId,
					    	link: '//wq.jd.com/item/view?sku='+it.skuId+'&ptag=7001.1.45',
					    	name: it.skuName,
					    	img: '//img14.360buyimg.com/n4/'+it.skuPicUrl,
					    	num: it.skuNum
					    });
					}
					else{
						var it = item[j].colorList[0].skuList[0];
						sku.push(it.skuId);
					    tmp.item.push({
					    	sku: it.skuId,
					    	link: '//wq.jd.com/item/view?sku='+it.skuId+'&ptag=7001.1.45',
					    	name: it.name,
					    	img: '//img14.360buyimg.com/n4/'+it.image,
					    	num: 1
					    });
					}
				};
				tmp.cartid = sku.join('_');
				relateds.push(tmp);
			};
				obj.isZiying ? obj.relatedItem[json.suit.data.skuId] = [relateds, max] : obj.relatedItem[json.suit.data.masterSkuId] = [relateds, max];
				obj.setRelated();
		};
		if(this.relatedItem[this.skuId]){
			this.setRelated();
		}
		else{
			obj.createTimeout('10','item relate api timeout');
			ls.loadScript({
					url: '//c.3.cn/recommend?callback=relatedSuit&methods=suit&channel='+(this.isWX?4:5)+'&sku='+this.skuId+'&cat='+this.jdCategory.slice(0,3).join(','),
					charset: 'GBK'
				});
		}
	};
	
	ItemDet.prototype.setRelated = function(){
		var data = this.relatedItem[this.skuId];
		if(!data || data[0].length==0) return;	
		if(this.cpart == 'main'){
			$('#relatedNotice').html('最高省 <span class="price">'+data[1]+'</span>元，共'+data[0].length+'款');
			$('#relatedEnter').show();
			this.iconHtml = '<em class="hl_red_bg">优惠套装</em>' + this.iconHtml;	
			this.setPromoteTitle();
		}
		else{
			var html=[], data=data[0];
			var tpl = $id('relatedTpl').text, tpl2 = $id('relatedBigTpl').text, tpl3 = $id('relatedSmallTpl').text;
			for (var i = 0; i < data.length; i++) {
				var html2=[], html3=[];
				for (var j=0; j < data[i].item.length; j++) {
					html2.push($jsonToTpl(data[i].item[j], tpl2));
					html3.push($jsonToTpl(data[i].item[j], tpl3));
				};
				data[i].no = i+1;
				data[i].itemBig = html2.join('');
				data[i].itemSmall = html3.join('');
				html.push($jsonToTpl(data[i], tpl));
			}
			
			$('#relatedDet').html(html.join(''));
		}
		
		$("#related_s_1").trigger("tap");
		if(urlParam.getUrlParam('isrelated')) window.location.hash = '#related';
	};
	
	ItemDet.prototype.showRelatedItem = function(em){
		var id = em.id, cell = $(em.parentNode.parentNode);
		if(id.indexOf('_s_') > 0){
			cell.addClass('detail_row_unfold');
			cell.find('[val="small"]').hide();
			cell.find('[val="big"]').show();
			this.setDelayTime();		
		}
		else{
			cell.removeClass('detail_row_unfold');
			cell.find('[val="small"]').show();
			cell.find('[val="big"]').hide();		
		}
	};
	
	ItemDet.prototype.loadGuess = function(){
		//if(this.isAd) return;
		var obj = this, tjw = (this.isAd ? 630006: (this.isWX ? 902026:635015)),isMixerCgi = (!this.isAd),expVal = (obj.isWX ? (obj.isZiying ? '1742':'1877'):(obj.isZiying ? '1744':'1879'));
		if(!this.timeout.reloadGuess){
			this.timeout.reloadGuess = setTimeout(function(){
				if(!$('#guessItem').html())
					obj.loadGuess();
			}, 6000);
		}
		this.createTimeout('9','item guess api timeout');		
		window['cb'+tjw] = function(json){
			obj.delTimeout('itil9');
			JD.report.umpBiz({bizid:'25',operation:'9',result:'0',source:'0',message:'item guess api loaded'});
			var data = json.data;
			if(!data||data.length==0 || $('#guessItem').html()) return;
			var tpl = '<a href="{#link#}" repURL="{#clk#}" source="{#source#}" id="tjwguess_{#no#}" class="item"><div class="img"><img back_src="{#image#}"></div><div class="txt">{#name#}</div><div class="info"><span class="num">{#price#}</span></div></a>',
				flow = json.flow,html=[],dataItem={},
				linkPtag = '7001.1.45',len=data.length,isNeedMore=false;
			if(isMixerCgi){
				linkPtag = '7001.1.60';
				if(len>29){  //30个，为更多猜你喜欢引流
					len = 29;
					isNeedMore = true;
				}
			}else{
				expVal='0'
			}
			for (var i = 0; i < len; i++) {
				dataItem = data[i];
				dataItem.link = '//wq.jd.com/item/view?sku='+dataItem.sku+'&ptag='+linkPtag+'&exp='+expVal+'&rec='+tjw;
				dataItem.image = '//img14.360buyimg.com/n2/'+dataItem.img;
				dataItem.name = dataItem.t;
				dataItem.price = dataItem.jp;
				dataItem.no = i;
				if(isMixerCgi){
					dataItem.clk = dataItem.clk ? dataItem.clk : dataItem.clk_url;
					dataItem.link += '&flow='+flow+'&sid='+dataItem.sid+'&source='+dataItem.source;
				} 
				html.push($jsonToTpl(dataItem, tpl));
			}
			//加上查看更多
			if(isNeedMore) html.push('<a href="//wqs.jd.com/item/recommend_more.shtml?sku='+obj.skuId+'&ptag=7001.1.66&category='+obj.jdCategory.slice(0,3).join('_')+'&price='+obj.jdPrice+'&adids='+expVal+'" class="item more"><div class="more_box"><i class="icon_more"></i><div class="desc">查看更多</div><div class="icon_go"></div></div></a>');
			//曝光上报
			var impr = json.impr,expid = getVParam('expid',impr),reqsig = getVParam('reqsig',impr),csku = getVParam('csku',impr);
			if(impr.indexOf('mercury')>-1){
				report.guessyoulikeReport({
					src:'rec',   //一定放在第一个
					action:0,  //0：展示；1：点击；2：马上看到（预加载）；3：请求。
					sku:obj.skuId,
					csku:csku,
					expid:expid,
					reqsig:reqsig,
					t:'rec.'+tjw
				});
			} 
			$('#guessArea').show();

			var tab=[];
			while(html.length){
				var div = document.createElement('div');
				div.className = 'itm_list';
				div.innerHTML = html.splice(0,6).join('');
				$('#guessItem').append(div);
				tab.push('<li></li>');
			}
			$('#guessItemTab').html(tab.length>1 ? tab.join(''): '');
			
			var showImg = function(dom){
				dom.find('img').each(function(){
					if($(this).attr('back_src')){
						this.src = $(this).attr('back_src');
						$(this).removeAttr('back_src');
					}
				});
			};

			if(tab.length == 1){
				showImg($('#guessItem'));
			}
			else{
				loopSrcoll.init({
					tp : 'text', //图片img或是文字text
					min : 20,
					//loadImg:true,
					moveDom : $('#guessItem'),
					moveChild: $('#guessItem').children(),
					tab:$('#guessItemTab li'),
					//touchDom2:[$id('guessItem').parentNode, $id('evalDet_main')],
					//loopScroll:true,
					lockScrY:true,
					enableTransX:true,
					index: 1,
					fun:function(index){
						showImg($(this.moveChild[index-1]));
					}
				});
			}
			$('#guessItem').on('click','.itm_list a.item',function(e){
				var $em = $(this),repurl = $em.attr('repURL'),toLink = $em.attr('href'),itemSource=$em.attr('source');
				if(!repurl) return;
				if(itemSource=='1'){  //广告的上报
					window.sessionStorage && window.sessionStorage.setItem('reportTJW',JSON.stringify({value:repurl}));
				} 
				if(isMixerCgi){
					var	val = urlParam.getUrlParam('flow',toLink)+'_'+urlParam.getUrlParam('source',toLink)+'_'+urlParam.getUrlParam('sid',toLink);
					cookie.set('adinfo', val, 30, '/', 'jd.com');
				}
				if(itemSource=='0' && impr.indexOf('mercury')>-1){ //点击上报  推荐的上报
					var indx = ($em.attr('id') && $em.attr('id').match(/\d+/) && $em.attr('id').match(/\d+/)[0]) || 0;//根据ID匹配推荐位位置
					csku = urlParam.getUrlParam('sku',toLink);
					report.guessyoulikeReport({
						src:'rec',
						action:1,  //0：展示；1：点击；2：马上看到（预加载）；3：请求。
						sku:obj.skuId,
						csku:csku,
						expid:expid,
						reqsig:reqsig,
						index:indx,
						t:'rec.'+tjw
					});
				}
			});
			function getVParam(name,url){
            	//参数：变量名，url为空则表从当前页面的url中取
	            var u  = arguments[1] || window.location.search,
	                reg = new RegExp(name +"=([^\$|&]*)"),
	                r = u.substr(u.indexOf("\?")+1).match(reg);
	            return r!=null?r[1]:"";
        	}
		};
		var uuid = (cookie.get('jd_uuid')||cookie.get('visitkey'));
		var url = function(p){
			var c = obj.item().category;
			if(isMixerCgi){  //80%的自营商品使用数字营销提供的接口
				return ['//mixer.jd.com/mixer?p='+p,
				'uuid='+uuid,
				'sku='+obj.skuId,
				'pin='+encodeURIComponent(cookie.get('jdpin')),
				'c1='+c[0]+'&c2='+c[1]+'&c3='+c[2],
				'lid='+obj.jdAddrId[0],
				'lim=30&sp=&hi=&fe=&fne=&ro=&ec=utf-8&iplocation=&app_info=&ad_ids='+expVal,
				obj.isWX?'mobile_type=3&device_type=512&device_id='+cookie.get('open_id'):'mobile_type=4&device_type=1024&device_id='+(cookie.get('open_id')||cookie.get('sq_open_id')),
				'callback=cb'+p].join('&');
			}
			return ['//diviner.jd.com/diviner?p='+p,
			'uuid='+uuid,
			'sku='+ obj.skuId,
			'pin=&c1='+c[0]+'&c2='+c[1]+'&c3='+c[2],
			'lid='+obj.jdAddrId[0],
			'hi='+ (obj.isWX ? cookie.get('open_id'):(cookie.get('open_id')||cookie.get('sq_open_id'))),
			'lim=30&sp=&fe=&fne=&ro=',
			'ec=utf-8',
			'callback=cb'+p,
			't='+Math.random()].join('&');
		};
		ls.loadScript(url(tjw));
		JD.store.get("reportTJW",function(a,b){  //跨域取
			if(b && b.value){
				(new Image).src = b.value.replace('http://','//');
				JD.store.set("reportTJW",'',function(key,value){},"wqs.jd.com",true); //跨域删除
			}
		},"wqs.jd.com",true);
		if(window.sessionStorage && window.sessionStorage.getItem('reportTJW')){
			try{
				var reportTJW = JSON.parse(window.sessionStorage.getItem('reportTJW')).value;
				if(reportTJW) (new Image).src = reportTJW.replace('http://','//');
			}catch(e){}
		 	window.sessionStorage.removeItem('reportTJW');
		}
	};
	
	//从移动版商祥转到京东版
	ItemDet.prototype.detItemToSku = function(){
		var obj = this;
		obj.showMobileDet = false;
		obj.isLoadDet[obj.detIndex] = null;
		obj.jdSkuInfo['det'][obj.skuId] = null;
		obj.detIndex = 0;
		obj.showDetTab(1);
	};
	
	//格式化商祥的html
	ItemDet.prototype.tavlHTML = function(str){
		if(!str) return '';
		var imgReg = /<img([^>]+)src="([^"]+)"([^>]*)/ig,
			imgReg2 = /width/ig,
			emptyImg = '//static.paipaiimg.com/qqbuy/img/transparent.png',
			linkReg1 = /href="([^"]+)"/ig,
			linkReg2 = /href='([^']+)'/ig,
			linkReg3 = /height="0px"/ig,
			imgReg4 = /height/ig,
			//imgBrReg = /(<img[^\>]*>)((?:\s*<br\s*\/>\s*)+)(?=<img[^\>]*>)/ig;  //用于删除图片间br标签
			imgBrReg = /<\s*br.*?>/ig;  //替换所有br标签
		var webp = $.os.ios ? '!q80.jpg' : '!q80.jpg.webp';
		return str = str.replace(imgReg, function($0,$1,$2,$3){return '<img'+$1+'init_src="'+JD.img.getImgUrl($2)+ '" src="' + emptyImg + '"'+$3;})
						.replace(imgReg2, 'w')
						.replace(linkReg1, '')
						.replace(linkReg2, '')
						.replace(linkReg3, 'style="display:none"')
						.replace(imgReg4, 'h')
						.replace(/<iframe.*?iframe>/ig, '')
						.replace(/img10/g, 'img14')
						.replace(imgBrReg, '<div class="for_separator"></div>')
						.replace(/http:\/\//g,'//');
	};
	
	//店铺信息
	ItemDet.prototype.shopInfo = function(data){  //传递库存信息
		var obj = this,
			shopInfoHtml='',postNotice3Html = '由京东发货并提供售后服务';
		if(!data) data = {};
		if(data.serviceInfo) postNotice3Html = data.serviceInfo.replace(/<.*?>/ig, '');
		shopInfoHtml = '<span class="tip">京东自营</span>&nbsp;<span class="name">本商品'+postNotice3Html+'</span>';
		if(obj.venderId*1){
			var json = data.self_D||data.D||{vender:'京东'};
			obj.venderName = json.vender;
			shopInfoHtml = '<div class="name">'+json.vender+'</div><div class="desc">'+ (obj.isZiying ? ((obj.isOverseaPurchase>0 ? '<div class="mod_sign_tip bg_1 bor"><b><i class="i_global"></i> 全球购</b><span>自营</span></div>':'<span class="tip">京东自营</span>')) : (obj.isOverseaPurchase>0 ? '<div class="mod_sign_tip bg_1 bor"><b><i class="i_global"></i> 全球购</b></div>':json.linkphone)) +'</div>'; 
			obj.checkChartStatus(json.id);  //检查服务在线状态
			obj.showShopLink(obj.item().shopInfo && obj.item().shopInfo.logo);
			$('#shopLinks, #quick_shoplink,#gotoShop').show();
			//店铺链接写死，防止venderId变化
			obj.shopUrl = '//wq.jd.com/mshop/gethomepage?venderId=' + obj.venderId + '&source=' + (obj.isWX ? 1 : 0) + '&sid=' + cookie.get('sid')+'&loginFlag=1';
			$('#shopFav').parent().show();
			$('#shopLogo').parent().show();
			if(obj.jdSkuInfo['venderInfo']) $('#shopBaseInfo').show();
		}else{
			$('#shopLogo').parent().hide();
			$('#shopFav').parent().hide();
			$('#shopBaseInfo').hide();
			obj.checkChartStatus();  //检查服务在线状态
		}
		$('#postNotice3').html(postNotice3Html);
		$('#shopInfo').html(shopInfoHtml);
		$('#serviveArea').removeClass('service_wrap_none'); //对于经过库存方法的sku都会打开
	};

	ItemDet.prototype.getVenderInfo = function(){  //获取店铺信息，店铺区域增加上新
		var obj = this;
		if(!obj.venderId || obj.venderId=='0') return;//不存在venderId
		window.getVenderInfoCB = function(data){
			if(data.fansNum=='0'&&data.newNum=='0'&&data.promotionNum=='0') return;
			obj.jdSkuInfo['venderInfo'] = data;
			var baseInfoArr = $('#shopBaseInfo .de_c_orange');
			baseInfoArr.eq(0).html(data.fansNum);
			baseInfoArr.eq(1).html(data.newNum);
			baseInfoArr.eq(2).html(data.promotionNum);
			$('#shopBaseInfo').show();
		};
		if(obj.jdSkuInfo['venderInfo']){
			window.getVenderInfoCB(obj.jdSkuInfo['venderInfo']);
		}else{
			ls.loadScript('//wq.jd.com/wdcolumn/mshopnumshow/getmshopdetail?callback=getVenderInfoCB&venderid='+obj.venderId);
			// try{
			// 	obj.ajaxSend(ls.addToken('//wq.jd.com/wdcolumn/mshopnumshow/getmshopdetail?callback=getVenderInfoCB&venderid='+obj.venderId),{
			// 		operationNo:'13',
			// 		msg:'item mshopnumshow api',
			// 		umpResultCode:{'302':'4','timeout':'5','other':'6'}
			// 	});
			// }catch(e){
			// 	JD.report.umpBiz({bizid:'25',operation:'13',result:'12',source:'0',message:e});
			// }
			
		}
	};

	ItemDet.prototype.checkIsFavShop = function(){  //检查是否收藏店铺
		var obj = this;
		if(!login.isLogin()) return;
		window.checkFavShopCB = function(json){
			if (json.iRet == "0") {
                if (json.state == "0") {
                    $('#shopFav').removeClass('faved').html('收藏店铺');
                } else {
                    $('#shopFav').addClass('faved').html('已收藏店铺');
                }
            }
		};
		ls.loadScript('//wq.jd.com/fav/shop/QueryOneShopFav?venderId=' + obj.venderId + '&callback=checkFavShopCB&t=' + Math.random());
		// try{
		// 	obj.ajaxSend(ls.addToken('//wq.jd.com/fav/shop/QueryOneShopFav?callback=checkFavShopCB&venderId=' + obj.venderId + '&t=' + Math.random()),{
		// 		operationNo:'13',
		// 		msg:'item QueryOneShopFav api',
		// 		umpResultCode:{'302':'7','timeout':'8','other':'9'}
		// 	});
		// }catch(e){
		// 	JD.report.umpBiz({bizid:'25',operation:'13',result:'13',source:'0',message:e});
		// }
	};

	ItemDet.prototype.shopFav = function(){ //收藏店铺
		var obj = this,
		    btn = $('#shopFav');
		if(!login.isLogin()){ 
			obj.login();
			return;
		}
		if(obj.isHoldFav) return;
		obj.isHoldFav = true;
		setTimeout(function(){obj.isHoldFav = false;}, 600);
		if($('#shopFav').hasClass('faved')){
			window.delShopFavCB = function(json){
				if (json.iRet == "9999") return;
				if(json.iRet == "0" || json.iRet == "20"){
					btn.removeClass("faved").html('收藏店铺');
					obj.showNotice('取消成功');
				}
			};
			ls.loadScript("//wq.jd.com/fav/shop/DelShopFav?venderId=" + obj.venderId + "&callback=delShopFavCB&t=" + Math.random());
		}else{
			window.addShopFavCB = function(json){
				if (json.iRet == "9999") return;
				if(json.iRet == "0" || json.iRet == "2"){
					btn.addClass("faved").html('已收藏店铺');
					obj.showNotice('收藏成功');
				}
			};
			ls.loadScript("//wq.jd.com/fav/shop/AddShopFav?venderId=" + obj.venderId + "&callback=addShopFavCB&t=" + Math.random());
		}
	};
	
	ItemDet.prototype.showShopLink = function(url){
		var obj = this;
		if(url){
			$('#shopLogo').attr('src', url);
			return;
		} 
		window.shopLink = function(json){
			if(json.errorCode == 0){
				if(json.shopLogoUrl){
					$('#shopLogo').attr('src', json.shopLogoUrl.replace('http://','//'));
				}
			}
		};
		ls.loadScript('//wq.jd.com/mshop/CheckVenderId?callback=shopLink&venderId='+ this.venderId + '&t='+Math.random());
	};
	//检查店铺客服是否在线
	ItemDet.prototype.checkChartStatus = function(shopId){
		var obj = this;
		this.shopImLink = ['//wq.jd.com/wqmsg/dongdong/goodsquery?skuid=' + obj.skuId,
			'imgUrl=' + (encodeURIComponent(obj.loopImg[0])),
			'name=' + (encodeURIComponent(obj.item().skuName)),
			'price=' + ($('#priceSale').attr('p') || 'KONG'),
			'source=' + (obj.isWX?0:1),
			'sid='+(cookie.get('sid')||'')].join('&');
		window.checkChatStatuCb = function(json){
			json.code == 1 ? $('#shopIM').addClass('on') : $('#shopIM').removeClass('on');
		};
		ls.loadScript('//chat1.jd.com/api/checkChat?callback=checkChatStatuCb&pid=' + obj.skuId + '&t='+Math.random()); //+ (shopId ? '&shopId=' + shopId : '') + (obj.venderId && obj.venderId != 0 ? '&venderId='+ obj.venderId : ''));
	};

	//获取并检查   所有sku收藏状态
	ItemDet.prototype.checkFav = function(){
		var obj = this;
		if(cookie.get('dofav')){
			cookie.del('dofav');
			this.isLoginAct = true;
			this.fav();
		}
		else if(cookie.get('wq_uin') && cookie.get('wq_skey')){  //简单判断登陆
			obj.createTimeout('6','item collection api(chcek) timeout');
			window.checkFav = function(json){
				if(json.iRet != '0') return;
				var data = json.data;
				for (var i = 0; i < data.length; i++) {
					obj.favInfo[data[i].skuid] = data[i].state == '1';
				};
				obj.setFavStatus();
				obj.delTimeout('itil6');
			};

			var param = {'commId': this.jdSkuIds.join(','), 'shopId':(this.venderId||0), 't':Math.random()};
			setTimeout(function(){ls.loadScript('//wq.jd.com/fav/comm/FavManyCommQuery?callback=checkFav&' + $.param(param));}, 1500);
		}
	};

	//设置状态
	ItemDet.prototype.setFavStatus = function(){
		if(this.favInfo[this.skuId]){
			$('#fav').addClass('fav_on');
			$('#fav .txt').html('已收藏');
		}
		else{
			$('#fav').removeClass('fav_on');
			$('#fav .txt').html('收藏');
		}
	};
	
	//收藏  & 取消收藏
	ItemDet.prototype.fav = function(){
		var obj = this;
		if(obj.isHoldFav) return;
		
		if(!this.jdSkuStatus){
			document.getElementById('skuCont').scrollIntoView(true);
			this.showNotice('请选择颜色/尺寸');
			return false;
		}
		obj.isHoldFav = true;
		setTimeout(function(){obj.isHoldFav = false;}, 600);
		obj.createTimeout('6','item collection api timeout');
		if(this.favInfo[this.skuId]){ //取消收藏
			window.cancelFav = function(json){
				if(json.iRet == '9999') return; //0是成功  但是点快了就会是1  不做精细判断了  当都删除成功
				obj.favInfo[obj.skuId] = false;
				obj.setFavStatus();
				obj.showNotice('取消成功');
				obj.delTimeout('itil6');
			};
			var param = {'commId': this.skuId, 'shopId':(this.venderId||0), 't':Math.random()};
			ls.loadScript('//wq.jd.com/fav/comm/FavCommDel?callback=cancelFav&' + $.param(param));
		}
		else{ //收藏
			window.addFav = function(json){
				if(json.iRet == '9999'){
					if(obj.isLoginAct) {
						JD.report.umpBiz({bizid:'25',operation:'6',result:'0',source:'0',message:'item collection api loaded'});
						return; //登陆有问题
					}
					cookie.set('dofav','ok',1);
					obj.login();
				}
				else if(json.iRet == '2') {
					obj.showNotice('已达到商品收藏上限');
				}
				else if(json.iRet == '0' || json.iRet == '3') {
					obj.favInfo[obj.skuId] = true;
					obj.setFavStatus();
					obj.showNotice('收藏成功');
					//obj.addFavReport();  //收藏成功上报
				}
				obj.delTimeout('itil6');
			};

			var tmp=this.skuPro.id[this.skuId] || [],
			param = ['//wq.jd.com/fav/comm/FavCommAdd?callback=addFav&commId=' + this.skuId,
			'shopId='+(this.venderId||0),
			'commTitle='+encodeURIComponent(this.item().skuName),
			'commPrice='+(this.jdPrice*100).toFixed(0),
			'shopName='+encodeURIComponent(this.venderName),
			'imageUrl='+encodeURIComponent(this.loopImg[0]),
			'commColor='+(tmp[0]||''),
			'commSize='+(tmp[1]||''),
			't='+Math.random()];
			ls.loadScript(param.join('&'));
		}
	};
	//延保服务上新接口
	ItemDet.prototype.loadNewYanBao = function(){
		var obj = this,
			url = ['//baozhang.jd.com/bindSkusWeb/queryBindSkus.do?callback=yanbaoCB&mainSkuId='+obj.skuId,
				'brandId='+(obj.item().brandId||''),
				'thirdCategoryId='+(obj.jdCategory[2]||''),
				'pin='+(cookie.get('jdpin')||''),
				'area='+obj.jdAddrId.slice(0,4).join('_')].join('&');
		window.yanbaoCB = function(list){
			if(!list || list.length === 0) return;
			var iconArr={'CXTH':11,'ZHBX':7,'YCBX':8,'FWBZ':10,'YWBH':9},ybItemHtml=[],ybHtml = [],skuList=[],ybItem={},skuItem={},skuHtml=[],
				tpl1 = '<div class="item" id="yb_{#categoryCode#}"><div class="label gray"><i class="icon_service icon_ins_{#iconNo#}"></i><div class="txt">{#displayName#}</div></div></div>',//商详主页面延保的各项
				tpl2 = '<div class="mod_bm_picker"><div class="tit"><i class="icon_ins_{#iconNo#}"></i>{#displayName#}</div><div class="option_list">{#listStr#}</div></div>',//延保二级页的每项标题：延长保修等
				tpl3 = '<div class="op_item" id="ybItem_{#bindSkuId#}" sku="{#bindSkuId#}" categorycode="{#categoryCode#}" skuname="{#bindSkuName#}" price="{#price#}"><div class="checkbox"><i class="icon_check"></i></div><div class="name">{#bindSkuName#}<span class="price">&yen;{#price#}</span>{#favor#}</div><div class="desc">{#tip#}</div></div>';//延保的每一子项
			for(var i = 0, len = list.length; i < len; ++i){
				skuHtml = [];
				ybItem = list[i];
				skuList = ybItem.fuwuSkuWebDetailList;
				for(var j = 0, jlen = skuList.length; j < jlen; ++j){
					skuItem = skuList[j];
					skuItem.categoryCode = ybItem.categoryCode;
					skuItem.favor = (skuItem.favor ? '<div class="mod_sign_tip bor"><span>优惠</span></div>':'');
					skuHtml.push($jsonToTpl(skuItem, tpl3));
				}
				ybItem.iconNo = (iconArr[ybItem.categoryCode]||0);
				ybItem.listStr = skuHtml.join('');
				ybHtml.push($jsonToTpl(ybItem, tpl2));
				ybItemHtml.push($jsonToTpl(ybItem, tpl1));
			}
			obj.yanbaoStr = ybItemHtml.join('');
			obj.yanbaoTip = '本商品支持购买'+list.length+'类京东服务，点击选择';
			$('#ybService').html(ybHtml.join(''));
			$('#ybArea2').html(obj.yanbaoTip);
			$('#ybArea').show();
			obj.isYanBao = true;
		};
		ls.loadScript(url);
	};
	//确认选择的延保服务
	ItemDet.prototype.setNewYanBao = function(){
		var obj = this,$item=[],$tar = [],$selected = $('#part_yanbao .op_item_selected');
		$('#ybArea2').html(obj.yanbaoTip);
		if($selected.length>0){
			$('#ybArea2').html(obj.yanbaoStr);
			$('#ybArea2 >div.item').hide();
			$selected.each(function(ind, item){//把选中的全部点亮
				var $item = $(item);
				$tar = $('#yb_'+$item.attr('categorycode'));
				$tar.attr('sku',$item.attr('sku'));
				$tar.find('div.label').removeClass('gray');
				$tar.find('div.txt').html($item.attr('skuname')+'<span class="price">¥'+$item.attr('price')+'</span>');
				$tar.show();
			});
			try{JD.report.rd({sku_id:obj.skuId, vender_id:obj.venderId||'', ptag:'7001.1.65'});}catch(e){};
		}
	};
	ItemDet.prototype.getNewYanBaoList = function(){
		var obj=this, skuids = [],$tar = [],sku='';
		$('#ybArea2>div.item').each(function(ind, item){
			$tar = $(item);
			sku = $tar.attr('sku');
			sku && skuids.push([sku,'0','0','0','0',obj.skuId,'0'].join(','));
		});
		return skuids;	
	};
	//延保服务
	ItemDet.prototype.loadYanbao = function(){
		var that = this,
			url = '//fuwu.jd.com/wechat/getServiceProducts.action?callback=serviceProductCb&productIds=' + that.skuId;
		window.serviceProductCb = function(list){
			if(!list || list.length == 0) return;
			var html = [],
				tpl = $id('ybServiceTpl').text,
				tpl2 = $id('ybServiceTpl2').text;
			for(var i = 0, len = list.length; i < len; ++i){
				var spro = list[i],
					tmps = [],
					products = spro.products,
					tempId = '';
				for(var j = 0, jlen = products.length; j < jlen; ++j){
					(j == 0) && (tempId = products[j].sortId);
					products[j].pSortId = spro.sortId;
					tmps.push($jsonToTpl(products[j], tpl2));
				}
				spro.sortInd = that.getSortInd(spro.sortId);
				spro.listStr = tmps.join('');
				html.push($jsonToTpl(spro, tpl));
			}
			$('#ybService').html(html.join(''));
			$('#ybArea').show();
			that.isYanBao = true;
		};
		ls.loadScript(url);
	};
	//确认选择延保服务
	ItemDet.prototype.setYanBao = function(){
		var that = this,
			tpl =  $id('ybListTpl').text;
			html = [];
		$('#part_yanbao .op_item_selected').each(function(ind, item){
			var tar = $(item),
				sortname = tar.attr('sortname'),
				price = tar.attr('price'),
				pSortId = tar.attr('psortid'),
				pid = tar.attr('pid');
			html.push($jsonToTpl({
				pid : pid,
				sortInd : that.getSortInd(pSortId),
				sortName : sortname,
				price : price
			}, tpl));
		});
		$('#ybList').html(html.join(''));
	};
	//服务图标下标
	ItemDet.prototype.getSortInd = function(gid){
		var sortInds = {
			'1' : '1',  //延长保修
			'5' : '3',  //意外保护
			'8' : '5',  //只换不修
			'10' : '',  //远程服务 (不存在)
			'14' : '4',  //上门服务
			'19' : '3',  //双11 (促销-用意外保护的图标)
			'26' : '6',  //原厂服务 黄 (原厂服务)
			'36' : '6',  //原厂服务 红 (原厂服务)
			'51' : '2'  //屏碎保
		};
		return sortInds[gid] || 0;
	};
	ItemDet.prototype.getYanBaoList = function(){
		var obj = this,pids=[],$tar = [],pid='';
		$('#ybList>div.item').each(function(ind, em){
			$tar = $(em);
			pid = $tar.attr('pid');
			pid && pids.push([pid,'0','0','0','0',obj.skuId,'0'].join(','));
		});
		return pids;
	};

	/**
commlist: 各个商品描述以“$”分隔，每个商品描述如下：
	itemid,itemattr,num,skuid,type,targetid,packid，各字段以“,”分隔；
itemid 如果是paipai商品则为拍拍商品id，如果是JD套装商品则为promotionid_skuid1_skuid2的形式，促销id和各套装单品skuid间以”_”分隔；其他单品和赠品则为商品的skuid
itemattr为商品库存属性串，非必选
num 商品数量，此处无效。
skuid非必选项;
type  1：单品；4：套装4；16：赠品（商品类型参看备注1: ItemTypeInCart）
targetid 如果是满返满赠套装中商品（单品或赠品），填写满返满增的促销ID；否则填0
packid，延保商品必选项，为套装编号；否则填0

type 操作类型，普通商品为0，添加赠品则为1，延保商品 则为2
locationid: JD三级地址
scene:  0购物车页添加商品；1，订单确认页添加商品
action：0：cart购物车购买；1：order一口价购买
reg：reg=1 表示如果用户未绑定pin，则绑定一个默认生成pin；0表示不为用户自动绑定默认pin
callback：js回调函数

	*/
	ItemDet.prototype.addCart = function(param){
		if(this.yushouStatus > 0 || !this.jdStatus){
			JD.report.umpBiz({bizid:'25',operation:'8',result:'4',source:'0',message:'item addcart can not add'});
			return false;
		} 
		if(!this.jdSkuStatus){
			document.getElementById('skuCont').scrollIntoView(true);
			this.showNotice('请选择颜色/尺寸');
			JD.report.umpBiz({bizid:'25',operation:'8',result:'2',source:'0',message:'item addcart sku not ready'});
			return false;
		}

		var obj=this, type=0, commlist=[this.skuId, this.itemId, this.buyNum, this.skuId, '1,0,0'];
		// if(JD.device.scene==='qqbrower'){ //QQ浏览器，跳转到微信
		// 	obj.login(location.href.replace(obj.baseSkuId, obj.skuId));
		// 	return;
		// }
		type = ((this.item().attr && this.item().attr.indexOf('isXnzt') != -1) ? '3':'0');
		if(param && typeof(param) == 'object'){
			if(param.type) type = param.type;
			if(param.commlist) commlist = param.commlist;
		}
		var paramStr = ['//wq.jd.com/deal/mshopcart/addcmdy?callback=addCartCB&scene=2&reg=1',
		'type='+type,
		'commlist='+commlist.join(','),
		'locationid='+[this.jdAddrId.slice(0,3).join('-')],
		't='+Math.random()];
		if(this.isYanBao){  //延保服务
			var pids = this.getNewYanBaoList();
			if(pids.length > 0){
				paramStr.push('isnewyb=1&ybcommlist=' + pids.join('$'));
			}
		}
		this.createTimeout('8','item addcart api timeout');
		window.addCartCB = function(json){
			obj.delTimeout('itil8');
			if(json.errId == '13'){
				JD.report.umpBiz({bizid:'25',operation:'8',result:'3',source:'0',message:'item addcart not login'});
				if(obj.isLoginAct) {
					return; //登陆有问题
				}
				obj.isLoginAct = true;
				var cookieStr = (param && typeof(param) == 'object') ? JSON.stringify(param) : 'ok';
				cookie.set('doAddCart',cookieStr,1);
				window.location.href = json.nextUrl+encodeURIComponent(location.href.replace(obj.baseSkuId, obj.skuId));
			}
			else if(json.errId == '8968'){
				obj.showNotice('商品数量最大超过200');
				JD.report.umpBiz({bizid:'25',operation:'8',result:'5',source:'0',message:'item addcart over 200'});
			}
			else if(json.errId == '8969'){
				obj.showNotice('添加商品失败，已超出购物车最大容量！');
				JD.report.umpBiz({bizid:'25',operation:'8',result:'5',source:'0',message:'item addcart over capacity'});
			}
			else if(json.errId == '0'){
				JD.report.umpBiz({bizid:'25',operation:'8',result:'0',source:'0',message:'item addcart api loaded'});
				obj.showNotice('添加成功');
				$('#popone').html('+'+obj.buyNum).addClass('show');
				setTimeout(function(){$('#popone').removeClass('show');},2000);
				obj.setCartNum(json.cart.mainSkuNum*1);
				//obj.addCartReport();  //加入购物车成功上报
			}
			else{
				obj.showNotice('添加失败，请稍后再试');
				JD.report.umpBiz({bizid:'25',operation:'8',result:'5',source:'0',message:'item addcart fail'});
			}
		};
		ls.loadScript(paramStr.join('&'));
	};

	ItemDet.prototype.setCartNum = function(num){
		var n = cookie.get('cartNum')*1 || 0;  //localStorage.getItem('cartNum')*1 ||
		if(num){
			n = num;
			cookie.set('cartNum', n, 999999, "/", 'jd.com');
			localStorage.setItem('cartNum', n);
		}
		n ? $('#cartNum').html(n>99?'99+':n).show() : $('#cartNum').hide();
	};
	
	ItemDet.prototype.addCartRelated = function(em){
		var cartid = $(em).attr('cartid');
		if(!cartid) return;
		this.addCart({type:0, commlist:[cartid, '', 1, '', '4,0,0']});
	};

    //登陆跳转
    ItemDet.prototype.loginLocation = function (url, isStat){
    	var stat = login.isLogin();
    	if(isStat) return stat;
    	
        if(stat){  //简单判断登陆
            location.href = url;
        }
        else{
            this.login(url);
        }
    };

	//登陆
	ItemDet.prototype.login = function(reUrl) {
		reUrl = reUrl || location.href;
		login.login({rurl:reUrl});
		// var obj = this;
		// if(JD.device.scene==='qqbrower' && obj.qqBrowserWx){//qq浏览器
		// 	JD.qqbrower.openUrlInWechat(reUrl,function(a,b){//0表示成功,   QQ浏览器，跳微信
		// 		JD.report.umpBiz({bizid:'25',operation:'19',result:a,source:'0',message:JSON.stringify(b)}); 
		// 		if(a != 0){  //打开失败
		// 			obj.qqBrowserWx = false;//失败了，只跳转一次
		// 			login.login({rurl:reUrl}); 
		// 		}
		// 	});
		// }else{
		// 	login.login({rurl:reUrl});
		// }
		// setTimeout(function(){
		// 	obj.qqBrowserWx = false;
		// 	login.login({rurl:reUrl});
		// },2000);
    };

    //拼购买链接
	ItemDet.prototype.getBuyLink = function() {
		var obj = this;
		if(!this.jdStatus){
			if($('#buyBtn2').hasClass('btn_disable')){
				JD.report.umpBiz({bizid:'25',operation:'15',result:'2',source:'0',message:'item buy other'+obj.skuId}); //diabled
			}else{
				JD.report.umpBiz({bizid:'25',operation:'7',result:'3',source:'0',message:'item buy can not buy'+obj.skuId});
			}
			return false;
		} 

		if(!this.jdSkuStatus){
			document.getElementById('skuCont').scrollIntoView(true);
			this.showNotice('请选择颜色/尺寸');
			JD.report.umpBiz({bizid:'25',operation:'7',result:'2',source:'0',message:'item buy sku not ready'});
			return false;
		}
		if(!this.skuJson[this.skuId] || !this.skuJson[this.skuId].item){
			return false;
		} 
		if(this.skuJson[this.skuId].feetype&&!this.cfeeType){
			document.getElementById('skuCont').scrollIntoView(true);
			this.showNotice('请选购买方式');
			JD.report.umpBiz({bizid:'25',operation:'7',result:'2',source:'0',message:'item buy sku not ready'});
			return false;
		}
		var weixinadkey = '';
		if(cookie.get('weixinadkey')){
			weixinadkey = '&weixinadkey='+cookie.get('weixinadkey');
		}

		var url = '';
		if(this.yushouStatus == 2){  //预售的预约链接
			return '//wqs.jd.com/item/yuyue_account.shtml?sku='+this.skuId;
            //return ls.addToken('//wq.jd.com/bases/yuyue/item?dataType=0&skuId='+this.skuId,'ls');   //加token
		}
		
		if(this.isHYKHSP){ //合约卡号sp
			return ['//wqs.jd.com/item/phone_simcard1.shtml?feeType=0',
					'sku='+this.skuId,
					'cityId='+this.jdAddrId[1],
					'provinceId='+this.jdAddrId[0]].join('&');
		}

		if(this.cfeeType && this.cfeeType.ft != 100){
			var tp = 'phone_option1', add='';
			if(this.cfeeType.ft == 18) tp='phone_option_cmcc1';
			if(this.cfeeType.ft == 28) add='&cucc=1';
			return ['//wqs.jd.com/item/'+tp+'.shtml?sku='+this.cfeeType.sku,
				'feeType='+this.cfeeType.ft,
				'sids='+(this.cfeeType.sids||''),
				'cityId='+this.jdAddrId[1],
				'provinceId='+this.jdAddrId[0]+add].join('&');
		}
		if(this.koStatus == 1 || this.koStatus == 2){
			if(obj.miaoErr.errId == '16385'){
				ui.alert({container:document.body, msg:obj.miaoErr.errMsg, onConfirm:function(){location.reload();}});
				JD.report.umpBiz({bizid:'25',operation:'7',result:'3',source:'0',message:'item buy can not buy'});
				return false;
			}
			return '//wqs.jd.com/order/s_confirm_miao.shtml?bid=' + (this.bid || '') + '&scene=jd&isCanEdit=1&EncryptInfo=&Token=&commlist=,,1,' + this.skuId + weixinadkey;
		}
		
		if(this.xuniBrandId){
		//	commlist=brandid,ppitemid,num,skuid,type
        //        type=1,表示游戏点卡 2表示Q币
        //        brandid是品牌id，应该是商祥传给你的
        //        ppitemid就是原先拍拍格式的itemid，没有的话就空着
        	var xltype={4835:1, 4836:2}, commlist=[this.xuniBrandId, '', this.buyNum, this.skuId, xltype[this.jdCategory[2]] || 0];
			return '//wqs.jd.com/order/s_confirm_virtual.shtml?commlist=' + commlist.join(',') + '#wechat_redirect';
		}

		if(this.locShopInfo['isLOC']){
			if(!this.locShopInfo['locationId'] || !this.locShopInfo['shopId']){
				JD.report.umpBiz({bizid:'25',operation:'7',result:'3',source:'0',message:'item buy can not buy'});
				return false;
			}
			return  (['//wqs.jd.com/order/wq.confirm.loc.shtml?commlist=' + [this.skuId, this.itemId, this.buyNum, this.skuId, '1,0,0'].join(','),
			        'venderid='+this.venderId,
				    'locationid='+this.locShopInfo['locationId'],
				    'shopid='+ this.locShopInfo['shopId']].join('&'));
		}
		var bf='', pg='',wdref='&wdref='+encodeURIComponent(this.protocol+'//wq.jd.com/item/view?sku='+this.skuId);  //登录二次跳转容易失去refer
		if(urlParam.getUrlParam('bf')) bf+='bf='+urlParam.getUrlParam('bf');
		if(this.isChou) bf+='zhongchou='+urlParam.getUrlParam('zhongchou');
		
		if(this.pgStatus > 0 && this.pgStatus < 10) pg= '&action=3&activeid='+this.pgInfo.active_id+'&bizkey='+this.pgInfo.biz_key+'&bizval='+this.pgInfo.biz_value+'&member='+this.pgInfo.tuan_member_count;
		if(this.pgStatus == 1111) pg = '&appprice=1';
		if(this.yuShouNoWayStatus == 1){  //预售进行中
			window.buyLink = '//wqs.jd.com/order/s_confirm_booking.shtml';
		}else{
			window.buyLink = '//wqs.jd.com/order/wq.confirm.shtml';
		}
		url = [ window.buyLink + '?bid=' + (this.bid||'')+weixinadkey+wdref,
				'scene=jd&isCanEdit=1&EncryptInfo=&Token=&commlist=' + [this.skuId, this.itemId, this.buyNum, this.skuId, '1,0,0'].join(','),
				'locationid='+this.jdAddrId.slice(0,3).join('-'),
				'type='+((this.item().attr && this.item().attr.indexOf('isXnzt') != -1) ? '3':'0'),
				this.item().attr == 'LuxuryGoods' ? 'lg=1':'lg=0',
				this.item().attr == 'isSupermarket' ? 'supm=1':'supm=0',
				pg + (pg && bf ? '&' : '') + bf];
		if(location.pathname.indexOf('mitem') > 0) url.push('ismitem=1');
		if(this.isYanBao){  //延保服务
			var pids = this.getNewYanBaoList();
			if(pids.length > 0){
				url.push('isnewyb=1&ybcommlist=' + pids.join('$'));
			}
		}
		if(this.isOverseaPurchase > 0){
			url.push('globalbuy=' + this.isOverseaPurchase);
		}
		if(this.isEcard) url.push('eCard=1');
		return url.join('&') + '#wechat_redirect';
	};


	//选择地址
	ItemDet.prototype.addressInit = function(){
		var obj = this;
		address.init({
			con : 'addrList',  //主容器id
			//onRender : fillAreas,  //自定义模板渲染
			onSelect : function(id, name, level){  //选择地区回调
				window.scroll(0,0);
				//if(level == 1){
				//	$('#resFilterTipBlock').html('配送至：' + name);
				//}
			},  
			onClose:function(){
				setTimeout(function(){obj.showPart('main');}, 200); //这里太容易点透
			},
			onFinish : function(area, areaId){
				obj.setAddrId();
				if(obj.cfee && obj.cfee.ft != 100){
					location.href = location.href.replace(obj.baseSkuId, obj.skuId).replace(/#.*/, '')+'&t='+Math.random();
					return;
				}
				obj.jdSkuInfo['price'] = null;
				obj.jdSkuInfo['promote'] = null;
				obj.skuJson = {};
				obj.setItemInfo();
				setTimeout(function(){
					obj.showPart('main', function(){if(obj.sliderProtal) obj.sliderProtal.resize($('#loopImgUl li').eq(0).width());});
				}, 200);
			},
			itil : {  //itil上报参数
				bid : '8',
				mid : '10',
				timeout : ['7:1'],
				success : ['6:1'],
				empty : ['8:1']
			}
		});
	};

	//选择地址
	ItemDet.prototype.chooseAddress = function(){
		this.showPart('address');
		address.show();
	};

	//购买数
	ItemDet.prototype.setBuyNum = function(num) {
		num = num*1 || 1;
		var tmp=num;
		num = Math.max(1, num);
		num = Math.min(this.maxBuyNum, num);
		this.buyNum = num;
		$('#buyNum').val(num);
		if(tmp > this.maxBuyNum) this.showNotice('单款最多可买'+this.maxBuyNum+'件');
		num == 1 ? $('#minus').addClass('minus_disabled') : $('#minus').removeClass('minus_disabled');
		this.maxBuyNum <= num ? $('#plus').addClass('plus_disabled') : $('#plus').removeClass('plus_disabled');
	};

	//设置详情tab的高度
	ItemDet.prototype.setDetHeight = function() {
		var h = $("#detail" + this.detIndex).height();
		$("#detail").css('height', Math.max(h, this.detLowH));
	};
		
	//判断浏览器是否支持sticky属性
	ItemDet.prototype.supportSticky = function () {
        var t, n = '-webkit-sticky', e = document.createElement("i");
        e.style.position = n;
        t = e.style.position;
        e = null;
        return t === n;
    };

	//滚动加载商祥图
	ItemDet.prototype.initLoadImg = function(tp) {
		var data = {cache:[]}, img=tp=='detPC' ? $("#detailPC img") : $("#detail1 img");
		img.each(function(i) {
			var dom = $(this);
			data.cache.push({
				url : dom.attr('init_src'),
				dom : dom
			});
		});
		data.num = data.cache.length;
		data.viewHeight = $(window).height();
		data.scrollOffsetH = 100;
		if(tp == 'detPC'){
			data.scrollOffsetH = 500;
			window._imagePC_data = data;
		}
		else{
			window._images_data = data;
		}
		this.loadImg(tp);
	};
	  
	ItemDet.prototype.loadImg = function(tp) {
		// 滚动条的高度
		if(tp == 'detPC'){
			var scrollHeight = $('#detailPC').scrollTop(), d = window._imagePC_data;
		}
		else{
			var scrollHeight = $(window).scrollTop(), d = window._images_data;
		}
		
		if (!d || d.num == 0) {
			return;
		}
		// 已经卷起的高度+可视区域高度+偏移量，即当前显示的元素的高度
		visibleHeight = d.viewHeight + scrollHeight + d.scrollOffsetH;
		$.each(d.cache, function(i, data) {
			var em = data.dom, imgH =tp=='detPC'?em.position().top:em.offset().top;
			// 图片在后面两屏范围内，并且未被加载过
			//if(tp=='detPC')$('#commDesc').append(['^'+visibleHeight, imgH].join('-'));
			if (visibleHeight > imgH && !em.attr("loaded")) {
				// 加载图片
				//em.attr('h', [d.viewHeight , scrollHeight , d.scrollOffsetH, visibleHeight, imgH].join(','))
				data.url && em.attr("src", data.url);
				em.removeAttr('init_src');
				em.attr("loaded", d.num+1);
				d.num--;
			}
		});
		
		this.setDetHeight();
	};

	//收藏成功上报
	ItemDet.prototype.addFavReport = function(){
		var url = '//wq.jd.com/shopgroup/shoucang_share?skuid=' + this.skuId + '&skuname=' + encodeURIComponent(this.item().skuName) + '&picimgurl=' + encodeURIComponent(this.loopImg[0]) + '&skuprice=' + (this.jdPrice*100).toFixed(0) + '&nickname=' + encodeURIComponent(cookie.get('nickname') || '');
		ls.loadScript(url);
	};

	//加入购物车成功上报
	ItemDet.prototype.addCartReport = function(){
		var url = '//wq.jd.com/shopgroup/gouwuche_share?skuid=' + this.skuId + '&skuname=' + encodeURIComponent(this.item().skuName) + '&picimgurl=' + encodeURIComponent(this.loopImg[0]) + '&skuprice=' + (this.jdPrice*100).toFixed(0) + '&nickname=' + encodeURIComponent(cookie.get('nickname') || '');
		ls.loadScript(url);
	};

	//滚动事件
	ItemDet.prototype.scroll = function() {
		if(this.detPCshow || this.blackCoverShow){
			if(this.detPCshow) this.loadImg('detPC');
			window.scrollTo(0, this.lockScrollH);  //还原用户的穿透式滚动
			return;
		}
		var obj = this, st = $(window).scrollTop();
		
		if(!this.isUseSticky){ //高版本浏览器到吸顶  不用处理
			this.detTabH = $('#detailBaseLine').offset().top;
			if(st > this.detTabH) {
				if (!this.detTabFloatShow)
					$('#detailTab').addClass('mod_tab_fixed');
				this.detTabFloatShow = true;
			} else {
				if (this.detTabFloatShow)
					$('#detailTab').removeClass('mod_tab_fixed');
				this.detTabFloatShow = false;
			}
		}
		
		if(st > this.pageHight*2){
			if (!this.gotoTopShow) $('.goTopBtn').show();
			this.gotoTopShow = true;
		}
		else{
			if (this.gotoTopShow) $('.goTopBtn').hide();
			this.gotoTopShow = false;
		}
		
		this.setDetHeight();
		
		if(this.detIndex == 1){
			this.loadImg('detMobile');
		}
		if (this.cpart == 'summary'){
			if (st >= (($(document).height() - $(window).height()) - 220)) {
				this.loadEval();
			}
		}
		
		if(this.quckIcoShow){
			$('#quckArea').removeClass('more_active');
			this.quckIcoShow = false;
		}
		this.lastST = st;
	};
	
	//隐藏查看电脑版的浮层
	ItemDet.prototype.hideDetPC = function(){
		$('#detailPCArea').removeClass('layer_show');
		setTimeout(function(){$('#detailPC').html('');}, 300);
		this.detPCshow = false;
	};
	
	//居中显示提示信息 （不只sku用）
	ItemDet.prototype.showNotice = function(str, t) {
		if(!str) return;
		t = t ? t : 2000;
		$('#noticeStr').html(str);
		$('#noticePanel').show();
		$('#noticePanel').css('margin-left', '-' + ($('#noticePanel').width())/2 + 'px');
		setTimeout(function(){
			$('#noticePanel').hide();
		}, t);
	};
	
	//设置延时，防止点透
	ItemDet.prototype.setDelayTime = function() {
		window.holdAction = true;
		setTimeout(function(){
			window.holdAction = false;
		},400);
	};
	//protal图 resize
	ItemDet.prototype.resizeProtal = function(showBlack){
		if(showBlack){
			var temp = $('#loopImgDiv').hasClass('mod_slider_viewer');
			if(temp){
				$('#loopImgDiv').removeClass('mod_slider_viewer');
			}else{
				$('#loopImgDiv').addClass('mod_slider_viewer');
				window.location.hash = '#img';
			}
		}
		if(this.sliderProtal) this.sliderProtal.resize($('#loopImgUl li').eq(0).width());
	};
	
	//绑定事件
	ItemDet.prototype.bindEvent = function() {
		$(window).on("scroll", $.proxy(this.scroll, this));
		this.isBind = true;
		var obj = this, hideDelay=true;
		var hideBlackCover = function(){
			if(hideDelay){
				setTimeout(function(){hideBlackCover();}, 300);
				hideDelay = false;
				return;
			}
			hideDelay = true;
			$('#blackCover').hide();
			obj.blackCoverShow = false;
			if($('#loopImgDiv').hasClass('mod_slider_viewer')){
				obj.resizeProtal(true);//非微信下  点击看大图时把这块内容抽出来显示
			}
			else{
				$('#imageViewer').hide();
			}
		};
		
		var showSingeImg = function(src){
			obj.lockScrollH = $(window).scrollTop();
			obj.blackCoverShow = true;
			$('#blackCover').show();
			$('#imageViewer').show();
			$('#fullImg').attr('src', src);
		};

		var showServiceIco = function(){
			$('#serviveArea').hasClass('detail_row_unfold') ? $('#serviveArea').removeClass('detail_row_unfold') : $('#serviveArea').addClass('detail_row_unfold');
		};
		
		//$('body').on('click', function(e){
		//	var em = e.srcElement || e.target;
		//	alert(em.id+'~~'+em.className)
		//});
		$('#commDesc, #evalDet_summary, #evalDet_main').on('click', function(e){
			var target = e.srcElement || e.target;
			if(target.nodeName == 'IMG'){
				var src = $(target).attr('prview') || target.src.replace(/\s+/g, '');
				if(window.WeixinJSBridge){
					var imgs=[];
					if($(target).attr('prview')){
						$(target).parent().parent().find('img').each(function(){imgs.push($(this).attr('prview'));});
					}
					else{
						imgs = [src];
					}
					src = (~src.indexOf('http') ? '':obj.protocol) + src;
					for(var i=0,len=imgs.length;i<len;i++){
						imgs[i] = (~imgs[i].indexOf('http') ? '':obj.protocol) + imgs[i];
					}
					WeixinJSBridge.invoke('imagePreview',{
	                    'current':src,
	                    'urls':imgs}
            		);
				}
				else{
					showSingeImg(src);
				}
			}
		});
		
		setTimeout(function(){  //延时绑定，防穿透
			var loopImg = [];
			for(var i=0,len=obj.loopImg.length;i<len;i++){
				loopImg.push((obj.loopImg[i].indexOf('http')>-1 ? '':obj.protocol) + obj.loopImg[i]);
			}
			$('#loopImgUl').on('click', function(e){
				$countRd('7001.1.3');
				if(window.WeixinJSBridge){
					WeixinJSBridge.invoke('imagePreview',{
						'current':loopImg[(obj.sliderProtal ? (obj.sliderProtal.index-1):0)],
						'urls':loopImg
					});
					return;
				}

				if(obj.loopImg.length == 1){
					showSingeImg(obj.loopImg[0]);
					return;
				}
				if(!obj.loopImg.length) return;
				if($('#loopImgDiv').hasClass('mod_slider_viewer')){  //hide
					window.history.go(-1);
				}
				else{                                                //show
					obj.lockScrollH = $(window).scrollTop();
					obj.blackCoverShow = true;
					$('#blackCover').show();
					obj.resizeProtal(true);
				}
			});
		}, 400);

		/*$('#serviceInfo').on('click', function(e){
			showServiceIco();
			e.preventDefault();
		});*/
		
		$('body').on('touchend', function(e){ //在多次滑动后  容易失去tap
			var target = e.srcElement || e.target, em=target, i=1;
			while(em && !em.id && i<=3){ em = em.parentNode; i++;}
			if(!em || !em.id) return;
			switch(em.id){
				case 'imageViewer': case 'fullImg':
					hideBlackCover();
					e.preventDefault();
				break;
				case 'blackCover':
					if($('#loopImgDiv').hasClass('mod_slider_viewer')){  //hide
						window.history.go(-1);
					}else{
						hideBlackCover();
					}
					e.preventDefault();
				break;
				case 'detailClosePC':
					obj.hideDetPC();
					e.preventDefault();
				break;
				case 'goTop':
					window.scroll(0,0);
					e.preventDefault();
				break;
			}
		});
		
		//$('body').on('touchend', function(e){
		//$('body').on('touchstart', function(e){
		$('body').on('tap', function(e){
			var target = e.srcElement || e.target, em=target, i=1;
			while(em && !em.id && i<=4){ em = em.parentNode; i++;}
			if(!em || !em.id) return;
			//if(obj.ptag[em.id]) setTimeout(function(){$countRd(obj.ptag[em.id]);}, 0);
			if (em.id.indexOf('couponItem_') > -1) {
				obj.getCoupon(em);
				return;
			}
			if (em.id.indexOf('related_') > -1) {
				obj.showRelatedItem(em);
				return;
			}
			if (em.id.indexOf('addCart_') > -1) {
				obj.addCartRelated(em);
				return;
			}
			if (em.id.indexOf('ybItem_') > -1) {
				var tar = $(em);
				if(tar.hasClass('op_item_selected')){
					tar.removeClass('op_item_selected');
				}else{
					tar.siblings('.op_item_selected').removeClass('op_item_selected');
					tar.addClass('op_item_selected');
				}
				return;
			}
			
			switch(em.id){
				case 'buyBtnExp':
					obj.pgStatus = 1111;  //先标记exp，然后继续走buyBtn2
				case 'buyBtn2':
					obj.delTimeout('itil7');
					obj.timeout.itil7=setTimeout(function(){
						JD.report.umpBiz({bizid:'25',operation:'7',result:'1',source:'0',message:'item buy click fail'+obj.skuId+window.buyUrl});
						if(window.buyUrl){
							JD.report.umpBiz({bizid:'25',operation:'15',result:'1',source:'0',message:'item buy jump fail in 4s'+obj.skuId+window.buyUrl});
						} 						
					}, obj.cgiTimeout); //3秒商详不跳转失败
					try{
						window.buyUrl = false;
						var url = obj.getBuyLink(),ptag = ($('#buyBtn2').text()=='立即抢购' ? '7001.1.9' : '7001.1.8');
						//if(url) url = util.addRd(url,ptag);
						window.buyUrl = url;
						if(!url) obj.delTimeout('itil7');
						cookie.set('buysku', obj.skuId, 30);  //下单页用
						if(window.jdm){  //秒杀用
							var v = jdm.x(jdm.y);
							jdm.z && cookie.set(jdm.z,v,999999,"/", 'jd.com');
							if(!obj.isWX) cookie.set('wqmnx','180850892b323d04f811f0ab89cbhq86',999999,"/", 'jd.com');
						}
						JD.report.rd({sku_id:obj.skuId, vender_id:obj.venderId||'', ptag:ptag});
						if(url){
							JD.report.umpBiz({bizid:'25',operation:'7',result:'0',source:'0',message:'item buy clicked'});
							obj.loginLocation(url);
						}
					}
					catch(e){
						if(url) location.href = url;
						JD.report.umpBiz({bizid:'25',operation:'15',result:'8',source:'0',message:'item buy jserror'+e});
					}
					
					if(!url) obj.delTimeout('itil7');
					return false;
				break;
				case 'viewGuess':
					if($('#guessArea')[0]) $('#guessArea')[0].scrollIntoView(true);
				break;
				case 'arrivalNotice':
					obj.loginLocation('//wqs.jd.com/item/arrival_notice.shtml?sku='+obj.skuId);
				break;
				case 'quckIco2':
					obj.quckIcoShow ? $('#quckArea').removeClass('more_active') : $('#quckArea').addClass('more_active');
					obj.quckIcoShow = !obj.quckIcoShow;
					return;
				break;
				case 'plus': case 'minus':
					if(em.className.indexOf('disabled') != -1) return;
					var num = em.id == 'plus' ? obj.buyNum + 1 : obj.buyNum - 1;
					obj.setBuyNum(num);
				break;
				case 'pcItemLink':
					obj.detItemToSku();
				break;
				case 'couponRow':
					$('#couponListDiv').hasClass('detail_row_unfold') ? $('#couponListDiv').removeClass('detail_row_unfold') : $('#couponListDiv').addClass('detail_row_unfold');
				break;
				case 'fav':
					try{JD.report.rd({sku_id:obj.skuId, vender_id:obj.venderId||'', ptag:'7001.1.23'});}catch(e){};
					obj.fav();
				break;
				case 'shopFav':
					obj.shopFav();
				break;
				case 'addCart2':
					try{JD.report.rd({sku_id:obj.skuId, vender_id:obj.venderId||'', ptag:'7001.1.10'});}catch(e){};
					obj.addCart();
				break;
				case 'gotoCart':
				    window.location.href = '//wqs.jd.com/my/cart/jdshopcart.shtml';
				break;
				case 'shopLinks':case 'quick_shoplink':case 'shopLogoInfo':case 'shopBaseInfo':case 'gotoShop':
					if(obj.shopUrl) window.location.href = obj.shopUrl;
				break;
				case 'storeChoose': case 'storeChooseIndx': case 'storeChooseIcon':  //选择门店
					try{JD.report.rd({sku_id:obj.skuId, vender_id:obj.venderId||'', ptag:'7001.1.55'});}catch(e){};
					obj.storeChoose();				
				break;
				case 'storeInfo': case 'storeName': case 'storeAttr': case 'storePhone'://进入地图
					//obj.locShopInfo['shopCoords'] && loc.map(obj.locShopInfo['shopCoords']['latitude']+','+obj.locShopInfo['shopCoords']['longitude'],obj.locShopInfo['shopName'],obj.locShopInfo['shopAttr']);
				break;
				case 'addrArea': case 'addrName': case 'postNotice1':  case 'postNotice2': 
					obj.chooseAddress();
				break;
				case 'postIcon':
					obj.createPopup({flag:1});
				break;
				case 'ysTip':
					obj.createPopup({flag:2});
				break;
				case 'addrBack' :
					address.prev();
				break;
				case 'serviveArea':  case 'postNotice3':
					showServiceIco();
				break;
				case 'shopIM':
					if($(em).hasClass('on')){ 
						location.href = obj.shopImLink;
					}
					else{
						obj.showNotice('客服暂时不在线，请稍后联系');
					}
				break;
				case 'skuAttach': //合约机
					if(target.nodeName != 'SPAN') return;
					if($(target).hasClass('option_selected')){
						$(target).removeClass('option_selected');
						obj.skuAttachNo = -1;
						obj.cfee = null;
						return;
					}
					$('#skuAttach span').removeClass('option_selected');
					$(target).addClass('option_selected');
					obj.skuAttachNo = $(target).attr('no');

					obj.cfee = obj.comboSkuInfo[obj.skuAttachNo];
					if(!obj.cfee) return;

					if(obj.cfee.sku != obj.skuId){
						cookie.set('ftNo',obj.skuAttachNo*1+1,1);
						location.href = location.href.replace(obj.baseSkuId, obj.cfee.sku);
						return;
					}
					obj.cfee.ft == 12 ? obj.getComboSkuPrice(obj.cfee.sids) : obj.getSingleSkuPrice(obj.cfee.sku);
					if(obj.yushouStatus == 0 && obj.koStatus == 0) obj.setHeyueStat();  //正常的合约机
					if(obj.yushouStatus == 4 || obj.koStatus==2) obj.setHeyueStat();  //抢购中、秒杀中的    其他状态以抢购秒杀的为准
					obj.maxBuyNum = obj.cfee.ft == 100 ? 200 : 1;
					obj.skuId = obj.cfee.sku;
					if(obj.timmer) {clearInterval(obj.timmer); obj.timmer=null;}
					obj.setItemInfo({itemType:'heyue'});
				break;
				case 'skuAttach1': //合约机
					if(target.nodeName != 'SPAN') return;
					var $target = $(target);
					if($target.hasClass('option_selected')) return;//不可以不勾选
					$target.addClass('option_selected').siblings().removeClass('option_selected');
					obj.skuAttachNo = $target.attr('no');
					obj.cfee = obj.comboSkuInfo[obj.skuAttachNo];
					obj.setCfeeType();
					if(!obj.cfeeType) return;
					if(obj.cfeeType.sku != obj.skuId){
						cookie.set('ftNo',obj.skuAttachNo*1+1,1);
						location.href = location.href.replace(obj.baseSkuId, obj.cfeeType.sku);
						return;
					}
					if(obj.yushouStatus == 0 && obj.koStatus == 0) obj.setHeyueStatNew();  //正常的合约机
					if(obj.yushouStatus == 4 || obj.koStatus==2) obj.setHeyueStatNew();  //抢购中、秒杀中的    其他状态以抢购秒杀的为准
					if(obj.timmer) {clearInterval(obj.timmer); obj.timmer=null;}
					obj.setItemInfo({itemType:'heyue'});
				break;
				case 'skuAttach2':
					if(target.nodeName != 'SPAN') return;
					var $target = $(target);
					if($target.hasClass('option_selected')) return;
					$target.addClass('option_selected').siblings().removeClass('option_selected');
					obj.setCfeeType($target.attr('no')*1+1);
					if(obj.cfeeType && obj.cfeeType.sku&&obj.jdStatus){
						obj.jdSkuStatus = true;
						obj.changeSkuId = obj.cfeeType.sku;
						$('#statusNotice').hide();
						obj.setItemInfo({itemType:'heyue'});
					}else{
						obj.jdSkuStatus = false;
					}
				break;
				case 'sku1': case 'sku2': case 'sku3':
					if(target.nodeName != 'SPAN') return;
					var $target = $(target), cname = $target.text(), id=em.id, no=id.replace('sku','');
					if($target.hasClass('option_disabled')) { //disabled 的不让选  除一个列
						if(id == 'sku1' && $('#sku2 span').length){ //有多维sku  主sku灰色  也让可选
							$('#sku1 span').removeClass('option_selected');
							$target.removeClass('option_disabled').addClass('option_selected');
							obj.checkSkuList(no, cname);
							obj.jdSkuStatus = false;
						}
						return;
					}
					var isSkuA=id=='sku1', sid2=isSkuA?'sku2':'sku1';
					if($target.hasClass('option_selected')){
						$target.removeClass('option_selected');
						$('#'+sid2+' span').removeClass('option_disabled'); //去掉勾选时  去掉另外一条的disable
					}
					else{  //勾选时 选中当前  disable另外一半的 无组合sku
						$('#'+id+' span').removeClass('option_selected');
						$target.addClass('option_selected');
						obj.checkSkuList(no, cname);
					}

					var skuName = [$('#sku1 .option_selected').text(), $('#sku2 .option_selected').text(), $('#sku3 .option_selected').text()].filterEmp().join('~~');
					var sid = obj.skuPro.name[skuName];
					
					if(sid){
						obj.jdSkuStatus = true;
						obj.changeSkuId = sid;
						//obj.skuId = sid;
						if(obj.isYuShouNoWay){
							window.setTimeout(function(){
								location.href = location.href.replace(obj.baseSkuId, sid);
							}, 200);
						}else{
							obj.setItemInfo();
						}
					}
					else{
						obj.jdSkuStatus = false;
					}
				break;
				case 'evalTab':
					if(target.nodeName != 'SPAN') target = target.parentNode;
					if(target.nodeName != 'SPAN') return;
					obj.evalType = Math.min(parseInt($(target).attr('no')), 4);
					obj.evalPageCur=1;
					$('#evalTab span').removeClass('cur');
					target.className = 'cur';
					window.scroll(0,0);
					obj.loadEval();
					break;
				case 'headEval': case 'evalNo1': case 'evalNo3':
					document.getElementById('itemDetEnter').scrollIntoView(true);
				break;
				case 'promoteDiv': case 'promote': case 'promoteIcon':
					if($('#promoteIcon').hasClass('icon_point_up')){
						$('#promote').html(obj.iconHtml).removeClass('de_c_red').addClass('de_span').children().hide(); //隐藏掉乱七八糟的标签
						$('#promote .hl_red_bg').show();
						$('#promoteIcon').removeClass('icon_point_up').addClass('icon_point_drop');
						$('#promGroup').hide();
					}
					else{
						obj.setPromoteTitle();
					}
					
				break;
				case 'relatedEnter': case 'relatedNotice':
					location.hash = 'related';
				break;
				case 'ybArea':case 'ybArea1':case 'ybArea2':
					location.hash = 'yanbao';
				break;
				case 'summaryEnter':case 'summaryEnterIco':case 'evalRate':case 'evalRateP':case 'evalNo2':case 'summaryEnter2':
					location.hash = 'summary';
				break;
				case 'itemDetEnter':
					document.getElementById('detailTab').scrollIntoView(true);
				case 'sureYbServiceBtn':  //延保服务选择确认
					obj.setDelayTime();
					obj.setNewYanBao();
					location.hash='#main';
					break;
				case 'buyNum':
					if(!obj.isAndroid) setTimeout(function(){$('#btnTools').removeClass('fixed');},200); 
				break;
				default:
				break;
			}
		});
		
		$('#buyNum').on('input',function(){
			if(this.value) obj.setBuyNum(this.value);
		});
		$('#buyNum').on('focus',function(){
			$('#quckIcoArea').hide();
			$('#buyAreaBtm').hide();
		});
		$('#buyNum').on('blur',function(){
			$('#quckIcoArea').show();
			$('#buyAreaBtm').show();
			obj.setBuyNum(this.value);
			$('#btnTools').addClass('fixed');
		});
		
		var hashChange  = function(){
			var hash = window.location.hash;
			switch(hash){
				case '#detail':
					//obj.showPart('tab');
					//obj.showDetTab(obj.detIndex);
					break;
				break;
				case '#address':
					obj.chooseAddress();
					break;
				case '#related':
					obj.showPart('related');
					obj.setRelated();
					break;
				case '#summary':
					obj.showPart('summary');
					obj.evalPageCur=1;
					obj.evalType=3;
					//obj.getSkuSummary();
					obj.loadEval();
					obj.reloadEvalAppdl();  //重新生成app下载组件(评价页)
					break;
				break;
				case '#yanbao':
					obj.showPart('yanbao');
					break;
				case '#main':
					obj.showPart('main');
					obj.reloadEvalAppdl(true);  //恢复首页下载组件
					break;
				break;
				default:
					//obj.showPart('main');
				break;
			}
			if(hash != '#img'){
				if($('#loopImgDiv').hasClass('mod_slider_viewer')){
					hideBlackCover();
				}
			}
		};
		window.onhashchange = hashChange;
		if(!obj.isWX) {  //狗血手Q会重写这个事件
			setTimeout(function(){window.onhashchange = hashChange;}, 1000);
			setTimeout(function(){window.onhashchange = hashChange;}, 2000);
		}
		window.onresize = function(){
			if(obj.pageWidth == $(window).width()) return; //横向没有动就不resize了
			obj.pageWidth = $(window).width();
			obj.resizeProtal();
			obj.sliderDetail && obj.sliderDetail.resize(obj.pageWidth);
		};
		
	};
	//上报adkey
	ItemDet.prototype.reportAdkey = function(){
		var adkey = report.getADKEY();
		if(adkey){
			var img= new Image();
			img.src = '//wq.jd.com/webmonitor/collect/biz.json?contents=2|1|0|1|ok';
		}
	};
	//重新生成评价页app下载组件(back)
	ItemDet.prototype.reloadEvalAppdl = function(back){
		if(!window._jdApp || !this.isWX) return;
		if(back){  //恢复首页下载参数
			if(window._jdApp.oldInitHide) return;
			window._jdApp.androidindex = 8;
			window._jdApp.appdlCon = 'appdlCon';
			window._jdApp.reload && window._jdApp.reload();
		}else{  //评价
			window._jdApp.oldInitHide = window._jdApp.initHide;
			window._jdApp.androidindex = 9;
			window._jdApp.appdlCon = 'appdlCon2';
			window._jdApp.initHide = false;
			window._jdApp.reload && window._jdApp.reload();
		}
	};

	//拉取优惠券列表并展示
	ItemDet.prototype.getCouponList = function(){
		if (!this.venderId || !this.isLoadCoupon) return;
		var obj = this;
		function showCoupon(data){
			if (data.length) {
				var tmp = data.sort(function (a, b) {
					return b.discount - a.discount;
				});
				//tmp = tmp.concat(tmp);//测试多个优惠券用
				var couponHtml = [], tpl = $id('couponTpl').text;
				for (var i = 0; i < tmp.length; i++) {
					couponHtml.push($jsonToTpl(tmp[i], tpl));
				}
				$('#couponList').html(couponHtml.join(''));
				$('#couponListDiv').show();

				if (tmp.length <= 3) $('#couponRow').hide();
			} else {
				$('#couponListDiv').hide();
			}
		}
		window.getCouponListCB = function (json) {
			obj.delTimeout('itil11');
			try{
				obj.coupons = json.coupons || [];
				showCoupon(obj.coupons);
				JD.report.umpBiz({bizid:'25',operation:'11',result:'0',source:'0',message:'item CommCouponQuery api success'});
			}catch(e){
				console.log(e);
				JD.report.umpBiz({bizid:'25',operation:'11',result:'2',source:'0',message:'item CommCouponQuery api jserror '+e});
			}
		};
		obj.createTimeout('11','item CommCouponQuery api timeout');
		ls.loadScript(['//wq.jd.com/mshop/CommCouponQuery?callback=getCouponListCB',
						'cid='+obj.jdCategory[2],
						'sku='+obj.skuId,
						'popId='+(obj.isZiying?'':obj.venderId),
						'pin='+(cookie.get('jdpin')||''),
						'platform='+(obj.isWX?'5':'4'),
						't='+Math.random()].join('&'));
	};

	//领优惠券
	ItemDet.prototype.getCoupon = function (em) {
		var islogin = cookie.get('wq_uin') && cookie.get('wq_skey');
		if (!islogin) {
			this.login();
			return;
		}
		var obj = this, emobj = null;
		if (em.className == 'item') {
			emobj = $(em);
		}
		else if (em.parentNode.className == 'item') {
			emobj = $(em.parentNode);
		}
		if (!emobj) return;
		var key = emobj.attr('key'), roleid = emobj.attr('roleid');
		if (!key || !roleid) return;
		window.ObtainJdShopFreeCouponCallBack = function (json) {
			//未登录
			var drawTips = {
				999: '领取成功！<br/>优惠券将在1分钟内到账,<br/>请稍后前往个人中心查看~',
				14: '您已经领取过此优惠券',
				15: '您今天已经参加过此活动，请明天再试',
				16: '此券今日已经被领完，请明天再来~',
				17: '此券已经被领完了，下次记得早点来哟'
			};
			if (json.code == 1000) {
				obj.login();
			} else {
				obj.showNotice(drawTips[json.code] || '领取失败，请稍候再试', 3000);
				if (json.code == 999 || json.code == 14) {
					$(emobj).addClass('checked').find('.status').html("已领");
				}
			}
		};

		ls.loadScript('//wq.jd.com/activeapi/obtainjdshopfreecoupon?callback=ObtainJdShopFreeCouponCallBack&key=' + key + '&roleid=' + roleid + '&_t=' + Date.now());
	};

	ItemDet.prototype.delTimeout = function(key){
		if(this.timeout[key]){
			clearTimeout(this.timeout[key]); 
			this.timeout[key] = null;
		}
	};
	ItemDet.prototype.createTimeout = function(operationNo,msg){//普通的设置延时上报
		var itilStr = 'itil'+operationNo;
		this.delTimeout(itilStr);
		this.timeout[itilStr] = setTimeout(function(){
			JD.report.umpBiz({bizid:'25',operation:operationNo,result:'1',source:'0',message:msg});
		}, this.cgiTimeout);
	};
	ItemDet.prototype.ajaxSend = function(url,params){ //对于同域的请求，分析请求返回状态,url所有参数拼接好，要加上callback参数
		if(!url || url.indexOf('wq.jd.com')===-1) return;//json方式获取，无法跨域
		params = params || {};
		var obj = this, timeout = (params.timeout||obj.cgiTimeout),
			umpResultCode = (params.umpResultCode||{'404':'10','302':'11','timeout':'12','other':'13'}),
			resultCode = '0',msg= (params.msg||'item api '),
			operationNo = params.operationNo,
			//callback = params.callback,
			reqParam ={
				type:'GET',
				url:url,
				async:true,
				timeout:timeout,
				dataType:'json',//必须用json的方式，因为jsonp相当于加一个script标签,无法得到状态码
				complete:function(xhr,textStatus){//因为404都会302跳转到error页
					var status = xhr.status,repText = xhr.responseText;
					if(status==200 || status==304){//成功
						resultCode = '0';
						if(~repText.indexOf('<!DOCTYPE HTML>')){ //跳转到了error页面
							resultCode = umpResultCode['302'];
							msg += 'fail ';
						}else{
							msg += 'success ';
							window.eval && eval(repText);//请求加了callback参数，后台会返回一段代码
							//callback && callback(JSON.parse(repText));
						}
						
					}else{ //失败
						resultCode = ((status==404 || status==302) ? umpResultCode['302'] : (umpResultCode[textStatus]||umpResultCode.other));
						msg += 'fail '+status+textStatus;
					}
					JD.report.umpBiz({bizid:'25',operation:operationNo,result:resultCode,source:'0',message:msg});
				}
			},
			ajaxSend = $.ajax(reqParam);
	};
	ItemDet.prototype.createPopup = function(opt){  //1：邮费蒙层 2:预售规则 3:预售定金可抵
		var flag = opt.flag,stopMove = opt.stopMove,str = opt.str,
			coverDiv = document.createElement('div'),el = document.createElement('div'),container = document.body,
			stopMoveFun = function(e){e.preventDefault();},btnStr='',obj = this,
			btnEvent = function(ele,e){
				obj.setDelayTime();
	            container.removeChild(coverDiv);
	            el.style.display = 'none';
	            ele.onclick = null;
	            container.removeChild(el);
	            if(stopMove) document.removeEventListener("touchmove", stopMoveFun, false);
			};
    	coverDiv.className = "mod_alert_mask show fixed";
		switch(flag){
			case 2:
				el.className = "mod_alert mod_alert_info show fixed";
				el.innerHTML = '<span class="close"></span><h3 class="title">预售规则</h3><div class="inner"><dl><dd> 1、定金下单后，请在30分钟内付款，超时将自动关闭订单；</dd></dl><dl><dd>2、定金付款后，若非京东或商家责任（根据《售后政策》和客服判断为准），定金恕不退还；</dd></dl><dl><dd>3、预售结束时，由系统自动更新尾款价格，先下单后下单均能享受同样的价格。请至京东“我的订单”内付尾款；</dd></dl><dl><dd>4、尾款开始付款后，请在要求的时间（72小时）内支付尾款，若超时将自动关闭订单，且定金不予退还。请注意预售的结束时间，并及时支付尾款；</dd></dl><dl><dd>5、预售商品不支持7天无理由退换货；</dd></dl><dl><dd>6、发货时间请以预售商品详情页“发货时间”描述为准。</dd></dl></div>';
				btnStr = 'span.close';
			break;
			case 1:
				str = this.postTip;
			case 3:
				el.className = "mod_alert show fixed";
				el.innerHTML = str + '<p class="btns"><a href="javascript:void(0);" class="btn btn_1">知道了</a></p>';
				btnStr = 'p.btns';
			break;
		}
		setTimeout(function(){
			container.appendChild(el);
        	container.appendChild(coverDiv);
		},obj.isAndroid ? 100:400);  //防止点透
		el.querySelector(btnStr).onclick = function(e){
			btnEvent(this,e);
		};
        coverDiv.onclick = function(e) {
			btnEvent(this,e);
        };
        if(stopMove) document.addEventListener("touchmove", stopMoveFun, false);
	};
	/******************************
	 　功能实现区
	 *******************************/

function $jsonToTpl(json,tpl){
    return tpl.replace(/{#(\w+)#}/g,function(a,b){return json[b]===0?'0':(json[b]||"");});
}
function $itilReport(option){
    var opt = {
        bid : "1",  //业务id(后台分配)
        mid : "01",  //页面id(后台分配)
        res : [],  //页面监控业务的结果数组(
        onBeforeReport : null,  //上报前回调函数
        delay : 5000  //延迟上报时间(ms)
	};
    for(var k in option){
        opt[k] = option[k];
	}
    if(opt.res.length>0){
        //设置itil上报空回调，减少badjs
        window.reportWebInfo = function(json){};
        //页面加载5s后上报
        window.setTimeout(function(){
            opt.onBeforeReport && opt.onBeforeReport(opt);
            //var pstr = opt.bid + opt.mid + "-" + opt.res.join("|");
		}, opt.delay);
	}
}

//window.ECC_cloud_report_pv为true  说明底部已经加载ok
function $countRd(rd){
	try{
		report.trace({ptag:rd});
	}catch(e){}
}

exports.init = function() {
	Array.prototype.filterEmp = function(){var a=[];$(this).each(function(i,s){s!==''&&a.push(s);}); return a;};
	var item = new ItemDet();
	item.init();
	window._itemDetail = item;  //这个变量要保留  外部有用到
};

});
