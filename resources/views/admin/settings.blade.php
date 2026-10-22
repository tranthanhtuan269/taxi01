@extends('layouts.admin')
@section('heading', 'Nội dung trang')
@section('content')
    <form class="space-y-6" method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')
        @foreach(collect($fields)->groupBy('group') as $group => $items)
            <section class="bg-white rounded-xl shadow-sm p-5">
                <h2 class="font-bold text-[#0f2942] mb-4">{{ $group }}</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($items as $field)
                        <label class="block {{ $field['type'] === 'textarea' ? 'md:col-span-2' : '' }}">
                            <span class="text-sm font-semibold text-slate-700">{{ $field['label'] }}</span>
                            @if($field['type'] === 'textarea')
                                <textarea class="mt-1 w-full min-h-24 px-3 py-2 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" name="settings[{{ $field['key'] }}]">{{ $stored[$field['key']] ?? '' }}</textarea>
                            @else
                                <input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-600 outline-none" name="settings[{{ $field['key'] }}]" value="{{ $stored[$field['key']] ?? '' }}">
                            @endif
                        </label>
                    @endforeach
                </div>
            </section>
        @endforeach
        <button class="h-12 px-6 rounded-xl bg-[#0f2942] text-white font-bold" type="submit">Lưu nội dung</button>
    </form>
@endsection
