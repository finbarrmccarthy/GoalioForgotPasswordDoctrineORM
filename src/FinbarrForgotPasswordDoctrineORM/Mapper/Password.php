<?php

namespace FinbarrForgotPasswordDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use FinbarrForgotPassword\Mapper\Password as FinbarrPasswordMapper;
use FinbarrForgotPassword\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Password extends FinbarrPasswordMapper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \FinbarrForgotPassword\Options\ModuleOptions
     */
    protected $options;

    public function __construct(EntityManager $em, ModuleOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    public function remove($passwordModel)
    {
        $this->em->remove($passwordModel);
        $this->em->flush();
    }

    public function findByUser($userId)
    {
        $er = $this->em->getRepository($this->options->getPasswordEntityClass());

        return $er->findOneBy(array('user_id' => $userId));
    }

    public function findByUserIdRequestKey($userId, $key)
    {
        $er = $this->em->getRepository($this->options->getPasswordEntityClass());
        return $er->findOneBy(array('user_id' => $userId, 'requestKey' => $key));
    }

    public function cleanExpiredForgotRequests($expiryTime=86400)
    {

    }

    public function cleanPriorForgotRequests($userId)
    {
        $dql = sprintf("DELETE %s u WHERE u.user_id = '%s'", $this->options->getPasswordEntityClass(), $userId);
        $query = $this->em->createQuery($dql);
        $query->getResult();
    }

    public function persist($passwordModel)
    {
        $this->em->persist($passwordModel);
        $this->em->flush();

        return $passwordModel;
    }

}