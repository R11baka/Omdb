<?php

namespace Omdb\Api\HttpClient;

use RuntimeException;

class CurlClient implements Client
{
    const TIMEOUT = 10;

    /**
     * @param string $url
     * @return string
     * @throws RuntimeException
     */
    public function getRequest(string $url): string
    {
        try {
            if (!$curl = \curl_init()) {
                throw new RuntimeException("Can't init curl");
            }
            $options = [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => self::TIMEOUT];
            $optionsResult = curl_setopt_array($curl, $options);
            if ($optionsResult === false) {
                throw new RuntimeException(curl_error($curl));
            }
            $response = curl_exec($curl);
            if ($response === false) {
                throw new RuntimeException(curl_error($curl));
            }
            return $response;
        } catch (\Exception $e) {
            if (isset($curl) && is_resource($curl)) {
                curl_close($curl);
            }
            throw $e;
        }
    }
}
