<div id="sections">
    <ul>
        <?php if (isset($submenuItems)): ?>
            <?php foreach ( $submenuItems as $name => $uri ): ?>
                 <li <?php echo strpos($uri,$this->uri->segment(2)) ? 'class="active"' : '' ?>>
                    <a href="/<?php echo $uri ?>"><?php echo $name ?></a>
                </li>
            <?php endforeach ?>
        <?php endif ?>
    </ul>

    <div class="description">
        <?php
           $moduleDetails = include BOONE . 'codeigniter/bootstrap/appdesc.php';

           echo (isset($moduleDetails[$this->uri->segment(1)]) && is_null($this->uri->segment(2))) ? 
                $moduleDetails[$this->uri->segment(1)] : 
                $this->moduleDetails['description'];
        ?>
    </div>
</div>
