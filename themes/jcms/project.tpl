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


<section class="fixed clearfix">
  <div class="container">
    <div class="row">
      <list catid="27" item="val" pagesize="18" fields="type">
      <div class="col-md-4 col-sm-offset-0 col-sm-6 col-xs-offset-1 col-xs-10">
        <a href="{:U('/content/'.$val['id'])}" title="{$val['title']}" class="project">
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

    <nav>
      <ul class="pager">
        {$page}
      </ul>
    </nav>

  </div>
</section>


<section class="gradient" style="padding-bottom:60px;padding-top:30px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10">
        <div class="heading-text">
          <h1>帮助别人，战胜自己</h1>
          <div>我们拥有激情，总是在寻找新的挑战。联系我们！</div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-center">
        <a class="btn btn-primary" href="<category id='32' name='url' />">联系我们</a>
      </div>
    </div>
  </div>
</section>


<template file="footer.tpl" />