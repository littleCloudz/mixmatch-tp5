<?php
use think\Env;
return [
	'app_status' => Env::get('status', 'prod'),
	'app_emial'  => 'zxy_7107@qq.com',
	'app_author' => 'littlecloudz',
	'auto_bind_module'  => true,
	'url_route_on'      => true,
	'url_route_must'    => false
];