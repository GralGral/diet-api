<?php


namespace App\Food\Application\Meal\Command\Create;


final class CreateMealCommand
{
    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var array
     */
    private $foods;

    /**
     * @var array
     */
    private $dishes;

    /**
     * CreateMealCommand constructor.
     *
     * @param string $date
     * @param string $category
     * @param string $userId
     * @param array $foods
     * @param array $dishes
     */
    public function __construct(string $date, string $category, string $userId, array $foods, array $dishes)
    {
        $this->date = $date;
        $this->category = $category;
        $this->userId = $userId;
        $this->foods = $foods;
        $this->dishes = $dishes;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getFoods(): array
    {
        return $this->foods;
    }

    /**
     * @return array
     */
    public function getDishes(): array
    {
        return $this->dishes;
    }
}