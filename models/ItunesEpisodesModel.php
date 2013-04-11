<?php

namespace ItunesFeedGenerator;

class ItunesEpisodesModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_itunes_episodes';

	public static function getItemsByPid($pid)
	{
		$t = static::$strTable;
		$arrColumns = array("$t.pid IN(".$pid.")");
		$arrOptions['order']  = "$t.pubDate DESC";
		return static::findBy($arrColumns, null, $arrOptions);
	}

	
}
