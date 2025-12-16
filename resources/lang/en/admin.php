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
        'CreateUserSuccess' => 'User has been created successfully!',
        'UpdateUserSuccess' => 'User updated successfully!',
        'DeleteUserSuccess' => 'User deleted successfully!',

        // Update User Page
        'UpdateUserTitle' => 'Update User',
        'UpdateProfilePic-NoPic' => 'No Image',

        // User Detail Page
        'UserDetailTitle' => 'User Detail',

        // Manage Locations Page
        'LocTable' => [
            'Title' => 'Manage Locations',
            'No' => 'No.',
            'Name' => 'Name',
            'Floor' => 'Floor Number',
            'Action' => 'Action'
        ],
        'LocDeleteModal' => [
            'Title' => 'Confirm Deletion',
            'Message1' => "Are you sure you want to delete",
            'Message2' => 'This action cannot be undone.',
            'Cancel' => 'Cancel',
        ],
        'LocAddModal' => [
            'Title' => "Add New Location",
        ],
        'LocUpdateModal' => [
            'Title' => 'Update Location',
            'Name' => [
                'Title' => 'Location Name',
                'Placeholder' => 'Enter Location Name'
            ],
            'Floor' => [
                'Title' => 'Floor Number',
                'Placeholder' => 'Enter Floor Number (0 For Basement)'
            ]
        ],

        'AddLocSuccessTitle' => 'Location has been created successfully!',
        'UpdateLocSuccessTitle' => 'Location updated successfully!',
        'DeleteLocSuccessTitle' => 'Location deleted successfully!',

        // Manage Categories
        'CatTable' => [
            'Title' => 'Manage Categories',
            'No' => 'No.',
            'Name' => 'Name',
            'Group' => 'Group',
            'Action' => 'Action',
            'NoGroup' => 'No Group'
        ],
        'CatAddModal' => [
            'Title' => "Add New Category",
        ],
        'CatUpdateModal' => [
            'Title' => 'Update Category',
            'Name' => [
                'Title' => 'Category Name',
                'Placeholder' => 'Enter Category Name'
            ],
            'Group' => [
                'Title' => 'Group',
                'Placeholder' => 'Enter The Group'
            ]
        ],

        // Alert
        'AddCatSuccessTitle' => 'Category has been created successfully!',
        'UpdateCatSuccessTitle' => 'Category updated successfully!',
        'DeleteCatSuccessTitle' => 'Category deleted successfully!',

        // Manage Menu Page
        'MenuTable' => [
            'Title' => 'Manage Menus',
            'No' => 'No.',
            'Image' => 'Image',
            'Price' => 'Price',
            'Name' => 'Name',
            'Location' => 'Location',
            'Desc' => 'Description',
            'Action' => 'Action',
            'NoMenu' => "No Menus Found"
        ],

        // Menu Detail Page
        'MenuDetailPage' => [
            'Title' => 'Detail Menu',
            'NoImg' => 'No image',
            'Category' => 'Category'
        ],

        // Create Menu
        'MenuCreatePage' => [
            'Title' => 'Create Menu',
            'CatPlaceholder' => 'Choose Category',
            'LocPlaceholder' => 'Choose Location',
            'ImgTitle' => 'Upload Image',
            'ImgNo' => 'No File Chosen'
        ],

        // Update Menu
        'MenuUpdatePage' => [
            'Title' => 'Update Menu',
            'Name' => [
                'Title' => 'Name',
                'Placeholder' => 'Enter Food Name'
            ],
            'Price' => [
                'Title' => 'Price (Rp)',
                'Placeholder' => 'Enter Food Price'
            ],
            'Category' => [
                'Title' => "Category"
            ],
            'Location' => [
                'Title' => "Location"
            ],
            'Desc' => [
                'Title' => "Description",
                'Placeholder' => "Enter Description"
            ],
            'Image' => [
                'Title' => 'Upload Image (Optional)',
                'NoImg' => 'No File Chosen',
                'Choose' => 'Choose File'
            ]
        ],

        // Alert
        'AddMenuSuccessTitle' => 'Menu has been created successfully!',
        'UpdateMenuSuccessTitle' => 'Menu updated successfully!',
        'DeleteMenuSuccessTitle' => 'Menu deleted successfully!',

        // Manage Order Page
        'OrderTable' => [
            'Title' => 'Manage Orders',
            'No' => 'No.',
            'Titiper' => 'Titiper',
            'Runner' => 'Runner',
            'Status' => 'Status',
            'Total' => 'Total',
            'Date' => 'Date',
            'Action' => 'Action'
        ],

        'OrderDeleteModal' => [
            'Title' => 'Confirm Deletion',
            'Message' => 'Are you sure you want to delete this order?',
            'Cancel' => 'Cancel',
            'Delete' => 'Delete'
        ],

        'OrderUpdatePage' => [
            'Title' => 'Update Order Status',
            'OrderID' => 'Order ID',
            'Status' => 'Order Status',
            'Waiting' => 'Waiting Runner',
            'Accepted' => 'Accepted',
            'Arrived' => 'Arrived at Pickup',
            'Completed' => 'Completed',
            'Cancelled' => 'Cancelled',
            'OrderStatusDesc1' => 'Order With Status',
            'OrderStatusDesc2' => 'cannot be changed',
            'Update' => 'Update Status'
        ],

        'OrderDetailPage' => [
            'Title' => 'Order Detail',
            'OrderID' => 'Order ID',
            'Date' => 'Date',
            'Status' => 'Status',
            'Titiper' => 'Titiper',
            'Runner' => 'Runner',
            'Pickup' => "Pickup Location",
            'Delivery' => 'Delivery Location',
            'Items' => 'Order Items',
            'Menu' => 'Menu',
            'Qty' => 'Qty',
            'Price' => 'Price',
            'Total' => 'Total',
            'Subtotal' => 'Subtotal',
            'Service' => 'Service Fee',
        ],

        'UpdateOrderSuccessTitle' => 'Order updated successfully!',
        'DeleteOrderSuccessTitle' => 'Order deleted successfully!',

        // Manage Review Page
        'ReviewTable' => [
            'Title' => 'Manage Reviews',
            'No' => 'No.',
            'OrderID' => 'Order ID',
            'Titiper' => 'Titiper',
            'Runner' => 'Runner',
            'Rating' => 'Rating',
            'Comment' => 'Comment',
            'Date' => 'Date',
            'Action' => 'Action'
        ],

        'DeleteReviewModal' => [
            'Title' => 'Confirm Deletion',
            'Message1' => 'Are you sure you want to delete this review?',
            'Message2' => 'This action cannot be undone.'
        ],

        'ReviewDetailPage' => [
            'Title' => 'Review Detail',
            'OrderID' => 'Order ID',
            'Titiper' => 'Titiper',
            'Runner' => 'Runner',
            'Rating' => 'Rating',
            'Comment' => 'Comment',
            'Created' => "Created on"
        ],

        'DeleteReviewSuccessTitle' => 'Review deleted successfully!',
        'NoComment' => 'No Comment',
        
    ];