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

/**
 * Class EntityToken
 *
 * @package Dsync\PhpSdk\Utils\Generator
 */
class EntityToken
{

    /**
     * @param string $entityName
     *
     * @return string
     */
    public function generateEntityToken($entityName)
    {
        return str_replace(' ', '', 'php-sdk-' . strtolower($entityName) . '-' . md5(microtime()));
    }
}
