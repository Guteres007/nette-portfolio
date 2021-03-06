<?php


namespace App\Modules\Admin\Secure;


class Authorizator implements \Nette\Security\Authorizator
{

    function isAllowed($role, $resource, $operation): bool
    {

        if ($role === 'admin') {
            return true;
        }
        if ($role === 'user' && $operation === 'create') {
            return true;
        }
        return false;
    }
}
