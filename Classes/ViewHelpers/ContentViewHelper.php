<?php
namespace OliverThiele\OtWebsite\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Soeren Kroell <soeren@99grad.de>, 99grad
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ContentElementViewHelper
 */
class ContentElementViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Renders a content element
	 *
	 * @param mixed $uid
	 * @param array $data
	 *
	 * @return string
	 */
	public function render($uid, $data=NULL) {

		if(is_string($uid)){
			$explode = explode('tt_content_', $uid);
			$uid = intval($explode[1]);
		}

		$cObj = GeneralUtility::makeInstance('tslib_cObj');

		$conf = array(
			'tables' => 'tt_content',
			'source' => $uid,
			'dontCheckPid' => 1
		);

		$html = $cObj->RECORDS($conf);

		if ($data !== NULL) {
			$html = $this->renderTemplateSource($html, $data);
		}

		return $html ? $html : "Keine Content-Element mit uid {$uid} gefunden. Evtl. muss uid im View angepasst werden!";
	}

	/**
	 * Renders a given code-snippet as fluid-template. Variables can be passed
	 *
	 * @param string $templateSrc
	 * @param array $vars
	 *
	 * @return string
	 */

	public function renderTemplateSource ($templateSrc=NULL, $vars) {

		if ($templateSrc === NULL) return '';

		$view = $this->objectManager->get('\TYPO3\CMS\Fluid\View\StandaloneView');
		$view->setTemplateSource($templateSrc);
		$view->assignMultiple($vars);
		return $view->render();
	}


}