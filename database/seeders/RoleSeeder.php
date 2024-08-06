<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array_permissions = [
            'Struktur',
            'Struktur bölməsi',
            'Departament bölməsi',
            'Departament əlavə olunması',
            'Departament düzəliş edilməsi',
            'Departament silinməsi',
            'Şöbələr bölməsi',
            'Şöbələr əlavə olunması',
            'Şöbələr düzəliş edilməsi',
            'Şöbələr silinməsi',
            'Vəzifələr bölməsi',
            'Vəzifələr əlavə olunması',
            'Vəzifələr düzəliş edilməsi',
            'Vəzifələr silinməsi',
            'Otaqlar bölməsi',
            'Otaqlar əlavə olunması',
            'Otaqlar düzəliş edilməsi',
            'Otaqlar silinməsi',
            'İşçilər bölməsi',
            'İşçilər əlavə olunması',
            'İşçilər düzəliş edilməsi',
            'İşçilər silinməsi',
            'İnventar',
            'Kateqoriyalar bölməsi',
            'Kateqoriyalar əlavə olunması',
            'Kateqoriyalar düzəliş edilməsi',
            'Kateqoriyalar silinməsi',
            'Təminatçılar bölməsi',
            'Təminatçılar əlavə olunması',
            'Təminatçılar düzəliş edilməsi',
            'Təminatçılar silinməsi',
            'İnventarlar bölməsi',
            'Qaimələr bölməsi',
            'Qaimələr əlavə edilməsi',
            'İnventar əməliyyatları',
            'İnventar yeni təhkim olunması',
            'Texniki dəstək biletləri',
            'Həftəlik hesabatlar',
            'Ümumi tənzimləmələr',
            'Sistemə giriş mesajı',
            'Təmir modu və bildiriş',
            'Həftəlik hesabat modulu və istifadəçilər',
            'Ticket modulu',
            'Təhvil-təslimdə pdf və excel generasiyası',
            'Bir işçidən başqa işçiyə təhvil verilən zaman pdf və excel generasiyası',
            'Bildiriş modulu',
            'Texniki dəstək səbəbləri',
            'Səlahiyyətlər',
            'Səlahiyyətlər əlavə olunması',
            'Səlahiyyətlər düzəliş edilməsi',
            'Səlahiyyətlər silinməsi',
            'İstifadəçi vəzifələri',
            'İstifadəçi vəzifələri əlavə olunması',
            'İstifadəçi vəzifələri düzəliş edilməsi',
            'İstifadəçi vəzifələri silinməsi',
            'Sistem işçiləri',
            'Sistem işçiləri əlavə olunması',
            'Sistem işçiləri düzəliş edilməsi',
            'Sistem işçiləri silinməsi',
            'Loqlar',
        ];

        foreach ($array_permissions as $permission)
        {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $array = [
            'Administrator',
            'Moderator',
            'Mühasib',
            'Mühasib köməkçisi',
            'Təhcizatçı',
            'Təhcizatçı köməkçisi',
            'İnsan resursları üzrə mütəxəssis',
            'İnsan resursları üzrə mütəxəssis köməkçisi',
            'Texniki dəstək mütəxəssisi',
            'Texniki dəstək mütəxəssisi köməkçisi',
        ];

        foreach ($array as $role)
        {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'web'
            ]);

            $role->syncPermissions($array_permissions);
        }
    }
}
