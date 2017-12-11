<?php
/*
 * This file is part of the DSYNC PHP SDK package.
 *
 * (c) DSYNC <support@dsync.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dsync\PhpSdk\Utils\Generator;

use Exception;

/**
 * Class Endpoint
 *
 * @package Dsync\PhpSdk\Utils\Generator
 */
class Endpoint
{

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $treekey;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * @var string
     */
    protected $entityToken;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param string $entityName
     *
     * @return $this
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;

        return $this;
    }

    /**
     * @param string $treekey
     *
     * @return $this
     */
    public function setTreekey($treekey)
    {
        $this->treekey = $treekey;

        return $this;
    }

    /**
     * @param string $endpointUrl
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @param string $entityToken
     *
     * @return $this
     */
    public function setEntityToken($entityToken)
    {
        $this->entityToken = $entityToken;

        return $this;
    }

    /**
     * @param Field $field
     *
     * @return $this
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return $this
     * @throws Exception
     */
    public function addFields(array $fields)
    {
        foreach ($fields as $field) {
            if (!$field instanceof Field) {
                throw new Exception(
                    'Invalid type, should be type Field.'
                );
            }
            $this->fields[] = $field;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function generate()
    {
        $this->validate();

        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->generate();
        }

        return [
            'entity_name' => $this->entityName,
            'treekey' => $this->treekey,
            'endpoint_url' => $this->endpointUrl,
            'entity_token' => $this->entityToken,
            'fields' => $fields,
        ];
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        $error = null;

        if (!$this->treekey) {
            $error .= 'Treekey is required for this endpoint. ';
        }

        if (!$this->entityName) {
            $error .= 'Entity name is required. ';
        }

        if (!$this->endpointUrl) {
            $error .= 'The endpoint url is required. ';
        }

        if (!$this->entityToken) {
            $error .= 'The entity token is required. ';
        }

        if ($error) {
            throw new Exception($error);
        }
    }
}
