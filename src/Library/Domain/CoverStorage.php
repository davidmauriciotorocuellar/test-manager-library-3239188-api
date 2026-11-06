<?php

namespace Library\Application\Ports;

interface CoverStorage 
{
    public function store(string $filename, string $content): string;
    public function delete(string $coverKey): void;
}