<?php

return [
    // Register Page Validation
    'name' => [
        'required' => 'Username is required',
        'string' => 'Username must be a valid text',
        'min' => 'Username must be at least :min characters',
        'max' => 'Username must not be greater than :max characters'
    ],

    'phone_number' => [
        'required' => 'Phone number is required',
        'regex' => 'Phone number must follow "08xxxxxxxxxx" format',
        'unique' => 'Phone number is already in use'
    ],

    'email' => [
        'required' => 'Email is required',
        'email' => 'Invalid email format',
        'unique' => 'Email is already in use'
    ],

    'password' => [
        'required' => 'Password is required',
        'min' => 'Password must be at least :min characters',
        'confirmed' => 'Password confirmation does not match',
    ],


    // Manage User Validation 
    'ManageUser' => [
        'name' => [
            'required' => 'Username is required',
            'min' => 'Username must be at least :min characters',
            'max' => 'Username must not be greater than :max characters'
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'Invalid email format',
            'unique' => 'Email is already in use'
        ],
        'role' => [
            'required' => 'Role is required',
            'in' => 'Invalid Role'
        ],
        'mode' => [
            'required' => 'Mode is required',
            'in' => 'Invalid Mode'
        ],
        'profile_pic' => [
            'image' => 'Profile picture must be an image',
            'mimes' => 'Image format must be JPG, JPEG or PNG',
            'max' => 'Image size must not be more than 2 MB'
        ],
        'password' => [
            'required' => 'Password is required',
            'min' => 'Password must be at least :min characters',
            'confirmed' => 'Password confirmation does not match',
        ],
        'password_confirmation' => [
            'required' => 'Password Confirmation is required'
        ]
    ],

    // Manage Locations
    'ManageLoc' => [
        'name' => [
            'required' => 'Location name is required',
            'string' => 'Location name must be a valid text',
            'min' => 'Location name must be at least :min characters',
            'max' => 'Location name must not be greater than :max characters',
        ],
        'Floor' => [
            'required' => 'Floor number is required',
            'integer ' => 'Floor number must be an integer',
            'min' => 'Floor number must not be less than 0',
        ]
    ],

    // Manage Categories
    'ManageCat' => [
        'name' => [
            'required' => 'Category name is required',
            'string' => 'Category name must be a valid text',
            'min' => 'Category name must be at least :min characters',
            'max' => 'Category name must not be greater than :max characters',
            'unique' => 'Category name is already in use'
        ],
        'Group' => [
            'string' => 'Group must be a valid text',
            'max' => 'Group must not be greater than :max characters'
        ]
    ],
    
    // Manage Menu
    'ManageMenu' => [
        'name' => [
            'required' => 'Menu name is required',
            'string' => 'Menu name must be a valid text',
            'min' => 'Menu name must be at least :min characters',
            'max' => 'Menu name must not be greater than :max characters',
        ],
        'desc' => [
            'string' => 'Description must be a valid text'
        ],
        'price' => [
            'required' => 'Price is required',
            'numeric' => 'Price must be a number',
            'min' => 'Price must be at least :min'
        ],
        'category_id' => [
            'required' => 'Category is required',
            'exists' => 'Selected category is invalid'
        ],
        'location_id' => [
            'required' => 'Location is required',
            'exists' => 'Selected location is invalid'
        ],
        'image' => [
            'required' => 'Image is required',
            'image' => 'must be an image',
            'max' => 'Image size must not be more than 2 MB'
        ]
    ],

    // 

    // Profile Controller
    'ManageProfile' => [
        'name' => [
            'required' => 'Username is required',
            'string' => 'Username must be a valid text',
            'max' => 'Username must not be greater than :max characters'
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'Invalid email format',
            'max' => 'Email must not be greater than :max characters',
            'unique' => 'Email is already in use'
        ],
        'phone' => [
             'required' => 'Phone number is required',
            'numeric' => 'Phone number must be a number',
            'min_digits' => "Phone number must at least have :min_digits numbers"
        ],
        'photo' => [
            'required' => 'Profile Picture is required',
            'image' => 'Profile picture must be an image',
            'mimes' => 'Image format must be JPG, JPEG or PNG',
            'max' => 'Image size must not be more than 2 MB'
        ]
    ],
];