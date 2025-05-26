@if(auth()->user()->hasRole('admin'))
    <a href="{{ route('assign_reviewer.create', $pengajuan->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        {{ __('Assign ke Reviewer') }}
    </a>
@endif
