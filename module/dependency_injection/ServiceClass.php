<?php

namespace Drupal\my_module;

use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Component\Serialization\Json;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Drupal\Core\Logger\LoggerChannelFactory;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * The ServiceClass class.
 */
class ServiceClass  {

  /**
   * The ConfigFactory service.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * The GuzzleHttp Client service.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * The AccountProxy service.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * The Json service.
   *
   * @var \Drupal\Component\Serialization\Json
   */
  protected $json;

  /**
   * The LoggerChannelFactory service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactory
   */
  protected $loggerFactory;

  /**
   * The RequestStack service.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructs a new MyClass object.
   */
  public function __construct(ConfigFactory $config_factory, Client $http_client, AccountProxy $account_proxy, Json $json, LoggerChannelFactory $logger_factory, RequestStack $request_stack) {
    $this->configFactory = $config_factory;
    $this->httpClient = $http_client;
    $this->currentUser = $account_proxy;
    $this->json = $json;
    $this->loggerFactory = $logger_factory;
    $this->requestStack = $request_stack;
  }

  /**
   * Examples of using injected services.
   */
  protected function myFunction() {

    // Get config object.
    $config = $this->configFactory('my_module.settings');

    // Get config value.
    $my_setting = $config->get('my_module.mySetting');

    // Set config value.
    $config->set('my_module.mySetting', 'my new value');
    $config->save();

    // Get access token.
    $token = $this->tokenManager->getAccessToken();

    // Example variables for use with httpClient, loggerFactory.
    $method = 'GET';
    $url = 'https://example.com';
    $options = [
      'verify' => FALSE,
      'http_errors' => TRUE,
      'headers' => [
        'Accept' => 'application/json',
        'Content-type' => 'application/json',
      ],
    ];

    // Get request.
    $request = $this->httpClient->request($method, $url, $options);

    // Log a message.
    $this->loggerFactory->get('my_logger_channel')->info("doing %method to %url with options %options", [
      '%method' => $method,
      '%url' => $url,
      '%options' => \GuzzleHttp\json_encode($options),
    ]);

    // Use currentUser.
    if ($this->currentUser->isAnonymous()) {
      // Do something.
    }

    // Get the client IP, via requestStack.
    $clientIp = $this->requestStack->getCurrentRequest()->getClientIp();

    // Use json service to convert from json to PHP array.
    $decoded = $this->json->decode($data);

  }

}
