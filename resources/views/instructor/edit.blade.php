<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Schedule Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                  {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

             <x-schedule_class.form :$classTypes  :$times :schedule='$schedule'  :isEdit='true' />

            </div>

        </div>
    </div>

</x-app-layout>
