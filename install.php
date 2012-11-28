<?php
require_once __DIR__."/../../autoload.php";
use Mouf\Actions\InstallUtils;
use Mouf\MoufManager;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instance
$moufManager = MoufManager::getMoufManager();
$defaultLanguageDetection = $moufManager->getInstanceDescriptor('defaultLanguageDetection');

if ($moufManager->instanceExists("jQueryValidateLibrary")) {
	$jQueryValidateLib = $moufManager->getInstanceDescriptor("jQueryValidateLibrary");
} else {
	$jQueryValidateLib = $moufManager->createInstance("Mouf\\Html\\Utils\\I18nWebLibrary\\I18nWebLibrary");
	$jQueryValidateLib->setName("jQueryValidateLibrary");
}

$jQueryValidateLib->getProperty("languageDetection")->setValue($defaultLanguageDetection);
$jQueryValidateLib->getProperty("jsFiles")->setValue(array(
	'vendor/mouf/javascript.jquery.jquery-validate/jquery.validate.min.js',
	'vendor/mouf/javascript.jquery.jquery-validate/localization/messages_[lang].js'
));

$renderer = $moufManager->getInstanceDescriptor('defaultWebLibraryRenderer');

$jQueryValidateLib->getProperty("renderer")->setValue($renderer);
$jQueryValidateLib->getProperty("dependencies")->setValue(array($moufManager->getInstanceDescriptor('jQueryLibrary')));

$webLibraryManager = $moufManager->getInstanceDescriptor('defaultWebLibraryManager');
if ($webLibraryManager) {
	$libraries = $webLibraryManager->getProperty("webLibraries")->getValue();
	$libraries[] = $jQueryValidateLib;
	$webLibraryManager->getProperty("webLibraries")->setValue($libraries);
}

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall();