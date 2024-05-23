<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    
        @forelse ($vacantes as $vacante )
            <div class="p-6 bg-white border-b border-gray-200 text-gray-900 md:flex md:justify-between md:items-center">

                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">Empresa: {{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="{{ route('candidatos.index', $vacante)}}" class="bg-green-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"> {{ $vacante->candidatos->count() }} Candidatos</a>
                    <a href="{{ route('vacantes.edit', $vacante->id)}}" class="bg-sky-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                    <button wire:click="$dispatch('eliminar', { id: {{ $vacante->id }} })" class="bg-red-500 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar</button>
                </div>

            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
        @endforelse

    </div>
    <div class="mt-10">
        {{ $vacantes->links('pagination::tailwind') }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('eliminar', (vacanteId) => {
            Swal.fire({
                title: "¿Eliminar Vacante?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    Livewire.dispatch('on-delete', { vacante: vacanteId })

                    Swal.fire({
                        title: "Se eliminó la vacante!",
                        text: "Eliminado correctamente.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endpush