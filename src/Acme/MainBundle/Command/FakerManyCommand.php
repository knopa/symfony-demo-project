<?php
/**
 * Created by PhpStorm.
 * User: sergey@slepokurov.com
 * Date: 29.10.2014
 * Time: 15:51
 */

namespace Acme\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FakerManyCommand  extends ContainerAwareCommand
{
    private $em;
    protected function configure()
    {
        $this
            ->setDescription('Populates many to many')
            ->setName('fakermany:populate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        /** @var \Acme\MainBundle\Entity\PostRepository $postRepository */
        $postRepository = $this->em->getRepository('AcmeMainBundle:Post');

        $posts = $postRepository->findAll();

        /** @var \Acme\MainBundle\Entity\TagRepository $tagRepository */
        $tagRepository = $this->em->getRepository('AcmeMainBundle:Tag');

        $tags = $tagRepository->findAll();

        foreach($posts as $post) {
            /** @var \Acme\MainBundle\Entity\Post $post */
            $limit = 0;
            foreach($tags as $tag) {
                if($limit == 4) {
                    break;
                }
                if(rand(0,100) > 50) {
                    $post->addTag($tag);
                    $limit++;
                }
            }
            $postRepository->save($post);
        }
    }
}
