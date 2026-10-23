@extends('layouts.admin')
@section('heading', 'Yêu cầu gọi lại')
@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left"><tr><th class="p-3">Thời điểm</th><th class="p-3">Điện thoại</th><th class="p-3">Kênh</th><th class="p-3">Nhu cầu</th><th class="p-3">Trạng thái</th><th class="p-3"></th></tr></thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="border-t">
                        <td class="p-3 whitespace-nowrap">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-3 font-semibold">{{ $item->phone }}</td>
                        <td class="p-3">{{ contact_channel_label($item->contact_channel) ?: '—' }}</td>
                        <td class="p-3">{{ $item->note ?: '—' }}</td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.callbacks.update', $item) }}">
                                @csrf @method('PUT')
                                <select class="h-10 px-2 rounded-lg ring-1 ring-slate-200" name="status" onchange="this.form.submit()">
                                    @foreach(\App\Models\Callback::STATUSES as $value => $label)
                                        <option value="{{ $value }}" @selected($item->status === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.callbacks.destroy', $item) }}" onsubmit="return confirm('Xóa yêu cầu này?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600" type="submit">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-6 text-slate-500" colspan="6">Chưa có yêu cầu gọi lại.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $items->links() }}</div>
@endsection
