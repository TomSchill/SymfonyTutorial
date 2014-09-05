<?php namespace Opifer\BlogBundle\Tests\Entity;

use Opifer\BlogBundle\Entity\Blog;
use Opifer\BlogBundle\Entity\Comment;
use Symfony\Component\Yaml\Tests\B;

class BlogTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the createSlug method.
     */
    public function testCreateSlug()
    {
        $blog = new Blog();

        $this->assertEquals('hello-world', $blog->createSlug('Hello World!'));
        $this->assertNotEquals('a false slug', $blog->createSlug("A false SLuGG"));
        $this->assertEquals('a-good-slug', $blog->createSlug("A GOOD SLuG"));
        $this->assertEquals('without-trailing-spaces', $blog->createSlug('Without trailing spaces '));

    }

    /**
     * Test the setSlug method.
     * This tests if the setSlug method transforms the title correctly
     */
    public function testSetSlug()
    {
        $blog = new Blog();

        $blog->setSlug('Test setSlug Method');
        $this->assertEquals('test-setslug-method', $blog->getSlug());
    }

    /**
     * Test the setTitle method to pass the title correctly to
     * the setSlug method which transforms it to a slug.
     */
    public function testSetTitle()
    {
        $blog = new Blog();

        $blog->setTitle('Test setTitle method');
        $this->assertEquals('test-settitle-method', $blog->getSlug());

    }

    /**
     * test setAuthor method
     */
    public function testSetAuthor()
    {
        $blog = new Blog();

        $blog->setAuthor('Tom');
        $this->assertEquals('Tom', $blog->getAuthor());

        $blog->setAuthor('Opifer');
        $this->assertEquals('Opifer', $blog->getAuthor());
    }

    /**
     * Test the setBlog and getBlog methods.
     * The getBlog accepts a number.
     * getBlog returns the ammount of characters specified.
     */
    public function testSetBlog()
    {
        $blog = new Blog();
        $string = "Dit is een test blog!"; # 21 characters in length.

        $blog->setBlog($string);
        $this->assertEquals($string, $blog->getBlog());

        $blog->setBlog($string);
        $this->assertEquals('Dit i', $blog->getBlog(5));

        $blog->setBlog($string);
        $this->assertEquals('Dit', $blog->getBlog(3));

        $blog->setBlog($string);
        $this->assertEquals('Dit is een', $blog->getBlog(10));
    }

    public function testSetTags()
    {
        $blog = new Blog();

        $tags = 'php, html, phpunit';
        $blog->setTags($tags);

        $this->assertEquals($tags, $blog->getTags());
    }

    public function testSetComments()
    {
        $blog = new Blog();

        $comment = 'Hallo dit is een comment voor een test';
        $blog->setComments($comment);

        $this->assertEquals($comment, $blog->getComments());
    }

    public function testSetImage()
    {
        $blog = new Blog();

        $image = 'image.png';
        $blog->setImage($image);

        $this->assertEquals($image, $blog->getImage());
    }
} 