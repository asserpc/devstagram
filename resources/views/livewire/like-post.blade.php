<div>
    {{-- para imprimir una variable de livewires se hace como en laravel --}}
    {{--  se usa {{ "variable" }} --}}
    
    {{-- para agregar funcionalidad a los contenedores primero
        vamos a hacerlo con el like solo nos traemos el boton del condicional de show --}}
    {{-- cuando se pasa un componeneta aca estan disponibles los eventos para ello se requiere 
        wire:<tipo de evento>= "nombre de la funcion" importante esta funcion debe estan en el archivo de
            manejo del componente (clase) --}}
    {{-- como se usaran eventos ya no se requiere el tipo de boton --}}
    {{-- importante usar comillas dobles las simples dan problemas a veces --}}
    <div class="gap-2 items-center">
        <button 
         wire:click="like">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="{{ $isLiked ? "red": "white" }}" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
        </button>  
        <p>
            {{-- se usa la variable del componente --}}
            {{ $likes }} likes
        </p>
    </div>
    
</div>
