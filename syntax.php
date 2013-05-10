<?php
/**
 * DokuWiki Plugin publist (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Raphael Reitzig <code@verrech.net>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_publist extends DokuWiki_Syntax_Plugin {
    function getType() {
        return 'substition';
    }

    function getPType() {
        return 'block';
    }

    function getSort() {
        return 105;
    }

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\[publist\|.+?\]',$mode,'plugin_publist');
    }

    function handle($match, $state, $pos, &$handler){
        $data = array();

        // Partition properly 
        $matches = array();
        $pattern = '/\[publist(?:\|(page|file|url):(.+?))(?:\|(wiki|html):(page|file|url):(.+?))(?:\|(.+?(?:\|.+?)*))?\]/';
        if ( 0 === preg_match($pattern, $match, $matches) ) {
            $data['error'] = 'Not valid publist syntax: '.$match;
        }
        else {
            $data['bibtex'] = array('type' => $matches[1], 'ref' => $matches[2]);
            $data['template'] = array('target' => $matches[3], 'type' => $matches[4], 'ref' => $matches[5]);
            $data['options'] = array();

      
            // Set default language. Get current lang from translation plugin
            // if installed & enabled or fall back to default lang in conf.
            if (!plugin_isdisabled('translation')) {
                $trans =& plugin_load('helper', 'translation');
                global $ID;
                $mylang = $trans->getLangPart($ID);
            } else {
                global $conf;
                $mylang = $conf['lang'];
            }
            $data['options']['lang'] = $mylang;
            
            if ( !empty($matches[6]) ) {
               $matches = explode('|', $matches[6]);
               foreach ( $matches as $opt ) {
                 $optparts = array();
                 if ( preg_match('/(.+?):(.+)/', $opt, $optparts) ) {
                    $optparts[2] = explode(';', $optparts[2]);
                    $option = array();
                    foreach ( $optparts[2] as $single ) {
                        $single = explode('=', $single);
                        if (count($single) == 1 && count($optparts[2]) == 1) {
                            $option = $single[0];
                        }
                        else {
                            $option[$single[0]] = str_replace(',', '|', $single[1]);
                        }
                    }
                    $data['options'][$optparts[1]] = $option;
                 }
               }
            }

            if ($data['options']['authors'])
            {
              $tmp = explode(':', $data['options']['authors']);
              $data['authors'] = array('type' => $tmp[0], 'ref' => $tmp[1]);
            }
        }
        return $data;
    }

    function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;
 
        if ( empty($data['error']) ) {
            // Retrieve BibTeX source
            $bibtex = $this->_load($data, 'bibtex');
            if ( empty($bibtex) ) {
                $data['error'] .= $data['bibtex']['type'].' '.$data['bibtex']['ref'].' does not exist<br />';
            }
            
            // Retrieve Template source
            $template = $this->_load($data, 'template');
            if ( empty($template) ) {
                $data['error'] .= $data['template']['type'].' '.$data['template']['ref'].' does not exist<br />';
            }

			$authors = null;
            if ($data['authors']) {
	            // Retrieve Authors source
	            $authors = $this->_load($data, 'authors');
	            if ( empty($authors) ) {
	                $data['error'] .= $data['authors']['type'].' '.$data['authors']['ref'].' does not exist<br />';
	            }
            }


            if ( !empty($bibtex) && !empty($template) ) {
                require_once(dirname(__FILE__).'/bib2tpl/bibtex_converter.php');
                if ( is_readable(dirname(__FILE__).'/sanitiser.php')) {
                    include(dirname(__FILE__).'/sanitiser.php');
                }
                if ( empty($sanitiser) ) {
                   $sanitiser = create_function('$i', 'return $i;');
                }
                $parser = new BibtexConverter($data['options'],$sanitiser,$authors);
                $code = $parser->convert($bibtex, $template);
                
                if ( $data['template']['target'] == 'wiki' ) {
                    $code = p_render($mode, p_get_instructions($code), $info);
                }

                $renderer->doc .= $code;
            }
        }
        
        if ( !empty($data['error']) ) {
            $renderer->doc .= $data['error'];
        }

        $renderer->info['cache'] = false;

        return true;
    }

    function _load($data, $kind) {
        global $INFO;

        if ( $data[$kind]['type'] == 'url' ) {
            return file_get_contents($data[$kind]['ref']);
        }
        if ( $data[$kind]['type'] == 'file' ) {
            return file_get_contents(dirname(__FILE__).'/'.$kind.'/'.$data[$kind]['ref']);
        }
        else if ( $data[$kind]['type'] == 'page' ) {
            $exists = false;
            $id = $data[$kind]['ref'];
            resolve_pageid($INFO['namespace'], &$id, &$exists);
            if ( $exists ) {
                return rawWiki($id);
            }
        }

        return null;
    }
}

// vim:ts=4:sw=4:et:enc=utf-8:
