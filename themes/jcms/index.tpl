<template file="header.tpl" />

<!-- banner -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="http://htmlcoder.me/sites/all/themes/idea/images/parallax-bg.jpg" alt="">
    </div>
    <div class="item">
      <img src="http://htmlcoder.me/sites/all/themes/idea/images/parallax-bg.jpg" alt="">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!--Service-->
<section class="our_service fixed clearfix">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h1 class="title">我们的服务</h1>
          <p>Our pursuit of perfection<br />我们有强制性，看到不好的东西总会不刻意的弄好</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="items">
        <div class="col-md-3 col-sm-6 item">
          <h3>meet us</h3>
          <div class="ico"><img src="__PUBLIC__/img/ico_service01.png" alt="meet us" /></div>
          <h4>您的项目</h4>
          <p>我们需要了解清楚您预期效果，所以我们能够创造一个贴合您需求的片子。</p>
        </div>

        <div class="col-md-3 col-sm-6 item">
          <h3>reflexion</h3>
          <div class="ico"><img src="__PUBLIC__/img/ico_service02.png" alt="reflexion" /></div>
          <h4>头脑风暴</h4>
          <p>我们会分享我们的想法和执行方案。并交换彼此的想法和概念择优选择。</p>
        </div>

        <div class="col-md-3 col-sm-6 item">
          <h3>shoot &amp; edit</h3>
          <div class="ico"><img src="__PUBLIC__/img/ico_service03.png" alt="shoot &amp; edit" /></div>
          <h4>开始执行</h4>
          <p>制定或选择镜头运动方式，编辑的节奏，一切都对该项目有意义的事情。</p>
        </div>

        <div class="col-md-3 col-sm-6 item">
          <h3>delivery</h3>
          <div class="ico"><img src="__PUBLIC__/img/ico_service04.png" alt="delivery" /></div>
          <h4>反复检查</h4>
          <p>我们很多时间去讨论看上去不和谐的地方，并以最完美的效果呈现给您</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="btn-action"><a href="/service/" class="btn btn-success">了解更多</a></div>
    </div>

  </div>
</section>

<!-- About -->
<section class="about_us fixed clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h2 class="title">关于我们</h2>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="desc">
          <p>佛山云顶科技有限公司，建立于2010年，是一家富有活力的年轻创作型网络科技公司， 满足客户所需，高效的创意执行，丰富经验的制作团队，庞大的制作资源，是我们的优势。正因为如此使我们在短短几年一跃成为佛山知名的网络科技公司。</p>
          <p>我们凭借创意和高效的执行力，通过多年的经验，对客户所需作出准确的判断，将平凡的东西变得与众不同。 我们优异的成绩，吸引着众多优秀的合作伙伴和客户，其中不乏本地和港澳甚至国外客户的信赖。</p>
          <p>我们的服务： PHP项目开发 / 网站建设 / 网页UI设计 / APPS应用 / 企业网络生态链一站式营销服务</p>
          <p>Foshan Yundes Ltd., established in 2010, is a dynamic young technology companies create networks, meet customer requirements and efficient implementation of creative and experienced production team, a huge production resources is our advantage. That is why in a few years so that we became well-known network technology companies in Foshan.</p>
          <p>With our creative and efficient execution, through years of experience, the customer is required to make accurate judgments, the ordinary things become different. Our excellent results, attracting many outstanding partners and customers, many of whom trust the local and foreign clients and even Hong Kong and Macao.</p>
          <p>Our services: PHP project development / construction site / Web UI design / Phone application / enterprise network ecosystem-stop marketing services</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="ico"><img src="__PUBLIC__/img/ico_about.png" alt="关于 J-cms"></div>
      </div>
    </div>
</section>


<!-- Project -->
<section class="projects fixed clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h2 class="title">客户案例</h2>
          <p>Customer case study<br />我们真心对待每一个客户，您的项目也将有机会显示在这里</p>
        </div>
      </div>
    </div>

    <div class="row">

      <list catid="27" item="val" limit="15" fields="type">
      <div class="col-md-4 col-sm-offset-0 col-sm-6 col-xs-offset-1 col-xs-10">
        <a href="{$val['url']}" title="{$val['title']}" class="project">
          <div class="thumbnail animated">
            <img src="{$val['image']}" alt="{$val['title']}" />
          </div>
          <div class="overlay">
            <div class="meta animated">
              <div class="type">{$val['type']}</div>
              <div class="client">{$val['title']}</div>
            </div>
          </div>
        </a>
      </div>
      </list>

    </div>
  </div>
</section>


<!-- Contact -->
<section class="contact_us fixed clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h2 class="title">联系我们</h2>
          <p>Let’s get stared</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
        <div class="col-sm-4">
          <i class="ico ion-iphone size-96"></i>
          <p>给我们来电<br />15218938652</p>
        </div>
        <div class="col-sm-4">
          <i class="ico ion-ios-email-outline size-96"></i>
          <p>发电子邮件<br />710915644@qq.com</p>
        </div>
        <div class="col-sm-4">
          <i class="ico ion-ios-location-outline size-96"></i>
          <p>广东省<br />佛山市/南海区</p>
        </div>
      </div>
    </div>
  </div>
</section>


<template file="footer.tpl" />