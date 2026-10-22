@extends('layouts.admin')
@section('heading', $item->exists ? 'Sửa câu hỏi' : 'Thêm câu hỏi')
@section('content')
    <form class="bg-white rounded-xl shadow-sm p-5 grid gap-4 max-w-3xl" method="POST" action="{{ $item->exists ? route('admin.faqs.update', $item) : route('admin.faqs.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <label class="text-sm font-semibold">Câu hỏi<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" name="question" value="{{ old('question', $item->question) }}" required></label>
        <label class="text-sm font-semibold">Câu trả lời (có thể dùng thẻ strong)<textarea class="mt-1 w-full min-h-32 px-3 py-2 rounded-lg ring-1 ring-slate-200" name="answer" required>{{ old('answer', $item->answer) }}</textarea></label>
        <label class="text-sm font-semibold">Thứ tự<input class="mt-1 w-full h-11 px-3 rounded-lg ring-1 ring-slate-200" type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}"></label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active ?? true))> Đang hiển thị</label>
        <button class="h-11 px-5 rounded-lg bg-[#0f2942] text-white font-semibold w-fit" type="submit">Lưu</button>
    </form>
@endsection
