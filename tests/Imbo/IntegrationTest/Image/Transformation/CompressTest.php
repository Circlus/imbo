<?php
/**
 * This file is part of the Imbo package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\IntegrationTest\Image\Transformation;

use Imbo\Image\Transformation\Compress,
    Imagick;

/**
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Test suite\Integration tests
 * @covers Imbo\Image\Transformation\Compress
 * @group integration
 */
class CompressTest extends TransformationTests {
    /**
     * {@inheritdoc}
     */
    protected function getTransformation() {
        return new Compress();
    }

    /**
     * @expectedException Imbo\Exception\TransformationException
     * @expectedExceptionMessage Missing required parameter: quality
     * @expectedExceptionCode 400
     */
    public function testThrowsExceptionOnMissingParam() {
        $event = $this->getMock('Imbo\EventManager\Event');
        $event->expects($this->once())->method('getArgument')->with('params')->will($this->returnValue(array()));
        $this->getTransformation()->transform($event);
    }

    public function testCanTransformTheImage() {
        $image = $this->getMock('Imbo\Model\Image');
        $image->expects($this->once())->method('hasBeenTransformed')->with(true);

        $event = $this->getMock('Imbo\EventManager\Event');
        $event->expects($this->at(0))->method('getArgument')->with('params')->will($this->returnValue(array('quality' => 50)));
        $event->expects($this->at(1))->method('getArgument')->with('image')->will($this->returnValue($image));

        $imagick = new Imagick();
        $imagick->readImageBlob(file_get_contents(FIXTURES_DIR . '/image.png'));

        $this->getTransformation()->setImagick($imagick)->transform($event);
    }
}
