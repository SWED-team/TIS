<?
abstract class Controller
{

    // Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
    protected $data = array();
    // Název šablony bez přípony
    protected $view = "";
    // Hlavička HTML stránky
    protected $header = array('title' => '', 'key_words' => '', 'description' => '');

    // Ošetří proměnnou pro výpis do HTML stránky
    private function varCheck($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->varCheck($v);
            }
            return $x;
        }
        else 
            return $x;
    }
    
    // Vyrenderuje view
    public function printView()
    {
        if ($this->view)
        {
            extract($this->varCheck($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view . ".phtml");
        }
    }
    
    // Presmeruje na dane url
    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    // Hlavní metoda controlleru
    abstract function proceed($parameters);

}