document.getElementById('btn_guardar').addEventListener('click', async () => {
    try {
    
        let respuesta = await fetch('https://pokeapi.co/api/v2/pokemon?limit=20');
        let datos = await respuesta.json();

        let datosPokemon = [];
        for (let pokemon of datos.results) {
            let respuestaPokemon = await fetch(pokemon.url);
            let detallesPokemon = await respuestaPokemon.json();

            datosPokemon.push({
                nombre: detallesPokemon.name,
                altura: detallesPokemon.height,
                tipo: detallesPokemon.types[0].type.name,
                habilidad_1: detallesPokemon.abilities[0]?.ability.name,
                habilidad_2: detallesPokemon.abilities[1]?.ability.name,
                experiencia_base: detallesPokemon.base_experience,
                movimiento_1: detallesPokemon.moves[0]?.move.name,
                movimiento_2: detallesPokemon.moves[1]?.move.name
            });
        }
        let respuestaGuardar = await fetch('app/controller/pokemon.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datosPokemon)
        });

        let resultado = await respuestaGuardar.json();
        document.getElementById('resultado').innerText = resultado.mensaje;
    } catch (error) {
        console.error('Error:', error);
    }
});
