<?php

/**
 * Se usa para dividir un texto 
 * 
 * @param  mixed  $contenido texto a dividir
 * @param  mixed  $cantidadPalabras cantidad de palabras
 * @return string         resultado texto dividido
 */
if (! function_exists('dinv_extracto')) {
	function dinv_extracto($contenido, $cantidadPalabras) 
	{
		 $contenido = explode(' ', $contenido);
		 $contenido = array_slice($contenido, 0, $cantidadPalabras);
		 $contenido = implode(' ', $contenido);
		 return $contenido;
	}
}
?>