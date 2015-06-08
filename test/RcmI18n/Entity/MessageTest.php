<?php

namespace RcmI18nTest\RemoteLoader;

use RcmI18n\Entity\Message;

require __DIR__ . '/../../autoload.php';

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Message
     */
    protected $unit;

    /**
     * setup
     *
     * @return void
     */
    public function setup()
    {
        $this->unit = new Message();
    }

    /**
     * testSetGetMessage
     *
     * @return void
     */
    public function testSetGetMessage()
    {
        $value = 123;
        $this->unit->setMessageId($value);

        $this->assertEquals($value, $this->unit->getMessageId());
    }

    /**
     * @covers RcmI18n\Entity\Message
     */
    public function testSetGetKey()
    {
        $value = 'Bob';
        $this->unit->setDefaultText($value);
        $this->assertEquals($value, $this->unit->getDefaultText());
    }

    /**
     * @covers RcmI18n\Entity\Message
     */
    public function testSetGetLocale()
    {
        $value = 'en_US';
        $this->unit->setLocale($value);
        $this->assertEquals($value, $this->unit->getLocale());
    }

    /**
     * @covers RcmI18n\Entity\Message
     */
    public function testSetGetText()
    {
        $value = 'Bobinseo';
        $this->unit->setText($value);
        $this->assertEquals($value, $this->unit->getText());
    }

    /**
     * testSetGetMessage
     *
     * @return void
     */
    public function testDataMethods()
    {
        $value = 'TestText';
        $this->unit->setText($value);

        $this->assertInstanceOf(
            '\Traversable',
            $this->unit->getIterator()
        );

        $this->assertTrue(
            is_array(
                $this->unit->toArray()
            )
        );

        $this->assertEquals(
            $value,
            $this->unit->toArray()['text']
        );

        $this->assertTrue(is_array($this->unit->jsonSerialize()));
    }
}
