<?php
/**
 * 寻易生活模块处理程序
 *
 * @author karlZh
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Xy_shModuleProcessor extends WeModuleProcessor {
	public function respond() {
		$content = $this->message['content'];
		//这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
        return $this->respText('你触发了寻易生活模块');
	}
}