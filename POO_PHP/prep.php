<?php
class professeur{
    private int $CodePro;
    private string $NomPro;
    private string $PrenomPro;
    private string $DateNaissance;
    private string $Grade;

    public function __construct(int $CodePro,string $NomPro,string $PrenomPro,string $DateNaissance,string $Grade){
        $this->CodePro=$CodePro;
        $this->NomPro=$NomPro;
        $this->PrenomPro=$PrenomPro;
        $this->DateNaissance=$DateNaissance;
        $this->Grade=$Grade;
    }

    public function getCodePro(){
        return $this->CodePro;
    }

}

?>