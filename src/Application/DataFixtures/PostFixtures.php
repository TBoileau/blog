<?php

namespace App\Application\DataFixtures;

use App\Application\Entity\Comment;
use App\Application\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class PostFixtures
 * @package App\Application\DataFixtures
 */
class PostFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $post = new Post();
            $post->setTitle("Article N°" . $i);
            $post->setContent("Contenu N°" . $i);
            $post->setUser($this->getReference(sprintf("user-%d", ($i % 10) + 1)));
            $post->setImage(" https://picsum.photos/400/300");
            $manager->persist($post);

            for ($j = 1; $j <= rand(5, 15); $j++) {
                $comment = new Comment();
                $comment->setAuthor("Auteur " . $i);
                $comment->setContent("Commentaire N°" . $j);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
