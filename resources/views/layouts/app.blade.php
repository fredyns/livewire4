<x-layouts::app.header :title="$title ?? null">
    <flux:main container>
        <div class="flex max-md:flex-col items-start">
            <div class="w-full md:w-[220px] pb-4 me-10">
                <flux:navlist>
                    <flux:navlist.item href="#" current>Dashboard</flux:navlist.item>
                    <flux:navlist.item href="#" badge="32">Orders</flux:navlist.item>
                    <flux:navlist.item href="#">Catalog</flux:navlist.item>
                    <flux:navlist.item href="#">Payments</flux:navlist.item>
                    <flux:navlist.item href="#">Customers</flux:navlist.item>
                    <flux:navlist.item href="#">Billing</flux:navlist.item>
                    <flux:navlist.item href="#">Quotes</flux:navlist.item>
                    <flux:navlist.item href="#">Configuration</flux:navlist.item>
                </flux:navlist>
            </div>

            <flux:separator class="md:hidden" />

            {{ $slot }}

        </div>
    </flux:main>
</x-layouts::app.header>
