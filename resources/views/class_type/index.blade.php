<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('All Class Types') }}
            </h2>

            <a
                href="{{ route('class_type.create') }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
            >
                + Create Class Type
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-4">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-4">
                                    Name
                                </th>

                                <th scope="col" class="px-6 py-4">
                                    Description
                                </th>

                                <th scope="col" class="px-6 py-4">
                                    Duration
                                </th>

                                <th scope="col" class="px-6 py-4 text-right">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse ($classTypes as $classType)

                                <tr class="hover:bg-gray-50">

                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                        {{ $classType->id }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                        {{ $classType->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $classType->description ?? '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ $classType->minites }} minutes
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">

                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('class_type.edit', $classType) }}"
                                                class="rounded-md bg-yellow-500 px-3 py-2 text-xs font-semibold text-white hover:bg-yellow-600"
                                            >
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('class_type.destroy', $classType) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this class type?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-6 py-12 text-center text-gray-500"
                                    >
                                        No class types found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
