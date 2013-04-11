<?php

/**
 * Table tl_itunes_feeds
 */
 
$GLOBALS['TL_DCA']['tl_itunes_feeds'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_itunes_episodes'),
		'enableVersioning'            => true,
		'onsubmit_callback' => array
		(
			array('tl_itunes_feeds', 'updateFeed')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'alias' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 2,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
		),
		'global_operations' => array
		(
			'appleSpecs' => array
			(
				'button_callback'     => array('tl_itunes_feeds', 'appleSpecs')
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"',
			),
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['edit'],
				'href'                => 'table=tl_itunes_episodes',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_itunes_feeds', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_itunes_feeds', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'generate' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['generate'],
				'href'                => 'key=generate',
				'icon'                => 'system/modules/itunes_feed_generator/assets/images/generate_icon.png',
				'button_callback'     => array('tl_itunes_feeds', 'generate')
			),
			'deleteFile' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['deleteFile'],
				'href'                => 'key=deleteFile',
				'icon'                => 'system/modules/itunes_feed_generator/assets/images/delete_icon.png',
				'button_callback'     => array('tl_itunes_feeds', 'deleteFile')
			),
			'publicLink' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['publicLink'],
				'icon'                => 'system/modules/itunes_feed_generator/assets/images/link_icon.png',
				'button_callback'     => array('tl_itunes_feeds', 'publicLink')
			),
			'downloadFile' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['downloadFile'],
				'href'                => 'key=downloadFile',
				'icon'                => 'system/modules/itunes_feed_generator/assets/images/download_icon.png',
				'button_callback'     => array('tl_itunes_feeds', 'downloadFile')
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title,alias;{subtitle_legend},subtitle,author;{owner_legend},owner_name,owner_email;{language_legend},language,copyright;{summary_legend},summary;{image_legend},image,link;{categories_legend},category_1,category_2,category_3,explicit;{complete_legend},complete,newFeedLink;{publish_legend},published;',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'label'                  => array('ID'),
			'search'                 => true,
			'sql'                    => "int(10) unsigned NOT NULL auto_increment"
		),
		'title' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['title'],
			'inputType'              => 'text',
			'search'                 => true,
			'sorting'                => true,
			'tl_class'               => 'w50',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'unique' => true,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['alias'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'alias',
											'doNotCopy' => true,
											'unique' => true,
											'spaceToUnderscore' => true,
											'maxlength' => 128,
											'tl_class' => 'w50',
										),
			'sql'                    => "varbinary(128) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_itunes_feeds', 'generateAlias')
			),
		),
		'subtitle' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['subtitle'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'author' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['author'],
			'inputType'              => 'text',
			'filter'                 => true,
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'owner_name' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['owner_name'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'owner_email' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['owner_email'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'rgxp' => 'email',
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'language' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['language'],
			'inputType'              => 'text',
			'filter'                 => true,
			'default'                => 'de-de',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 7,
											'nospace' => true,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(7) NOT NULL default ''"
		),
		'copyright' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['copyright'],
			'inputType'              => 'text',
			'default'                => '2013 by Max Mustermann',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 255,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'summary' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['summary'],
			'inputType'              => 'textarea',
			'eval'                   => array(
											'mandatory' => true,
											'maxlength' => 4000,
											'rows' => 5,
											'style' => 'height : auto;',
										),
			'sql'                    => "varchar(4000) NOT NULL default ''"
		),
		'keywords' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['keywords'],
			'inputType'              => 'text',
			'search'                 => true,
			'eval'                   => array(
											'mandatory' => true, 
											'maxlength' => 255,
											'nospace' => true,
											'tl_class' => 'long',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'image' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['image'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'url',
											'filesOnly' => true,
											'extensions' => 'jpg,png',
											'fieldType' => 'radio',
											'paths' => true,
											'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes'], 
											'tl_class' => 'wizard w50',
										),
			'wizard' => array
			(
				array('tl_itunes_feeds', 'filePicker')
			),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'link' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['link'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'url',
											'fieldType' => 'radio',
											'paths' => true,
											'maxlength' => 255,
											'tl_class' => 'wizard w50',
										),
			'wizard' => array
			(
				array('tl_itunes_feeds', 'pagePicker')
			),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'category_1' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['category_1'],
			'inputType'              => 'select',
			'options_callback'       => array('tl_itunes_feeds', 'categories'),
			'eval'                   => array(
											'mandatory' => true,
											'size' => 10,
										),
			'reference'              => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['categories'],
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'category_2' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['category_2'],
			'inputType'              => 'select',
			'options_callback'       => array('tl_itunes_feeds', 'categories'),
			'eval'                   => array(
											'size' => 10,
											'includeBlankOption' => true,
										),
			'reference'              => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['categories'],
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'category_3' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['category_3'],
			'inputType'              => 'select',
			'options_callback'       => array('tl_itunes_feeds', 'categories'),
			'eval'                   => array(
											'size' => 10,
											'includeBlankOption' => true,
										),
			'reference'              => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['categories'],
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'explicit' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['explicit'],
			'inputType'              => 'select',
			'filter'                 => true,
			'options'                => array('no', 'clean', 'yes'),
			'eval'                   => array(
											'mandatory' => true,
										),
			'reference'              => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['explicit'],
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'complete' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['complete'],
			'filter'                 => true,
			'inputType'              => 'checkbox',
			'eval'                   => array(
											'tl_class' => 'w50 m12',
										),
			'sql'                    => "char(1) NOT NULL default ''"
		),
		'newFeedLink' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['newFeedLink'],
			'inputType'              => 'text',
			'eval'                   => array(
											'maxlength' => 255,
											'tl_class' => 'wizard w50',
										),
			'wizard' => array
			(
				array('tl_itunes_feeds', 'pagePicker')
			),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_feeds']['published'],
			'filter'                 => true,
			'inputType'              => 'checkbox',
			'eval'                   => array(
											'doNotCopy' => true
										),
			'sql'                    => "char(1) NOT NULL default ''"
		),
		'tstamp' => array
		(
			'sql'                    => "int(10) unsigned NOT NULL default '0'"
		),
	)
);

