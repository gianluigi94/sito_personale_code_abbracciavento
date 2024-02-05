<!-- In questa pagina definisco l'aside per la navigazione più facile tra i vari progetti -->
<!-- Su un file json sono riportati tutti i progetti che serviranno da link per la navigazione. Tuttavia ho fatto in modo che "salti" il nome che corrisponde alla pagina stessa dove si trova l'utente, perché non aveva senso inserire il link al progetto che si stava già visualizzando -->

<aside class="tre">

    <h3><?php echo $aside->pagina->h3; ?></h3>
    <ul>
        <?php
        $asd = $aside->aside;
        foreach ($asd as $linkAs) {
            $linkUrl = basename($linkAs->url);
            if ($linkUrl == $currentPage) {
                continue;
            }
            printf('<li><a href="%s" title="%s">%s</a></li>', $linkAs->url, $linkAs->title, $linkAs->testo);
        }
        ?>
    </ul>

</aside>