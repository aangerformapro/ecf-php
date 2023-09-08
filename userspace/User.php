<?php

declare(strict_types=1);

class User extends BaseModel implements \Stringable
{
    protected string $name;
    protected string $email;

    public function __toString(): string
    {
        return $this->name;
    }

    public function __serialize(): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }

    public function __unserialize(array $data): void
    {
        [
            $this->id ,
            $this->name,
            $this->email
        ] = [$data['id'], $data['name'], $data['email']];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public static function connectUser(string $email, string $password): ?static
    {
        $stmt = getPDO()->prepare('SELECT * FROM users WHERE email = ?');

        if ($stmt->execute([$email]))
        {
            if ($data = $stmt->fetch())
            {
                if (password_verify($password, $data['password']))
                {
                    return static::initialize($data);
                }
            }
        }

        return null;
    }
}
