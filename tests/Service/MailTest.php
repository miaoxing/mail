<?php

namespace MiaoxingTest\Mail\Service;

use Miaoxing\Mail\Base;
use Miaoxing\Plugin\Test\BaseTestCase;
use MiaoxingTest\Mail\Fixture\Register;

/**
 * 邮件服务
 */
class MailTest extends BaseTestCase
{
    /**
     * 创建邮件对象
     */
    public function testCreate()
    {
        $mail = wei()->mail->create(Register::className());

        $this->assertInstanceOf(Base::className(), $mail);
    }

    /**
     * 调用发送接口
     */
    public function testSend()
    {
        $ret = wei()->mail->send(Register::className());

        $this->assertRetSuc($ret, 'sent!');
    }
}
