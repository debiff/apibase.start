<?php

namespace SB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SBUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
