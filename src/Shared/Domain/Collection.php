<?php


namespace App\Shared\Domain;

use \ArrayIterator;
use \Closure;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use function \array_key_exists;
use function \array_keys;
use function \array_map;
use function \array_search;
use function \array_slice;
use function \array_values;
use function \count;
use function \end;
use function \in_array;
use function \key;
use function \next;
use function \reset;

abstract class Collection implements DoctrineCollection
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!$this->isItemValid($item)) {
                continue;
            }

            $this->items[] = $item;
        }
    }

    /**
     * @param $item
     */
    public function add($item)
    {
        if (!$this->isItemValid($item)) {
            return;
        }

        $this->items[] = $item;
    }

    /**
     * @param $key
     *
     * @return object|null
     */
    public function remove($key)
    {
        if (! isset($this->items[$key]) && ! array_key_exists($key, $this->items)) {
            return null;
        }

        $removed = $this->items[$key];
        unset($this->items[$key]);

        return $removed;
    }

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function removeElement($item)
    {
        $key = array_search($item, $this->items, true);

        if ($key === false) {
            return false;
        }

        unset($this->items[$key]);

        return true;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return object|null
     */
    public function first()
    {
        return reset($this->items) ?: null;
    }

    /**
     * @return object|null
     */
    public function last()
    {
        return end($this->items) ?: null;
    }

    /**
     * @return object|null
     */
    public function current()
    {
        return current($this->items) ?: null;
    }

    /**
     * @return object|null
     */
    public function next()
    {
        return next($this->items) ?: null;
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * @return void
     */
    public function clear()
    {
        $this->items = [];
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * @param Closure $fn
     *
     * @return Collection
     */
    public function map(Closure $fn)
    {
        return $this->createFrom(array_map($fn, $this->items));
    }

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function contains($item)
    {
        return in_array($item, $this->items, true);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * @param int|string $key
     *
     * @return bool
     */
    public function containsKey($key)
    {
        return isset($this->items[$key]) || array_key_exists($key, $this->items);
    }

    /**
     * @param int|string $key
     *
     * @return object|null
     */
    public function get($key)
    {
        return $this->items[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->items);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return array_values($this->items);
    }

    /**
     * @param int|string $key
     * @param object $value
     */
    public function set($key, $value)
    {
        if (! $this->isItemValid($value)) {
            return;
        }

        $this->items[$key] = $value;
    }

    /**
     * @param Closure $p
     *
     * @return bool
     */
    public function exists(Closure $p)
    {
        foreach ($this->items as $key => $item) {
            if ($p($key, $item)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Closure $p
     *
     * @return Collection
     */
    public function filter(Closure $p)
    {
        return $this->createFrom(array_filter($this->items, $p, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * @param Closure $p
     *
     * @return bool
     */
    public function forAll(Closure $p)
    {
        foreach ($this->items as $key => $item) {
            if (! $p($key, $item)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Closure $p
     *
     * @return array
     */
    public function partition(Closure $p)
    {
        $matches = $noMatches = [];

        foreach ($this->items as $key => $item) {
            if ($p($key, $item)) {
                $matches[$key] = $item;
            } else {
                $noMatches[$key] = $item;
            }
        }

        return [$this->createFrom($matches), $this->createFrom($noMatches)];
    }

    /**
     * @param object $item
     *
     * @return int|string|null
     */
    public function indexOf($item)
    {
        return array_search($item, $this->items, true) ?: null;
    }

    /**
     * @param int $offset
     * @param int|null $length
     *
     * @return array
     */
    public function slice($offset, $length = null)
    {
        return array_slice($this->items, $offset, $length, true);
    }

    /**
     * @param int|string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * @param int|string $offset
     *
     * @return object|null
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param int|string $offset
     * @param object $value
     */
    public function offsetSet($offset, $value)
    {
        if (! isset($offset)) {
            $this->add($value);

            return;
        }

        $this->set($offset, $value);
    }

    /**
     * @param int|string $offset
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @param array $items
     *
     * @return Collection
     */
    protected function createFrom(array $items)
    {
        return new static($items);
    }

    /**
     * @param object $item
     *
     * @return bool
     */
    protected function isItemValid(object $item): bool
    {
        $class = $this->getClass();

        return $item instanceof $class;
    }

    /**
     * @return string
     */
    abstract public function getClass(): string;
}