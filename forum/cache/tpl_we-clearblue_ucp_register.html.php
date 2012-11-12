<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<script type="text/javascript">
// <![CDATA[
	/**
	* Change language
	*/
	function change_language(lang_iso)
	{
		document.forms['register'].change_lang.value = lang_iso;
		document.forms['register'].submit.click();
	}

	<?php if ($this->_rootref['CAPTCHA_TEMPLATE'] && $this->_rootref['S_CONFIRM_REFRESH']) {  ?>

	onload_functions.push('apply_onkeypress_event()');
	<?php } ?>


// ]]>
</script>



<?php if (( $this->_rootref['S_AL_WL_ENABLED'] || $this->_rootref['S_AL_FB_ENABLED'] || $this->_rootref['S_AL_TW_ENABLED'] || $this->_rootref['S_AL_OI_ENABLED'] ) && ! $this->_rootref['S_ADMIN_AUTH']) {  ?>

 <div class="panel bg3">
   <div class="inner"><span class="corners-top"><span></span></span>
      
 <h3><?php echo ((isset($this->_rootref['L_SOCIAL_LOGIN_OPTIONS'])) ? $this->_rootref['L_SOCIAL_LOGIN_OPTIONS'] : ((isset($user->lang['SOCIAL_LOGIN_OPTIONS'])) ? $user->lang['SOCIAL_LOGIN_OPTIONS'] : '{ SOCIAL_LOGIN_OPTIONS }')); ?></h3> 
                <br /> 
            <?php if ($this->_rootref['S_AL_WL_ENABLED']) {  ?> 
            <a href="<?php echo (isset($this->_rootref['U_AL_WL_AUTHORIZE'])) ? $this->_rootref['U_AL_WL_AUTHORIZE'] : ''; ?>"><img src="alternatelogin/images/windows_live_connect.png" alt="Windows Live" /></a> 
        <?php } if ($this->_rootref['S_AL_FB_ENABLED']) {  ?> 
            <a onclick="window.location='alternatelogin/al_fb_connect.php';" href="#"> 
                    <img src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Login with your Facebook account!" /> 
            </a> 
        <?php } if ($this->_rootref['S_AL_TW_ENABLED']) {  ?> 
        <a href="<?php echo (isset($this->_rootref['U_AL_TW_REQUEST'])) ? $this->_rootref['U_AL_TW_REQUEST'] : ''; ?>"><img src="alternatelogin/images/sign-in-with-twitter-l.png" alt="Twitter" /></a> 
        <?php } if ($this->_rootref['S_AL_OI_ENABLED']) {  ?> 
        <link type="text/css" rel="stylesheet" href="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/css/openid.css" />
	<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/js/openid-jquery.js"></script>
	<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/js/openid-en.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			openid.init('openid_identifier');
			
		});
	</script>
        <form action="<?php echo (isset($this->_rootref['U_AL_OI_LOGIN'])) ? $this->_rootref['U_AL_OI_LOGIN'] : ''; ?>" method="get" id="openid_form">
			<input type="hidden" name="action" value="verify" />
			<fieldset>
			
				<div id="openid_choice">
				
				<div id="openid_btns"></div>
				</div>
				<div id="openid_input_area">
					<input id="openid_identifier" name="openid_identifier" type="text" value="http://" />
					<input id="openid_submit" type="submit" value="Sign-In"/>
				</div>
			
			</fieldset>
		</form>
        <?php } ?> 
      

   <span class="corners-bottom"><span></span></span></div>
</div>
 <?php } ?>





<form method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>" id="register">

