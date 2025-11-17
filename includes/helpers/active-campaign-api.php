<?php



function fetch_api_active_campaign($url, $body = []) {

  $args = [

    'headers' => [

      'Accept' => 'application/json',

    ],

    'body'    => wp_json_encode($body),

    'method'  => 'POST',

    'timeout' => 20,

  ];

  // error_log(print_r($body, true));

  $response = wp_remote_post($url, $args);



  if (is_wp_error($response)) {

    error_log('fetch_api error: ' . $response->get_error_message());

    return ['error' => $response->get_error_message()];

  }



  $code = wp_remote_retrieve_response_code($response);

  $res_body = wp_remote_retrieve_body($response);



  if ($code !== 200) {

    error_log("fetch_api bad response: HTTP $code - $res_body");

    return null;

  }



  return $res_body;

}



