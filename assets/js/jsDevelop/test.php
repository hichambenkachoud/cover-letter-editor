<?php

*
 * if (isset($_POST['nbrBlock'])){

               // $rowNum = htmlspecialchars($_POST['nbrBlock']);


               // die();

                for ($i = 1; $i <= $rowNum; $i++) {
                    var_dump('blockValue'.$i);
                    if (isset($_POST['blockValue'.$i])){

                        $valueBlock = htmlspecialchars($_POST['blockValue'.$i]);
                        $roadMapBlock = new RoadMapBlock(array(
                            'defaultvalue' =>$valueBlock,
                            'order' =>'',
                            'raodmapid' => $idRoadMapLast,
                            'state' => 1
                        ));
                        //$roadMapBlockManager->add($roadMapBlock);
                    }



                    // get Last RoadMapBlock added to add RoadMap Field
                    $lastRoadMapBlockAdded = $roadMapBlockManager->getRoadMapBlocks(
                        "Site(roadMapBlocks).*",
                        "WHERE Site(roadMapBlocks).state =:state",
                        array(
                            'state' => 1
                        ),
                        "Site(roadMapBlocks).id DESC LIMIT 1"
                    )->getRows();

                    if ($lastRoadMapBlockAdded){
                        $RoadMapBlock = $lastRoadMapBlockAdded[0]->getRoadMapBlock();
                    }
                    $idRoadMapBlockLast = $RoadMapBlock->getId();
                    //var_dump($idRoadMapBlockLast);

                    if (isset($_POST['nbrField'])){
                        $numberField = $_POST['nbrField'];
                        for ($j = 1; $j <= $numberField; $j++){

                            if (isset($_POST['fieldBlockValue'.$i.'_'.$j]) && isset($_POST['FieldAndOr'.$i.'_'.$j])){
                                var_dump('fieldBlockValue'.$i.'_'.$j);
                                $fieldBlockValue = $_POST['fieldBlockValue'.$i.'_'.$j];
                                $fieldAndOr = $_POST['FieldAndOr'.$i.'_'.$j];

                                $roadMapField = new RoadMapField(array(
                                    'wysiwyg' => $fieldBlockValue,
                                    'blockid' => $idRoadMapBlockLast,
                                    'andor' => $fieldAndOr,
                                    'state' => 1
                                ));
                                //$roadMapFieldManager->add($roadMapField);

                                //var_dump($roadMapField);
                            }

                            // get Last RoadMapField added to add RoadMapField Categories
                            $lastRoadMapFieldAdded = $roadMapFieldManager->getRoadMapFields(
                                "Site(roadMapFields).*",
                                "WHERE Site(roadMapFields).state =:state",
                                array(
                                    'state' => 1
                                ),
                                "Site(roadMapFields).id DESC LIMIT 1"
                            )->getRows();

                            if ($lastRoadMapFieldAdded){
                                $RoadMapField = $lastRoadMapFieldAdded[0]->getRoadMapField();
                            }
                            $idRoadMapFieldLast = $RoadMapField->getId();

                            if (isset($_POST['nbrFieldCategory'])){
                                $numberFIeldCategory = $_POST['nbrFieldCategory'];
                                for ($k = 1; $k <= $numberFIeldCategory; $k++){

                                    if (isset($_POST['fieldBlockCategory'.$j.'_'.$k])) {
                                        var_dump('fieldBlockCategory'.$j.'_'.$k);
                                        $categoryFieldId = $_POST['fieldBlockCategory' . $j . '_' . $k];

                                        $roadMapFieldCategoryField = new roadMapFieldCategoryField(array(
                                            'categoryfieldid' => $categoryFieldId,
                                            'roadmapfieldid' => $idRoadMapFieldLast,
                                            'state' => 1
                                        ));
                                        //var_dump($roadMapFieldCategoryField);
                                        //$RoadMapFieldCategoryFieldManager->add($roadMapFieldCategoryField);

                                    }

                                        $managerCategoryField = new CategoryFieldManager();

                                        $listCategoryField = $managerCategoryField->getCategoryFields(
                                            "Site(categoryFields).*",
                                            "WHERE Site(categoryFields).id = :min and Site(categoryFields).state = :state",
                                            array(
                                                'min' => $categoryFieldId,
                                                'state' => 1
                                            ),
                                            "Site(categoryFields).id ASC "
                                        )->getRows();

                                    $type='';
                                    if ($listCategoryField){
                                        $CategoryField = $listCategoryField[0]->getCategoryField();
                                    }
                                    $type = $CategoryField->getType();

                                    if (isset($_POST['nbrvalueField'])){
                                        $nbrvalueField = $_POST['nbrvalueField'];
                                        $lastAssociationAdd = $RoadMapFieldCategoryFieldManager->getRoadMapFieldCategoryField(
                                            "Site(roadMapFieldCategoryField).*",
                                            "WHERE Site(roadMapFieldCategoryField).state =:state",
                                            array(
                                                'state' => 1
                                            ),
                                            "Site(roadMapFieldCategoryField).id DESC LIMIT 1"
                                        )->getRows();

                                        if ($lastAssociationAdd){
                                            $RoadFieldAssociation = $lastAssociationAdd[0]->getroadMapFieldCategoryField();
                                        }
                                        $idRoadFieldAssociationLast = $RoadFieldAssociation->getId();
                                        for ($p = 1; $p <= $nbrvalueField; $p++){

                                            switch ($type){
                                                case CategoryFieldType::INTEGER :
                                                    if (isset($_POST['fieldValueOperator'.$k.'_'.$p])
                                                    && isset($_POST['fieldValueInteger'.$k.'_'.$p])){
                                                        var_dump('fieldValueInteger'.$k.'_'.$p);
                                                        $operator = htmlspecialchars($_POST['fieldValueOperator'.$k.'_'.$p]);
                                                        $value = htmlspecialchars($_POST['fieldValueInteger'.$k.'_'.$p]);
                                                        $table = '';

                                                        $fieldDisplayRule = new FieldDisplayRule(array(
                                                            'fieldAssociationid' => $idRoadFieldAssociationLast,
                                                            'fieldvalue' => $value,
                                                            'table' => $table,
                                                            'operator' => $operator,
                                                            'state' => 1
                                                        ));
                                                        //$fieldDisplayRuleManager->add($fieldDisplayRule);
                                                    }
                                                    break;
                                                case CategoryFieldType::STRING :
                                                    if (isset($_POST['stringValue'.$k.'_'.$p])){
                                                       var_dump('stringValue'.$k.'_'.$p);
                                                        $operator = '';
                                                        $value = htmlspecialchars($_POST['stringValue'.$k.'_'.$p]);
                                                        $table = '';

                                                        $fieldDisplayRule = new FieldDisplayRule(array(
                                                            'fieldAssociationid' => $idRoadFieldAssociationLast,
                                                            'fieldvalue' => $value,
                                                            'table' => $table,
                                                            'operator' => $operator,
                                                            'state' => 1
                                                        ));
                                                        //$fieldDisplayRuleManager->add($fieldDisplayRule);
                                                    }
                                                    break;
                                                case CategoryFieldType::BOOLEAN :
                                                    if (isset($_POST['booleanoption'.$k.'_'.$p])){
                                                        var_dump('booleanoption'.$k.'_'.$p);
                                                        $operator = '';
                                                        $value = htmlspecialchars($_POST['booleanoption'.$k.'_'.$p]);
                                                        $table = '';

                                                        $fieldDisplayRule = new FieldDisplayRule(array(
                                                            'fieldAssociationid' => $idRoadFieldAssociationLast,
                                                            'fieldvalue' => $value,
                                                            'table' => $table,
                                                            'operator' => $operator,
                                                            'state' => 1
                                                        ));
                                                        //$fieldDisplayRuleManager->add($fieldDisplayRule);
                                                    }
                                                    break;
                                                case CategoryFieldType::TABLE :
                                                    if (isset($_POST['tableNameValue'.$k.'_'.$p])){
                                                        var_dump($_POST['tableNameValue'.$k.'_'.$p]);
                                                        $operator = '';
                                                        $value = 'value Table';
                                                        $table = htmlspecialchars($_POST['tableNameValue'.$k.'_'.$p]);

                                                        $fieldDisplayRule = new FieldDisplayRule(array(
                                                            'fieldAssociationid' => $idRoadFieldAssociationLast,
                                                            'fieldvalue' => $value,
                                                            'table' => $table,
                                                            'operator' => $operator,
                                                            'state' => 1
                                                        ));
                                                        //$fieldDisplayRuleManager->add($fieldDisplayRule);
                                                    }
                                                    break;
                                            }



                                        }

                                    }


                                }
                            }



                        }
                        //if number field
                    }


                }

                // if number block
            }
 * */

 ?>