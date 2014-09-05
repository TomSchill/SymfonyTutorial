<?php

namespace Opifer\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('article.blog')->count() > 0);

        $blogLink   = $crawler->filter('article.blog h2 a')->first();
        $blogTitle  = $blogLink->text();
        $crawler    = $client->click($blogLink->link());

        $this->assertEquals(1, $crawler->filter('h2:contains("' . $blogTitle .'")')->count());
    }

    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        $this->assertEquals(1, $crawler->filter('h1:contains("Contact Us!")')->count());



        $form = $crawler->selectButton('send')->form();

        $form['contact[name]']       = 'name';
        $form['contact[subject]']    = 'Subject';
        $form['contact[email]']      = 'email@email.com';
        $form['contact[body]']       = 'The comment body must be at least 50 characters long as there is a validation constrain on the Enquiry entity';

        $client->enableProfiler();

        $crawler = $client->submit($form);

        if ($profile = $client->getProfile())
        {
            $swiftMailerProfiler = $profile->getCollector('swiftmailer');

            $this->assertEquals(1, $swiftMailerProfiler->getMessageCount());

            $messages = $swiftMailerProfiler->getMessages();
            $message  = array_shift($messages);

            $blogEmail = $client->getContainer()->getParameter('opifer_blog.emails.contact_email');
            $this->assertArrayHasKey($blogEmail, $message->getTo());
        }

        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('.opifer-notice:contains("Your messege was sent successfully!")')->count());
    }
}
