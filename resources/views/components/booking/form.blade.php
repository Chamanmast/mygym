@props(['scheduled' => [], 'isCancle' => false])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-10 text-gray-900 max-w-2xl divide-y">
        @forelse ($scheduled as $class)
            <div class="py-6">
                <div class="flex gap-6 justify-between">
                    @if ($isCancle)
                        <div>
                            <p class="text-2xl font-bold text-purple-700">{{ $class->scheduled->classType->name }}</p>
                            <p class="text-sm">{{ $class->instructor->name }}</p>
                            <p class="mt-2">{{ $class->scheduled->classType->description }}</p>
                            <span class="text-slate-600 text-sm">{{ $class->scheduled->classType->minutes }}
                                minutes</span>
                        </div>
                    @else
                        <div>
                            <p class="text-2xl font-bold text-purple-700">{{ $class->classType->name }}</p>
                            <p class="text-sm">{{ $class->instructor->name }}</p>
                            <p class="mt-2">{{ $class->classType->description }}</p>
                            <span class="text-slate-600 text-sm">{{ $class->classType->minutes }} minutes</span>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                            <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                        </div>
                    @endif

                </div>
                <div class="mt-1 text-right">
                    <form method="post"
                        action="{{ $isCancle ? route('bookings.destroy', $class->id) : route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="scheduled_class_id" value="{{ $class->id }}">

                        @if ($isCancle)
                            <x-secondary-button class="px-3 py-1">Cancle</x-secondary-button>
                        @else
                            <x-primary-button class="px-3 py-1">Book</x-primary-button>
                        @endif

                    </form>
                </div>
            </div>
        @empty
            <div>
                <p>No classes are scheduled. Check back later.</p>
                </a>
            </div>
        @endforelse
    </div>
</div>
{{ $scheduled->links() }}
