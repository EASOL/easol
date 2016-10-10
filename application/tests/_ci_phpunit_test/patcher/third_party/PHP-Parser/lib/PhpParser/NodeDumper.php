<?php

namespace PhpParser;

class NodeDumper
{
    /**
     * Dumps a node or array.
     *
     * @param array|Node $node Node or array to dump
     *
     * @return string Dumped value
     */
    public function dump($node) 
    {
        if ($node instanceof Node) {
            $r = $node->getType() . '(';

            foreach ($node->getSubNodeNames() as $key) {
                $r .= "\n    " . $key . ': ';

                $value = $node->$key;
                if (NULL === $value) {
                    $r .= 'null';
                } elseif (FALSE === $value) {
                    $r .= 'false';
                } elseif (TRUE === $value) {
                    $r .= 'true';
                } elseif (is_scalar($value)) {
                    $r .= $value;
                } else {
                    $r .= str_replace("\n", "\n    ", $this->dump($value));
                }
            }
        } elseif (is_array($node)) {
            $r = 'array(';

            foreach ($node as $key => $value) {
                $r .= "\n    " . $key . ': ';

                if (NULL === $value) {
                    $r .= 'null';
                } elseif (FALSE === $value) {
                    $r .= 'false';
                } elseif (TRUE === $value) {
                    $r .= 'true';
                } elseif (is_scalar($value)) {
                    $r .= $value;
                } else {
                    $r .= str_replace("\n", "\n    ", $this->dump($value));
                }
            }
        } else {
            throw new \InvalidArgumentException('Can only dump nodes and arrays.');
        }

        return $r . "\n)";
    }
}
