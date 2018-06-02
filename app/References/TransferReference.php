<?php

namespace App\References;


class TransferReference
{

    const RULES = [
        'from_user_id' => 'required|exists:users,id',
        'to_user_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:0',
        'status' => 'nullable|integer|min:0',
        'error_msg' => 'nullable|string',
    ];


    const STATUS_NEW = 0;
    const STATUS_OK = 1;
    const STATUS_ERROR = 2;

    const STATUSES = [
        self::STATUS_NEW => 'new',
        self::STATUS_OK => 'ok',
        self::STATUS_ERROR => 'error',
    ];

}