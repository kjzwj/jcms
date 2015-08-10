<?php
return array(

	// 伪静态设置
	'URL_MODEL'	=>	2,  // 如果你的环境不支持 请设置为 1
	'URL_ROUTER_ON'   => true, //如果你的环境不支持Rewrite 请设置为 false
	'URL_ROUTE_RULES' => array( //定义路由规则
		'content/:id'               => 'content/view',
		'/^category\/(\d+)-(\d+)$/'        => 'content/index?cid=:1&p=:2',
		'/^category\/(\d+)$/' 			=> 'content/index?cid=:1',
		
		// 'index' 			=> 'index.php',
		'/^([a-z]+)$/' 			=> 'content/index?name=:1',
		// '/^about$/'		=>	'content/index?name=about',
		// '/^case$/'		=>	'content/index?name=case',
		// '/^sevrice$/'		=>	'content/index?name=sevrice',
		// '/^contact$/'		=>	'content/index?name=contact',
	),

	'HTML_CACHE_ON'		=> true,    //生成HTML静态文件
	'HTML_CACHE_RULES'	=> array(
		'index:'=>array('index_{:action}','3600'),
		'content:'=>array('{$_SERVER.REQUEST_URI|md5}'),
		'category:' => array('{$_SERVER.REQUEST_URI|md5}'),
	)

);
