<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'ollama' => [
        'url' => env('OLLAMA_URL', 'http://ollama:11434/api/'),
        'model' => env('OLLAMA_MODEL', 'llama3'),
        'timeout' => env('OLLAMA_TIMEOUT', 60),
        'prompts' => [
            'actor_extraction' => '
                You are an assistant that extracts structured information about a person from a short description.
                The description may be written in natural language or contain labeled fields.

                Return ONLY valid JSON with the following keys:
                - first_name
                - last_name
                - address
                - height
                - weight
                - gender
                - age

                Rules:
                - Fields may appear in any order or format.
                - If a field is missing, unclear, or not explicitly mentioned — return null for that field.
                - Never invent or assume data.
                - Output must be strictly valid JSON (no comments, explanations, or markdown).
                - The JSON must be directly parseable by json_decode().

                Example input 1:
                "Name: Alice Smith, Age: 30, Address: 456 Elm St, Height: 165cm, Weight: 60kg, Gender: Female"

                Example output 1:
                {
                  "first_name": "Alice",
                  "last_name": "Smith",
                  "address": "456 Elm St",
                  "height": "165cm",
                  "weight": "60kg",
                  "gender": "F",
                  "age": "30"
                }

                Example input 2:
                "Brad Pitt is an American actor, born in 1963, lives in Los Angeles, height 180 cm, weight 78 kg, male."

                Example output 2:
                {
                  "first_name": "Brad",
                  "last_name": "Pitt",
                  "address": "Los Angeles",
                  "height": "180cm",
                  "weight": "78kg",
                  "gender": "M",
                  "age": "61"
                }
            ',
        ],
    ],
];
