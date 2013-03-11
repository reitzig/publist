<?php
$translations = array(
  // groupkey if no grouping is done
  'all' => 'All',
  // groupkey for entries that do not specify the grouping value
  'rest' => 'Rest',
  // Month names entries are compared against for sorting issues.
  // - Names are case insensitive
  // - Regular expression are supported to include alternatives like
  //   'january|jan'
  // - In translations, keep English names and short forms in case bibtex
  //   source is in English. E.g. 'enero|ene|january|jan'
  'months' => array('01' => 'january|jan',
                     '02' => 'february|feb',
                     '03' => 'march|mar',
                     '04' => 'april|apr',
                     '05' => 'may',
                     '06' => 'june|jun',
                     '07' => 'july|jul',
                     '08' => 'august|aug',
                     '09' => 'september|sep',
                     '10' => 'october|oct',
                     '11' => 'november|nov',
                     '12' => 'december|dec'),

  // Representations of entry types used as headlines
  'entrytypes' => array('article'       => 'Articles',
                        'book'          => 'Books',
                        'booklet'       => 'Booklets',
                        'conference'    => 'Conference Papers',
                        'inbook'        => 'In Books',
                        'incollection'  => 'In Collections',
                        'inproceedings' => 'In Proceedings',
                        'manual'        => 'Manuals',
                        'mastersthesis' => 'Master\'s Theses',
                        'misc'          => 'Miscellaneous',
                        'phdthesis'     => 'Dissertations',
                        'proceedings'   => 'Proceedings',
                        'techreport'    => 'Technical Reports',
                        'unpublished'   => 'Unpublished',

                        // Map non-standard types to this type
                        'unknown'       => 'misc')
);
?>
