@props(['isEdit' => false,'classType' => []])

@php
$method=$isEdit ? 'PUT' : 'POST';
@endphp
<form method="POST" action="{{ !$isEdit ?  route('class_type.store') :route('class_type.update',$classType?->id)  }}">
            @csrf

@if (in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif


            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Class Name')" />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name',$classType?->name  ?? '')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="e.g. Yoga"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Enter class description..."
                >{{ old('description',$classType?->description  ?? '')  }}</textarea>


            </div>

            {{-- Duration --}}
            <div class="mt-4">
                <x-input-label for="minutes" :value="__('Duration (Minutes)')" />

                <x-text-input
                    id="minutes"
                    name="minutes"
                    type="number"
                    class="mt-1 block w-full"
                    :value=" old('minutes',$classType?->minutes ?? '')"
                    min="1"
                    placeholder="e.g. 60"
                    required
                />

                <x-input-error :messages="$errors->get('minutes')" class="mt-2" />
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex items-center justify-end gap-4">

                <a
                    href="{{ route('class_type.create') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                >
                    Cancel
                </a>

                <x-primary-button>
                    {{ $isEdit ? 'Update' :'Create'  }} Class Type
                </x-primary-button>

            </div>

        </form>
