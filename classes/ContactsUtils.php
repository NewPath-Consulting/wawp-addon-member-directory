<?php

namespace PO\classes;

class ContactsUtils {

  public static function generateSelectStatement($customFields) {
    $customFields = array_map(function($item) {
        return "'$item'";
    }, $customFields);

    return implode(',', $customFields);
  }

  public static function generateFilterStatement($filterList) {
    if (empty($filterList) || empty($filterList[0]))
      return null;


    $filter = array_reduce($filterList, function($filter, $item) {
      if (strrpos($item, " OR", -3)) {
        return $filter . $item . " ";
      } else {
        return $filter . $item . " AND ";
      }
    });

    //clear the 'OR' or 'AND' from the last statement
    if (strrpos($filter, " OR ", -4)) {
      $filter = substr($filter, 0, -4);
    }

    if (strrpos($filter, " AND ", -5)) {
      $filter = substr($filter, 0, -5);
    }

    return $filter;
  }
}
?>