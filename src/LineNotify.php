<?php

namespace KS\Line;

use GuzzleHttp\Client;

/**
 * A simple class to send text message, image and Line sticker on Line notify
 * 
 * https://notify-bot.line.me/doc/en/
 * 
 * @property string $token Line notify token
 * @property \GuzzleHttp\Client $http Guzzle Http Client instance for send Http request
 */
class LineNotify {

  const API_URL = 'https://notify-api.line.me/api/notify';

  private $token = null;
  private $http = null;
  
  /**
   * Initialize class with Line notify token string
   * 
   * @param string $token the token of Line notify
   */
  public function __construct($token) {

    $this->token = $token;
    $this->http = new Client();
  }
  
  /**
   * Set token Line notify that want to send message
   * 
   * @param string $token the token of Line notify
   */
  public function setToken($token) {
    $this->token = $token;
  }
  
  /**
   * Get current token Line Notify
   * 
   * @return string the token of Line notify
   */
  public function getToken() {
    return $this->token;
  }
  
  /**
   * Send text message, image or sticker on Line notify
   * 
   * @param string $text text message on Line notify can not be empty
   * @param string $imagePath image path you want to send on the local machine
   * @param array() $sticker array of line sticker ['stickerPackageId' => PACKAGE_ID, 'stickerId' => STICKER_ID ] 
   *                         more info https://devdocs.line.me/files/sticker_list.pdf
   * @return boolean success or fail on send Line notify message
   */
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
    
    if (!empty($imagePath) && preg_match("#^https?://#", $imagePath)) {
      // Remote HTTP / HTTPS image
      $request_params['multipart'][] = [
        'name' => 'imageThumbnail',
        'contents' => $imagePath
      ];
      
      $request_params['multipart'][] = [
        'name' => 'imageFullsize',
        'contents' => $imagePath
      ];
      
    } elseif (!empty($imagePath) && file_exists($imagePath)) {
      // Local image
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
