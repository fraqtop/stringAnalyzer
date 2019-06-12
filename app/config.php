<?php

return [
    'router' => DI\create(\App\Adapters\SlimRouter::class)->constructor('#', 'App\\Controllers\\'),
    'renderer' => DI\create(\App\Adapters\TwigRenderer::class),
    'processor' => DI\create(\App\Models\AnagramFinder::class)
];