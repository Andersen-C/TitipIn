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
];