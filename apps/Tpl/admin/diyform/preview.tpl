<layout name="layout" />

<wj:load type="js" href="__DATA__ueditor/editor_config.js,__DATA__ueditor/editor_all_min.js" />
<load type='css' href="__DATA__css/diyform.css,__DATA__ueditor/themes/default/css/ueditor.css" />

<div class="row-fluid">
<form class="form-horizontal" action="{:U('home/diyform/add')}" method="post" id="J_checkingForm">
 
  <!--基本选项-->
  <present name="has_fields">
  <div class="form-items">
  <h4>{$diyinfo.title}</h4>
  <!--附加字段-->
  <ul id="diyform-{$diyinfo.id}">
    <volist name="add_fields" id="vo">
      <li class="{$vo.formtype}">
        <?php if($vo['formtype'] == 'images'){ ?>
          {$vo.input}
        <?php }else{ ?>
          <span class="label">{$vo.name}</span>
          <span class="form-item">{$vo.input}</span>
          <span class="tips" id="{$vo.field}Tip">{$vo.tips}</span>
        <?php } ?>
      </li>
    </volist>
  </ul>
  </div>
  </present>
  

  <div class="form-actions">
    <input type="hidden" name="diyid" value="{$id}">
    <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
    <button class="btn" type="reset">{:L('lable_cancel')}</button>
  </div>            

  </form>
</div>  


<script>
//验证表单字段
<present name="has_fields">
$(document).ready(function(){
$.formValidator.initConfig({formid:"J_checkingForm",autotip:true,onerror:function(msg){alert(msg)}});

<volist name="add_fields" id="vo">
<if condition="($vo.verification neq '') or ($vo.required eq 1)">
$("#<?php echo $vo['field'];?>").formValidator({<if condition="$vo.required neq 1">empty:true,</if>onshow:"<?php echo $vo['tips'];?>",onfocus:"<?php echo $vo['tips'];?>"})<if condition="$vo.verification neq ''">.regexValidator({regexp:"<?php echo $vo['verification'];?>",onerror:"<?php echo $vo['errortips'];?>"})</if>.inputValidator({<if condition="$vo.required eq 1">min:1,</if>onerror:"<?php echo $vo['errortips'];?>"});
</if>
</volist>
})
</present>
</script>


<wj:load type="js" href="__DATA__js/plugins/formvalidator.js,__DATA__js/admin.js" />

<present name="iframe_tools">
<load type='css' href="__DATA__css/artDialog.css" />
<wj:load type='js' href="__DATA__js/artDialog.js,__DATA__js/plugins/iframeTools.js" />
</present>

<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>