<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        class agence{
            private $codeAg;
            private $nomAg;
            private $adresseAg;
            private $telAg;
            public function __constructor($codeAg,$nomAg,$adresseAg,$telAg){
                $this->codeAg=
                $this->nomAg=$nomAg;
                $this->adresseAg=$adresseAg;
                $this->telAg=$telAg;
            }
            public function getcodeAg($this){
                return $this->codeAg;
             }
             public function getNomAg($this){
                return $this->nomAg;
             }
            
            public function __toString(){
                return "$this->nomAg: $this->adresseAg"
            }
        }

    ?>
</body>
</html>