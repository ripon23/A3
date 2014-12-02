<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('users_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_roles')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang("roles_{$action}_page_name"); ?></h2>

      <div class="well">
        <?php echo lang("roles_{$action}_description"); ?>
      </div>
	
    
    
    	<div class="col-md-5">	
      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="form-group <?php echo (form_error('role_name') || isset($role_name_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="role_name"><?php echo lang('roles_name'); ?></label>

          <div class="controls">
            <?php if( $is_system ) : ?>
              <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

              <span class="input uneditable-input"><?php echo $role->name; ?></span><span class="help-block"><?php echo lang('roles_system_name'); ?></span>
            <?php else : ?>
              <?php echo form_input(array('name' => 'role_name', 'id' => 'role_name', 'class'=>'form-control', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

              <?php if (form_error('role_name') || isset($role_name_error)) : ?>
                <span class="help-inline">
                <?php
                  echo form_error('role_name');
                  echo isset($role_name_error) ? $role_name_error : '';
                ?>
                </span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
      </div>

      <div class="form-group <?php echo form_error('role_description') ? 'error' : ''; ?>">
          <label class="control-label" for="role_description"><?php echo lang('roles_description'); ?></label>

          <div class="controls">
            <?php echo form_textarea(array('name' => 'role_description', 'id' => 'role_description', 'class'=>'form-control', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

            <?php if (form_error('role_description') || isset($role_name_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('role_description');
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="form-group">
          <label class="control-label" for="settings_lastname"><?php echo lang('roles_permission'); ?></label>

          
            <?php foreach( $permissions as $perm ) : ?>
              <?php
                $check_it = FALSE;

                if( isset($role_permissions) )
                {
                  foreach( $role_permissions as $rperm )
                  {
                    if( $rperm->id == $perm->id )
                    {
                      $check_it = TRUE; break;
                    }
                  }
                }
              ?>
              <div class="checkbox">
              	<label>
                <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it); ?>
                <?php echo $perm->key; ?>
                </label>
            </div>
            <?php endforeach; ?>
          
      </div>

      <div class="form-group">
        <?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
        <?php echo anchor('account/manage_roles', lang('website_cancel'), 'class="btn btn-default"'); ?>
        <?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
          <span><?php echo lang('admin_or');?></span>
          <?php if( isset($role->suspendedon) ): ?>
            <?php echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger"'); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <?php echo form_close(); ?>
	
    </div>
    </div>
  </div>
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>