<?php

namespace Drupal\my_module;

use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

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
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new ControllerClass object.
   */
  public function __construct(LoggerChannelFactory $logger_channel_factory, AccountProxy $account_proxy, ConfigFactory $config_factory, EntityTypeManager $entity_type_manager) {
    $this->logger = $logger_channel_factory->get('my_logger_channel');
    $this->currentUser = $account_proxy;
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
    $container->get('logger.factory'),
    $container->get('current_user'),
    $container->get('config.factory'),
    $container->get('entity_type.manager')
    );
  }

}
