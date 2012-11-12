<?php if (!defined('IN_PHPBB')) exit; ?>Subject: Welcome to "<?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?>"

<?php echo (isset($this->_rootref['WELCOME_MSG'])) ? $this->_rootref['WELCOME_MSG'] : ''; ?>

Please keep this e-mail for your records. Your account information is as follows:

----------------------------
Username: <?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>

Board URL: <?php echo (isset($this->_rootref['U_BOARD'])) ? $this->_rootref['U_BOARD'] : ''; ?>
----------------------------

When logging in please use the <?php echo (isset($this->_rootref['AL_LOGIN_TYPE'])) ? $this->_rootref['AL_LOGIN_TYPE'] : ''; ?> button.

Thank you for registering.

<?php echo (isset($this->_rootref['EMAIL_SIG'])) ? $this->_rootref['EMAIL_SIG'] : ''; ?>