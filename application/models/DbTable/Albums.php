<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{

    protected $_name = 'albums';


    public function obtenirTousAlbums($i)
    {

        $row = $this->fetchAll();
        if (!$row) {
            throw new Exception("aucun Album trouver");
        }
        return $row->toArray();
    }

    public function obtenirAlbum($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterAlbum($artiste, $titre)
    {
        $data = array(
            'artiste' => $artiste,
            'titre' => $titre,
        );
        $this->insert($data);
    }

    public function modifierAlbum($id, $artiste, $titre)
    {
        $data = array(
            'artiste' => $artiste,
            'titre' => $titre,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function supprimerAlbum($id)
    {
        $this->delete('id =' . (int)$id);
    }


}

