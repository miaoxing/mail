<?php

namespace Miaoxing\Mail;

use PHPMailer;
use Miaoxing\Plugin\Service\OptionTrait;
use Miaoxing\Plugin\Service\ServiceTrait;

/**
 * @property \Wei\Logger $logger
 * @property \Wei\View $view
 * @property \wei\Url $url
 */
abstract class Base extends PHPMailer
{
    use OptionTrait;
    use ServiceTrait;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = [])
    {
        parent::__construct(false);
        $this->setOption($options);
    }

    /**
     * 准备邮件内容并发送邮件
     *
     * @return array
     */
    public function send()
    {
        // 1. 准备内容
        $ret = $this->prepare();
        if ($ret && $ret['code'] !== 1) {
            return $ret;
        }

        // 2. 调用发送程序
        $result = parent::send();
        // @codingStandardsIgnoreLine
        $errorInfo = $this->ErrorInfo;

        if (!$result) {
            $errors = $this->smtp ? $this->smtp->getError() : [];
            $this->logger->alert($errorInfo, $errors);
        }

        return $result ?
            ['code' => 1, 'message' => '发送成功'] :
            ['code' => -1, 'message' => $errorInfo];
    }

    /**
     * @codingStandardsIgnoreLine
     * 准备发送邮件的内容,如收件人,发信内容
     *
     * @return array
     */
    abstract protected function prepare();

    /**
     * 生成随机字符数字串
     * @param int $length
     * @return string
     */
    public function generateNonceStr($length = 32)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        return $str;
    }
}
