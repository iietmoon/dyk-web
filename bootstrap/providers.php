<?php

return [
    // Ensure view is registered before any exception handling needs it (avoids "Class view does not exist" in production).
    Illuminate\View\ViewServiceProvider::class,
    App\Providers\AppServiceProvider::class,
];
