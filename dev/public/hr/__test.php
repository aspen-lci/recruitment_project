<?php

require_once('../../private/initialize.php'); 

 $id = $_GET['id'];

    $candidate_list = get_candidate_by_id($id);
    $candidate = $candidate_list[0];

    $document_list = documents_by_candidate($id);
    $link = [];
    $link['jd'] = get_jd_link($document_list);
    $link['disc'] = get_doc_link($document_list, '4');
    $link['lea'] = get_doc_link($document_list, '5');
    $link['bcg'] = get_doc_link($document_list, '6');

$document_ids = array_column($document_list, 'document_id');

if (in_array(4, $document_ids)) {
 echo "True"; 
} else {
 echo "False";
}


?>