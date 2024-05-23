<?php
// in questa pagina gestisco le variabili che impostano gli elementi a seconda del tema 

//scritte aside che cambiano colore all hover
$cookieColorGreen = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieColorGreen = 'whiteGreen';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieColorGreen = 'darkGreen';
}

// scritte normali bianche nere
$cookieColor = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieColor = 'colorLight';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieColor = 'colorDark';
}

// scritte secondarie bianche nere meno intense
$cookieColorTwo = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieColorTwo = 'colorLightSecond';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieColorTwo = 'colorDarkSecond';
}


// colore input dei form 
$cookieInput = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieInput = 'inputBkDark';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieInput = 'inputBkLight';
}

// colore input da selezionato
$cookieInputIn = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieInputIn = 'inputBkDarkInv';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieInputIn = 'inputBkLightInv';
}

// colore della option della select
$cookieOption = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieOption  = 'optionCoockieBlack';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieOption  = 'optionCoockieWhite';
}

// colore di sfondi di alcuni elementi
$cookieSpecial = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieSpecial  = 'darkDark';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieSpecial  = 'lightLight';
}

//bordo animazione pendolo
$bordoNewton = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $bordoNewton = 'bordoBianco';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $bordoNewton = 'bordoNero';
}

// colore aste animazioni pendolo con sfere
$spanBefore = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $spanBefore = 'whiteBefore';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $spanBefore = 'darkBefore';
}

// colore sfondo di alcuni elemento che però non hanno sfondo da tema scuro
$cookieSpecialNone = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieSpecialNone  = 'noneBackground';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieSpecialNone  = 'lightLight';
}

// colore sfondo bottoni
$cookieClick = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieClick  = 'darkButton';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieClick  = 'lightButton';
}

//sfondo durante il caricamento
$cookieBk = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieBk = 'backBlack';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieBk = 'backLight';
}

//sfondo delle righe di caricamento
$cookieLine = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieLine = 'lineLoadBlack';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieLine = 'lineLoadWhite';
}

//gestisco effetti hover
$cookieColorHo = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieColorHo = 'hoL';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieColorHo = 'hoD';
} 

//sfondo menu 
$cookieBackground = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieBackground  = 'darkMenu';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieBackground  = 'lightMenu';
}

//ombra menu
$cookieShadow = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieShadow  = 'shadowDarkMenu';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieShadow  = 'shadowLightMenu';
}

//sfondo sotto menu 
$cookieSubUno = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieSubUno  = 'darkMenuTwo';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieSubUno  = 'lightMenuTwo';
}

// hover del sottomenu
$cookieSubHover = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieSubHover  = 'hoverDark';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieSubHover  = 'hoverLight';
}

// sfondo galleria immagini
$cookieBacGallery = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieBacGallery = 'galleryDarkBac';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieBacGallery = 'galleryLightBac';
}

// colore elementi specifico scritte label
$cookieColors = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieColors = 'colorLight';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieColors = 'colorDark';
}

//bordo recensioni      
$cookieBorder = '';
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    $cookieBorder = 'borderDark';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    $cookieBorder = 'borderLight';
}