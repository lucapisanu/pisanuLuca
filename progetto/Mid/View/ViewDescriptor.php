<?php

// classe per popolare la vista della pagina
class ViewDescriptor {
    

    const get = 'get';
    const post = 'post';

    
    private $titolo;
    private $logo_file;
    private $menu_file;
    private $leftBarSection_file;
    private $leftBarInfo_file;
    private $leftItem; 
    private $content_file;
    private $messaggioErrore;
    private $messaggioConferma;
    private $pagina;
    private $sottoPagina;
    private $impToken;

    
    //costruttore
    public function __construct() {
        ;
    }

    public function getTitolo() {
        return $this->titolo;
    }

   
    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }
  
    public function setLogoFile($logoFile) {
        $this->logo_file = $logoFile;
    }

    public function getLogoFile() {
        return $this->logo_file;
    }

    public function getMenuFile() {
        return $this->menu_file;
    }

    public function setMenuFile($menuFile) {
        $this->menu_file = $menuFile;
    }

    public function getLeftBarSectionFile() {
        return $this->leftBarSection_file;
    }
    
    public function setLeftBarSectionFile($leftBarSection) {
        $this->leftBarSection_file = $leftBarSection;
    }
    
    public function getLeftBarInfoFile() {
        return $this->leftBarInfo_file;
    }

    public function setLeftBarInfoFile($leftBarInfo) {
        $this->leftBarInfo_file = $leftBarInfo;
    }

    public function setContentFile($contentFile) {
        $this->content_file = $contentFile;
    }

    public function getContentFile() {
        return $this->content_file;
    }
    
    public function getMessaggioErrore() {
        return $this->messaggioErrore;
    }

    public function setMessaggioErrore($msg) {
        $this->messaggioErrore = $msg;
    }

    public function getSottoPagina() {
        return $this->sottoPagina;
    }

    public function setSottoPagina($pag) {
        $this->sottoPagina = $pag;
    }

    public function getMessaggioConferma() {
        return $this->messaggioConferma;
    }

    public function setMessaggioConferma($msg) {
        $this->messaggioConferma = $msg;
    }

    public function getPagina() {
        return $this->pagina;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    public function setImpToken($token) {
        $this->impToken = $token;
    }

    public function scriviToken($pre = '', $method = self::get) {
        $imp = BaseController::impersonato;
        switch ($method) {
            case self::get:
                if (isset($this->impToken)) {
                   
                    return $pre . "$imp=$this->impToken";
                }
                break;

            case self::post:
                if (isset($this->impToken)) {
                    return "<input type=\"hidden\" name=\"$imp\" value=\"$this->impToken\"/>";
                }
                break;
        }

        return '';
    }

}

?>
