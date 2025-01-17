<?php 
/**
	Admin Page Framework v3.8.28 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/og-gdpr>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class OG_GDPR_AdminPageFramework_Model__FormRedirectHandler extends OG_GDPR_AdminPageFramework_FrameworkUtility {
    public $oFactory;
    public function __construct($oFactory) {
        $this->oFactory = $oFactory;
        $this->_replyToCheckRedirects();
    }
    public function _replyToCheckRedirects() {
        if (!$this->_shouldProceed()) {
            return;
        }
        $_sPageSlug = sanitize_text_field($_GET['page']);
        $_sTransient = 'apf_rurl' . md5(trim("redirect_{$this->oFactory->oProp->sClassName}_{$_sPageSlug}"));
        $_aError = $this->oFactory->getFieldErrors();
        if (!empty($_aError)) {
            $this->deleteTransient($_sTransient);
            return;
        }
        $_sURL = $this->getTransient($_sTransient);
        if (false === $_sURL) {
            return;
        }
        $this->deleteTransient($_sTransient);
        $this->goToURL($_sURL);
    }
    private function _shouldProceed() {
        if (!$this->oFactory->isInThePage()) {
            return false;
        }
        if (!$this->getElement($_GET, 'settings-updated', false)) {
            return false;
        }
        return 'redirect' === $this->getElement($_GET, 'confirmation', '');
    }
    }
    