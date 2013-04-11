#itunes_feed_generator, a Contao plugin

Contao plugin to help you generate your itunes podcast feeds, by managing feed information and items.

## Status

The core features seem to work fine, but I haven't had much time yet to test everything, so it is still pre alpha. As soon, as everything seems a little more stable, I will hand it over to the contao extension repository as alpha1. Check out the features and roadmap, to see what's done and what's still missing.

## Features

Allthough not at all fully tested, these features are already in place:

* iTunes-Feeds:
 * create / delete itunes feeds
 * edit itunes feeds and fill in the channel information
* XML-Files:
 * manually generate the xml-file in 'share/' with all feed information and items
 * manually delete the generated xml-file
 * get direct link to xml-file
 * download xml-file (one click)
 * hooked into maintenance (regeneration of XML-Files)
* Items (Episodes)
 * create / copy / move / delete feed items (episodes) and fill in all needed information (Notice: the plugin only generates the feed, it does not take care of your video files!) 
* Miscellaneous
 * link to Apples Specs about iTunes feeds
 * two insert tags (output link and url of given feed)

## Roadmap / Todo for 1.0 stable

* clean up the code -.- (pretty messy due to the fact that there is no proper documentation about extending contao... and my lack of superawesome programming skills)
* check about this licence-thing, copyright and stuff
* test, find, fix. Repeat.
* check the specs again. Maybe I missed something important?
* Feed-Validator.org -> valid feeds?
* better explainations
* English translation (german only atm)
* check this permission thing... still not sure, how it works in contao :/
* useful documentation / little homepage / demo (?)
* let some contao crack have a look at it!
* find new todos ;)

## Roadmap for 2.0 (far far away...)

* integrate Amazon S3 / DropBox / FTP / whateverismissing (file picker / upload (possible? useful?))
* integrate statistics (if possible)
* more insert tags
* some FE modules (list of feeds, episodes, embed video player, etc.)

## Questions / Ideas / Comments / anything?

Please feel encouraged to contact me!
