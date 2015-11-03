<?
class RouterController extends Controller{
    protected $controller;


    private function replaceDashes($text) 
    {
        $replaced = str_replace('_', ' ', $text);
        $replaced = ucwords($replaced);
        $replaced = str_replace(' ', '', $replaced);
        return $replaced;
    }


    private function parseURL($url){
        // Naparsuje jednotlive casti url adresy a vrati pole parametrov
        $parsedURL = parse_url($url);
        // Odstranění počátečního lomítka
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        // Odstranění bílých znaků kolem adresy
        $parsedURL["path"] = trim($parsedURL["path"]);
        // Rozbití řetězce podle lomítek
        $path = explode("/", $parsedURL["path"]);
        return $path;
    }

    function proceed($param){
        $parsedURL = $this->parseURL($param[0]);
                
        if (empty($parsedURL[0]))      
            $this->redirect('clanek/uvod');        
        // controller je 1. parameter URL
        $controllerClass = $this->replaceDashes(array_shift($parsedURL)) . 'Controller';
        
        if (file_exists('controllers/' . $controllerClass . '.php'))
            $this->controller = new $controllerClass;
        else
            $this->redirect('error');
        
        // volanie controllera
        $this->controller->proceed($parsedURL);
        
        // Nastavenie premennych pre sablonu
        $this->data['title'] = $this->controller->header['title'];
        $this->data['description'] = $this->controller->header['description'];
        $this->data['key_words'] = $this->controller->header['key_words'];
        
        // Nastavenie hlavnej sablony
        $this->view = 'defaultLayout';
    }


}





?>