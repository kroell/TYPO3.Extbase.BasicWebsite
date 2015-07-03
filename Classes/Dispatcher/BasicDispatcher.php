<?php

/** *************************************************************
 *
 * Extbase Dispatcher for Ajax Calls TYPO3 6.1 namespaces
 *
 * IMPORTANT Use this script only in Extensions with namespaces
 *
 * Klaus Heuer <klaus.heuer@t3-developer.com>
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */


/**
 * Gets the Ajax Call Parameters
 */
$ajax = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('request');


//var_dump($_SERVER);

/**
 * Set Vendor and Extension Name
 *
 * Vendor Name like your Vendor Name in namespaces
 * ExtensionName in upperCamelCase
 */
$ajax['vendor'] = 'TYPO3'; // TODO Update
$ajax['extensionName'] = 'EsweApi'; // TODO Update

/**
 * @var $TSFE \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
 */
$TSFE = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController', $TYPO3_CONF_VARS, 0, 0);
\TYPO3\CMS\Frontend\Utility\EidUtility::initLanguage();

// Get FE User Information
$TSFE->initFEuser();
// Important: no Cache for Ajax stuff
$TSFE->set_no_cache();

//$TSFE->checkAlternativCoreMethods();
$TSFE->checkAlternativeIdMethods();
$TSFE->determineId();
$TSFE->initTemplate();
$TSFE->getConfigArray();

//\TYPO3\CMS\Core\Core\Bootstrap::getInstance();

/**
 * Ohne wird das TCA nicht geladen und es kann nicht auf die Datensätze zugegriffen werden
 */
\TYPO3\CMS\Core\Core\Bootstrap::getInstance()->loadExtensionTables();



$TSFE->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
$TSFE->settingLanguage();
$TSFE->settingLocale();

/**
 * Initialize Database
 */
\TYPO3\CMS\Frontend\Utility\EidUtility::connectDB();

/**
 * @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager
 */
$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');


/**
 * Initialize Extbase bootstap
 */
$bootstrapConf['extensionName'] = $ajax['extensionName'];
$bootstrapConf['pluginName'] = $ajax['pluginName'];

$bootstrap = new TYPO3\CMS\Extbase\Core\Bootstrap();
$bootstrap->initialize($bootstrapConf);

$bootstrap->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_cObj');




/**
 * Build the request
 */
$request = $objectManager->get('TYPO3\CMS\Extbase\Mvc\Request');

$request->setControllerVendorName($ajax['vendor']);
$request->setcontrollerExtensionName($ajax['extensionName']);
$request->setPluginName($ajax['pluginName']);
$request->setControllerName($ajax['controller']);
$request->setControllerActionName($ajax['action']);

if(isset($_FILES)){
    $ajax['arguments']['file'] = $_FILES;
}
//var_dump( $_FILES );

if(isset($ajax['arguments'])){
    $request->setArguments($ajax['arguments']);
}

# hinzugefuegt
if(isset($ajax['format'])){
    $request->setFormat($ajax['format']);
} else {
    $request->setFormat($_SERVER['CONTENT_TYPE']);
}


/**
 * SOAP Anpassungen
 */
if(isset($_SERVER['HTTP_SOAPACTION'])) {
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $request->setArguments(array('soap_request_data'=>$HTTP_RAW_POST_DATA));
}



/**
 * Erlaubt CORS-Anfragen
 */
if(isset($_SERVER['REQUEST_METHOD'])) {
    switch($_SERVER['REQUEST_METHOD']){
        case 'OPTIONS':
            header("Access-Control-Allow-Origin: http://localhost:8100");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
            http_response_code(200);

            break;
        default:
            header("Access-Control-Allow-Origin: http://localhost:8100");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
            break;
    }
}

$response = $objectManager->create('TYPO3\CMS\Extbase\Mvc\ResponseInterface');


/**
 * Dispatches a request to a controller and initializes the security framework.
 */
$dispatcher = $objectManager->get('TYPO3\CMS\Extbase\Mvc\Dispatcher');
$dispatcher->dispatch($request, $response);


/**
 * Response an an das Request-Format anpassen
 */

//$responseWeb->setHeader('Content-Type', 'application/json');

//if($ajax['format'] == 'json'){
//    echo json_encode($response->getContent());
//} else {
//
//}

#var_dump($request->getFormat());
#echo $_SERVER["CONTENT_TYPE"];
echo $response->getContent();
//var_dump( $_FILES );

//die();


?>