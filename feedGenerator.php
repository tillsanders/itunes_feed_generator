<?php

namespace ItunesFeedGenerator;

class feedGenerator extends \Backend {

	/*
	 * Generates itunes feed
	 * @param /DataContainer
	 */
	public function generate($feedPointer){
		$message = new \Message();
		$message->addConfirmation($GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_generate']['confirmation']);
		
		if(is_string($feedPointer))
		{
			$feedId = $feedPointer;
		}
		else
		{
			$feedId = $feedPointer->id;			
		}

		$feedData = \ItunesFeedsModel::findByPk($feedId);
		
		// Starting XML-Feed
		$feed  = '<?xml version="1.0" encoding="UTF-8"?>';
		$feed .= '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">';
		
		// Channel
		$feed .= '<channel>';
		$feed .= '<title>'.$this->encodeXML($feedData->title).'</title>';
		$feed .= '<link>'.$this->encodeXML($this->convertRelativePath($this->replaceInsertTags($feedData->link))).'</link>';
		$feed .= '<language>'.$this->encodeXML($feedData->language).'</language>';
		$feed .= '<copyright>'.$this->encodeXML($feedData->copyright).'</copyright>';
		$feed .= '<itunes:subtitle>'.$this->encodeXML($feedData->subtitle).'</itunes:subtitle>';
		$feed .= '<itunes:author>'.$this->encodeXML($feedData->author).'</itunes:author>';
		$feed .= '<itunes:summary>'.$this->encodeXML($feedData->summary).'</itunes:summary>';
		$feed .= '<description>'.$this->encodeXML($feedData->summary).'</description>';
		$feed .= '<itunes:owner>';
		$feed .= '<itunes:name>'.$this->encodeXML($feedData->owner_name).'</itunes:name>';
		$feed .= '<itunes:email>'.$this->encodeXML($feedData->owner_email).'</itunes:email>';
		$feed .= '</itunes:owner>';
		$feed .= '<itunes:image href="'.$this->encodeXML($this->convertRelativePath($feedData->image)).'" />';
		
		$this->import('tl_itunes_feeds');
		$categoriesArr = $this->tl_itunes_feeds->categories();
		
		// Category 1
		if(array_key_exists($feedData->category_1, $categoriesArr))
		{
			$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_1).'"/>';
		}
		else
		{
			$category1Key = $this->array_get_parent($feedData->category_1, $categoriesArr);	
			$feed .= '<itunes:category text="'.$this->encodeXML($category1Key).'">';
			$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_1).'"/>';
			$feed .= '</itunes:category>';
		}
		
