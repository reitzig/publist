<?php
$translations = array(
  // groupkey if no grouping is done
  'all' => 'Alle',
  // groupkey for entries that do not specify the grouping value
  'rest' => 'Rest',
  // Month names entries are compared against for sorting issues.
  // - Names are case insensitive
  // - Regular expression are supported to include alternatives like
  //   'january|jan'
  // - In translations, keep English names and short forms in case bibtex
  //   source is in English. E.g. 'enero|ene|january|jan'
  'months' => array('01' => 'januar|january|jan',
                    '02' => 'februar|february|feb',
                    '03' => 'märz|mär|march|mar',
                    '04' => 'april|apr',
                    '05' => 'mai|may',
                    '06' => 'juni|june|jun',
                    '07' => 'juli|july|jul',
                    '08' => 'august|aug',
                    '09' => 'september|sep',
                    '10' => 'oktober|okt|octuber|oct',
                    '11' => 'november|nov',
                    '12' => 'dezember|dez|december|dec'),

  // Representations of entry types used as headlines
  'entrytypes' => array('article'       => 'Artikel',
                        'book'          => 'Bücher',
                        'booklet'       => 'Hefte',
                        'conference'    => 'Konferenzen',
                        'inbook'        => 'In Büchern',
                        'incollection'  => 'In Sammelbänden',
                        'inproceedings' => 'In Berichten',
                        'manual'        => 'Handbücher',
                        'mastersthesis' => 'Masterarbeiten',
                        'misc'          => 'Verschiedenes',
                        'phdthesis'     => 'Dissertationen',
                        'proceedings'   => 'Berichte',
                        'techreport'    => 'Technische Berichte',
                        'unpublished'   => 'Unveröffentlicht',

                        // Map non-standard types to this type
                        'unknown'       => 'misc')
);
?>
