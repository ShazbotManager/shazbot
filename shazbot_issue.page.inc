<?php

/**
 * @file
 * Contains shazbot_issue.page.inc.
 *
 * Page callback for Shazbot issue entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Shazbot issue templates.
 *
 * Default template: shazbot_issue.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_shazbot_issue(array &$variables) {
  // Fetch ShazbotIssue Entity Object.
  $shazbot_issue = $variables['elements']['#shazbot_issue'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
