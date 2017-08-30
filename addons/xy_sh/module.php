<?php
/**
 * 寻易生活模块定义
 *
 * @author karlZh
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Xy_shModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
        global $_W,$_GPC;
        if (!empty($rid)) {
            $item = pdo_fetch("SELECT * FROM ".tablename('basic_reply')." WHERE rid = :rid",array(':rid' => $rid));
        }
        include $this->template('rule');
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
        global $_GPC;
        if (empty($_GPC['content'])) {
            return '请填写回复内容';
        }
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
        global $_W, $_GPC;
        $data = array(
            'rid' => $rid,
            'content' => $_GPC['content'],
        );
        $id = pdo_fechcolumn("SELECT id FROM ".tablename('basic_reply')." WHERE rid = :rid",array(':rid' => $rid));
        if (empty($rid)) {
            pdo_insert('basic_reply', $data);
        } else {
            pdo_update('basic_reply', $data, array('id' => $id));
        }
	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
        pdo_delete('basic_reply', array('rid' => $rid));
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;

		load()->classs('cloudapi');
		$api = new CloudApi(true);
		$iframe = $api->url('debug', 'settingsDisplay', array(
			'referer' => urlencode($_W['siteurl']),
			'version' => $this->module['version'],
			'v' => random(3),
		), 'html');
		if (is_error($iframe)) {
			message($iframe['message'], '', 'error');
		}

		if($_W['ispost']) {
			$setting = $_GPC['setting'];
			$setting = $api->post('debug', 'saveSettings', array('setting' => $setting, 'version' => $this->module['version'], 'v' => random(3),), 'json');
			if (is_error($setting)) {
				die("<script>alert('{$setting['message']}');location.href = '{$iframe}';</script>");
			}
			$this->saveSettings($setting);
			die("<script>location.href = '{$iframe}';</script>");
		}

		include $this->template('setting');
	}


}