<?php
include_once plugin_dir_path(__DIR__) . "data/UserRepository.php";

$repo = new UserRepository();
$singleUser = $repo->singleUser($id);

$googleMaps = "https://www.google.com/maps?q=".$singleUser->address->geo->lat.",+".$singleUser->address->geo->lng;

 ?>
 <div class="row single dark-theme">
     <div class="cols col-4">
        <p><span>ID:</span> <?= $singleUser->id ?></p>
        <p><span>Name:</span> <?= $singleUser->name ?></p>
        <p><span>Username:</span> <?= $singleUser->username ?></p>
        <p><span>Emmail:</span> <a href="mailto:<?= $singleUser->email ?>"><?= $singleUser->email ?></a></p>
     </div>
     <div class="cols col-4">
        <p><span>Street:</span> <?= $singleUser->address->street ?></p>
        <p><span>Suite:</span> <?= $singleUser->address->suite ?></p>
        <p><span>City:</span> <?= $singleUser->address->city ?></p>
        <p><span>See on Google Maps:</span> <a href="<?= $googleMaps ?>" target="_blank">Here</a></p>
     </div>
     <div class="cols col-4">
        <p><span>Phone:</span> <?= $singleUser->phone ?></p>
        <p><span>Website:</span> <?= $singleUser->website ?></p>
        <p><span>Company:</span> <?= $singleUser->company->name ?></p> 
     </div>
 </div>
