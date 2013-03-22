<?php
/**
 * DokuWiki Plugin publist (Sanitiser Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Jorge Juan <jjchico@gmail.com>
 */

// Simple latex to utf8 sanitiser. Extend as needed.

// Rename (or copy) this file to "sanitiser.php" and it will be automatically
// used by publist.

$sanitiser = function ($inputstr) {
    $search_array = array(
        '\$', '\&', '\%', '\#', '\_', '\{', '\}',   // specials
        '{', '}',                                   // emphasizers
        "\'a", "\'e", "\'i", "\'o", "\'u",		// acute
        "\'A", "\'E", "\'I", "\'O", "\'U",
        '\`a', '\`e', '\`i', '\`o', '\`u',		// grave
        '\`A', '\`E', '\`I', '\`O', '\`U',
        '\^a', '\^e', '\^i', '\^o', '\^u',		// circumflex
        '\^A', '\^E', '\^I', '\^O', '\^U',
        '\"a', '\"e', '\"i', '\"o', '\"u',		// umlaut
        '\"A', '\"E', '\"I', '\"O', '\"U',
        '\~n',						// tilde
        '\~N',
        '\cc', '\cC',
        '~', '\,', '\\'				        // space
    );					
    $replace_array = array(
        '$', '&', '%', '#', '_', '<html>&#123;</html>', '<html>&#125;</html>',
        '','',
        'á', 'é', 'í', 'ó', 'ú',
        'Á', 'É', 'Í', 'Ó', 'Ú',
        'à', 'è', 'ì', 'ò', 'ù',
        'À', 'È', 'Ì', 'Ò', 'Ù',
        'â', 'ê', 'î', 'ô', 'û',
        'Â', 'Ê', 'Î', 'Ô', 'Û',
        'ä', 'ë', 'ï', 'ö', 'ü',
        'Ä', 'Ë', 'Ï', 'Ö', 'Ü',
        'ñ',
        'Ñ',
        'ç', 'Ç',
        "\xC2\xA0", ' ', ' '
    );
    $outputstr = str_replace($search_array, $replace_array, $inputstr);
    return $outputstr;
}

// vim:ts=4:sw=4:et:enc=utf-8:
?>
