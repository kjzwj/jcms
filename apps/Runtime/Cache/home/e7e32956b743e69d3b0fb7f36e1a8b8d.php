<?php if (!defined('THINK_PATH')) exit(); if(!$this->view) $this->view = Think::instance('View');$this->view->display('./themes/jcms/header.tpl',$this->tVar); ?>

<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h1 class="title"><?php echo ($info['title']); ?></h1>
        </div>
        <div class="col-xs-12 col-sm-offset-1 col-sm-10"><?php echo ($info['body']); ?></div>
      </div>
    </div>
  </div>
</section>

<?php if(!$this->view) $this->view = Think::instance('View');$this->view->display('./themes/jcms/footer.tpl',$this->tVar); ?>