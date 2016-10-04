<?php

namespace OAuth2;

interface RequestInterface
{
    public function query($name, $default = NULL);

    public function request($name, $default = NULL);

    public function server($name, $default = NULL);

    public function headers($name, $default = NULL);

    public function getAllQueryParameters();
}
