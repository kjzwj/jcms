<layout name="layout" />
<h4>{:L('cate_edit')}</h4>
<div class="blank20"></div>
<div class="row-fluid">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#base" data-toggle="tab">{:L('tabs_base')}</a></li>
    <li><a href="#advance" data-toggle="tab">{:L('tabs_advanced')}</a></li>
    <li><a href="#content" data-toggle="tab">{:L('cate')}{:L('tabs_content')}</a></li>
  </ul>
  
  <form class="form-horizontal" action="{:U('edit')}" method="post">
    <fieldset>
       
      <div class="tab-content">
        <!--基本选项-->
        <div class="tab-pane active" id="base">
        
        	<div class="control-group">
            <label class="control-label" for="pid">{:L('lable_parent')}{:L('cate_name')}</label>
            <div class="controls">
              <select class="J_cate_select" data-pid="0" data-uri="{:U('category/ajax_getchilds')}" data-selected="{$info.spid}"></select>
              <input type="hidden" name="pid" id="J_cate_id" />
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="name">{:L('cate')}{:L('lable_name')}</label>
            <div class="controls">
                <input name="name" type="text" class="input-xlarge" id="name" value="{$info.name}">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="alias">{:L('lable_alias')}</label>
            <div class="controls">
              <input type="text" class="input-large" name="alias" id="alias" value="{$info.alias}" placeholder="URL目录" />
            </div>
          </div>
      
          <div class="control-group">
            <label class="control-label" for="listorder">{:L('lable_order')}</label>
            <div class="controls">
              <input type="text" class="input-small" name="ordid" id="ordid" value="{$info.ordid}" />
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="modelid">{:L('lable_module')}</label>
            <div class="controls">
              <select id="modelid" name="modelid" onchange="load_file_list(this.value)">
                <option value="">{:L('lable_selectone')}</option>
                <volist name="model_list" id="model">
                <if condition="$model['status'] eq 1">
                	<option value="{$model.id}" <if condition="$info['modelid'] eq $model['id']">selected="selected"</if>>{$model.name}</option>
                </if>
                </volist>
              </select>
            </div>
          </div>            
          
        	<div class="control-group">
            <label class="control-label" for="isnav">{:L('lable_type')}</label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_0" value="0" <if condition="$info['type'] eq 0">checked="checked"</if>>{:L('type_0')}
              </label>
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_1" value="1" <if condition="$info['type'] eq 1">checked="checked"</if>>{:L('type_1')}
              </label>
              <label class="radio inline">
                <input type="radio" name="type" onchange="change_type(this.value)" id="type_2" value="2" <if condition="$info['type'] eq 2">checked="checked"</if>>{:L('type_2')}
              </label>
            </div>
          </div>           
          
          <div class="control-group">
            <label class="control-label" for="isnav">{:L('lable_showinnav')}</label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" name="isnav" id="isnav1" value="1" <if condition="$info['isnav'] eq 1">checked="checked"</if>> {:L('lable_yes')}
              </label>
              <label class="radio inline">
                <input type="radio" name="isnav" id="isnav2" value="0" <if condition="$info['isnav'] eq 0">checked="checked"</if>> {:L('lable_no')}
              </label>
            </div>
          </div>
        </div>
       	<!--基本选项-->
        <!--高级选项-->
        <div class="tab-pane" id="advance">
          <div class="control-group hide-url show-page">
            <label class="control-label" for="template_index">{:L('template_index')}</label>
            <div class="controls">
                <div class="input-append"><input name="template_index" type="text" class="input-large" id="J_template_index" placeholder="index_default" value="{$info.template_index}">
                <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_index" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>            
                </div>
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="template_list">{:L('template_list')}</label>
            <div class="controls">
                <div class="input-append"><input name="template_list" type="text" class="input-large" id="J_template_list" placeholder="list_default" value="{$info.template_list}">
                <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_list" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
                </div>
            </div>
          </div>
          
          <div class="control-group hide-page hide-url">
            <label class="control-label" for="template_show">{:L('template_show')}</label>
            <div class="controls">
                <div class="input-append"><input name="template_show" type="text" class="input-large" id="J_template_show" placeholder="show_default" value="{$info.template_show}">
                <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'tpl'))}" data-name="J_template_show" data-width="800" data-title="{:L('template_select')} (双击选择)" type="button">{:L('template_select')}</button>
                </div>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="J_image">{:L('cate_img')}</label>
            <div class="controls">
              <div class="input-append">
              <input type="text" name="image" id="J_image" class="input-xlarge" value="{$info.image}" />
              <button class="btn J_opendialog" data-uri="{:U('attachment/index',array('type'=>'image'))}" data-name="J_image" data-width="800" data-title="{:L('selet_images')} (双击选择)" type="button">{:L('selet_images')}</button>
              </div>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seotitle">{:L('seo_title')}</label>
            <div class="controls">
                <input name="seotitle" type="text" class="input-xxlarge" id="seotitle" value="{$info.seotitle}">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seokeywords">{:L('seo_keys')}</label>
            <div class="controls">
                <input name="seokeywords" type="text" class="input-xxlarge" id="seokeywords" value="{$info.seokeywords}">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="seodescription">{:L('seo_desc')}</label>
            <div class="controls">
                <textarea name="seodescription" id="seodescription" class="input-xxlarge" rows="6">{$info.seodescription}</textarea>
            </div>
          </div>

        </div>
        <!--高级选项-->
        
        <div class="tab-pane" id="content">
      		<editor type="ueditor" lang="cn" name="body" content="{$info.body}"></editor> 
        </div>
        
      </div>

      <div class="form-actions">
      	<input type="hidden" name="id" value="{$info.id}">
        <button type="submit" class="btn btn-primary">{:L('lable_submit')}</button>
        <a class="btn" type="reset" href="{:U('category/index')}">{:L('lable_back')}</a>
      </div>            
     </fieldset>
  </form>

      <script>
        $(function () {
          $('.tabs a:last').tab('show')
        })
      </script>
</div>

<script>
$(function(){
	//分类联动
	$('.J_cate_select').cate_select();
  //栏目类型
  change_type($('input:radio[name=type]:checked').val());
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

function change_type(type) {
  switch(type){
    case "1":
      $('.hide-page').hide(200);
      break;
    case "2":
      $('.hide-url').hide(200);
      break;
    default:
      $('.hide-url,.hide-page').show(200);
  }
}
</script>