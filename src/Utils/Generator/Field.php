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
 * Class Field
 *
 * @package Dsync\PhpSdk\Utils\Generator
 */
class Field
{
    const TYPE_TEXT     = 'text';
    const TYPE_NUMBER   = 'number';
    const TYPE_URL      = 'url';
    const TYPE_EMAIL    = 'email';
    const TYPE_DATE     = 'date';
    const TYPE_TIME     = 'time';
    const TYPE_DATETIME = 'datetime';
    const TYPE_BOOLEAN  = 'boolean';
    const TYPE_OBJECT   = 'object';
    const TYPE_MATH     = 'math';
    const TYPE_CUSTOM   = 'custom';

    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $treekey;

    /**
     * @var string|null
     */
    protected $value;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var string|null
     */
    protected $dateFormat;

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var array
     */
    protected $functions = [];

    /**
     * @var bool
     */
    protected $primaryKey = false;

    /**
     * @var string|null
     */
    protected $foreignKey;

    /**
     * @var string|null
     */
    protected $boolSettings;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param bool $multiple
     *
     * @return $this
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * @param string $dateFormat
     *
     * @return $this
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    /**
     * @param bool $required
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @param array $functions
     *
     * @return $this
     */
    public function setFunctions(array $functions)
    {
        $this->functions = $functions;

        return $this;
    }

    /**
     * @param bool $primaryKey
     *
     * @return $this
     */
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }

    /**
     * @param string $foreignKey
     *
     * @return $this
     */
    public function setForeignKey($foreignKey)
    {
        $this->foreignKey = $foreignKey;

        return $this;
    }

    /**
     * @param string $boolSettings
     *
     * @return $this
     */
    public function setBoolSettings($boolSettings)
    {
        $this->boolSettings = $boolSettings;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return array
     */
    public function generate()
    {
        $this->validate();

        return [
            'id' => $this->id,
            'treekey' => $this->treekey,
            'value' => $this->value,
            'type' => $this->type,
            'multiple' => $this->multiple,
            'date_format' => $this->dateFormat,
            'required' => $this->required,
            'functions' => $this->functions,
            'primary_key' => $this->primaryKey,
            'foreign_key' => $this->foreignKey,
            'bool_settings' => $this->boolSettings,
            'name' => $this->name,
            'description' => $this->description
        ];
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        $error = null;

        if (!$this->treekey) {
            $error .= 'Treekey is required for this field. ';
        }

        if (!$this->type) {
            $error .= 'Field type is required. ';
        }

        if (!$this->name) {
            $error .= 'Name of field is required. ';
        }

        if ($error) {
            throw new Exception($error);
        }
    }
}
