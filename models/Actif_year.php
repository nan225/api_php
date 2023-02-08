<?php
class Actif_year
{
    private $table="actif_year";
    private $connexion=null;

    //les propriétes de l'objet étudiant
    public $id_ay;
    public $id_niveau;
    public $promo;
    public $groupe;
    public $id_etudiant;

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
        $sql="UPDATE $this->table set id_niveau=:id_niveau,promo=:promo,groupe=:groupe,id_etudiant=:id_etudiant WHERE id_ay=:id_ay";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":id_ay"=>$this->id_ay,
            ":id_niveau"=>$this->id_niveau,
            ":promo"=>$this->promo,
            ":groupe"=>$this->groupe,
            ":id_etudiant"=>$this->id_etudiant,
        ]);
        if($re){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id_ay=:id_ay";

        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array("id_ay" => $this->id_ay));

        if ($re) {
            return true;
        } else {
            return false;
        }
        

    }

}

