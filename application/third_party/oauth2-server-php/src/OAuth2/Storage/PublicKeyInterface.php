<?php

namespace OAuth2\Storage;

/**
 * Implement this interface to specify where the OAuth2 Server
 * should get public/private key information
 *
 * @author Brent Shaffer <bshafs at gmail dot com>
 */
interface PublicKeyInterface
{
    public function getPublicKey($client_id = NULL);
    public function getPrivateKey($client_id = NULL);
    public function getEncryptionAlgorithm($client_id = NULL);
}
