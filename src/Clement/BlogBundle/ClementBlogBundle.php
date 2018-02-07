<?php

namespace Clement\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ClementBlogBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
