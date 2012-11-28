<?php

class ProvisionerUtils {
    public static function get_mac_address($ua, $uri) {
        // Let's check in the User-Agent
        if (preg_match("#[0-9a-fA-F]{2}(?=(:?))(?:\\1[0-9a-fA-F]{2}){5}#", $ua, $match_result))
            // need to return the mac address without the ':''
            return preg_replace('/:/', '', $match_result[0]);
        else 
            // Then let's check in the uri (should be at the end of it)
            // Then explode the url
            $explode_uri = explode('/', $uri);
            $mac_index = sizeof($explode_uri) - 1;

            if (preg_match("#[0-9a-fA-F]{12}#", $explode_uri[$mac_index], $match_result))
                return $match_result[0];
            else 
                return false;
    }

    // Will return the host and only that
    // No 'www.' and no port
    public static function get_provider($http_host) {
        $host = preg_replace("/^www\./", '', $http_host);
        $host = preg_replace("#:\d*$#", '', $host);
        return $host;
    }
}

?>