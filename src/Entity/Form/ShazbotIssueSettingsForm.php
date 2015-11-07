<?php

/**
 * @file
 * Contains Drupal\shazbot\Entity\Form\ShazbotIssueSettingsForm.
 */

namespace Drupal\shazbot\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ShazbotIssueSettingsForm.
 *
 * @package Drupal\shazbot\Form
 *
 * @ingroup shazbot
 */
class ShazbotIssueSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'ShazbotIssue_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Defines the settings form for Shazbot issue entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['ShazbotIssue_settings']['#markup'] = 'Settings form for Shazbot issue entities. Manage field settings here.';

    return $form;
  }

}
