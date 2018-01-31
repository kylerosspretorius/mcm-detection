<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 29/01/2018
 * Time: 09:42
 */

namespace MCM\MCMDetection;

class Main {


    private $email;

    public function __construct(string $email) {


        $this->ensureIsValidEmail($email);

        $this->email = $email;

    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }


    private function ensureIsValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

}