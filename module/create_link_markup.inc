<?php

/**
 * @file
 * Example of how to create custom links programmatically.
 */

use Drupal\Core\Url;
use Drupal\Core\Link;

  /**
   * Builds the mailto link.
   *
   * @return string
   *   Mailto link HTML string.
   */
  private function buildMailtoLink() {
    $system_site_config = \Drupal::config('system.site');
    $site_email = $system_site_config->get('mail');
    $subject = rawurlencode(t('Site Access Request'));

    $uri = 'mailto:' . $site_email . '?subject=' . $subject;
    $url = Url::fromUri($uri);
    $mailto_link = Link::fromTextAndUrl(t('Mailto'), $url);
    $mailto_link = $mailto_link->toRenderable();
    $mailto_link['#attributes'] = [
      'class' => [
        'myclass-1',
        'myclass-2',
      ],
    ];

    return render($mailto_link);
  }
