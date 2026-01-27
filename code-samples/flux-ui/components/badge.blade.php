{{--docs: https://fluxui.dev/components/badge --}}

{{--basic--}}
<flux:badge color="lime">New</flux:badge>


{{--sizes--}}
<flux:badge size="sm">Small</flux:badge>
<flux:badge>Default</flux:badge>
<flux:badge size="lg">Large</flux:badge>


{{--icon--}}
<flux:badge icon="user-circle">Users</flux:badge>
<flux:badge icon="document-text">Files</flux:badge>
<flux:badge icon:trailing="video-camera">Videos</flux:badge>


{{--rounded--}}
<flux:badge rounded icon="user">Users</flux:badge>


{{--As button--}}
<flux:badge as="button" rounded icon="plus" size="lg">Amount</flux:badge>


{{--With close button--}}
<flux:badge>
    Admin <flux:badge.close />
</flux:badge>