		// Category 2 (optional)
		if(!empty($feedData->category_2))
			if(array_key_exists($feedData->category_2, $categoriesArr))
			{
				$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_2).'"/>';
			}
			else
			{
				$category2Key = $this->array_get_parent($feedData->category_2, $categoriesArr);	
				$feed .= '<itunes:category text="'.$this->encodeXML($category2Key).'">';
				$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_2).'"/>';
				$feed .= '</itunes:category>';
			}		
		
		// Category 3 (optional)
		if(!empty($feedData->category_3))
			if(array_key_exists($feedData->category_3, $categoriesArr))
			{
				$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_3).'"/>';
			}
			else
			{
				$category3Key = $this->array_get_parent($feedData->category_3, $categoriesArr);	
				$feed .= '<itunes:category text="'.$this->encodeXML($category3Key).'">';
				$feed .= '<itunes:category text="'.$this->encodeXML($feedData->category_3).'"/>';
				$feed .= '</itunes:category>';
			}
		
		// Published?
		if(!$feedData->published)
			$feed .= '<itunes:block>yes</itunes:block>';
			
		$feed .= '<itunes:explicit>'.$feedData->explicit.'</itunes:explicit>';
		
		// Completed?
		if($feedData->complete)
			$feed .= '<itunes:complete>yes</itunes:complete>';
			
		$feed .= '<itunes:keywords>'.$this->encodeXML($feedData->keywords).'</itunes:keywords>';
			
		// New feed URL?
		if(!empty($feedData->newFeedLink))
			$feed .= '<itunes:new-feed-url>'.$this->encodeXML($feedData->newFeedLink).'</itunes:new-feed-url>';
			
			
		// Get items
		$items = \ItunesEpisodesModel::getItemsByPid($feedData->id);
			
		// Parse the items
		if ($items !== null)
		{
			while($items->next())
			{
				
				$feed .= '<item>';
				$feed .= '<title>'.$this->encodeXML($items->title).'</title>';
				if(!empty($items->order))
					$feed .= '<itunes:order>'.$items->order.'</itunes:order>';
				$feed .= '<itunes:author>'.$this->encodeXML($items->author).'</itunes:author>';
				$feed .= '<itunes:subtitle>'.$this->encodeXML($items->subtitle).'</itunes:subtitle>';
				$feed .= '<itunes:summary>'.$this->encodeXML($items->summary).'</itunes:summary>';
				$feed .= '<itunes:image href="'.$this->encodeXML($items->image).'" />';
				$videoUrl = $this->convertRelativePath($this->encodeXML($items->video), '', true);
				$feed .= '<enclosure url="'.$videoUrl.'" length="'.$items->length.'" type="'.$this->getMimeType($videoUrl).'" />';
				if($items->guidDontUsePermalink)
				{
					$feed .= '<guid>'.$this->encodeXML($items->guid).'</guid>';
				}
				else
				{
					$feed .= '<guid>'.$this->encodeXML($items->video).'</guid>';
				}
				$feed .= '<pubDate>'.date('r', $items->pubDate+$items->pubTime).'</pubDate>';
				$feed .= '<itunes:duration>'.$items->duration.'</itunes:duration>';
				$feed .= '<itunes:keywords>'.$this->encodeXML($items->keywords).'</itunes:keywords>';
				if(!$items->published)
					$feed .= '<itunes:block>yes</itunes:block>';	
				$feed .= '<itunes:explicit>'.$items->explicit.'</itunes:explicit>';
				if($items->isClosedCaptioned)
					$feed .= '<itunes:isClosedCaptioned>yes</itunes:isClosedCaptioned>';	
				$feed .= '</item>';
			}
		}
			
		$feed .= '</channel>';
		$feed .= '</rss>';

		$file = new \File('share/'.$feedData->alias.'.xml');
		$file->write($feed);
		$file->close();
		
		$objTemplate = new \BackendTemplate('be_itunes_feed_generate');
		$objTemplate->action = ampersand(\Environment::get('request'));
		$objTemplate->headline = sprintf($GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_generate']['headline'], $feedId);
		$objTemplate->message = $message->generate();		
		$objTemplate->submit = $GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_generate']['submit'];
		
		return $objTemplate->parse();
		
	}
	
	/**
	 * Delete xml file of itunes feed
	 */
	public function deleteFile(){
		$message = new \Message();
		$message->addConfirmation($GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_deleteFile']['confirmation']);
		
		$feedId = $this->Input->get('id');
		$feedModel = new ItunesFeedsModel();
		$feedData = $feedModel->findByPk($feedId);

		$file = new \File('share/'.$feedData->alias.'.xml');
		$file->delete();
		$file->close();
		
		$objTemplate = new \BackendTemplate('be_itunes_feed_deleteFile');
		$objTemplate->action = ampersand(\Environment::get('request'));
		$objTemplate->headline = sprintf($GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_deleteFile']['headline'], $feedId);
		$objTemplate->message = $message->generate();		
		$objTemplate->submit = $GLOBALS['TL_LANG']['tl_itunes_feeds']['be_itunes_feed_deleteFile']['submit'];
		
		return $objTemplate->parse();	
	}
	
	/**
	 * Delete old files and generate all feeds
	 */
	public function generateFeeds()
	{
		$this->import('Automator');
		$this->Automator->purgeXmlFiles();

		$objFeed = \ItunesFeedsModel::findAll();

		if ($objFeed !== null)
		{
			while ($objFeed->next())
			{
				$this->generate($objFeed->id);
				$this->log('Generated itunes feed "' . $objFeed->alias . '.xml"', 'feedGenerator generateFeeds()', TL_CRON);
			}
		}
	}
	
	/**
	 * Return the names of the existing feeds so they are not removed
	 * @return array
	 */
	public function purgeOldFeeds()
	{
		$arrFeeds = array();
		$objFeeds = \ItunesFeedsModel::findAll();

		if ($objFeeds !== null)
		{
			while ($objFeeds->next())
			{
				$arrFeeds[] = $objFeeds->alias;
			}
		}

		return $arrFeeds;
	}
	
	// Vorlage: Controller::sendFileToBrowser()
	public function downloadFile()
	{
		$feedId = $this->Input->get('id');
		$feedModel = new ItunesFeedsModel();
		$feedData = $feedModel->findByPk($feedId);
		$strFile = 'share/'.$feedData->alias.'.xml';
		
		// Make sure there are no attempts to hack the file system
		if (preg_match('@^\.+@i', $strFile) || preg_match('@\.+/@i', $strFile) || preg_match('@(://)+@i', $strFile))
		{
			header('HTTP/1.1 404 Not Found');
			die('Invalid file name');
		}

		// Limit downloads to the share directory
		if (!preg_match('@^' . preg_quote('share', '@') . '@i', $strFile))
		{
			header('HTTP/1.1 404 Not Found');
			die('Invalid path');
		}

		// Check whether the file exists
		if (!file_exists(TL_ROOT . '/' . $strFile))
		{
			header('HTTP/1.1 404 Not Found');
			die('File not found');
		}

		$objFile = new \File($strFile);
		$arrAllowedTypes = array('xml');

		if (!in_array($objFile->extension, $arrAllowedTypes))
		{
			header('HTTP/1.1 403 Forbidden');
			die(sprintf('File type "%s" is not allowed', $objFile->extension));
		}

		// Make sure no output buffer is active
		// @see http://ch2.php.net/manual/en/function.fpassthru.php#74080
		while (@ob_end_clean());

		// Prevent session locking (see #2804)
		session_write_close();

		// Open the "save as …" dialogue
		header('Content-Type: ' . $objFile->mime);
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="' . $objFile->basename . '"');
		header('Content-Length: ' . $objFile->filesize);
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		header('Connection: close');

		$resFile = fopen(TL_ROOT . '/' . $strFile, 'rb');
		fpassthru($resFile);
		fclose($resFile);

		// Stop the script
		exit;
	}
	
	public function array_get_parent($search_value, $array){
		foreach($array as $key => $value) {
			if(is_array($value))
				if(in_array($search_value, $value)) return $key;
		}
	}
	
	public function encodeXML($string){
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
		
	public function getMimeType($url)
	{
		$ext = pathinfo($url, PATHINFO_EXTENSION);
		$mimeTypes = array(
			'mp3' => 'audio/mpeg',
			'm4a' => 'audio/x-m4a',
			'mp4' => 'video/mp4',
			'm4v' => 'video/x-m4v',
			'mov' => 'video/quicktime',
			'pdf' => 'application/pdf',
			'epub' => 'document/x-epub',
		);
		return $mimeTypes[$ext];
	}
	
	/**
	 * Convert relative path to absolute URL
	 * 
	 * @param string  $strPath     The path
	 * @param string  $strBase     An optional base URL
	 * 
	 * @return string The converted URL
	 */
	public static function convertRelativePath($strPath, $strBase='')
	{
		if ($strBase == '')
		{
			$strBase = \Environment::get('base');
		}
		if (!preg_match('@^(https?://|ftp://|mailto:|#)@i', $strPath))
		{
			$strPath = $strBase.(($strPath != '/') ? $strPath : '');
		}
		return $strPath;
	}
	
}