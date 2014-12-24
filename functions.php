<?php

// показ всех объявлений
function showAll($link){
    $query = "SELECT id, date, title, price, seller_name FROM ads ORDER BY id";
    $res = mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }
return $data;
}

// добавление объявления
function newAd($link, $new_ad){
    $query = "INSERT INTO ads (date, title, price, seller_name, private, email, allow_mails, phone, location_id, category_id, description)
              VALUES (now(), '$new_ad[title]', $new_ad[price], '$new_ad[seller_name]', $new_ad[private], '$new_ad[email]', $new_ad[allow_mails], '$new_ad[phone]', $new_ad[location_id], $new_ad[category_id], '$new_ad[description]')";
    mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
}


// редактирование объявления
function updateAd ($link, $update_ad, $id){
    $query = "UPDATE ads SET
                title = '$update_ad[title]',
                price = '$update_ad[price]',
                seller_name = '$update_ad[seller_name]',
                private = $update_ad[private],
                email = '$update_ad[email]',
                allow_mails = $update_ad[allow_mails],
                phone = '$update_ad[phone]',
                location_id = $update_ad[location_id],
                category_id = $update_ad[category_id],
                description = '$update_ad[description]'
            WHERE id = $id";
    mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
}

// показ конкрентного объявления
function showAd($link, $id){
    $query = "SELECT * FROM ads WHERE id = $id";
    $res = mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
	$row = mysqli_fetch_assoc($res);
	return $row;
}
// удаление объявления
function delAd($link, $id){
	$query = "DELETE FROM ads WHERE id = $id";
	mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
}

// список городов
function location_id($link){
    $query = "SELECT id, location FROM locations ORDER BY location";
    $res = mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[$row['id']]=$row['location'];
    }
return $data;
}

// список подкатегорий
function label_id($link){
    $query = "SELECT id, category FROM categorys WHERE parent_id IS NULL";
    $res = mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[$row['id']]=$row['category'];
    }
return $data;
}

// список категорий
function category_id($link){
    $query = "SELECT id, category, parent_id FROM categorys WHERE parent_id IS NOT NULL";
    $res = mysqli_query( $link, $query) or die ('Запрос не удался:'.mysqli_error($link));
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[$row['parent_id']][$row['id']]=$row['category'];
    }
return $data;
}
