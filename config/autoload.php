<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Itunes_feed_generator
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ItunesFeedGenerator',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'ItunesFeedGenerator\feedInsertTags'      => 'system/modules/itunes_feed_generator/feedInsertTags.php',
	'ItunesFeedGenerator\feedGenerator'       => 'system/modules/itunes_feed_generator/feedGenerator.php',
	// Models
	'ItunesFeedGenerator\ItunesFeedsModel'    => 'system/modules/itunes_feed_generator/models/ItunesFeedsModel.php',
	'ItunesFeedGenerator\ItunesEpisodesModel' => 'system/modules/itunes_feed_generator/models/ItunesEpisodesModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_itunes_feed_deleteFile' => 'system/modules/itunes_feed_generator/templates',
	'be_itunes_feed_generate'   => 'system/modules/itunes_feed_generator/templates',
));
