<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @version $Id: functions.php 6362 2012-05-29 05:17:56Z capedfuzz $
 * 
 * @category Piwik_Plugins
 * @package Piwik_UserSettings
 */

/**
 * @see libs/UserAgentParser/UserAgentParser.php
 */
require_once PIWIK_INCLUDE_PATH . '/libs/UserAgentParser/UserAgentParser.php';
		
function Piwik_getPluginsLogo( $oldLabel )
{
	return  'plugins/UserSettings/images/plugins/'. $oldLabel . '.gif';
}

function Piwik_getOSLabel($osId)
{
	$osName = UserAgentParser::getOperatingSystemNameFromId($osId);
	if($osName !== false)
	{
		return $osName;
	}
	if( $osId == 'UNK')
	{
		return Piwik_Translate('General_Unknown');
	}
	return $osId;
}

function Piwik_getOSShortLabel($osId)
{
	$osShortName = UserAgentParser::getOperatingSystemShortNameFromId($osId);
	if($osShortName !== false)
	{
		return $osShortName;
	}
	if( $osId == 'UNK')
	{
		return Piwik_Translate('General_Unknown');
	}
	return $osId;
}


function Piwik_UserSettings_getOSFamily($osLabel)
{
	$osId = UserAgentParser::getOperatingSystemIdFromName($osLabel);
	$osFamily = UserAgentParser::getOperatingSystemFamilyFromId($osId);
	
	if ($osFamily == 'unknown')
	{
		$osFamily = Piwik_Translate('General_Unknown');
	}
	else if ($osFamily == 'Gaming Console')
	{
		$osFamily = Piwik_Translate('UserSettings_GamingConsole');
	}
	
	return $osFamily;
}

function Piwik_UserSettings_getDeviceTypeFromOS($osLabel)
{
	$osId = UserAgentParser::getOperatingSystemIdFromName($osLabel);
	$osFamily = UserAgentParser::getOperatingSystemFamilyFromId($osId);
	
	// NOTE: translations done in another filter
	switch ($osFamily)
	{
		case 'Windows':
		case 'Linux':
		case 'Mac':
		case 'Unix':
		case 'Other':
		case 'Gaming Console':
			return 'General_Desktop';
		case 'iOS':
		case 'Android':
		case 'Windows Mobile':
		case 'Other Mobile':
		case 'Mobile Gaming Console':
			return 'General_Mobile';
		default:
			return 'General_Unknown';
	}
}

function Piwik_getBrowserTypeLabel($oldLabel)
{
	if(isset(Piwik_UserSettings::$browserType_display[$oldLabel]))
	{
		return Piwik_UserSettings::$browserType_display[$oldLabel];
	}
	if($oldLabel == 'unknown')
	{
		return Piwik_Translate('General_Unknown');
	}
	return $oldLabel;
}


function Piwik_getConfigurationLabel($str)
{
	if(strpos($str, ';') === false)
	{
		return $str;
	}
	$values = explode(";", $str);
	
	$os = Piwik_getOSLabel($values[0]);
	$name = $values[1];
	$browser = UserAgentParser::getBrowserNameFromId($name);
	if($browser === false)
	{
		$browser = Piwik_Translate('General_Unknown');
	}
	$resolution = $values[2];
	return $os . " / " . $browser . " / " . $resolution;
}

function Piwik_getBrowserLabel($oldLabel)
{
	$browserId = Piwik_getBrowserId($oldLabel);
	$version = Piwik_getBrowserVersion($oldLabel);
	$browserName = UserAgentParser::getBrowserNameFromId($browserId);
	if( $browserName !== false)
	{
		return $browserName . " ". $version;
	}
	if( $browserId == 'UNK')
	{
		return Piwik_Translate('General_Unknown');
	}
	return $oldLabel;
}

function Piwik_getBrowserShortLabel($oldLabel)
{
	$browserId = Piwik_getBrowserId($oldLabel);
	$version = Piwik_getBrowserVersion($oldLabel);
	$browserName = UserAgentParser::getBrowserShortNameFromId($browserId);
	if( $browserName !== false)
	{
		return $browserName . " ". $version;
	}
	if( $browserId == 'UNK')
	{
		return Piwik_Translate('General_Unknown');
	}
	return $oldLabel;
}

function Piwik_getBrowserId($str)
{
	return substr($str, 0, strpos($str, ';'));
}

function Piwik_getBrowserVersion($str)
{
	return substr($str, strpos($str, ';') + 1);
}

function Piwik_getBrowsersLogo($label)
{
	$id = Piwik_getBrowserId($label);
	// For aggregated row 'Others'
	if(empty($id)) {
		$id = 'UNK';
	}
	return  'plugins/UserSettings/images/browsers/'. $id . '.gif';
}

function Piwik_getOSLogo($label)
{
	// For aggregated row 'Others'
	if(empty($label)) {
		$label = 'UNK';
	}
	$path = 'plugins/UserSettings/images/os/'. $label . '.gif';
	return $path;
}

function Piwik_getScreensLogo($label)
{
	return 'plugins/UserSettings/images/screens/' . $label . '.gif';
}

function Piwik_UserSettings_getDeviceTypeImg( $oldOSImage, $osFamilyLabel )
{
	switch ($osFamilyLabel)
	{
		case 'General_Desktop':
			return 'plugins/UserSettings/images/screens/normal.gif';
		case 'General_Mobile':
			return 'plugins/UserSettings/images/screens/mobile.gif';
		case 'General_Unknown':
		default:
			return 'plugins/UserSettings/images/os/UNK.gif';
	}
}

function Piwik_UserSettings_keepStrlenGreater($value)
{
	return strlen($value) > 5;
}

function Piwik_getScreenTypeFromResolution($resolution)
{
	if($resolution === 'unknown')
	{
		return $resolution;
	}

	$width = intval(substr($resolution, 0, strpos($resolution, 'x')));
	$height= intval(substr($resolution, strpos($resolution, 'x') + 1));
	$ratio = Piwik::secureDiv($width, $height);
	
	if($width < 640)
	{
		$name = 'mobile';
	}
	elseif($ratio < 1.4)
	{
		$name = 'normal';
	}
	else if($ratio < 2)
	{
		$name = 'wide';
	}
	else
	{
		$name = 'dual';
	}
	return $name;
}

function Piwik_getBrowserFamily($browserLabel)
{
	$familyNameToUse = UserAgentParser::getBrowserFamilyFromId(substr($browserLabel, 0, 2));
	return $familyNameToUse;	
}

/**
 * Extracts the browser name from a string with the browser name and version.
 */
function Piwik_UserSettings_getBrowserFromBrowserVersion( $browserWithVersion )
{
	if (preg_match("/(.+) [0-9]+(?:\.[0-9]+)?$/", $browserWithVersion, $matches) === 0)
	{
		return $browserWithVersion;
	}
	
	return $matches[1];
}

