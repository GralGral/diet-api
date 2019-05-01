<?php
namespace App\Shared\Infrastructure\Persistence\MongoDB;


use App\Shared\Infrastructure\Persistence\Projection\Projection;
use App\Shared\Infrastructure\Persistence\Projection\ProjectionInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

abstract class MongoDBRepository
{
    /**
     * @var DocumentRepository
     */
    protected $repository;

    /**
     * @var DocumentManager
     */
    protected $documentManager;

    /**
     * MysqlRepository constructor.
     *
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
        $this->setRepository();
    }

    /**
     * @return DocumentManager
     */
    public function getDocumentManager(): DocumentManager
    {
        return $this->documentManager;
    }

    /**
     * @param $projection
     */
    protected function register($projection): void
    {
        $this->documentManager->persist($projection);
        $this->apply();
    }

    protected function apply(): void
    {
        // TODO See ghow to manage exception here
        $this->documentManager->flush();
    }

    /**
     * @return string
     */
    protected function getClass(): string
    {
        throw new \LogicException(sprintf(
            "Method %s must be override in % class",
            __METHOD__,
            \get_class($this)
        ));
    }

    private function setRepository(): void
    {
        $this->repository = $this->documentManager->getRepository($this->getClass());
    }
}