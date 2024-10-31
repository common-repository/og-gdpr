<?php 
/**
	Admin Page Framework v3.8.28 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/og-gdpr>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class OG_GDPR_AdminPageFramework_View__PageRenderer__InPageTabs extends OG_GDPR_AdminPageFramework_FrameworkUtility {
    public $oFactory;
    public $sPageSlug;
    public $sTag = 'h3';
    public function __construct($oFactory, $sPageSlug) {
        $this->oFactory = $oFactory;
        $this->sPageSlug = $sPageSlug;
        $this->sTag = $oFactory->oProp->sInPageTabTag ? $oFactory->oProp->sInPageTabTag : 'h3';
    }
    public function get() {
        $_aInPageTabs = $this->getElement($this->oFactory->oProp->aInPageTabs, $this->sPageSlug, array());
        if (empty($_aInPageTabs)) {
            return '';
        }
        return $this->_getOutput($_aInPageTabs, $this->sPageSlug, $this->sTag);
    }
    private function _getOutput($aInPageTabs, $sCurrentPageSlug, $sTag) {
        $_aPage = $this->oFactory->oProp->aPages[$sCurrentPageSlug];
        $_sCurrentTabSlug = $this->_getCurrentTabSlug($sCurrentPageSlug);
        $_sTag = $this->_getInPageTabTag($sTag, $_aPage);
        if (!$_aPage['show_in_page_tabs']) {
            return $this->getElement($aInPageTabs, array($_sCurrentTabSlug, 'title')) ? "<{$_sTag} class='og-gdpr-in-page-tab-title'>" . $aInPageTabs[$_sCurrentTabSlug]['title'] . "</{$_sTag}>" : "";
        }
        return $this->_getInPageTabNavigationBar($aInPageTabs, $_sCurrentTabSlug, $sCurrentPageSlug, $_sTag);
    }
    private function _getInPageTabNavigationBar(array $aTabs, $sActiveTab, $sCurrentPageSlug, $sTag) {
        $_oTabBar = new OG_GDPR_AdminPageFramework_TabNavigationBar($aTabs, $sActiveTab, $sTag, array('class' => 'in-page-tab',), array('format' => array($this, '_replyToFormatNavigationTabItem_InPageTab'), 'arguments' => array('page_slug' => $sCurrentPageSlug,),));
        $_sTabBar = $_oTabBar->get();
        return $_sTabBar ? "<div class='og-gdpr-in-page-tab'>" . $_sTabBar . "</div>" : '';
    }
    public function _replyToFormatNavigationTabItem_InPageTab(array $aTab, array $aStructure, array $aTabs, array $aArguments = array()) {
        $_oFormatter = new OG_GDPR_AdminPageFramework_Format_NavigationTab_InPageTab($aTab, $aStructure, $aTabs, $aArguments, $this->oFactory);
        return $_oFormatter->get();
    }
    private function _getInPageTabTag($sTag, array $aPage) {
        return tag_escape($aPage['in_page_tab_tag'] ? $aPage['in_page_tab_tag'] : $sTag);
    }
    private function _getCurrentTabSlug($sCurrentPageSlug) {
        $_sCurrentTabSlug = $this->getElement($_GET, 'tab', $this->oFactory->oProp->getDefaultInPageTab($sCurrentPageSlug));
        $_sTabSlug = $this->_getParentTabSlug($sCurrentPageSlug, $_sCurrentTabSlug);
        return $_sTabSlug;
    }
    private function _getParentTabSlug($sPageSlug, $sTabSlug) {
        $_sParentTabSlug = $this->getElement($this->oFactory->oProp->aInPageTabs, array($sPageSlug, $sTabSlug, 'parent_tab_slug'), $sTabSlug);
        return isset($this->oFactory->oProp->aInPageTabs[$sPageSlug][$_sParentTabSlug]['show_in_page_tab']) && $this->oFactory->oProp->aInPageTabs[$sPageSlug][$_sParentTabSlug]['show_in_page_tab'] ? $_sParentTabSlug : $sTabSlug;
    }
    }
    