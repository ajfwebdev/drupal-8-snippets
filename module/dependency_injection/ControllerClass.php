<?php

namespace Drupal\my_module;

use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\Session\AccountProxy;

/**
 * The ControllerClass class.
 */
class ControllerClass extends ControllerBase {

  /**
   * The LoggerChannelInterface for the logger channel.
   *
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $logger;

  /**
   * The AccountProxy service.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * Constructs a new ControllerClass object.
   */
  public function __construct(LoggerChannelFactory $logger_channel_factory, AccountProxy $account_proxy) {
    $this->logger = $logger_channel_factory->get('my_logger_channel');
    $this->currentUser = $account_proxy;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
    $container->get('logger.factory'),
    $container->get('current_user')
    );
  }

}
