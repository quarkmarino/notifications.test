<form class="p-6 text-gray-900 flex flex-col">
    @if (session()->has('message'))
        <div class="rounded bg-green-300 text-lime-900 p-3">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <x-textarea label="Message" placeholder="The Notification message" wire:model="content"/>
    <br>
    <x-native-select
        label="Select Category"
        placeholder="Select Category"
        :options="$this->categoryOptions"
        option-label="name"
        option-value="value"
        wire:model="category"
    />
    <br>
    <div class="flex flex-row justify-end">
        <x-button outline black label="Submit" icon="check" wire:click="notify"/>
    </div>
</form>
