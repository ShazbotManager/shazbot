<?php

/**
 * @file
 * Contains \Drupal\shazbot\ShazbotEntityContextBase.
 */

namespace Drupal\shazbot;

use Drupal\Core\Entity\EntityTypeInterface;

class ShazbotEntityContextBase extends ShazbotEntityBase {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    return $fields;
  }

}