<?php
    echo '<nav>
            <div class="nav-wrapper">';
            echo '<img src="app/assets/imgs/kabumLogo.png" class="brand-logo left logo-kabum" alt="Logo do KaBuM!" >';
            if (isset($_COOKIE['token'])) {
                echo '<i class="fas fa-sign-out-alt right" id="logout-btn">Logout</i>';
            }
            echo '</div>
        </nav>';