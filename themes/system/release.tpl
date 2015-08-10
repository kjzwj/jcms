<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$seo['title']}</title>
<meta name="keywords" content="{$seo['keywords']}">
<meta name="description" content="{$seo['description']}">
<link href="__PUBLIC__css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__css/main.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__css/ionicons.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__js/bootstrap.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script type="text/javascript" src="__PUBLIC__js/html5shiv.js"></script>
<![endif]-->
<style type="text/css">
ul.list>li{margin-bottom: 50px;}
</style>
</head>

<body>
<!--header-->
<template file="top.tpl" />

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					J-cms 历史版本 <small>Release下载页面</small>
				</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list">
				<volist name="list" id="vo">
				<li>
					<h3>{$vo.title}</h3>
					<p>{$vo.desc}</p>
					<a href="{$vo.url}" target="_blank" class="btn btn-info"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> 下载</a>
				</li>
				</volist>
			</ul>
		</div>
	</div>
</div>

</body>
</html>