<?php

return [
    // Titiper Home
    'welcome' => 'Selamat Datang',
    'to' => 'ke',
    'subtitle' => 'Titip makanan cepat dan mudah',
    'titipnow' => 'Mulai Titip Sekarang',
    'latestOrd' => 'Titipan Terbaru',
    'latestOrdSub' => 'Ringkasan Titipan Terbaru Anda',
    'menuDeleted' => 'Menu dihapus',
    'NoItem' => 'Tidak ada item',
    'Pending' => 'Menunggu',
    'Completed' => "Selesai",
    'AllOrders' => 'Lihat Semua Titipan',
    'VoucherUnAvail' => "Tidak ada Voucher",
    'RecommMenu' => 'Rekomendasi Menu',
    'SeeMore' => 'Selengkapnya',

    // Titiper Menu Page
    'MenuPage' => [
        'Title' => 'Menu',
        'SearchBarPlaceholder' => 'Mau makan apa hari ini?',
        'Search' => 'Cari',
        'Filter' => 'Semua',
        'NoMenu' => 'Menu tidak ditemukan.',
    ], 

    // Titiper Menu Detail Page
    'MenuDetailPage' => [
        'Title' => 'Detail Menu',
        'Notes' => 'Catatan',
        'Time' => 'Menit',
        'Amount' => 'Jumlah',
        'TitipNow' => 'Titip Sekarang',
        'Back' => 'Kembali ke Menu',
        'NotesModalTitle' => 'Masukkan catatan untuk titipan anda',
        'NotesModalPlaceholder' => 'Masukkan Catatan (Opsional)',
        'NotesModalButton1' => 'Tanpa Catatan',
        'NotesModalButton2' => 'Simpan & Titip'
    ],

    // Titiper Payment Summary Page
    'PaymentSummaryPage' => [
        'Title' => 'Ringkasan Pembayaran',
        'Notes' => 'Catatan',
        'NoNotes' => 'Tidak ada Catatan',
        'Cancel' => 'Batal',
        'Save' => 'Simpan',
        'Edit' => 'Ubah Catatan',
        'Pickup' => "Lokasi Pengambilan",
        'PickupUnknown' => 'Lokasi Pengambilan Tidak Diketahui',
        'Delivery' => 'Pilih Lokasi Pengantaran',
        'AddLocation' => 'Lokasi Baru',
        'floor' => 'Lantai',
        'DeliveryNote' => 'Pastikan anda berada dilokasi pengambilan saat titipan sampai.',
        'PaymentMethod' => 'Metode Pembayaran',
        'CashOnDelivery' => 'Bayar Tunai',
        'CashOnDeliverySub' => 'Bayar secara tunai saat Runner sampai.',
        'BankTransfer' => 'Transfer Bank',
        'PaymentNotes' => 'Metode Pembayaran dapat berubah sampai Runner mengambil pesanan.',
        'Subtotal' => 'Subtotal',
        'Service' => 'Biaya Layanan',
        'Total' => 'Total',
        'TitipNow' => 'Titip Sekarang',
        'AddNewLocations' => 'Tambah Lokasi Baru',
        'AddNewLocationName' => 'Nama Lokasi',
        'AddNewLocationNamePlaceholder' => 'Contoh: Kelas 301, Kantin, Lobby',
        'AddNewLocationFloor' => 'Nomor Lantai',
        'AddNewLocationFloorPlaceholder' => '0 Untuk Basement',
        'AddNewLocationsCancel' => 'Batal',
        'AddNewLocationsSave' => 'Simpan'
    ],


    // Titiper Orders Page
    'OrdersListPage' => [
        'Title' => 'Titipan Saya',
        'Subtitle' => 'Lacak status titipan kamu secara real time.',
        'Search' => 'Cari titipan kamu.....',
        'Status' => [
            'all' => 'Semua',
            'waiting' => 'Menunggu',
            'inprocess' => 'Dalam Proses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ],
        'AddDetail' => 'Masukkan Detail (Opsional)',
        'NoMenu' => 'Menu Dihapus',
        'COD' => 'Bayar Tunai',
        'bank' => 'Transfer',
        'otherItem' => 'Item Lain',
        'cancelReason' => 'Alasan Pembatalan:',
        'Note' => 'Catatan',
        'Total' => 'Total',
        'Waiting' => 'Menunggu',
        'Cancelled' => 'Dibatalkan',
        'Estimation' => 'Estimasi',
        'inProcess' => 'Dalam Proses',
        'Completed' => 'Selesai',
        'RunnerReview' => 'Nilai Runner',
        'NoOrders' => 'Tidak ada Titipan',
        'RedirectMenu' => 'Mulai Titip Sekarang',
        'OrderDetailTitle' => 'Detail Titipan',
        'OrderCancelled' => 'Titipan Dibatalkan',
        'menu' => 'Menu',
        'NoNotes' => 'Tidak ada Catatan',
        'Amount' => 'Jumlah',
        'Pickup' => "Lokasi Pengambilan",
        'Delivery' => 'Lokasi Pengantaran',
        'PaymentMethod' => 'Metode Pembayaran',
        'Statuss' => 'Status',
        'pending' => 'MENUNGGU',
        'Subtotal' => 'Subtotal',
        'Service' => 'Biaya Layanan',
        'Total' => 'Total',
        'Close' => 'Tutup',
        'Undisclosed' => 'Alasan Tidak Diketahui',
        'CancellationConf' => 'Konfirmasi Pembatalan',
        'CancelMessage' => 'Apakah kamu yakin ingin membatalkan titipan?',
        'CancelOption' => [
            'option1' => 'Memilih item yang salah',
            'option2' => 'Ingin mengubah lokasi pengantaran',
            'option3' => 'Ingin mengubah jumlah menu',
            'option4' => 'Lainnya'
        ],
        'Cancel' => 'Batal',
        'CancelOrder' => 'Batalkan Titipan',
        'Review' => 'Ulasan Kamu',
        'ReviewPlaceHolder' => 'Tuliskan Pengalaman Kamu',
        'Submit' => 'Kirim'
    ],

    'CancelOrderSuccess' => 'Titipan berhasil dibatalkan!',
    'CannotCancelOrder' => 'titipan telah diproses dan tidak dapat dibatalkan.',

    // Menu Controller
    'OrderCreatedSuccess' => 'Titipan berhasil dibuat! menunggu Runner.',
    'OrderCreatedFailed' => 'Titipan Gagal: ',
    'OrderCreatedError' => 'Terjadi kesalahan: ',
    
    'LocationAdded' => 'Lokasi berhasil ditambahkan!',
    'Floor' => 'Lantai ',
    'ServerError' => 'Terjadi kesalahan server: ' ,

    // Review Controller
    'NoAccess' => 'Anda tidak memiliki akses!',
    'OrderUncomplete' => 'titipan belum selesai.',
    'OrderReviewed' => 'Anda telah mengulas titipan ini.',
    'SubmitReview' => 'Ulasan berhasil dikirim!'
];