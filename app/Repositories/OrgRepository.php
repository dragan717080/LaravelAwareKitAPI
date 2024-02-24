<?php

namespace App\Repositories;

use App\Models\{Org, Contact, Phone, Creator };
use App\Repositories\Traits\{ GetByIdTrait, DeleteTrait };

class OrgRepository
{
    use GetByIdTrait;
    use DeleteTrait;

    public $model;

    public function __construct(private UserRepository $userRepository)
    {
        $this->model = new Org();
    }

    public function getAll()
    {
        return Org::all();
    }

    public function update($id, $name, $description, $type)
    {
        $org = $this->model->find($id);
    
        if (!$org) {
            return null;
        }
    
        if ($name !== null) {
            $org->name = $name;
        }

        if ($description !== null) {
            $org->description = $description;
        }
    
        if ($type !== null) {
            $org->type = $type;
        }
    
        $org->save();
    
        return $org;
    }

    public function create(
        string $name, 
        ?string $description, 
        string $type, 
        array $contact, 
        string $creatorId
    )
    {
        // Create Org without saving it
        $org = new Org();
        $org->name = $name;
        $org->description = $description;
        $org->type = $type;
        $org->creator_id = $this->userRepository->getById($creatorId)->id;

        // Save Org to get the id
        $org->save();

        // Create Contact and associate with the Org
        $contactModel = new Contact();
        $contactModel->email = $contact['email'];
        $contactModel->org_id = $org->id;
        $contactModel->save();

        // Create Phone and associate with Contact
        $phoneModel = new Phone();
        $phoneModel->countryCode = $contact['phone']['countryCode'];
        $phoneModel->number = $contact['phone']['number'];
        $phoneModel->contact_id = $contactModel->id;
        $phoneModel->save();

        // Associate Contact with the Org
        $org->contact()->save($contactModel);
        $org->save();

        // Eager load the contact and phone relationships
        $contactModel->load('phone');

        // Eager load the creator and contact relationships
        $org->load('contact', 'creator');

        return $org;
    }
}
