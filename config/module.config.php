<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'finbarrforgotpassword_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/finbarrforgotpassword'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'FinbarrForgotPassword\Entity'  => 'finbarrforgotpassword_entity'
                )
            )
        )
    ),
);
