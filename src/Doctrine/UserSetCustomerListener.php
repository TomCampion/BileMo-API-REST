<?php


namespace App\Doctrine;


use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class UserSetCustomerListener
{

    /**
     * Security $security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(User $user){
        if($user->getCustomer()){
            return;
        }

        if($this->security->getUser() ){
            $user->setCustomer($this->security->getUser());
        }
    }
}