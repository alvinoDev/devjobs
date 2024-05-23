<div>

    <livewire:filtrar-vacantes />

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-center text-4xl text-gray-700 mb-12">Nuestras Vacantes Diponibles</h3>

            <div class="bg-white shadow-sm rounded-lg p-6 divide-y divide-gray-200">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">

                        <div class="md:flex-1">
                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-1xl font-extrabold text-gray-600"> {{ $vacante->titulo }} </a>
                            <p class="text-base text-gray-600 mb-1"> {{ $vacante->empresa }} </p>
                            <p class="text-xs font-bold text-gray-600 mb-1"> {{ $vacante->categoria->categoria }} </p>
                            <p class="text-base text-gray-600 mb-1"> {{ $vacante->salario->salario }} </p>
                            <p class="font-bold text-xs text-gray-600"> Fecha limite: <span class="font-normal"> {{ $vacante->ultimo_dia->format('d/m/Y') }} </span> </p>
                        </div>

                        <div class="mt-5 md:mt-0">
                            <a href="{{ route('vacantes.show', $vacante->id) }}" class="px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-offset-2 transition ease-in-out duration-150 block text-center">Ver Vacante</a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-600">No hay vacantes aún</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
