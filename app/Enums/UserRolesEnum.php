<?php

namespace App\Enums;

enum UserRolesEnum: int {
    case Customer = 1;
    case Employee = 2;
    case Admin = 3;
}