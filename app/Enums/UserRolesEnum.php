<?php

namespace App\Enums;

enum UserRolesEnum: int
{
    case Customer = 3;
    case Employee = 2;
    case Admin = 1;
}
