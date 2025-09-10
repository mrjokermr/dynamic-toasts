<div wire:poll.500ms="removeExpiredMessages"
     style="pointer-events:none; position:fixed; top:0; right:0; bottom:0; left:0; z-index:100; display:flex; justify-content:flex-end; flex-direction:column;">
    <div style="height:5rem; width:100%; display:flex; justify-content:flex-end;">
        <div style="width:auto; max-width:22rem; padding:0.75rem; display:flex; flex-direction:column-reverse; row-gap:0.5rem;">
            @php /** @var \Mrjokermr\DynamicToasts\Classes\ToastMessage $message */ @endphp
            @foreach($messages as $message)
                @php $styleClass = $message->getStyleClass(); @endphp
                <div
                    @if (isset($styleClass))
                        class="{!! $styleClass !!}"
                    @else
                        style="pointer-events:auto; width:auto; font-size:0.875rem; padding:0.5rem; border-radius:0.375rem; box-shadow:0 1px 2px 0 rgb(0 0 0 / 0.05); background-color: {{ $message->getBackgroundHexColor() }};">
                    @endif
                    <div style="color: {{ $message->getTextHexColor() }}; position: relative; display: flex; column-gap: 0.5rem;">
                        @if ($message->showIcon)
                            <div style="position: relative; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <div style="width: 1.25rem; height: 1.25rem; fill: #ffffff;">
                                    {!! $message->getIconHtml() !!}
                                </div>
                            </div>
                        @endif
                        <p
                            wire:key="dynamic_toast_message_{{ $message->id }}"
                            wire:click="deleteDynamicToastMessage('{{ $message->id }}')"
                            style="font-weight:bold; text-align: left; cursor: pointer; flex: 1 1 0%;"
                        >
                            {!! $message->message !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
