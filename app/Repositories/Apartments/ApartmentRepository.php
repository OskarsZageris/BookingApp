<?php

namespace App\Repositories\Apartments;

use App\Models\ApartmentsInfo;

interface ApartmentRepository {
public function save(ApartmentsInfo $apartments):void;
public function show();
public function edit($id);
public function delete($id);
public function update($request);

}