/**
 * Class tl_itunes_feeds
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_itunes_feeds extends \Backend
{
	
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	/**
	 * Return the appleSpecs button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function appleSpecs()
	{
		return '<a href="'.$GLOBALS['TL_LANG']['tl_itunes_feeds']['appleSpecs']['url'].'" title="'.$GLOBALS['TL_LANG']['tl_itunes_feeds']['appleSpecs']['title'].'" target="_blank" style="background:url(\'system/themes/default/images/show.gif\') left center no-repeat;padding:3px 0 2px 20px;margin-left:15px;">'.' '.$GLOBALS['TL_LANG']['tl_itunes_feeds']['appleSpecs']['label'].'</a> ';
	}
	
	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || count(preg_grep('/^tl_itunes_feeds::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : '';
	}	

	/**
	 * Return the generate button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function generate($row, $href, $label, $title, $icon, $attributes)
	{
		$href .= '&amp;id='.$row['id'];
		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}
	
	/**
	 * Return the delete file button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteFile($row, $href, $label, $title, $icon, $attributes)
	{
		$href .= '&amp;id='.$row['id'];
		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}
	
	/**
	 * Return the link button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function publicLink($row, $href, $label, $title, $icon, $attributes)
	{
		$href = 'share/'.$row['alias'].'.xml';
		return $this->convertRelativeUrls('<a href="'.$href.'" title="'.specialchars($row['title']).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ', '', true);
	}
	
	/**
	 * Return the download button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function downloadFile($row, $href, $label, $title, $icon, $attributes)
	{
		$href .= '&amp;id='.$row['id'];
		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.' target="_blank">'.$this->generateImage($icon, $label).'</a> ';
	}
	
	/**
	 * Auto-generate a feed alias if it has not been set yet
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 * @throws \Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_itunes_feeds WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_itunes_feeds::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}
	
	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		Input::setGet('id', $intId);
		Input::setGet('act', 'toggle');
		$this->checkPermission();

		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_itunes_feeds::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish iTunes feed item ID "'.$intId.'"', 'tl_itunes_feeds toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_itunes_feeds', $intId);

		// Update the database
		$this->Database->prepare("UPDATE tl_itunes_feeds SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_itunes_feeds', $intId);

		// Update the RSS feed (for some reason it does not work without sleep(1))
		sleep(1);
		$this->import('feedGenerator');
		$this->feedGenerator->generate(CURRENT_ID);
	}
	
	/**
	 * Return the file picker wizard
	 * @param \DataContainer
	 * @return string
	 */
	public function filePicker(DataContainer $dc)
	{
		return ' <a href="contao/file.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.$dc->value.'" title="'.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MSC']['filepicker'])).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\''.specialchars($GLOBALS['TL_LANG']['MOD']['files'][0]).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . $this->generateImage('pickfile.gif', $GLOBALS['TL_LANG']['MSC']['filepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
	}
	
	/**
	 * Return the link picker wizard
	 * @param \DataContainer
	 * @return string
	 */
	public function pagePicker(DataContainer $dc)
	{
		return ' <a href="contao/page.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.str_replace(array('{{link_url::', '}}'), '', $dc->value).'" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\''.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
	}
	
	/**
	 * Return the itunes podcast category array
	 * @return array
	 */
	 
	public function categories()
	{
		return array(
			'Arts' => array(
				'Design',
				'Fashion & Beauty', 
				'Food',
				'Literature',
				'Performing Arts',
				'Visual Arts',
			), 
			'Business' => array(
				'Business News',
				'Careers',
				'Investing',
				'Management & Marketing',
				'Shopping',
			),
			'Comedy' => 'Comedy',
			'Education' => array(
				'Education',
				'Education Technology',
				'Higher Education',
				'K-12',
				'Language Courses',
				'Training',
			),
			'Games & Hobbies' => array(
				'Automotive',
				'Aviation',
				'Hobbies',
				'Other Games',
				'Video Games',
			),
			'Government & Organizations' => array(
				'Local',
				'National',
				'Non-Profit',
				'Regional',
			),
			'Health' => array(
				'Alternative Health',
				'Fitness & Nutrition',
				'Self-Help',
				'Sexuality',
			),
			'Kids & Family' => 'Kids & Family',
			'Music' => 'Music',
			'News & Politics' => 'News & Politics',
			'Religion & Spirituality' => array(
				'Buddhism',
				'Christianity',
				'Hinduism',
				'Islam',
				'Judaism',
				'Other',
				'Spirituality',
			),
			'Science & Medicine' => array(
				'Medicine',
				'Natural Sciences',
				'Social Sciences',
			),
			'Society & Culture' => array(
				'History',
				'Personal Journals',
				'Philosophy',
				'Places & Travel',
			),
			'Sports &amp; Recreation' => array(
				'Amateur',
				'College & High School',
				'Outdoor',
				'Professional',
			),
			'Technology' => array(
				'Gadgets',
				'Tech News',
				'Podcasting',
				'Software How-To',
			),
			'TV &amp; Film' => 'TV &amp; Film',
		);
	}
	
	/**
	 * Check permissions to edit table tl_news_archive
	 */
	public function checkPermission()
	{

		if ($this->User->isAdmin)
		{
			return;
		}

		// Set root IDs
		if (!is_array($this->User->itunes_feedss) || empty($this->User->itunes_feedss))
		{
			$root = array(0);
		}
		else
		{
			$root = $this->User->itunes_feedss;
		}

		$GLOBALS['TL_DCA']['tl_itunes_feeds']['list']['sorting']['root'] = $root;

		// Check permissions to add itunes feeds
		if (!$this->User->hasAccess('create', 'itunes_feedsp'))
		{
			$GLOBALS['TL_DCA']['tl_itunes_feeds']['config']['closed'] = true;
		}

		// Check current action
		switch (Input::get('act'))
		{
			case 'create':
			case 'select':
				// Allow
				break;

			case 'edit':
				// Dynamically add the record to the user profile
				if (!in_array(Input::get('id'), $root))
				{
					$arrNew = $this->Session->get('new_records');

					if (is_array($arrNew['tl_itunes_feeds']) && in_array(Input::get('id'), $arrNew['tl_itunes_feeds']))
					{
						// Add permissions on user level
						if ($this->User->inherit == 'custom' || !$this->User->groups[0])
						{
							$objUser = $this->Database->prepare("SELECT itunes_feedss, itunes_feedsp FROM tl_user WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->id);

							$arrFaqp = deserialize($objUser->itunes_feedsp);

							if (is_array($arrFaqp) && in_array('create', $arrFaqp))
							{
								$arrItunes_feedss = deserialize($objUser->itunes_feedss);
								$arrItunes_feedss[] = Input::get('id');

								$this->Database->prepare("UPDATE tl_user SET itunes_feedss=? WHERE id=?")
											   ->execute(serialize($arrItunes_feedss), $this->User->id);
							}
						}

						// Add permissions on group level
						elseif ($this->User->groups[0] > 0)
						{
							$objGroup = $this->Database->prepare("SELECT itunes_feedss, itunes_feedsp FROM tl_user_group WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->groups[0]);

							$arrItunes_feedsp = deserialize($objGroup->itunes_feedsp);

							if (is_array($arrItunes_feedsp) && in_array('create', $arrItunes_feedsp))
							{
								$arrItunes_feedss = deserialize($objGroup->itunes_feedss);
								$arrItunes_feedss[] = Input::get('id');

								$this->Database->prepare("UPDATE tl_user_group SET itunes_feedss=? WHERE id=?")
											   ->execute(serialize($arrItunes_feedss), $this->User->groups[0]);
							}
						}

						// Add new element to the user object
						$root[] = Input::get('id');
						$this->User->itunes_feedss = $root;
					}
				}
				// No break;

			case 'copy':
			case 'delete':
			case 'show':
				if (!in_array(Input::get('id'), $root) || (Input::get('act') == 'delete' && !$this->User->hasAccess('delete', 'itunes_feedsp')))
				{
					$this->log('Not enough permissions to '.Input::get('act').' iTunes feed ID "'.Input::get('id').'"', 'tl_itunes_feeds checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'editAll':
			case 'deleteAll':
			case 'overrideAll':
				$session = $this->Session->getData();
				if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'itunes_feedsp'))
				{
					$session['CURRENT']['IDS'] = array();
				}
				else
				{
					$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				}
				$this->Session->setData($session);
				break;

			default:
				if (strlen(Input::get('act')))
				{
					$this->log('Not enough permissions to '.Input::get('act').' iTunes feeds', 'tl_itunes_feeds checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;
		}
	}

	/**
	 * Update a iTunes feed
	 *
	 * This method is triggered when a single news archive or multiple news
	 * archives are modified (edit/editAll).
	 * @param \DataContainer
	 */
	public function updateFeed(DataContainer $dc)
	{
		// Return if there is no ID
		if (!$dc->id)
		{
			return;
		}

		// generate feed
		$this->import('feedGenerator');
		$this->feedGenerator->generate($dc->id);
	}
}