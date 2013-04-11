<?php

// Operations

$GLOBALS['TL_LANG']['tl_itunes_episodes']['new'][0] = 'Episode anlegen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['new'][1] = 'Diesem iTunes-Feed eine enuee Episode hinzufügen';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['show'][0] = 'Episoden-Details';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['show'][1] = 'Details der Episode ID %s anzeigen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['edit'][0] = 'Episode bearbeiten';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['edit'][1] = 'Episode ID %s bearbeiten';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['copy'][0] = 'Episode duplizieren';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['copy'][1] = 'Episode ID %s duplizieren';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['delete'][0] = 'Episode löschen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['delete'][1] = 'Episode ID %s löschen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['toggle'][0] = 'Episode veröffentlichen/unveröffentlichen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['toggle'][1] = 'Episode ID %s veröffentlichen/unveröffentlichen';

// Fields

/*
$GLOBALS['TL_LANG']['tl_itunes_episodes'][''][0] = '';
$GLOBALS['TL_LANG']['tl_itunes_episodes'][''][1] = '';
*/

$GLOBALS['TL_LANG']['tl_itunes_episodes']['title'][0] = 'Titel';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['title'][1] = 'Titel der Episode';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['subtitle'][0] = 'Untertitel';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['subtitle'][1] = 'Untertitel der Episode';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['guidDontUsePermalink'][0] = 'GUID anpassen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['guidDontUsePermalink'][1] = 'Die GUID ist eine statische, eindeutige Kennung (\'globally unique identifier\'). Wenn Folgen zu einem Feed hinzugefügt werden, werden diese Kennungen verglichen (unter Beachtung von Groß- und Kleinschreibung), um festzustellen, welche Folgen neu sind. Ist hier ein Häkchen gesetzt, kann die GUID frei gewählt werden. Andernfalls wird die URL des Videos verwendet.';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['guid'][0] = 'GUID';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['guid'][1] = 'Angepasste GUID. Beispielsweise eine Art Alias. Wird die GUID nicht von Hand angepasst, wird automatisch die URL des Videos verwendet.';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['author'][0] = 'Autor';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['author'][1] = 'Voller Name des Autors / der Autoren der Folge.';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['manualOrder'][0] = 'Reihenfolge';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['manualOrder'][1] = 'Um eine Reihenfolge (abweichend von der Sortierung nach dem Erscheinungs-Zeitpunkt) festzulegen, kann hier eine Ganz-Zahl eingetragen werden.';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubDate'][0] = 'Erscheinungsdatum';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubDate'][1] = 'Datum der Veröffentlichung dieser Episode';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubTime'][0] = 'Uhrzeit der Veröffentlichung';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['pubTime'][1] = 'Uhrzeit der Veröffentlichung dieser Episode';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['summary'][0] = 'Zusammenfassung / Beschreibung';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['summary'][1] = 'Zusammenfassung / Beschreibung der Episode in ganzen Sätzen.';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['keywords'][0] = 'Suchbegriffe';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['keywords'][1] = 'Suchbegriffe, welche den Inhalt der Episode beschreiben (max. 12)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['image'][0] = 'Bild / Vorschau';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['image'][1] = 'Bild / Vorschaubild der Episode (mind. 1400 x 1400; quadratisch; RGB; JPG oder PNG)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['video'][0] = 'Video-Quelle';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['video'][1] = 'Die URL der Video-Datei der Episode (mp3, m4a, mp4, m4v, mov, pdf oder epub)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['duration'][0] = 'Dauer';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['duration'][1] = 'Länge der Episode (SS:MM:ss, S:MM:ss, MM:ss oder M:ss; S = Stunden, M = Minuten, s = Sekunden)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['length'][0] = 'Dateigröße';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['length'][1] = 'Größe der Datei in Byte (Angabe wird von iTunes zum Streamen benötigt)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['closedCaptioned'][0] = 'Digitale Untertitel vorhanden';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['closedCaptioned'][1] = 'Ankreuzen, wenn das Video über digitale (d.h. auf Wunsch aus-/einblendbare Untertitel) verfügt';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit'][0] = 'Altersfreigabe';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit'][1] = 'Enthält die Episode potenziell nicht-jugendfreie Inhalte?';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit']['yes'] = 'nicht-jugendfrei ("Explicit"-Grafik)';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit']['no'] = 'jugendfrei (keine zusätzliche Grafik)';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['explicit']['clean'] = 'jugendfrei ("Clean"-Grafik)';

$GLOBALS['TL_LANG']['tl_itunes_episodes']['published'][0] = 'Episode veröffentlichen';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['published'][1] = 'Die Episode für die Anzeige in iTunes freigeben (Hinweis: Die Episode ist stets im Feed enthalten. Bei Nicht-Veröffentlichung wird iTunes jedoch mittels eines Tags angewiesen, die Episode nicht anzuzeigen.';

// Pallettes

$GLOBALS['TL_LANG']['tl_itunes_episodes']['title_legend'] = 'Titel';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['author_legend'] = 'Autor & Reihenfolge';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['guid_legend'] = 'GUID';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['pub_legend'] = 'Erscheinungsdatum';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['summary_legend'] = 'Zusammenfassung & Suchbegriffe';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['src_legend'] = 'Vorschau und Video-Material';
$GLOBALS['TL_LANG']['tl_itunes_episodes']['publish_legend'] = 'Veröffentlichung';