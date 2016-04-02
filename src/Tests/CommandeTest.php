<?php
namespace Nostromo\Tests;

use Nostromo\Classes\Article;
use Nostromo\Classes\Collection;
use Nostromo\Classes\Commande;
use Nostromo\Classes\Utilisateur;

class CommandeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Commande
     */
    private $commande;

    public function setUp()
    {
        $this->commande = new Commande(
            1,
            new Utilisateur(
                1,
                'Kévin',
                'Turmel',
                '26C Rue Pierre Brossolette',
                53100,
                'Mayenne',
                'kdsjglkjdfklsjdfcgbnliuez',
                'kevinturmel@gmail.com',
                150
            ),
            date('Y-m-d')
        );

        $articles = new Collection();

        $article = new Article();
        $article
            ->setDescription('Bonjour')
            ->setDesignation('ArticleTest 1')
            ->setNumArt(2)
            ->setPu(35)
            ->setQte(5)
            ->setQteStock(30)
            ->setUrl('test');
        $articles->ajouter($article);

        $article2 = new Article();
        $article2
            ->setDescription('Bo2')
            ->setDesignation('ArticleTest 2')
            ->setNumArt(1)
            ->setPu(800)
            ->setQte(8)
            ->setQteStock(90)
            ->setUrl('test');
        $articles->ajouter($article2);

        $this->commande->setLesArticles($articles);

    }

    public function testGetMontantTotal()
    {
        $this->assertEquals(6575, $this->commande->getMontantTotal());
    }
}
