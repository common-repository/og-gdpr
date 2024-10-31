<?php 
/**
	Admin Page Framework v3.8.28 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/og-gdpr>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class OG_GDPR_AdminPageFramework_Form_View___CSS_Field extends OG_GDPR_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->___getFormFieldRules();
    }
    static private function ___getFormFieldRules() {
        return "td.og-gdpr-field-td-no-title {padding-left: 0;padding-right: 0;}.og-gdpr-fields {display: table; width: 100%;table-layout: fixed;}.og-gdpr-field input[type='number'] {text-align: right;} .og-gdpr-fields .disabled,.og-gdpr-fields .disabled input,.og-gdpr-fields .disabled textarea,.og-gdpr-fields .disabled select,.og-gdpr-fields .disabled option {color: #BBB;}.og-gdpr-fields hr {border: 0; height: 0;border-top: 1px solid #dfdfdf; }.og-gdpr-fields .delimiter {display: inline;}.og-gdpr-fields-description {margin-bottom: 0;}.og-gdpr-field {float: left;clear: both;display: inline-block;margin: 1px 0;}.og-gdpr-field label {display: inline-block; width: 100%;}@media screen and (max-width: 782px) {.form-table fieldset > label {display: inline-block;}}.og-gdpr-field .og-gdpr-input-label-container {margin-bottom: 0.25em;}@media only screen and ( max-width: 780px ) { .og-gdpr-field .og-gdpr-input-label-container {margin-top: 0.5em; margin-bottom: 0.5em;}} .og-gdpr-field .og-gdpr-input-label-string {padding-right: 1em; vertical-align: middle; display: inline-block; }.og-gdpr-field .og-gdpr-input-button-container {padding-right: 1em; }.og-gdpr-field .og-gdpr-input-container {display: inline-block;vertical-align: middle;}.og-gdpr-field-image .og-gdpr-input-label-container { vertical-align: middle;}.og-gdpr-field .og-gdpr-input-label-container {display: inline-block; vertical-align: middle; } .repeatable .og-gdpr-field {clear: both;display: block;}.og-gdpr-repeatable-field-buttons {float: right; margin: 0.1em 0 0.5em 0.3em;vertical-align: middle;}.og-gdpr-repeatable-field-buttons .repeatable-field-button {margin: 0 0.1em;font-weight: normal;vertical-align: middle;text-align: center;}@media only screen and (max-width: 960px) {.og-gdpr-repeatable-field-buttons {margin-top: 0;}}.og-gdpr-sections.sortable-section > .og-gdpr-section,.sortable > .og-gdpr-field {clear: both;float: left;display: inline-block;padding: 1em 1.32em 1em;margin: 1px 0 0 0;border-top-width: 1px;border-bottom-width: 1px;border-bottom-style: solid;-webkit-user-select: none;-moz-user-select: none;user-select: none; text-shadow: #fff 0 1px 0;-webkit-box-shadow: 0 1px 0 #fff;box-shadow: 0 1px 0 #fff;-webkit-box-shadow: inset 0 1px 0 #fff;box-shadow: inset 0 1px 0 #fff;-webkit-border-radius: 3px;border-radius: 3px;background: #f1f1f1;background-image: -webkit-gradient(linear, left bottom, left top, from(#ececec), to(#f9f9f9));background-image: -webkit-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -moz-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -o-linear-gradient(bottom, #ececec, #f9f9f9);background-image: linear-gradient(to top, #ececec, #f9f9f9);border: 1px solid #CCC;background: #F6F6F6;} .og-gdpr-fields.sortable {margin-bottom: 1.2em; } .og-gdpr-field .button.button-small {width: auto;} .font-lighter {font-weight: lighter;} .og-gdpr-field .button.button-small.dashicons {font-size: 1.2em;padding-left: 0.2em;padding-right: 0.22em;min-width: 1em; }@media screen and (max-width: 782px) {.og-gdpr-field .button.button-small.dashicons {min-width: 1.8em; }}.og-gdpr-field .button.button-small.dashicons:before {position: relative;top: 7.2%;}@media screen and (max-width: 782px) {.og-gdpr-field .button.button-small.dashicons:before {top: 8.2%;}}.og-gdpr-field-title {font-weight: 600;min-width: 80px;margin-right: 1em;}.og-gdpr-fieldset {font-weight: normal;}.og-gdpr-input-label-container,.og-gdpr-input-label-string{min-width: 140px;}";
    }
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= ".og-gdpr-field .remove_value.button.button-small {line-height: 1.5em; }";
        }
        $_sCSSRules.= $this->___getForWP38OrAbove();
        $_sCSSRules.= $this->___getForWP53OrAbove();
        return $_sCSSRules;
    }
    private function ___getForWP38OrAbove() {
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            return '';
        }
        return ".og-gdpr-repeatable-field-buttons {margin: 2px 0 0 0.3em;}.og-gdpr-repeatable-field-buttons.disabled > .repeatable-field-button {color: #edd;border-color: #edd;} @media screen and ( max-width: 782px ) {.og-gdpr-fieldset {overflow-x: hidden;overflow-y: hidden;}}";
    }
    private function ___getForWP53OrAbove() {
        if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
            return '';
        }
        return ".og-gdpr-field .button.button-small.dashicons:before {position: relative;top: -5.4px;}@media screen and (max-width: 782px) {.og-gdpr-field .button.button-small.dashicons:before {top: -6.2%;}.og-gdpr-field .button.button-small.dashicons {min-width: 2.4em;}}.og-gdpr-repeatable-field-buttons .repeatable-field-button.button.button-small {min-width: 2.4em;padding: 0;}.repeatable-field-button .dashicons {position: relative;top: 4.4px;font-size: 16px;}@media screen and (max-width: 782px) {.og-gdpr-repeatable-field-buttons {margin: 0.5em 0 0 0.28em;}.repeatable-field-button .dashicons {position: relative;top: 10px;font-size: 18px;}.og-gdpr-repeatable-field-buttons .repeatable-field-button.button.button-small {margin-top: 0;margin-bottom: 0;min-width: 2.6em;min-height: 2.4em;}.og-gdpr-fields.sortable .og-gdpr-repeatable-field-buttons {margin: 0;}}";
    }
    }
    