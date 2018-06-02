<?php

namespace App\References;


class UserReference
{

    const RULES = [
        'name' => 'required|max:120',
        'balance' => 'nullable|numeric|min:0',
    ];


}