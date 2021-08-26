<?php
declare(strict_types=1);

namespace App\Http\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class CreateUserRequestData extends DataTransferObject
{
    public string $name;

    public string $email;

    public string $password;
}
