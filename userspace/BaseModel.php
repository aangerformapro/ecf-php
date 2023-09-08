<?php

declare(strict_types=1);

abstract class BaseModel
{
    protected static ?string $table = null;

    protected ?int $id              = null;

    abstract public function __unserialize(array $data): void;

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function find(string $where = null, array $bindings = []): array
    {
        $stmt = getPDO()->prepare(
            sprintf(
                'SELECT * FROM %s%s',
                static::getTable(),
                $where ? (' WHERE ' . $where) : ''
            )
        );

        if ($stmt->execute($bindings))
        {
            if ($results = $stmt->fetch())
            {
                return array_map(fn ($arr) => static::initialize($arr), $results);
            }
        }
        return [];
    }

    public static function findOne(string $where = null, array $bindings = []): ?static
    {
        $table = static::$table ?? strtolower(static::class) . 's';

        $stmt  = getPDO()->prepare(
            sprintf(
                'SELECT * FROM %s%s',
                $table,
                $where ? (' WHERE ' . $where) : ''
            )
        );

        if ($stmt->execute($bindings))
        {
            if ($arr = $stmt->fetch())
            {
                return static::initialize($arr);
            }
        }

        return null;
    }

    public static function delete(self $model)
    {
        if ($id = $model->getId())
        {
            getPDO()
                ->prepare(
                    sprintf(
                        'DELETE FROM %s WHERE id = ?',
                        static::getTable()
                    )
                )
                ->execute([$id])
            ;
        }
    }

    public static function update(self $model): static
    {
        return $model;
    }

    public static function create(array $data): ?static
    {
        if (count($data))
        {
            $props = [];

            foreach (array_keys($data) as $prop)
            {
                $props[":{$prop}"] = $prop;
            }

            $query = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                static::getTable(),
                implode(', ', $props),
                implode(', ', array_keys($props))
            );

            try
            {
                if (getPDO()->prepare($query)->execute($data))
                {
                    $id = getPDO()->lastInsertId();

                    return static::findOne('id = ?', [$id]);
                }
            } catch (PDOException)
            {
            }
        }

        return null;
    }

    public static function save(self $model): static
    {
        return $model;
    }

    protected static function getTable(): string
    {
        return static::$table ?? strtolower(static::class) . 's';
    }

    protected static function initialize($data): static
    {
        $instance = new static();
        $instance->__unserialize($data);
        return $instance;
    }
}
