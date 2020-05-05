<?php


namespace Recruitment\Contract;


class News
{
    private int $id;
    private ?string $name = null;
    private ?string $description = null;
    private ?bool $is_active = true;
    private ?string $created_at;
    private ?string $updated_at;
    private int $author_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return null !== $this->created_at
            ? new \DateTime($this->created_at)
            : null;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return null !== $this->updated_at
            ? new \DateTime($this->updated_at)
            : null;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
    }



    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param bool|null $is_active
     */
    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    /**
     * @param \DateTime|null $created_at
     */
    public function setCreatedAt(?\DateTime $created_at): void
    {
        $this->created_at = null !== $created_at
            ? $created_at->format(\DateTime::ISO8601)
            : null;
    }

    /**
     * @param \DateTime|null $updated_at
     */
    public function setUpdatedAt(?\DateTime $updated_at): void
    {
        $this->updated_at = null !== $updated_at
            ? $updated_at->format(\DateTime::ISO8601)
            : null;
    }

    /**
     * @param int $author_id
     */
    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
    }


}