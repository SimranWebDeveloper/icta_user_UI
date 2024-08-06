<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::insert("INSERT INTO `users` (`id`, `departments_id`, `branches_id`, `positions_id`, `rooms_id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
    (1, 1, 1, 1, 1, 'Cavid Şıxıyev', 'admin@gmail.com', NULL, '2y10EoYd7rHUNoRBuxD.fi9O8.qm0aSvjVlHzBVDCPIAwb5DhFKIevZU.', 'administrator', NULL, '2024-04-08 06:24:55', '2024-04-08 06:24:55'),
        (2, 1, 1, 2, 1, 'Röya Quliyeva', 'roya.quliyeva@icta.az', NULL, '2y108ACZ2.vpbP0Eb9OX1VfcGeXxZn3r0vOVKzhYAiImbC5rCJcryF1yy', 'employee', NULL, '2024-04-08 06:24:55', '2024-04-08 06:24:55'),
        (3, NULL, NULL, 3, 1, 'Nail Mərdanov Teyyub', 'nail.merdanov@icta.az', NULL, '2y100Qdb1NSJVJkW4fZvWvn/F.vs6c7SO2pp7rS774XkLMWv0kbmrFDga', 'user', NULL, '2024-04-08 08:51:56', '2024-04-08 08:51:56'),
        (4, NULL, NULL, 6, 1, 'İbadlı Tural Qabil', 'tural.ibadli@icta.az', NULL, '2y10JBq6aFGDWaCOJy2gfcCuSuXRfeOJ1Gld6obfwg1CHSw5cVmtpPD..', 'user', NULL, '2024-04-08 08:54:27', '2024-04-08 08:54:27'),
        (5, NULL, NULL, 7, 1, 'İsgəndərov Ravil Məmməd', 'ravil.isgandarov@icta.az', NULL, '2y10iQ.fOTk61U.Tikqh.Itu9O15DYa4v8PT95un6wpIp9IlRoSA/8bcu', 'user', NULL, '2024-04-08 08:55:14', '2024-04-08 08:55:14'),
        (6, NULL, NULL, 8, 1, 'Əliyev Elvir Vüqar', 'elvir.aliyev@icta.az', NULL, '2y10IOZLDm6NlX1WAytS5Uyuv.XYAaTLUNHHkM.5NAE4G2KPNyTQHq7Zm', 'user', NULL, '2024-04-08 08:55:59', '2024-04-08 08:55:59'),
        (7, NULL, NULL, 5, 1, 'Quluzadə Toğrul Vüqar', 'togrul.guluzada@icta.az', NULL, '2y10bATyv2IbALdoRmfZqFZOg.WjRyVj.Trq1iNSZGD9sHdRKSnocGfp.', 'user', NULL, '2024-04-08 08:56:43', '2024-04-08 08:56:43'),
        (8, 1, 1, 10, 1, 'Zərbəliyev Tural Süleyman', 'tural.zarbaliyev@icta.az', NULL, '2y100G.oKh/CJ/A3ejsleRmKUekFLJ9BAISo11zpEsD4jnaqu78fzbxlS', 'user', NULL, '2024-04-08 09:02:47', '2024-04-08 09:02:47'),
        (9, 1, 1, 11, 1, 'Əliyev Aydın Məhəmmədəli', 'aydin.aliyev@icta.az', NULL, '2y1014FcumQldxGPIQcyBIhKuuPNgrzq2SfvERs0NJzWxYNTJCgN8AVda', 'user', NULL, '2024-04-08 09:35:16', '2024-04-08 09:35:16'),
        (10, 1, 1, 14, 1, 'Abbasov Elvin Şirulla', 'elvin.abbasov@icta.az', NULL, '2y10haN0oPD3iJ6zJhSh6.EUXOB6FTu4R3KWsT6RVHmLJGmZ1ekEzuSIe', 'user', NULL, '2024-04-08 09:37:05', '2024-04-08 09:37:05'),
        (11, 1, 1, 16, 1, 'İsmayılov İlqar Müzəffər', 'ilqar.ismayilov@icta.az', NULL, '2y10onVYPhRajSmbHtZYU.Yk3enPa1yUokz1JhjDaPAsOWU83SNO3UNKW', 'user', NULL, '2024-04-08 09:38:02', '2024-04-08 09:38:02'),
        (12, 1, 1, 15, 1, 'Quliyev Murad Tofiq', 'murad.quliyev@icta.az', NULL, '2y10QRHgRxMz5e46Ic6sumX.JuuI8FVxGVk57LO3rjCSHHkN8eZP2DBjK', 'user', NULL, '2024-04-08 09:38:48', '2024-04-08 09:38:48'),
        (13, 1, 1, 18, 1, 'Əhmədova Dərya Qoşqar', 'darya.ahmadova@icta.az', NULL, '2y10SAB4VfX6euCLilRq4iMbQu270izlyJd7H3s1Bm8Rir8EtlPJ/tGtG', 'user', NULL, '2024-04-08 09:39:45', '2024-04-08 09:39:45'),
        (14, 1, 2, 19, 1, 'Namazov Asim Tahir', 'asim.namazov@icta.az', NULL, '2y10cktzTmrLTzr2z4cCHtS0RuZIrHssrH4BFsdAs9CmzTk5LG/BS7GsG', 'user', NULL, '2024-04-09 01:26:24', '2024-04-09 01:26:24'),
        (15, 1, 2, 20, 1, 'Quluyev Müşfiq Balacan', 'mushfiq.quluyev@icta.az', NULL, '2y104BeQReSDd0VBNpFewZ6FEODBp43By5XvbInHvTK/0iMZSKaqF3WVi', 'user', NULL, '2024-04-09 01:27:17', '2024-04-09 01:27:17'),
        (16, 1, 2, 21, 1, 'Ağababayev Rahib Rəsul', 'rahib.aghababayev@icta.az', NULL, '2y10D9xqkksjP7IZmSDe61DJweITOlELH0jbffzQ0sz0x7KCnZDBRZyB.', 'user', NULL, '2024-04-09 01:28:02', '2024-04-09 01:28:02'),
        (17, 1, 3, 25, 1, 'Səmədov Vüqar Oktay', 'vuqar.samadov@icta.az', NULL, '2y103D/Vp9AUgkeIy9Yr4OsrD.5TWccDsXDSxm6dhvCMDkS9zYAjyBwcG', 'user', NULL, '2024-04-09 01:29:14', '2024-04-09 01:29:14'),
        (18, 1, 3, 26, 1, 'Nəsibova Şəhla Firuddin', 'shahla.nasibova@icta.az', NULL, '2y10z75wyGZkcKnPVdsiSDxJ6ehK8bcUi4Amqn3j.eoT8m0AdFsmy1bnG', 'user', NULL, '2024-04-09 01:30:25', '2024-04-09 01:30:25'),
        (19, 1, 3, 27, 1, 'Rəhimli Vüsal Elşən', 'vusal.rahimli@icta.az', NULL, '2y101xUYnU5rxRNYPdrR.8z4/ezqY17k3Kp3WFHNvMAjXPNeoB1UVl8wy', 'user', NULL, '2024-04-09 01:34:21', '2024-04-09 01:34:21'),
        (20, 1, 4, 28, 1, 'Süleymanov Vüsal Fərman', 'vusal.suleymanov@icta.az', NULL, '2y10SRQ4TzfjvIJTZJKqDFmWWeab/TlTZdKlhOxcui5NEHZ9F2OCc9/be', 'user', NULL, '2024-04-09 01:35:11', '2024-04-09 01:35:11'),
        (21, 1, 4, 30, 1, 'Muradzadə Elvin İlqar', 'elvin.muradzada@icta.az', NULL, '2y10U5fufB2GjQJKAX3vJiB11OV9yKJ/oOqUo0Czs5oGhjmiXQy1KS2re', 'user', NULL, '2024-04-09 01:35:59', '2024-04-09 01:35:59'),
        (22, 1, 4, 31, 1, 'Hüseynov Salman Bəhram', 'salman.huseynov@icta.az', NULL, '2y10moffyX.cwiog1uc7dxixcu3y4H5EieAF8LpnW6Ef9WmVVugdgM2Z.', 'user', NULL, '2024-04-09 01:36:47', '2024-04-09 01:36:47'),
        (23, 1, 4, 32, 1, 'Şıxıyeva Könül Əlibala', 'konul.shikhiyeva@icta.az', NULL, '2y10.kY9pgxPqdLzyOZaTRPFk.DeaKaIieCrJfhIEMoAQa2pR.bXqUnHO', 'user', NULL, '2024-04-09 01:37:23', '2024-04-09 01:37:23'),
        (24, 2, 5, 34, 1, 'İsmayılov Nail Mirzə Musa', 'nail.ismayilov@icta.az', NULL, '2y104JPjl5.YTn5jorWX7CbjXuCdE.1mXA7zsffro0yUnQ54NGyFpHRq.', 'user', NULL, '2024-04-09 01:40:04', '2024-04-09 01:40:04'),
        (25, 2, 5, 35, 1, 'Kərimova Xumar Elşad', 'khumar.karimova@icta.az', NULL, '2y10L8dse6/tb0vzF0vSopjUi.W.C9ZZD3yCML5ZiklClBHtO5dbRlWGy', 'user', NULL, '2024-04-09 01:40:47', '2024-04-09 01:40:47'),
        (26, 2, 5, 37, 1, 'Bayramlı Şahmar Faiq', 'shahmar.bayramli@icta.az', NULL, '2y10ai59LAV1PJhAxBhPGyMYTeWnMeWJmzFl.wyGT7NHFet259ClNj8ye', 'user', NULL, '2024-04-09 01:41:38', '2024-04-09 01:41:38'),
        (27, 2, 5, 36, 1, 'Məcidova Xəyalə Arif', 'khayala.majidova@icta.az', NULL, '2y10wieILxIr3EKCdizNCd7O0OSL/I4rnC6mwtKMKYTp96i3fbQyZvKF6', 'user', NULL, '2024-04-09 01:42:30', '2024-04-09 01:42:30'),
        (28, 2, 5, 39, 1, 'Nağıyev Kənan Vüqar', 'kanan.naghiyev@icta.az', NULL, '2y105mzBDr4DdkqeU8g0xRgx2emA.9PmiIbuPv2roVd.mtIW6R6SNTBYO', 'user', NULL, '2024-04-09 01:43:09', '2024-04-09 01:43:09'),
        (29, 2, 5, 38, 1, 'Qurbanov Muxtar Talış', 'mukhtar.qurbanov@icta.az', NULL, '2y10TwSEob9VxDiMbWSf8stRJOAkEWRtx2u1vPcaUz1cF0busG9miug5S', 'user', NULL, '2024-04-09 01:43:45', '2024-04-09 01:43:45'),
        (30, 2, 6, 42, 1, 'Mikayılov Xalid Vahid', 'khalid.mikayilov@icta.az', NULL, '2y10PQ1.F0PS5vaB8ri5eRMVcOD9lw/75rxokyXPjNUo2rpdFBb.goXBi', 'user', NULL, '2024-04-09 01:48:50', '2024-04-09 01:48:50'),
        (31, 2, 6, 43, 1, 'Yusifova Nigar İsmayıl', 'nigar.yusifova@icta.az', NULL, '2y10iBHWyTxEw9uXOwpUoVHdNOVqqBUozGvhnGp8Xxqo9wwdpdmLibZM2', 'user', NULL, '2024-04-09 01:51:01', '2024-04-09 01:51:01'),
        (32, 2, 6, 44, 1, 'Hüseynova Səkinə Nağı', 'sakina.huseynova@icta.az', NULL, '2y10f8WLCch9JTQzvW/rTlCop.z/3qVjV4YDRmJc1qShGL9G4g3rfR.l6', 'user', NULL, '2024-04-09 01:51:59', '2024-04-09 01:51:59'),
        (33, 2, 6, 45, 1, 'Ələkbərov Seyhun Əndəhət', 'seyhun.alakbarov@icta.az', NULL, '2y10BIdIitxBz15.Z.wYR1mM5O2JQE7vtCAububt.4vCjiKhyacOq3qKG', 'user', NULL, '2024-04-09 01:52:35', '2024-04-09 01:52:35'),
        (34, 2, 6, 47, 1, 'Ağayev İmran Xanbaba', 'imran.aghayev@icta.az', NULL, '2y10rvV8n/qvWt57DM25gLEADesHj7prI6ReZygJugxb5C2mRAS1JVzDG', 'user', NULL, '2024-04-09 01:53:11', '2024-04-09 01:53:11'),
        (35, 2, 6, 48, 1, 'Qurbanov Fariz Əbülhəsən', 'fariz.gurbanov@icta.az', NULL, '2y10MWmOtMbNUrrBOyewsoYtf.XV8BS8nYsmmMD7aiDafL/Mw2X9LTy..', 'user', NULL, '2024-04-09 01:54:10', '2024-04-09 01:54:10'),
        (36, 2, 6, 49, 1, 'Bəşirova Nərmin Arzu', 'narmin.bashirova@icta.az', NULL, '2y10ghsvIZyqXW.2DhN05T1uTuMqUR300lIZWvYDqoyELrkvzH9tNKxz2', 'user', NULL, '2024-04-09 01:55:52', '2024-04-09 01:55:52'),
        (37, 2, 6, 50, 1, 'Maqsudova Nailə Elxan', 'naila.maqsudova@icta.az', NULL, '2y10Y.ahZ.UI1uiUUqR4i.hxTeFbG4mZRYiPyFeQYnoWW/vE4yuyKlVxy', 'user', NULL, '2024-04-09 01:59:09', '2024-04-09 01:59:09'),
        (38, 3, 7, 52, 1, 'Bağırzadə İslam Aydın', 'islam.baghirzada@icta.az', NULL, '2y10SpRgC3ehhm0QjXm5KpG8Geq1.Pk3boT5Zk1axMJrbNH1LIP.actW2', 'user', NULL, '2024-04-09 02:00:55', '2024-04-09 02:00:55'),
        (39, 3, 7, 53, 1, 'Şıxəliyev Emin Nadir', 'emin.shikhaliyev@icta.az', NULL, '2y10F9ZaE/LXXCwju5TwzPK56e5hkG62M1IPAQfm95JhQxH2zktJjXePy', 'user', NULL, '2024-04-09 02:01:33', '2024-04-09 02:01:33'),
        (40, 3, 8, 56, 1, 'İsmayıl Cavid Ramiz', 'cavid.ismayil@icta.az', NULL, '2y10zjXMllCvTlnWkbdyzwsWru1SCvg5N7XFraQq8PStrG/PUgDoF73de', 'user', NULL, '2024-04-09 02:06:46', '2024-04-09 02:06:46'),
        (41, 3, 8, 57, 1, 'Əkbərli Vüsal Gündüz', 'vusal.akbarli@icta.az', NULL, '2y10ZscHuryoZMbkK2C/ToVGoeukdT4OpJ2wIfo./B4kyu6RkVo.KSjmS', 'user', NULL, '2024-04-09 02:08:02', '2024-04-09 02:08:02'),
        (42, 3, 8, 58, 1, 'Həsənli Cavid Rəfael', 'cavid.hasanli@icta.az', NULL, '2y10LB5Fp1xtdFha5YcA4Q896e.6C4G1WOs6qdtHsrdDnI6YL.z.K/0LK', 'user', NULL, '2024-04-09 02:09:15', '2024-04-09 02:09:15'),
        (43, 3, 8, 59, 1, 'Şıxıyev Cavid Çapar', 'cavid.shikhiyev@icta.az', NULL, '2y108zNiLZ4dZIAe1Ntr5p1S2OSBgOTqkB7fTwE8kpIVX0XeN1slXoYIW', 'user', NULL, '2024-04-09 02:09:48', '2024-04-09 02:09:48'),
        (44, 4, 9, 62, 1, 'Qarayeva Aysel İntiqam', 'aysel.garayeva@icta.az', NULL, '2y10ah8LqVvUJl8EifZipImtl.xeShB6kLk8d4xZP9JyxJzNo8jGR86dq', 'user', NULL, '2024-04-09 02:12:08', '2024-04-09 02:12:08'),
        (45, 4, 9, 64, 1, 'Süleymanlı Sənan Şahbaz', 'sanan.suleymanli@icta.az', NULL, '2y10.mV1DQgms5vcQdtInn1Vc.zKQsXcfvkIQdcAnMbhpg.B0px.DbVfq', 'user', NULL, '2024-04-09 02:12:46', '2024-04-09 02:12:46'),
        (46, 4, 9, 66, 1, 'Kələntərova Əminə İntiqam', 'amina.kalantarova@icta.az', NULL, '2y10sTpJDuFczBjT.D1a5h7HTujw.z/kUT1u4yDvciXQ9iCza5ZW19DQy', 'user', NULL, '2024-04-09 02:13:34', '2024-04-09 02:13:34'),
        (47, 4, 9, 67, 1, 'Əbilov Emil Kamal', 'emil.abilov@icta.az', NULL, '2y10s7dyZ/k52msx11cUFvEVluTZnlnLA0SgAM3K1UA13V85JTSYzBvz.', 'user', NULL, '2024-04-09 02:14:06', '2024-04-09 02:14:06'),
        (48, 4, 10, 68, 1, 'Qədirov Elman Ağahüseyn', 'elman.qadirov@icta.az', NULL, '2y10Z0nfk9SCL1MbX.9K8l9DgOgS0X1bdjKeQhp7qNIy9F3JfAosaQ4x.', 'user', NULL, '2024-04-09 02:14:45', '2024-04-09 02:14:45'),
        (49, 4, 10, 71, 1, 'Cavdzadə Aynurə Əbülfəz', 'aynura.cavadzada@icta.az', NULL, '2y10lwBDW0SahCAOEebNqOM5X.V5AbR8zHwVNYED1eYbsIAa46ez12XAi', 'user', NULL, '2024-04-09 02:15:33', '2024-04-09 02:15:33'),
        (50, 5, 12, 72, 1, 'Qədimova-Vəliyeva Güllər Həsənəli', 'gullar.qadimova@icta.az', NULL, '2y10j1UhtDvOB9ng.3kNoVL8g.uSOQ3aN4lQQZNT1sPw31mLRNVD0.CSe', 'user', NULL, '2024-04-09 02:32:03', '2024-04-09 02:32:03'),
        (51, 5, 12, 76, 1, 'Bayramova Fəridə Elxan', 'farida.bayramova@icta.az', NULL, '2y105DqOHEI.6FRG055SpKYjGesO1Kw9CrYAeJC6ueSraXcgpI2HzbOcy', 'user', NULL, '2024-04-09 02:33:01', '2024-04-09 02:33:01'),
        (52, 5, 11, 78, 1, 'Bayramzadə Emin Salman', 'emin.bayramzada@icta.az', NULL, '2y10jdFgVq1FI7eGxuv2F1KRfONSBmYOKTHhEriyvoLetAaMNyH3wcNVK', 'user', NULL, '2024-04-09 02:33:39', '2024-04-09 02:33:39'),
        (53, 5, 11, 79, 1, 'Həsənov Rəşad Asəf', 'rashad.hasanov@icta.az', NULL, '2y10tr4K7kIq2oZoSs0ijOv0wOeqy/gxCNQEvoIcEykAhaFzyDtoshIFO', 'user', NULL, '2024-04-09 02:34:14', '2024-04-09 02:34:14'),
        (54, 5, 13, 83, 1, 'Məmmədov Asim Rasim', 'asim.mammadov@icta.az', NULL, '2y10nNCvLMBhr/I0/xR211lCS.ZwrB86EuH3UXyvB9XVf6wXOSX7vE5GK', 'user', NULL, '2024-04-09 02:35:08', '2024-04-09 02:35:08'),
        (55, 5, 13, 84, 1, 'Ənvərli Elman Kərim', 'elman.anvarli@icta.az', NULL, '2y10JTDuJ5kyvU93LaDk7xIPV.aVrlTP/b3F6TK7QOmLNKTZRgfcLnxGm', 'user', NULL, '2024-04-09 02:35:49', '2024-04-09 02:35:49'),
        (56, 5, 13, 86, 1, 'Abbaslı Nigar Vilayət', NULL, NULL, '2y10qBGiRXu9UTqVTE5rv9OY2uJItUD5Z1uNLsreoTvMlaZfOWK8xML2q', 'user', NULL, '2024-04-09 02:38:48', '2024-04-09 02:38:48'),
        (57, 5, 13, 87, 1, 'Rüstəmova Solmaz Məsim', NULL, NULL, '2y10zk2qPTt4/niZfNLFcjeqU.U867m4RgIfW9fL6xHFU8HhtRaubHpFO', 'user', NULL, '2024-04-09 02:39:39', '2024-04-09 02:39:39'),
        (58, 5, 13, 85, 1, 'Əhmədov Elnur Gəray', NULL, NULL, '2y10FELPqFgTAbbQak6CtZdzmugPmNL4xdGL0dsawWB6Y.8CleAltc6c2', 'user', NULL, '2024-04-09 02:40:29', '2024-04-09 02:40:29')");
    }
}
