<template file="header.tpl" />


<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h1 class="title">{$category['name']}</h1>
        </div>
        <if condition="$category['body']">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10">{$category['body']}</div>
        </if>
      </div>
    </div>
    <div class="row contact_ico">
        <div class="col-xs-12 col-sm-3 tline">
          <a href="tel:15218938652">
          <i class="ico ion-iphone size-96"></i>
          <p>给我们来电<br />15218938652</p>
          </a>
        </div>
        <div class="col-xs-12 col-sm-3 tline">
          <a href="mailto:710915644@qq.com">
          <i class="ico ion-ios-email-outline size-96"></i>
          <p>发电子邮件<br />710915644@qq.com</p>
          </a>
        </div>
        <div class="col-xs-12 col-sm-3 tline">
          <a href="tencent://message/?uin=710915644&amp;Site=iszwj.com&amp;Menu=yes">
          <i class="ico ion-chatbubble-working size-96"></i>
          <p>QQ/微信<br />710915644</p>
          </a>
        </div>
        <div class="col-xs-12 col-sm-3 tline">
          <a href="#maps">
          <i class="ico ion-ios-location-outline size-96"></i>
          <p>广东省<br />佛山市/南海区</p>
          </a>
        </div>
    </div>
  </div>
</section>


<section class="gradient" style="padding-bottom:60px;padding-top:30px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10">
        <div class="heading-text">
          <h1>联系表单</h1>
          <p>如果您心里有一个想法，在这里跟我们说说。我们想跟你谈谈你的项目。</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-lg-offset-2 col-lg-8">
        <div class="contact-form">
        <form action="{:U('diyform/add')}" method="post" id="J_checkingForm">
            <input type="text" name="addfields[28]" id="name" placeholder="您的名称" required="required" value="">
            <input type="text" name="addfields[29]" id="contact" placeholder="联系方式，可填：电话/QQ/Email" required="required" value="">
            <input type="text" name="addfields[30]" placeholder="您希望项目什么时候上线？（可选）" value="">
            <input type="text" name="addfields[31]" placeholder="您的预算？（可选）" value="">
            <textarea name="addfields[32]" placeholder="向我们解释下您的项目，我们很乐意帮助 ;)"></textarea>
            <button type="submit" class="btn btn-lg btn-primary">提交您的信息</button>
            <input type="hidden" name="diyid" value="5">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<div id="maps" style="width:100%;height:500px;"></div>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&amp;ak=QP8PQbX6I9GFHHqcHMabMGdG"></script>
<script type="text/javascript">
  var map = new BMap.Map("maps");
  var point = new BMap.Point(113.161555,23.076736);
  map.centerAndZoom(point, 16);
  var navigationControl = new BMap.NavigationControl({
    // 靠左上角位置
    anchor: BMAP_ANCHOR_TOP_LEFT,
    // LARGE类型
    type: BMAP_NAVIGATION_CONTROL_LARGE,
    // 启用显示定位
    enableGeolocation: true
  });
  map.addControl(navigationControl);

  //设置marker
  var vectorMarker = new BMap.Marker(new BMap.Point(point.lng,point.lat), {
    // 指定Marker的icon属性为Symbol
    icon: new BMap.Symbol(BMap_Symbol_SHAPE_POINT, {
      scale: 1.5,//图标缩放大小
      fillColor: "orange",//填充颜色
      fillOpacity: 0.8//填充透明度
    })
  });
  map.addOverlay(vectorMarker);

  //设置信息窗口
  var marker = new BMap.Marker(point);  // 创建标注
  map.addOverlay(marker);              // 将标注添加到地图中
  var opts = {
    width : 200,     // 信息窗口宽度
    height: 130,     // 信息窗口高度
    title : "<p>Jcms</p>" , // 信息窗口标题
    enableMessage:true,//设置允许信息窗发送短息
    message:"Jcms公司地址~"
  }
  var infoWindow = new BMap.InfoWindow("<p>电话：15218938652</p><p>QQ/微信：710915644</p><p>地址：广东省佛山市南海区</p>", opts);  // 创建信息窗口对象 
  map.openInfoWindow(infoWindow,point); //开启信息窗口

  
</script>
<template file="footer.tpl" />