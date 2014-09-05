<?php namespace Opifer\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Opifer\BlogBundle\Entity\Blog;

class BlogFixtures extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $firstPost = new Blog();
        $firstPost->setTitle('My first BlogPost');
        $firstPost->setAuthor('Tom Schillemans');
        $firstPost->setBlog('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $firstPost->setTags('symfony2.5, php, cool, opifer, doctrine fixtures');
        $firstPost->setImage('firstImage.png');
        $firstPost->setCreated(new \DateTime());
        $firstPost->setUpdated($firstPost->getCreated());
        $manager->persist($firstPost);

        $secondPost = new Blog();
        $secondPost->setTitle('My Second BlogPost');
        $secondPost->setAuthor('Tom Schillemans');
        $secondPost->setBlog('Lorem ipsum dolor sit amet. \nLorem ipsum dolor sit amet, consectetur adipiscing elit.');
        $secondPost->setTags('symfony2.5, second post, opifer, repeating');
        $secondPost->setImage('secondImage.jpg');
        $secondPost->setCreated(new \DateTime());
        $secondPost->setUpdated($secondPost->getCreated());
        $manager->persist($secondPost);

        $manager->flush();

        # References to be used by the CommentFixtures
        $this->addReference('firstPost', $firstPost);
        $this->addReference('secondPost', $secondPost);
    }

    public function getOrder()
    {
        return 1;
    }
} 