<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cards') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-notification-success :message="session('success') ?? ''"></x-notification-success>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Create new card') }}</h4>
                <form method="POST" action="{{ route('cards.store') }}">
                    @csrf
                    <input type="number" name="balance" placeholder="{{ __('Card\'s balance') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('balance') }}"
                           step="0.01"/>
                    <x-input-error :messages="$errors->get('balance')" class="mt-2"/>
                    <br>
                    <select name="user_id"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">{{__('Select an user')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                    <br>
                    <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="text-gray-800 dark:text-gray-200">
                    <x-index-table>
                        @include('cards.partials.card-table')
                    </x-index-table>
                    {{ $cards->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
