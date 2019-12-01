<?php
/**
 * Form class for the Album Model
 *
 * This class adds form fields to hydrate to the Albul Model.
 *
 * @see https://github.com/dreboard/zend
 */
namespace Album\Form;

use Zend\Form\Form;

/**
 * Class AlbumForm
 * @package Album\Form
 */
class AlbumForm extends Form
{
    /**
     * AlbumForm constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}