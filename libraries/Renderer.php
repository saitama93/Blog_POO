<?php

class Renderer
{
    /**
     * Affiche un template HTML en infectant les $variables
     * 
     * @param strin $path
     * @param array $variables
     * @return void
     */
    public static function render(string $path, array $variables = [])
    {
        extract($variables);
        ob_start();
        require('templates/' . $path . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }
}
