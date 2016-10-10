<?php

namespace OAuth2\Storage;

use Aws\DynamoDb\DynamoDbClient;

use OAuth2\OpenID\Storage\UserClaimsInterface;
use OAuth2\OpenID\Storage\AuthorizationCodeInterface as OpenIDAuthorizationCodeInterface;
/**
 * DynamoDB storage for all storage types
 *
 * To use, install "aws/aws-sdk-php" via composer
 * <code>
 *  composer require aws/aws-sdk-php:dev-master
 * </code>
 *
 * Once this is done, instantiate the DynamoDB client
 * <code>
 *  $storage = new OAuth2\Storage\Dynamodb(array("key" => "YOURKEY", "secret" => "YOURSECRET", "region" => "YOURREGION"));
 * </code>
 *
 * Table :
 *  - oauth_access_tokens (primary hash key : access_token)
 *  - oauth_authorization_codes (primary hash key : authorization_code)
 *  - oauth_clients (primary hash key : client_id)
 *  - oauth_jwt (primary hash key : client_id, primary range key : subject)
 *  - oauth_public_keys (primary hash key : client_id)
 *  - oauth_refresh_tokens (primary hash key : refresh_token)
 *  - oauth_scopes (primary hash key : scope, secondary index : is_default-index hash key is_default)
 *  - oauth_users (primary hash key : username)
 *
 * @author Frederic AUGUSTE <frederic.auguste at gmail dot com>
 */
