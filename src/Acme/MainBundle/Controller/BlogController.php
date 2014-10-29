<?php

namespace Acme\MainBundle\Controller;

use Acme\MainBundle\Entity\Comment;
use Acme\MainBundle\Entity\Post;
use Acme\MainBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function indexAction()
    {
        /** @var \Acme\MainBundle\Entity\PostRepository $postRepository */
        $postRepository = $this->getDoctrine()->getRepository('AcmeMainBundle:Post');
        $posts = $postRepository->getAll();

        return $this->render('AcmeMainBundle:Blog:index.html.twig', [
            'posts' => $posts,
            'featured' => current($posts)
        ]);
    }

    public function showAction(Request $request, Post $post)
    {
        /** @var \Acme\MainBundle\Entity\PostRepository $postRepository */
        $postRepository = $this->getDoctrine()->getRepository('AcmeMainBundle:Post');

        $older = $postRepository->getById($post->getId() - 1);
        $newer = $postRepository->getById($post->getId() + 1);

        $comment = new Comment();
        $form = $this->createForm('comment', $comment);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $comment = $form->getData();
                $comment->setPost($post);
                $postRepository->save($comment);
            }
        }

        return $this->render('AcmeMainBundle:Blog:show.html.twig',[
            'post' => $post,
            'older' => $older,
            'newer' => $newer,
            'form' => $form->createView()
        ]);
    }

    public function tagAction(Tag $tag)
    {
        $posts = $tag->getPosts();
        return $this->render('AcmeMainBundle:Blog:tag.html.twig',[
            'posts' => $posts,
            'tag' => $tag
        ]);
    }
}
