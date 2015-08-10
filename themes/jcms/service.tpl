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
  </div>
</section>


<section class="services clearfix">
  <div class="container">
    <div class="row">

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-earth size-96"></i>
        <h2>网站建设</h2>
        <p>即使你对网站方面不了解<br/>我们为您解决互联网生态营销服务</p>
      </div>

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-social-html5-outline size-96"></i>
        <h2>响应式网页</h2>
        <p>我们使用最先进的HTML5+CSS3<br/>响应式技术创造美丽的网站。</p>
      </div>

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-chatbubble-working size-96"></i>
        <h2>微信营销</h2>
        <p>我们帮助您在微信上建立企业品牌<br/>为您吸纳更多有价值的客户</p>
      </div>

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-android-color-palette size-96"></i>
        <h2>UI 设计</h2>
        <p>我们为您的企业品牌设计<br/>完美的像素和友好的界面的网站。</p>
      </div>

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-android-apps size-96"></i>
        <h2>APPS应用</h2>
        <p>我们为您量身定制<br/>手机上(iOS和Android)工作的应该程序。</p>
      </div>

      <div class="col-xs-12 col-sm-4 item tline">
        <i class="ico ion-chatbubbles size-96"></i>
        <h2>咨询顾问</h2>
        <p>我们帮助您定义您的需求，<br/>并提供完善的售后服务。</p>
      </div>

    </div>
  </div>
</section>


<template file="footer.tpl" />