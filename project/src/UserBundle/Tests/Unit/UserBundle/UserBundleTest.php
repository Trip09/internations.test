<?php

namespace Tests\UserBundle;

use PHPUnit\Framework\TestCase;
use UserBundle\UserBundle;

class UserBundleTest extends TestCase
{
    public function testGetParent()
    {
        $appExtension = new UserBundle();
        $this->assertEquals($appExtension->getParent(), 'SonataUserBundle');
    }
}
