<?php
/**
 * This file is part of the prooph/annotations package.
 * (c) 2017 Michiel Rook <mrook@php.net>
 * (c) 2017 prooph software GmbH <contact@prooph.de>
 * (c) 2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ProophTest\Annotation;

use PHPUnit\Framework\TestCase;
use Prooph\Annotation\AnnotatedHandlerInvoker;
use Prooph\Common\Messaging\Message;

class AnnotatedHandlerInvokerTest extends TestCase
{
    public function testShouldInvokeTarget()
    {
        $delegate = new class() {
            public function handle(Message $message)
            {
                return 'handler';
            }
        };

        $invoker = new AnnotatedHandlerInvoker($delegate, new \ReflectionMethod($delegate, 'handle'));
        static::assertEquals('handler', $invoker($this->getMockBuilder(Message::class)->getMock()));
    }
}
