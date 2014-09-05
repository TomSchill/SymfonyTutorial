<?php

namespace Opifer\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testAddComment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/my-first-blogpost');

        $this->assertEquals(1, $crawler->filter('h2:contains("My first BlogPost")')->count());

        $form = $crawler->selectButton('Submit')->form();
        $crawler = $client->submit($form, array(
            'opifer_blogbundle_comment[user]' => 'name',
            'opifer_blogbundle_comment[comment]' => 'comment',
        ));

        $crawler = $client->followRedirect();

        $articleCrawler = $crawler->filter('section .previous-comments article')->last();

        $this->assertEquals('name', $articleCrawler->filter('header span.highlight')->text());
        $this->assertEquals('comment', $articleCrawler->filter('p')->last()->text());
    }

}
