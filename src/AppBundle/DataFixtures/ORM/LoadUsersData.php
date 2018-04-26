<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 09/04/2018
 * Time: 16:26
 */

namespace AppBundle\DataFixtures\ORM;



use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadUsersData extends  AbstractFixture
{
    use ContainerAwareTrait;


    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager )
    {

        /**
         * set groups
         */
        $adminGroup = new Group();
        $writerGroup = new Group();

        $adminGroup->setRole('ROLE_ADMIN');
        $writerGroup->setRole('ROLE_WRITER');

        $manager->persist($adminGroup);
        $manager->persist($writerGroup);
            /**
             * set Users
            //         */
        $tomAdmin = new User();
        $tomAdmin->setFirstname('Thomas');
        $tomAdmin->setLastname('Brenard');
        $tomAdmin->setUsername('thomasbrenard@gmail.Com');
        $tomAdmin->setGroup($adminGroup);
        $encodedPassword = $this->encoder->encodePassword($tomAdmin, 'azerty');
        $tomAdmin->setPassword($encodedPassword);
        $tomAdmin->setActive(true);


        $manager->persist($tomAdmin);

        $mcWriter = new User();
        $mcWriter->setFirstname('Marie-Claire');
        $mcWriter->setLastname('Brenard');
        $mcWriter->setUsername('mc.tomasi@gmail.com');
        $mcWriter->setGroup($writerGroup);
        $encodedPassword = $this->encoder->encodePassword($mcWriter, 'azerty');
        $mcWriter->setPassword($encodedPassword);
        $mcWriter->setActive(true);



        $manager->persist($mcWriter);

        $manager->flush();

        $this->addReference('tom-admin', $tomAdmin);
        $this->addReference('prajana-validator', $mcWriter);



    }
}