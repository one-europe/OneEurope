<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<fb:like href="http://facebook.com/OneEurope" show_faces="false" width="450" font="arial"></fb:like>

<?php if ($this->_rootref['S_DISPLAY_SEARCH'] || ( $this->_rootref['S_USER_LOGGED_IN'] && ! $this->_rootref['S_IS_BOT'] )) {  ?>

<ul class="linklist">
	<?php if ($this->_rootref['S_DISPLAY_SEARCH']) {  ?>

		<li><a href="<?php echo (isset($this->_rootref['U_SEARCH_UNANSWERED'])) ? $this->_rootref['U_SEARCH_UNANSWERED'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_UNANSWERED'])) ? $this->_rootref['L_SEARCH_UNANSWERED'] : ((isset($user->lang['SEARCH_UNANSWERED'])) ? $user->lang['SEARCH_UNANSWERED'] : '{ SEARCH_UNANSWERED }')); ?></a><?php if ($this->_rootref['S_LOAD_UNREADS']) {  ?> &bull; <a href="<?php echo (isset($this->_rootref['U_SEARCH_UNREAD'])) ? $this->_rootref['U_SEARCH_UNREAD'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_UNREAD'])) ? $this->_rootref['L_SEARCH_UNREAD'] : ((isset($user->lang['SEARCH_UNREAD'])) ? $user->lang['SEARCH_UNREAD'] : '{ SEARCH_UNREAD }')); ?></a><?php } if ($this->_rootref['S_USER_LOGGED_IN']) {  ?> &bull; <a href="<?php echo (isset($this->_rootref['U_SEARCH_NEW'])) ? $this->_rootref['U_SEARCH_NEW'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_NEW'])) ? $this->_rootref['L_SEARCH_NEW'] : ((isset($user->lang['SEARCH_NEW'])) ? $user->lang['SEARCH_NEW'] : '{ SEARCH_NEW }')); ?></a><?php } ?> &bull; <a href="<?php echo (isset($this->_rootref['U_SEARCH_ACTIVE_TOPICS'])) ? $this->_rootref['U_SEARCH_ACTIVE_TOPICS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SEARCH_ACTIVE_TOPICS'])) ? $this->_rootref['L_SEARCH_ACTIVE_TOPICS'] : ((isset($user->lang['SEARCH_ACTIVE_TOPICS'])) ? $user->lang['SEARCH_ACTIVE_TOPICS'] : '{ SEARCH_ACTIVE_TOPICS }')); ?></a></li>
	<?php } if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['U_MARK_FORUMS']) {  ?><li class="rightside"><a href="<?php echo (isset($this->_rootref['U_MARK_FORUMS'])) ? $this->_rootref['U_MARK_FORUMS'] : ''; ?>" accesskey="m"><?php echo ((isset($this->_rootref['L_MARK_FORUMS_READ'])) ? $this->_rootref['L_MARK_FORUMS_READ'] : ((isset($user->lang['MARK_FORUMS_READ'])) ? $user->lang['MARK_FORUMS_READ'] : '{ MARK_FORUMS_READ }')); ?></a></li><?php } ?>

