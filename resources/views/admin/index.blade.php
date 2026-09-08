<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Users List </h2>

                    {{-- <a
                    href="{{ route('schedule.create') }}"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                >
                    + Schedule Class
                </a> --}}
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    # </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Name </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Email </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Role </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Created At </th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($users as $user)
                                <tr class="transition hover:bg-gray-50"> {{-- ID --}} <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"> #{{ $user->id }}
                                    </td> {{-- Name --}} <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <div class="text-sm font-semibold text-gray-900"> {{ $user->name }} </div>
                                        </div>
                                    </td>

                                    {{-- Role --}} <td class="whitespace-nowrap px-6 py-4">
                                        @php
                                            $roleClass = match ($user->role) {
                                                'admin' => 'bg-red-100 text-red-700',
                                                'instructor' => 'bg-indigo-100 text-indigo-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp <span
                                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $roleClass }}">
                                            {{ ucfirst($user->role) }} </span> </td> {{-- Email Verified --}} <td
                                        class="whitespace-nowrap px-6 py-4">
                                        @if ($user->email_verified_at)
                                            <span
                                                class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Verified </span>
                                        @else
                                            <span
                                                class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Pending </span>
                                        @endif
                                    </td> {{-- Created At --}} <td class="whitespace-nowrap px-6 py-4">
                                        <div class="text-sm text-gray-900"> {{ $user->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500"> {{ $user->created_at->format('h:i A') }}
                                        </div>
                                    </td>
                            </tr> @empty <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="text-sm font-semibold text-gray-900"> No users found </div>
                                        <p class="mt-1 text-sm text-gray-500"> There are currently no users to display.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
