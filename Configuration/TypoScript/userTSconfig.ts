/**
 * User TSconfig
 *
 * @see http://docs.typo3.org/typo3cms/TSconfigReference/UserTsconfig/
 */
options {
	# default: 0
	pageTree.showNavTitle = 1

	# default: 1,6,4,7,3,254,255,199
	pageTree.doktypesToShowInNewPageDragArea = 1,4,3,254,199
}




ajaxCall = PAGE
ajaxCall {
    typeNum = 200
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        pluginName = OtWebsite
        extensionName = OtWebsite
        vendorName = OliverThiele
    }
    config {
        disableAllHeaderCode = 1
        additionalHeaders = Content-type:application/json
        xhtml_cleaning = 0
        admPanel = 0
        no_cache = 1
    }
}