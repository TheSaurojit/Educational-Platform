<?php

namespace App\Helpers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GlobalData
{
    private static $data;

    private static function loadData()
    {
        // Initialize as object if not already
        if (!is_object(self::$data)) {
            self::$data = new \stdClass();
        }

        self::$data->matches = User::whereNot('id', Auth::user()?->id);
    }

    public static function getData()
    {
        self::loadData();
        return self::$data;
    }
}
