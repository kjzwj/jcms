<layout name="layout" />
<h4>{:L('article_edit')} <small><a href="{:U('content/add',array('cat_id'=>$_REQUEST['cat_id']))}">【{:L('article_add')}】</a></small></h4>
<div class="blank20"></div>
<div class="row-fluid">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#base" data-toggle="tab">{:L('tabs_base')}</a></li>
    <li><a href="#advance" data-toggle="tab">{:L('tabs_advanced')}</a></li>
    <present name="add_fields">
    	<li><a href="#addfields" data-toggle="tab">{:L('add_fields')}</a></li>
    </present>    
  </ul>
  
  <form class="form-horizontal" action="{:U('edit')}" method="post" id="J_checkingForm">
    <fieldset>
       
      <div class="tab-content">
        <!--基本选项-->
        <div class="tab-pane active" id="base">
        
        	<div class="control-group">
            <label class="control-label" for="cat_id">{:L('cate_name')}</label>
            <div class="controls">
              <select class="J_cate_select" data-pid="0" data-uri="{:U('content/ajax_getchilds',array('modelid'=>$modelid))}" data-selected="{$spid}"></select>
              <input type="hidden" name="cat_id" id="J_cate_id" value="{$info.cat_id}" />
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="J_title">{:L('lable_title')}</label>
            <div class="controls">
                <input name="title" type="text" class="input-xxlarge" id="J_title" value="{$info.title}" style="color:{$info.color};">
                <input type="hidden" value="{$info.color}" name="color" id="J_color">
					        <a href="javascript:;" class="color_picker_btn"><img class="J_color_picker" data-it="J_title" data-ic="J_color" src="__DATA__img/color.png"></a>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="image">{:L('thumb')}</label>
            <div class="controls">
              <div class="input-append"><input class="input-xlarge" id="J_image" name="image" type="text" value="{$info.image}">
              <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'image'))}" data-name="J_image" data-width="800" data-title="{:L('selet_images')} (双击选择)" type="button">{:L('selet_images')}</button></div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="flag">{:L('flag')}</label>
            <div class="controls">
            	<foreach name="flag" item="vo">
              <label class="checkbox inline"><input type="checkbox" id="flag_{$key}" name="flag[{$key}]" value="{$key}" <if condition="preg_match('#'.$key.'#', $info['flag'])">checked="checked"</if> > {$vo}</label>
              </foreach>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="author">{:L('author')}</label>
            <div class="controls">
              <input type="text" class="input-large" name="author" id="author" value="{$info.author}" />
            </div>
          </div>
      
          <div class="control-group">
            <label class="control-label" for="ordid">{:L('lable_order')}</label>
            <div class="controls">
              <input type="text" class="input-small" name="ordid" id="ordid" value="{$info.ordid}" />
              <span class="help-inline">{:L('order_tip')}</span>
            </div>
          </div>  
          
          <div class="control-group">
            <div class="controls" style="margin-left:50px;">
              <editor type="ueditor" lang="cn" name="body" id="body" width="820" height="500" content="{$info.body}"></editor> 
            </div>
          </div> 
          
        </div>
       	<!--基本选项-->
        
        <!--高级选项-->
        <div class="tab-pane" id="advance">
        
        	<div class="control-group">
            <label class="control-label" for="flag">{:L('lable_access')}</label>
            <div class="controls">
              <select name="access" id="access">
              	<foreach name="access" item="vo">
                <option value="{$key}" <if condition="$info['access'] eq $key">selected="selected"</if>>{$vo}</option>
                </foreach>
              </select>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="author">{:L('add_time')}</label>
            <div class="controls">
              <input type="text" class="input-large Wdate" name="addtime" id="addtime" value="{$info.addtime|date='Y-m-d H:i:s',###}" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="click">{:L('lable_click')}</label>
            <div class="controls">
              <input type="text" class="input-small" name="click" id="click" value="{$info.click}" />
            </div>
          </div>       
          
          <div class="control-group">
            <label class="control-label" for="status">{:L('lable_show')}</label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" name="status" id="status1" value="1" <if condition="$info['status'] eq 1">checked="checked"</if>> {:L('lable_yes')}
              </label>
              <label class="radio inline">
                <input type="radio" name="status" id="status2" value="0" <if condition="$info['status'] eq 0">checked="checked"</if>> {:L('lable_no')}
              </label>
            </div>
          </div>
          
          
          <div class="control-group">
            <label class="control-label" for="seo_title">{:L('seo_title')}</label>
            <div class="controls">
                <input name="seo_title" type="text" class="input-xlarge" id="seo_title" value="{$info.seo_title}">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seo_key">{:L('seo_keys')}</label>
            <div class="controls">
                <input name="seo_key" type="text" class="input-xlarge" id="seo_key" value="{$info.seo_key}">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seo_desc">{:L('seo_desc')}</label>
            <div class="controls">
                <textarea name="seo_desc" id="seo_desc" class="input-xxlarge" rows="6">{$info.seo_desc}</textarea>
            </div>
          </div>

        </div>
        
        <present name="has_fields">
        <!--附加字段-->
        <div class="tab-pane" id="addfields">
        	<volist name="add_fields" id="vo">
            <div class="control-group">
              <?php if($vo['formtype'] == 'images'){ ?>
              	{$vo.input}
              <?php }else{ ?>
                <label class="control-label" for="{$vo.field}">{$vo.name}</label>
                <div class="controls">
                  {$vo.input}
                  <span class="help-inline">{$vo.tips}</span>
                </div>
              <?php } ?>
            </div>
        	</volist>
        </div>
        </present>        
        
      </div>

      <div class="form-actions">
      	<input type="hidden" name="id" value="{$info.id}">
        <input type="hidden" name="modelid" value="{$modelid}">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <button class="btn" type="reset" onclick="history.back()">{:L('lable_cancel')}</button>
      </div>            
     </fieldset>
  </form>

      <script>
        $(function () {
          $('.tabs a:last').tab('show')
        })
      </script>
</div>

<load type="js" href="__DATA__js/plugins/colorpicker.js,__DATA__js/main.js" />
<load href="__DATA__js/my97date/WdatePicker.js" />
<script>
$(function(){
	//分类联动
	$('.J_cate_select').cate_select();	
	
	//颜色选择器
	$('.J_color_picker').colorpicker();
	
	//加载图片集
	<foreach name="imglist" item="img" key="k">
		<volist id="img" name="img">
			add_images('{$k}','{$img.0}','{$img.1}',{$i});
		</volist>
	</foreach>
	
})

function load_file_list(id) {
	var url="{:U('category/get_model_files')}";
  $.getJSON(url+'&id='+id,
	function(data){
    $('#template_index').val(data['data']['template_index']);
		$('#template_list').val(data['data']['template_list']);
		$('#template_show').val(data['data']['template_show']);
  });
}

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