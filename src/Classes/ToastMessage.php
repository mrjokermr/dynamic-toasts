<?php

namespace Mrjokermr\DynamicToasts\Classes;

use Carbon\Carbon;
use Livewire\Wireable;
use Mrjokermr\DynamicToasts\Enums\ToastMessageType;

class ToastMessage implements Wireable
{
    public ?string $id = null;
    public ?string $expiresAt = null;
    public bool $showIcon = true;
    public function __construct(
        public string $message,
        public ToastMessageType $type,
    )
    {
        $this->id = uuid_create();
        $this->expiresAt = Carbon::now()->addSeconds(5)->toDateTimeString();

        $showIcon = (bool) config('dynamic-toasts.default_value_show_icon');
        $this->showIcon = $showIcon;
    }

    public function setExpiresAtSeconds(int $seconds): self
    {
        $this->expiresAt = Carbon::now()->addSeconds($seconds)->toDateTimeString();
        return $this;
    }

    public function hideIcon(): self
    {
        $this->showIcon = false;
        return $this;
    }

    public function expired(): bool
    {
        return Carbon::parse($this->expiresAt)->isPast();
    }

    public function getBackgroundHexColor(): string
    {
        return $this->type->background_hex_color();
    }

    public function getTextHexColor(): string
    {
        return $this->type->text_hex_color();
    }

    public function getIconHtml(): string
    {
        return $this->type->icon_html();
    }

    public function getStyleClass(): ?string
    {
        return $this->type->get_style_class();
    }

    public function toLivewire(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'type' => $this->type->value,
            'expiresAt' => $this->expiresAt,
            'showIcon' => $this->showIcon,
        ];
    }

    public function toArray(): array
    {
        return $this->toLivewire();
    }

    public static function fromLivewire($value): self
    {
        $toastMessage = (new self(
            message: $value['message'],
            type: ToastMessageType::from($value['type']),
        ));

        $toastMessage->id = $value['id'];
        $toastMessage->expiresAt = $value['expiresAt'];
        $toastMessage->showIcon = $value['showIcon'];

        return $toastMessage;
    }
}
