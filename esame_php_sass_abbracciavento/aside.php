<aside class="box tre">

            <h3><?php echo $aside->pagina->h3;?></h3>
            <ul>
                <?php
                    $asd = $aside-> aside;
                    foreach ($asd as $linkAs){
                        $linkUrl = basename($linkAs->url);
                        if($linkUrl == $currentPage){
                            continue;
                        }
                        printf('<li><a href="%s" title="%s">%s</a></li>', $linkAs->url, $linkAs->title, $linkAs->testo);
                    }
                ?>
            </ul>

        </aside>