<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a class="inline-flex text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-700" href="{{route('cards.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="ml-2">{{sprintf(__('Back to %s'), __('cards')) }} </span>
            </a>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit card') }}</h4>
                <form method="POST" action="{{ route('cards.update', $card->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="number" name="balance" placeholder="{{ __('Card\'s balance') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('balance', $card->balance) }}"
                           step="0.01"/>
                    <x-input-error :messages="$errors->get('balance')" class="mt-2"/>
                    <br>
                    <select name="user_id"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">{{__('Select an user')}}</option>
                        @foreach($users as $user)
                            <option @selected($card->user_id = $user->id) value="{{$user->id}}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                    <br>
                    <select name="status"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($stati as $status)
                            <option @selected($card->status == $status) value="{{$status}}">{{ucfirst($status)}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                    <br>
                    <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('cards.partials.delete-card-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
