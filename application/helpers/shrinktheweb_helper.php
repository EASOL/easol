<?php
    /**
     * Prerequisites: PHP4 (tested 4.4.1+), PHP5
	 * Maintainers: Andreas Pachler, Brandon Elliott
	 *
	 *	For the latest documentation and best practices: please visit http://www.shrinktheweb.com/content/shrinktheweb-pagepix-documentation.html
     */
    define('ACCESS_KEY', 'baa3cc5dac47164');
    define('SECRET_KEY', '2d5de');
    define('THUMBNAIL_URI', base_url('stw_thumbs').'/'); // set permissions to 0755
    define('THUMBNAIL_DIR', 'stw_thumbs/'); // set permissions to 0755
    define('INSIDE_PAGES', true); // set to true if inside capturing should be allowed
    define('CUSTOM_MSG_URL', ''); // i.e. 'http://yourdomain.com/path/to/your/custom/msgs'
    define('CACHE_DAYS', 0); // how many days should the local copy be valid?
                             // Enter 0 (zero) to never update screenshots once cached
                             // Enter -1 to disable caching and always use embedded method instead
    define('VER', '2.0.5'); // allows us to identify known bugs and version control; DONT touch!
    define('QUOTA_IMAGE', 'quota.jpg');
    define('BANDWIDTH_IMAGE', 'bandwidth.jpg');
    define('NO_RESPONSE_IMAGE', 'no_response.jpg');
    define('MAINTENANCE', 'ShrinkTheWeb is temporarily offline for maintenance');

    // DB constants, must be setup when using debug
	// For Advanced Users: create a database, add a user w/ permission to it, and then run the SQL in stw_debug_db.sql to setup it up
    define('DEBUG', false); // MUST be "true" to log debug entries to database
	define('DATABASE_HOST', 'localhost'); // localhost is common
	define('DATABASE_PORT', '3306'); // 3306 is the default
	define('DATABASE_SOCK', ''); // typically left blank
	define('DATABASE_NAME', '');
	define('DATABASE_USER', '');
	define('DATABASE_PASS', '');
	if(DEBUG){include_once("/stw_db_funcs.php");} // only load db functions if debug=true

    // EXAMPLE CALL OF THUMBNAIL REQUEST
    error_reporting(E_ALL ^ E_NOTICE);

    function show ($sUrl = '')
    {	
        $aOptions = array(
            'Size' => 'xlg',
    #        'SizeCustom' => '240',
    #        'FullSizeCapture' => true,
    #        'MaxHeight' => '465',
    #        'NativeResolution' => '1440',
    #        'WidescreenY' => '900',
    #        'RefreshOnDemand' => true, // this should be used only once to update the captured image
    #        'Delay' => '5',
    #        'Quality' => '50',
        );
        // use options above
        // $sImageHTML = getThumbnailHTML($sUrl, $aOptions);
        // do not use options
        $sImageHTML = getThumbnailHTML($sUrl);
        echo $sImageHTML;
	}

	/******************************************** 
	*	!! DO NOT CHANGE BELOW THIS LINE !!		*
	*	...unless you know what you are doing	*
	********************************************/	

    /**
     * Gets the thumbnail for the specified website, stores it in the cache, and then returns the HTML for loading the image.
     */
    function getThumbnailHTML($sUrl, $aOptions = array(), $sAttribAlt = false, $sAttribClass = false, $sAttribStyle = false, $isLink = false) {
  	    // $sUrl = 'http://www.shrinktheweb.com';
        $sImageTag = false;
        $aOptions = _generateOptions($aOptions);

        $sImageTag = _getThumbnailAdvanced($sUrl, $aOptions, $sAttribAlt, $sAttribClass, $sAttribStyle, $isLink);

        return $sImageTag;
    }

    /**
     * Delete thumbnail
     */
    function deleteThumbnail($sUrl, $aOptions = array()) {
        $aOptions = _generateOptions($aOptions);
        $aArgs = _generateRequestArgs($aOptions);
        $aArgs['stwurl'] = $sUrl;

        $sFilename = _generateHash($aArgs).'.jpg';
	    $sFile = THUMBNAIL_DIR . $sFilename;

       	if (file_exists($sFile)) {
    		@unlink($sFile);
    	}
    }

    /**
     * refresh a thumbnail for a url with specified options
     * first delete it and then do a new request and return the HTML for image loading
     */
    function refreshThumbnail($sUrl, $aOptions = array(), $sAttribAlt = false, $sAttribClass = false, $sAttribStyle = false, $isLink = false) {
        $aOptions = _generateOptions($aOptions);
        $aOptions['RefreshOnDemand'] = true;

        deleteThumbnail($sUrl, $aOptions);
        $sImageTag = getThumbnailHTML($sUrl, $aOptions, $sAttribAlt, $sAttribClass, $sAttribStyle, $isLink);

        return $sImageTag;
    }

    /**********************
    *  PRIVATE FUNCTIONS  *
    **********************/

    // getting the thumbnal with advanced api
    function _getThumbnailAdvanced($sUrl, $aOptions, $sAttribAlt, $sAttribClass, $sAttribStyle, $isLink) {
        $sImageUrl = _getThumbnail($sUrl, $aOptions);

        // if WAY OVER the limits (i.e. request is ignored by STW), grab an "Account Problem" image and store it as NO_RESPONSE_IMAGE
        if ($sImageUrl == 'no_response') {
            $sImageUrl = _getNoResponseImage($sUrl, $aOptions);
        }

        // add attributes if set
        $sTags = false;
        if ($sAttribStyle) {
            $sTags .= ' style="' . $sAttribStyle . '"';
        }
        if ($sAttribAlt) {
            $sTags .= ' alt="' . $sAttribAlt . '"';
        }
        if ($sAttribClass) {
            $sTags .= ' class="' . $sAttribClass . '"';
        }

        // add link?
        if ($isLink) {
            $sImageHTML = $sImageUrl ? '<a href="' . $sUrl . '" target="_blank"><img src="' . $sImageUrl . '"'.$sTags.'/></a>' : false;
        } else {
            $sImageHTML = $sImageUrl ? '<img src="' . $sImageUrl . '"'.$sTags.'/>' : false;
        }

        return $sImageHTML;
    }

    /**
     * Gets the thumbnail for the specified website, stores it in the cache, and then returns the
     * relative path to the cached image.
     */
    function _getThumbnail($sUrl, $aOptions) {
        // create cache directory if it doesn't exist
        _createCacheDirectory();

        $aArgs = _generateRequestArgs($aOptions);

        // Try to grab the thumbnail
        $iCacheDays = CACHE_DAYS + 0;
        if ($iCacheDays >= 0 && $aOptions['Embedded'] != 1) {
            $aArgs['stwurl'] = $sUrl;
            $sImageUrl = _getCachedThumbnail($aArgs);
        } else {
            // Get raw image data
            unset($aArgs['stwu']); // ONLY on "Advanced" method requests!! (not allowed on embedded)
            $aArgs['stwembed'] = 1;
            $aArgs['stwurl'] = $sUrl;
            $sImageUrl = urldecode("http://images.shrinktheweb.com/xino.php?".http_build_query($aArgs,'','&'));
        }

        return $sImageUrl;
    }

    /**
     * generate options
     */
    function _generateOptions($aOptions) {
        // check if there are options set, otherwise set it to default or false
        $aOptions['Size'] = isset($aOptions['Size']) ? $aOptions['Size'] : 'sm';
        $aOptions['SizeCustom'] = isset($aOptions['SizeCustom']) ? $aOptions['SizeCustom'] : false;
        $aOptions['FullSizeCapture'] = isset($aOptions['FullSizeCapture']) ? $aOptions['FullSizeCapture'] : false;
        $aOptions['MaxHeight'] = isset($aOptions['MaxHeight']) ? $aOptions['MaxHeight'] : false;
        $aOptions['NativeResolution'] = isset($aOptions['NativeResolution']) ? $aOptions['NativeResolution'] : false;
        $aOptions['WidescreenY'] = isset($aOptions['WidescreenY']) ? $aOptions['WidescreenY'] : false;
        $aOptions['RefreshOnDemand'] = isset($aOptions['RefreshOnDemand']) ? $aOptions['RefreshOnDemand'] : false;
        $aOptions['Delay'] = isset($aOptions['Delay']) ? $aOptions['Delay'] : false;
        $aOptions['Quality'] = isset($aOptions['Quality']) ? $aOptions['Quality'] : false;

        return $aOptions;
    }

    /**
     * generate the request arguments
     */
    function _generateRequestArgs($aOptions) {
        $aArgs['stwaccesskeyid'] = ACCESS_KEY;
        $aArgs['stwu'] = SECRET_KEY;
        $aArgs['stwver'] = VER;

        // allowing internal links?
        if (INSIDE_PAGES) {
            $aArgs['stwinside'] = 1;
        }

        // If SizeCustom is specified and widescreen capturing is not activated,
        // then use that size rather than the size stored in the settings
        if (!$aOptions['FullSizeCapture'] && !$aOptions['WidescreenY']) {
            // Do we have a custom size?
            if ($aOptions['SizeCustom']) {
                $aArgs['stwxmax'] = $aOptions['SizeCustom'];
            } else {
                $aArgs['stwsize'] = $aOptions['Size'];
            }
        }

        // Use fullsize capturing?
        if ($aOptions['FullSizeCapture']) {
            $aArgs['stwfull'] = 1;
            if ($aOptions['SizeCustom']) {
                $aArgs['stwxmax'] = $aOptions['SizeCustom'];
            } else {
                $aArgs['stwxmax'] = 120;
            }
            if ($aOptions['MaxHeight']) {
                $aArgs['stwymax'] = $aOptions['MaxHeight'];
            }
        }

        // Change native resolution?
        if ($aOptions['NativeResolution']) {
            $aArgs['stwnrx'] = $aOptions['NativeResolution'];
            if ($aOptions['WidescreenY']) {
                $aArgs['stwnry'] = $aOptions['WidescreenY'];
                if ($aOptions['SizeCustom']) {
                    $aArgs['stwxmax'] = $aOptions['SizeCustom'];
                } else {
                    $aArgs['stwxmax'] = 120;
                }
            }
        }

        // Wait after page load in seconds
        if ($aOptions['Delay']) {
            $aArgs['stwdelay'] = intval($aOptions['Delay']) <= 45 ? intval($aOptions['Delay']) : 45;
        }

        // Use Refresh On-Demand?
        if ($aOptions['RefreshOnDemand']) {
            $aArgs['stwredo'] = 1;
        }

        // Use another image quality in percent
        if ($aOptions['Quality']) {
            $aArgs['stwq'] = intval($aOptions['Quality']);
        }

        // Use custom messages?
        if (CUSTOM_MSG_URL) {
            $aArgs['stwrpath'] = CUSTOM_MSG_URL;
        }

        return $aArgs;
    }
    
    /**
     * Get a thumbnail, caching it first if possible
     */
    function _getCachedThumbnail($aArgs = null) {
        $aArgs = is_array($aArgs) ? $aArgs : array();

        // Use arguments to work out the target filename
        $sFilename = _generateHash($aArgs).'.jpg';
        $sFile = THUMBNAIL_DIR . $sFilename;

        $sReturnName = false;
        // Work out if we need to update the cached thumbnail
        $iForceUpdate = $aArgs['stwredo'] ? true : false;
        if ($iForceUpdate || _cacheFileExpired($sFile)) {
            // if bandwidth limit has reached return the BANDWIDTH_IMAGE
            if (_checkLimitReached(THUMBNAIL_DIR . BANDWIDTH_IMAGE)) {
                $sFilename = BANDWIDTH_IMAGE;
            // if quota limit has reached return the QUOTA_IMAGE
            } else if (_checkLimitReached(THUMBNAIL_DIR . QUOTA_IMAGE)) {
                $sFilename = QUOTA_IMAGE;
			// if WAY OVER the limits (i.e. request is ignored by STW) return the NO_RESPONSE_IMAGE
            } else if (_checkLimitReached(THUMBNAIL_DIR . NO_RESPONSE_IMAGE)) {
                $sFilename = NO_RESPONSE_IMAGE;
            } else {
                // check if the thumbnail was captured
                $aImage = _checkWebsiteThumbnailCaptured($aArgs);
                switch ($aImage['status']) {
                    case 'save': // download the image to local path
                        _downloadRemoteImageToLocalPath($aImage['url'], $sFile);
                    break;

                    case 'nosave': // dont save the image but return the url
                        return $aImage['url'];
                    break;

                    case 'quota_exceed': // download the image to local path for locking requests
                        $sFilename = QUOTA_IMAGE;
                        $sFile = THUMBNAIL_DIR . $sFilename;
                        _downloadRemoteImageToLocalPath($aImage['url'], $sFile);
                    break;

                    case 'bandwidth_exceed': // download the image to local path for locking requests
                        $sFilename = BANDWIDTH_IMAGE;
                        $sFile = THUMBNAIL_DIR . $sFilename;
                        _downloadRemoteImageToLocalPath($aImage['url'], $sFile);
                    break;

                    default: // otherwise return the status
                        return $aImage['status'];
                }
            }
        }

        $sFile = THUMBNAIL_DIR . $sFilename;
        // Check if file exists
        if (file_exists($sFile)) {
            $sReturnName = THUMBNAIL_URI . $sFilename;
        }

        return $sReturnName;
    }

    /**
     * Method that checks if the thumbnail for the specified website exists
     */
    function _checkWebsiteThumbnailCaptured($aArgs) {
        $sRequestUrl = 'http://images.shrinktheweb.com/xino.php';
        $sRemoteData = _fileGetContent($sRequestUrl, $aArgs);

        // check if we get no response or the maintenance string
        if ($sRemoteData == '' || $sRemoteData == 'offline') {
            $aImage = array('status' => 'no_response');
            if ($sRemoteData != '') {
                 $aImage['message'] = MAINTENANCE;
            }
        } else {
            $aResponse = _getXMLResponse($sRemoteData);
            // thumbnail is existing, download it
            if ($aResponse['exists'] && $aResponse['thumbnail'] != '') {
                $aImage = array('status' => 'save', 'url' => $aResponse['thumbnail']);
            // bandwidth limit has reached, grab embedded image and store it as BANDWIDTH_IMAGE
            } else if ($aResponse['stw_bandwidth_remaining'] == 0 && !$aResponse['locked'] && !$aResponse['invalid'] && !$aResponse['exists'] && !$aResponse['problem']) {
                $aImage = array('status' => 'bandwidth_exceed', 'url' => $aResponse['thumbnail']);
            // quota limit has reached, grab embedded image and store it as QUOTA_IMAGE
            } else if ($aResponse['stw_quota_remaining'] == 0 && !$aResponse['locked'] && !$aResponse['invalid'] && !$aResponse['exists'] && !$aResponse['problem']) {
                $aImage = array('status' => 'quota_exceed', 'url' => $aResponse['thumbnail']);
            // an error has occured, return the url but dont save the image
            } else if (!$aResponse['exists'] && $aResponse['thumbnail'] != '') {
                $aImage = array('status' => 'nosave', 'url' => $aResponse['thumbnail']);
            // otherwise return error because we dont know the situation
            } else {
                $aImage = array('status' => 'error');
            }

            // add the request to the database if debug is enabled
            if (DEBUG && DATABASE_HOST != '' && DATABASE_NAME != '' && DATABASE_USER != '') {
                if (_DBConnect()) {
                    _addRequestToDB($aArgs, $aResponse, _generateHash($aArgs));
                    _DBDisconnect();
                }
            }
        }

        return $aImage;
    }

    /**
     * Method to get image at the specified remote Url and attempt to save it to the specifed local path
     */
    function _downloadRemoteImageToLocalPath($sRemoteUrl, $sFile) {
        $sRemoteData = _fileGetContent($sRemoteUrl, array());

        // Only save data if we managed to get the file content
        if ($sRemoteData) {
            $rFile = fopen($sFile, "w+");
            fputs($rFile, $sRemoteData);
            fclose($rFile);
        } else {
            // Try to delete file if download failed
            if (file_exists($sFile)) {
                @unlink($sFile);
            }

            return false;
        }

        return true;
    }

    /**
     * Gets the account problem image and returns the relative path to the cached image
     */
    function _getNoResponseImage($sUrl, $aOptions) {
        // create cache directory if it doesn't exist
        _createCacheDirectory();

        $aOptions = _generateOptions($aOptions);
        
        $aArgs['stwaccesskeyid'] = 'accountproblem';

        if ($aOptions['SizeCustom']) {
            $aArgs['stwxmax'] = $aOptions['SizeCustom'];
        } else {
            $aArgs['stwsize'] = $aOptions['Size'];
        }

        $sRequestUrl = 'http://images.shrinktheweb.com/xino.php';
        $sRemoteData = _fileGetContent($sRequestUrl, $aArgs);

        if ($sRemoteData != '') {
            $aResponse = _getXMLResponse($sRemoteData);

            if (!$aResponse['exists'] && $aResponse['thumbnail'] != '') {
                $sImageUrl = $aResponse['thumbnail'];

                $sFilename = NO_RESPONSE_IMAGE;
                $sFile = THUMBNAIL_DIR . $sFilename;
                $isDownloaded = _downloadRemoteImageToLocalPath($sImageUrl, $sFile);

                if ($isDownloaded == true) {
                    return THUMBNAIL_URI . $sFilename;
                }
            }
        }
        
        return false;
    }

    /**
     * Check if the limit reached image is existing, if so return true
     * return false if there is no image existing or the limit reached file is
     * older then 6 hours
     */
    function _checkLimitReached($sFile) {
        // file is not existing
        if (!file_exists($sFile)) {
            return false;
        }

        // is file older then 6 hours?
        $iCutoff = time() - (3600 * 6);
        if (filemtime($sFile) <= $iCutoff) {
            @unlink($sFile);
            return false;
        }

        // file is existing and not expired!
        return true;
    }

    /**
     * Create cache directory if it doesnt exist
     */
    function _createCacheDirectory() {
        // Create cache directory if it doesnt exist
        if (!file_exists(THUMBNAIL_DIR)) {
            @mkdir(THUMBNAIL_DIR, 0777, true);
        } else {
            // Try to make the directory writable
            @chmod(THUMBNAIL_DIR, 0777);
        }
    }

    /**
     * Generate the hash for the thumbnail, this is used as filename also
     */
    function _generateHash($aArgs) {
        $sPrehash = $aArgs['stwfull'] ? 'a' : 'c';
        $sPrehash .= $aArgs['stwxmax'].'x'.$aArgs['stwymax'];
        if ($aArgs['stwnrx']) {
            $sPrehash .= 'b'.$aArgs['stwnrx'].'x'.$aArgs['stwnry'];
        }
        $sPrehash .= $aArgs['stwinside'];

        $aReplace = array('http', 'https', 'ftp', '://');
        $sUrl = str_replace($aReplace, '', $aArgs['stwurl']);

        return md5($sPrehash.$aArgs['stwsize'].$aArgs['stwq'].$sUrl);
    }

    /**
     * store the XML response in an array and generate status bits
     */
    function _getXMLResponse($sResponse) {
        if (extension_loaded('simplexml')) { // If simplexml is available, we can do more stuff!
            $oDOM = new DOMDocument;
            $oDOM->loadXML($sResponse);
            $sXML = simplexml_import_dom($oDOM);
            $sXMLLayout = 'http://www.shrinktheweb.com/doc/stwresponse.xsd';

            // Pull response codes from XML feed
            $aResponse['thumbnail'] = $sXML->children($sXMLLayout)->Response->ThumbnailResult->Thumbnail[0];
            $aResponse['stw_action'] = $sXML->children($sXMLLayout)->Response->ThumbnailResult->Thumbnail[1];
            $aResponse['stw_response_status'] = $sXML->children($sXMLLayout)->Response->ResponseStatus->StatusCode; // HTTP Response Code
            $aResponse['stw_response_code'] = $sXML->children($sXMLLayout)->Response->ResponseCode->StatusCode; // STW Error Response
            $aResponse['stw_last_captured'] = $sXML->children($sXMLLayout)->Response->ResponseTimestamp->StatusCode; // Last Captured
            $aResponse['stw_quota_remaining'] = $sXML->children($sXMLLayout)->Response->Quota_Remaining->StatusCode; // New Reqs left for today
            $aResponse['stw_bandwidth_remaining'] = $sXML->children($sXMLLayout)->Response->Bandwidth_Remaining->StatusCode; // New Reqs left for today
            $aResponse['stw_category_code'] = $sXML->children($sXMLLayout)->Response->CategoryCode->StatusCode; // Not yet implemented
        } else {
	        // LEGACY SUPPPORT
            $aResponse['stw_response_status'] = _getLegacyResponse('ResponseStatus', $sRemoteData);
            $aResponse['stw_response_code'] = _getLegacyResponse('ResponseCode', $sRemoteData);

            // check remaining quota
            $aResponse['stw_quota_remaining'] = _getLegacyResponse('Quota_Remaining', $sRemoteData);
            // check remaining bandwidth
            $aResponse['stw_bandwidth_remaining'] = _getLegacyResponse('Bandwidth_Remaining', $sRemoteData);

            // get thumbnail and status
            $aThumbnail = _getThumbnailStatus($sRemoteData);
            $aResponse = array_merge($aResponse, $aThumbnail);
        }
        
        if ($aResponse['stw_action'] == 'delivered') {
            $aResponse['exists'] = true;
        } else {
            $aResponse['exists'] = false;
        }

        if ($aResponse['stw_action'] == 'fix_and_retry') {
            $aResponse['problem'] = true;
        } else {
            $aResponse['problem'] = false;
        }

        if ($aResponse['stw_action'] == 'noretry') {
            $aResponse['error'] = true;
        } else {
            $aResponse['error'] = false;
        }

        // if we use the advanced api for free account we get an invalid request
        if ($aResponse['stw_response_code'] == 'INVALID_REQUEST') {
            $aResponse['invalid'] = true;
        } else {
            $aResponse['invalid'] = false;
        }
		
		// if our domain or IP is not listed in the account's "Allowed Referrers" AND "Lock to Account" is enabled, then we get this error
        if ($aResponse['stw_response_code'] == 'LOCK_TO_ACCOUNT') {
            $aResponse['locked'] = true;
        } else {
            $aResponse['locked'] = false;
        }

        return $aResponse;
    }

    function _getLegacyResponse($sSearch, $s) {
	    $sRegex = '/<[^:]*:' . $sSearch . '[^>]*>[^<]*<[^:]*:StatusCode[^>]*>([^<]*)<\//';
	    if (preg_match($sRegex, $s, $sMatches)) {
	    	return $sMatches[1];
	    }
        return false;
    }

    function _getThumbnailStatus($s) {
        $sRegex = '/<[^:]*:ThumbnailResult?[^>]*>[^<]*<[^:]*:Thumbnail\s*(?:Exists=\"((?:true)|(?:false))\")+[^>]*>([^<]*)<\//';
        if (preg_match($sRegex, $s, $sMatches)) {
            return array('stw_action' => $sMatches[1],
                         'thumbnail' => $sMatches[2]);
        }
        return false;
    }

    /**
     * Determine if specified file has expired from the cache
     */
    function _cacheFileExpired($sFile) {
        // Use setting to check age of files.
        $iCacheDays = CACHE_DAYS + 0;

        // dont update image once it is cached
        if ($iCacheDays == 0 && file_exists($sFile)) {
            return false;
        // check age of file and if file exists return false, otherwise recache the file
        } else {
            $iCutoff = time() - (3600 * 24 * $iCacheDays);
            return (!file_exists($sFile) || filemtime($sFile) <= $iCutoff);
        }
    }

    /**
     * Safe method to get the value from an array using the specified key
     */
    function _getArrayValue($aArray, $sKey, $isReturnSpace = false) {
        if ($aArray && isset($aArray[$sKey])) {
            return $aArray[$sKey];
        }

        // If returnSpace is true, then return a space rather than nothing at all
        if ($isReturnSpace) {
            return '&nbsp;';
        } else {
            return false;
        }
    }

    /**
    * Gets file content by URL
    */
    function _fileGetContent($sFileUrl, $aParams = array()) {
        $sParams = '?';
        foreach($aParams as $sKey => $sValue)
            $sParams .= $sKey . '=' . $sValue . '&';
        $sParams = substr($sParams, 0, -1);

        $sResult = '';
        if(function_exists('curl_init')) {
            $rConnect = curl_init();

            curl_setopt($rConnect, CURLOPT_URL, $sFileUrl . $sParams);
            curl_setopt($rConnect, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($rConnect, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($rConnect, CURLOPT_HEADER, 0); // must be 0 or else headers will break SimpleXML parsing

            $sAllCookies = '';
            foreach($_COOKIE as $sKey=>$sValue){
                $sAllCookies .= $sKey."=".$sValue.";";
            }
            curl_setopt($rConnect, CURLOPT_COOKIE, $sAllCookies);

            $sResult = curl_exec($rConnect);
            curl_close($rConnect);
        }
        else
            $sResult = @file_get_contents($sFileUrl . $sParams);

        return $sResult;
    }
?>