</ul>
<?php } if ($this->_rootref['AL_FB_FACEPILE'] | $this->_rootref['AL_FB_ACTIVITY'] | $this->_rootref['AL_FB_STREAM']) {  ?> 
<table width="100%"> 
    <tr> 
        <td valign="top"> 
<?php } $this->_tpl_include('forumlist_body.html'); if ($this->_rootref['AL_FB_FACEPILE'] | $this->_rootref['AL_FB_ACTIVITY'] | $this->_rootref['AL_FB_STREAM']) {  ?> 
        </td> 
        
        <?php if (( $this->_rootref['AL_FB_ACTIVITY'] && ! $this->_rootref['AL_FB_USER_HIDE_ACTIVITY'] ) || ( $this->_rootref['AL_FB_STREAM'] && ! $this->_rootref['AL_FB_USER_HIDE_STREAM'] )) {  ?> 
        <td width="185" valign="top"> 
        <?php } if ($this->_rootref['AL_FB_ACTIVITY'] && ! $this->_rootref['AL_FB_USER_HIDE_ACTIVITY']) {  ?> 
			<div class="element">
				<fb:activity site="<?php echo (isset($this->_rootref['AL_FB_SITE_DOMAIN'])) ? $this->_rootref['AL_FB_SITE_DOMAIN'] : ''; ?>" width="180" height="500" header="true" font="arial" border_color="" recommendations="true"></fb:activity> 
        	</div>
		<?php } ?> 
		</td>
		<td width="265" valign="top">
        <?php if ($this->_rootref['AL_FB_STREAM'] && ! $this->_rootref['AL_FB_USER_HIDE_STREAM']) {  ?> 
			<div class="element">
				<fb:live-stream event_app_id="<?php echo (isset($this->_rootref['AL_FB_APPID'])) ? $this->_rootref['AL_FB_APPID'] : ''; ?>" width="260" height="500" xid="" always_post_to_friends="false"></fb:live-stream> 
     		</div>
   		<?php } if (( $this->_rootref['AL_FB_ACTIVITY'] && ! $this->_rootref['AL_FB_USER_HIDE_ACTIVITY'] ) || ( $this->_rootref['AL_FB_STREAM'] && ! $this->_rootref['AL_FB_USER_HIDE_STREAM'] )) {  ?> 
        </td> 
        <?php } ?> 
    </tr> 
    <?php if ($this->_rootref['AL_FB_FACEPILE'] && ! $this->_rootref['AL_FB_USER_HIDE_FACEPILE']) {  ?> 
    <tr> 
        <td<?php if ($this->_rootref['AL_FB_ACTIVITY']) {  ?> colspan="2"<?php } ?>>
                <div class="forabg"> 
		<div class="inner"><span class="corners-top"><span></span></span> 
 
                    <div class="panel"> 
                        
                        <fb:facepile href="<?php echo (isset($this->_rootref['AL_FB_SITE_DOMAIN'])) ? $this->_rootref['AL_FB_SITE_DOMAIN'] : ''; ?>" width="200" max_rows="1"></fb:facepile> 
                    </div> 
                        <span class="corners-bottom"><span></span></span></div> 
	</div> 
 
 
        </td> 
    </tr> 
    <?php } ?> 
</table> 
<?php } if (! $this->_rootref['S_USER_LOGGED_IN'] && ! $this->_rootref['S_IS_BOT']) {  ?>

	<form method="post" action="<?php echo (isset($this->_rootref['S_LOGIN_ACTION'])) ? $this->_rootref['S_LOGIN_ACTION'] : ''; ?>" class="headerspace">
	<h3><a href="<?php echo (isset($this->_rootref['U_LOGIN_LOGOUT'])) ? $this->_rootref['U_LOGIN_LOGOUT'] : ''; ?>"><?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a><?php if ($this->_rootref['S_REGISTER_ENABLED']) {  ?>&nbsp; &bull; &nbsp;<a href="<?php echo (isset($this->_rootref['U_REGISTER'])) ? $this->_rootref['U_REGISTER'] : ''; ?>"><?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a><?php } ?></h3>
		<fieldset class="quick-login">
			<label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label>&nbsp;<input type="text" name="username" id="username" size="10" class="inputbox" title="<?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>" />
			<label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>:</label>&nbsp;<input type="password" name="password" id="password" size="10" class="inputbox" title="<?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>" />
			<?php if ($this->_rootref['S_AUTOLOGIN_ENABLED']) {  ?>

				| <label for="autologin"><?php echo ((isset($this->_rootref['L_LOG_ME_IN'])) ? $this->_rootref['L_LOG_ME_IN'] : ((isset($user->lang['LOG_ME_IN'])) ? $user->lang['LOG_ME_IN'] : '{ LOG_ME_IN }')); ?> <input type="checkbox" name="autologin" id="autologin" /></label>
			<?php } ?>

			<input type="submit" name="login" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" class="button2" />
			
			<?php if (( $this->_rootref['S_AL_WL_ENABLED'] || $this->_rootref['S_AL_FB_ENABLED'] || $this->_rootref['S_AL_TW_ENABLED'] ) && ! $this->_rootref['S_AL_LOGIN']) {  ?> 	
			<div class="alternate_login">
			
				<?php if ($this->_rootref['S_AL_FB_ENABLED']) {  ?> 
					<a onclick="window.location='alternatelogin/al_fb_connect.php';" href="#" class="fb"> 
						<img src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Login with your Facebook account!" style="margin-bottom: -9px;" /> 
					</a> 
				<?php } if ($this->_rootref['S_AL_TW_ENABLED']) {  ?> 
					<a href="<?php echo (isset($this->_rootref['U_AL_TW_REQUEST'])) ? $this->_rootref['U_AL_TW_REQUEST'] : ''; ?>" class="tw"><img src="alternatelogin/images/sign-in-with-twitter-l.png" alt="Sign in with your Twitter account!" style="margin-bottom: -9px" /></a> 
				<?php } if ($this->_rootref['S_AL_WL_ENABLED']) {  ?> 
		        	<a href="<?php echo (isset($this->_rootref['U_AL_WL_AUTHORIZE'])) ? $this->_rootref['U_AL_WL_AUTHORIZE'] : ''; ?>" class="wl"><img src="alternatelogin/images/windows_live_connect.png" alt="Windows Live Connect" style="margin-bottom: -9px" /></a> 
				<?php } ?> 
				
			</div>
			<?php } ?>

			<?php echo (isset($this->_rootref['S_LOGIN_REDIRECT'])) ? $this->_rootref['S_LOGIN_REDIRECT'] : ''; ?>

		</fieldset>
	</form>
<?php } if ($this->_rootref['S_DISPLAY_ONLINE_LIST']) {  if ($this->_rootref['U_VIEWONLINE']) {  ?><h3><a href="<?php echo (isset($this->_rootref['U_VIEWONLINE'])) ? $this->_rootref['U_VIEWONLINE'] : ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a></h3><?php } else { ?><h3><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></h3><?php } ?>

	<p><?php echo (isset($this->_rootref['TOTAL_USERS_ONLINE'])) ? $this->_rootref['TOTAL_USERS_ONLINE'] : ''; ?> (<?php echo ((isset($this->_rootref['L_ONLINE_EXPLAIN'])) ? $this->_rootref['L_ONLINE_EXPLAIN'] : ((isset($user->lang['ONLINE_EXPLAIN'])) ? $user->lang['ONLINE_EXPLAIN'] : '{ ONLINE_EXPLAIN }')); ?>)<br /><?php echo (isset($this->_rootref['RECORD_USERS'])) ? $this->_rootref['RECORD_USERS'] : ''; ?><br /> <br /><?php echo (isset($this->_rootref['LOGGED_IN_USER_LIST'])) ? $this->_rootref['LOGGED_IN_USER_LIST'] : ''; ?>

	<?php if ($this->_rootref['LEGEND']) {  ?><br /><em><?php echo ((isset($this->_rootref['L_LEGEND'])) ? $this->_rootref['L_LEGEND'] : ((isset($user->lang['LEGEND'])) ? $user->lang['LEGEND'] : '{ LEGEND }')); ?>: <?php echo (isset($this->_rootref['LEGEND'])) ? $this->_rootref['LEGEND'] : ''; ?></em><?php } ?></p>
<?php } if ($this->_rootref['S_DISPLAY_BIRTHDAY_LIST'] && $this->_rootref['BIRTHDAY_LIST']) {  ?>

	<h3><?php echo ((isset($this->_rootref['L_BIRTHDAYS'])) ? $this->_rootref['L_BIRTHDAYS'] : ((isset($user->lang['BIRTHDAYS'])) ? $user->lang['BIRTHDAYS'] : '{ BIRTHDAYS }')); ?></h3>
	<p><?php if ($this->_rootref['BIRTHDAY_LIST']) {  echo ((isset($this->_rootref['L_CONGRATULATIONS'])) ? $this->_rootref['L_CONGRATULATIONS'] : ((isset($user->lang['CONGRATULATIONS'])) ? $user->lang['CONGRATULATIONS'] : '{ CONGRATULATIONS }')); ?>: <strong><?php echo (isset($this->_rootref['BIRTHDAY_LIST'])) ? $this->_rootref['BIRTHDAY_LIST'] : ''; ?></strong><?php } else { echo ((isset($this->_rootref['L_NO_BIRTHDAYS'])) ? $this->_rootref['L_NO_BIRTHDAYS'] : ((isset($user->lang['NO_BIRTHDAYS'])) ? $user->lang['NO_BIRTHDAYS'] : '{ NO_BIRTHDAYS }')); } ?></p>
<?php } if ($this->_rootref['NEWEST_USER']) {  ?>

	<h3><?php echo ((isset($this->_rootref['L_STATISTICS'])) ? $this->_rootref['L_STATISTICS'] : ((isset($user->lang['STATISTICS'])) ? $user->lang['STATISTICS'] : '{ STATISTICS }')); ?></h3>
	<p><?php echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; ?> &bull; <?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; ?> &bull; <?php echo (isset($this->_rootref['TOTAL_USERS'])) ? $this->_rootref['TOTAL_USERS'] : ''; ?> &bull; <?php echo (isset($this->_rootref['NEWEST_USER'])) ? $this->_rootref['NEWEST_USER'] : ''; ?></p>
<?php } $this->_tpl_include('overall_footer.html'); ?>