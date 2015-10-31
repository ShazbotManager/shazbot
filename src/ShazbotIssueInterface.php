<?php

/**
 * @file
 * Contains Drupal\shazbot\ShazbotIssueInterface.
 */

namespace Drupal\shazbot;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Shazbot issue entities.
 *
 * @ingroup shazbot
 */
interface ShazbotIssueInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
