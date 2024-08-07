<?php

use App\Models\Stocks;

function display_user_types()
{
    $types_array = [
        'employee' => [
            'name' => 'İşçi',
            'route' => route("employee.home")
        ],
        'administrator' => [
            'name' => 'Administrator',
            'route' => route("admin.dashboard")
        ],
        'hr' => [
            'name' => 'İnsan resursları',
            'route' => route('hr.home')
        ],
        'accountant' => [
            'name' => 'Mühasibatlıq',
            'route' => route("accountant.home")
        ],
        'warehouseman' => [
            'name' => 'Təhcizat',
            'route' => route('warehouseman.warehouseman')
        ],
        'support' => [
            'name' => 'Texniki dəstək',
            'route' => route('support.home')
        ],
        'itd-leader' => [
            'name' => 'IKT rəhbəri',
            'route' => route('itd-leader.home')
        ]
    ];

    $user_types = explode(',', \Illuminate\Support\Facades\Auth::user()->type);

    $compact_types = [];
    if (count($user_types) > 1) {
        foreach ($user_types as $type_key => $type) {
            $compact_types[$type_key]['type'] = $types_array[$type];
        }
    }

    return $compact_types;
}

function isUserActive($userId)
{
    return \Illuminate\Support\Facades\Cache::has('user-is-online-' . $userId);
}


