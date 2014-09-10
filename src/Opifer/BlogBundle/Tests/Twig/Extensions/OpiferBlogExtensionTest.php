<?php namespace Opifer\BlogBundle\Tests\Twig\Extensions;



use Opifer\BlogBundle\Twig\Extensions\OpiferBlogExtension;

class OpiferBlogExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected function getDateTime($delta)
    {
        return new \DateTime(date("Y-m-d H:i:s", time()+$delta));
    }

    public function testCreatedAgo()
    {
        $blog = new OpiferBlogExtension();

        $this->assertEquals('Just now', $blog->createdAgo(new \DateTime()));
        $this->assertEquals('Just now', $blog->createdAgo($this->getDateTime(-34)));
        $this->assertEquals('1 minute ago', $blog->createdAgo($this->getDateTime(-60)));
        $this->assertEquals('2 minutes ago', $blog->createdAgo($this->getDateTime(-120)));
        $this->assertEquals('1 hour ago', $blog->createdAgo($this->getDateTime(-3600)));
        $this->assertEquals('1 hour ago', $blog->createdAgo($this->getDateTime(-3601)));
        $this->assertEquals('2 hours ago', $blog->createdAgo($this->getDateTime(-7200)));
        $this->assertEquals('1 day ago', $blog->createdAgo($this->getDateTime(-86400)));
        $this->assertEquals('2 days ago', $blog->createdAgo($this->getDateTime(-172800)));
        $this->assertEquals('1 month ago', $blog->createdAgo($this->getDateTime(-2629743.83)));
        $this->assertEquals('1 year ago', $blog->createdAgo($this->getDateTime(-31556926)));
    }
} 