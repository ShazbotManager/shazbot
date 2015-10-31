<?php

/**
 * @file
 * Contains Drupal\shazbot\ShazbotIssueListBuilder.
 */

namespace Drupal\shazbot;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Shazbot issue entities.
 *
 * @ingroup shazbot
 */
class ShazbotIssueListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Shazbot issue ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\shazbot\Entity\ShazbotIssue */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $this->getLabel($entity),
      new Url(
        'entity.shazbot_issue.edit_form', array(
          'shazbot_issue' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
