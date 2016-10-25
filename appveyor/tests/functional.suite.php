<?php

$contents = file_get_contents("tests/functional.suite.template.yml");
$contents = str_replace("{{test-key}}", $_ENV['CI_TEST_KEY'], $contents);

file_put_contents('tests/functional.suite.yml', $contents);