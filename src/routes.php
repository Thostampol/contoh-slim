<?php
// use Slim\Http\UploadedFile;
// function moveUploadedFile($directory, UploadedFile $uploadedFile){
//     $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
//     $basename = 'assasa' . '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
//     $filename = sprintf('%s.%0.8s', $basename, $extension);

//     $uploadedFile->moveTo($directory. DIRECTORY_SEPARATOR .$filename);

//     return $filename;
// }
    
    // Library group fasilitas
    $app->group('/fasilitas', function () use ($app) {
        $app->get('/[{id}]', function ($request, $response, $args) {
           $sth = $this->db->prepare("SELECT *,to_char(tanggal,'dd-MM-yyyy') as tgl FROM CompanyFasilitas WHERE (CompanyID =:id) ORDER BY id");
           $sth->bindParam("id", $args['id']);
           $sth->execute();
           $todos = $sth->fetchAll();
           return $response->withStatus(200)
           ->withHeader('Content-Type', 'application/json')
           ->write(json_encode($todos));
        });
        $app->get('/detail/{id}/{cmp}', function ($request, $response, $args) {
            $sth = $this->db->prepare("Select * from Companyfasilitas where ID = :id AND Companyid=:cmp ");
            $sth->bindParam("cmp", $args['cmp']);
            $sth->bindParam("id", $args['id']);
            $sth->execute();
            $todos = $sth->fetchObject();
            return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($todos));
        });
        $app->delete('/delete/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("DELETE FROM Companyfasilitas WHERE id=:id");
         $sth->bindParam("id", $args['id']);
         $sth->execute();
         $todos = $sth->fetchAll();
         return $this->response->withJson($todos);
        });
         $app->post('/tambah', function ($request, $response) {
            try {
                $directory = "../img/";
                $uploadedFiles = $request->getUploadedFiles();
                $input = $request->getParsedBody();
                $sql = "INSERT INTO Companyfasilitas (companyid,
                namafasilitas,
                tanggal,
                keterangan,
                picname0,
                picname1,
                picname2,
                picname3,
                picname4,
                picname5,
                picname6,
                picname7,
                picname8,
                picname9
                ) VALUES (:companyid,
                :namafasilitas,
                :tanggal,
                :keterangan,
                :picname0,
                :picname1,
                :picname2,
                :picname3,
                :picname4,
                :picname5,
                :picname6,
                :picname7,
                :picname8,
                :picname9 
                )";
                $sth = $this->db->prepare($sql);
                $sth->bindParam("companyid", $input['companyid']);
                $sth->bindParam("namafasilitas", $input['namafasilitas']);
                $sth->bindParam("tanggal", $input['tanggal']);
                $sth->bindParam("keterangan", $input['keterangan']);
                // $sth->bindParam("picname0", $input['picname0']);
                $sth->bindParam("picname1", $input['picname1']);
                $sth->bindParam("picname2", $input['picname2']);
                $sth->bindParam("picname3", $input['picname3']);
                $sth->bindParam("picname4", $input['picname4']);
                $sth->bindParam("picname5", $input['picname5']);
                $sth->bindParam("picname6", $input['picname6']);
                $sth->bindParam("picname7", $input['picname7']);
                $sth->bindParam("picname8", $input['picname8']);
                $sth->bindParam("picname9", $input['picname9']);
                if($uploadedFiles){
                    if(isset($uploadedFiles['picname0']) && $uploadedFiles['picname0'] !='' ) {
                        $extension = pathinfo($uploadedFiles['picname0']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname0']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname0']->getError() == 0) {
                         $sth->bindParam("picname0",$filename);
                         //$response->write(json_encode($filename)); 
                        }
                    }
                    if(isset($uploadedFiles['picname1']) && $uploadedFiles['picname1'] !=''){
                        $extension = pathinfo($uploadedFiles['picname1']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname1']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname1']->getError() == 0) {
                         $sth->bindParam("picname1",$filename);
                         //$response->write(json_encode($filename)); 
                        }
                    }
                    if(isset($uploadedFiles['picname2']) && $uploadedFiles['picname2'] !=''){
                        $extension = pathinfo($uploadedFiles['picname2']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname2']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname2']->getError() == 0) {
                           $sth->bindParam("picname2",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname3']) && $uploadedFiles['picname3'] !=''){
                        $extension = pathinfo($uploadedFiles['picname3']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname3']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname3']->getError() == 0) {
                           $sth->bindParam("picname3",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname4']) && $uploadedFiles['picname4'] !=''){
                        $extension = pathinfo($uploadedFiles['picname4']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname4']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname4']->getError() == 0) {
                           $sth->bindParam("picname4",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname5']) && $uploadedFiles['picname5'] !=''){
                        $extension = pathinfo($uploadedFiles['picname5']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname5']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname5']->getError() == 0) {
                           $sth->bindParam("picname5",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname6']) && $uploadedFiles['picname6'] !=''){
                        $extension = pathinfo($uploadedFiles['picname6']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname6']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname6']->getError() == 0) {
                           $sth->bindParam("picname6",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname7']) && $uploadedFiles['picname7'] !=''){
                        $extension = pathinfo($uploadedFiles['picname7']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname7']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname7']->getError() == 0) {
                           $sth->bindParam("picname7",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname8']) && $uploadedFiles['picname8'] !=''){
                        $extension = pathinfo($uploadedFiles['picname8']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname8']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname8']->getError() == 0) {
                           $sth->bindParam("picname8",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                    if(isset($uploadedFiles['picname9']) && $uploadedFiles['picname9'] !=''){
                        $extension = pathinfo($uploadedFiles['picname9']->getClientFilename(), PATHINFO_EXTENSION);
                        $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                        $filename = sprintf('%s.%0.8s', $basename, $extension);
                        $uploadedFiles['picname9']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                        if($uploadedFiles['picname9']->getError() == 0) {
                           $sth->bindParam("picname9",$filename);
                           //$response->write(json_encode($filename)); 
                       }
                   }
                   return $sth->execute();
                   $response->withJson(["status" => "success", "data" => $input], 200);
                }
                //$input['id'] = $t
                //return $this->response->withJson("{ success }");
            } catch (PDOException $ex){
                return $ex->getMessage();
            }
         });
        $app->put('/update/{id}', function ($request, $response, $args) {
        try {
           $directory = "../img/";
           $uploadedFiles = $request->getUploadedFiles();
           $input = $request->getParsedBody();
           $sql = "Update CompanyFasilitas SET NamaFasilitas=:namafasilitas ,Keterangan=:keterangan,Tanggal=:tanggal, 
           Picname0=:picname0,
           Picname1=:picname1,  
           Picname2=:picname2, 
           Picname3=:picname3,
           Picname4=:picname4,
           Picname5=:picname5,
           Picname6=:picname6,
           Picname7=:picname7,
           Picname8=:picname8,
           Picname9=:picname9 where ID=:id";
           
           $sth = $this->db->prepare($sql);
           $input['id'] = $args['id'];
           $sth->bindParam("id", $input['id']);
           $sth->bindParam("namafasilitas", $input['namafasilitas']);
           $sth->bindParam("keterangan", $input['keterangan']);
            // $sth->bindParam("picname0", $input['picname0']);
           $sth->bindParam("picname1", $input['picname1']);
           $sth->bindParam("picname2", $input['picname2']);
           $sth->bindParam("picname3", $input['picname3']);
           $sth->bindParam("picname4", $input['picname4']);
           $sth->bindParam("picname5", $input['picname5']);
           $sth->bindParam("picname6", $input['picname6']);
           $sth->bindParam("picname7", $input['picname7']);
           $sth->bindParam("picname8", $input['picname8']);
           $sth->bindParam("picname9", $input['picname9']);
           if($uploadedFiles){
            if(isset($uploadedFiles['picname0']) && $uploadedFiles['picname0'] !='' ) {
                $extension = pathinfo($uploadedFiles['picname0']->getClientFilename(), PATHINFO_EXTENSION);
                $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                $filename = sprintf('%s.%0.8s', $basename, $extension);
                $uploadedFiles['picname0']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                if($uploadedFiles['picname0']->getError() == 0) {
                   $sth->bindParam("picname0",$filename);
                         //$response->write(json_encode($filename)); 
               }
            }
           if(isset($uploadedFiles['picname1']) && $uploadedFiles['picname1'] !=''){
            $extension = pathinfo($uploadedFiles['picname1']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname1']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname1']->getError() == 0) {
               $sth->bindParam("picname1",$filename);
                         //$response->write(json_encode($filename)); 
               }
           }
           if(isset($uploadedFiles['picname2']) && $uploadedFiles['picname2'] !=''){
            $extension = pathinfo($uploadedFiles['picname2']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname2']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname2']->getError() == 0) {
             $sth->bindParam("picname2",$filename);
                               //$response->write(json_encode($filename)); 
             }
         }
         if(isset($uploadedFiles['picname3']) && $uploadedFiles['picname3'] !=''){
            $extension = pathinfo($uploadedFiles['picname3']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname3']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname3']->getError() == 0) {
             $sth->bindParam("picname3",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname4']) && $uploadedFiles['picname4'] !=''){
            $extension = pathinfo($uploadedFiles['picname4']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname4']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname4']->getError() == 0) {
             $sth->bindParam("picname4",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname5']) && $uploadedFiles['picname5'] !=''){
            $extension = pathinfo($uploadedFiles['picname5']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname5']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname5']->getError() == 0) {
             $sth->bindParam("picname5",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname6']) && $uploadedFiles['picname6'] !=''){
            $extension = pathinfo($uploadedFiles['picname6']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname6']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname6']->getError() == 0) {
             $sth->bindParam("picname6",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname7']) && $uploadedFiles['picname7'] !=''){
            $extension = pathinfo($uploadedFiles['picname7']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname7']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname7']->getError() == 0) {
             $sth->bindParam("picname7",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname8']) && $uploadedFiles['picname8'] !=''){
            $extension = pathinfo($uploadedFiles['picname8']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname8']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname8']->getError() == 0) {
             $sth->bindParam("picname8",$filename);
                                   //$response->write(json_encode($filename)); 
         }
        }
        if(isset($uploadedFiles['picname9']) && $uploadedFiles['picname9'] !=''){
            $extension = pathinfo($uploadedFiles['picname9']->getClientFilename(), PATHINFO_EXTENSION);
            $basename = 'USR_'. '_' . str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFiles['picname9']->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
            if($uploadedFiles['picname9']->getError() == 0) {
             $sth->bindParam("picname9",$filename);
            //$response->write(json_encode($filename)); 
         }
        }
        
        $sth->execute();
        $response->withJson(["status" => "success", "data" => $input], 200);
        }
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        });
    });
    $app->group('/sertifikat', function () use ($app) {
        $app->get('/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM CompanySertifikat WHERE (CompanyID =:id) ORDER BY JenisSertifikat");
         $sth->bindParam("id", $args['id']);
         $sth->execute();
         $sertifikat = $sth->fetchAll();
         return $response->withStatus(200)
         ->withHeader('Content-Type', 'application/json')
         ->write(json_encode($sertifikat));
        });

        $app->get('/detail/{id}/{cmp}', function ($request, $response, $args) {
         $sth = $this->db->prepare("Select * from CompanySertifikat where id = :id AND Companyid=:cmp");
         $sth->bindParam("id", $args['id']);
         $sth->bindParam("cmp", $args['cmp']);
         $sth->execute();
         $sertifikat = $sth->fetchAll();
         return $response->withStatus(200)
         ->withHeader('Content-Type', 'application/json')
         ->write(json_encode($sertifikat));
        });

        $app->get('/delete/{id}/{cmp}', function ($request, $response, $args) {
           $sth = $this->db->prepare("Select * from CompanySertifikat where id = :id AND Companyid=:cmp");
           $sth->bindParam("id", $args['id']);
           $sth->bindParam("cmp", $args['cmp']);
           $sth->execute();
           $sertifikat = $sth->fetchAll();
           return $response->withStatus(200)
           ->withHeader('Content-Type', 'application/json')
           ->write(json_encode($sertifikat));
       });
    });
    // $app->get('/country/[{id}]', function ($request, $response, $args) {
    //      $sth = $this->db->prepare("SELECT * FROM country WHERE id =:id");
    //     $sth->bindParam("id", $args['id']);
    //     $sth->execute();
    //     $todos = $sth->fetchObject();
    //     // return $this->response->withJson($todos);
    //     return $response->withStatus(200)
    //     ->withHeader('Content-Type', 'application/json')
    //     ->write(json_encode($todos));
    // });
 
 // $app->post('/country', function ($request, $response) {
 //    try {
 //        $input = $request->getParsedBody();
 //        $sql = "INSERT INTO country (nama) VALUES (:nama)";
 //        $sth = $this->db->prepare($sql);
 //        $sth->bindParam("nama", $input['nama']);
 //        $sth->execute();
 //        //$input['id'] = $this->db->lastInsertId();
 //        return $this->response->withJson("{ success }");
 //    } catch (PDOException $ex){
 //        return $ex->getMessage();
 //    }

 // });

 // $app->post('/task', function ($request, $response) {
 //    try {
 //        $directory = "gambarnya/";
 //        $uploadedFiles = $request->getUploadedFiles();
 //        $uploadedFile = $uploadedFiles['task'];
 //        $sql = "INSERT into tasks (task) values (:task)";
 //        $sth = $this->db->prepare($sql);
 //        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
 //            $filename = moveUploadedFile($directory, $uploadedFile);
 //            $sth->bindParam("task",$filename);
 //            $sth->execute();
 //            $response->write(json_encode($filename));
 //        }
 //    }catch (PDOException $ex){
 //        return $ex->getMessage();
 //    }
 // });