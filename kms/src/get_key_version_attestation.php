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

// [START kms_get_key_version_attestation]
use Google\Cloud\Kms\V1\KeyManagementServiceClient;

function get_key_version_attestation_sample(
  $projectId = 'my-project',
  $locationId = 'us-east1',
  $keyRingId = 'my-key-ring',
  $keyId = 'my-key',
  $versionId = '123'
) {
    // Create the Cloud KMS client.
    $client = new KeyManagementServiceClient();

    // Build the key name.
    $keyVersionName = $client->cryptokeyVersionName($projectId, $locationId, $keyRingId, $keyId, $versionId);

    // Call the API.
    $version = $client->getCryptoKeyVersion($keyVersionName);

    // Only HSM keys have an attestation. For other key types, the attestion
    // will be NULL.
    $attestation = $version->getAttestation();
    if (!$attestation) {
        throw new Exception('no attestation');
    }

    printf('Got key attestation: %s' . PHP_EOL, $attestation->getContent());
    return $attestation;
}
// [END kms_get_key_version_attestation]

if (isset($argv)) {
    require_once __DIR__ . '/../vendor/autoload.php';
    list($_, $projectId, $locationId, $keyRingId, $keyId, $versionId) = $argv;
    get_key_version_attestation_sample($projectId, $locationId, $keyRingId, $keyId, $versionId);
}
