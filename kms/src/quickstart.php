<?php
/*
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

// [START kms_quickstart]
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

function quickstart_sample(
  $projectId = 'my-project',
  $locationId = 'us-east1'
) {
    // Create the Cloud KMS client.
    $client = new KeyManagementServiceClient();

    // Build the parent location name.
    $locationName = $client->locationName($projectId, $locationId);

    // Call the API.
    $keyRings = $client->listKeyRings($locationName);

    // Example of iterating over labels.
    printf('Key rings in %s:' . PHP_EOL, $locationName);
    foreach ($keyRings as $keyRing) {
        printf('%s' . PHP_EOL, $keyRing->getName());
    }

    return $keyRings;
}
// [END kms_quickstart]

if (isset($argv)) {
    require_once __DIR__ . '/../vendor/autoload.php';
    list($_, $projectId, $locationId) = $argv;
    quickstart_sample($projectId, $locationId);
}
