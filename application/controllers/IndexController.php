<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $albums = new Application_Model_DbTable_Albums();
        $this->view->albums = $albums->fetchAll();
    }

    public function ajouterAction()
    {
        $form = new Application_Form_Album();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artiste = $form->getValue('artiste');
                $titre = $form->getValue('titre');
                $albums = new Application_Model_DbTable_Albums();
                $albums->ajouterAlbum($artiste, $titre);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction()
    {
        $form = new Application_Form_Album();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $artiste = $form->getValue('artiste');
                $titre = $form->getValue('titre');
                $albums = new Application_Model_DbTable_Albums();
                $albums->modifierAlbum($id, $artiste, $titre);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->obtenirAlbum($id));
            }
        }
    }

    public function supprimerAction()
    {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->supprimerAlbum($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->obtenirAlbum($id);
        }
    }


}







