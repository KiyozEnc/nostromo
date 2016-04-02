<?php
namespace Nostromo\Tests;

use Nostromo\Classes\Article;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 02/04/2016
 * Time: 16:31
 */
class ArticleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Article
     */
    private $article;

    public function testGetArticles()
    {
        $tab = $this->article->getArticles();
        $this->assertEquals(5, $tab['qte'], '5 quantities expected');
    }

    public function setUp()
    {
        $this->article = new Article();
        $this->article
            ->setDescription('Bonjour')
            ->setDesignation('ArticleTest 1')
            ->setNumArt(2)
            ->setPu(35)
            ->setQte(5)
            ->setQteStock(30)
            ->setUrl('test');
    }

    public function testAugmenterQuantite()
    {
        $this->article->augmenterQuantite(1);
        $this->assertEquals(6, $this->article->getQte(), '6 quantities expected');

        $this->article->augmenterQuantite(8);
        $this->assertEquals(14, $this->article->getQte(), '14 quantities expected');
    }

    public function testDiminuerQuantite()
    {
        $this->article->diminuerQuantite(4);
        $this->assertEquals(1, $this->article->getQte(), '1 quantity expected');

        $this->article->diminuerQuantite(5);
        $this->assertEquals(0, $this->article->getQte(), '0 quantity expected');
    }
}
