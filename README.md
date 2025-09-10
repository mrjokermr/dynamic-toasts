
# Dynamic toasts

**Simple Livewire 3 toast messages package**

Compatible with any css framework & no CDN requirements. (Uses native inline css styling & svg icons.)

![Example](https://imgur.com/3Qv0Grn.png)
## Installation

Install via composer:

```bash
  composer require mrjokermr/dynamic-toasts
```

Place the Livewire component right before the closing body tag in your layout (for example in ```resources/views/layouts/app.blade.php```)
```
@livewire('dynamic-toasts')
</body>
```



## Usage/Examples


```php
use Mrjokermr\DynamicToasts\Classes\ToastMessage;
use Mrjokermr\DynamicToasts\Enums\ToastMessageType;
use Mrjokermr\DynamicToasts\Livewire\DisplayDynamicToasts;

$this->dispatch(
    DisplayDynamicToasts::NEW_TOAST_EVENT,
    (new ToastMessage(
        message: "Hello GitHub",
        type: ToastMessageType::INFO
    ))->toArray(),
);
```
It is required to transform the ```ToastMessage``` to an array via ```->toArray()```.
Since livewire 3 doesn't automatically serialize ```Wireable``` classes.

Available types:
```php
use Mrjokermr\DynamicToasts\Enums\ToastMessageType;

ToastMessageType::INFO
ToastMessageType::POSITIVE
ToastMessageType::POSITIVE
ToastMessageType::NEGATIVE
ToastMessageType::FAILURE
ToastMessageType::WARNING
```

### Customization:

**Without icon:**

Add the ```->hideIcon()``` function.

**Example:**
```php
$this->dispatch(
    DisplayDynamicToasts::NEW_TOAST_EVENT,
    (new ToastMessage(
        message: "Hello GitHub",
        type: ToastMessageType::INFO
    ))->hideIcon()->toArray(),
);
```

**Set expiration time:**

Add the ```->setExpiresAtSeconds()``` function.

**Example:**
```php
$this->dispatch(
    DisplayDynamicToasts::NEW_TOAST_EVENT,
    (new ToastMessage(
        message: "Hello GitHub",
        type: ToastMessageType::INFO
    ))->setExpiresAtSeconds(seconds: 12)->toArray(),
);
```

### Config

```bash
php artisan vendor:publish --tag=dynamic-toasts-config
```
You might change the background color and text color for each individual pop up type, or the default toast duration.
**default config:**
```php
return [
    'default_seconds' => 5,
    'default_value_show_icon' => true,

    'styles' => [
        'positive' => [
            'background-color' => '#00c950',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
        'success' => [
            'background-color' => '#00c950',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
        'negative' => [
            'background-color' => '#fb2c36',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
        'failure' => [
            'background-color' => '#fb2c36',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
        'warning' => [
            'background-color' => '#fe9a00',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
        'info' => [
            'background-color' => '#fe9a00',
            'text-color' => '#fcfcfc',
            'class' => null,
        ],
    ],
];
```
