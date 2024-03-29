<x-app-layout>
    <x-slot name="header">

        <a href="{{route('capturePokemonView', 1)}}">
            <x-button>
                Capture a new pokemon
            </x-button>
        </a>
    </x-slot>

    @if(Auth::user()->pokemonTrainer->count())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg pb-8">
                    <div class="p-6 pb-24 bg-white grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6">

                        @foreach(Auth::user()->pokemonTrainer as $key => $pokemonTrainer)

                            <div class="flex flex-col flex-wrap capitalize items-center ml-4 mt-4">

                                <img class="w-32 h-32" src="{{$pokemonTrainer->pokemon->image_url}}" alt="{{$pokemonTrainer->pokemon->name}}">

                                <div class="flex flex-row flex-wrap justify-center">

                                    @if($pokemonTrainer->nickName == "")
                                        <p>{{$pokemonTrainer->pokemon->name}}</p>
                                    @else
                                        <p>{{$pokemonTrainer->nickName}}</p>
                                    @endif

                                    <div class="sm:flex sm:items-center">
                                        <x-dropdown align="{{$key % 2 == 0 ? 'top' : 'right'}}">
                                            <x-slot name="trigger">
                                                <button class="focus:outline-none">
                                                    <x-iconpark-down-o  class="w-6 h-6 text-gray-500 hover:text-indigo-900"/>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <div class="flex flex-row justify-evenly">
                                                    <a class="hover:border-b-2 border-transparent hover:border-indigo-600 p-1" href="{{route('showPokemonView',$pokemonTrainer->id)}}">
                                                        <div class="cursor-pointer">
                                                            <x-iconpark-previewopen-o class="ml-3 w-5 h-5"/>
                                                            Show
                                                        </div>
                                                    </a>
                                                    <a class="border-b-2 border-transparent hover:border-indigo-600 p-1" href="{{route('dropPokemon',[$pokemonTrainer->id])}}">
                                                        <div class="cursor-pointer">
                                                            <x-iconpark-bye-o class="ml-2 w-5 h-5"/>
                                                            Drop
                                                        </div>
                                                    </a>
                                                </div>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </div>
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
