/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

// en el content deben agregarse las rutas y archivos a los que se le aplicaria 
// en el caso de la paginacion la ruta es  "./vendor/laravel/framework/src/Iluminate/Pagination/resources/views/*.blade.php"
// es importante para que se puedan mapear adecuadamente los estilos