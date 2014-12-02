<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>
<div class="container">

<div class="row">
  <div class="col-md-5">           

     <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password')); ?></div>
            </div>     

            <div style="padding-top:30px" class="panel-body" >
               	<?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="form-horizontal"'); ?>
				<?php echo form_fieldset(); ?>  
				
				<?php if (isset($sign_in_error)) : ?>                	                    
                    <div class="alert alert-danger" role="alert">
              		<a class="close" data-dismiss="alert" href="#">x</a><?php echo $sign_in_error; ?>
            		</div>
				<?php endif; ?>
                
                <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
                         <p class="text-danger">
                         <?php echo form_error('sign_in_username_email'); ?>
                         <?php if (isset($sign_in_username_email_error)) : ?>
                             <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
                         <?php endif; ?>
                         </p>
				<?php endif; ?> 
                 
				<div style="margin-bottom: 25px" class="input-group" <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'has-error' : ''; ?>>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="sign_in_username_email" type="text" class="form-control" name="sign_in_username_email" value="" placeholder="<?php echo lang('sign_in_username_email'); ?>">
                              
                </div>
                                    
                <?php 	if (form_error('sign_in_password')) : ?>
						<p class="text-danger"><?php echo form_error('sign_in_password'); ?></p>
				<?php 	endif; ?>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="sign_in_password" type="password" class="form-control" name="sign_in_password" placeholder="password" value="<?=set_value('sign_in_password')?>">
                    
                 	
                    <?php if (isset($recaptcha)) : ?>
							<?php echo $recaptcha; ?>
							<?php if (isset($sign_in_recaptcha_error)) : ?>
								<span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
							<?php endif; ?>
					<?php endif; ?>
                    
                       
                </div>

                
                <div class="input-group">
                    <div class="checkbox">
                      <label>
                        <?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'checked', 'checked' => $this->input->post('sign_in_remember'),)); ?>
							<?php echo lang('sign_in_remember_me'); ?>
                      </label>
                    </div>
                </div>


				<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-sm pull-right', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>

            </div><!-- panel-body -->
            
			<div class="panel-footer">
            	<?php echo sprintf(lang('sign_in_dont_have_account'), anchor('account/sign_up', lang('sign_in_sign_up_now'))); ?>
            	
            </div>
            
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
   </div>
  </div> <!-- col-md-7 -->
  
  <div class="col-md-7">
  <?php if ($this->config->item('third_party_auth_providers')) : ?>
            <h3><?php echo sprintf(lang('sign_in_third_party_heading')); ?></h3>
            <ul>
				<?php foreach ($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, ' ', array('title' => sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?></li>
				<?php endforeach; ?>
            </ul>
			<?php endif; ?>
  </div>
</div> <!-- row -->



      
</div> <!-- /container -->

<?php echo $this->load->view('footer'); ?>