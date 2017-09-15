<?php

namespace Drupal\my_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Header Block with the site name and tagline.
 *
 * @Block(
 *   id = "my_header",
 *   admin_label = @Translation("My Header"),
 * )
 */
class MyHeaderBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Stores the configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Creates a SystemBrandingBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $tagline = $this->configFactory->get('system.site')->get('slogan');
    $sitename = $this->configFactory->get('system.site')->get('sitename');

    $form['tagline'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tagline'),
      '#default_value' => $tagline,
      '#description' => t('Displayed in header above the site name.'),
      '#weight' => 1,
      '#attributes' => [
        'placeholder' => 'Tagline',
      ],
    ];

    $form['sitename'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Name'),
      '#default_value' => $sitename,
      '#description' => t('The site name.'),
      '#weight' => 1,
      '#attributes' => [
        'placeholder' => 'Site Name',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    \Drupal::configFactory()->getEditable('system.site')
      ->set('slogan', $form_state->getValue('tagline'))
      ->save();

    \Drupal::configFactory()->getEditable('system.site')
      ->set('sitename', $form_state->getValue('sitename'))
      ->save();
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    $build['logo_url'] = [
      '#markup' => "/",
    ];

    $build['tagline'] = [
      '#markup' => $this->configFactory->get('system.site')->get('slogan'),
    ];

    $build['site_label'] = [
      '#markup' => $this->configFactory->get('system.site')->get('name'),
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(
      parent::getCacheTags(),
      $this->configFactory->get('pwc_core.settings')->getCacheTags()
    );
  }

}

