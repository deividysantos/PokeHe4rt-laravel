<x-app-layout>
    <x-slot name="header">
        <x-button>
            <a href="{{route('capturePokemonView')}}">Capture a new pokemon</a>
        </x-button>
    </x-slot>

    @if(Auth::user()->trainerPokemon->count())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pb-8 border-b border-gray-200">
                    <div class="p-6 bg-white  grid grid-cols-3">

                        @foreach(Auth::user()->trainerPokemon as $trainerPokemon)

                            <div class="flex flex-col flex-wrap shrink capitalize mx-5 mb-5 justify-self-center text-center">

                                <a href="{{route('pokemon.show', $trainerPokemon->pokemon->name)}}">
                                    <img class="border-b-2 border-solid border-indigo-600 min-h-full" src="{{$trainerPokemon->pokemon->image_url}}" alt="{{$trainerPokemon->pokemon->name}}">
                                </a>

                                <div class="flex flex-row justify-between">

                                    @if($trainerPokemon->nickName == "")
                                        <p>{{$trainerPokemon->pokemon->name}}</p>
                                    @else
                                        <p>{{$trainerPokemon->nickName}}</p>
                                    @endif

                                    <div class="hidden sm:flex sm:items-center">
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button class="focus:outline-none">
                                                    <x-iconpark-down-o  class="w-5 h-5 text-gray-400 hover:text-black"/>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">

                                                <div class="flex flex-row justify-evenly">
                                                    <a class="hover:bg-gray-100 p-1" href="{{route('pokemon.show',$trainerPokemon->id)}}">
                                                        <div class="cursor-pointer">
                                                            <x-iconpark-previewopen-o class="ml-3 w-5 h-5"/>
                                                            Show
                                                        </div>
                                                    </a>

                                                    <a class="hover:bg-gray-100 p-1" href="{{route('dropPokemon',[$trainerPokemon->pokemon->id])}}">
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
