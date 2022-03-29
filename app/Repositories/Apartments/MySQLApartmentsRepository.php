<?php
namespace App\Repositories\Apartments;
use App\Database;
use App\Models\ApartmentsInfo;
use App\Repositories\Apartments;

class MySQLApartmentsRepository implements ApartmentRepository
{
    private $id;
public function save(ApartmentsInfo $apartments):void
{
    Database::connect()
        ->insert('apartments', [
            'address' => $apartments->getAddress(),
            'name' => $apartments->getName(),
            'cost' => $apartments->getCost()
        ]);
    $connection = Database::connect();
    $result = $connection
        ->createQueryBuilder()
        ->select('*')
        ->from('apartments')
        ->where('address = ?')
        ->setParameter(0, $apartments->getAddress())
        ->executeQuery()
        ->fetchAssociative();
$this->id=$result["id"];
}
    public function getId()
    {
        return $this->id;
    }

    public function show()
    {
        $connection = Database::connect();
        $results = $connection
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->executeQuery()
            ->fetchAllAssociative();
return $results;
    }

    public function edit($id){
        $connection = Database::connect();
        $result = $connection
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();
return $result;
    }
    public function delete($id){
        Database::connect()
            ->delete('apartments', [
                'id' => $id
            ]);
    }
public function update($request){
    Database::connect()
        ->update('apartments', [
            'address' => $request->getAddress(),
            'name' => $request->getName(),
            'cost' => $request->getCost()
        ], ['id' => $request->getApartmentId()
        ]);
}
}