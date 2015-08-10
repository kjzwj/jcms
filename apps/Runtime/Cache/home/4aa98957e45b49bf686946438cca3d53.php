<?php if (!defined('THINK_PATH')) exit(); if(!$this->view) $this->view = Think::instance('View');$this->view->display('./themes/jcms/header.tpl',$this->tVar); ?>

<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-text">
          <h1 class="title"><?php echo ($category['name']); ?></h1>
        </div>
        <div class="col-xs-12 col-sm-offset-1 col-sm-10"><?php echo ($category['body']); ?></div>
      </div>
    </div>
  </div>
</section>

<section class="team gradient">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10">
        <div class="heading-text">
          <h1>专业团队</h1>
          <p>我们拥有一支对网络充满激情的小伙伴，每一位成员都技术不凡！</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10">
        <?php $i=1; ?>
        <?php $map['catid']=1;$map['limit']="";$map['order']="";$map['image']="";$map['flag']="";$map['fields']="title2";$map['pagesize']="";$_data = D('content')->get_list($map);$_list=$_data['list'];$_total=$_data['_total'];$_page=$_data['_page'];foreach ($_list as $peo):$peo['url']=U("content/view",array("id"=>$peo['id'])); if($i > 1): ?><div class="separator"></div><?php endif; ?>
        <div class="person">
          <div class="picture">
            <img src="<?php echo ($peo['image']); ?>" alt="<?php echo ($peo['title']); ?>">
          </div>
          <div class="description">
            <p><strong><?php echo ($peo['title']); ?> <?php echo ($peo['title2']); ?></strong></p>
            <p><?php echo ($peo['body']); ?></p>
            <p class="links"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#smsModal" data-whatever="@<?php echo ($peo['title']); ?>">给我留言</button></p>
          </div>
        </div>
        <?php $i++; endforeach; ?>
      </div>
    </div>
  </div>
</section>


<div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="smsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php echo U('diyform/add');?>" method="post" id="J_checkingForm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="smsModalLabel">New message</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="control-label">收信人:</label>
            <input type="text" class="form-control" id="recipient-name" name="addfields[36]" required="required">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">您想说的话:</label>
            <textarea class="form-control" id="message-text" rows="8" name="addfields[37]" required="required"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary" id="send-message">发送</button>
      </div>
      <input type="hidden" name="diyid" value="6">
    </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$('#smsModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('发送留言给' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>

<?php if(!$this->view) $this->view = Think::instance('View');$this->view->display('./themes/jcms/footer.tpl',$this->tVar); ?>