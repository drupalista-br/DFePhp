<?php

function stripAccents($str) {
  return trim(strtr(utf8_decode($str), utf8_decode('ªºàáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aoaaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
}

echo stripAccents('nº é ª ãõñ');