<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestQuery extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [1, 2, 3];

        $monthNames = array_map(function ($month) {
            return Carbon::create(null, $month, null)->monthName;
        }, $months);

        // file_put_contents('dump.json', json_encode($monthNames));
    }
}
