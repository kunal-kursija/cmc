<?php

namespace Drupal\cmc\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Class GreetingsForm.
 *
 * @package Drupal\cmc\Form
 */
class GreetingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cmc_greetings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return ['cmc.greetings_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('cmc.greetings_settings');

    $form['greeting'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Greeting'),
      '#description' => $this->t('Greetings to be seen by the site visitors'),
      '#default_value' => $config->get('greeting'),
    ];

    $form['greeting_summary'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Greeting Summary'),
      '#default_value' => $config->get('greeting_summary'),
      '#rows' => '5',
      '#description' => $this->t('Greetings summary to be seen by the site visitors'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('cmc.greetings_settings')
      ->set('greeting', $form_state->getValue('greeting'))
      ->set('greeting_summary', $form_state->getValue('greeting_summary'))
      ->save();
  }

}