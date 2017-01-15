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

  public function send($text, $imagePath = null) {

    if (empty($text)) {
      return false;
    }

    $request_params = [
      'headers' => [
        'Authorization' => 'Bearer ' . $this->token,
      ],
    ];

    if (!empty($imagePath)) {
      $request_params['multipart'] = [
        [
          'name' => 'message',
          'contents' => $text
        ],
        [
          'name' => 'imageFile',
          'contents' => fopen($imagePath, 'r')
        ],
      ];
    } else {
      $request_params['form_params'] = ['message' => $text];
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
