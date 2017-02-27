<?php

namespace MiaoxingTest\Mail\Fixture;

use Miaoxing\Mail\Base;
use Wei\RetTrait;

class Register extends Base
{
    use RetTrait;

    /**
     * {@inheritdoc}
     */
    protected function prepare()
    {
        // send register email
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        // process send

        return $this->suc('sent!');
    }
}
