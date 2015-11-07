<?php

/**
 * @file
 * Contains Drupal\shazbot\Entity\Form\ShazbotIssueForm.
 */

namespace Drupal\shazbot\Entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\Language;

/**
 * Form controller for Shazbot issue edit forms.
 *
 * @ingroup shazbot
 */
class ShazbotIssueForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\shazbot\Entity\ShazbotIssue */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $form['langcode'] = [
      '#title'         => $this->t('Language'),
      '#type'          => 'language_select',
      '#default_value' => $entity->langcode->value,
      '#languages'     => Language::STATE_ALL,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = $entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Shazbot issue.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Shazbot issue.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.shazbot_issue.edit_form', ['shazbot_issue' => $entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array $form, FormStateInterface $form_state) {
    // Build the entity object from the submitted values.
    $entity = parent::submit($form, $form_state);

    return $entity;
  }

}
