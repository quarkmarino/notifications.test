<template>
    <form class="p-6 text-gray-900 flex flex-col">
        <div class="bg-green-600 text-lime-900">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

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

    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
