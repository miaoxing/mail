<?php

namespace Miaoxing\Mail\Service;

class Mail extends \Miaoxing\Plugin\BaseService
{
    /**
     * PHPMailer的配置
     *
     * @var array
     */
    protected $options = [];

    /**
     * 创建一个邮件对象
     *
     * @param string $className
     * @param array $options
     * @return \Miaoxing\Mail\Base
     */
    public function create($className, array $options = [])
    {
        return new $className(['wei' => $this->wei] + $options + $this->options);
    }

    /**
     * 创建一个邮件对象并发送
     *
     * @param string $className
     * @param array $options
     * @return array
     */
    public function send($className, array $options = [])
    {
        return $this->create($className, $options)->send();
    }
}
