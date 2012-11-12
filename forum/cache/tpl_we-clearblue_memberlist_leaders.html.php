<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<h2><?php echo (isset($this->_rootref['PAGE_TITLE'])) ? $this->_rootref['PAGE_TITLE'] : ''; ?></h2>

<form method="post" action="<?php echo (isset($this->_rootref['S_MODE_ACTION'])) ? $this->_rootref['S_MODE_ACTION'] : ''; ?>">
	<div class="forums-wrapper">
		<table class="forums">
			<thead>
				<tr>
					<th><?php echo ((isset($this->_rootref['L_ADMINISTRATORS'])) ? $this->_rootref['L_ADMINISTRATORS'] : ((isset($user->lang['ADMINISTRATORS'])) ? $user->lang['ADMINISTRATORS'] : '{ ADMINISTRATORS }')); ?></th>
					<th class="group"><?php echo ((isset($this->_rootref['L_PRIMARY_GROUP'])) ? $this->_rootref['L_PRIMARY_GROUP'] : ((isset($user->lang['PRIMARY_GROUP'])) ? $user->lang['PRIMARY_GROUP'] : '{ PRIMARY_GROUP }')); ?></th>
					<th class="group"><?php echo ((isset($this->_rootref['L_FORUMS'])) ? $this->_rootref['L_FORUMS'] : ((isset($user->lang['FORUMS'])) ? $user->lang['FORUMS'] : '{ FORUMS }')); ?></th>
				</tr>
			</thead>
			<tbody>	
				<?php $_admin_count = (isset($this->_tpldata['admin'])) ? sizeof($this->_tpldata['admin']) : 0;if ($_admin_count) {for ($_admin_i = 0; $_admin_i < $_admin_count; ++$_admin_i){$_admin_val = &$this->_tpldata['admin'][$_admin_i]; ?>

					<tr class="<?php if (!($_admin_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } ?>">
						<td>
							<p><?php echo $_admin_val['USERNAME_FULL']; ?></p>
							<p><?php if ($_admin_val['RANK_IMG']) {  echo $_admin_val['RANK_IMG']; } else { echo $_admin_val['RANK_TITLE']; } ?></p>
						</td>
						<td class="bg2">
							<?php if ($_admin_val['U_GROUP']) {  ?>

								<p><a <?php if ($_admin_val['GROUP_COLOR']) {  ?>style="font-weight: bold; color: #<?php echo $_admin_val['GROUP_COLOR']; ?>"<?php } ?> href="<?php echo $_admin_val['U_GROUP']; ?>"><?php echo $_admin_val['GROUP_NAME']; ?></a></p>
							<?php } else { ?>

								<p><?php echo $_admin_val['GROUP_NAME']; ?></p>
							<?php } ?>

						</td>
						<td>-</td>
					</tr>
				<?php }} else { ?>

					<tr class="bg1">
						<td colspan="3"><p><?php echo ((isset($this->_rootref['L_NO_ADMINISTRATORS'])) ? $this->_rootref['L_NO_ADMINISTRATORS'] : ((isset($user->lang['NO_ADMINISTRATORS'])) ? $user->lang['NO_ADMINISTRATORS'] : '{ NO_ADMINISTRATORS }')); ?></p></td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</div>
	
	<div class="forums-wrapper">
		<table class="forums">
			<thead>
				<tr>
					<th><?php echo ((isset($this->_rootref['L_MODERATORS'])) ? $this->_rootref['L_MODERATORS'] : ((isset($user->lang['MODERATORS'])) ? $user->lang['MODERATORS'] : '{ MODERATORS }')); ?></th>
					<th class="group"><?php echo ((isset($this->_rootref['L_PRIMARY_GROUP'])) ? $this->_rootref['L_PRIMARY_GROUP'] : ((isset($user->lang['PRIMARY_GROUP'])) ? $user->lang['PRIMARY_GROUP'] : '{ PRIMARY_GROUP }')); ?></th>
					<th class="group"><?php echo ((isset($this->_rootref['L_FORUMS'])) ? $this->_rootref['L_FORUMS'] : ((isset($user->lang['FORUMS'])) ? $user->lang['FORUMS'] : '{ FORUMS }')); ?></th>
				</tr>
			</thead>
			<tbody>	
				<?php $_mod_count = (isset($this->_tpldata['mod'])) ? sizeof($this->_tpldata['mod']) : 0;if ($_mod_count) {for ($_mod_i = 0; $_mod_i < $_mod_count; ++$_mod_i){$_mod_val = &$this->_tpldata['mod'][$_mod_i]; ?>

					<tr class="<?php if (!($_mod_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } ?>">
						<td>
							<p><?php echo $_mod_val['USERNAME_FULL']; ?></p>
							<p><?php if ($_mod_val['RANK_IMG']) {  echo $_mod_val['RANK_IMG']; } else { echo $_mod_val['RANK_TITLE']; } ?></p>
						</td>
						<td class="bg2">
							<?php if ($_admin_val['U_GROUP']) {  ?>

								<p><a <?php if ($_mod_val['GROUP_COLOR']) {  ?>style="font-weight: bold; color: #<?php echo $_mod_val['GROUP_COLOR']; ?>"<?php } ?> href="<?php echo $_mod_val['U_GROUP']; ?>"><?php echo $_mod_val['GROUP_NAME']; ?></a></p>
							<?php } else { ?>

								<p><?php echo $_mod_val['GROUP_NAME']; ?></p>
							<?php } ?>

						</td>
						<td><?php if (! $_mod_val['FORUMS']) {  ?><p><?php echo ((isset($this->_rootref['L_ALL_FORUMS'])) ? $this->_rootref['L_ALL_FORUMS'] : ((isset($user->lang['ALL_FORUMS'])) ? $user->lang['ALL_FORUMS'] : '{ ALL_FORUMS }')); ?></p><?php } else { ?><select style="width: 100%;"><?php echo $_mod_val['FORUMS']; ?></select><?php } ?></td>
					</tr>
				<?php }} else { ?>

					<tr class="bg1">
						<td colspan="3"><p><?php echo ((isset($this->_rootref['L_NO_MODERATORS'])) ? $this->_rootref['L_NO_MODERATORS'] : ((isset($user->lang['NO_MODERATORS'])) ? $user->lang['NO_MODERATORS'] : '{ NO_MODERATORS }')); ?></p></td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</div>
</form>

<?php $this->_tpl_include('jumpbox.html'); $this->_tpl_include('overall_footer.html'); ?>