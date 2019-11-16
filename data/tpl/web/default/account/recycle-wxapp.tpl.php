<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">小程序管理</div>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url ('account/manage', array('account_type' => '4'))?>">小程序列表</a></li>
	<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_OWNER || $_W['role'] == ACCOUNT_MANAGE_NAME_FOUNDER) { ?>
	<li class="active"><a href="<?php  echo url ('account/recycle', array('account_type' => '4'))?>">小程序回收站</a></li>
	<?php  } ?>
</ul>
<div class="clearfix we7-margin-bottom">
	<form action="" class="form-inline  pull-left" method="get">
		<input type="hidden" name="c" value="account">
		<input type="hidden" name="a" value="recycle">
		<input type="hidden" name="account_type" value="4">
		<div class="input-group form-group" style="width: 400px;">
			<input type="text" name="keyword" value="<?php  echo $_GPC['keyword'];?>" class="form-control" placeholder="搜索关键字"/>
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
</div>                                                                                              
<table class="table we7-table table-hover vertical-middle table-manage" id="js-system-account-recycle" ng-controller="SystemAccountRecycle" ng-cloak>
	<col width="85px" />
	<col />
	<col width="208px" />
	<col width="150px" />
	<tr>
		<th colspan="2" class="text-left">帐号</th>
		<th>有效期</th>
		<th class="text-right">操作</th>
	</tr>
	<tr class="color-gray" ng-repeat="list in del_accounts">
		<td class="text-left">
			<img ng-src="{{list.thumb}}" class="img-responsive">
		</td>
		<td class="text-left">
			<p class="color-dark" ng-bind="list.name"></p>
		</td>
		<td>
			<p ng-bind="list.setmeal.timelimit"></p>
		</td>
		<td class="vertical-middle">
			<div class="link-group">
				<a ng-href="{{links.postRecover}}&acid={{list.acid}}&uniacid={{list.uniacid}}">恢复</a>
				<a class="del" ng-href="{{links.postDel}}&acid={{list.acid}}&uniacid={{list.uniacid}}" onclick="if(!confirm('此为永久删除，删除后不可找回！确认吗？')) return false;">删除</a>
			</div>
		</td>
	</tr>
</table>
<div class="text-right">
	<?php  echo $pager;?>
</div>
<script>
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	angular.module('accountApp').value('config', {
		del_accounts: <?php echo !empty($del_accounts) ? json_encode($del_accounts) : 'null'?>,
		links: {
			postRecover: "<?php  echo url('account/recycle/recover', array('type' => ACCOUNT_TYPE_APP_NORMAL))?>",
			postDel: "<?php  echo url('account/recycle/delete', array('type' => ACCOUNT_TYPE_APP_NORMAL))?>",
		}
	});
	angular.bootstrap($('#js-system-account-recycle'), ['accountApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>