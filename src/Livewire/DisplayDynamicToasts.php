<?php

namespace Mrjokermr\DynamicToasts\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Mrjokermr\DynamicToasts\Classes\ToastMessage;
use Mrjokermr\DynamicToasts\Enums\ToastMessageType;

class DisplayDynamicToasts extends Component
{
    const NEW_TOAST_EVENT = 'new_dynamic_toast_event';
    public array $messages = [];

    public function mount()
    {
        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::SUCCESS example",
                type: ToastMessageType::SUCCESS,
            ))->setExpiresAtSeconds(10)->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::SUCCESS example",
                type: ToastMessageType::SUCCESS,
            ))->setExpiresAtSeconds(10)->hideIcon()->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::FAILURE example",
                type: ToastMessageType::FAILURE,
            ))->setExpiresAtSeconds(10)->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::FAILURE example",
                type: ToastMessageType::FAILURE,
            ))->setExpiresAtSeconds(10)->hideIcon()->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::WARNING example",
                type: ToastMessageType::WARNING,
            ))->setExpiresAtSeconds(10)->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::WARNING example",
                type: ToastMessageType::WARNING,
            ))->setExpiresAtSeconds(10)->hideIcon()->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::INFO example",
                type: ToastMessageType::INFO,
            ))->setExpiresAtSeconds(10)->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::INFO example",
                type: ToastMessageType::INFO,
            ))->setExpiresAtSeconds(10)->hideIcon()->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::NEGATIVE example",
                type: ToastMessageType::NEGATIVE,
            ))->setExpiresAtSeconds(10)->toLivewire(),
        );

        $this->addDynamicToastMessage(
            toastMessage: (new ToastMessage(
                message: "ToastMessageType::NEGATIVE example",
                type: ToastMessageType::NEGATIVE,
            ))->setExpiresAtSeconds(10)->hideIcon()->toLivewire(),
        );
    }

    #[On(self::NEW_TOAST_EVENT)]
    public function addDynamicToastMessage(array $toastMessage)
    {
        $toastMessage = ToastMessage::fromLivewire($toastMessage);
        $toastMessages = $this->messages;
        array_unshift($toastMessages, $toastMessage);
        $this->messages = $toastMessages;
    }

    public function deleteDynamicToastMessage(string $id)
    {
        $messages = $this->messages;
        foreach ($messages as $index => $toastMessage) {
            if ($toastMessage->id === $id) {
                unset($messages[$index]);
                break;
            }
        }

        $this->messages = $messages;
        $this->dispatch('$refresh');
    }

    public function removeExpiredMessages()
    {
        $remainingMessages = [];
        /** @var ToastMessage $message */
        foreach ($this->messages as $message) {
            if (!$message->expired()) {
                $remainingMessages[] = $message;
            }
        }

        $this->messages = $remainingMessages;
    }

    public function render()
    {
        return view('dynamic-toasts::Livewire.display-dynamic-toasts');
    }
}
