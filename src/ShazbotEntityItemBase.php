<?php

/**
 * @file
 * Contains \Drupal\shazbot\ShazbotEntityItemBase.
 */

namespace Drupal\shazbot;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\shazbot\ShazbotEntityBase;

class ShazbotEntityItemBase extends ShazbotEntityBase {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    return $fields;
  }

}