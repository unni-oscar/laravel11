<?php

namespace App\Services;

class CurlService
{
    /**
     * Perform a cURL request.
     *
     * @param string $url
     * @param array $headers
     * @return string
     */
    public function getRequest(string $url, array $headers = []): array
    {
        // Initialize a cURL session
        $ch = curl_init($url);
        // Set the option to return the transfer as a string of the return value of curl_exec() instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the option to follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // Set the option to set the maximum number of seconds to allow cURL functions to execute
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        // Set the option to disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Set the HTTP headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
        ], $headers));

        // Execute the cURL session
        $response = curl_exec($ch);

        // Get the HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // Close the cURL session
        curl_close($ch);

        // Check if the file exists based on the HTTP status code
        if ($httpCode === 200) {
            // File exists
            // return $response;  // Return the content or process it as needed
            return [
                "status" => true,
                "message" => "File downloaded successfully.",
                'data' => $response
            ];
        } elseif ($httpCode === 404) {
            return [
                "status" => false,
                "message" => "File not found..",
            ];
            
        } else {
            return [
                "status" => false,
                "message" => "Error: HTTP code " . $httpCode,
            ];
            // Other HTTP status codes (e.g., 500, 403)
            // return "Error: HTTP code " . $httpCode;
        }

        // Return the response
        // return $response;
    }
}
