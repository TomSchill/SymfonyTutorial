<?php

namespace Opifer\BlogBundle\Controller;

use Opifer\BlogBundle\Entity\Comment;
use Opifer\BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function newAction($blog_id)
    {
        $blog = $this->getBlogFromDB($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);
        $form = $this->createForm(new CommentType(), $comment);

        return $this->render('OpiferBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    public function createAction($blog_id, Request $request)
    {
        $blog = $this->getBlogFromDB($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(new CommentType(), $comment);
        $form->submit($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('opifer_blog_show', array(
                    'slug' => $comment->getBlog()->getSlug())) .
                                   '#comment-' . $comment->getId()
            );
        }

        return $this->render('OpiferBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getBlogFromDB($blog_id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('OpiferBlogBundle:Blog')->find($blog_id);

        if(!$blog)
        {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }


}
