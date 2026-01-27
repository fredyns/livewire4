# OTP Input

Source: https://fluxui.dev/components/otp-input

## Main

```blade
<span class="line"><span style="color:#3B9FEC;--shiki-dark:#88DDFF"><</span><span style="color:#157FD2;--shiki-dark:#81E6FF">flux:otp</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> wire:model</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"code"</span><span style="color:#D050A3;--shiki-dark:#75FFC7"> length</span><span style="color:#88DDFF;--shiki-dark:#88DDFF">=</span><span style="color:#0EB0A9;--shiki-dark:#FF9BDE">"6"</span><span style="color:#3B9FEC;--shiki-dark:#88DDFF"> /></span></span>
```


## Example usage

```blade
<flux:card>
    <form wire:submit="verify" class="space-y-8">
        <div class="max-w-64 mx-auto space-y-2">
            <flux:heading size="lg" class="text-center">Verify your account</flux:heading>
            <flux:text class="text-center">Please enter a one-time password from the authenticator app.</flux:text>
        </div>

        <flux:otp
            wire:model="code"
            length="6"
            label="OTP Code"
            label:sr-only
            :error:icon="false"
            error:class="text-center"
            class="mx-auto"
        />

        <div class="space-y-4">
            <flux:button variant="primary" type="submit" class="w-full">Verify</flux:button>
            <flux:button wire:click="resend" class="w-full">Resend code</flux:button>
        </div>
    </form>
</flux:card>
```

## Autosubmit

```blade
<form wire:submit="verify" class="space-y-8">
    <div class="max-w-64 mx-auto space-y-2">
        <flux:heading size="lg" class="text-center">Verify your account</flux:heading>
        <flux:text class="text-center">Please enter a one-time password from the authenticator app.</flux:text>
    </div>

    <div class="space-y-6">
        <flux:otp wire:model="code" length="6" submit="auto" class="mx-auto" />
    </div>
</form>
```

## Alphanumeric

```blade
<flux:otp
    wire:model="licenseKey"
    length="10"
    mode="alphanumeric"
    label="License key"
    description:trailing="Enter the license key printed on the installation disc"
/>
```

## Private

```blade
<flux:otp wire:model="pin" length="4" private label="PIN Code" />
```

## Separator

```blade
<flux:otp wire:model="code">
    <flux:otp.input />
    <flux:otp.input />
    <flux:otp.input />

    <flux:otp.separator />

    <flux:otp.input />
    <flux:otp.input />
    <flux:otp.input />
</flux:otp>
```

## Group

```blade
<flux:otp wire:model="code">
    <flux:otp.group>
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
    </flux:otp.group>
</flux:otp>
```

## Group separator

```blade
<flux:otp wire:model="code">
    <flux:otp.group>
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
    </flux:otp.group>

    <flux:otp.separator />

    <flux:otp.group>
        <flux:otp.input />
        <flux:otp.input />
        <flux:otp.input />
    </flux:otp.group>
</flux:otp>
```

## Reference

### `flux:otp`

| Prop | Description |
| --- | --- |
| `wire:model` | Binds the value to a Livewire property. |
| `value` | Current value as a string. |
| `length` | Number of input fields. |
| `mode` | Options: `numeric` (default), `alphanumeric`, `alpha`. |
| `private` | Masks input values. |
| `submit` | Options: (default), `auto` (submit when all fields are filled). |
| `autocomplete` | Autocomplete attribute for first input. Default: `one-time-code`. |

### `flux:otp.input`

| Prop | Description |
| --- | --- |
| `â€”` | `â€”` |

### `flux:otp.separator`

| Prop | Description |
| --- | --- |
| `â€”` | `â€”` |

### `flux:otp.group`

| Slot | Description |
| --- | --- |
| `default` | The input fields to include in the group. |
