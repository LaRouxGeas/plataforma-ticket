<?php

if (!function_exists('reduzir_nome')) {
	/**
	 * Devolve o nome do arquivo reduzido caso se $nome for maior que $tamanho.
	 *
	 * @param  string $nome
	 * @param  int    $tamanho
	 * @return string
	 */
	function reduzir_nome($nome, $tamanho = 15)
	{
		if (strlen($nome) > $tamanho) {
			$nome_reduzido = substr($nome, 0, ($tamanho - 5));
			$i = strrpos($nome, ".") ?: 0;

			return $i ? $nome_reduzido."-".substr($nome, $i) : $nome_reduzido;
		} else {
			return $nome;
		}
	}
}

if (!function_exists('icone')) {
	/**
	 * Devolve uma regra css de um icone com a extensão recebida.
	 *
	 * @param  string $ext
	 * @return string
	 */
	function icone($ext)
	{
		if ($ext == "png" || $ext == "jpg" || $ext == "gif") {
			return "fas fa-file-image";
		}

		if ($ext == "wmv" || $ext == "mp4") {
			return "fas fa-file-video";
		}

		if ($ext == "docx") {
			return "fas fa-file-word";
		}

		if ($ext == "pptx") {
			return "fas fa-file-powerpoint";
		}

		if ($ext == "xlsx") {
			return "fas fa-file-excel";
		}

		if ($ext == "txt") {
			return "fas fa-file-signature";
		}

		if ($ext == "pdf") {
			return "fas fa-file-pdf";
		}

		if ($ext == "xml") {
			return "fas fa-file-alt";
		}

		if ($ext == "zip" || $ext == "rar") {
			return "fas fa-file-archive";
		}

		if ($ext == "mp3" || $ext == "wav" || $ext == "bin") {
			return "fas fa-file-audio";
		}

		return "fas fa-file";
	}
}

if (!function_exists('capitalize')) {
	/**
	 * Devolve a primeira letra maiuscula e o resto em minusculas, alem de limpar a string.
	 *
	 * @param  string $string
	 * @return string
	 */
	function capitalize($string)
	{
		$string = preg_replace('/\s+/', ' ', trim($string));
		return ucfirst(mb_strtolower($string));
	}
}
