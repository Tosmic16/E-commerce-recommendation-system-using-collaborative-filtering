<?php


$purchase = array("Vincent"=>array("Chinos","Sweatshirt","Sleeve","Jacket", "Joggers","Hoddie", "Hoodies & Joggers","Denim", "Tshirt", "Black Jeans"),
 "Tosin"=>array("Vneck","Gown","Palazzo", "Turtle neck", "Sleeve"), 
 "Micheal"=>array("Black Coperate", "Sweatshirt", "Joggers", "Bodycon", "Lingerie") ,
 "Anita"=>array("Lingerie", "Blue Jeans","Palazzo", "Pyjams"),
 "Oyin"=>array("Chinos","Sweatshirt","Sleeve","Jacket","Black coperate"),
  "Queen"=> array("Black Jeans","Turtle neck", "Blue jeans", "Joggers","Hoodie"),
   "Ahmed"=>array("Gown","Denim","Bodycon", "Jumpsuit","Pyjamas"),
    "Samuel"=>array("Lingerie","Palazzo","Tshirt","Hoodies & Joggers", "Vneck"),
    "Peter" => array("Palazzo", "Lingerie"),
    "TK" => array("Black Jeans", "Blue Jeans", "Jacket")

);

$wishlist = array("Vincent"=>array("Pyjamas","Joggers","Palazzo", "Lingerie"), "Tosin"=>array("Joggers","Hoodie","Palazzo"), "Micheal"=>array("Black Jeans", "Blue Jeans","Tshirt"));
$view = array("Vincent"=>array("Tshirt","Hoodies & Joggers","Jumpsuit"), "Tosin"=>array("Blue Jeans","Black Jeans"), "Micheal"=>array("Denim", "Lingerie","Tshirt"));

$name = "Vincent";
$i=0;

$p_order = array();
$w_order = array();
$v_order = array();
$collect = array();
$checker =count($purchase[$name]);
$diff=array();
$recommend= array();


//Strict checking if the user has purchase any item before

if (array_key_exists($name, $purchase)) {

    // --------------------------This block check with other users to identify similar order pattern---------------------

    //looping through to compare specified user purchase with other users for recommendation
foreach ($purchase as $key=> $value) {
    #this count the number of item they both have in common
    $i_count = count(array_intersect($purchase[$name], $purchase[$key]));

    
    if ($purchase[$key] != $purchase[$name]) {
        #this code push the name of the compared user, mapping it with the number of item it have in common with the specified user.
        $p_order +=[$key=>$i_count];
        
         }
    }   
 }

     //looping through to compare user wishlist with other users for recommendation

foreach ($wishlist as $key=> $value) {
    $i_count = count(array_intersect($purchase[$name], $wishlist[$key]));
    if ($wishlist[$key] != $purchase[$name]) {
        $w_order +=[$key=>$i_count];
        
    }
}    

     //looping through to compare user wishlist with other users for recommendation

foreach ($view as $key=> $value) {
    $i_count = count(array_intersect($purchase[$name], $view[$key]));
    if ($view[$key] != $purchase[$name]) {
        $v_order +=[$key=>$i_count];
        
    }
}   

// ------------------------------------------------the block ends here------------------------------------------------

//collecting all arrays into a super array in in order to check which has the most intersection, of which should be prioritized
$collect += ["p"=>$p_order];
$collect += ["v"=>$v_order];
$collect += ["w"=>$w_order];


#-------------------------this block here is the algorithm that reccomends in order of shopping pattern -------------------------

for ($i=(count($purchase[$name])); $i >0 ; $i--) { 
    # code...
foreach ($collect as $key => $order) {

    

 foreach ($order as $main => $value) {
    
    if ($i == $value ) {
        if(!empty($purchase[$main])){

        if (count(array_intersect($purchase[$main],$purchase[$name]))>0) {
            # code...
        
        $diff = array_diff($purchase[$main],$purchase[$name]);
        foreach ($diff as $rec) {
if (!in_array($rec,$recommend)) {
array_push($recommend,$rec);}}}}

    if(!empty($wishlist[$main])){
    if ($value == count(array_intersect($wishlist[$main],$purchase[$name])) ) {

$diff = array_diff($wishlist[$main],$purchase[$name]);
        foreach ($diff as $rec) {
if (!in_array($rec,$recommend)) {
array_push($recommend,$rec);}}}}
if(!empty($view[$main])){

if ($value == count(array_intersect($view[$main],$purchase[$name]))) {
    # code...

$diff = array_diff($view[$main],$purchase[$name]);
        foreach ($diff as $rec) {
if (!in_array($rec,$recommend)) {
array_push($recommend,$rec);}}}}
        }
    }

    
 }
#-----------------------------------The block Ends Here----------------------------------------------
}
#Loop to get the top six recommendation for the specfied user

if (count($recommend)>6){
echo "    <br> "."<h3>These are the top 7 recommendation for $name </h3> <br>";
for ($p=0; $p <7 ; $p++) { 
echo " <span style='margin-left:30px'>"."      => ". ($p+1). ". ".$recommend[$p]." </span> <br><br>";
}}
else {
    echo "    <br> "."<h3>These are the top:". count($recommend). " recommendation for $name </h3> <br>";

    for ($q=0; $q <(count($recommend)) ; $q++) { 

        echo " <span style='margin-left:30px'>"."      => ". ($q+1). ". ".$recommend[$q]." </span> <br><br>";
    }
}
?>