<?php
class Collection
{
    private $_tab = [];

    /**
     * Ajoute un élément à la collection
     *
     * @param mixed $obj
     * @param null  $key
     *
     * @throws KeyHasUseException
     */
    public function ajouter($obj, $key = null)
    {
        if ($key === null) {
            $this->_tab[] = $obj;
        } else {
            if (array_key_exists($key, $this->_tab)) {
                throw new KeyHasUseException("Key $key already in use.");
            } else {
                $this->_tab[$key] = $obj;
            }
        }
    }

    /**
     * Récupère l'élément $key
     *
     * @param mixed $key
     *
     * @return mixed
     * @throws KeyInvalidException
     */
    public function getElement($key)
    {
        if (array_key_exists($key, $this->_tab)) {
            return $this->_tab[$key];
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    /**
     * @param mixed $key
     *
     * @throws KeyInvalidException
     */
    public function supprimer($key)
    {
        if (array_key_exists($key, $this->_tab)) {
            unset($this->_tab[$key]);
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->_tab;
    }

    /**
     * @return array
     */
    public function getCles()
    {
        return array_keys($this->_tab);
    }

    /**
     * @return int
     */
    public function taille()
    {
        return count($this->_tab);
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function cleExiste($key)
    {
        return array_key_exists($key, $this->_tab);
    }

    public function vider()
    {
        $this->_tab = array();
    }
}
