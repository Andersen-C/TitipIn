<?php

return [
    // Titiper Home
    'welcome' => 'Welcome',
    'to' => 'to',
    'subtitle' => 'Titip food quickly and easily',
    'titipnow' => 'Start Titip Now',
    'latestOrd' => 'Latest Titipan',
    'latestOrdSub' => 'Your Latest Titipan Summary',
    'menuDeleted' => 'Menu deleted',
    'NoItem' => 'No items',
    'Pending' => 'Pending',
    'Completed' => "Completed",
    'AllOrders' => 'View All Titipan',
    'VoucherUnAvail' => "Voucher Unavailable",
    'RecommMenu' => 'Menu Recommendation',
    'SeeMore' => 'See More',

    // Titiper Menu Page
    'MenuPage' => [
        'Title' => 'Menu',
        'SearchBarPlaceholder' => 'What do you want to eat?',
        'Search' => 'Search',
        'Filter' => 'All',
        'NoMenu' => 'No Menus Found',
    ], 

    // Titiper Menu Detail Page
    'MenuDetailPage' => [
        'Title' => 'Menu Detail',
        'Notes' => 'Notes',
        'Time' => 'Min',
        'Amount' => 'Amount',
        'TitipNow' => 'Titip Now',
        'Back' => 'Back to Menu',
        'NotesModalTitle' => 'Add notes to your dish',
        'NotesModalPlaceholder' => 'Add Notes (Optional)',
        'NotesModalButton1' => 'Without Notes',
        'NotesModalButton2' => 'Save & Titip'
    ],

    // Titiper Payment Summary Page
    'PaymentSummaryPage' => [
        'Title' => 'Payment Summary',
        'Notes' => 'Notes',
        'NoNotes' => 'No Notes',
        'Cancel' => 'Cancel',
        'Save' => 'Save',
        'Edit' => 'Edit Note',
        'Pickup' => "Pickup Location",
        'PickupUnknown' => 'Unknown Pickup Location',
        'Delivery' => 'Choose Delivery Location',
        'AddLocation' => 'New Location',
        'floor' => 'Floor',
        'DeliveryNote' => 'Make sure you are at this location when your titipan arrives.',
        'PaymentMethod' => 'Payment Method',
        'CashOnDelivery' => 'Cash On Delivery',
        'CashOnDeliverySub' => 'Pay in cash to the runner upon delivery.',
        'BankTransfer' => 'Bank Transfer',
        'PaymentNotes' => 'The payment method can be changed until they confirm the titipan.',
        'Subtotal' => 'Subtotal',
        'Service' => 'Service Fee',
        'Total' => 'Total',
        'TitipNow' => 'Titip Now',
        'AddNewLocations' => 'Add New Location',
        'AddNewLocationName' => 'Location Name',
        'AddNewLocationNamePlaceholder' => 'Ex: Kelas 301, Kantin, Lobby',
        'AddNewLocationFloor' => 'Floor Number',
        'AddNewLocationFloorPlaceholder' => '0 For Basement',
        'AddNewLocationsCancel' => 'Cancel',
        'AddNewLocationsSave' => 'Save'
    ],


    // Titiper Orders Page
    'OrdersListPage' => [
        'Title' => 'My Titipan',
        'Subtitle' => 'Track your titipan status in real time.',
        'Search' => 'Search your titipan here...',
        'Status' => [
            'all' => 'All',
            'waiting' => 'Waiting',
            'inprocess' => 'In Process',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ],
        'AddDetail' => 'Add Detail (Optional)',
        'NoMenu' => 'Menu Deleted',
        'COD' => 'Cash On Delivery',
        'bank' => 'Transfer',
        'otherItem' => 'Other Items',
        'cancelReason' => 'Reason for Cancellation:',
        'Note' => 'Notes',
        'Total' => 'Total',
        'Waiting' => 'Waiting',
        'Cancelled' => 'Cancelled',
        'Estimation' => 'Estimation',
        'inProcess' => 'In Process',
        'Completed' => 'Completed',
        'RunnerReview' => 'Rate Runner',
        'NoOrders' => 'No Titipan In',
        'RedirectMenu' => 'Start Buying Now',
        'OrderDetailTitle' => 'Titipan Detail',
        'OrderCancelled' => 'Titipan Cancelled',
        'menu' => 'Menu',
        'NoNotes' => 'No Notes',
        'Amount' => 'Amount',
        'Pickup' => "Pickup Location",
        'Delivery' => 'Delivery Location',
        'PaymentMethod' => 'Payment Method',
        'Statuss' => 'Status',
        'pending' => 'PENDING',
        'Subtotal' => 'Subtotal',
        'Service' => 'Service Fee',
        'Total' => 'Total',
        'Close' => 'Close',
        'Undisclosed' => 'Undisclosed Reason',
        'CancellationConf' => 'Confirm Cancellation',
        'CancelMessage' => 'Are you sure you want to cancel the titipan?',
        'CancelOption' => [
            'option1' => 'Selected the wrong item',
            'option2' => 'Want to change the delivery location',
            'option3' => 'Want to change the menu quantity',
            'option4' => 'Others'
        ],
        'Cancel' => 'Cancel',
        'CancelOrder' => 'Cancel Titipan',
        'Review' => 'Your Review',
        'ReviewPlaceHolder' => 'Write Your Experience',
        'Submit' => 'Submit'
    ],

    'CancelOrderSuccess' => 'Titipan Cancelled Successfully!',
    'CannotCancelOrder' => 'The titipan is already being processed and cannot be cancelled.',

    // Menu Controller
    'OrderCreatedSuccess' => 'Titipan created successfully! Waiting for a Runner.',
    'OrderCreatedFailed' => 'Titipan Failed: ',
    'OrderCreatedError' => 'An error occurred: ',
    
    'LocationAdded' => 'Location Added Successfully!',
    'Floor' => 'Floor ',
    'ServerError' => 'A server error occurred: ' ,

    // Review Controller
    'NoAccess' => 'You Have No Access!',
    'OrderUncomplete' => 'The titipan is not completed yet.',
    'OrderReviewed' => 'You have already reviewed this titipan.',
    'SubmitReview' => 'Review submitted successfully!'
];