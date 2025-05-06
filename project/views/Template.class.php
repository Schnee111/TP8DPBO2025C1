<?php
class Template {
    private $template;
    private $vars = array();
    
    public function __construct($template = '') {
        $this->template = $template;
    }
    
    public function replace($key, $value) {
        $this->vars[$key] = $value;
    }
    
    public function write() {
        if (file_exists($this->template)) {
            $output = file_get_contents($this->template);
            
            foreach ($this->vars as $key => $value) {
                $output = str_replace('{' . $key . '}', $value, $output);
            }
            
            echo $output;
        } else {
            echo "Template {$this->template} not found!";
        }
    }
}
?>