<?php
/**
 * This file is part of the Imbo package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboIntegrationTest\Image\Transformation;

use Imbo\Image\Transformation\Rotate,
    Imagick;

/**
 * @covers Imbo\Image\Transformation\Rotate
 * @group integration
 * @group transformations
 */
class RotateTest extends TransformationTests {
    /**
     * {@inheritdoc}
     */
    protected function getTransformation() {
        return new Rotate();
    }

    public function getRotateParams() {
        return [
            '90 angle' => [90, 463, 665],
            '180 angle' => [180, 665, 463],
        ];
    }

    /**
     * @dataProvider getRotateParams
     * @covers Imbo\Image\Transformation\Rotate::transform
     */
    public function testCanTransformImage($angle, $width, $height) {
        $image = $this->getMock('Imbo\Model\Image');

        $image->expects($this->once())->method('setWidth')->with($width)->will($this->returnValue($image));
        $image->expects($this->once())->method('setHeight')->with($height)->will($this->returnValue($image));
        $image->expects($this->once())->method('hasBeenTransformed')->with(true)->will($this->returnValue($image));

        $event = $this->getMock('Imbo\EventManager\Event');
        $event->expects($this->at(0))->method('getArgument')->with('image')->will($this->returnValue($image));
        $event->expects($this->at(1))->method('getArgument')->with('params')->will($this->returnValue([
            'angle' => $angle,
            'bg' => 'fff',
        ]));

        $imagick = new Imagick();
        $imagick->readImageBlob(file_get_contents(FIXTURES_DIR . '/image.png'));

        $this->getTransformation()->setImagick($imagick)->transform($event);
    }
}
