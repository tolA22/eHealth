<?php 
namespace App\Repositories\Schedule;

interface ScheduleRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);

    public function findByColumn(array $param);

    public function findBetweenDates(array $param,$id);

}