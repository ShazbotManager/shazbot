<?php

/**
 * @file
 * Contains Drupal\shazbot\Entity\ShazbotIssue.
 */

namespace Drupal\shazbot\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Shazbot issue entities.
 */
class ShazbotIssueViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['shazbot_issue']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Shazbot issue'),
      'help' => $this->t('The Shazbot issue ID.'),
    );

    return $data;
  }

}
