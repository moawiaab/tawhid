<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\SellItem;
use App\Models\Stage;
use App\Models\User;
use App\Services\ChartsService;

class DashboardApiController extends Controller
{
    public function index()
    {


        $line4 = new ChartsService([
            'title'              => 'Set sellitem',
            'chart_type'         => 'line',
            'model'              => 'App\Models\User',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'column_class'       => 'col-md-12',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'amount',
            'filter_by_field'    => 'created_at',
            'filter_by_period'   => 30,
        ]);

        $bar5 = [
            // 'labels' => auth()->user()->account->products()->get()->transform(function ($e) {
            //     return $e->name;
            // }),
            'labels' => [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
              ],
            'datasets' => [
                [
                    'label' => 'one',
                    'backgroundColor'    => '#f800ff',
                    'data' => [15, 20, 12, 59, 10, 100, 8, 60, 40, 2, 12, 11],
                ],
                [
                    'label' => 'tow',
                    'backgroundColor'    => '#000079',
                    'data' => [40, 12, 12, 39, 10, 40, 39, 60, 40, 20, 12, 11],
                ]
            ]
        ];

        $pie6 = new ChartsService([
            'title'              => 'Ok2order',
            'chart_type'         => 'pie',
            'model'              => 'App\Models\User',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'column_class'       => 'col-md-4',
            'aggregate_function' => 'count',
            'aggregate_field'    => '',
            'filter_by_field'    => 'created_at',
            'filter_by_period'   => 7,
        ]);

        $dataNum = [
            'user' => auth()->user()->account->users()->count(),
            'role' => auth()->user()->account->roles()->count(),
        ];
        return [
            'bar' => $bar5,
            'pie6' => $pie6,
            'line4' => $line4,
            'num' => $dataNum
        ];
    }
}
