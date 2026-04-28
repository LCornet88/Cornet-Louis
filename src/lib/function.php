<?php

function convertirDuree($minutes) {
    $minute = $minutes % 60;
    $heure = (int)($minutes / 60);
    return $heure . 'h' . ($minute < 10 ? '0' : '') . $minute;
}

// function ilYARien() {
//     return "Il n'y rien a voir ici :( ♥♦♣♠";
// }

// function boireUnCafe() {
//     return "☕";
// }

function pasDeFilm($films) {
    return count($films) === 0;
}



?>