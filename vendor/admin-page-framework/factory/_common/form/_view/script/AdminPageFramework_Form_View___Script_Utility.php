<?php 
/**
	Admin Page Framework v3.8.28 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/og-gdpr>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class OG_GDPR_AdminPageFramework_Form_View___Script_Utility extends OG_GDPR_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
( function( $ ) {
    $.fn.reverse = [].reverse;

    $.fn.formatPrintText = function() {
        var aArgs = arguments;     
        return aArgs[ 0 ].replace( /{(\d+)}/g, function( match, number ) {
            return typeof aArgs[ parseInt( number ) + 1 ] != 'undefined'
                ? aArgs[ parseInt( number ) + 1 ]
                : match;
        });
    };
}( jQuery ));
JAVASCRIPTS;
        
    }
    }
    