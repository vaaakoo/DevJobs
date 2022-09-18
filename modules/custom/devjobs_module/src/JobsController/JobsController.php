<?php

namespace Drupal\devjobs_module\JobsController;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class JobsController extends ControllerBase {

  public function jobsContent() {

    $title = \Drupal::request()->query->get('title');
    $location = \Drupal::request()->query->get('location');
    $checkbox = \Drupal::request()->query->get('full_time');



    $node_storage = \Drupal::entityTypeManager()->getStorage('node');

    $nids = $node_storage->getQuery()
      ->condition('type', 'jobs')
      ->condition('status', 1)
      ->execute();

    if (!empty($title) && empty($location) && empty($checkbox)) {
      $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'jobs')
        ->condition('field_job_title', $title, 'CONTAINS')
        ->sort('nid', 'asc')
        ->execute();
    }
    if (empty($title) && !empty($location) && empty($checkbox)) {
      $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'jobs')
        ->condition('field_job_country', $location, 'CONTAINS')
        ->sort('nid', 'asc')
        ->execute();
    }
    if (empty($title) && empty($location) && !empty($checkbox)) {
      $checkbox='full time';
      $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'jobs')
        ->condition('field_job_time', $checkbox, 'CONTAINS')
        ->sort('nid', 'asc')
        ->execute();
    }
    if (empty($title) && !empty($location) && !empty($checkbox)) {
      $checkbox='full time';
      $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'jobs')
        ->condition('field_job_country', $location, 'CONTAINS')
        ->condition('field_job_time', $checkbox, 'CONTAINS')
        ->sort('nid', 'asc')
        ->execute();
    }


    $jobs = [];
    foreach ($nids as $nid) {
    $node = Node::load($nid);

      $fid = $node->field_job_image->getValue()[0]['target_id'] ?? null;
      $file = File::load($fid);
      $image_uri = $file->getFileUri();
      $style = ImageStyle::load('thumbnail');
      $url = $style->buildUrl($image_uri);

    $jobs[$nid] = [
      'job_image'=>$url,
      'job_title' =>$node->field_job_title->getValue()[0]['value'],
      'job_type' =>$node->field_job_type->getValue()[0]['value'],
      'job_country' =>$node->field_job_country->getValue()[0]['value'],
//      'job_time' =>$node->field_job_time->getValue()[0]['value'],
//      'part_time' =>$node->field_part_time->getValue()[0]['value'],
      'work_time' => $node->field_time->getValue()[0]['value'],
      'id' => $nid,
    ];
  }

    return [
      // Theme hook name
      '#theme' => 'jobs',

      // Variables
      '#jobs' => $jobs,

    ];

  }
}


