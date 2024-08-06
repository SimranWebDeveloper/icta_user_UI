<?php

namespace Database\Seeders;

use App\Models\Positions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions_array = [
            //IH
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'İdarə heyətinin sədri',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'İdarə heyətinin sədr müavini',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'İdarə heyətinin sədr müavini',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Daxili auditor',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'SƏTƏM üzrə baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Media ilə iş üzrə baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Beynəlxalq əməkdaşlıq üzrə baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => NULL,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Kiçik mütəxəssis',
                'status' => 1
            ],
            //EKS start
            [
                'departments_id' => 1,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Departament direktoru',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 1,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // TTS

            [
                'departments_id' => 1,
                'branches_id' => 2,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 2,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 2,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 2,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],

            //PRS

            [
                'departments_id' => 1,
                'branches_id' => 3,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 3,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 3,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 3,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 3,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            //RIS

            [
                'departments_id' => 1,
                'branches_id' => 4,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 4,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 4,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 4,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'branches_id' => 4,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // XBN

            [
                'departments_id' => 2,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Departament direktoru',
                'status' => 1
            ],


            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 5,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // IHS

            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'branches_id' => 6,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // RTI

            [
                'departments_id' => 3,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Departament direktoru',
                'status' => 1
            ],

            [
                'departments_id' => 3,
                'branches_id' => 7,
                'count' => 1,
                'name' => 'Şöbə müdiri - Data analitika üzrə mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 7,
                'count' => 1,
                'name' => 'Proqramlaşdırma üzrə inzibatçı',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 7,
                'count' => 1,
                'name' => 'Proqramçı mühəndis',
                'status' => 1
            ],

            // SI

            [
                'departments_id' => 3,
                'branches_id' => 8,
                'count' => 1,
                'name' => 'Şöbə müdiri - Şəbəəkə inzibatçısı',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 8,
                'count' => 1,
                'name' => 'Verilənlər bazasını idarə edən inzibatçı',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 8,
                'count' => 1,
                'name' => 'Verilənlər bazasını idarə edən inzibatçı',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 8,
                'count' => 1,
                'name' => 'Texniki dəstək mütəxəssisi',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'branches_id' => 8,
                'count' => 1,
                'name' => 'Texniki dəstək mütəxəssisi',
                'status' => 1
            ],

            // H

            [
                'departments_id' => 4,
                'branches_id' => NULL,
                'count' => 1,
                'name' => 'Departament direktoru',
                'status' => 1
            ],


            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Baş hüquqşünas',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Baş hüquqşünas',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Aparıcı hüquqşünas',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Aparıcı hüquqşünas',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Hüquqşünas',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 9,
                'count' => 1,
                'name' => 'Hüquqşünas',
                'status' => 1
            ],

            // SI

            [
                'departments_id' => 4,
                'branches_id' => 10,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 10,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 10,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'branches_id' => 10,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // IR

            [
                'departments_id' => 5,
                'branches_id' => 12,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 12,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 12,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 12,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 12,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // MS

            [
                'departments_id' => 5,
                'branches_id' => 11,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 11,
                'count' => 1,
                'name' => 'Baş mühasib',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 11,
                'count' => 1,
                'name' => 'Baş mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 11,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 11,
                'count' => 1,
                'name' => 'Mütəxəssis',
                'status' => 1
            ],

            // ST

            [
                'departments_id' => 5,
                'branches_id' => 13,
                'count' => 1,
                'name' => 'Şöbə müdiri',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 13,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 13,
                'count' => 1,
                'name' => 'Aparıcı mütəxəssis',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 13,
                'count' => 1,
                'name' => 'Sürücü',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'branches_id' => 13,
                'count' => 1,
                'name' => 'Xadimə',
                'status' => 1
            ],
        ];

        foreach ($positions_array as $item) {
            Positions::create($item);
        }


    }
}
