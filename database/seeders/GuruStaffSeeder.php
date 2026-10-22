<?php

namespace Database\Seeders;

use App\Models\GuruStaff;
use Illuminate\Database\Seeder;

/**
 * Data Pimpinan, Tata Usaha, Kepala Program Keahlian, Pembina OSIS,
 * Guru & Staf SMK INFOKOM. Dikelompokkan lewat kolom `kategori` supaya
 * halaman publik Guru & Staff bisa menampilkannya per kelompok.
 *
 * Catatan: nilai `foto` dan `jabatan` disamakan persis dengan dump
 * `sekolah_db.sql` (mengacu ke berkas yang sudah ada di
 * storage/app/public/guru-staff). Kolom `jabatan` pada kelompok "Guru & Staf"
 * (id 17-34) mengikuti hasil pembaruan terakhir di dump; baris ke-34
 * (Guru Matematika, urutan 0) ditambahkan admin setelah data awal.
 */
class GuruStaffSeeder extends Seeder
{
    public function run(): void
    {
        if (GuruStaff::count() > 0) {
            return;
        }

        $now = now();

        $data = [
            // Pimpinan Sekolah
            ['Ir. Hj. Liliek Rahmaningsih, M.M.Pd.', 'guru-staff/gUGi1A7kgs8zvZBfl3Tq5MkIwlkw9ch0uZ0XjBTE.png', 'Kepala Sekolah', 'Pimpinan Sekolah', 1],
            ['Mila Yaelasari, M.Pd.', 'guru-staff/rzqNJbwIfCVJBxpXmhiTZ4j0U7FUiFxzwTdHUvai.png', 'Wakil Kepala Sekolah Bidang Kurikulum', 'Pimpinan Sekolah', 2],
            ['Dea Rijalul Fikri, S.Kom., Gr.', 'guru-staff/LeWTAysrIN9YplZ3x3LgCvI9WM34366w8Ffo8yij.png', 'Wakil Kepala Sekolah Bidang Kesiswaan', 'Pimpinan Sekolah', 3],
            ['R. Radiani Srirestuti Dewi, SS., Gr.', 'guru-staff/esrj7d54I9A5kBLFAANuoDdi9c0WWuzgCIgqIzq6.png', 'Wakil Kepala Sekolah Bidang Hubungan Industri dan Masyarakat', 'Pimpinan Sekolah', 4],
            ['Heny Handayani, S.Pd.', 'guru-staff/hAWzQN1k27x0QQNV8Eb1aLRO5gTVyxI0AhiPZgRq.png', 'Wakil Kepala Sekolah Bidang Pengembangan Sumber Daya Manusia', 'Pimpinan Sekolah', 5],
            ['Agus Tiyono, M.Pd.', 'guru-staff/YrnuZpLLfZOfr1FGRLOXdtMM4LQsvzy9ACpdDKnE.png', 'Wakil Kepala Sekolah Bidang Sarana dan Prasarana', 'Pimpinan Sekolah', 6],

            // Manajemen & Tata Usaha
            ['Aditya Nugraha, ST.', 'guru-staff/rnpe0gfOfNYskgoB0NEa6q4MAWm7d80L196CGp8y.png', 'Ketua Manajemen Mutu', 'Manajemen & Tata Usaha', 1],
            ['Cahyadi Rozi, ST.', 'guru-staff/P8xKpTztUR5dYkCmQe36NnaskBQ88HLubLvzP1NR.png', 'Kepala Tata Usaha', 'Manajemen & Tata Usaha', 2],
            ['Drs. Puji Marhaen Waluyo', 'guru-staff/fMsbicsvP3DtAbuiIf93Vdr4GVvciuCcH5f8pDpW.png', 'Kepala Perpustakaan', 'Manajemen & Tata Usaha', 3],
            ['Putri Riandini, S.Hut., M.Pd., Gr.', 'guru-staff/4vM2kGyzzj40AEwBp4qFJBTwlhmIG1aM7HNIkmb1.png', 'Kepala Bendahara', 'Manajemen & Tata Usaha', 4],

            // Kepala Program Keahlian
            ['Aditya Nugraha, ST.', 'guru-staff/2JdYdtG8VAPl5nfvBfVsHzWHv0IeDoOvKSnR2ooA.png', 'Kepala Program Keahlian TKJ', 'Kepala Program Keahlian', 1],
            ['Ridwan Hala, S.Kom., Gr.', 'guru-staff/DwwhpU9Em63R5errOI9u6XMcTmtcEeJ16Qf7MW9Z.png', 'Kepala Program Keahlian RPL', 'Kepala Program Keahlian', 2],
            ['Muhammad Ibnu Arif, S.IKom.', 'guru-staff/PRdZZEqxcxGu8p6WGLYTZUEfusuZeZelJvzcOLVI.png', 'Kepala Program Keahlian DKV', 'Kepala Program Keahlian', 3],
            ['Erli Suherli, A.Md.Kom.', 'guru-staff/9J67aZDYNaJNINUJFfOPIxl4NR6aVJbUo9vjGvN4.png', 'Kepala Program Keahlian PSPT', 'Kepala Program Keahlian', 4],

            // Pembina OSIS
            ['Ahmad Hotib, S.Pd.I', 'guru-staff/2gY42lTaUHpZ5wrjS6eKaAMvzM9X08NyiNuXIxzh.png', 'Pembina OSIS', 'Pembina OSIS', 1],
            ['Abdul Azis, M.Pd.', 'guru-staff/UMxXZd5aopWNSNtf2ApA8D5QWCW6BQcrmLx8J7xi.png', 'Pembina OSIS', 'Pembina OSIS', 2],

            // Guru & Staf
            ['Vera Yuni Astuti, SP., M.IKom., Gr.', 'guru-staff/3LcHJiQBO7SP0gDq3myBbNobSDsQMDwONR9IWtAa.png', 'Guru PKK', 'Guru & Staf', 1],
            ['M. Fauzan Arifin, S.IKom., Gr.', 'guru-staff/p0by4WV7pPgfW4iys7jNbFwm7Hy9JVcVuQ55fOlF.png', 'Guru Desain Publikasi & Fotografi', 'Guru & Staf', 2],
            ['Dra. Popon Puspitasari', 'guru-staff/kaRXaUCN051lCNqdu8rGzPJnRjYqhQTTFv65PlT3.png', 'Guru PAI', 'Guru & Staf', 3],
            ['Richo Santana, S.Kom.', 'guru-staff/haYC34B4IdVC9AFWKwqfFKUMR1dNuUjunhxO2sde.png', 'Guru PWPB', 'Guru & Staf', 4],
            ['Dian Hardianti, S.Kom., Gr.', 'guru-staff/Cioy1U8p9GVloIPCRaKz99IUAYHr4CCUcoY9wiB6.png', 'Guru Basis Data', 'Guru & Staf', 5],
            ['Yeni Yuliawati, S.Pd., Gr.', 'guru-staff/csiKkRfsPMB5lncyopYKYJdtXuaVqppLhcqIlXjz.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 6],
            ['Rita Widyastuti', 'guru-staff/LmqZD6KNpvNvcC2h7vjL8PFpInKm4du0uY9p4P88.png', 'Staf Teller (Bendahara)', 'Guru & Staf', 7],
            ['Eva Farida Rahayu, S.Pd., Gr.', 'guru-staff/48Yshzn7vYe0xYJEEvx1bq9RZRAlr1uMMrxYy5Wu.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 8],
            ['Jayadi, S.Pd., Gr.', 'guru-staff/VshJ8UvjtSa5VHJ5JemUPXcuYBFgVrwvOTXAejuz.png', 'Guru PJOK', 'Guru & Staf', 9],
            ['Yadi Setiadi, S.Sos., Gr.', 'guru-staff/nA7l4RJhEP2YrdBxXlalkJFsdU2alrBkGYtHTs9W.png', 'Guru PKK', 'Guru & Staf', 10],
            ['Siti Nuraeni', 'guru-staff/ukq0AVSD41KVmtBWmWWpcNpkRnOhO6BcJzHZU32K.png', 'Staf Tata Usaha', 'Guru & Staf', 11],
            ['Reza Prafitriansyah, S.Kom., Gr.', 'guru-staff/0KE8f1jx1hb5CXhzFZsBQv3S2RtuGlMqIusqz985.png', 'Guru Dasar DKV', 'Guru & Staf', 12],
            ['Dra. Diana Octaria', 'guru-staff/SQ5BWONNfor8uo1jOXl0spACHJEWHcByOi9LGiob.png', 'Guru PPKn', 'Guru & Staf', 13],
            ['Nabila Ahmadia Pratama, S.Pd.', 'guru-staff/FFZD795JZPsbehHtZY3uwFJMaJMdRAQXhbozMmso.png', 'Guru Bahasa Indonesia', 'Guru & Staf', 14],
            ['Erwin Hasiholan Gultom, S.Kom.', 'guru-staff/zco3poGvjFAuv41JXMDOzq4UtUXAtmzceODltJxl.png', 'Guru Produktif RPL', 'Guru & Staf', 15],
            ['Widyatama Nuranisa, SM.', 'guru-staff/gbUWqIvCt0J0it9OuSsclEjNHJY2wnwTkT0l14AW.png', 'Guru PKK', 'Guru & Staf', 16],
            ['Dara Purwanita, S.Pd., Gr.', 'guru-staff/ZrJQXSoBK4x2MfKlwhsAhBlD13w4Cq4RfwCotTqw.png', 'Guru Bahasa Inggris', 'Guru & Staf', 17],
            ['Mila Yaelasari, M.Pd.', 'guru-staff/pBXqMltd6h1YVC7tp5evmWnTeT2qljyxIOzoDJiK.png', 'Guru Matematika', 'Guru & Staf', 0],
        ];

        GuruStaff::insert(array_map(fn ($row) => [
            'nama_lengkap' => $row[0],
            'foto' => $row[1],
            'jabatan' => $row[2],
            'kategori' => $row[3],
            'urutan' => $row[4],
            'created_at' => $now,
            'updated_at' => $now,
        ], $data));
    }
}