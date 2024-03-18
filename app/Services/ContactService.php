<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    protected $contact;
    
    /**
     * __construct
     *
     * @param  mixed $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        return $this->contact->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function massRemove($id)
    {
        return $this->contact->whereIn('id', $id);
    }
}
