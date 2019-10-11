<?php

namespace Drupal\cmc\Controller;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class welcome.
 *
 * @package Drupal\cmc\Controller
 */
class welcome extends ControllerBase {

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs welcome object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config Factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * Method to return page output.
   */
  public function showGreetings() {
    $cmc = $this->configFactory->get('cmc.greetings_settings');

    return [
      '#theme' => 'cmc_greetings',
      '#greeting' => $cmc->get('greeting'),
      '#summary' => $cmc->get('greeting_summary'),
      '#attached' => [
        'library' => ['cmc/cmc-greetings-style'],
      ],
    ];
  }

}
