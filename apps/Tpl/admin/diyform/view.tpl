<layout name="layout" />

<h4>{$diyform_title} - {:L('info_manage')} 【<a href="{:U('diyform/info',array('id'=>$diyid))}">{:L('lable_back')}</a>】</h4>
<div class="blank20"></div>

<div class="row-fluid J_tablelist">
  <table class="table table-bordered table-hover">
    <tbody>
    	<volist name="info" id="val">
      <tr>
      	<th width="200">{$val.name}</th>
      	<td>{$val.info}</td>
      </tr>
      </volist>
    </tbody>
  </table>
</div>