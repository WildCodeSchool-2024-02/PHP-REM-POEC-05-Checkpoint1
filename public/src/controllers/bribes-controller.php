<?php
require __DIR__ . '/../models/bribes-model.php';

function browseBribes(): array
{
    $bribes = getAllBribes();

    return $bribes;
}