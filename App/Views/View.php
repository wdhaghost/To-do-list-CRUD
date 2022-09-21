<?php

namespace App\Views;

abstract class View
{
    protected static string $filename;
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    //Getters et Setters
    public function getFilename()
    {
        return static::$filename;
    }
    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function setData(string $data)
    {
        $this->data = $data;
    }
    //Methods
    
    public function getFileContent(): string|false
    {
        return file_get_contents(static::$filename);
    }

    public function getHtml(): string
    {
        return str_replace(array_map(fn ($s) => "{{" . $s . "}}", array_keys($this->getData())), array_values($this->getData()), $this->getFileContent());
    }

    public function display(): void
    {
        echo $this->getHtml();
    }
}
