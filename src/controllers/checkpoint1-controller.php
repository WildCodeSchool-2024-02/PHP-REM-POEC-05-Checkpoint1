<?php
require __DIR__ . '/../models/checkpoint1-model.php';

function browsebribes(): void
{
    $bribes = getBribe();
    require __DIR__ . '/../views/indexbribes.php';
}

function sumbribes(): void
{
    $total_payement = getSumBribe();
    require __DIR__ . '/../views/indexbribes.php';
}