<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<h2><?php echo ((isset($this->_rootref['L_REGISTRATION'])) ? $this->_rootref['L_REGISTRATION'] : ((isset($user->lang['REGISTRATION'])) ? $user->lang['REGISTRATION'] : '{ REGISTRATION }')); ?></h2>
	
	
    <?php if ($this->_rootref['S_AL_LOGIN_ENABLED'] && ! $this->_rootref['S_AL_LOGIN']) {  ?> 
		<div><?php echo ((isset($this->_rootref['L_AL_REGISTRATION'])) ? $this->_rootref['L_AL_REGISTRATION'] : ((isset($user->lang['AL_REGISTRATION'])) ? $user->lang['AL_REGISTRATION'] : '{ AL_REGISTRATION }')); ?></div> 
		<div> 
			<?php if ($this->_rootref['S_AL_WL_ENABLED']) {  ?> 
			<wl:app channel-url="<?php echo (isset($this->_rootref['S_AL_WL_WRAP_CHANNEL'])) ? $this->_rootref['S_AL_WL_WRAP_CHANNEL'] : ''; ?>"
                            callback-url="<?php echo (isset($this->_rootref['S_AL_WL_WRAP_CALLBACK'])) ? $this->_rootref['S_AL_WL_WRAP_CALLBACK'] : ''; ?>"
                            client-id="<?php echo (isset($this->_rootref['S_AL_WL_CLIENT_ID'])) ? $this->_rootref['S_AL_WL_CLIENT_ID'] : ''; ?>"
                            scope="WL_Contacts.View, WL_Profiles.View,Messenger.SignIn"
                            onload="appLoaded"> 
                        </wl:app> 
                        <wl:signin signed-in-text="Sign Out" signed-out-text="Sign In" on-signin="{{signInCompleted}}" /> 
                        <wl:userinfo cid="$user"></wl:userinfo> 
			<?php } if ($this->_rootref['S_AL_FB_ENABLED']) {  ?> 
				<a onclick="window.location='alternatelogin/al_fb_connect.php';" href="#"> 
					<img src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Login with your Facebook account!" /> 
				</a> 
 
 
			<?php } if ($this->_rootref['S_AL_TW_ENABLED']) {  ?> 
				<a onclick="window.location='alternatelogin/al_tw_connect.php';" href="#"> 
					<img src="alternatelogin/images/sign-in-with-twitter-l.png" alt="Login with your Twitter account!" align="middle" /> 
				</a> 
			<?php } ?> 
		</div> 
	<?php } if ($this->_rootref['ERROR']) {  ?><p class="error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></p><?php } ?>


	<fieldset class="fields2 lalala">
	<?php if ($this->_rootref['L_REG_COND']) {  ?>

		<dl><dd><strong><?php echo ((isset($this->_rootref['L_REG_COND'])) ? $this->_rootref['L_REG_COND'] : ((isset($user->lang['REG_COND'])) ? $user->lang['REG_COND'] : '{ REG_COND }')); ?></strong></dd></dl>
	<?php } ?>

	<dl>
		<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label><br /><span><?php echo ((isset($this->_rootref['L_USERNAME_EXPLAIN'])) ? $this->_rootref['L_USERNAME_EXPLAIN'] : ((isset($user->lang['USERNAME_EXPLAIN'])) ? $user->lang['USERNAME_EXPLAIN'] : '{ USERNAME_EXPLAIN }')); ?></span></dt>
		<dd><input type="text" tabindex="1" name="username" id="username" size="25" value="<?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>" class="inputbox autowidth" title="<?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>" /></dd>
	</dl>
	<dl>
		<dt><label for="email"><?php echo ((isset($this->_rootref['L_EMAIL_ADDRESS'])) ? $this->_rootref['L_EMAIL_ADDRESS'] : ((isset($user->lang['EMAIL_ADDRESS'])) ? $user->lang['EMAIL_ADDRESS'] : '{ EMAIL_ADDRESS }')); ?>:</label></dt>
		<dd><input type="text" tabindex="2" name="email" id="email" size="25" maxlength="100" value="<?php echo (isset($this->_rootref['EMAIL'])) ? $this->_rootref['EMAIL'] : ''; ?>" class="inputbox autowidth" title="<?php echo ((isset($this->_rootref['L_EMAIL_ADDRESS'])) ? $this->_rootref['L_EMAIL_ADDRESS'] : ((isset($user->lang['EMAIL_ADDRESS'])) ? $user->lang['EMAIL_ADDRESS'] : '{ EMAIL_ADDRESS }')); ?>" /></dd>
	</dl>
	
	
	
	
	<?php if (! $this->_rootref['S_AL_LOGIN']) {  ?> 
	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_EMAIL'])) ? $this->_rootref['L_CONFIRM_EMAIL'] : ((isset($user->lang['CONFIRM_EMAIL'])) ? $user->lang['CONFIRM_EMAIL'] : '{ CONFIRM_EMAIL }')); ?>: </b></dt> 
		<dd><input type="text" tabindex="3" name="email_confirm" size="25" maxlength="100" value="<?php echo (isset($this->_rootref['EMAIL_CONFIRM'])) ? $this->_rootref['EMAIL_CONFIRM'] : ''; ?>" class="inputbox autowidth" /></dd> 		
	</dl> 


	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_PASSWORD_EXPLAIN'] : ((isset($user->lang['PASSWORD_EXPLAIN'])) ? $user->lang['PASSWORD_EXPLAIN'] : '{ PASSWORD_EXPLAIN }')); ?></span></dt> 
		<dd><input type="password" tabindex="4" name="new_password" size="25" value="<?php echo (isset($this->_rootref['PASSWORD'])) ? $this->_rootref['PASSWORD'] : ''; ?>" class="inputbox autowidth" /></dd> 
	</dl> 
	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD'])) ? $this->_rootref['L_CONFIRM_PASSWORD'] : ((isset($user->lang['CONFIRM_PASSWORD'])) ? $user->lang['CONFIRM_PASSWORD'] : '{ CONFIRM_PASSWORD }')); ?>: </b></dt> 
		<dd><input type="password" tabindex="5" name="password_confirm" size="25" value="<?php echo (isset($this->_rootref['PASSWORD_CONFIRM'])) ? $this->_rootref['PASSWORD_CONFIRM'] : ''; ?>" class="inputbox autowidth" /></dd> 
	</dl> 
	<?php } if ($this->_rootref['S_AL_TWITTER'] || $this->_rootref['S_AL_OPENID']) {  ?> 
	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_EMAIL'])) ? $this->_rootref['L_CONFIRM_EMAIL'] : ((isset($user->lang['CONFIRM_EMAIL'])) ? $user->lang['CONFIRM_EMAIL'] : '{ CONFIRM_EMAIL }')); ?>: </b></dt> 
		<dd><input type="text" tabindex="3" name="email_confirm" size="25" maxlength="100" value="<?php echo (isset($this->_rootref['EMAIL_CONFIRM'])) ? $this->_rootref['EMAIL_CONFIRM'] : ''; ?>" class="inputbox autowidth" /></dd> 
	</dl> 
	
	
	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_PASSWORD_EXPLAIN'] : ((isset($user->lang['PASSWORD_EXPLAIN'])) ? $user->lang['PASSWORD_EXPLAIN'] : '{ PASSWORD_EXPLAIN }')); ?></span></dt> 
		<dd><input type="password" tabindex="4" name="new_password" size="25" value="<?php echo (isset($this->_rootref['PASSWORD'])) ? $this->_rootref['PASSWORD'] : ''; ?>" class="inputbox autowidth" /></dd> 
	</dl> 
	<dl> 
		<dt><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD'])) ? $this->_rootref['L_CONFIRM_PASSWORD'] : ((isset($user->lang['CONFIRM_PASSWORD'])) ? $user->lang['CONFIRM_PASSWORD'] : '{ CONFIRM_PASSWORD }')); ?>: </b></dt> 
		<dd><input type="password" tabindex="5" name="password_confirm" size="25" value="<?php echo (isset($this->_rootref['PASSWORD_CONFIRM'])) ? $this->_rootref['PASSWORD_CONFIRM'] : ''; ?>" class="inputbox autowidth" /></dd> 
	</dl>
	<?php } ?>

	
	
	
	

	<hr />

	<dl>
		<dt><label for="lang"><?php echo ((isset($this->_rootref['L_LANGUAGE'])) ? $this->_rootref['L_LANGUAGE'] : ((isset($user->lang['LANGUAGE'])) ? $user->lang['LANGUAGE'] : '{ LANGUAGE }')); ?>:</label></dt>
		<dd><select name="lang" id="lang" onchange="change_language(this.value); return false;" tabindex="6" title="<?php echo ((isset($this->_rootref['L_LANGUAGE'])) ? $this->_rootref['L_LANGUAGE'] : ((isset($user->lang['LANGUAGE'])) ? $user->lang['LANGUAGE'] : '{ LANGUAGE }')); ?>"><?php echo (isset($this->_rootref['S_LANG_OPTIONS'])) ? $this->_rootref['S_LANG_OPTIONS'] : ''; ?></select></dd>
	</dl>
	<dl>
		<dt><label for="tz"><?php echo ((isset($this->_rootref['L_TIMEZONE'])) ? $this->_rootref['L_TIMEZONE'] : ((isset($user->lang['TIMEZONE'])) ? $user->lang['TIMEZONE'] : '{ TIMEZONE }')); ?>:</label></dt>
		<dd><select name="tz" id="tz" tabindex="7" class="autowidth"><?php echo (isset($this->_rootref['S_TZ_OPTIONS'])) ? $this->_rootref['S_TZ_OPTIONS'] : ''; ?></select></dd>
	</dl>

	<?php if (sizeof($this->_tpldata['profile_fields'])) {  ?>

		<dl><dd><strong><?php echo ((isset($this->_rootref['L_ITEMS_REQUIRED'])) ? $this->_rootref['L_ITEMS_REQUIRED'] : ((isset($user->lang['ITEMS_REQUIRED'])) ? $user->lang['ITEMS_REQUIRED'] : '{ ITEMS_REQUIRED }')); ?></strong></dd></dl>

	<?php $_profile_fields_count = (isset($this->_tpldata['profile_fields'])) ? sizeof($this->_tpldata['profile_fields']) : 0;if ($_profile_fields_count) {for ($_profile_fields_i = 0; $_profile_fields_i < $_profile_fields_count; ++$_profile_fields_i){$_profile_fields_val = &$this->_tpldata['profile_fields'][$_profile_fields_i]; ?>

		<dl>
			<dt><label<?php if ($_profile_fields_val['FIELD_ID']) {  ?> for="<?php echo $_profile_fields_val['FIELD_ID']; ?>"<?php } ?>><?php echo $_profile_fields_val['LANG_NAME']; ?>:<?php if ($_profile_fields_val['S_REQUIRED']) {  ?> *<?php } ?></label>
			<?php if ($_profile_fields_val['LANG_EXPLAIN']) {  ?><br /><span><?php echo $_profile_fields_val['LANG_EXPLAIN']; ?></span><?php } if ($_profile_fields_val['ERROR']) {  ?><br /><span class="error"><?php echo $_profile_fields_val['ERROR']; ?></span><?php } ?></dt>
			<dd><?php echo $_profile_fields_val['FIELD']; ?></dd>
		</dl>
	<?php }} } ?>


	</fieldset>
	<span class="corners-bottom"><span></span></span></div>
</div>
<?php if ($this->_rootref['CAPTCHA_TEMPLATE']) {  $this->_tpldata['DEFINE']['.']['CAPTCHA_TAB_INDEX'] = 8; if (isset($this->_rootref['CAPTCHA_TEMPLATE'])) { $this->_tpl_include($this->_rootref['CAPTCHA_TEMPLATE']); } } if ($this->_rootref['S_COPPA']) {  ?>



<div class="panel">
	<div class="inner"><span class="corners-top"><span></span></span>

	<h4><?php echo ((isset($this->_rootref['L_COPPA_COMPLIANCE'])) ? $this->_rootref['L_COPPA_COMPLIANCE'] : ((isset($user->lang['COPPA_COMPLIANCE'])) ? $user->lang['COPPA_COMPLIANCE'] : '{ COPPA_COMPLIANCE }')); ?></h4>

	<p><?php echo ((isset($this->_rootref['L_COPPA_EXPLAIN'])) ? $this->_rootref['L_COPPA_EXPLAIN'] : ((isset($user->lang['COPPA_EXPLAIN'])) ? $user->lang['COPPA_EXPLAIN'] : '{ COPPA_EXPLAIN }')); ?></p>
	<span class="corners-bottom"><span></span></span></div>
</div>
<?php } ?>


<div class="panel bg2">
	<div class="inner"><span class="corners-top"><span></span></span>

	<fieldset class="submit-buttons">
		<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

		<input type="submit" tabindex="9" name="submit" id="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1 default-submit-action" />&nbsp;
		<input type="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" name="reset" class="button2" />
		<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</fieldset>

	<span class="corners-bottom"><span></span></span></div>
</div>
</form>

<?php $this->_tpl_include('overall_footer.html'); ?>