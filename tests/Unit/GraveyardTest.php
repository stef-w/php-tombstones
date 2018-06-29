<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 29/06/2018
 * Time: 09:29
 */

class GraveyardTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \StefW\Tombstones\Graveyard
     */
    private $sut;

    public function setUp()
    {
        require_once  __DIR__ . '/../fixtures/RandomClass.php';
        $directory    = realpath(__DIR__ . '/../fixtures/');
        $arrayStorage = new \StefW\Tombstones\Storage\ArrayStorage();
        $this->sut    = new \StefW\Tombstones\Graveyard($directory, $arrayStorage);
    }

    /**
     *
     */
    public function it_can_set_a_tombstone()
    {
        $this->sut->tombstone('RandomClass.php', 19);
        $this->sut->tombstone('RandomClass.php', 24);
    }

    /**
     * @test
     */
    public function it_can_get_all_tombstones()
    {
        $tombstones = $this->sut->getAllTombstones();

        $first      = $tombstones[0]->toArray();
        $second     = $tombstones[1]->toArray();

        $this->assertEquals($first['line'], 19);
        $this->assertEquals($second['line'], 24);
    }

    /**
     * @test
     */
    public function it_can_get_all_closed_tombstones()
    {
        $testClass = new \RandomClass($this->sut);
        $testClass->thisIsAnAliveMethod();
        $tombstones = $testClass->graveyard->getClosedTombstones();
        $this->assertEquals(count($tombstones), 3);
    }

    /**
     * @test
     */
    public function it_can_get_all_opened_tombstones()
    {
        $testClass = new \RandomClass($this->sut);
        $testClass->thisIsAnAliveMethod();
        $tombstones = $testClass->graveyard->getOpenedTombstones();
        $this->assertEquals(count($tombstones), 1);
    }
}
