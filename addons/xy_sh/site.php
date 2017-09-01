<?php
/**
 * 寻易生活模块微站定义
 *
 * @author karlZh
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Xy_shModuleSite extends WeModuleSite {

	public function doMobileWebindex() {
	    load()->func('tpl');
	    //这个操作被定义用来呈现 功能封面
//        echo tpl_app_form_field_image('image','/data');
        include $this->template('webindex');
	}
	public function doWebReplay() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebShop() {
	    //这个操作被定义用来呈现 管理中心导航菜单
        include $this->template('shop');
    }
	public function doMobileNavigate() {
		//这个操作被定义用来呈现 微站首页导航图标
        load()->func('tpl');
        //分支测试
        include $this->template('webindex');
	}
	public function doMobileCenter() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doMobileMenus() {
		//这个操作被定义用来呈现 微站快捷功能导航
	}
	public function doWebSlone() {
		//这个操作被定义用来呈现 微站独立功能
	}

}