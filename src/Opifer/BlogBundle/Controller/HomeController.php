<?php namespace Opifer\BlogBundle\Controller;

use Opifer\BlogBundle\Entity\Enquiry;
use Opifer\BlogBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('OpiferBlogBundle:Blog')
            ->getLatestBlogs();

        return $this->render('OpiferBlogBundle:Home:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enquiry);
            $em->flush();

            $messege = \Swift_Message::newInstance()
                ->setSubject($enquiry->getSubject())
                ->setFrom($enquiry->getEmail())
                ->setTo($this->container->getParameter('opifer_blog.emails.contact_email'))
                ->setBody($this->renderView('OpiferBlogBundle:Page:contactEmail.txt.twig', array(
                    'enquiry' => $enquiry,
                    'name'    => $enquiry->getName()
                )));
            $send = $this->get('mailer')->send($messege);

            if($send)
                $this->get('session')->getFlashBag()->add('notice-ok', 'Your messege was sent successfully!');
            else
                $this->get('session')->getFlashBag()->add('notice-er', 'Your messege was not sent successfully!');

            return $this->redirect($this->generateUrl('opifer_blog_index'));
        }


        return $this->render('OpiferBlogBundle:Home:contact.html.twig', array('form' => $form->createView()));
    }

    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('OpiferBlogBundle:Blog')->getBlogPostBySlug($slug);

        if(!$blog)
        {
            throw $this->createNotFoundException('Was unable to find a blogpost with the slug: ' . $slug);
        }


        $comments = $em->getRepository('OpiferBlogBundle:Comment')
            ->getCommentsForBlog($blog->getId());

//        $blogSlugComplete = '/blog/'.$blog->getSlug();
//        $comments = $this->get('knp_disqus.request')->fetch('SymfonyTest', array(
//            'identifier' => $blogSlugComplete,
//            'limit'      => 10, // Default limit is set to max. value for Disqus (100 entries)
//        ));

        return $this->render('OpiferBlogBundle:Home:show.html.twig', array(
            'blog'     => $blog,
            'comments' => $comments
        ));
    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('OpiferBlogBundle:Blog')->getTags();
        $tagWeights = $em->getRepository('OpiferBlogBundle:Blog')->getTagWeights($tags);

        $commentLimit = $this->container->getParameter('opifer_blog.comments.latest_comment_limit');
        $latestComments = $em->getRepository('OpiferBlogBundle:Comment')->getLatestComments($commentLimit);

        return $this->render('OpiferBlogBundle:Home:sidebar.html.twig', array(
            'tags' => $tagWeights,
            'latestComments' => $latestComments
        ));
    }
}
