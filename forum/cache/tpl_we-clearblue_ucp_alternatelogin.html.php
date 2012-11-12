<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); if ($this->_rootref['S_MODE_WINDOWSLIVE']) {  if ($this->_rootref['S_AL_WL_USER']) {  ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_DISABLE_WINDOWSLIVE_TEXT'])) ? $this->_rootref['L_UCP_AL_DISABLE_WINDOWSLIVE_TEXT'] : ((isset($user->lang['UCP_AL_DISABLE_WINDOWSLIVE_TEXT'])) ? $user->lang['UCP_AL_DISABLE_WINDOWSLIVE_TEXT'] : '{ UCP_AL_DISABLE_WINDOWSLIVE_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_WINDOWSLIVE_DESCRIPTION'])) ? $this->_rootref['S_UCP_WINDOWSLIVE_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
						
					<input id="submit" name="submit" type="submit" value="<?php echo ((isset($this->_rootref['L_DISABLE_WINDOWSLIVE'])) ? $this->_rootref['L_DISABLE_WINDOWSLIVE'] : ((isset($user->lang['DISABLE_WINDOWSLIVE'])) ? $user->lang['DISABLE_WINDOWSLIVE'] : '{ DISABLE_WINDOWSLIVE }')); ?>" />
					<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

                                        <input name="mode" id="mode" type="hidden" value="windowslive" />
					</form>
				</td>
			</tr>
		</table>	
	<?php } else { ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_ENABLE_WINDOWSLIVE_TEXT'])) ? $this->_rootref['L_UCP_AL_ENABLE_WINDOWSLIVE_TEXT'] : ((isset($user->lang['UCP_AL_ENABLE_WINDOWSLIVE_TEXT'])) ? $user->lang['UCP_AL_ENABLE_WINDOWSLIVE_TEXT'] : '{ UCP_AL_ENABLE_WINDOWSLIVE_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_WINDOWSLIVE_DESCRIPTION'])) ? $this->_rootref['S_UCP_WINDOWSLIVE_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<a href="<?php echo (isset($this->_rootref['U_AL_WL_AUTHORIZE'])) ? $this->_rootref['U_AL_WL_AUTHORIZE'] : ''; ?>&mode=link"><img src="alternatelogin/images/windows_live_connect.png" alt="Windows Live Connect" /></a> 
				</td> 
			</tr>
		</table>
		
	<?php } } else if ($this->_rootref['S_MODE_FACEBOOK']) {  if ($this->_rootref['S_AL_FB_USER']) {  ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_DISABLE_FACEBOOK_TEXT'])) ? $this->_rootref['L_UCP_AL_DISABLE_FACEBOOK_TEXT'] : ((isset($user->lang['UCP_AL_DISABLE_FACEBOOK_TEXT'])) ? $user->lang['UCP_AL_DISABLE_FACEBOOK_TEXT'] : '{ UCP_AL_DISABLE_FACEBOOK_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_FACEBOOK_DESCRIPTION'])) ? $this->_rootref['S_UCP_FACEBOOK_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
						<input name="mode" id="mode" type="hidden" value="facebook" />
						<input id="submit" name="submit" type="submit" value="<?php echo ((isset($this->_rootref['L_DISABLE_FACEBOOK'])) ? $this->_rootref['L_DISABLE_FACEBOOK'] : ((isset($user->lang['DISABLE_FACEBOOK'])) ? $user->lang['DISABLE_FACEBOOK'] : '{ DISABLE_FACEBOOK }')); ?>" />
						<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

						<input name="mode" id="mode" type="hidden" value="facebook" />
					</form>
				</td>
			</tr>
		</table>	
	<?php } else { ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_ENABLE_FACEBOOK_TEXT'])) ? $this->_rootref['L_UCP_AL_ENABLE_FACEBOOK_TEXT'] : ((isset($user->lang['UCP_AL_ENABLE_FACEBOOK_TEXT'])) ? $user->lang['UCP_AL_ENABLE_FACEBOOK_TEXT'] : '{ UCP_AL_ENABLE_FACEBOOK_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_FACEBOOK_DESCRIPTION'])) ? $this->_rootref['S_UCP_FACEBOOK_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
						<a onclick="window.location='alternatelogin/al_fb_connect.php';" href="#">
							<img src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Login with your Facebook account!" />
						</a>						
						<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

						
					</form>

				</td>
			</tr>
		</table>
		
	<?php } } else if ($this->_rootref['S_MODE_TWITTER']) {  if ($this->_rootref['S_AL_TW_USER']) {  ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_DISABLE_TWITTER_TEXT'])) ? $this->_rootref['L_UCP_AL_DISABLE_TWITTER_TEXT'] : ((isset($user->lang['UCP_AL_DISABLE_TWITTER_TEXT'])) ? $user->lang['UCP_AL_DISABLE_TWITTER_TEXT'] : '{ UCP_AL_DISABLE_TWITTER_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_TWITTER_DESCRIPTION'])) ? $this->_rootref['S_UCP_TWITTER_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<form method="post" action="<?php echo (isset($this->_rootref['U_ACTION'])) ? $this->_rootref['U_ACTION'] : ''; ?>">
						<input name="mode" id="mode" type="hidden" value="twitter" />
						<input id="submit" name="submit" type="submit" value="<?php echo ((isset($this->_rootref['L_DISABLE_TWITTER'])) ? $this->_rootref['L_DISABLE_TWITTER'] : ((isset($user->lang['DISABLE_TWITTER'])) ? $user->lang['DISABLE_TWITTER'] : '{ DISABLE_TWITTER }')); ?>" />
						<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

						<input name="mode" id="mode" type="hidden" value="twitter" />
					</form>
				</td>
			</tr>
		</table>	
	<?php } else { ?>

		<table>
			<tr>
				<th colspan="2"><?php echo ((isset($this->_rootref['L_UCP_AL_ENABLE_TWITTER_TEXT'])) ? $this->_rootref['L_UCP_AL_ENABLE_TWITTER_TEXT'] : ((isset($user->lang['UCP_AL_ENABLE_TWITTER_TEXT'])) ? $user->lang['UCP_AL_ENABLE_TWITTER_TEXT'] : '{ UCP_AL_ENABLE_TWITTER_TEXT }')); ?></th>
			</tr>
			<tr>
				<td>
					<?php echo (isset($this->_rootref['S_UCP_TWITTER_DESCRIPTION'])) ? $this->_rootref['S_UCP_TWITTER_DESCRIPTION'] : ''; ?>

				</td>
				<td>
					<a href="<?php echo (isset($this->_rootref['U_AL_TW_REQUEST'])) ? $this->_rootref['U_AL_TW_REQUEST'] : ''; ?>"><img src="alternatelogin/images/sign-in-with-twitter-l.png" alt="Windows Live Connect" /></a> 

				</td>
			</tr>
		</table>
		
	<?php } } $this->_tpl_include('ucp_footer.html'); ?>