   @props([
       'isEdit' => false,
       'schedule' => null,
       'classTypes' => [],
       'times' =>[],
   ])
   @php
       $method = $isEdit ? 'PUT' : 'POST';

   @endphp
   <form method="POST" action="{{ !$isEdit ? route('schedule.store') : route('schedule.update', $schedule?->id) }}">
       @csrf

       @if (in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
           @method($method)
       @endif


       {{-- Class Type --}}
       <div class="mt-4">
           <x-input-label for="class_type_id" :value="__('Class Type')" />

           <select id="class_type_id" name="class_type_id"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
               <option value="">Select Class Type</option>

               @foreach ($classTypes as $id => $name)
                   <option value="{{ $id }}" @selected(old('class_type_id', $schedule?->class_type_id) == $id)>
                       {{ $name }}

                   </option>
               @endforeach
           </select>

           <x-input-error :messages="$errors->get('class_type_id')" class="mt-2" />
       </div>


       {{-- Date --}}
       <div class="mt-4">
           <x-input-label for="date" :value="__('Date')" />

           <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', $schedule?->date_time?->format('Y-m-d'))"
               required />

           <x-input-error :messages="$errors->get('date')" class="mt-2" />
       </div>

       {{-- Time --}}
       <div class="mt-4">
    <x-input-label for="time" :value="__('Time')" />

    <select
        id="time"
        name="time"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
               focus:border-indigo-500 focus:ring-indigo-500"
        required
    >
        <option value="">Select Time</option>

        @foreach ($times as $value => $label)
            <option
                value="{{ $value }}"
                @selected(old('time', $schedule?->date_time?->format('H:i')) == $value)
            >
                {{ $label }}
            </option>
        @endforeach
    </select>

    <x-input-error
        :messages="$errors->get('time')"
        class="mt-2"
    />
</div>

       {{-- Buttons --}}
       <div class="mt-6 flex items-center justify-end gap-3">

           <a href="{{ route('schedule.index') }}"
               class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
               Cancel
           </a>

           <x-primary-button>
               {{ $isEdit ? 'Update' : 'Create' }} Schedule Class
           </x-primary-button>

       </div>

   </form>
