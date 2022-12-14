<x-app-layout>
    @if (Auth::user()->hasRole("mahasiswa"))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelas : {{Auth::user()->class->kd_kelas}}
        </h2>
    </x-slot>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <x-slot:script>
        @yield('scripts')
    </x-slot>
</x-app-layout>