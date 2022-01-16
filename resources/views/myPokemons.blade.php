<x-app-layout>
    <x-slot name="header">
        <x-button>
            <a href="{{route('capturePokemonView')}}">Capture a new pokemon</a>
        </x-button>
    </x-slot>

    @if(Auth::user()->pokemons->count())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-3">

                            @foreach(Auth::user()->pokemons as $pokemon)

                                <div class="flex flex-col capitalize mx-5 mb-5 justify-self-center text-center">

                                    <a href="{{route('pokemon.show', $pokemon->name)}}">
                                        <img class="border-b-2 border-solid border-indigo-600" src="{{$pokemon->image_url}}" alt="{{$pokemon->name}}">
                                    </a>

                                    <p>{{$pokemon->name}}</p>
                                    <a href="{{route('dropPokemon', $pokemon->id)}}"><x-iconpark-bye class="w-7 h-7 inline-block"/></a>


                                </div>

                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-3">

                        You don't have any pokemon yet

                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
