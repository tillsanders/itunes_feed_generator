<?php

/**
 * Table tl_itunes_feeds
 */
 
$GLOBALS['TL_DCA']['tl_itunes_episodes'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_itunes_feeds',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		/*'onsubmit_callback' => array
		(
			array('tl_itunes_feeds', 'updateFeed')
		),*/
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'headerFields'            => array('title', 'subtitle', 'author', 'published'),
			'child_record_callback'   => array('tl_itunes_episodes', 'listEpisodes'),
			'fields'                  => array('pubDate'),
			'flag'                    => 5,
			'panelLayout'             => 'filter;search,sort,limit',
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"',
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_itunes_episodes', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('guidDontUsePermalink'),
		'default'                     => '{title_legend},title,subtitle;{guid_legend},guidDontUsePermalink;{author_legend},author,manualOrder;{pub_legend},pubDate,pubTime;{summary_legend},summary,keywords;{src_legend},image,video,duration,length,closedCaptioned,explicit;{publish_legend},published;',
	),
	
	// Subpalettes
	'subpalettes' => array
	(
		'guidDontUsePermalink'           => 'guid',
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
		'pid' => array
		(
			'foreignKey'             => 'tl_itunes_feeds.title',
			'sql'                    => "int(10) unsigned NOT NULL default '0'",
			'relation'               => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'title' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['title'],
			'inputType'              => 'text',
			'search'                 => true,
			'sorting'                => true,
			'eval'                   => array(
											'mandatory' => true, 
											'maxlength' => 255, 
											'unique' => true, 
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'subtitle' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['subtitle'],
			'inputType'              => 'text',
			'search'                 => true,
			'eval'                   => array(
											'mandatory' => true, 
											'maxlength' => 255, 
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'guidDontUsePermalink' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['guidDontUsePermalink'],
			'inputType'              => 'checkbox',
			'default'                => 1,
			'eval'                   => array(
											'tl_class' => 'w50 m12',
											'submitOnChange' => true,
										),
			'sql'                    => "char(1) NOT NULL default ''"
		),
		'guid' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['guid'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'doNotCopy' => true,
											'unique' => true,
											'maxlength' => 255,
											'tl_class' => 'w50',
										),
			'sql'                    => "varbinary(255) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_itunes_episodes', 'generateAlias')
			),
		),
		'author' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['author'],
			'inputType'              => 'text',
			'sorting'                => true,
			'filter'                 => true,
			'eval'                   => array(
											'mandatory' => true, 
											'maxlength' => 255, 
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'manualOrder' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['manualOrder'],
			'inputType'              => 'text',
			'sorting'                => true,
			'eval'                   => array(
											'maxlength' => 10,
											'rgxp' => 'digit',
											'unique' => true,
											'doNotCopy' => true, 
										),
			'sql'                    => "varchar(10) NOT NULL default ''"
		),
		'pubDate' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubDate'],
			'default'                => time(),
			'sorting'                => true,
			'flag'                   => 8,
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'date', 
											'datepicker' => true, 
											'tl_class' => 'w50 wizard',
										),
			'sql'                    => "int(10) unsigned NOT NULL default '0'"
		),
		'pubTime' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubTime'],
			'default'                => time(),
			'inputType'              => 'text',
			'eval'                   => array(
											'rgxp' => 'time',
											'tl_class' => 'w50',
										),
			'sql'                    => "int(10) unsigned NOT NULL default '0'"
		),
		'summary' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['summary'],
			'inputType'              => 'textarea',
			'eval'                   => array(
											'mandatory' => true,
											'rows' => 5,
											'maxlength' => 4000,
											'style' => 'height : auto;',
										),
			'sql'                    => "varchar(4000) NOT NULL default ''"
		),
		'keywords' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['keywords'],
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
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['image'],
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
				array('tl_itunes_episodes', 'filePicker')
			),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'video' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['video'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'url',
											'filesOnly' => true,
											'extensions' => 'mp3,m4a,mp4,m4v,mov,pdf,epub',
											'fieldType' => 'radio',
											'paths' => true,
											'tl_class' => 'wizard w50',
										),
			'wizard' => array
			(
				array('tl_itunes_episodes', 'filePicker')
			),
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'duration' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['duration'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'tl_class' => 'w50',
										),
			'sql'                    => "varchar(8) NOT NULL default ''"
		),
		'length' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['length'],
			'inputType'              => 'text',
			'eval'                   => array(
											'mandatory' => true,
											'rgxp' => 'digit',
											'tl_class' => 'w50',
										),
			'sql'                    => "int(10) unsigned NOT NULL default '0'"
		),
		'closedCaptioned' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['closedCaptioned'],
			'inputType'              => 'checkbox',
			'eval'                   => array(
											'tl_class' => 'w50 m12',
										),
			'sql'                    => "char(1) NOT NULL default ''"
		),
		'explicit' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit'],
			'inputType'              => 'select',
			'filter'                 => true,
			'options'                => array('no', 'clean', 'yes'),
			'eval'                   => array(
											'mandatory' => true,
											'tl_class' => 'w50',
										),
			'reference'              => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit'],
			'sql'                    => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                  => &$GLOBALS['TL_LANG']['tl_itunes_episodes']['published'],
			'filter'                 => true,
			'inputType'              => 'checkbox',
			'eval'                   => array(
											'doNotCopy' => true,
											'tl_class' => 'w50',
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
 * Class tl_itunes_episodes
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_itunes_episodes extends \Backend
{
	
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	public function listEpisodes($row) 
	{
		return $row['title'].'<br /><small><i>'.$row['subtitle'].'</i><br /><br />'.(!empty($row['manualOrder'])?$GLOBALS['TL_LANG']['tl_itunes_episodes']['manualOrder'][0].': '.$row['manualOrder'].', ':'').date($GLOBALS['TL_CONFIG']['datimFormat'], $row['pubDate']+$row['pubTime']).'</small>';
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
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_itunes_episodes::published', 'alexf'))
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
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_itunes_episodes::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish iTunes feed episode item ID "'.$intId.'"', 'tl_itunes_episodes toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_itunes_episodes', $intId);

		// Update the database
		$this->Database->prepare("UPDATE tl_itunes_episodes SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_itunes_episodes', $intId);

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
	 * Check permissions to edit table tl_itunes_episodes
	 */
	public function checkPermission()
	{

		if ($this->User->isAdmin)
		{
			return;
		}

		// Set the root IDs
		if (!is_array($this->User->itunes_episodes) || empty($this->User->itunes_episodes))
		{
			$root = array(0);
		}
		else
		{
			$root = $this->User->itunes_episodes;
		}

		$id = strlen(Input::get('id')) ? Input::get('id') : CURRENT_ID;

		// Check current action
		switch (Input::get('act'))
		{
			case 'paste':
				// Allow
				break;

			case 'create':
				if (!strlen(Input::get('pid')) || !in_array(Input::get('pid'), $root))
				{
					$this->log('Not enough permissions to create iTunes feed episode items in iTunes feed ID "'.Input::get('pid').'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'cut':
			case 'copy':
				if (!in_array(Input::get('pid'), $root))
				{
					$this->log('Not enough permissions to '.Input::get('act').' iTunes episode item ID "'.$id.'" to iTunes feed ID "'.Input::get('pid').'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				// NO BREAK STATEMENT HERE

			case 'edit':
			case 'show':
			case 'delete':
			case 'toggle':
				$objArchive = $this->Database->prepare("SELECT pid FROM tl_itunes_episodes WHERE id=?")
											 ->limit(1)
											 ->execute($id);

				if ($objArchive->numRows < 1)
				{
					$this->log('Invalid iTunes episode item ID "'.$id.'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}

				if (!in_array($objArchive->pid, $root))
				{
					$this->log('Not enough permissions to '.Input::get('act').' iTunes episode item ID "'.$id.'" of iTunes feed ID "'.$objArchive->pid.'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'select':
			case 'editAll':
			case 'deleteAll':
			case 'overrideAll':
			case 'cutAll':
			case 'copyAll':
				if (!in_array($id, $root))
				{
					$this->log('Not enough permissions to access iTunes feed ID "'.$id.'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}

				$objArchive = $this->Database->prepare("SELECT id FROM tl_itunes_episodes WHERE pid=?")
											 ->execute($id);

				if ($objArchive->numRows < 1)
				{
					$this->log('Invalid iTunes feed ID "'.$id.'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}

				$session = $this->Session->getData();
				$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $objArchive->fetchEach('id'));
				$this->Session->setData($session);
				break;

			default:
				if (strlen(Input::get('act')))
				{
					$this->log('Invalid command "'.Input::get('act').'"', 'tl_itunes_episodes checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				elseif (!in_array($id, $root))
				{
					$this->log('Not enough permissions to access iTunes feed ID ' . $id, 'tl_itunes_episodes checkPermission', TL_ERROR);
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
		if (!$dc->pid)
		{
			return;
		}

		// generate feed
		$this->import('feedGenerator');
		$this->feedGenerator->generate($dc->pid);
	}
}