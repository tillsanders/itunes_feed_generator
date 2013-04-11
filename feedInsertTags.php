<?php

namespace ItunesFeedGenerator;

class feedInsertTags extends \Controller {

	public function replaceItunesFeedInsertTags($strTag)
	{
		$arrSplit = explode('::', $strTag);
		// if {{itunes_feed_url::(id|aliaa)}} or {{itunes_feed_open::(id|alias)}}
		if ($arrSplit[0] == 'itunes_feed_url' || $arrSplit[0] == 'itunes_feed_open')
		{
			if (isset($arrSplit[1]))
			{
				// get feed by id or alias
				$this->import('ItunesFeedsModel');
				$feed = $this->ItunesFeedsModel->findByPk($arrSplit[1]);
				if(is_null($feed))
					$feed = $this->ItunesFeedsModel->findBy('alias', $arrSplit[1]);
				if(!is_null($feed))
				{
					// if {{itunes_feed_url::(id|aliaa)}}
					if($arrSplit[0] == 'itunes_feed_url')
					{
						$this->import('feedGenerator');
						return $this->feedGenerator->convertRelativePath('share/'.$feed->alias.'.xml');
					}
					// if {{itunes_feed_open::(id|alias)}}
					elseif($arrSplit[0] == 'itunes_feed_open')
					{
						$this->import('feedGenerator');
						$href = $this->feedGenerator->convertRelativePath('share/'.$feed->alias.'.xml');
						return '<a href="'.$href.'" title="'.$feed->title.'">';
					}
				}
				else
				{
					return false;	
				}
			} else {
				return false;
			}
		}
		// if {{itunes_feed_close}}
		elseif ($arrSplit[0] == 'itunes_feed_close')
		{
			return '</a>';
		}
		return false;
	}
	
}