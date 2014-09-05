<?php namespace Opifer\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Opifer\BlogBundle\Entity\Blog;
use Opifer\BlogBundle\Entity\Comment;

class CommentFixtures extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setUser('WebSiteUser1');
        $comment1->setComment('I am a website user commenting on your blogpost!!');
        $comment1->setApproved(true);
        $comment1->setBlog($manager->merge($this->getReference('firstPost')));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setUser('WebSiteUser2');
        $comment2->setComment('I am another website user commenting on your blogpost!! I hope you find this repitition not too iritating!');
        $comment2->setApproved(true);
        $comment2->setBlog($manager->merge($this->getReference('firstPost')));
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setUser('WebSiteUser3');
        $comment3->setComment('I am another website user comenting on your second blogpost!');
        $comment3->setApproved(true);
        $comment3->setBlog($manager->merge($this->getReference('secondPost')));
        $manager->persist($comment3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
} 