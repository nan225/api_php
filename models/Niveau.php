<?php
class Niveau
{
    private $table="niveau";
    private $connexion=null;

    //les propriétes de l'objet étudiant

    public $id_niveau;
    public $niveau;
  

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
        $sql="UPDATE $this->table set niveau=:niveau
        WHERE id_niveau=:id_niveau";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":id_niveau"=>$this->id_niveau,
            ":niveau"=>$this->niveau
         
        ]);
        if($re){
            return true;
        }else{
            return false;
        }
    }


    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id_niveau=:id_niveau";

        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array("id_niveau" => $this->id_niveau));

        if ($re) {
            return true;
        } else {
            return false;
        }
        

    }

}