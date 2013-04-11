<?php

$GLOBALS['BE_MOD']['content']['itunes_feed_generator'] = array(
	'tables' => array('tl_itunes_feeds', 'tl_itunes_episodes'),
	'icon' => 'system/modules/itunes_feed_generator/assets/images/be_icon.png',
	'generate' => array('feedGenerator', 'generate'),
	'deleteFile' => array('feedGenerator', 'deleteFile'),
	'downloadFile' => array('feedGenerator', 'downloadFile'),
);

/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'itunes_feedss';
$GLOBALS['TL_PERMISSIONS'][] = 'itunes_feedsp';

/**
 * Register insert tags
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('feedInsertTags', 'replaceItunesFeedInsertTags');

/**
 * Register hook to add itunes feeds to the indexer
 */
$GLOBALS['TL_HOOKS']['removeOldFeeds'][] = array('feedGenerator', 'purgeOldFeeds');
$GLOBALS['TL_HOOKS']['generateXmlFiles'][] = array('feedGenerator', 'generateFeeds');