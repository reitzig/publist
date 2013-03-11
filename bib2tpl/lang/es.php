<?php
$translations = array(
  // groupkey if no grouping is done
  'all' => 'Todos',
  // groupkey for entries that do not specify the grouping value
  'rest' => 'Resto',
  // Month names entries are compared against for sorting issues
  // - Names are case insensitive
  // - Regular expression are supported to include alternatives like
  //   'january|jan'
  // - In translations, keep English names and short forms in case bibtex
  //   source is in English. E.g. 'enero|ene|january|jan'
  'months' => array('01' => 'enero|ene|january|jan',
                    '02' => 'febrero|february|feb',
                    '03' => 'marzo|march|mar',
                    '04' => 'abril|abr|april|apr',
                    '05' => 'mayo|may',
                    '06' => 'junio|june|jun',
                    '07' => 'julio|july|jul',
                    '08' => 'agosto|ago|august|aug',
                    '09' => 'septiembre|september|sep',
                    '10' => 'octubre|october|oct',
                    '11' => 'noviembre|november|nov',
                    '12' => 'diciembre|dic|december|dec'),

  // Representations of entry types used as headlines
  'entrytypes' => array('article'       => 'Artículos',
                        'book'          => 'Libros',
                        'booklet'       => 'Folletos',
                        'conference'    => 'Conferencias',
                        'inbook'        => 'Capítulos de libros',
                        'incollection'  => 'Colecciones',
                        'inproceedings' => 'Contribuciones a congresos',
                        'manual'        => 'Manuales',
                        'mastersthesis' => 'Tesis de maestría',
                        'misc'          => 'Miscelánea',
                        'phdthesis'     => 'Tesis doctorales',
                        'proceedings'   => 'Libros de actas',
                        'techreport'    => 'Informes Técnicos',
                        'unpublished'   => 'No publicados',

                        // Map non-standard types to this type
                        'unknown'       => 'misc')
);
?>
