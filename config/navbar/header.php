<?php
/**
 * Supply the basis for the navbar as an array.
 */

return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items

    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Frågor",
            "url" => "questions",
            "title" => "Frågor",
        ],
        [
            "text" => "Taggar",
            "url" => "taggar",
            "title" => "Taggar",
        ],
        [
            "text" => "Användare",
            "url" => "user/all",
            "title" => "Användare",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Profil",
            "url" => "user",
            "title" => "Profil",
        ],
    ],
];
