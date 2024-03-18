<?php

return [
    'menuTitle'          => '.env Editor',
    'controllerMessages' => [
        'backupWasCreated'                       => 'Cadangan baru telah dibuat',
        'fileWasRestored'                        => 'File cadangan ":name", dipulihkan sebagai .env default',
        'fileWasDeleted'                         => 'File cadangan ":nama", telah dihapus',
        'currentEnvWasReplacedByTheUploadedFile' => 'File telah diunggah dan menjadi file .env baru',
        'uploadedFileSavedAsBackup'              => 'File diunggah sebagai cadangan dengan nama ":nama"',
        'keyWasAdded'                            => 'Key ":name" telah ditambahkan',
        'keyWasEdited'                           => 'Key ":name" telah diperbarui',
        'keyWasDeleted'                          => 'Key ":nama" telah Dihapus',
    ],
    'views' => [
        'tabTitles' => [
            'upload'     => 'Mengunggah',
            'backup'     => 'Cadangan',
            'currentEnv' => '.env saat ini',
        ],
        'currentEnv' => [
            'title'       => 'Konten file .env saat ini',
            'tableTitles' => [
                'key'     => 'Key',
                'value'   => 'Value',
                'actions' => 'Aksi',
            ],
            'btn' => [
                'edit'                    => 'Edit File',
                'delete'                  => 'Hapus Key',
                'addAfterKey'             => 'Tambahkan key baru setelah key ini',
                'addNewKey'               => 'Tambahkan key baru',
                'deleteConfigCache'       => 'Hapus cache konfigurasi',
                'deleteConfigCacheDesc'   => 'Pada lingkungan produksi, nilai yang diubah mungkin tidak segera diterapkan karena konfigurasi yang di-cache. Jadi, Anda dapat mencoba membatalkan cache-nya',
            ],
            'modal' => [
                'title' => [
                    'new'    => 'Key Baru',
                    'edit'   => 'Sunting Key',
                    'delete' => 'Hapus Key',
                ],
                'input' => [
                    'key'   => 'Key',
                    'value' => 'Value',
                ],
                'btn' => [
                    'close'  => 'Menutup',
                    'new'    => 'Tambahkan Key',
                    'edit'   => 'Perbarui Key',
                    'delete' => 'Hapus Key',
                ],
            ],

        ],
        'upload' => [
            'title'            => 'Di sini Anda dapat mengunggah file ".env" baru sebagai cadangan atau untuk menggantikan ".env" saat ini',
            'selectFilePrompt' => 'Pilih file',
            'btn'              => [
                'clearFile'        => 'Membatalkan',
                'uploadAsBackup'   => 'Unggah sebagai cadangan',
                'uploadAndReplace' => 'Unggah dan ganti .env saat ini',
            ],
        ],
        'backup' => [
            'title'       => 'Di sini Anda dapat melihat daftar file cadangan yang disimpan (jika ada), Anda dapat membuat yang baru, atau mengunduh file .env',
            'tableTitles' => [
                'filename'   => 'Nama file',
                'created_at' => 'Tanggal Pembuatan',
                'actions'    => 'Aksi',
            ],
            'noBackUpItems' => 'Tidak ada cadangan pada direktori pilihan Anda. <br> Anda dapat membuat cadangan pertama dengan menekan tombol "Dapatkan Cadangan baru".',
            'btn'           => [
                'backUpCurrentEnv'   => 'Unduh .env saat ini',
                'downloadCurrentEnv' => 'Unduh .env saat ini',
                'download'           => 'Unduh berkas',
                'delete'             => 'Menghapus berkas',
                'restore'            => 'Pulihkan Berkas',
                'viewContent'        => 'Lihat Isi file',
            ],
        ],
    ],
    'exceptions' => [
        'fileNotExists'    => 'File ":nama" tidak ada !!!',
        'keyAlreadyExists' => 'Kunci ":nama" sudah ada !!!',
        'keyNotExists'     => 'Kunci ":nama" tidak ada !!!',
        'provideFileName'  => 'Anda harus memberikan Nama File !!!',
    ],

];
