<?php

/**
 * @file
 * Contains Drupal\shazbot\ShazbotIssueAccessControlHandler.
 */

namespace Drupal\shazbot;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the Shazbot issue entity.
 *
 * @see \Drupal\shazbot\Entity\ShazbotIssue.
 */
class ShazbotIssueAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view shazbot issue entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit shazbot issue entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete shazbot issue entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add shazbot issue entities');
  }

}
