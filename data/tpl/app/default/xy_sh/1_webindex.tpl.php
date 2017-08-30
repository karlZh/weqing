<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="mui-input-row">
    <label>选择地区</label>
    <?php  echo tpl_app_form_field_district('address', array('province' => $address['province'],'city' => $address['city'],'district' => $address['district']));?>
</div>
<div class="mui-input-row">
    <label>出生日期</label>
    <?php  echo tpl_app_fans_form('birth', array('year' => $profile['birthyear'], 'month' => $profile['birthmonth'], 'day' => $profile['birthday']), $mcFields['birthyear']['title']);?>
</div>
<div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label">性别</label>
    <div class="col-sm-9 col-xs-12">
        <?php  echo tpl_fans_form('gender', $profile['gender']);?>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>