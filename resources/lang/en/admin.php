<?php

return [
    // Admin Home Page
    'Introduction' => 'Hi, Admin',
    'UserCard' => 'Total User',
    'RunnerCard' => 'Total Active Runner',
    'MenuCard' => 'Total Menu',
    'OrderCard' => 'Total Orders',
    'Stat1' => [
        'Title' => 'Total Order Revenue for the Last 7 Days'
    ],
    'Stat2' => [
        'Title' => 'Number of Orders During the Last 7 Days'
    ],
    'LeftTable' => [
        'Title' => 'Runner Leaderboard',
        'Rank' => 'Rank',
        'Name' => 'Name',
        'Order' => 'Total Orders'
    ],
    'RightTable' => [
        'Title' => 'Menu Leaderboard',
        'Rank' => 'Rank',
        'Name' => 'Name',
        'Sold' => 'Sold',
        'Location' => 'Location'
    ],

    // Manage Page
    'ManageUser' => [
        'Title1' => 'Manage',
        'Title2' => 'Users',
        'Desc' => 'View, create, and manage all user accounts and roles.'
    ],
    'ManageLocation' => [
        'Title1' => 'Manage',
        'Title2' => 'Locations',
        'Desc' => 'View, create, and manage all location in the system.'
    ],
    'ManageCategory' => [
        'Title1' => 'Manage',
        'Title2' => 'Categories',
        'Desc' => 'View, create, and manage all the categories in the system.'
    ],
    'ManageMenu' => [
        'Title1' => 'Manage',
        'Title2' => 'Menus',
        'Desc' => 'View, create, and manage all menus in the system.'
    ],
    'ManageOrders' => [
        'Title1' => 'Manage',
        'Title2' => 'Orders',
        'Desc' => 'View and manage all orders and order items in the system.'
    ],
    'ManageReview' => [
        'Title1' => 'Manage',
        'Title2' => 'Reviews',
        'Desc' => 'View and manage all the reviews in the system.'
    ],

    // Universal Button (For Manage User - Review)
    'Back' => 'Back',
    'Add' => 'Add',
    'Details' => 'Details',
    'Update' => 'Update',
    'Delete' => 'Delete',

    // Manage User Page
    'UserTable' => [
        'Title' => 'Manage Users',
        'No' => 'No.',
        'Name' => 'Name',
        'Role' => 'Role',
        'AvgRating' => 'Average Rating',
        'Action' => 'Action'
    ],
    'UserDeleteModal' => [
        'Title' => 'Confirm Deletion',
        'Message1' => "Are you sure you want to delete",
        'Message2' => 'This action cannot be undone.',
        'Cancel' => 'Cancel',
    ],

    // Create User Page
    'CreateUserTitle' => 'Create User',
    'CreateUserForm' => [
        'Name' => [
            'Title' => 'Username',
            'Placeholder' => 'Enter Username'
        ],
        'Phone' => [
            'Title' => 'Phone Number',
            'Placeholder' => 'Enter Phone Number'
        ],
        'Email' => [
            'Title' => 'Email',
            'Placeholder' => 'Enter Email'
        ],
        'Role' => [
            'Title' => 'Role',
            'Placeholder' => 'Choose Role'
        ],
        'Mode' => [
            'Title' => 'Mode',
            'Placeholder' => 'Choose Mode'
        ],
        'ProfilePic' => [
            'Title' => 'Profile Picture (Optional)',
            'Placeholder' => 'No File Chosen',
            'Choose' => 'Choose File'
        ],
        'Password' => [
            'Title' => 'Password',
            'Placeholder' => 'Enter Password'
        ],
        'PasswordConf' => [
            'Title' => 'Password Confirmation',
            'Placeholder' => 'Re-enter Password'
        ],
        'Submit' => 'Submit'
    ],
    
    // ManageUserController Page
    'CreateUserSuccess' => 'The user has been created successfully.'
];