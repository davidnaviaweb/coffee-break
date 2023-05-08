<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete product') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your product is deleted, all of its resources and data will be permanently deleted. Before deleting this product, please consider notifying the manager to turn off and empty the product.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion')"
    >{{ __('Delete product') }}</x-danger-button>

    <x-modal name="confirm-product-deletion" focusable>
        <form method="post" action="{{ route('products.destroy', $product) }}" class="p-6">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this product?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your product is deleted, all of its resources and data will be permanently deleted. Before deleting this product, please consider notifying the manager to turn off and empty the product.') }}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete product') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
