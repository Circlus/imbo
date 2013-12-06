<?php
/**
 * This file is part of the Imbo package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\UnitTest\Http\Response\Formatter;

use Imbo\Http\Response\Formatter\JSON;

/**
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Test suite\Unit tests
 * @group unit
 */
class FormatterTest extends \PHPUnit_Framework_TestCase {
    /**
     * @covers Imbo\Http\Response\Formatter\Formatter::format
     * @expectedException Imbo\Exception\InvalidArgumentException
     * @expectedExceptionMessage Unsupported model type
     * @expectedExceptionCode 500
     */
    public function testThrowsExceptionWhenModelIsNotSupported() {
        $formatter = new JSON($this->getMock('Imbo\Helpers\DateFormatter'));
        $formatter->format($this->getMock('Imbo\Model\ModelInterface'));
    }
}