class DynamoDB implements
    AuthorizationCodeInterface,
    AccessTokenInterface,
    ClientCredentialsInterface,
    UserCredentialsInterface,
    RefreshTokenInterface,
    JwtBearerInterface,
    ScopeInterface,
    PublicKeyInterface,
    UserClaimsInterface,
    OpenIDAuthorizationCodeInterface
{
    protected $client;
    protected $config;

    public function __construct($connection, $config = array())
    {
        if (!($connection instanceof DynamoDbClient)) {
            if (!is_array($connection)) {
                throw new \InvalidArgumentException('First argument to OAuth2\Storage\Dynamodb must be an instance a configuration array containt key, secret, region');
            }
            if (!array_key_exists("key", $connection) || !array_key_exists("secret", $connection) || !array_key_exists("region", $connection) ) {
                throw new \InvalidArgumentException('First argument to OAuth2\Storage\Dynamodb must be an instance a configuration array containt key, secret, region');
            }
            $this->client = DynamoDbClient::factory(array(
                'key' => $connection["key"],
                'secret' => $connection["secret"],
                'region' =>$connection["region"]
            ));
        } else {
            $this->client = $connection;
        }

        $this->config = array_merge(array(
            'client_table' => 'oauth_clients',
            'access_token_table' => 'oauth_access_tokens',
            'refresh_token_table' => 'oauth_refresh_tokens',
            'code_table' => 'oauth_authorization_codes',
            'user_table' => 'oauth_users',
            'jwt_table'  => 'oauth_jwt',
            'scope_table'  => 'oauth_scopes',
            'public_key_table'  => 'oauth_public_keys',
        ), $config);
    }

    /* OAuth2\Storage\ClientCredentialsInterface */
    public function checkClientCredentials($client_id, $client_secret = NULL)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['client_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));

        return  $result->count()==1 && $result["Item"]["client_secret"]["S"] == $client_secret;
    }

    public function isPublicClient($client_id)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['client_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));

        if ($result->count()==0) {
            return FALSE ;
        }

        return empty($result["Item"]["client_secret"]);
    }

    /* OAuth2\Storage\ClientInterface */
    public function getClientDetails($client_id)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['client_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $result = $this->dynamo2array($result);
        foreach (array('client_id', 'client_secret', 'redirect_uri', 'grant_types', 'scope', 'user_id') as $key => $val) {
            if (!array_key_exists ($val, $result)) {
                $result[$val] = NULL;
            }
        }

        return $result;
    }

    public function setClientDetails($client_id, $client_secret = NULL, $redirect_uri = NULL, $grant_types = NULL, $scope = NULL, $user_id = NULL)
    {
        $clientData = compact('client_id', 'client_secret', 'redirect_uri', 'grant_types', 'scope', 'user_id');
        $clientData = array_filter($clientData, function ($value) { return !is_null($value);

        });

        $result = $this->client->putItem(array(
            'TableName' =>  $this->config['client_table'],
            'Item' => $this->client->formatAttributes($clientData)
        ));

        return TRUE;
    }

    public function checkRestrictedGrantType($client_id, $grant_type)
    {
        $details = $this->getClientDetails($client_id);
        if (isset($details['grant_types'])) {
            $grant_types = explode(' ', $details['grant_types']);

            return in_array($grant_type, (array) $grant_types);
        }

        // if grant_types are not defined, then none are restricted
        return TRUE;
    }

    /* OAuth2\Storage\AccessTokenInterface */
    public function getAccessToken($access_token)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['access_token_table'],
            "Key" => array('access_token'   => array('S' => $access_token))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);
        if (array_key_exists ('expires', $token)) {
            $token['expires'] = strtotime($token['expires']);
        }

        return $token;
    }

    public function setAccessToken($access_token, $client_id, $user_id, $expires, $scope = NULL)
    {
        // convert expires to datestring
        $expires = date('Y-m-d H:i:s', $expires);

        $clientData = compact('access_token', 'client_id', 'user_id', 'expires', 'scope');
        $clientData = array_filter($clientData, function ($value) { return !empty($value);

        });

        $result = $this->client->putItem(array(
            'TableName' =>  $this->config['access_token_table'],
            'Item' => $this->client->formatAttributes($clientData)
        ));

        return TRUE;

    }

    public function unsetAccessToken($access_token)
    {
        $result = $this->client->deleteItem(array(
            'TableName' =>  $this->config['access_token_table'],
            'Key' => $this->client->formatAttributes(array("access_token" => $access_token))
        ));

        return TRUE;
    }

    /* OAuth2\Storage\AuthorizationCodeInterface */
    public function getAuthorizationCode($code)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['code_table'],
            "Key" => array('authorization_code'   => array('S' => $code))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);
        if (!array_key_exists("id_token", $token )) {
            $token['id_token'] = NULL;
        }
        $token['expires'] = strtotime($token['expires']);

        return $token;

    }

    public function setAuthorizationCode($authorization_code, $client_id, $user_id, $redirect_uri, $expires, $scope = NULL, $id_token = NULL)
    {
        // convert expires to datestring
        $expires = date('Y-m-d H:i:s', $expires);

        $clientData = compact('authorization_code', 'client_id', 'user_id', 'redirect_uri', 'expires', 'id_token', 'scope');
        $clientData = array_filter($clientData, function ($value) { return !empty($value);

        });

        $result = $this->client->putItem(array(
            'TableName' =>  $this->config['code_table'],
            'Item' => $this->client->formatAttributes($clientData)
        ));

        return TRUE;
    }

    public function expireAuthorizationCode($code)
    {

        $result = $this->client->deleteItem(array(
            'TableName' =>  $this->config['code_table'],
            'Key' => $this->client->formatAttributes(array("authorization_code" => $code))
        ));

        return TRUE;
    }

    /* OAuth2\Storage\UserCredentialsInterface */
    public function checkUserCredentials($username, $password)
    {
        if ($user = $this->getUser($username)) {
            return $this->checkPassword($user, $password);
        }

        return FALSE;
    }

    public function getUserDetails($username)
    {
        return $this->getUser($username);
    }

    /* UserClaimsInterface */
    public function getUserClaims($user_id, $claims)
    {
        if (!$userDetails = $this->getUserDetails($user_id)) {
            return FALSE;
        }

        $claims = explode(' ', trim($claims));
        $userClaims = array();

        // for each requested claim, if the user has the claim, set it in the response
        $validClaims = explode(' ', self::VALID_CLAIMS);
        foreach ($validClaims as $validClaim) {
            if (in_array($validClaim, $claims)) {
                if ($validClaim == 'address') {
                    // address is an object with subfields
                    $userClaims['address'] = $this->getUserClaim($validClaim, $userDetails['address'] ?: $userDetails);
                } else {
                    $userClaims = array_merge($userClaims, $this->getUserClaim($validClaim, $userDetails));
                }
            }
        }

        return $userClaims;
    }

    protected function getUserClaim($claim, $userDetails)
    {
        $userClaims = array();
        $claimValuesString = constant(sprintf('self::%s_CLAIM_VALUES', strtoupper($claim)));
        $claimValues = explode(' ', $claimValuesString);

        foreach ($claimValues as $value) {
            if ($value == 'email_verified') {
                $userClaims[$value] = $userDetails[$value]=='true' ? TRUE : FALSE;
            } else {
                $userClaims[$value] = isset($userDetails[$value]) ? $userDetails[$value] : NULL;
            }
        }

        return $userClaims;
    }

    /* OAuth2\Storage\RefreshTokenInterface */
    public function getRefreshToken($refresh_token)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['refresh_token_table'],
            "Key" => array('refresh_token'   => array('S' => $refresh_token))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);
        $token['expires'] = strtotime($token['expires']);

        return $token;
    }

    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = NULL)
    {
        // convert expires to datestring
        $expires = date('Y-m-d H:i:s', $expires);

        $clientData = compact('refresh_token', 'client_id', 'user_id', 'expires', 'scope');
        $clientData = array_filter($clientData, function ($value) { return !empty($value);

        });

        $result = $this->client->putItem(array(
            'TableName' =>  $this->config['refresh_token_table'],
            'Item' => $this->client->formatAttributes($clientData)
        ));

        return TRUE;
    }

    public function unsetRefreshToken($refresh_token)
    {
        $result = $this->client->deleteItem(array(
            'TableName' =>  $this->config['refresh_token_table'],
            'Key' => $this->client->formatAttributes(array("refresh_token" => $refresh_token))
        ));

        return TRUE;
    }

    // plaintext passwords are bad!  Override this for your application
    protected function checkPassword($user, $password)
    {
        return $user['password'] == sha1($password);
    }

    public function getUser($username)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['user_table'],
            "Key" => array('username'   => array('S' => $username))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);
        $token['user_id'] = $username;

        return $token;
    }

    public function setUser($username, $password, $first_name = NULL, $last_name = NULL)
    {
        // do not store in plaintext
        $password = sha1($password);

        $clientData = compact('username', 'password', 'first_name', 'last_name');
        $clientData = array_filter($clientData, function ($value) { return !is_null($value);

        });

        $result = $this->client->putItem(array(
            'TableName' =>  $this->config['user_table'],
            'Item' => $this->client->formatAttributes($clientData)
        ));

        return TRUE;

    }

    /* ScopeInterface */
    public function scopeExists($scope)
    {
        $scope = explode(' ', $scope);
        $scope_query = array();
        $count = 0;
        foreach ($scope as $key => $val) {
            $result = $this->client->query(array(
                'TableName'     => $this->config['scope_table'],
                'Select'        => 'COUNT',
                'KeyConditions' => array(
                    'scope' => array(
                        'AttributeValueList' => array(array('S' => $val)),
                        'ComparisonOperator' => 'EQ'
                    )
                )
            ));
            $count += $result['Count'];
        }

        return $count == count($scope);
    }

    public function getDefaultScope($client_id = NULL)
    {

        $result = $this->client->query(array(
            'TableName' => $this->config['scope_table'],
            'IndexName' => 'is_default-index',
            'Select' => 'ALL_ATTRIBUTES',
            'KeyConditions' => array(
                'is_default' => array(
                    'AttributeValueList' => array(array('S' => 'true')),
                    'ComparisonOperator' => 'EQ',
                ),
            )
        ));
        $defaultScope = array();
        if ($result->count() > 0) {
            $array = $result->toArray();
            foreach ($array["Items"] as $item) {
                $defaultScope[]  = $item['scope']['S'];
            }

            return empty($defaultScope) ? NULL : implode(' ', $defaultScope);
        }

        return NULL;
    }

    /* JWTBearerInterface */
    public function getClientKey($client_id, $subject)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['jwt_table'],
            "Key" => array('client_id'   => array('S' => $client_id), 'subject' => array('S' => $subject))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);

        return $token['public_key'];
    }

    public function getClientScope($client_id)
    {
        if (!$clientDetails = $this->getClientDetails($client_id)) {
            return FALSE;
        }

        if (isset($clientDetails['scope'])) {
            return $clientDetails['scope'];
        }

        return NULL;
    }

    public function getJti($client_id, $subject, $audience, $expires, $jti)
    {
        //TODO not use.
    }

    public function setJti($client_id, $subject, $audience, $expires, $jti)
    {
        //TODO not use.
    }

    /* PublicKeyInterface */
    public function getPublicKey($client_id = '0')
    {

        $result = $this->client->getItem(array(
            "TableName"=> $this->config['public_key_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);

        return $token['public_key'];

    }

    public function getPrivateKey($client_id = '0')
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['public_key_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));
        if ($result->count()==0) {
            return FALSE ;
        }
        $token = $this->dynamo2array($result);

        return $token['private_key'];
    }

    public function getEncryptionAlgorithm($client_id = NULL)
    {
        $result = $this->client->getItem(array(
            "TableName"=> $this->config['public_key_table'],
            "Key" => array('client_id'   => array('S' => $client_id))
        ));
        if ($result->count()==0) {
            return 'RS256' ;
        }
        $token = $this->dynamo2array($result);

        return $token['encryption_algorithm'];
    }

    /**
     * Transform dynamodb resultset to an array.
     * @param $dynamodbResult
     * @return $array
     */
    private function dynamo2array($dynamodbResult)
    {
        $result = array();
        foreach ($dynamodbResult["Item"] as $key => $val) {
            $result[$key] = $val["S"];
            $result[] = $val["S"];
        }

        return $result;
    }
}
