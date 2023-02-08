<?php
class Etudiant
{
    private $table="etudiant";
    private $connexion=null;

    //les propriétes de l'objet étudiant
    public $id_etudiant;
    public $nom;
    public $prenoms;
    public $matricule;
    public $email;
    public $dateNaissance;

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
        $sql="UPDATE $this->table set nom=:nom, prenoms=:prenoms,
         matricule=:matricule, email=:email,dateNaissance=:dateNaissance WHERE id_etudiant=:id_etudiant";
        //Préparation de la requete
        $req=$this->connexion->prepare($sql);

        //execution de la requete
        $re=$req->execute([
            ":id_etudiant"=>$this->id_etudiant,
            ":nom"=>$this->nom,
            ":prenoms"=>$this->prenoms,
            ":matricule"=>$this->matricule,
            ":email"=>$this->email,
            ":dateNaissance"=>$this->dateNaissance,
        ]);
        if($re){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id_etudiant=:id_etudiant";

        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array("id_etudiant" => $this->id_etudiant));

        if ($re) {
            return true;
        } else {
            return false;
        }
        

    }

}