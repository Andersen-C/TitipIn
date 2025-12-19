<?php

return [
    // Register Page Validation
    'name' => [
        'required' => 'Username wajib diisi',
        'string' => 'Username harus berupa teks yang valid',
        'min' => 'Username minimal memiliki :min karakter',
        'max' => 'Username maksimal memiliki :max karakter'
    ],

    'phone_number' => [
        'required' => 'Nomor telepon wajib diisi',
        'regex' => 'Nomor telepon harus mengikuti format 08xxxxxxxxxx',
        'unique' => 'Nomor telepon telah dipakai oleh akun lain'
    ],

    'email' => [
        'required' => 'Email wajib diisi',
        'email' => 'Format email tidak valid',
        'unique' => 'Email telah dipakai oleh akun lain'
    ],

    'password' => [
        'required' => 'Password wajib diisi',
        'min' => 'Password minimal memiliki :min karakter',
        'confirmed' => 'Konfirmasi password tidak sesuai',
    ],


    // Manage User Validation 
    'ManageUser' => [
        'name' => [
            'required' => 'Username wajib diisi',
            'min' => 'Username minimal memiliki :min karakter',
            'max' => 'Username maksimal memiliki :max karakter'
        ],
        'email' => [
            'required' => 'Email wajib diisi',
            'email' => 'Format email tidak valid',
            'unique' => 'Email telah dipakai oleh akun lain'
        ],
        'role' => [
            'required' => 'Role wajib diisi',
            'in' => 'Role tidak valid'
        ],
        'mode' => [
            'required' => 'Mode wajib diisi',
            'in' => 'Mode tidak valid'
        ],
        'profile_pic' => [
            'image' => 'Foto profil harus berupa gambar',
            'mimes' => 'format gambar harus berupa JPG, JPEG atau PNG',
            'max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
        ],
        'password' => [
            'required' => 'Password wajib diisi',
            'min' => 'Password minimal memiliki :min karakter',
            'confirmed' => 'Konfirmasi password tidak sesuai',
        ],
        'password_confirmation' => [
            'required' => 'Konfirmasi Password wajib diisi'
        ]
    ],

    // Manage Locations
    'ManageLoc' => [
        'name' => [
            'required' => 'Nama Lokasi wajib diisi',
            'string' => 'Nama Lokasi harus berupa teks yang valid',
            'min' => 'Nama Lokasi minimal memiliki :min karakter',
            'max' => 'Nama Lokasi maksimal memiliki :max karakter',
        ],
        'Floor' => [
            'required' => 'Nomor Lantai wajib diisi',
            'integer ' => 'Nomor Lantai harus berupa bilangan bulat',
            'min' => 'Nomor Lantai tidak boleh dibawah angka 0',
        ]
    ],

    // Manage Categories
    'ManageCat' => [
        'name' => [
            'required' => 'Nama kategori wajib diisi',
            'string' => 'Nama kategori harus berupa teks yang valid',
            'min' => 'Nama kategori minimal memiliki :min karakter',
            'max' => 'Nama kategori maksimal memiliki :max karakter',
            'unique' => 'Nama kategori telah dipakai'
        ],
        'Group' => [
            'string' => 'Group harus berupa teks yang valid',
            'max' => 'Group maksimal memiliki :max karakter'
        ]
    ],
    
    // Manage Menu
    'ManageMenu' => [
        'name' => [
            'required' => 'Nama menu wajib diisi',
            'string' => 'Nama menu harus berupa teks yang valid',
            'min' => 'Nama menu minimal memiliki :min karakter',
            'max' => 'Nama menu maksimal memiliki :max karakter',
        ],
        'desc' => [
            'string' => 'Deskripsi harus berupa teks yang valid'
        ],
        'price' => [
            'required' => 'Harga wajib diisi',
            'numeric' => 'Harga harus berupa angka',
            'min' => 'Harga minimal harus :min'
        ],
        'category_id' => [
            'required' => 'Kategori wajib diisi',
            'exists' => 'Kategori yang dipilih tidak valid'
        ],
        'location_id' => [
            'required' => 'Lokasi wajib diisi',
            'exists' => 'Lokasi yang dipilih tidak valid'
        ],
        'image' => [
            'required' => 'Gambar wajib diisi',
            'image' => 'Harus berupa gambar',
            'max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
        ]
    ],

    // 

    // Profile Controller
    'ManageProfile' => [
        'name' => [
            'required' => 'Username wajib diisi',
            'string' => 'Username harus berupa teks yang valid',
            'max' => 'Username maksimal memiliki :max karakter'
        ],
        'email' => [
            'required' => 'Email wajib diisi',
            'email' => 'Format email tidak valid',
            'max' => 'Email maksimal memiliki :max karakter',
            'unique' => 'Email telah dipakai oleh akun lain'
        ],
        'phone' => [
             'required' => 'Nomor telepon wajib diisi',
            'numeric' => 'Nomor telepon harus berupa angka',
            'min_digits' => "Nomor telepon minimal memiliki :min_digits angka"
        ],
        'photo' => [
            'required' => 'Foto profil wajib diisi',
            'image' => 'Foto profil harus berupa gambar',
            'mimes' => 'format gambar harus berupa JPG, JPEG atau PNG',
            'max' => 'Ukuran gambar tidak boleh melebihi 2 MB'
        ]
    ],
];