<?php 

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct()
    {
        $this->model = new User();
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->latest()->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->setModel($this->model,$data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model,$param)
    {
        $this->model = $model;
        $this->model->name = $param["name"]??$model->name;
        $this->model->email = $param["email"]??$model->email;
        $this->model->address = $param["address"]??$model->address;
        $this->model->phone = $param["phone"]??$model->phone;
        $this->model->dob = $param["dob"]??$model->dob;
        $this->model->password = $param["password"]??$model->password;
        $this->model->api_token = $param["api_token"]??$model->api_token;
        $this->model->save();
        return $this->model;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function roles($role){
        return User::role($role)->get();

    }
}