<?php

/**
 * @file
 * Contains Drupal\shazbot\Entity\ShazbotIssue.
 */

namespace Drupal\shazbot\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\shazbot\ShazbotEntityItemBase;
use Drupal\shazbot\ShazbotIssueInterface;

/**
 * Defines the Shazbot issue entity.
 *
 * @ingroup shazbot
 *
 * @ContentEntityType(
 *   id = "shazbot_issue",
 *   label = @Translation("Shazbot issue"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\shazbot\ShazbotIssueListBuilder",
 *     "views_data" = "Drupal\shazbot\Entity\ShazbotIssueViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\shazbot\Entity\Form\ShazbotIssueForm",
 *       "add" = "Drupal\shazbot\Entity\Form\ShazbotIssueForm",
 *       "edit" = "Drupal\shazbot\Entity\Form\ShazbotIssueForm",
 *       "delete" = "Drupal\shazbot\Entity\Form\ShazbotIssueDeleteForm",
 *     },
 *     "access" = "Drupal\shazbot\ShazbotIssueAccessControlHandler",
 *   },
 *   base_table = "shazbot_issue",
 *   admin_permission = "administer ShazbotIssue entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/issue/{shazbot_issue}",
 *     "edit-form" = "/issue/{shazbot_issue}/edit",
 *     "delete-form" = "/issue/{shazbot_issue}/delete"
 *   },
 *   field_ui_base_route = "shazbot_issue.settings"
 * )
 */
class ShazbotIssue extends ShazbotEntityItemBase implements ShazbotIssueInterface {
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += ['user_id' => \Drupal::currentUser()->id(),];
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['content'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Content'))
      ->setDescription(t('Issue content.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label'  => 'hidden',
        'type'   => 'text_default',
        'weight' => 25,
      ])
      ->setDisplayOptions('form', [
        'type'     => 'string_textarea',
        'weight'   => 25,
        'settings' => [
          'rows' => 10,
        ],
      ]);

    return $fields;
  }

}
