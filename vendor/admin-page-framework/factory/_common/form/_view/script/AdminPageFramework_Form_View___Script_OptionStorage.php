<?php 
/**
	Admin Page Framework v3.8.28 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/og-gdpr>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class OG_GDPR_AdminPageFramework_Form_View___Script_OptionStorage extends OG_GDPR_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {
            
    $.fn.aOG_GDPR_AdminPageFrameworkInputOptions = {}; 
                            
    $.fn.storeOG_GDPR_AdminPageFrameworkInputOptions = function( sID, vOptions ) {
        var sID = sID.replace( /__\d+_/, '___' );	// remove the section index. The g modifier is not used so it will replace only the first occurrence.
        $.fn.aOG_GDPR_AdminPageFrameworkInputOptions[ sID ] = vOptions;
    };	
    $.fn.getOG_GDPR_AdminPageFrameworkInputOptions = function( sID ) {
        var sID = sID.replace( /__\d+_/, '___' ); // remove the section index
        return ( 'undefined' === typeof $.fn.aOG_GDPR_AdminPageFrameworkInputOptions[ sID ] )
            ? null
            : $.fn.aOG_GDPR_AdminPageFrameworkInputOptions[ sID ];
    }

}( jQuery ));
JAVASCRIPTS;
        
    }
    }
    