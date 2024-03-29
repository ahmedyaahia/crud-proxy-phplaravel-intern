<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request as HttpRequest;

class ProxyController extends Controller
{
     /**
     * Handle an incoming proxy request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleProxyRequest(HttpRequest $request)
    {
        $apiEndpoint = 'https://jsonplaceholder.typicode.com/posts';
    
        // Get request data from the client
        $requestData = $request->all();
    
        // Extract request_url, headers, and body from the request data
        $requestUrl = $requestData['request_url'];
        $headers = $requestData['headers'];
        $body = $requestData['body'];
    
        // Create a new GuzzleHttp client instance
        $client = new Client();
    
        // Create a new GuzzleHttp request
        $proxyRequest = new Request('POST', $apiEndpoint . $requestUrl, $headers, $body);
    
        try {
            // Forward the request to the API endpoint
            $proxyResponse = $client->send($proxyRequest);
    
            // Get the response body from the API response
            $responseBody = $proxyResponse->getBody()->getContents();
    
            // Pass the response data to the view
            return view('proxy-response', ['responseData' => $responseBody]);
        } catch (RequestException $e) {
            // Handle any errors that occur during the request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    }    