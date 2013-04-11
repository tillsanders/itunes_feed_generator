#itunes_feed_generator, a Contao plugin

Contao plugin to help you generate your itunes podcast feeds, by managing feed information and items.

## Status

The core features seem to work fine, but I haven't had much time yet to test everything, so it is still pre alpha. As soon, as everything seems a little more stable, I will hand it over to the contao extension repository as alpha1. Check out the features and roadmap, to see what's done and what's still missing.

## Features

Allthough not at all fully tested, these features are already in place:

* iTunes-Feeds:
 * Create / delete itunes feeds
 * Edit itunes feeds and fill in the channel information
* XML-Files:
 * Manually generate the xml-file in 'share/' with all feed information and items
 * Manually delete the generated xml-file
 * Get direct link to xml-file
 * Download xml-file (one click)
 * Hooked into maintenance (regeneration of XML-Files)
* Items (Episodes)
 * Create / copy / move / delete feed items (episodes) and fill in all needed information (Notice: the plugin only generates the feed, it does not take care of your video files!) 
* Miscellaneous
 * Link to Apples Specs about iTunes feeds

## Roadmap / Todo

* Clean up the code -.- (pretty messy due to the fact that there is no proper documentation about extending contao... and my lack of superawesome programming skills)
* Check about this licence-thing, copyright and stuff
* Test, find, fix. Repeat.
* Check the specs again. Maybe I missed something important?
* Feed-Validator.org -> valid feeds?
* Better explanations
* English translation (german only atm)
* find new todos ;)
