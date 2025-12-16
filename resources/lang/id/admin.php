<?php

return [
    // Admin Home Page
    'Introduction' => 'Halo, Admin',
    'UserCard' => 'Total User',
    'RunnerCard' => 'Total Runner Aktif',
    'MenuCard' => 'Total Menu',
    'OrderCard' => 'Total Titipan',
    'Stat1' => [
        'Title' => 'Total Pendapatan Titipan Dalam 7 Hari Terakhir'
    ],
    'Stat2' => [
        'Title' => 'Jumlah Titipan Dalam 7 Hari Terakhir'
    ],
    'LeftTable' => [
        'Title' => 'Runner Leaderboard',
        'Rank' => 'Rank',
        'Name' => 'Nama',
        'Order' => 'Total Titipan'
    ],
    'RightTable' => [
        'Title' => 'Menu Leaderboard',
        'Rank' => 'Rank',
        'Name' => 'Nama',
        'Sold' => 'Jumlah Terjual',
        'Location' => 'Lokasi'
    ],

    // Manage Page
    'ManageUser' => [
        'Title1' => 'Kelola',
        'Title2' => 'Pengguna',
        'Desc' => 'Lihat, buat, dan kelola semua akun pengguna dan perannya.'
    ],
    'ManageLocation' => [
        'Title1' => 'Kelola',
        'Title2' => 'Lokasi',
        'Desc' => 'Lihat, buat, dan kelola semua lokasi dalam sistem.'
    ],
    'ManageCategory' => [
        'Title1' => 'Kelola',
        'Title2' => 'Kategori',
        'Desc' => 'Lihat, buat, dan kelola semua kategori dalam sistem.'
    ],
    'ManageMenu' => [
        'Title1' => 'Kelola',
        'Title2' => 'Menu',
        'Desc' => 'Lihat, buat, dan kelola semua menu dalam sistem.'
    ],
    'ManageOrders' => [
        'Title1' => 'Kelola',
        'Title2' => 'Titipan',
        'Desc' => 'Lihat dan kelola seluruh titipan dan item titipan dalam sistem.'
    ],
    'ManageReview' => [
        'Title1' => 'Kelola',
        'Title2' => 'Ulasan',
        'Desc' => 'Lihat dan kelola seluruh ulasan dalam sistem.'
    ],

    // Universal Button (For Manage User - Review)
    'Back' => 'Kembali',
    'Add' => 'Tambah',
    'Details' => 'Selengkapnya',
    'Update' => 'Memperbarui',
    'Delete' => 'Hapus',

    // Manage User Page
    'UserTable' => [
        'Title' => 'Kelola Pengguna',
        'No' => 'No.',
        'Name' => 'Nama',
        'Role' => 'peran',
        'AvgRating' => 'Rata-rata Penilaian',
        'Action' => 'Aksi'
    ],
    'UserDeleteModal' => [
        'Title' => 'Konfirmasi Penghapusan',
        'Message1' => "Apakah kamu yakin ingin menghapus",
        'Message2' => 'Aksi ini bersifat permanen.',
        'Cancel' => 'Batal',
    ],

    // Create User Page
    'CreateUserTitle' => 'Membuat Pengguna',
    'CreateUserForm' => [
        'Name' => [
            'Title' => 'Username',
            'Placeholder' => 'Masukkan Username'
        ],
        'Phone' => [
            'Title' => 'Nomor Telepon',
            'Placeholder' => 'Masukkan Nomor Telepon'
        ],
        'Email' => [
            'Title' => 'Email',
            'Placeholder' => 'Masukkan Email'
        ],
        'Role' => [
            'Title' => 'Peran',
            'Placeholder' => 'Pilih Peran'
        ],
        'Mode' => [
            'Title' => 'Mode',
            'Placeholder' => 'Pilih Mode'
        ],
        'ProfilePic' => [
            'Title' => 'Gambar Profil (Opsional)',
            'Placeholder' => 'Tidak Ada File',
            'Choose' => 'Pilih File'
        ],
        'Password' => [
            'Title' => 'Password',
            'Placeholder' => 'Masukkan Password'
        ],
        'PasswordConf' => [
            'Title' => 'Konfirmasi Password',
            'Placeholder' => 'Masukkan Kembali Password'
        ],
        'Submit' => 'Kirim'
    ],
    
    // ManageUserController Page
    'CreateUserSuccess' => 'Pengguna Berhasil Dibuat!',
    'UpdateUserSuccess' => 'Pengguna Berhasil Diperbarui!',
    'DeleteUserSuccess' => 'Pengguna Berhasil Dihapus!',

    // Update User Page
    'UpdateUserTitle' => 'Membaharui Pengguna',
    'UpdateProfilePic-NoPic' => 'Tidak ada Gambar',

    // User Detail Page
    'UserDetailTitle' => 'Detail Pengguna',

    // Manage Locations Page
    'LocTable' => [
        'Title' => 'Kelola Lokasi',
        'No' => 'No.',
        'Name' => 'Nama',
        'Floor' => 'Nomor Lantai',
        'Action' => 'Aksi'
    ],
    'LocDeleteModal' => [
        'Title' => 'Konfirmasi Penghapusan',
        'Message1' => "Apakah kamu yakin ingin menghapus",
        'Message2' => 'Aksi ini bersifat permanen.',
        'Cancel' => 'Batal',
    ],
    'LocAddModal' => [
        'Title' => "Tambah Lokasi Baru",
    ],
    'LocUpdateModal' => [
        'Title' => 'Membaharui Lokasi',
        'Name' => [
            'Title' => 'Nama Lokasi',
            'Placeholder' => 'Masukkan Nama Lokasi'
        ],
        'Floor' => [
            'Title' => 'Nomor Lantai',
            'Placeholder' => 'Masukkan Nomor Lantai (0 Untuk Basement)'
        ]
    ],

    'AddLocSuccessTitle' => 'Lokasi Berhasil Dibuat!',
    'UpdateLocSuccessTitle' => 'Lokasi Berhasil Diperbarui!',
    'DeleteLocSuccessTitle' => 'Lokasi Berhasil Dihapus!',

    // Manage Categories
    'CatTable' => [
        'Title' => 'Kelola Kategori',
        'No' => 'No.',
        'Name' => 'Nama',
        'Group' => 'Grup',
        'Action' => 'Aksi',
        'NoGroup' => 'Tidak Ada Grup'
    ],
    'CatAddModal' => [
        'Title' => "Tambah Kategori Baru",
    ],
    'CatUpdateModal' => [
        'Title' => 'Memperbarui Kategori',
        'Name' => [
            'Title' => 'Nama Kategori',
            'Placeholder' => 'Masukkan Nama Kategori'
        ],
        'Group' => [
            'Title' => 'Grup',
            'Placeholder' => 'Masukkan Grup'
        ]
    ],

    // Alert
    'AddCatSuccessTitle' => 'Kategori Berhasil Dibuat!',
    'UpdateCatSuccessTitle' => 'Kategori Berhasil Diperbarui!',
    'DeleteCatSuccessTitle' => 'Kategori Berhasil Dihapus!',

    // Manage Menu Page
    'MenuTable' => [
        'Title' => 'Kelola Menu',
        'No' => 'No.',
        'Image' => 'Gambar',
        'Price' => 'Harga',
        'Name' => 'Nama',
        'Location' => 'Lokasi',
        'Desc' => 'Deskripsi',
        'Action' => 'Aksi',
        'NoMenu' => "Menu Tidak Ditemukan"
    ],

    // Menu Detail Page
    'MenuDetailPage' => [
        'Title' => 'Detail Menu',
        'NoImg' => 'Tidak ada Gambar',
        'Category' => 'Kategori'
    ],

    // Create Menu
    'MenuCreatePage' => [
        'Title' => 'Membuat Menu',
        'CatPlaceholder' => 'Pilih Kategori',
        'LocPlaceholder' => 'Pilih Lokasi',
        'ImgTitle' => 'Upload Gambar',
        'ImgNo' => 'Tidak ada file yang dipilih'
    ],

    // Update Menu
    'MenuUpdatePage' => [
        'Title' => 'Memperbarui Menu',
        'Name' => [
            'Title' => 'Nama',
            'Placeholder' => 'Masukkan Nama Menu'
        ],
        'Price' => [
            'Title' => 'Price (Rp)',
            'Placeholder' => 'Masukkan Harga Menu'
        ],
        'Category' => [
            'Title' => "Kategori"
        ],
        'Location' => [
            'Title' => "Lokasi"
        ],
        'Desc' => [
            'Title' => "Deskripsi",
            'Placeholder' => "Masukkan Deskripsi"
        ],
        'Image' => [
            'Title' => 'Upload Gambar (Opsional)',
            'NoImg' => 'Tidak ada file yang dipilih',
            'Choose' => 'Pilih File'
        ]
    ],

    // Alert
    'AddMenuSuccessTitle' => 'Menu Berhasil Dibuat!',
    'UpdateMenuSuccessTitle' => 'Menu Berhasil Diperbarui!',
    'DeleteMenuSuccessTitle' => 'Menu Berhasil Dihapus!',

    // Manage Order Page
    'OrderTable' => [
        'Title' => 'Kelola Titipan',
        'No' => 'No.',
        'Titiper' => 'Titiper',
        'Runner' => 'Runner',
        'Status' => 'Status',
        'Total' => 'Total',
        'Date' => 'Tanggal',
        'Action' => 'Aksi'
    ],

    'OrderDeleteModal' => [
        'Title' => 'Konfirmasi Penghapusan',
        'Message' => 'Apakah anda yakin ingin menghapus titipan ini?',
        'Cancel' => 'Batal',
        'Delete' => 'Hapus'
    ],

    'OrderUpdatePage' => [
        'Title' => 'Memperbarui Status Titipan',
        'OrderID' => 'ID Titipan',
        'Status' => 'Status Titipan',
        'Waiting' => 'Menunggu Runner',
        'Accepted' => 'Diterima',
        'Arrived' => 'Tiba di Lokasi Pick up',
        'Completed' => 'Selesai',
        'Cancelled' => 'Dibatalkan',
        'OrderStatusDesc1' => 'Titipan dengan status',
        'OrderStatusDesc2' => 'tidak dapat diubah',
        'Update' => 'Memperbarui Status'
    ],

    'OrderDetailPage' => [
        'Title' => 'Detail Titipan',
        'OrderID' => 'ID Titipan',
        'Date' => 'Tanggal',
        'Status' => 'Status',
        'Titiper' => 'Titiper',
        'Runner' => 'Runner',
        'Pickup' => "Lokasi Pick up",
        'Delivery' => 'Lokasi Pengiriman',
        'Items' => 'Item Pesanan',
        'Menu' => 'Menu',
        'Qty' => 'Qty',
        'Price' => 'Harga',
        'Total' => 'Total',
        'Subtotal' => 'Subtotal',
        'Service' => 'Biaya Service',
    ],

    'UpdateOrderSuccessTitle' => 'Titipan Berhasil Diperbarui!',
    'DeleteOrderSuccessTitle' => 'Titipan Berhasil Dihapus!',

    // Manage Review Page
    'ReviewTable' => [
        'Title' => 'Kelola Ulasan',
        'No' => 'No.',
        'OrderID' => 'ID Titipan',
        'Titiper' => 'Titiper',
        'Runner' => 'Runner',
        'Rating' => 'Penilaian',
        'Comment' => 'Komen',
        'Date' => 'Tanggal',
        'Action' => 'Aksi'
    ],

    'DeleteReviewModal' => [
        'Title' => 'Konfirmasi Penghapusan',
        'Message1' => 'Apakah anda yakin ingin menghapus ulasan ini?',
        'Message2' => 'Aksi ini bersifat permanen.'
    ],

    'ReviewDetailPage' => [
        'Title' => 'Detail Ulasan',
        'OrderID' => 'ID Titipan',
        'Titiper' => 'Titiper',
        'Runner' => 'Runner',
        'Rating' => 'Penilaian',
        'Comment' => 'Komen',
        'Created' => "Dibuat pada"
    ],

    'DeleteReviewSuccessTitle' => 'Review Berhasil Dihapus!',
    'NoComment' => 'Tidak ada Komen'
];