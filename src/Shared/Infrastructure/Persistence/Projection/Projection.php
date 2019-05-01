<?php


namespace App\Shared\Infrastructure\Persistence\Projection;


use Broadway\ReadModel\SerializableReadModel;

abstract class Projection implements ProjectionInterface, SerializableReadModel
{
}