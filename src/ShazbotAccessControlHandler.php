<?php

/**
 * @file
 * Contains Drupal\shazbot\ShazbotAccessControlHandler.
 */

namespace Drupal\shazbot;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the Shazbot entities.
 *
 * @see \Drupal\shazbot\Entity\ShazbotIssue.
 */
class ShazbotAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view shazbot entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit shazbot entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'edit shazbot entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'edit shazbot entities');
  }

}
