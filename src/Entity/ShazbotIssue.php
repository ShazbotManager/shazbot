<?php

/**
 * @file
 * Contains Drupal\shazbot\Entity\ShazbotIssue.
 */

namespace Drupal\shazbot\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\shazbot\ShazbotIssueInterface;
use Drupal\user\UserInterface;

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
 *     "canonical" = "/admin/shazbot_issue/{shazbot_issue}",
 *     "edit-form" = "/admin/shazbot_issue/{shazbot_issue}/edit",
 *     "delete-form" = "/admin/shazbot_issue/{shazbot_issue}/delete"
 *   },
 *   field_ui_base_route = "shazbot_issue.settings"
 * )
 */
class ShazbotIssue extends ContentEntityBase implements ShazbotIssueInterface {
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
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Shazbot issue entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Shazbot issue entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Shazbot issue entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label'  => 'hidden',
        'type'   => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type'     => 'entity_reference_autocomplete',
        'weight'   => 5,
        'settings' => [
          'match_operator'    => 'CONTAINS',
          'size'              => '60',
          'autocomplete_type' => 'tags',
          'placeholder'       => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Shazbot issue entity.'))
      ->setSettings([
        'max_length'      => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label'  => 'above',
        'type'   => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type'   => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Shazbot issue entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());

    return $this;
  }

}
