<?php

function currency($num){
    return 'Rp ' . number_format($num, 2, ',', '.');
}