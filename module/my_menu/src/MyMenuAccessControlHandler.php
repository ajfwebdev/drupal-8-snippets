<?php

namespace Drupal\my_menu;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the menu entity type.
 * Most of this is the same as the Drupal system menu access control handler.
 * The customization is -
 * "Deny permission to manage the Administration menu except for user 1."
 *
 * @see \Drupal\system\Entity\Menu
 */
class MyMenuAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected $viewLabelOperation = TRUE;

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    // There are no restrictions on viewing the label of a menu.
    if ($operation === 'view label') {
      return AccessResult::allowed();
    }

    // Deny permission to manage the Administration menu except for user 1.
    if ($entity->id() === "admin") {
      if ($operation != 'view label') {
        if ($account->id() === "1") {
          return parent::checkAccess($entity, $operation, $account)
            ->addCacheableDependency($entity);
        }
        else {
          return AccessResult::forbidden('The Administration menu should not be changed.')->addCacheableDependency($entity);
        }
      }
    }

    // Locked menus can not be deleted.
    elseif ($operation === 'delete') {
      if ($entity->isLocked()) {
        return AccessResult::forbidden('The Menu config entity is locked.')->addCacheableDependency($entity);
      }
      else {
        return parent::checkAccess($entity, $operation, $account)->addCacheableDependency($entity);
      }
    }

    return parent::checkAccess($entity, $operation, $account);
  }

}
