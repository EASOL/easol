<?php

namespace OAuth2;

/**
 * Interface which represents an object response.  Meant to handle and display the proper OAuth2 Responses
 * for errors and successes
 *
 * @see OAuth2\Response
 */
interface ResponseInterface
{
    public function addParameters(array $parameters);

    public function addHttpHeaders(array $httpHeaders);

    public function setStatusCode($statusCode);

    public function setError($statusCode, $name, $description = NULL, $uri = NULL);

    public function setRedirect($statusCode, $url, $state = NULL, $error = NULL, $errorDescription = NULL, $errorUri = NULL);

    public function getParameter($name);
}
