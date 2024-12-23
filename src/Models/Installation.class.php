<?php
/**
 * @file     Installation.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

class Installation
{
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $details;
    private ?string $imgPath;

    public function __construct(?int $id = null, ?string $title = null, ?string $description = null, ?string $details = null, ?string $imgPath = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->details = $details;
        $this->imgPath = $imgPath;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): void
    {
        $this->details = $details;
    }

    public function getImgPath() : ?string
    {
        return $this->imgPath;
    }

    public function setImgPath(?string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }
}