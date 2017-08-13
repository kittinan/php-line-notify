<?php

namespace KS\Line;

use GuzzleHttp\Client;

class LineNotify {

  const API_URL = 'https://notify-api.line.me/api/notify';

  private $token = null;
  private $http = null;

  public function __construct($token) {

    $this->token = $token;
    $this->http = new Client();
  }

  public function setToken($token) {
    $this->token = $token;
  }

  public function getToken() {
    return $this->token;
  }

  public function send($text, $imagePath = null, $sticker = null) {

    if (empty($text)) {
      return false;
    }

    $request_params = [
      'headers' => [
        'Authorization' => 'Bearer ' . $this->token,
      ],
    ];
    
    //Message always required
    $request_params['multipart'] = [
      [
        'name' => 'message',
        'contents' => $text
      ]
    ];

    if (!empty($imagePath)) {
      $request_params['multipart'][] = [
        'name' => 'imageFile',
        'contents' => fopen($imagePath, 'r')
      ];
    }

    //https://devdocs.line.me/files/sticker_list.pdf
    if (!empty($sticker) 
      && !empty($sticker['stickerPackageId']) 
      && !empty($sticker['stickerId'])) {
      
      $request_params['multipart'][] = [
        'name' => 'stickerPackageId',
        'contents' => $sticker['stickerPackageId']
      ];
      
      $request_params['multipart'][] = [
        'name' => 'stickerId',
        'contents' => $sticker['stickerId']
      ];
      
    }

    $response = $this->http->request('POST', LineNotify::API_URL, $request_params);

    if ($response->getStatusCode() != 200) {
      return false;
    }

    $body = (string) $response->getBody();
    $json = json_decode($body, true);
    if (empty($json['status']) || empty($json['message'])) {
      return false;
    }

    return true;
  }

}
