<?php
class Note
{
    private $table="notes";
    private $connexion=null;

    //les propriétes de l'objet étudiant
    public $id_note;
    public $Id_module;
    public $noteTD;
    public $noteTP;
    public $noteEXAM;
    public $noteRTPG;
    public $id_ay;

    public function __construct($db)
    {
        if($this->connexion==null)
        $this->connexion=$db;
    }

    //lecture des articles

    public function readAll(){
        //on crée la requete
        $sql="SELECT * FROM $this->table";

        $req= $this->connexion->query($sql);

        return $req;
    }

    public function update(){
        $sql="UPDATE $this->table set Id_module=:Id_module, noteTD=:noteTD,
         noteTP=:noteTP, noteEXAM=:noteEXAM,noteRTPG=:noteRTPG,id_ay=:id_ay WHERE id_note=:id_note";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":id_note"=>$this->id_note,
            ":Id_module"=>$this->Id_module,
            ":noteTD"=>$this->noteTD,
            ":noteTP"=>$this->noteTP,
            ":noteEXAM"=>$this->noteEXAM,
            ":noteRTPG"=>$this->noteRTPG,
            ":id_ay"=>$this->id_ay,
        ]);
        if($re){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id_note=:id_note";

        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array("id_note" => $this->id_note));

        if ($re) {
            return true;
        } else {
            return false;
        }
        

    }

}