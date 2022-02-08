<?php

namespace App\Controllers;

//Rupiah Format

class MoneyFormatController extends BaseController
{

    public static function money_format_rupiah($num)
    {
        $result = "Rp " . number_format($num, 2, ',', '.');
        return $result;
    }
}
