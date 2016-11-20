<?php
namespace Tests\Darrigo\WeeklyOffers\Service;

use PhpOption\None;
use PhpOption\Option;
use PhpOption\Some;
use PHPUnit\Framework\TestCase;
use Darrigo\WeeklyOffers\Model\Product;
use Darrigo\WeeklyOffers\Repository\ProductsRepository;
use Darrigo\WeeklyOffers\Service\ProductsService;

class ProductsServiceTest extends TestCase
{
    protected $repository;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder(ProductsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testItShouldReturnAProductObject()
    {
        $id = 9611;
        $this->repository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(Option::fromValue(
                new Product($id, 'Costume Drago', 'http://mazzucchellis.local/prodotti/costume-drago/', 'http://www.google.com')
            ));

        $service = new ProductsService($this->repository);
        $result = $service->getProduct($id);
        $this->assertInstanceOf(Some::class, $result);
        $this->assertInstanceOf(Product::class, $result->get());
    }

    public function testItShouldReturnAnEmptyResult()
    {
        $id = 9611;
        $this->repository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(Option::fromValue(null));

        $service = new ProductsService($this->repository);
        $result = $service->getProduct($id);
        $this->assertInstanceOf(None::class, $result);
    }
}
