let lastPoke = 0;

function autoFill(namePokemon, idPokemon)
{
    event.preventDefault();
    let inputText = document.getElementById('namePokemon');
    inputText.value = namePokemon;
    let pokemonCaptured = document.getElementById(idPokemon);

    pokemonCaptured.style.cssText = 'border: 2px solid blue';
    if(idPokemon !== lastPoke)
    {
        removeBorderLastPoke();
        lastPoke = idPokemon;
    }
}

function removeBorderLastPoke()
{
    if(lastPoke !== 0)
    {
        let element = document.getElementById(lastPoke);
        element.style.cssText = 'border: 2px solid black';
    }
}
