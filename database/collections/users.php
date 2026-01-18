<?php

use Illuminate\Support\Str;

return [
    [
        'id' => Str::uuid(),
        'name' => 'fredyns',
        'email' => 'dm@fredyns.id',
        'email_verified_at' => now(),
        'password' => '$2y$12$WvjfVopnzLYtfD0AULAFAuVOdF8OOVFb76OjS04Uwc6YgpklOmiy.',
        'remember_token' => Str::random(10),
    ],
    [
        'id' => Str::uuid(),
        'name' => 'fredy',
        'email' => 'fredy.ns@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$12$E4fQVLQTXZB6cxVFA20LNemC1HfpAYaNSzEVMvavayvEupOD2fjqe',
        'remember_token' => Str::random(10),
    ],
    [
        'id' => Str::uuid(),
        'name' => 'Fredy BKI',
        'email' => 'fredy.ns@bki.co.id',
        'email_verified_at' => now(),
        'password' => '$2y$12$E4fQVLQTXZB6cxVFA20LNemC1HfpAYaNSzEVMvavayvEupOD2fjqe',
        'remember_token' => Str::random(10),
    ],
];
