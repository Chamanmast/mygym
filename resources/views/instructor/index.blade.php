<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Schedule Class') }}
        </h2>
    </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    Scheduled Classes
                </h2>

                <a
                    href="{{ route('schedule.create') }}"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                >
                    + Schedule Class
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                #
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Instructor
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Class Type
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Date & Time
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">

                        @forelse ($scheduledClasses as $scheduledClass)

                            <tr class="hover:bg-gray-50">
                                {{-- ID --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $scheduledClass->id }}
                                </td>

                                {{-- Instructor --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $scheduledClass->instructor->name }}
                                </td>

                                {{-- Class Type --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                    {{ $scheduledClass->classType->name }}
                                </td>

                                {{-- Date Time --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                    {{ $scheduledClass->date_time->format('d M Y, h:i A') }}
                                </td>

                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm">

                                    <div class="flex justify-end gap-2">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('schedule.edit', $scheduledClass) }}"
                                            class="rounded-md bg-yellow-500 px-3 py-2 font-semibold text-white hover:bg-yellow-600"
                                        >
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('schedule.destroy', $scheduledClass) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this scheduled class?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-md bg-red-600 px-3 py-2 font-semibold text-white hover:bg-red-700"
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
                                    class="px-6 py-10 text-center text-sm text-gray-500"
                                >
                                    No scheduled classes found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
                {{ $scheduledClasses->links() }}
        </div>

    </div>
</div>

</x-app-layout>
