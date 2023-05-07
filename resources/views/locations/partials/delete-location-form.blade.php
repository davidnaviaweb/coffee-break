<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete location') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your location is deleted, all of its resources and data will be permanently deleted. Before deleting this location, please consider notifying the manager to turn off and empty the location.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-location-deletion')"
    >{{ __('Delete location') }}</x-danger-button>

    <x-modal name="confirm-location-deletion" focusable>
        <form method="post" action="{{ route('locations.destroy', $location) }}" class="p-6">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this location?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your location is deleted, all of its resources and data will be permanently deleted. Before deleting this location, please consider notifying the manager to turn off and empty the location.') }}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete location') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
