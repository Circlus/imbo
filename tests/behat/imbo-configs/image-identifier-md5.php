<?php
/**
 * This file is part of the Imbo package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

/**
 * Enable the md5 image identifier generator
 */
return [
    'imageIdentifierGenerator' => function() {
        return new Imbo\Image\Identifier\Generator\Md5();
    }
];
