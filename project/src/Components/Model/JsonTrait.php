<?php

namespace Components\Model;

trait JsonTrait
{
    /**
     * @inheritdoc
     */
    public function jsonSerialize(): string
    {
        return $this->toJson();
    }

    /**
     * Return the Object as a JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
