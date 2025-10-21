<?php

namespace app\models;

use yii\base\Model;

// Include Yii2 HTTP Client
use yii\httpclient\Client;

class Post extends Model
{   
    /* 
      Fetch all posts from the external JSONPlaceholder API with pagination support.
      @param int $page The page number to fetch.
      @param int $limit The number of posts per page.
      @return array containing 'data' (posts) and 'totalCount' (total number of posts).
    */
    public static function fetchAll($page = 1, $limit = 9)
    {
        // Create Yii2 HTTP Client
        $client = new Client(['baseUrl' => 'https://jsonplaceholder.typicode.com/']);

        // Try to send the request and handle possible errors
        try {

            // Send GET request to the /posts endpoint using Yii2 HttpClient with params for pagination
            // Documentation: https://github.com/typicode/json-server#paginate
            // We use _limit instead of _per_page because JSONPlaceholder is using old json-server version
            $response = $client->get('posts', [
                '_page' => $page,
                '_limit' => $limit,
            ])->send();

            // Check if the response is successful
            if ($response->isOk) {
                $posts = $response->data;

                // Total count of posts from the headers
                $totalCount = (int) $response->headers->get('X-Total-Count', count($posts));

                // Return posts data and total count
                return [
                    'data' => $posts,
                    'totalCount' => $totalCount,
                ];
            }

            /* 
              Handle different error status codes from the API related with getting posts.
              Taking into account it's not necessary credentials for this API.
            */
            switch ($response->statusCode) {
                case 400:
                    $message = 'Bad Request (400).';
                    break;
                case 404:
                    $message = 'Resource not found (404).';
                    break;
                case 500:
                    $message = 'Internal server error (500).';
                    break;
                case 503:
                    $message = 'Service unavailable (503). Please try again later.';
                    break;
                default:
                    $message = 'Unknown error. Code: ' . $response->statusCode;
                    break;
            }
            
            // Yii2 log to capture possible API errors
            Yii::warning("Error API ({$response->statusCode}): {$message}", __METHOD__);

            return [
                'error' => true,
                'message' => $message,
            ];

            
        } catch (\Exception $e) {

            // Yii2 log to capture connection errors
            Yii::error("Failed to connect: " . $e->getMessage(), __METHOD__);
            return [
                'error' => true,
                'message' => 'Sorry, there was an error connecting to the external {JSON} Placeholder API.',
            ];
        }
        
    }
}